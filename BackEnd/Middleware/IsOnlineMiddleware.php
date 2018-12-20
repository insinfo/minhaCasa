<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 31/07/2018
 * Time: 14:30
 */

namespace Jubarte\Middleware;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response;

use \Firebase\JWT\ExpiredException;
use Jubarte\Util\JWTWrapper;
use \Exception;

use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;
use Jubarte\Model\VO\Token;

use PmroPadraoLib\Middleware\IsOnlineMiddleware as IsOnliMiddleware;

class IsOnlineMiddleware extends IsOnliMiddleware
{
}