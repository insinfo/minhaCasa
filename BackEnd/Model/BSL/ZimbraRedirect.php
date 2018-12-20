<?php
/**
 * Created by PhpStorm.
 * User: Isaque
 * Date: 20/01/2018
 * Time: 19:30
 */

namespace Jubarte\Model\BSL;
//business service layer
class ZimbraRedirect
{
    /*
    gerar a Preauth Key no zimbra
    sudo -u zimbra -i
    zmprov generateDomainPreAuthKey -f riodasostras.rj.gov.br
    preAuthKey: 4a7e1c658b36c896c515cfecb5119cbc2c839aa3d0e5e6beba83b32b4fbbca3f
    previous preAuthKey: ea466a520cb73e74ee2a14836f805e87d4551efbd8d08ab4e14fda77623e9788
    */

    public static $PREAUTH_KEY = '4a7e1c658b36c896c515cfecb5119cbc2c839aa3d0e5e6beba83b32b4fbbca3f';
    public static $params = Array();
    public static $domain = 'riodasostras.rj.gov.br';

    public static function redirectURL($userName)
    {
        self::$domain = 'riodasostras.rj.gov.br';
        // DEFINE O FUSO HORARIO COMO O HORARIO DE SÃO PAULO
        date_default_timezone_set('America/Sao_Paulo');

        /*$d1 = new \Datetime("now");
        $timestamp = $d1->format('U');*/

        $timestamp = time() + 60*60;//+ 60*60 esse é um fix para o zimbra no horario de verão
        $timestamp = $timestamp * 1000;

        self::$params['account'] = $userName;
        self::$params['by'] = 'name'; // needs to be part of hmac
        self::$params['timestamp'] = $timestamp;
        self::$params['expires'] = '0';

        $WEB_MAIL_PREAUTH_URL = "http://ostra.riodasostras.rj.gov.br/service/preauth";

        /**
         * User's email address and domain. In this example obtained from a GET query parameter.
         * i.e. preauthExample.php?email=user@domain.com&domain=domain.com
         * You could also parse the email instead of passing domain as a separate parameter
         */
        $user = self::$params['account'];
        $domain = self::$domain;

        $email = "{$user}@{$domain}";

        if (empty(self::$PREAUTH_KEY))
        {
            die("Need preauth key for domain " . $domain);
        }

        /**
         * Create preauth token and preauth URL
         */

        $preauthToken = hash_hmac('sha1', $email . '|' . self::$params["by"] . '|' . self::$params['expires'] . '|' . self::$params['timestamp'], self::$PREAUTH_KEY);
        $preauthURL = $WEB_MAIL_PREAUTH_URL . '?account=' . $email . '&by=' . self::$params['by'] . '&timestamp=' . self::$params['timestamp'] . '&expires=' . self::$params['expires'] . '&preauth=' . $preauthToken;

        /**
         * Redirect to Zimbra preauth URL
         */
        //header("Location: $preauthURL");
        //echo $preauthURL;
        return $preauthURL;
    }

}