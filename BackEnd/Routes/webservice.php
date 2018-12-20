<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

//use Psr\Http\Message\ServerRequestInterface as Request;
//use Psr\Http\Message\ResponseInterface as Response;

use Jubarte\Controller\SistemaController;
use Jubarte\Controller\SistemaExtensaoController;
use Jubarte\Controller\PerfilController;
use Jubarte\Controller\PermissaoController;
use Jubarte\Controller\MenuController;
use Jubarte\Controller\UsuarioController;
use Jubarte\Controller\BugReportController;
use Jubarte\Controller\ZimbraController;
use Jubarte\Controller\NotificacaoController;
use Jubarte\Controller\PessoasController;
use Jubarte\Controller\OrganogramasController;
use Jubarte\Controller\UtilController;
use Jubarte\Controller\IntranetController;
use Jubarte\Controller\PerfilUsuarioController;

use Jubarte\Controller\AuthController;
use Jubarte\Middleware\AuthMiddleware;
use Jubarte\Middleware\LogMiddleware2;
use Jubarte\Middleware\IsOnlineMiddleware;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;


/* SISTEMA BIOMETRIA */

use Jubarte\Controller\CargoController;
use Jubarte\Controller\ServidorController;
use Jubarte\Controller\FuncaoGratificadaController;
use Jubarte\Controller\VinculoController;
use Jubarte\Controller\JornadaTrabalhoController;
use Jubarte\Controller\LocalBiometriaController;
use Jubarte\Controller\EstatisticaBiometriaController;


use Jubarte\Controller\CartaSenhaController;

use Jubarte\Controller\PortalController;


