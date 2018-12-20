<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 17/04/2018
 * Time: 18:36
 */

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;

use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

use Jubarte\Model\VO\LocalBiometria;

class LocalBiometriaController
{
    public static function getAll(Request $request, Response $response)
    {
        try {

            $params = $request->getParsedBody();
            $draw = isset($params['draw']) ? $params['draw'] : null;
            $limit = isset($params['length']) ? $params['length'] : null;
            $offset = isset($params['start']) ? $params['start'] : null;
            $search =  isset($params['search']) ? '%' . $params['search'] . '%' : null;

            DBLayer::Connect();
            $query = DBLayer::table(LocalBiometria::TABLE_NAME);
            $totalRecords = $query->count();

            $query->orderBy("unidade");

            if($limit && $offset)
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

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }
}