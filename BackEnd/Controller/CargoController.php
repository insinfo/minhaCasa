<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 17/04/2018
 * Time: 18:36
 */

namespace Jubarte\Controller;

use PmroPadraoLib\Model\VO\Servidor;
use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;

use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

use Jubarte\Model\VO\Cargo;

class CargoController
{
    public static function cargoPorPessoa ($pessoaId) {
        DBLayer::Connect();
        $query = DBLayer::table(DBLayer::raw(Cargo::TABLE_NAME . ' carg '))
            -> select([
                'carg.nome'
            ])
            -> leftJoin(
                DBLayer::raw(Servidor::TABLE_NAME . " serv"),
                DBLayer::raw('serv."' . Servidor::ID_CARGO . '"'),
                '=',
                DBLayer::raw('carg."' . Cargo::KEY_ID . '"')
            )->where(
                DBLayer::raw('serv."'. Servidor::ID_PESSOA .'"'),
                '=',
                $pessoaId
            );

        return $query->first();
    }

    public static function getAll(Request $request, Response $response)
    {
        try {

            $params = $request->getParsedBody();
            $draw = isset($params['draw']) ? $params['draw'] : null;
            $limit = isset($params['length']) ? $params['length'] : null;
            $offset = isset($params['start']) ? $params['start'] : null;
            $search =  isset($params['search']) ? '%' . $params['search'] . '%' : null;

            DBLayer::Connect();
            $query = DBLayer::table(Cargo::TABLE_NAME);

            $totalRecords = $query->count();

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