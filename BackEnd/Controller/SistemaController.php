<?php

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;
use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Model\VO\Sistema;
use Jubarte\Model\VO\SistemaExtensao;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

class SistemaController
{
    public static function getAll(Request $request, Response $response)
    {
        try {

            $params = $request->getParsedBody();
            $draw = isset($params['draw']) ? $params['length'] : null;
            $limit = isset($params['length']) ? $params['length'] : null;
            $offset = isset($params['start']) ? $params['start'] : null;
            $search = isset($params['search']) ? '%' . $params['search'] . '%' : null;

            $query = DBLayer::Connect()->table(Sistema::TABLE_NAME);

            if ($search != null){
                $query->where(function ($query) use ($request, $search) {
                    $query->orWhere(Sistema::KEY_ID, DBLayer::OPERATOR_ILIKE, $search);
                    $query->orWhere(Sistema::SIGLA, DBLayer::OPERATOR_ILIKE, $search);
                    $query->orWhere(Sistema::DESCRICAO, DBLayer::OPERATOR_ILIKE, $search);
                });
            }

            $totalRecords = $query->count();

            $query->orderBy(Sistema::ORDEM, DBLayer::ORDER_DIRE_ASC);

            if ($limit != null && $offset != null) {
                $data = $query->limit($limit)->offset($offset)->get();
            } else {
                $data = $query->get();
            }

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $totalRecords;
            $result['recordsTotal'] = $totalRecords;

            DBLayer::getRelationAll($data,SistemaExtensao::TABLE_NAME, SistemaExtensao::ID_SISTEMA,Sistema::KEY_ID,'extencoes');

            $result['data'] = $data;

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }

    public static function save(Request $request, Response $response)
    {
        try {

            $id = $request->getAttribute('id');
            $data = $request->getParsedBody();
            $sistema = Utils::filterArrayByArray($data, Sistema::TABLE_FIELDS);
            $extencoes = isset($data['extencoes']) ? $data['extencoes'] : null;

            DBLayer::connect();
            DBLayer::transaction(function () use ($sistema, $extencoes, $id) {

                if ($id) {

                    DBLayer::table(Sistema::TABLE_NAME)
                        ->where(Sistema::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)
                        ->update($sistema);

                    //update extenções
                    if ($extencoes != null) {

                        DBLayer::table(SistemaExtensao::TABLE_NAME)
                            ->where(SistemaExtensao::ID_SISTEMA, '=', $id)->delete();

                        foreach ($extencoes as &$extencao) {

                            $extencao['idSistema'] = $id;
                            DBLayer::table(SistemaExtensao::TABLE_NAME)
                                ->insert($extencao);

                        }
                    }

                } else {
                    //save sistema
                    $idSistema = DBLayer::table(Sistema::TABLE_NAME)
                        ->insertGetId($sistema);

                    //save extenções
                    if ($extencoes != null) {

                        foreach ($extencoes as &$extencao) {

                            $extencao['idSistema'] = $idSistema;
                            DBLayer::table(SistemaExtensao::TABLE_NAME)
                                ->insert($extencao);

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

    public static function get(Request $request, Response $response)
    {
        try {
            $id = $request->getAttribute('id');

            $item = DBLayer::Connect()->table(Sistema::TABLE_NAME)
                ->where(Sistema::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)
                ->first();

            $data[0]=$item;

            DBLayer::getRelationAll($data,SistemaExtensao::TABLE_NAME, SistemaExtensao::ID_SISTEMA,Sistema::KEY_ID,'extencoes');

            return $response->withStatus(StatusCode::SUCCESS)->withJson($data[0]);

        } catch (Exception $e) {

            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
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

                $result = DBLayer::Connect()->table(Sistema::TABLE_NAME)
                    ->where(Sistema::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)->first();

                if ($result) {
                    DBLayer::Connect();
                    DBLayer::transaction(function () use (&$itensDeletadosCount, $id) {
                        //deleta sistema
                        if (DBLayer::table(Sistema::TABLE_NAME)->delete($id)) {
                            $itensDeletadosCount++;
                            //deleta extensao de Sistema
                            DBLayer::table(SistemaExtensao::TABLE_NAME)
                                ->where(SistemaExtensao::ID_SISTEMA, '=', $id)->delete();
                        }

                    });
                }
            }
            if ($itensDeletadosCount == $idsCount) {
                return $response->withStatus(StatusCode::SUCCESS)
                    ->withJson(['message' => StatusMessage::TODOS_ITENS_DELETADOS]);
            } else if ($itensDeletadosCount > 0) {
                return $response->withStatus(StatusCode::SUCCESS)
                    ->withJson(['message' => StatusMessage::NEM_TODOS_ITENS_DELETADOS]);
            } else {
                return $response->withStatus(StatusCode::SUCCESS)
                    ->withJson((['message' => StatusMessage::NENHUM_ITEM_DELETADO]));
            }
        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }
}