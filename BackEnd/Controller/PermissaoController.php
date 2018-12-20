<?php

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;
use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Model\VO\Permissao;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

class PermissaoController
{
    public static function getAll(Request $request, Response $response)
    {
        try
        {
            //evita exiber noticia Notice: Undefined offset
            error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT ^ E_DEPRECATED);
            $parametros = $request->getParsedBody();
            $draw = $parametros['draw'];
            $limit = $parametros['length'];
            $offset = $parametros['start'];
            $search = '%' . $parametros['search'] . '%';
            $idPerfil = $parametros['idPerfil'];
            $idSistema = $parametros['idSistema'];

            $query = DBLayer::Connect()->table(Permissao::TABLE_NAME)->where(function ($query) use ($request, $search)
                {
                    $query->orWhere(Permissao::ID_PESSOA, DBLayer::OPERATOR_ILIKE, $search);
                    $query->orWhere(Permissao::ID_PERFIL, DBLayer::OPERATOR_ILIKE, $search);
                })
            ;

            if (isset($idPerfil))
            {
                $query->where(Permissao::ID_PERFIL, '=', $idPerfil);
            }
            if (isset($idSistema))
            {
                $query->where(Permissao::ID_SISTEMA, '=', $idSistema);
            }
            $totalRecords = $query->count();

            if (isset($limit))
            {
                $data = $query->limit($limit)->offset($offset)->get();
            }
            else
            {
                $data = $query->get();
            }

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $totalRecords;
            $result['recordsTotal'] = $totalRecords;
            $result['data'] = $data;
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }

    public static function save(Request $request, Response $response)
    {
        try
        {
            $permicao = $request->getParsedBody();
            $query = DBLayer::Connect()->table(Permissao::TABLE_NAME);

            $idPerfil = $permicao[Permissao::ID_PERFIL];
            $idSistema = $permicao[Permissao::ID_SISTEMA];
            $idPessoa = $permicao[Permissao::ID_PESSOA];

            $query->where(Permissao::ID_PERFIL, '=', $idPerfil);
            $query->where(Permissao::ID_SISTEMA, '=', $idSistema);
            $query->where(Permissao::ID_PESSOA, '=', $idPessoa);
            $query->delete();

            $menus = $permicao['menus'];
            foreach ($menus as $item)
            {
                $query->insert(['idPerfil' => $idPerfil, 'idSistema' => $idSistema, 'idPessoa' => $idPessoa, 'idMenu' => $item]);
            }
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);
    }


}