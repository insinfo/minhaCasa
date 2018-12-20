<?php

namespace Jubarte\Middleware;//Middleware;

//use \Slim\Http\Request;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response;

use \Firebase\JWT\ExpiredException;
use Jubarte\Util\JWTWrapper;
use \Exception;

use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

use PmroPadraoLib\Middleware\AuthMiddleware as AutMiddleware;

class AuthMiddleware extends AutMiddleware
{

}
