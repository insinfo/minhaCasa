<?php

namespace Jubarte\Controller;

use Jubarte\Model\VO\Token;
use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;
use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Model\VO\Usuario;
use Jubarte\Model\VO\UsuarioOnline;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;
use Jubarte\Model\DAL\UsuarioDAL;
use PmroPadraoLib\Controller\PessoaController;
use Jubarte\Model\VO\Constants;


use PmroPadraoLib\Controller\AutenticacaoController;
use \Adldap\Adldap;
use \Adldap\Connections\Configuration;

use Jubarte\Model\BSL\ActiveDirectoryAPI;


class UsuarioController
{
    //LISTA TODOS OS USUARIOS DA JUBARTE
    public static function getAll(Request $request, Response $response)
    {
        try {
            $params = $request->getParsedBody();
            $draw = isset($params['draw']) ? $params['draw'] : null;
            $limit = isset($params['length']) ? $params['length'] : null;
            $offset = isset($params['start']) ? $params['start'] : null;
            $search = isset($params['search']) ? '%' . $params['search'] . '%' : null;
            $ordering = isset($params['ordering']) ? $params['ordering'] : null;

            /*
             SELECT usuarios.*, org.sigla ||' - '|| org.nome as "nomeOrganograma", p.nome as "nomePessoa"
            FROM "usuarios"
            left JOIN pmro_padrao.func_organograma() as org on  org."idOrganograma" = "usuarios"."idOrganograma"
            JOIN pmro_padrao.pessoas as p on p.id =usuarios."idPessoa"
            */

            $query = DBLayer::Connect()
                ->table(Usuario::TABLE_NAME)
                ->select(DBLayer::raw('usuarios.*, perfis.sigla as "siglaPerfil", sistemas.sigla as "siglaSistema", org.sigla ||\' - \'|| org.nome as "nomeOrganograma", p.nome as "nomePessoa"'))
                ->join("perfis", "perfis.id", "=", Usuario::TABLE_NAME . "." . Usuario::ID_PERFIL)
                ->join("sistemas", "sistemas.id", "=", Usuario::TABLE_NAME . "." . Usuario::ID_SISTEMA)
                ->leftJoin(DBLayer::raw('pmro_padrao.func_organograma() as org'), DBLayer::raw('org."idOrganograma"'), "=", DBLayer::raw('"usuarios"."idOrganograma"'))
                ->join(DBLayer::raw('pmro_padrao.pessoas as p'), DBLayer::raw('p.id'), "=", DBLayer::raw('"usuarios"."idPessoa"'));

            if ($search != null) {
                $query->where(function ($query) use ($request, $search) {
                    $query->orWhere(Usuario::LOGIN, 'ilike', $search);
                    $query->orWhere("perfis.sigla", 'ilike', $search);
                    $query->orWhere("sistemas.sigla", 'ilike', $search);
                    $query->orWhere("p.nome", 'ilike', $search);
                });
            }

            $totalRecords = $query->count();

            //implementação da ordenação do ModernDataTable
            if ($ordering != null && count($ordering) > 0) {
                foreach ($ordering as $item) {
                    $query->orderBy($item['columnKey'], $item['direction']);
                }
            } else {
                $query->orderBy("p.nome", DBLayer::ORDER_DIRE_ASC);
            }

            if ($limit != null && $offset != null) {
                $data = $query->limit($limit)->offset($offset)->get();
            } else {
                $data = $query->get();
            }

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $totalRecords;
            $result['recordsTotal'] = $totalRecords;
            $result['data'] = $data;

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }

    //LISTA TODOS OS LOGINS DO LDAP
    public static function getAllLogin(Request $request, Response $response)
    {
        try {
            $params = $request->getParsedBody();
            $draw = isset($params['draw']) ? $params['draw'] : null;
            $limit = isset($params['length']) ? $params['length'] : null;
            $offset = isset($params['start']) ? $params['start'] : null;
            $search = isset($params['search']) ? $params['search'] : null;
            $ordering = isset($params['ordering']) ? $params['ordering'] : null;

            $orderBy = null;
            $ordeDir = 'asc';

            if (is_array($ordering) && count($ordering) > 0) {
                $order = $ordering[0];
                $orderBy = $order['columnKey'];
                $ordeDir = $order['direction'];

                $orderBy = $orderBy == 'login' ? 'samaccountname' : $orderBy;
                $orderBy = $orderBy == 'nome' ? 'cn' : $orderBy;

            }

            $activeDirectoryAPI = new ActiveDirectoryAPI();
            $result = $activeDirectoryAPI->gelAllUser($limit, $offset, $search, $orderBy, $ordeDir);

            //$result = AutenticacaoController::ListaUsuarios($params, AutenticacaoController::ARRAY_ASSOC_FORMAT);

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()]));
        }

    }

    //SALVA USUARIO JUBARTE
    public static function save(Request $request, Response $response)
    {
        try {
            $formData = $request->getParsedBody();
            $current = $formData['current'];//os dados atual de usuario
            $update = $formData['update'];//os dados novos de usuario

            if ($current != null) {
                DBLayer::Connect()->table(Usuario::TABLE_NAME)
                    ->where(Usuario::ID_PESSOA, '=', $current['idPessoa'])
                    ->where(Usuario::ID_ORGANOGRAMA, '=', $current['idOrganograma'])
                    ->where(Usuario::ID_SISTEMA, '=', $current['idSistema'])
                    ->where(Usuario::ID_PERFIL, '=', $current['idPerfil'])
                    ->update($update);
            } else {
                DBLayer::Connect()->table(Usuario::TABLE_NAME)->insert($update);
            }
        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);
    }

    public static function get(Request $request, Response $response)
    {
        try {
            $id = $request->getAttribute('id');

            $result = DBLayer::Connect()->table(Usuario::TABLE_NAME)
                ->where(Usuario::ID_PESSOA, DBLayer::OPERATOR_EQUAL, $id)
                ->first();

            return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }

    public static function delete(Request $request, Response $response)
    {
        try {
            $formData = $request->getParsedBody();

            foreach ($formData as $item) {
                DBLayer::Connect()->table(Usuario::TABLE_NAME)
                    ->where(Usuario::ID_PESSOA, '=', $item['idPessoa'])
                    ->where(Usuario::ID_ORGANOGRAMA, '=', $item['idOrganograma'])
                    ->where(Usuario::ID_SISTEMA, '=', $item['idSistema'])
                    ->where(Usuario::ID_PERFIL, '=', $item['idPerfil'])
                    ->delete();
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson(['message' => StatusMessage::TODOS_ITENS_DELETADOS]);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }

    public static function getUserLoggedCount(Request $request, Response $response)
    {
        try {
            $result = DBLayer::Connect()->table(UsuarioOnline::TABLE_NAME)
                ->selectRaw('count("idPessoa") as "usuariosOnline"')
                ->whereRaw('"dataAtividade" > (current_timestamp - interval \'10\' minute)')
                ->first();

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);
        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }

    public static function createLDAPUser(Request $request, Response $response)
    {
        try {
            $formData = $request->getParsedBody();
            $usuarioJubarte = $formData['usuarioJubarte'];
            $usuarioLDAP = $formData['usuarioLDAP'];

            $fullName = $usuarioLDAP['fullName'];
            $firstName = $usuarioLDAP['firstName'];
            $lastName = $usuarioLDAP['lastName'];
            $userName = $usuarioLDAP['userName'];
            $cpf = $usuarioLDAP['userCpf'];
            $userEmail = $usuarioLDAP['userEmail'];
            $userPassword = $usuarioLDAP['userPassword'];

            $description = $usuarioLDAP['description'];

            $company = $usuarioLDAP['company'];
            //campos novos
            $sobrenomes = $usuarioLDAP['sobrenomes'];
            $descricao = $usuarioLDAP['descricao'];

            $idPessoa = $usuarioJubarte['idPessoa'];
            $idOrganograma = $usuarioJubarte['idOrganograma'];
            $idSistema = $usuarioJubarte['idSistema'];
            $idPerfil = $usuarioJubarte['idPerfil'];
            $login = $usuarioJubarte['login'];
            $ativo = $usuarioJubarte['ativo'];

            $usuarioDAL = new UsuarioDAL();
            $isJubarteUserExist = $usuarioDAL->checkIfExist($idPessoa, $idOrganograma, $idSistema, $idPerfil);

            if ($isJubarteUserExist) {
                throw new \Exception('Usuário já cadastrado!');
            }

            $activeDirectoryAPI = new ActiveDirectoryAPI();
            $isUserAddToAd = $activeDirectoryAPI->createUser($fullName,$sobrenomes, $firstName, $lastName, $userName, $userPassword, $cpf, $userEmail, $descricao, $company);
            if (!$isUserAddToAd) {
                throw new \Exception('Erro ao cadastrar no LDAP, contate o suporte técnico!');
            }

            if (!$isJubarteUserExist) {
                $usuarioDAL->create($idPessoa, $idOrganograma, $login, $ativo, $idSistema, $idPerfil,$userPassword);
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson(['message' => StatusMessage::SUCCESS, 'userName' => $userName]);


        } catch (Exception $e) {

            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(['message' => $e->getMessage(), 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }

    public static function checkLDAPUserIfExist(Request $request, Response $response)
    {
        try {
            $formData = $request->getParsedBody();
            $activeDirectoryAPI = new ActiveDirectoryAPI();
            $userNames = $formData['userName'];
            $fullName = $formData['fullName'];
            $cpf = $formData['cpf'];

            $resultCpf = $activeDirectoryAPI->searchAdvanced('cpfnumber', $cpf, '=', true, ['cn']);
            if ($resultCpf) {
                throw new \Exception('O login/usuário que você esta tentando cadastrar já está sendo utilizado.');
            }

            $result = $activeDirectoryAPI->search('cn', $fullName);
            if ($result) {
                throw new \Exception('O login/usuário que você esta tentando cadastrar já está sendo utilizado.');
            }

            $userNamesDisponivel = null;
            foreach ($userNames as $key => $value) {
                if (!$activeDirectoryAPI->findUser($value)) {
                    $userNamesDisponivel = $value;
                    break;
                }
            }

            if (!$userNamesDisponivel) {
                throw new \Exception('O login/usuário que você esta tentando cadastrar já está sendo utilizado.');
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson(['result' => $userNamesDisponivel]);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(['message' => $e->getMessage(), 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }

    public static function changeLDAPUserPassword(Request $request, Response $response)
    {
        try {
            $formData = $request->getParsedBody();
            $token = new Token($request);
            $userName = isset($formData['userName']) ? $formData['userName'] : $token->getLoginName();
            $currentPassword = isset($formData['currentPassword']) ? $formData['currentPassword'] : null;
            $newPassword = $formData['newPassword'] ? $formData['newPassword'] : null;

            if ($newPassword == null || $newPassword == '' || strlen($newPassword) < 6) {
                throw new \Exception('O campo senha não pode ser vazio, e não pode ter menos de 6 caracteres!');
            }

            $activeDirectoryAPI = new ActiveDirectoryAPI();

            //aqui troca senha do proprio usuario logado
            if ($currentPassword) {
                $activeDirectoryAPI->changeUserPassword($userName, $currentPassword, $newPassword);
            } //aqui troca senha de * usuario
            else {

                //todo checar perfil de usuario  para autorizar isso
                $activeDirectoryAPI->changeUserPassword($userName, null, $newPassword, true);
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson([
                    'message' => "A senha do $userName foi alterada com sucesso."
                ]);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(['message' => 'Houve um erro ao alterar a sua senha, verifique se a senha atual esta correta, se o erro persistir entre em contato com o suporte.', 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }

    public static function updateLDAPUserByLogin(Request $request, Response $response)
    {
        try {
            $formData = $request->getParsedBody();
            $token = new Token($request);

            $userName = isset($formData['userName']) ? $formData['userName'] : null;
            $cpf = isset($formData['cpf']) ? $formData['cpf'] : null;
            $email = isset($formData['email']) ? $formData['email'] : null;
            $descricao = isset($formData['descricao']) ? $formData['descricao'] : null;

            if ($userName == null || $userName == '') {
                throw new \Exception('O campo userName não pode ser vazio ou nulo!');
            }

            $activeDirectoryAPI = new ActiveDirectoryAPI();
            $activeDirectoryAPI->updateUserByLogin($userName, $cpf, $email, $descricao);

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson([
                    'message' => StatusMessage::SUCCESS
                ]);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }
    }

    public static function createAppUser(Request $request, Response $response)
    {
        try {
            $formData = $request->getParsedBody();
            $pessoaData = $formData['pessoa'];

            $cpf = $pessoaData['cpf'];
            //1º checa se a pessoa ja existe
            $idPessoa = PessoaController::isExistFisica($cpf);

            if($idPessoa == null){
                $idPessoa = PessoaController::save($pessoaData);
            }

            $usuarioDAL = new UsuarioDAL();
            $isUserExist = $usuarioDAL->checkIfExist($idPessoa,
                Constants::ORGANOGRAMA_PMRO_ID,
                Constants::SISTEMA_JUBARTE_APP_ID,1);

            if($isUserExist){
                return $response->withStatus(StatusCode::BAD_REQUEST)
                    ->withJson((
                        [
                            'message' => "Usuario ja existe",
                            'exception' => "Usuario ja existe"
                        ]));

            } else {
                $usuarioData = $formData['usuario'];
                $idOrganograma = Constants::ORGANOGRAMA_PMRO_ID;
                $idSistema = Constants::SISTEMA_JUBARTE_APP_ID;
                $idPerfil = 1;
                $login = $usuarioData['login'];
                $ativo = true;
                $pass = $usuarioData['pass'];

                $usuarioDAL->create($idPessoa,$idOrganograma,$login,$ativo,$idSistema,$idPerfil,$pass);
            }

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => "Não foi possivel realizar o cadastro neste momento",
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);
    }

    /*
    public static function listLDAPuser(Request $request, Response $response)
    {
        try {

            $activeDirectoryAPI = new ActiveDirectoryAPI();
            $userNamesDisponivel = '';

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson(['result' => $userNamesDisponivel]);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(['message' => $e->getMessage(), 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
        }

          $json = array();
            DBLayer::Connect();
            $q = DBLayer::select('SELECT * FROM "view_pessoas"');

            foreach ($q as $row) {
                $nome = $row['nome'];
                $email = $row['emailPrincipal'];
                $cpf= $row['cpf'];
                $result = $activeDirectoryAPI->updateUserEmailCPFByName($nome,$cpf,$email);

                $json[] = (object)[
                    "a" => $nome,
                    "b" => $email,
                    "c" => $cpf,
                    "d" => $result
                ];
            }

        //$result = $activeDirectoryAPI->updateUserEmailCPFByName('Antonio Carlos Santana','123','');

    }
*/
}