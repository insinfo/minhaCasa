<?php

namespace Jubarte\Controller;

use Exception;
use Jubarte\Model\VO\Perfil;
use Jubarte\Model\VO\Sistema;
use Jubarte\Util\DBLayer;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;
use Jubarte\Util\Utils;
use Slim\Http\Request;
use Slim\Http\Response;

//error_reporting(E_ALL);

class PerfilController
{
    public static function getAll(Request $request, Response $response)
    {
        try
        {
            //evita exiber noticia Notice: Undefined offset
            error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT ^ E_DEPRECATED);
            $parametros = $request->getParsedBody();
            $draw =  $parametros['draw'];
            $limit = $parametros['length'] ;
            $offset = $parametros['start'];
            $search =  '%' . $parametros['search'] . '%' ;
            $idSistema = $parametros['idSistema'] ;

            $query = DBLayer::Connect()->table(Perfil::TABLE_NAME)
                ->select(Perfil::TABLE_NAME . '.*')
                ->leftJoin(Sistema::TABLE_NAME, Sistema::TABLE_NAME . '.' . Sistema::KEY_ID, '=', Perfil::TABLE_NAME . '.' . Perfil::ID_SISTEMA);

            if ($search)
            {
                $query->where(function ($query) use ($request, $search)
                {
                    $query->orWhere(Sistema::TABLE_NAME . '.' . Sistema::SIGLA, DBLayer::OPERATOR_ILIKE, $search);
                    $query->orWhere(Perfil::TABLE_NAME . '.' . Perfil::SIGLA, DBLayer::OPERATOR_ILIKE, $search);
                    $query->orWhere(Perfil::TABLE_NAME . '.' . Perfil::DESCRICAO, DBLayer::OPERATOR_ILIKE, $search);
                    $query->orWhere(Perfil::TABLE_NAME . '.' . Perfil::PRIORIDADE, DBLayer::OPERATOR_ILIKE, $search);
                });
            }

            //filtra pelo sistema
            if (isset($idSistema))
            {
                $idSistema = $idSistema == "null" ? null : $idSistema;
                $query->where(Perfil::ID_SISTEMA, '=', $idSistema);
                $query->orWhereRaw('"' . Perfil::ID_SISTEMA . '" is null');
            }

            $totalRecords = $query->count();

            if ($limit)
            {
                $data = $query->orderBy(Perfil::KEY_ID, DBLayer::ORDER_DIRE_ASC)->take($limit)->offset($offset)->get();
            }
            else
            {
                $data = $query->orderBy(Perfil::PRIORIDADE, DBLayer::ORDER_DIRE_ASC)->get();
            }

            foreach ($data as &$item)
            {
                $item['sistema'] = DBLayer::Connect()->table(Sistema::TABLE_NAME)->where(Sistema::KEY_ID, $item[Perfil::ID_SISTEMA])->first();
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
            $id = $request->getAttribute('id');
            $formData = Utils::filterArrayByArray($request->getParsedBody(), Perfil::TABLE_FIELDS);

            if ($id)
            {
                DBLayer::Connect()->table(Perfil::TABLE_NAME)->where(Perfil::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)->update($formData);
            }
            else
            {
                DBLayer::Connect()->table(Perfil::TABLE_NAME)->insert($formData);
            }
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);
    }

    public static function get(Request $request, Response $response)
    {
        try
        {
            $id = $request->getAttribute('id');
            $result = DBLayer::Connect()->table(Perfil::TABLE_NAME)->where(Perfil::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)->first();
            return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }

    public static function delete(Request $request, Response $response)
    {
        try
        {
            $formData = $request->getParsedBody();
            $ids = $formData['ids'];
            $idsCount = count($ids);
            $itensDeletadosCount = 0;
            foreach ($ids as $id)
            {
                $result = DBLayer::Connect()->table(Perfil::TABLE_NAME)->where(Perfil::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)->first();

                if ($result)
                {
                    if (DBLayer::Connect()->table(Perfil::TABLE_NAME)->delete($id))
                    {
                        $itensDeletadosCount++;
                    }
                }
            }
            if ($itensDeletadosCount == $idsCount)
            {
                return $response->withStatus(StatusCode::SUCCESS)->withJson(['message' => StatusMessage::TODOS_ITENS_DELETADOS]);
            }
            else if ($itensDeletadosCount > 0)
            {
                return $response->withStatus(StatusCode::SUCCESS)->withJson(['message' => StatusMessage::NEM_TODOS_ITENS_DELETADOS]);
            }
            else
            {
                return $response->withStatus(StatusCode::SUCCESS)->withJson((['message' => StatusMessage::NENHUM_ITEM_DELETADO]));
            }
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }
}