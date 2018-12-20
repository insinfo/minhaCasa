<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 26/02/2018
 * Time: 11:19
 */

namespace Jubarte\Controller;


use PmroPadraoLib\Controller\PessoaController;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;
use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Model\VO\Permissao;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

class PessoasController
{
    public static function getAll(Request $request, Response $response)
    {
        try {
            $formData = $request->getParsedBody();
            $result = PessoaController::getAll($formData);
        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }

    public static function save(Request $request, Response $response)
    {
        try {
            $id = $request->getAttribute('id');
            $formData = $request->getParsedBody();
            if ($id) {
                PessoaController::update($formData);
            } else {
                PessoaController::save($formData);
            }

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)
            ->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);

    }

    public static function get(Request $request, Response $response)
    {
        try {
            $formData['id'] = $request->getAttribute('id');
            $formData['tipo'] = $request->getAttribute('tipo');
            $result = PessoaController::get($formData);
        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)
            ->withJson($result);
    }

    public static function delete(Request $request, Response $response)
    {
        try {
            $formData = $request->getParsedBody();
            $ids = $formData['ids'];
            $tipoPessoa = $formData['tipo'];

            // DBLayer::Connect();
            // $pdo = DBLayer::connection()->getPdo();

            PessoaController::deleteByIds($ids, $tipoPessoa);

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson((['message' => StatusMessage::TODOS_ITENS_DELETADOS]));

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }
}