// ROTAS DE WEBSERVICE REST
$app->group('/api', function () use ($app) {
    //**************** ROTAS SISTEMAS ******************/

    // FAQ
    $app -> group('/faq', function () use ($app) {
        /** Captura todas as exceptions */
        try {
            $app->get('[/]', function (Request $request, Response $response){

                $user = Jubarte\Util\Utils::getUserLogged($request);
                \Jubarte\Controller\SuporteFAQController::$userLogged = $user;
                $result = \Jubarte\Controller\SuporteFAQController::getAll($request->getQueryParams());

                return $response->withStatus(StatusCode::SUCCESS)
                    ->withJson($result);
            });

            /** Cria um novo item no faq */
            $app->post('[/]', function (Request $request, Response $response, $args) {
                $user = Jubarte\Util\Utils::getUserLogged($request);
                \Jubarte\Controller\SuporteFAQController::$userLogged = $user;

                $result =  \Jubarte\Controller\SuporteFAQController::add($request -> getParsedBody());

                return $response->withStatus(StatusCode::SUCCESS)
                    ->withJson($result);
            });

            /** get item */
            $app->get('/{id:[0-9]+}[/]' , function (Request $request, Response $response, $args) {
                $result = \Jubarte\Controller\SuporteFAQController::get($args['id']);

                return $response->withStatus(StatusCode::SUCCESS)
                    ->withJson($result);
            });

            /** delete item */
            $app->delete('/{id:[0-9]+}[/]', function (Request $request, Response $response, $args) {
                $result =  \Jubarte\Controller\SuporteFAQController::delete($args['id']);

                return $response->withStatus(StatusCode::SUCCESS)
                    ->withJson($result);
            });

            /** update item */
            $app->put('/{id:[0-9]+}[/]', function (Request $request, Response $response, $args) {

                $user = Jubarte\Util\Utils::getUserLogged($request);
                \Jubarte\Controller\SuporteFAQController::$userLogged = $user;

                $result =  \Jubarte\Controller\SuporteFAQController::update($request->getParsedBody(), $args['id']);

                return $response->withStatus(StatusCode::SUCCESS)
                    ->withJson($result);
            });

            /** get categories */
            $app->get('/category[/]', function (Request $request, Response $response, $args) {
                $result = \Jubarte\Controller\SuporteFAQController::getCategories($args['id']);

                return $response->withStatus(StatusCode::SUCCESS)
                    ->withJson($result);
            });

            /** add Like */
            $app->post("/{id:[0-9]+}/like[/]", function (Request $request, Response $response, $args) {
                $result = \Jubarte\Controller\SuporteFAQController::addLike($args['id']);

                return $response->withStatus(StatusCode::SUCCESS)
                    ->withJson($result);
            });

            /** add unlike item */
            $app->post("/{id:[0-9]+}/unlike[/]", function (Request $request, Response $response, $args) {
                $result =  \Jubarte\Controller\SuporteFAQController::addUnlike($args['id']);

                return $response->withStatus(StatusCode::SUCCESS)
                    ->withJson($result);
            });

        } catch (\Exception $e) {
            $response = new Response();
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson([
                    'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ]);
        }
    });




    // Fim de rotas FAQ


    //OBTEM UM SISTEMA
    $app->get('/sistemas/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return SistemaController::get($request, $response);
    });
    //CRIA E ATUALIZA SISTEMA
    $app->put('/sistemas/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return SistemaController::save($request, $response);
    });
    //LISTA SISTEMA PARA MODERN DATATABLE
    $app->post('/sistemas', function (Request $request, Response $response, $args) use ($app) {
        return SistemaController::getAll($request, $response);
    });
    //DELETA SISTEMA
    $app->delete('/sistemas', function (Request $request, Response $response, $args) use ($app) {
        return SistemaController::delete($request, $response);
    });

    //LISTA EXTENÇOES DE SISTEMA PARA MODERN DATATABLE
    $app->post('/sistemas/extencoes', function (Request $request, Response $response, $args) use ($app) {
        return SistemaExtensaoController::getAll($request, $response);
    });

    //**************** ROTAS PERFIS ******************/

    //OBTEM UM PERFIL
    $app->get('/perfis/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return PerfilController::get($request, $response);
    });
    //CRIA E ATUALIZA PERFIL
    $app->put('/perfis/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return PerfilController::save($request, $response);
    });
    //LISTA PERFIL PARA MODERN DATATABLE
    $app->post('/perfis', function (Request $request, Response $response, $args) use ($app) {
        return PerfilController::getAll($request, $response);
    });
    //DELETA PERFIL
    $app->delete('/perfis', function (Request $request, Response $response, $args) use ($app) {
        return PerfilController::delete($request, $response);
    });

    //**************** ROTAS MENUS ******************/

    //OBTEM O MENU
    $app->get('/menus/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return MenuController::get($request, $response);
    });
    //CRIA E ATUALIZA MENU
    $app->put('/menus/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return MenuController::save($request, $response);
    });
    //LISTA MENU PARA MODERN DATATABLE
    $app->post('/menus', function (Request $request, Response $response, $args) use ($app) {
        return MenuController::getAll($request, $response);
    });
    //DELETA MENU
    $app->delete('/menus', function (Request $request, Response $response, $args) use ($app) {
        return MenuController::delete($request, $response);
    });
    //OBTEM O MENU ESTRUTURADO PARA TREEVIEW
    $app->get('/menus/hierarquia/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return MenuController::getHierarchy($request, $response);
    });
    //OBTEM O MENU ESTRUTURADO PARA O USUARIO LOGADO para tela principal da jubarte
    $app->get('/menus', function (Request $request, Response $response, $args) use ($app) {
        return MenuController::getMenusOffUser($request, $response);
    });

    //**************** ROTAS PERMISSÕES ******************/

    //SALVA PERMISSÃO
    $app->put('/permissoes', function (Request $request, Response $response, $args) use ($app) {
        return PermissaoController::save($request, $response);
    });
    //LISTA PERMISSÃO
    $app->post('/permissoes', function (Request $request, Response $response, $args) use ($app) {
        return PermissaoController::getAll($request, $response);
    });

    //**************** INICIO ROTAS USUARIOS ******************/

    //OBTEM UM USUARIO
    $app->get('/usuarios/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return UsuarioController::get($request, $response);
    });
    //CRIA E ATUALIZA USUARIO
    $app->put('/usuarios', function (Request $request, Response $response, $args) use ($app) {
        return UsuarioController::save($request, $response);
    });
    //LISTA USUARIO PARA MODERN DATATABLE
    $app->post('/usuarios', function (Request $request, Response $response, $args) use ($app) {
        return UsuarioController::getAll($request, $response);
    });
    //DELETA USUARIO
    $app->delete('/usuarios', function (Request $request, Response $response, $args) use ($app) {
        return UsuarioController::delete($request, $response);
    });
    //LISTA LOGINS LDAP
    $app->post('/usuarios/logins', function (Request $request, Response $response, $args) use ($app) {
        return UsuarioController::getAllLogin($request, $response);
    });
    //CRIA USUARIO NO LDAP
    $app->put('/usuarios/create', function (Request $request, Response $response, $args) use ($app) {
        return UsuarioController::createLDAPUser($request, $response);
    });

    $app->post('/usuarios/exist', function (Request $request, Response $response, $args) use ($app) {
        return UsuarioController::checkLDAPUserIfExist($request, $response);
    });

    //ALTERA SENHA USUARIO NO LDAP
    $app->put('/usuarios/change/password', function (Request $request, Response $response, $args) use ($app) {
        return UsuarioController::changeLDAPUserPassword($request, $response);
    });

    //ALTERA CPF DE USUARIO NO LDAP
    $app->put('/usuarios/change/cpf', function (Request $request, Response $response, $args) use ($app) {
        return UsuarioController::updateLDAPUserByLogin($request, $response);
    });


    //**************** ROTAS BUG REPORT  ******************/

    //CRIA E ATUALIZA BUG REPORT
    $app->put('/bugreport/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return BugReportController::save($request, $response);
    });

    //**************** ROTAS PESSOA ******************/

    //OBTEM UMA PESSOA
    $app->get('/pessoas/[{id}/{tipo}]', function (Request $request, Response $response, $args) use ($app) {
        return PessoasController::get($request, $response);
    });

    //CRIA E ATUALIZA PESSOA
    $app->put('/pessoas/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return PessoasController::save($request, $response);
    });
    //LISTA PESSOA
    $app->post('/pessoas', function (Request $request, Response $response, $args) use ($app) {
        return PessoasController::getAll($request, $response);
    });
    //DELETA PESSOAS {ids,tipoPessoa}
    $app->delete('/pessoas', function (Request $request, Response $response, $args) use ($app) {
        return PessoasController::delete($request, $response);
    });

    //**************** ROTAS ORGANOGRAMA ******************/
    //gravar ou atualizar um NOVO setor no ORGANOGRAMA
    $app->put('/organograma/[{idOrganograma}/{dataInicio}]', function (Request $request, Response $response, $args) use ($app) {
        return OrganogramasController::save($request, $response);
    });

    //gravar historico para setor no ORGANOGRAMA
    $app->put('/organograma/{idOrganograma}', function (Request $request, Response $response, $args) use ($app) {
        return OrganogramasController::save($request, $response);
    });

    //LISTA ORGANOGRAMA hierarquia
    $app->post('/organogramas/hierarquia', function (Request $request, Response $response, $args) use ($app) {
        return OrganogramasController::getHierarquia($request, $response);
    });

    //LISTA ORGANOGRAMA hierarquia
    $app->post('/organogramas/historico', function (Request $request, Response $response, $args) use ($app) {
        return OrganogramasController::getHistoricoOrganograma($request, $response);
    });

    //**************** ROTAS Perfil de Usuario ******************/
    //salva ou atualiza perfilusuario
    $app->put('/perfilusuario', function (Request $request, Response $response, $args) use ($app) {
        return PerfilUsuarioController::save($request, $response);
    });
    //obtem um perfil usuario pelo id de pessoa
    $app->get('/perfilusuario/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return PerfilUsuarioController::get($request, $response);
    });

    //**************** ROTAS E-MAIL ZIMBRA ******************/
    //lista emails
    $app->post('/emails', function (Request $request, Response $response, $args) use ($app) {
        return ZimbraController::getAll($request, $response);
    });
    $app->get('/emails/redirect', function (Request $request, Response $response, $args) use ($app) {
        return ZimbraController::redirectURL($request, $response);
    });

    //**************** ROTAS NOTIFICAÇÂO ******************/
    //obtem as ultimas notificações a partir de uma determinada data
    $app->post('/notifications/latest', function (Request $request, Response $response, $args) use ($app) {   //
        return NotificacaoController::getLatest($request, $response);
    });

    //cria notificação para uma pessoa
    $app->put('/notifications/notify/pessoa', function (Request $request, Response $response, $args) use ($app) {
        return NotificacaoController::notifyPessoa($request, $response);
    });

    //cria notificação para uma pessoas
    $app->put('/notifications/notify/pessoas', function (Request $request, Response $response, $args) use ($app) {
        return NotificacaoController::notifyPessoas($request, $response);
    });

    //cria notificação para um organograma
    $app->put('/notifications/notify/organograma', function (Request $request, Response $response, $args) use ($app) {
        return NotificacaoController::notifyOrganograma($request, $response);
    });

    /** *************** ROTAS CADASTRO SERVIDOR BIOMETRIA ***************** **/
    //CRIA OU ATUALIZA SERVIDOR
    $app->put('/servidores', function (Request $request, Response $response, $args) use ($app) {
        return ServidorController::save($request, $response);
    });
    //rota de importação
    $app->put('/servidores/import', function (Request $request, Response $response, $args) use ($app) {
        return ServidorController::saveImport($request, $response);
    });
    //obtem um servidor por CPF
    $app->get('/servidores/cpf/[{cpf}]', function (Request $request, Response $response, $args) use ($app) {
        return ServidorController::getByCPF($request, $response);
    });
    //obtem um servidor por CPF
    $app->get('/servidores/token', function (Request $request, Response $response, $args) use ($app) {
        return ServidorController::getByToken($request, $response);
    });
    //lista servidores
    $app->post('/servidores', function (Request $request, Response $response, $args) use ($app) {
        return ServidorController::getAll($request, $response);
    });

    //gera um arquivo excel xlsx listando servidores que cadastraram a bimetria
    $app->get('/servidores/biometria/xlsx', function (Request $request, Response $response, $args) use ($app) {
        return ServidorController::genXlsxAllBio($request, $response);
    });

    //gera um arquivo excel xlsx listando todos servidores
    $app->get('/servidores/all/xlsx', function (Request $request, Response $response, $args) use ($app) {
        return ServidorController::genXlsxAll($request, $response);
    });

    //lista cargos
    $app->post('/cargos', function (Request $request, Response $response, $args) use ($app) {
        return CargoController::getAll($request, $response);
    });

    $app->get('/cargo/pessoa/{idPessoa}', function (Request $request,Response $response, $args) use ($app) {
        try {
            $result =  CargoController::cargoPorPessoa($args['idPessoa']);
            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);
        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
            ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    });

    //lista Funcao Gratificada
    $app->post('/funcoes', function (Request $request, Response $response, $args) use ($app) {
        return FuncaoGratificadaController::getAll($request, $response);
    });
    //lista Vinculos
    $app->post('/vinculos', function (Request $request, Response $response, $args) use ($app) {
        return VinculoController::getAll($request, $response);
    });
    //lista Jornada de Trabalho
    $app->post('/jornadas', function (Request $request, Response $response, $args) use ($app) {
        return JornadaTrabalhoController::getAll($request, $response);
    });
    //lista Locais da Biometria
    $app->post('/locais', function (Request $request, Response $response, $args) use ($app) {
        return LocalBiometriaController::getAll($request, $response);
    });
    /** *************** FIM ROTAS CADASTRO SERVIDOR BIOMETRIA ***************** **/



})->add(new AuthMiddleware())->add(new LogMiddleware2())->add(new IsOnlineMiddleware());

