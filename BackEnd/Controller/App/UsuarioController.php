<?php

namespace Jubarte\Controller\App;

use Faker\Provider\DateTime;
use Jubarte\Model\VO\ActivateCode;
use Jubarte\Model\VO\PessoaFisica;
use Jubarte\Util\DBLayer;
use Mockery\Exception;
use function PHPSTORM_META\type;
use PmroPadraoLib\Controller\Exceptions\PessoaExisteException;
use Jubarte\Model\DAL\PessoaDAL;
use Jubarte\Model\DAL\UsuarioDAL;
use Jubarte\Model\BSL\ValidationAPI;
use Jubarte\Model\VO\Constants;

use PmroPadraoLib\Controller\Exceptions\UsuarioExisteException;
use PmroPadraoLib\Controller\Exceptions\ValidationException;
use PmroPadraoLib\Controller\PessoaController;
use PmroPadraoLib\Model\VO\Usuario;
use PmroPadraoLib\Services\SendMail;
use PmroPadraoLib\Util\Criptografia;
use Slim\Http\Response;

class UsuarioController {

    public static function criar ($data) {

        // dados de cadastro
        $cpf = $data['pessoa']['cpf'];
        $sexo = $data['pessoa']['sexo'];
        $nascimento = $data['pessoa']['dataNascimento'];
        $email = $data['pessoa']['email'];
        $nome = $data['pessoa']['nome'];
        $senha = $data['usuario']['senha'];
        $resenha = $data['usuario']['resenha'];
        $termos = $data['termos'];
        $data['pessoa']['tipo'] = "fisica";


        if (!$termos) {
            throw new ValidationException("Para continuar é necessário aceitar os termos de uso.",
                'termos');
        }

        if (strlen($senha) < 5) {
            throw new ValidationException("Sua senha deve ter no mínimo 5 caracteres.");
        }

        if ($senha !== $resenha) {
            throw new ValidationException( "Senhas não conferem! ",
                "senha");
        }

        if (!ValidationAPI::validaCPF($cpf)) {
            throw new ValidationException("CPF Inválido",
                'cpf');
        }

        if (!ValidationAPI::validaNome($nome)) {
            throw new ValidationException("Nome inválido",
                'nome');
        }

        if (!ValidationAPI::validaEmail($email)) {
            throw new ValidationException("E-mail inválido",
                'email');
        }

        if (!ValidationAPI::validateDate($nascimento)) {
            throw new ValidationException("Data de nascimento inválida",
                'nascimento');
        }

        $email_confirmacao = "";
        $pessoa = null;
        $idPessoa = 0;

        try {
            $idPessoa = PessoaController::save(array_merge($data['pessoa'], [
                'emailPrincipal' => $email
            ]));
        } catch (PessoaExisteException $e) {
            // pessoa já existe

            $pessoa = DBLayer::Connect()->table(PessoaFisica::TABLE_NAME)
                ->select('idPessoa')
                ->where('cpf', '=', $cpf)->first();

            $idPessoa = $pessoa['idPessoa'];

            $usuarioDAL = new UsuarioDAL();

            $result = $usuarioDAL->checkIfExist($idPessoa,
                Constants::ORGANOGRAMA_PMRO_ID,
                Constants::SISTEMA_JUBARTE_APP_ID,
                Constants::PERFIL_USUARIO_ID);

            if ($result === true) {
                throw new UsuarioExisteException("Usuário já existe, caso tenha esquecido sua senha, tente a opção trocar senha.");
            } else {
                $pessoa = (new PessoaDAL()) ->getById($idPessoa);
                $email_confirmacao = $pessoa->getEmailPrincipal();
            }

        } catch (\Exception $e ) {
            throw $e;
        }

        if ($idPessoa) {
            // cadastro do usuario

            $ativo = 1;

            if ($email_confirmacao !== "") {
                $ativo = 0;
            }

            // cria novo usuário

            $usuarioDAL = new UsuarioDAL();

            $result = $usuarioDAL->create($idPessoa,
                Constants::ORGANOGRAMA_PMRO_ID,
                $email,
                $ativo,
                Constants::SISTEMA_JUBARTE_APP_ID,
                Constants::PERFIL_USUARIO_ID,
                $senha
            );

            if ($result) {
                $usuario = \PmroPadraoLib\Model\DAL\UsuarioDAL::getInstance()->getByLoginName($email);

                if (!$ativo) {
                    // envia e-mail informando a necessidade de confirmar a criação da conta


                    global $app;
                    $container = $app -> getContainer('view');

                    $url = sprintf('https://jubarte.riodasostras.rj.gov.br/app/user/confirme?d=%s',
                        urlencode(
                            Criptografia::encrypt(
                                \json_encode([
                                'login' => $usuario->getLogin(),
                                'sistema_id' => Constants::SISTEMA_JUBARTE_APP_ID,
                                'pessoa_id' => $idPessoa,
                                'link_validade' => time() + 3 * 3600 * 24
                                ]),
                                Criptografia::$key
                            )
                        )
                    );

                    $data_to_view = array_merge( (array) $pessoa->toArray(), ['url' => $url]);

                    $content = $container['view'] -> render(
                        new Response(),
                        "emails/app/confirma-email.php",
                        $data_to_view
                    );

                    $result = (string) $content->getBody();

                    $semail = new SendMail();
                    $semail->to(utf8_decode("Confirmar criação do usuário"), $result, $email_confirmacao);

                }

                $email_str = "";

                if ($email_confirmacao) {
                    $email_arr = explode('@', $email_confirmacao);
                    $email_str = substr($email_arr[0], 0, 3) . '......@' . $email_arr[1];
                }

                return [
                    'usuario' => $usuario->toArray(),
                    'necessarioAtivacao' => !$ativo,
                    'emailAtivacao' => $email_str
                ];

            } else {
                throw new \Exception("Erro ao tentar criar usuário");
            }
        }

    }

