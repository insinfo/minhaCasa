<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 20/03/2018
 * Time: 12:16
 */

namespace Jubarte\Middleware;

use Jubarte\Util\JWTWrapper;
use \Exception;
use Jubarte\Util\Utils;
use Jubarte\Model\VO\Token;
use Jubarte\Model\BSL\JLog;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response;

use PmroPadraoLib\Middleware\LogMiddleware2 as LoMiddleware2;

class LogMiddleware2 extends LoMiddleware2
{

}