//rotas publicas e livres
$app->group('/api', function () use ($app) {
    //**************** PAGINA INICIAL DA JUBARTE ******************/
    $app->get('/estatisticas/intranet/usuarios', function (Request $request, Response $response, $args) use ($app) {
        return IntranetController::getSistemasAtivos($request, $response);
    });
    $app->get('/estatisticas/intranet/solicitacoes', function (Request $request, Response $response, $args) use ($app) {
        return IntranetController::getEstatisticaSolicitacoes($request, $response);
    });
    //lista de aniversariantes
    $app->get('/intranet/aniversariantes', function (Request $request, Response $response, $args) use ($app) {
        return IntranetController::getAniversariantes($request, $response);
    });
    //TOTAl DE USUARIOS LOGADOS
    $app->get('/usuarios/count/logged', function (Request $request, Response $response, $args) use ($app) {
        return UsuarioController::getUserLoggedCount($request, $response);
    });
    //lista de servidores COM e SEM Biometria
    $app->post('/estatisticas/biometria', function (Request $request, Response $response, $args) use ($app) {
        return EstatisticaBiometriaController::getServidoresBiometria($request, $response);
    });
    //lista de servidores COM e SEM Biometria
    $app->get('/estatisticas/biometria/cadastros', function (Request $request, Response $response, $args) use ($app) {
        return EstatisticaBiometriaController::getEstatisticaBiometria($request, $response);
    });
     //**************** ROTAS UTILITARIOS ******************/
    //OBTEM O IP DO USUARIO VISIVEL NO SERVIDOR
    $app->get('/utils/ip', function (Request $request, Response $response, $args) use ($app) {
        return UtilController::getUserIP($request, $response);
    });
    //OBTEM O ENDEREÇO POR CEP
    $app->get('/correios/endereco/[{cep}]', function (Request $request, Response $response, $args) use ($app) {
        return UtilController::getEnderecoByCep($request, $response);
    });
    //OBTEM UMA LISTA DE CEP COM BASE NO ENDEREÇO
    $app->post('/correios/cep', function (Request $request, Response $response, $args) use ($app) {
        return UtilController::getCepByEndereco($request, $response);
    });
    $app->get('/datetime/timestamp', function (Request $request, Response $response, $args) {
        return UtilController::timestamp($request, $response, $args);
    });
    $app->get('/numeroLei/{numeroLei}', function (Request $request, Response $response) {
        return OrganogramasController::getNumeroLei($request, $response);
    });
    /**************** ROTAS PAGINA CARTA SENHA ******************/
    $app->get('/cartasenha/pessoas/{cpf}', function (Request $request, Response $response) {
        return CartaSenhaController::getPessoaByCPF($request, $response);
    });
    //CRIA E ATUALIZA PESSOA
    $app->put('/cartasenha/pessoas/[{id}]', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::savePessoa($request, $response);
    });

    //LISTA organograma Orgão
    $app->get('/cartasenha/organogramas/orgao', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::getAllOrganogramaOrgao($request, $response);
    });

    //LISTA organograma UNIDADE
    $app->get('/cartasenha/organogramas/unidade/[{idOrgao}]', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::getAllOrganogramaUnidade($request, $response);
    });

    //LISTA organograma Departamento
    $app->get('/cartasenha/organogramas/departamento/[{idUnidade}]', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::getAllOrganogramaDepartamento($request, $response);
    });

    //LISTA SALI Orgão
    $app->get('/cartasenha/sali/orgao', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::getAllSaliOrgao($request, $response);
    });

    //LISTA SALI UNIDADE
    $app->get('/cartasenha/sali/unidade/[{idOrgao}]', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::getAllSaliUnidade($request, $response);
    });

    //LISTA SALI Departamento
    $app->get('/cartasenha/sali/departamento/[{idOrgao},{idUnidade}]', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::getAllSaliDepartamento($request, $response);
    });

    //LISTA SALI Setor
    $app->get('/cartasenha/sali/setor/[{idOrgao},{idUnidade},{idDepartamento}]', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::getAllSaliSetor($request, $response);
    });

    //lista todas as Organizational units do LDAP
    $app->get('/cartasenha/ldap/hierarquia/ou', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::getAllHierarchyOU($request, $response);
    });

    //lista todas as Organizational units do LDAP
    $app->get('/cartasenha/organogramas/hierarquia', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::getAllHierarchyOrganograma($request, $response);
    });

    //cria carta senha
    $app->put('/cartasenha', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::createCartaSenha($request, $response);
    });

    //lista carta senha
    $app->post('/cartasenha', function (Request $request, Response $response, $args) use ($app) {
        return CartaSenhaController::getAllCartaSenha($request, $response);
    });

    //rota de teste portal 2018
    $app->get('/portal/create/post', function (Request $request, Response $response, $args) use ($app) {
        return PortalController::createPost($request, $response);
    });

});

//ROTA DE AUTENTICAÇÃO
$app->post('/api/auth/login', function (Request $request, Response $response, $args) use ($app) {
    return AuthController::authenticate($request, $response);
});
//ROTA DE CHECK AUTENTICAÇÃO
$app->post('/api/auth/check', function (Request $request, Response $response, $args) use ($app) {
    return AuthController::checkToken($request, $response);
});
