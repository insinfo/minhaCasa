<?php

if (array_key_exists("HTTP_ORIGIN",$_SERVER)) {
    header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
}

header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400');

use \Slim\Http\Request;
use \Slim\Http\Response;
use Jubarte\Controller\AuthController;
use Jubarte\Controller\App\CodeActivate;
use Jubarte\Controller\App\UsuarioController;
use Jubarte\Util\StatusMessage;
use Jubarte\Util\StatusCode;
use \PmroPadraoLib\Controller\Exceptions\ValidationException;
use \PmroPadraoLib\Controller\Exceptions\UsuarioExisteException;

$app->get('/app/user/confirme', function (Request $request, Response $response, $args) use ($app) {

    $result = \Jubarte\Controller\App\UsuarioController::activate($request->getQueryParam('d'));

    $string_result = $app->getContainer()['view']->render(
        $response,
        '/app/user-activation.php',
        $result
    );

    return $string_result;

});

/** grupo de rotas liberadas */

$app -> group('/api/app', function () use ($app) {

    $app->post('/user', function (Request $request, Response $response, $args) use ($app) {
        try {
            $result = \Jubarte\Controller\App\UsuarioController ::criar($request -> getParsedBody());

            return $response -> withJson(( new \PmroPadraoLib\Util\ResponseDefault($result) ) -> toArray());
        } catch (UsuarioExisteException $e) {
            return $response->withStatus(409)
                ->withJson(
                    [
                        'type' => end(explode("\\", get_class($e))),
                        'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                        'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()
                    ]
                );

        } catch (ValidationException $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(
                    [
                        'type' => end(explode("\\", get_class($e))),
                        'field' => $e->getField(),
                        'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                        'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()
                    ]
                );

        } catch (\Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(
                    (
                    [
                        'type' => end(explode("\\", get_class($e))),
                        'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                        'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()
                    ]
                    )
                );
        }

        // return UsuarioController::createAppUser($request, $response);
    });
    $app->post('/auth/login', function (Request $request, Response $response, $args) use ($app) {
        return AuthController::authenticateApp($request, $response);
    });

    $app->post('/user/password', function (Request $request, Response $response, $args) use ($app) {
        try {

            $result =  UsuarioController::passwordUpdate(
                $request->getParsedBody()['password'],
                $request->getParsedBody()['email'],
                $request->getParsedBody()['code']
            );

            return $response -> withJson($result);

        } catch (Exception $e) {
            return $response->withStatus($e->getCode())
                ->withJson([
                    'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()
                ]);
        }
    });



    $app -> group('/code', function () use ($app) {

        $app->post('/generate', function (Request $request, Response $response) use ($app) {
            try {
                $result = CodeActivate::create(
                    $request->getParam('email')
                );
                return $response -> withJson($result);
            } catch (Exception $e) {
                return $response->withStatus(StatusCode::BAD_REQUEST)
                    ->withJson([
                        'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                        'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()
                    ]);
            }
        });
    });
});
