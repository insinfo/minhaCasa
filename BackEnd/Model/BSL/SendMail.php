<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 19/02/2018
 * Time: 12:52
 */

namespace Jubarte\Model\BSL;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use \Slim\Http\Request;
use \Slim\Http\Response;
//use \Exception;

use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;

use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

class SendMail extends \PmroPadraoLib\Services\SendMail
{

}