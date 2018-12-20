<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 22/05/2018
 * Time: 13:35
 */

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;
use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;
use PmroPadraoLib\Services\NotificationAPI;

class NotificacaoController
{
    public static function getLatest(Request $request, Response $response)
    {
        try {
            $params = $request->getParsedBody();
            $dataCriado = isset($params['dataCriado']) ? $params['dataCriado']: null;
            $idPessoa = isset($params['idPessoa']) ? $params['idPessoa']: null;
            $idOrganograma = isset($params['idOrganograma']) ? $params['idOrganograma']: null;
            $idSistema = isset($params['idSistema']) ? $params['idSistema']: null;

            $notificationAPI = new NotificationAPI();
            $result = $notificationAPI->getLatest($dataCriado,$idPessoa,$idOrganograma,$idSistema);

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }
    //notification
    public static function notify(Request $request, Response $response)
    {
        try
        {
            $data = $request->getParsedBody();
            $notificationAPI = new NotificationAPI();
            $notificationAPI->notify($data);

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);

        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }

    }
    //notifica uma pessoa
    public static function notifyPessoa(Request $request, Response $response)
    {
        try
        {
            $data = $request->getParsedBody();
            $notificationAPI = new NotificationAPI();

            $idPessoa = $data['idPessoa'];
            $mensagem = $data['mensagem'];
            $link = $data['link'];

            $notificationAPI->notifyPessoa($idPessoa,$mensagem,$link);

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);

        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }
    //notifica varias pessoas
    public static function notifyPessoas(Request $request, Response $response)
    {
        try
        {
            $data = $request->getParsedBody();
            $notificationAPI = new NotificationAPI();

            $idsPessoa = $data['idsPessoa'];
            $mensagem = $data['mensagem'];
            $link = $data['link'];

            $notificationAPI->notifyPessoas($idsPessoa,$mensagem,$link);

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);

        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }
    //notifica pessoas de um organograma
    public static function notifyOrganograma(Request $request, Response $response)
    {
        try
        {
            $data = $request->getParsedBody();
            $notificationAPI = new NotificationAPI();

            $idOrganograma = $data['idOrganograma'];
            $mensagem = $data['mensagem'];
            $link = $data['link'];

            $notificationAPI->notifyOrganograma($idOrganograma,$mensagem,$link);

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);

        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }
}