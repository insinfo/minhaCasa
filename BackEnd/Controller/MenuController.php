<?php

namespace Jubarte\Controller;

use Jubarte\Model\VO\Sistema;
use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;

use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Model\VO\Menu;
use Jubarte\Model\DAL\MenuDAL;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;
use Jubarte\Model\VO\Token;


class MenuController
{
    public static function getAll(Request $request, Response $response)
    {
        try
        {
            $parametros = $request->getParsedBody();
            $draw = $parametros['draw'];
            $limit = $parametros['length'];
            $offset = $parametros['start'];
            $search = '%' . $parametros['search'] . '%';

            $query = DBLayer::Connect()->table(Menu::TABLE_NAME)
                ->where(function ($query) use ($request, $search)
            {
                $query->orWhere(Menu::KEY_ID, DBLayer::OPERATOR_ILIKE, $search);
                $query->orWhere(Menu::ICONE, DBLayer::OPERATOR_ILIKE, $search);
                $query->orWhere(Menu::LABEL, DBLayer::OPERATOR_ILIKE, $search);
                $query->orWhere(Menu::ROTA, DBLayer::OPERATOR_ILIKE, $search);
            });

            $totalRecords = $query->count();

            if ($parametros)
            {
                $data = $query->orderBy(Menu::KEY_ID, DBLayer::ORDER_DIRE_ASC)->take($limit)->offset($offset)->get();
            }
            else
            {
                $data = $query->orderBy(Menu::KEY_ID, DBLayer::ORDER_DIRE_ASC)->get();
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
            $formData = Utils::filterArrayByArray($request->getParsedBody(), Menu::TABLE_FIELDS);

            if ($id)
            {
                DBLayer::Connect()->table(Menu::TABLE_NAME)->where(Menu::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)->update($formData);
            }
            else
            {
                DBLayer::Connect()->table(Menu::TABLE_NAME)->insert($formData);
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
            $result = DBLayer::Connect()->table(Menu::TABLE_NAME)
                ->where(Menu::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)
                ->first();

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);
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
                $result = DBLayer::Connect()->table(Menu::TABLE_NAME)->where(Menu::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)->first();

                if ($result)
                {
                    if (DBLayer::Connect()->table(Menu::TABLE_NAME)->delete($id))
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

    public static function getHierarchy(Request $request, Response $response)
    {
        try
        {
            $id = $request->getAttribute('id');
            $idSistema = $id == '' ? null : $id;
            $menuDAL = new MenuDAL();

            if ($id == '')
            {
                return $response->withStatus(StatusCode::SUCCESS)->withJson([]);
            }
            else
            {
                $result = $menuDAL->getHierarchy(null, $idSistema);
                return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
            }

        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }
    //OBTEM O MENU ESTRUTURADO PARA O USUARIO LOGADO para tela principal da jubarte
    public static function getMenusOffUser(Request $request, Response $response)
    {
        try
        {
            $token = new Token($request);
            $idPessoa=$token->getIdPessoa();
            $menuDAL = new MenuDAL();

            /*
             SELECT s., count() as "permissoes"
            FROM usuarios u, sistemas s, permissoes p
                WHERE u."idSistema" = s."id"
                    AND u."idSistema" = p."idSistema"
                    AND u."idPerfil" = p."idPerfil"
                  AND s.ativo = true
                    AND u."idPessoa" = 1  <---- idPessoa do token
                GROUP BY s."id"
             */
            $query = DBLayer::Connect()
                ->table(DBLayer::raw('usuarios u, sistemas s, permissoes p'))
                ->select(DBLayer::raw('s.*, count(*) as "permissoes"'))
                ->from(DBLayer::raw('usuarios u, sistemas s, permissoes p'))
                ->whereRaw('u."idSistema" = s."id"')
                ->whereRaw('u."idSistema" = p."idSistema"')
                ->whereRaw('u."idPerfil" = p."idPerfil"')
                ->whereRaw('s.ativo = true')
                ->whereRaw('u.ativo = true')
                ->whereRaw('u."idPessoa"='.$idPessoa)
                ->groupBy(DBLayer::raw('s."id"'))
                ->orderBy(DBLayer::raw('s."ordem"'));

            $sistemas = $query->get();

            $result = array();

            foreach ($sistemas as $sistema)
            {
                $item = array();
                $item["id"] = null;
                $item["idPai"] = null;
                $item["label"] = $sistema[Sistema::SIGLA];
                $item["icone"] = null;
                $item["cor"] = null;
                $item["ordem"] = null;
                $item["ativo"] = null;
                $item["idSistema"] = $sistema[Sistema::KEY_ID];

                $nodes = $menuDAL->getHierarchyForUser(null,  $item["idSistema"],true,$idPessoa);

                if ($nodes)
                {
                    $item["nodes"] = $nodes;
                }

                array_push($result, $item);

            }

            //$result = $menuDAL->getHierarchyChildren(null, null);

            return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }

}