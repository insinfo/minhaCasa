<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 26/01/2018
 * Time: 13:57
 */

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;

use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Util\Criptografia;

use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

use Jubarte\Model\BSL\ZimbraIMAP;
use Jubarte\Model\BSL\ZimbraRedirect;
use Jubarte\Model\VO\Token;

class ZimbraController
{
    public static function getAll(Request $request, Response $response)
    {
        try
        {
            //$parametros = $request->getParsedBody();
            $token = new Token($request);
            $pws = Criptografia::decrypt($token->getPws(),Criptografia::$key);
            $zimbraIMAP = new ZimbraIMAP();
            $result = $zimbraIMAP->getInbox($token->getLoginName(),$pws);
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }

    public static function redirectURL(Request $request, Response $response)
    {
        try
        {
            //$parametros = $request->getParsedBody();
            $token = new Token($request);
            $result['redirectURL'] = ZimbraRedirect::redirectURL($token->getLoginName());
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }
}