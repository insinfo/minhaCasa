<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 02/04/2018
 * Time: 13:54
 */

namespace Jubarte\Controller;



use PmroPadraoLib\Controller\PessoaController;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;
use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

use Jubarte\Model\VO\Servidor;
use Jubarte\Model\VO\CargaHoraria;
use Jubarte\Model\VO\Cargo;
use Jubarte\Model\VO\FuncaoGratificada;
use Jubarte\Model\VO\Horario;
use Jubarte\Model\VO\JornadaTrabalho;
use Jubarte\Model\VO\LocalBiometria;
use Jubarte\Model\VO\Vinculo;
use Jubarte\Model\BSL\ValidationAPI;
use Jubarte\Model\VO\ViewServidoresJson;
use Jubarte\Model\VO\ViewServidores;
use Jubarte\Model\VO\ViewPessoas;
use Jubarte\Model\VO\PessoaFisica;
use Jubarte\Model\VO\Token;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ServidorController
{
    public static function save(Request $request, Response $response)
    {
        try {
            //$id = $request->getAttribute('id');
            $formData = $request->getParsedBody();

            $servidores = isset($formData['servidores']) ? $formData['servidores'] : null;
            $cargaHoraria = isset($formData['cargaHoraria']) ? $formData['cargaHoraria'] : null;

            $pessoa = $formData;
            unset($pessoa['servidores']);
            unset($pessoa['cargaHoraria']);

            if ($pessoa == null && $servidores == null && $cargaHoraria == null) {
                throw new Exception('JSON inválido ou dados incompletos!');
            }

            DBLayer::Connect();
            $pdo = DBLayer::connection()->getPdo();

            //1ª pessoa
            $cpf = $pessoa['cpf'];

            if (ValidationAPI::validaCPF($cpf) === false) {
                throw new Exception('CPF invalido!');
            }

            $idPessoa = PessoaController::isExistFisica($cpf, $pdo);

            DBLayer::transaction(function () use ($request, &$pdo, &$idPessoa, $cpf, $pessoa, $servidores, $cargaHoraria) {

                //1ª update pessoa
                if ($idPessoa) {

                    if (!isset($pessoa['preventUpdate'])) {
                        $pessoa['idPessoa'] = $idPessoa;
                        PessoaController::update($pessoa, $pdo);
                    }

                } else {
                    $idPessoa = PessoaController::save($pessoa, $pdo);
                }

                //2ª servidores
                if (is_array($servidores)) {

                    foreach ($servidores as $servidor) {

                        $servidor = Utils::filterArrayByArray($servidor, Servidor::TABLE_FIELDS);
                        $servidor[Servidor::ID_PESSOA] = $idPessoa;

                        $matricula = $servidor[Servidor::MATRICULA];

                        $idServidor = DBLayer::table(Servidor::TABLE_NAME)
                            ->select(Servidor::KEY_ID)
                            ->where(Servidor::ID_PESSOA, '=', $idPessoa)
                            ->where(Servidor::MATRICULA, '=', $matricula)->first();

                        if ($idServidor) {

                            DBLayer::table(Servidor::TABLE_NAME)
                                ->where(Servidor::KEY_ID, '=', $idServidor)
                                ->update($servidor);

                        } else {

                            DBLayer::table(Servidor::TABLE_NAME)
                                ->insert($servidor);
                        }
                    }
                }

                //3ª insert cargaHoraria
                if (is_array($cargaHoraria)) {

                    $idFist = true;
                    foreach ($cargaHoraria as $value) {
                        $carga[CargaHoraria::ANO_COMPETENCIA] = '2018';
                        $carga[CargaHoraria::MES_COMPETENCIA] = '06';
                        $carga[CargaHoraria::ID_LOCAL_BIOMETRIA] = $value['id'];
                        $carga[CargaHoraria::TIPO] = 'semanal';
                        $carga[CargaHoraria::ID_PESSOA] = $idPessoa;

                        if ($idFist) {
                            DBLayer::table(CargaHoraria::TABLE_NAME)
                                ->where(CargaHoraria::ID_PESSOA, '=', $idPessoa)
                                /*->where(CargaHoraria::MES_COMPETENCIA, '=', $carga[CargaHoraria::MES_COMPETENCIA])
                                ->where(CargaHoraria::ANO_COMPETENCIA, '=', $carga[CargaHoraria::ANO_COMPETENCIA])*/
                                ->delete();
                            $idFist = false;
                        }

                        $idCarga = DBLayer::table(CargaHoraria::TABLE_NAME)
                            ->insertGetId($carga);

                        $horarios = isset($value['times']) ? $value['times'] : null;

                        //4ª insert horarios
                        if (is_array($horarios)) {
                            foreach ($horarios as $item) {
                                $horario[Horario::DIA_SEMANA] = $item['weekday'];
                                $horario[Horario::ENTRADA] = $item['in'];
                                $horario[Horario::SAIDA] = $item['out'];
                                $horario[Horario::TEMPO_TOTAL] = $item['_total'];
                                $horario[Horario::KEY_ID] = $idCarga;
                                DBLayer::table(Horario::TABLE_NAME)->insert($horario);
                            }
                        }
                    }
                }

            });

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }

        return $response->withStatus(StatusCode::SUCCESS)
            ->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);
    }

    public static function saveImport(Request $request, Response $response)
    {
        try {
            //$id = $request->getAttribute('id');
            $formData = $request->getParsedBody();
            $pessoa = $formData['pessoa'];
            $servidor = $formData['servidor'];
            $cargaHoraria = isset($formData['cargaHoraria']) ? $formData['cargaHoraria'] : null;

            DBLayer::Connect();
            $pdo = DBLayer::connection()->getPdo();

            //1ª pessoa
            $cpf = $pessoa['cpf'];

            if (!ValidationAPI::validaCPF($cpf)) {
                throw new Exception('CPF invalido!');
            }

            $idPessoa = PessoaController::isExistFisica($cpf, $pdo);

            DBLayer::transaction(function () use ($request, &$pdo, &$idPessoa, $cpf, $pessoa, $servidor, $cargaHoraria) {

                if ($idPessoa != null) {

                    if (!isset($pessoa['preventUpdate'])) {
                        $pessoa['idPessoa'] = $idPessoa;
                        PessoaController::update($pessoa, $pdo);
                    }

                } else {
                    $idPessoa = PessoaController::save($pessoa, $pdo);
                }

                //2ª servidor
                if ($servidor) {

                    $servidor = Utils::filterArrayByArray($servidor, Servidor::TABLE_FIELDS);
                    $servidor[Servidor::ID_PESSOA] = $idPessoa;

                    $matricula = $servidor[Servidor::MATRICULA];

                    $idServidor = DBLayer::table(Servidor::TABLE_NAME)
                        ->select(Servidor::KEY_ID)
                        ->where(Servidor::ID_PESSOA, '=', $idPessoa)
                        ->where(Servidor::MATRICULA, '=', $matricula)->first();

                    if ($idServidor) {
                        if (!isset($servidor['preventUpdate'])) {
                            DBLayer::table(Servidor::TABLE_NAME)
                                ->where(Servidor::KEY_ID, '=', $idServidor)
                                ->update($servidor);
                        }
                    } else {
                        DBLayer::table(Servidor::TABLE_NAME)
                            ->insert($servidor);
                    }

                }

                //3ª insert cargaHoraria
                if ($cargaHoraria) {
                    $idFist = true;
                    foreach ($cargaHoraria as $value) {
                        $carga = Utils::filterArrayByArray($value, CargaHoraria::TABLE_FIELDS);
                        $carga[CargaHoraria::ID_PESSOA] = $idPessoa;

                        if ($idFist) {
                            DBLayer::table(CargaHoraria::TABLE_NAME)
                                ->where(CargaHoraria::ID_PESSOA, '=', $idPessoa)
                                ->where(CargaHoraria::MES_COMPETENCIA, '=', $carga[CargaHoraria::MES_COMPETENCIA])
                                ->where(CargaHoraria::ANO_COMPETENCIA, '=', $carga[CargaHoraria::ANO_COMPETENCIA])
                                ->delete();
                            $idFist = false;
                        }

                        $idCarga = DBLayer::table(CargaHoraria::TABLE_NAME)
                            ->insertGetId($carga);

                        //4ª insert horarios
                        if (isset($carga['horarios'])) {
                            $horarios = $carga['horarios'];
                            foreach ($horarios as $item) {
                                $horario = Utils::filterArrayByArray($item, Horario::TABLE_FIELDS);
                                $horario[Horario::KEY_ID] = $idCarga;
                                DBLayer::table(Horario::TABLE_NAME)->insert($horario);
                            }
                        }
                    }
                }

            });


        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }

        return $response->withStatus(StatusCode::SUCCESS)
            ->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);
    }

    public static function getByCPF(Request $request, Response $response)
    {
        try {
            $cpf = $request->getAttribute('cpf');
            //$formData = $request->getParsedBody();
            DBLayer::Connect();

            $data = DBLayer::table(ViewServidoresJson::TABLE_NAME)
                ->where(PessoaFisica::CPF, '=', $cpf)->first();
            //$result = json_decode($data['jsonServidor']);

            $jsonServidor = $data['jsonServidor'];

            if (!$jsonServidor) {
                return $response->withStatus(StatusCode::NOT_FOUND)
                    ->withJson(['message' => 'Não existe na base de dados!']);
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->write($jsonServidor)
                ->withHeader('Content-type', 'application/json');

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }

    public static function getByToken(Request $request, Response $response)
    {
        try {
            $token = new Token($request);
            DBLayer::Connect();

            $data = DBLayer::table(ViewServidoresJson::TABLE_NAME)
                ->where(ViewServidoresJson::ID_PESSOA, '=', $token->getIdPessoa())->first();

            $jsonServidor = $data['jsonServidor'];

            if (!$jsonServidor) {
                return $response->withStatus(StatusCode::NOT_FOUND)
                    ->withJson(['message' => 'Não existe na base de dados!']);
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->write($jsonServidor)
                ->withHeader('Content-type', 'application/json');

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }

    public static function getAll(Request $request, Response $response)
    {
        try {

            $params = $request->getParsedBody();
            $draw = $params['draw'];
            $limit = $params['length'];
            $offset = $params['start'];
            $search = isset($params['search']) ? '%' . $params['search'] . '%' : '%%';
            $ordering = isset($params['ordering']) ? $params['ordering'] : null;

            DBLayer::Connect();
            $query = DBLayer::table(ViewServidores::TABLE_NAME)
                ->where(function ($query) use ($request, $search) {
                    $query->orWhere(ViewServidores::MATRICULA, 'ilike', $search);
                    $query->orWhere(ViewServidores::NOME, 'ilike', $search);
                    $query->orWhere(ViewServidores::CPF, 'ilike', $search);
                    $query->orWhere(ViewServidores::RG, 'ilike', $search);
                    $query->orWhere(ViewServidores::SIGLA_LOTACAO, 'ilike', $search);
                    $query->orWhere(ViewServidores::NOME_LOTACAO, 'ilike', $search);
                });

            $totalRecords = $query->count();
            //implementação da ordenação do ModernDataTable
            if ($ordering != null && count($ordering) > 0) {
                foreach ($ordering as $item) {
                    $query->orderBy($item['columnKey'], $item['direction']);
                }
            }

            $data = $query->limit($limit)->offset($offset)->get();

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $totalRecords;
            $result['recordsTotal'] = $totalRecords;
            $result['data'] = $data;

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }
    //gera um arquivo excel xlsx listando servidores que cadastraram a bimetria
    public static function genXlsxAllBio(Request $request, Response $response)
    {
        try {
            $params = $request->getParsedBody();
            $draw = isset($params['draw']) ? $params['draw'] : null;
            $limit = isset($params['length']) ? $params['length'] : null;
            $offset = isset($params['start']) ? $params['start'] : null;
            $search = isset($params['search']) ? '%' . $params['search'] . '%' : null;
            $ordering = isset($params['ordering']) ? $params['ordering'] : null;

            //faz a consulta no banco de dados
            DBLayer::Connect();
            $query = DBLayer::table('view_exportacao_biometria')
                ->select(DBLayer::raw(' *'))//DISTINCT on ("idPessoa")
              ->where('biometria','=','t');

            //$totalRecords = $query->count();
            $data = $query->get();

            if($data == null || count($data) == 0)
            {
                throw new \Exception('Não ha dados disponiveis');
            }

            $countCargaHorario = 0;
            //verifica qual pessoa da consulta do banco de dados tem mais carga horaria
            foreach ($data as $row) {
                $json = json_decode($row['jsonCagaHoraria'],true);
                $cont = count($json['cargaHoraria']);
                if($cont > $countCargaHorario){
                    $countCargaHorario = $cont;
                }
            }
            //pega somente a primeira linha da consulta do banco
            $header = $data[0];
            //remove a coluna  json carga horaria do header
            unset($header['jsonCagaHoraria']);
            //pega as keys do array associativo da consulta do banco de dados
            $header = array_keys($header);
            //prepara as keys de carga horaria
            $titulosCarcaHoraria = [
                'localBiometria',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida'
            ];
            //faz a mescla das keys do array associativo do banco com as keys da carga horaria
            for($i=0; $i < $countCargaHorario;$i++){
                $header = array_merge($header, $titulosCarcaHoraria);
            }
            //gera um nome randomico para o arquivo temporario
            $randoFileName = Utils::getUniqueId().'.xlsx';
            //inicializa a extenção xlswriter https://github.com/viest/php-ext-excel-export
            $config = ['path' => __DIR__];
            $excel  = new \Vtiful\Kernel\Excel($config);
            $excelAPI = $excel->constMemory($randoFileName);
            //gera o header no XLSX
            $excelAPI->header($header);

            //lopp principal para pegar os dados e colocar no XLSX
            $count = 1;
            foreach ($data as $row){
                $json = json_decode($row['jsonCagaHoraria'],true);
                $cagaHoraria = $json['cargaHoraria'];//array_values($json);

                $cargas = array();
                foreach($cagaHoraria as $carga)
                {
                    array_push($cargas,$carga['localBiometria']['unidade']);
                    $horarios = $carga['horarios'];

                    $hor = [
                        // 'diaSemana','entrada','saida',
                        'domingo','','',
                        'segunda','','',
                        'terça','','',
                        'quarta','','',
                        'quinta','','',
                        'sexta','','',
                        'sábado','','',
                    ];

                    for($i=0; $i < 7; $i++){
                        foreach ($horarios as $horario){
                            if($horario['diaSemana'] == $i) {
                                $posSemana = $i*3;
                                //$hor[$i] = $horario['diaSemana'];
                                $hor[$posSemana+1] = Utils::parseTimestamp($horario['entrada'],'H:i');
                                $hor[$posSemana+1+1] = Utils::parseTimestamp($horario['saida'],'H:i');
                            }
                        }
                    }
                    $cargas = array_merge($cargas, $hor);
                }

                $linha = $row;
                unset($linha['jsonCagaHoraria']);
                $linha = array_values($linha);
                $linha = array_merge($linha, $cargas);

                //adiciona no xlsx os dados da linha atual
                $excelAPI->data([$linha]);

                if($count == 15000){
                    break;
                }
                $count++;
            }

            //gera o arquivo xlsx
            $outPatch = $excelAPI->output();
            //pega o tamanho do arquivo
            $filesize = filesize($outPatch);
            //abre o arquivo criado
            $file = fopen($outPatch, 'r');
            //pega o conteudo do arquivo e coloca na variavel $contents
            $contents = fread($file,$filesize );
            //fecha o arquivo
            fclose($file);
            //deleta o arquivo
            unlink($outPatch);

            $response = $response->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $response = $response->withHeader('Content-Length',  $filesize);
            $response = $response->write($contents);
            return $response;

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }
    //gera um arquivo excel xlsx listando todos servidores
    public static function genXlsxAll(Request $request, Response $response)
    {
        try {
            $params = $request->getParsedBody();
            $draw = isset($params['draw']) ? $params['draw'] : null;
            $limit = isset($params['length']) ? $params['length'] : null;
            $offset = isset($params['start']) ? $params['start'] : null;
            $search = isset($params['search']) ? '%' . $params['search'] . '%' : null;
            $ordering = isset($params['ordering']) ? $params['ordering'] : null;

            //faz a consulta no banco de dados
            DBLayer::Connect();
            $query = DBLayer::table('view_exportacao_biometria')
                ->select(DBLayer::raw(' *'));//DISTINCT on ("idPessoa")

            //$totalRecords = $query->count();
            $data = $query->get();

            if($data == null || count($data) == 0)
            {
                throw new \Exception('Não ha dados disponiveis');
            }

            $countCargaHorario = 0;
            //verifica qual pessoa da consulta do banco de dados tem mais carga horaria
            foreach ($data as $row) {
                $json = json_decode($row['jsonCagaHoraria'],true);
                $cont = count($json['cargaHoraria']);
                if($cont > $countCargaHorario){
                    $countCargaHorario = $cont;
                }
            }
            //pega somente a primeira linha da consulta do banco
            $header = $data[0];
            //remove a coluna  json carga horaria do header
            unset($header['jsonCagaHoraria']);
            //pega as keys do array associativo da consulta do banco de dados
            $header = array_keys($header);
            //prepara as keys de carga horaria
            $titulosCarcaHoraria = [
                'localBiometria',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida',
                'diaSemana','entrada','saida'
            ];
            //faz a mescla das keys do array associativo do banco com as keys da carga horaria
            for($i=0; $i < $countCargaHorario;$i++){
                $header = array_merge($header, $titulosCarcaHoraria);
            }
            //gera um nome randomico para o arquivo temporario
            $randoFileName = Utils::getUniqueId().'.xlsx';
            //inicializa a extenção xlswriter https://github.com/viest/php-ext-excel-export
            $config = ['path' => __DIR__];
            $excel  = new \Vtiful\Kernel\Excel($config);
            $excelAPI = $excel->constMemory($randoFileName);
            //gera o header no XLSX
            $excelAPI->header($header);

            //lopp principal para pegar os dados e colocar no XLSX
            $count = 1;
            foreach ($data as $row){
                $json = json_decode($row['jsonCagaHoraria'],true);
                $cagaHoraria = $json['cargaHoraria'];//array_values($json);

                $cargas = array();
                foreach($cagaHoraria as $carga)
                {
                    array_push($cargas,$carga['localBiometria']['unidade']);
                    $horarios = $carga['horarios'];

                    $hor = [
                        // 'diaSemana','entrada','saida',
                        'domingo','','',
                        'segunda','','',
                        'terça','','',
                        'quarta','','',
                        'quinta','','',
                        'sexta','','',
                        'sábado','','',
                    ];

                    for($i=0; $i < 7; $i++){
                        foreach ($horarios as $horario){
                            if($horario['diaSemana'] == $i) {
                                $posSemana = $i*3;
                                //$hor[$i] = $horario['diaSemana'];
                                $hor[$posSemana+1] = Utils::parseTimestamp($horario['entrada'],'H:i');
                                $hor[$posSemana+1+1] = Utils::parseTimestamp($horario['saida'],'H:i');
                            }
                        }
                    }
                    $cargas = array_merge($cargas, $hor);
                }

                $linha = $row;
                unset($linha['jsonCagaHoraria']);
                $linha = array_values($linha);
                $linha = array_merge($linha, $cargas);

                //adiciona no xlsx os dados da linha atual
                $excelAPI->data([$linha]);

                if($count == 15000){
                    break;
                }
                $count++;
            }

            //gera o arquivo xlsx
            $outPatch = $excelAPI->output();
            //pega o tamanho do arquivo
            $filesize = filesize($outPatch);
            //abre o arquivo criado
            $file = fopen($outPatch, 'r');
            //pega o conteudo do arquivo e coloca na variavel $contents
            $contents = fread($file,$filesize );
            //fecha o arquivo
            fclose($file);
            //deleta o arquivo
            unlink($outPatch);

            $response = $response->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $response = $response->withHeader('Content-Length',  $filesize);
            $response = $response->write($contents);
            return $response;

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }
}