<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 27/02/2018
 * Time: 18:18
 */

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;
use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Model\VO\SistemaExtensao;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

class SistemaExtensaoController
{
    public static function getAll(Request $request, Response $response)
    {
        try {

            $params = $request->getParsedBody();
            $draw = isset($params['draw']) ? $params['length'] : null;
            $limit = isset($params['length']) ? $params['length'] : null;
            $offset = isset($params['start']) ? $params['start'] : null;
            $search = isset($params['search']) ? '%' . $params['search'] . '%' : null;

            $idSistema = isset($params['idSistema']) ? $params['idSistema'] : null;
            $destinos = isset($params['destinos']) ? $params['destinos'] : null;

            $query = DBLayer::Connect()->table(SistemaExtensao::TABLE_NAME);

            if ($search != null){
                $query->where(function ($query) use ($request, $search) {
                    $query->orWhere(SistemaExtensao::ROTA_DELETE, DBLayer::OPERATOR_ILIKE, $search);
                    $query->orWhere(SistemaExtensao::ROTA_GRAVACAO, DBLayer::OPERATOR_ILIKE, $search);
                    $query->orWhere(SistemaExtensao::ROTA_LEITURA, DBLayer::OPERATOR_ILIKE, $search);
                });
            }

            if($idSistema != null){
                $query->where(SistemaExtensao::ID_SISTEMA,'=',$idSistema);
            }

            if($destinos != null){
                foreach ($destinos as $intem)
                {
                    $query->where(SistemaExtensao::NOME, '=', $intem);
                }
            }

            $totalRecords = $query->count();

            $query->orderBy(SistemaExtensao::KEY_ID, DBLayer::ORDER_DIRE_ASC);

            if ($limit != null && $offset != null) {
                $data = $query->limit($limit)->offset($offset)->get();
            } else {
                $data = $query->get();
            }

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $totalRecords;
            $result['recordsTotal'] = $totalRecords;
            $result['data'] = $data;

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }

    public static function get(Request $request, Response $response)
    {
        try {
            $id = $request->getAttribute('id');

            $item = DBLayer::Connect()->table(SistemaExtensao::TABLE_NAME)
                ->where(SistemaExtensao::KEY_ID, DBLayer::OPERATOR_EQUAL, $id)
                ->first();
            return $response->withStatus(StatusCode::SUCCESS)->withJson($item);

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
            DBLayer::Connect();
            foreach ($ids as $id) {
                $servicos =  DBLayer::table(SistemaExtensao::TABLE_NAME)
                    ->where(SistemaExtensao::KEY_ID, '=', $id)->first();

                if ($servicos) {
                    if ( DBLayer::table(SistemaExtensao::TABLE_NAME)->delete($id)) {
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