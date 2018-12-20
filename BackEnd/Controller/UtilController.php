<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 07/12/2017
 * Time: 11:27
 */

namespace Jubarte\Controller;

use \Firebase\JWT\ExpiredException;
use \Exception;
use \Slim\Http\Request;
use \Slim\Http\Response;

use Jubarte\Util\DBLayer;
use Jubarte\Util\LdapAuth;
use Jubarte\Util\JWTWrapper;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;
use Jubarte\Model\DAL\UsuarioDAL;
use Jubarte\Model\DAL\PessoaDAL;
use Jubarte\Util\Criptografia;
use Jubarte\Middleware\IpAddressMiddleware;

class UtilController
{
    public static function getUserIP(Request $request, Response $response)
    {
        //$param = $request->getParsedBody();
        try
        {
            $ipAddress = $request->getAttribute('ip_address');
            $result['ip'] = $ipAddress;

            return $response->withStatus(StatusCode::SUCCESS)->
            withJson($result);
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)->
            withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }

    }

    public static function getCepByEndereco(Request $request, Response $response)
    {
        try
        {
            $param = $request->getParsedBody();
            $uf = $param['uf'];
            $municipio = $param['municipio'];
            $bairro = $param['bairro'];
            $logradouro = $param['logradouro'];

            $draw = isset($param['draw']) ? $param['draw'] : null;
            $length = isset($param['length']) ? $param['length'] : null;
            $start = isset($param['start']) ? $param['start'] : null;
            $search = isset($param['search']) ? $param['search'] : null;

            $query = DBLayer::Connect('laravelMysql')
                ->table(DBLayer::raw('log_logradouro, log_localidade, log_bairro'))
            ->select(DBLayer::raw('log_logradouro.log_tipo_logradouro as tipo, 
                                    log_logradouro.log_no as logradouro,
                                    log_logradouro.log_nome as complemento,
                                    log_bairro.bai_no as bairro,
                                    log_localidade.loc_no as municipio,
                                    log_localidade.ufe_sg as uf,
                                    log_logradouro.cep as cep'))
            ->from(DBLayer::raw('log_logradouro, log_localidade, log_bairro'))
            ->whereRaw('log_logradouro.loc_nu_sequencial = log_localidade.loc_nu_sequencial')
            ->whereRaw('log_logradouro.bai_nu_sequencial_ini = log_bairro.bai_nu_sequencial')
            ->whereRaw("log_localidade.ufe_sg LIKE CONCAT('%$uf%')")
            ->whereRaw("log_localidade.loc_no LIKE CONCAT('%$municipio%')")
                ->whereRaw("log_bairro.bai_no LIKE CONCAT('%$bairro%')")
            ->whereRaw("Concat(log_logradouro.log_tipo_logradouro ,' ', log_logradouro.LOG_NOME) LIKE '%$logradouro%'");

            //$result['sql'] = $query->toSql();
            if($length)
            {
                $totalRecords = $query->count();
                $data = array();
                $data['draw'] = $draw;
                $data['recordsFiltered'] = $totalRecords;
                $data['recordsTotal'] = $totalRecords;
                $data['data'] = $query->limit($length)->offset($start)->get();
            }
            else
            {
                $data = $query->get();
            }

            if(!$data)
            {
                throw new \Exception('Não existe');
            }

            return $response->withStatus(StatusCode::SUCCESS)->
            withJson($data);
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)->
            withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }

    }

    public static function getEnderecoByCep(Request $request, Response $response)
    {
        //$param = $request->getParsedBody();
        try
        {
            $cep = $request->getAttribute('cep');

            $query = DBLayer::Connect('laravelMysql')
                ->table(DBLayer::raw('log_logradouro,log_localidade,log_bairro'))
                ->select(DBLayer::raw('log_logradouro.log_tipo_logradouro as tipo, 
                        log_logradouro.log_no as logradouro,
                        log_bairro.bai_no as bairro,
                        log_localidade.loc_no as municipio,
                        log_localidade.ufe_sg as uf,
                        log_logradouro.cep'))
                ->from(DBLayer::raw('log_logradouro,log_localidade,log_bairro'))
                ->whereRaw('log_logradouro.loc_nu_sequencial = log_localidade.loc_nu_sequencial')
                ->whereRaw('log_logradouro.bai_nu_sequencial_ini = log_bairro.bai_nu_sequencial')
                ->whereRaw('log_logradouro.cep ='.$cep);

            //$result['sql'] = $query->toSql();
            $data = $query->first();

            if(trim($data['logradouro']) === "")
            {
                throw new \Exception('Não existe',400);
            }

            return $response->withStatus(StatusCode::SUCCESS)->
            withJson($data);
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)->
            withJson(['message' => 'Este CEP é inválido ou não existe na nossa base dos correios.', 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }

    }

    public static function timestamp(Request $request, Response $response, $args) {
        return $response->withJson([
            'time_request' => $_SERVER['REQUEST_TIME'],
            'time' => time(),
            'microtime' => microtime(true),
            'forMoment' => date('Y-m-d\TH:i:s') #2015-02-27T15:00:00
        ]) ->withStatus(StatusCode::SUCCESS);
    }

    /*public static function deploy(Request $request,Response $response)
    {
        /*$githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');
 
        $localToken = config('app.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
 
        if (hash_equals($githubHash, $localHash)) {
            $root_path = base_path();
            $process = new Process('cd ' . $root_path . '; ./deploy.sh');
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });
        }

        return $response->withJson([
            'time_request' => "dfg"
        ]) ->withStatus(StatusCode::SUCCESS);

}*/

}