<?php

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;

use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Model\VO\BugReport;
use Jubarte\Model\VO\Token;

use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;
use Jubarte\Model\BSL\SendMail;
use Jubarte\Util\Exceptions\NoInternetException;

class BugReportController
{
    public static function getAll(Request $request, Response $response)
    {
        try {

            $parametros = $request->getParsedBody();
            $draw = $parametros['draw'];
            $limit = $parametros['length'];
            $offset = $parametros['start'];
            $search = '%' . $parametros['search'] . '%';

            $query = DBLayer::Connect()->table(BugReport::TABLE_NAME)
                ->where(function ($query) use ($request, $search) {
                    $query->orWhere(BugReport::KEY_ID, DBLayer::OPERATOR_ILIKE, $search);
                    $query->orWhere(BugReport::SISTEMA, DBLayer::OPERATOR_ILIKE, $search);
                });

            $totalRecords = $query->count();
            if ($parametros) {
                $data = $query->orderBy(BugReport::KEY_ID, DBLayer::ORDER_DIRE_ASC)
                    ->take($limit)->offset($offset)->get();
            } else {
                $data = $query->orderBy(BugReport::KEY_ID, DBLayer::ORDER_DIRE_ASC)
                    ->get();
            }

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $totalRecords;
            $result['recordsTotal'] = $totalRecords;
            $result['data'] = $data;
        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }

    public static function save(Request $request, Response $response)
    {
        try {
            $token = new Token($request);
            $host = $request->getHeaderLine('Host');
            $origin = $request->getHeaderLine('origin');

            $id = $request->getAttribute('id');
            $bugReporteformData = Utils::filterArrayByArray($request->getParsedBody(), BugReport::TABLE_FIELDS);

            $sendMail = new SendMail();
            $sendMail->to("BugReporte " . $bugReporteformData[BugReport::SISTEMA],
                $bugReporteformData[BugReport::DESCRICAO_PROBLEMA]);

            /********************* INIT CRIA BA NO CIENTE ******************************/

            $atendimento = [
                "prioridade" => "2",
                "idOrganograma" => 19,//cotinf
                "idSolicitante" => $token->getIdPessoa(),//2 = isaque
                "idEquipamento" => "",
                "idOperador" =>  $token->getIdPessoa(),//isaque
                "idSetor" => 4,//destinatario DESV
                "idServico" => "108",//Correção de erros/bugs
                "idProduto" => "3",//Ciente
                "descricao" => $bugReporteformData[BugReport::DESCRICAO_PROBLEMA],//descrição
                "observacao" => $bugReporteformData[BugReport::PAGINA],
                "status" => 1//status aberto
            ];

            $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.104 Safari/537.36';

            // data fields for POST request
            $fields = array("data" => json_encode($atendimento));
            // files to upload
            /*
             $filenames = array("/tmp/1.jpg", "/tmp/2.png");;
             $files = array();
             foreach ($filenames as $f) {
                 $files[$f] = file_get_contents($f);
             }*/

            // URL to upload to
            $url = $origin . '/ciente/api/solicitacao';
            // curl
            $curl = curl_init();

            $boundary = uniqid();
            $delimiter = '-------------' . $boundary;
            $post_data = self::buildMultipartFormData($boundary, $fields);
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                //CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $post_data,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $token->getToken(),
                    "Content-Type: multipart/form-data; boundary=" . $delimiter,
                    "Content-Length: " . strlen($post_data)
                ),
            ));

            $result = curl_exec($curl);
            $info = curl_getinfo($curl);
            $curl_errno = curl_errno($curl);
            $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $http_code = $info['http_code'];
            $request_header = $info['request_header'];
            curl_close($curl);

            if ($curl_errno) {
                if ($curl_errno == 6 || $curl_errno == 7) {
                    throw new NoInternetException();
                } else {
                    throw new Exception('CURL: ' . $curl_errno . ' HTTP: ' . $http_status . ' ', 400);
                }
            }

            /********************* FIM  CRIA BA NO CIENTE ******************************/

            if ($id) {
                DBLayer::Connect()->table(BugReport::TABLE_NAME)
                    ->where(BugReport::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)
                    ->update($bugReporteformData);
            } else {
                DBLayer::Connect()->table(BugReport::TABLE_NAME)
                    ->insert($bugReporteformData);
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson([
                    'message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO,
                    'result' => '',
                    'http_status' => ''
                ]);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }

    }

    public static function buildMultipartFormData($boundary, $fields, $files = null)
    {
        $data = '';
        $eol = "\r\n";

        $delimiter = '-------------' . $boundary;

        foreach ($fields as $name => $content) {
            $data .= "--" . $delimiter . $eol
                . 'Content-Disposition: form-data; name="' . $name . "\"" . $eol . $eol
                . $content . $eol;
        }

        if ($files) {
            foreach ($files as $name => $content) {
                $data .= "--" . $delimiter . $eol
                    . 'Content-Disposition: form-data; name="' . $name . '"; filename="' . $name . '"' . $eol
                    //. 'Content-Type: image/png'.$eol
                    . 'Content-Transfer-Encoding: binary' . $eol;

                $data .= $eol;
                $data .= $content . $eol;
            }
            $data .= "--" . $delimiter . "--" . $eol;
        }

        return $data;
    }

    public static function get(Request $request, Response $response)
    {
        try {
            $id = $request->getAttribute('id');

            $result = DBLayer::Connect()->table(BugReport::TABLE_NAME)
                ->where(BugReport::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)
                ->first();

            return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }

    public static function delete(Request $request, Response $response)
    {
        try {
            $formData = $request->getParsedBody();
            $ids = $formData['ids'];
            $idsCount = count($ids);
            $itensDeletadosCount = 0;
            foreach ($ids as $id) {
                $result = DBLayer::Connect()->table(BugReport::TABLE_NAME)
                    ->where(BugReport::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)
                    ->first();

                if ($result) {
                    if (DBLayer::Connect()->table(BugReport::TABLE_NAME)->delete($id)) {
                        $itensDeletadosCount++;
                    }
                }
            }
            if ($itensDeletadosCount == $idsCount) {
                return $response->withStatus(StatusCode::SUCCESS)->withJson(['message' => StatusMessage::TODOS_ITENS_DELETADOS]);
            } else if ($itensDeletadosCount > 0) {
                return $response->withStatus(StatusCode::SUCCESS)->withJson(['message' => StatusMessage::NEM_TODOS_ITENS_DELETADOS]);
            } else {
                return $response->withStatus(StatusCode::SUCCESS)->withJson((['message' => StatusMessage::NENHUM_ITEM_DELETADO]));
            }
        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }


}