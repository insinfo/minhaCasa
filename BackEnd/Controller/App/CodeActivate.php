<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 18/12/18
 * Time: 12:30
 */

namespace Jubarte\Controller\App;

use Jubarte\Controller\Exception\UserNotFound;
use Jubarte\Model\BSL\SendMail;
use Jubarte\Model\DAL\UsuarioDAL;
use Jubarte\Model\VO\ActivateCode;
use Jubarte\Util\DBLayer;
use Slim\Http\Response;

class CodeActivate {

    public function create ($user_login) {

        if (!$user_login) {
            throw new \Exception("Login obrigatório para realizar esse procedimento");
        }

        $user = UsuarioDAL::getInstance()->getByLoginName($user_login);

        if (!$user) {
            throw new UserNotFound("Usuário não encontrado", 409);
        }

        $pessoa = $user->getPessoa();

        global $app;
        $container = $app -> getContainer('view');

        $code = (rand(100000, 999999));


        // insert to code
        DBLayer::table(ActivateCode::TABLE)
            ->insert([
                'code' => $code,
                'expire' => date("Y-m-d H:i:s", time() + 3600),
                'pessoa_id' => $pessoa->getId()
            ]);

        $content = $container['view'] -> render(
            new Response(),
            "emails/app/recuperar-senha.php",
            [
                "nome" => $pessoa->getNome(),
                "app" => $user->getSistema()->getDescricao(),
                "code" => $code
            ]
        );

        $result = (string) $content->getBody();

        $semail = new SendMail();
        if (!$semail->to(utf8_decode("Recuperação de senha"), $result, $user_login)) {
            throw new \Exception("Erro ao enviar e-mail para " . $user_login, 409);
        }

        return [
          "code" => $code
        ];
    }

}