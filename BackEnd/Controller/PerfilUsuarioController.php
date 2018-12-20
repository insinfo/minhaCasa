<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 11/07/2018
 * Time: 14:33
 */

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;
use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

use Jubarte\Model\VO\PerfilUsuario;
use Jubarte\Model\VO\Token;

class PerfilUsuarioController
{
    public static function save(Request $request, Response $response)
    {
        try {
            //$id = $request->getAttribute('id');
            $formData = $request->getParsedBody();
            $perfilUsuario = $formData;

            $idPessoa = $formData['idPessoa'];
            $exist = false;

            DBLayer::Connect();
            if ($idPessoa != null) {
                $result = DBLayer::table(PerfilUsuario::TABLE_NAME)
                    ->where(PerfilUsuario::ID_PESSOA, '=', $idPessoa)
                    ->first();
                if ($result) {
                    $exist = true;
                }
            }

            if ($exist) {
                DBLayer::table(PerfilUsuario::TABLE_NAME)
                    ->where(PerfilUsuario::ID_PESSOA, '=', $idPessoa)
                    ->update($perfilUsuario);

            } else {
                DBLayer::table(PerfilUsuario::TABLE_NAME)
                    ->insert($perfilUsuario);
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }

    public static function get(Request $request, Response $response)
    {
        try {
            $idPessoa = $request->getAttribute('id');

            $result = DBLayer::Connect()->table(PerfilUsuario::TABLE_NAME)
                ->where(PerfilUsuario::ID_PESSOA, '=', $idPessoa)
                ->first();

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }
}