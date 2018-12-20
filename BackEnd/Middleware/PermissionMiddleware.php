<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 15/10/2018
 * Time: 11:31
 */

namespace Jubarte\Middleware;

//use \Slim\Http\Request;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response;

use \Firebase\JWT\ExpiredException;
use Jubarte\Util\JWTWrapper;
use \Exception;

use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

use PmroPadraoLib\Middleware\PermissionMiddleware as PerMiddleware;

class PermissionMiddleware extends PerMiddleware
{
}