    public static function passwordUpdate ($pass, $email, $code) {

        $timeZone = '"America/Sao_Paulo"';
        date_default_timezone_set($timeZone);

        if (!$email) {
            throw new \Exception("E-mail obrigatório para realizar esse procedimento", 400);
        }
        $user = UsuarioDAL::getInstance()->getByLoginName($email);

        if (!$user) {
            throw new UserNotFound("Usuário não encontrado", 404);
        }

        $pessoa = $user->getPessoa();

        $data = DBLayer::table(ActivateCode::TABLE)
            ->where("pessoa_id", '=', $pessoa->getId())
            ->where('code', '=', $code)
            ->first();

        if (!isset($data['code'])) {
            throw new \Exception('Não existe um código ativo para este usuário', 406);
        }

        if ( $data['code'] === $code) {

            $data = explode(" ", $data['expire']);
            $time = explode(":", $data[1]);
            $data = explode("-", $data[0]);

            $expire = mktime(
                $time[0],
                $time[1],
                $time[2],
                $data[1],
                $data[2],
                $data[0]
            );

            $time_now = time();

            if ($expire < $time_now) {
                DBLayer::table(ActivateCode::TABLE)
                    ->where(ActivateCode::FIELD_CODE, '=', $code)
                    ->delete();

                throw new \Exception("Código expirado", 422);
            }


            DBLayer::transaction(function () use ($email, $pass, $code) {

                DBLayer::table(Usuario::TABLE_NAME)
                    ->where(Usuario::LOGIN, '=', $email)
                    ->update([
                        Usuario::PASS => UsuarioDAL::criptPass($pass)
                    ]);

                DBLayer::table(ActivateCode::TABLE)
                    ->where(ActivateCode::FIELD_CODE, '=', $code)
                    ->delete();
            });
        }

        global $app;
        $container = $app -> getContainer('view');

        $content = $container['view'] -> render(
            new Response(),
            "emails/app/senha-alterada.php",
            [
                "nome" => $pessoa->getNome(),
                "app" => $user->getSistema()->getDescricao(),
                "code" => $code
            ]
        );

        $result = (string) $content->getBody();

        $semail = new SendMail();
        $semail->to(utf8_decode("Senha alterada"), $result, $email);

        return [
            'status' => 'success'
        ];
    }

    public static function activate ($data) {

        $data = urldecode($data);
        $user = \json_decode(Criptografia::decrypt($data, Criptografia::$key));

        $userModel = \PmroPadraoLib\Model\DAL\UsuarioDAL::getInstance()->getByLoginName($user->login);

        $pessoa = (new PessoaDAL() ) ->getById($userModel->getIdPessoa());

        $response = [
            'status' => 'success',
            'message' => 'Usuário ativado com sucesso!',
            'pessoa' => $pessoa -> toArray(),
            'usuario' => $userModel -> toArray()
        ];

        if ($userModel->getAtivo()) {
            $response['status'] = 'fail';
            $response['message'] = 'Link inválido';
            return $response;
        }

        if (time() > $user->link_validade) {
            $response['status'] = 'fail';
            $response['message'] = 'Este link de ativação não é mais válido';

            return $response;
        }

        $result = DBLayer::Connect()->table(Usuario::TABLE_NAME)
            ->where('ativo','=', false)
            ->where('login','=', $user->login)
            ->update(['ativo' => true]);

        if (!$result) {
            $response['status'] = 'fail';
            $response['message'] = 'Houve um problema na ativação do seu usuário';
            return $response;
        }

        return $response;
    }

}