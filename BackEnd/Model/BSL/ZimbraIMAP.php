<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 26/01/2018
 * Time: 13:21
 */

namespace Jubarte\Model\BSL;

class ZimbraIMAP
{
    private $hostname = '{ostra.riodasostras.rj.gov.br:993/imap/ssl/novalidate-cert}INBOX';
    private $username = 'isaque.neves';
    private $emailDomain = 'riodasostras.rj.gov.br';
    private $pass = 'Ins257257';
    private $regexPaternEmail = '/[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+/';
    private $emailSubjectUTF8 = '=?UTF-8?B?';

    public function setUser($username)
    {
        $this->username = $username;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getInbox($username, $pass)
    {
        $this->username = $username;
        $this->pass = $pass;

        $inbox = imap_open($this->hostname, $this->username, $this->pass);
        //imap_last_error()
        $emails = imap_search($inbox, 'ALL');
        $result = array();
        $result['data'] = array();

        if ($emails) {
            $count = 0;
            // put the newest emails on top
            rsort($emails);
            // for every email...

            foreach ($emails as $email_number) {
                // get information specific to this email
                //FT_PEEK - Não defina o sinalizador \ Seen se ainda não estiver definido
                $overview = imap_fetch_overview($inbox, $email_number, 0);
                $message = imap_fetchbody($inbox, $email_number, 2,FT_PEEK );

                $item = array();
                $item['lido'] = $overview[0]->seen ? true : false;

                $assunto = $overview[0]->subject;

                if (strpos($assunto, $this->emailSubjectUTF8) !== false) {
                    $assunto = substr($assunto, strlen($this->emailSubjectUTF8), strlen($assunto) - (strlen($this->emailSubjectUTF8) + 2));
                    $assunto = base64_decode($assunto);
                }

                $item['assunto'] = $assunto;

                preg_match_all($this->regexPaternEmail, $overview[0]->from, $matches);
                $item['de'] = $matches[0][0];//$overview[0]->from;//
                $item['iniciais'] = strtoupper(substr($item['de'], 0, 2));

                $data = $overview[0]->date;
                $hora = "";
                if (($timestamp = strtotime($data)) !== false) {
                    //d/m/Y H:i:s
                    $hora = date("H:i:s", $timestamp);
                    $data = date("d/m/Y", $timestamp);
                }

                $item['hora'] = $hora;
                $item['data'] = $data;//2018-08-27 11:29:27
                $item['timestamp'] = date("Y-m-d H:i:s", strtotime($overview[0]->date));

                array_push($result['data'], $item);

                if ($count > 20) {
                    break;
                }
                $count++;
            }
            imap_close($inbox);
        }

        return $result;
    }
}