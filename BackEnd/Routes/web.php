<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Jubarte\Middleware\PermissionMiddleware;
use Jubarte\Model\VO\Constants;

$app->get('/', function (Request $request, Response $response, $args) use ($app) {
    return $this->view->render($response, 'MainView.php');
});
$app->get('/mainView', function (Request $request, Response $response, $args) use ($app) {
    return $this->view->render($response, 'MainView.php');
});
$app->get('/intranet', function (Request $request, Response $response, $args) use ($app) {
    return $this->view->render($response, 'intranet2.php');
});
$app->get('/minhaCasaMinhaVida', function (Request $request, Response $response, $args) use ($app) {
    return $this->view->render($response, 'mcmvCadastro.php');
});

// ROTAS DE WEBPAGES PROTEGIDAS DO CIENTE
$app->group('/pages', function () use ($app) {
    //rota cadastrada para ser acessada pelo ciente
    $app->get('/gerenciaPessoaMin', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'GerenciaPessoaMinView.php');
    });
})->add(new PermissionMiddleware($container, Constants::SISTEMA_CIENTE_ID));

// ROTAS DE WEBPAGES PROTEGIDAS DA JUBARTE
$app->group('/pages', function () use ($app) {

    // Controle de Acesso
    $app->get('/sistemas', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'GerenciarSistemasView.php');
    });
    $app->get('/perfis', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'GerenciarPerfisView.php');
    });
    $app->get('/menus', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'GerenciarMenusView.php');
    });
    $app->get('/permissoes', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'GerenciarPermissoesView.php');
    });
    $app->get('/dadosUsuario', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'DadosUsuarioView.php');
    });
    $app->get('/gerenciaPessoa', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'GerenciaPessoaView.php');
    });

    $app->get('/gerenciaUsuario', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'GerenciarUsuariosView.php');
    });

    $app->get('/meuPerfil', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'ProfileView.php');
    });

    $app->get('/gerenciarOrganograma', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'GerenciarOrganogramaView.php');
    });

    $app->get('/alterarSenha', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'AlterarSenhaView.php');
    });



})->add(new PermissionMiddleware($container, Constants::SISTEMA_JUBARTE_ID));

//ROTAS DE WEBPAGES PROTEGIDAS DO LDAP
$app->group('/pages', function () use ($app) {

    $app->get('/cadastroLDAP', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'CadastroLDAPView.php');
    });
    $app->get('/alterarLDAP', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'AlterarLDAPView.php');
    });
    $app->get('/gerenciaLDAP', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'GerenciarLDAPView.php');
    });
    $app->get('/cartaSenha', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'SolicitacaoCartaSenhaView.php');
    });
    $app->get('/moderarCartaSenha', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'ModeracaoCartaSenhaView.php');
    });

})->add(new PermissionMiddleware($container, Constants::SISTEMA_LDAP_ID));


//ROTAS LIBERDADAS
$app->group('/pages', function () use ($app) {

    $app->get('/home', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'Home.php');
    });

    $app->get('/404', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, '404.php');
    });

    $app->get('/401', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, '401.php');
    });

    $app->get('/suporte', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'suporteFAQ.php');
    });
    $app->get('/sis', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'Sistemas.php');
    });
    $app->get('/creditos', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'creditos.php');
    });
    $app->get('/version', function (Request $request, Response $response, $args) use ($app) {
        return $this->view->render($response, 'Version.php');
    });
});