<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 07/12/2017
 * Time: 11:27
 */

namespace Jubarte\Controller;

use \Firebase\JWT\ExpiredException;
use \Exception;
use \Slim\Http\Request;
use \Slim\Http\Response;

use Jubarte\Util\DBLayer;
use Jubarte\Util\LdapAuth;
use Jubarte\Util\JWTWrapper;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;
use Jubarte\Model\DAL\UsuarioDAL;
use Jubarte\Model\DAL\PessoaDAL;
use Jubarte\Util\Criptografia;
use Jubarte\Model\BSL\JLog;

use \PmroPadraoLib\Controller\AuthController as AController;

class AuthController extends AController
{
}