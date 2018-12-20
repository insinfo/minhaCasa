<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jubarte - Prefeitura Municipal de Rio das Ostras - RJ</title>

    <!-- ESTILO LIMITLESS -->
    <link href="/cdn/Assets/fonts/material-icons/material-icons.css" rel="stylesheet">
    <link href="/cdn/Assets/fonts/roboto/roboto.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Vendor/limitless/material/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Vendor/limitless/material/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Vendor/limitless/material/css/core.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Vendor/limitless/material/css/components.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Vendor/limitless/material/css/colors.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/modernDataTable.css" rel="stylesheet" type="text/css"/>
    <!-- /ESTILO LIMITLESS -->

    <!-- JS CORE LIMITLESS

    -->
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/core/libraries/bootstrap.min.js"></script>

    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/core/libraries/jquery_ui/full.min.js"></script>

    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/bootstrap-select.min.js"></script>
    <!-- /JS CORE LIMITLESS -->

    <!-- JS PLUGINS EXTRA PARA ESTA PAGINA -->
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/core/app.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/html2canvas/1.0.0/html2canvas.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/perfect-scrollbar-1.3.0/perfect-scrollbar.js"></script>
    <link href="/cdn/Vendor/perfect-scrollbar-1.3.0/perfect-scrollbar.css" rel="stylesheet" type="text/css">

    <!-- Editor de Texto -->
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/ckeditor/ckeditorCustom/ckeditor.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/ckeditor/ckeditorCustom/adapters/jquery.js"></script>
    <!-- /Editor de Texto -->

    <!-- /JS PLUGINS EXTRA PARA ESTA PAGINA -->

    <!-- DEPENDEICIAS JUBARTE -->
    <link href="/cdn/Assets/css/jSwitch.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/jubarteStyle.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/jubarteLoginStyle.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/jCheckBox.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/ModernTreeView.css" rel="stylesheet" type="text/css">

    <!-- DEPENDECIAS DA VIEW MODEL -->
    <script type="text/javascript" src="/cdn/utils/utils.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernBlockUI.js"></script>
    <script type="text/javascript" src="/cdn/utils/jubarte.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModalAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/LoaderAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/RESTClient.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernDataTable.js"></script>
    <script type="text/javascript" src="/cdn/utils/MenuAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/JubarteAPI.js"></script>

    <!-- VIEW MODEL -->
    <script type="text/javascript" src="/ViewModel/Constants.js"></script>
    <script type="text/javascript" src="/ViewModel/MainViewModel.js"></script>

</head>
<body id="window" class="navbar-top" onload="$('#inputNomeUsuario').focus()">

<!-- pageMainView -->
<div class="pageMainView" id="pageMainView" style="width: 100%;height: 100%;">

    <!-- Main navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top jubarteNavBar">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <img src="/cdn/Assets/images/jubarteLogo.svg" alt="Jubarte">
            </a>

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav left">
                <li name="btn-main-menu" data-popup="tooltip" title="Principal" data-placement="bottom"><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
                <li name="btn-detached-right-bar" class="dynamic hidden" data-popup="tooltip" title="Ações" data-placement="bottom"><a class="sidebar-control sidebar-detached-hide hidden-xs"><i class="icon-drag-right"></i></a></li>
                <!--<li class="dropdown" data-popup="tooltip" title="Atualizações" data-placement="bottom">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-puzzle3"></i>
                        <span class="visible-xs-inline-block position-right">Comunicação</span>
                        <span class="status-mark border-orange-400"></span>
                    </a>

                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-heading">
                            Atualizações
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-sync"></i></a></li>
                            </ul>
                        </div>

                        <ul class="media-list dropdown-content-body width-350">
                            <li class="media">
                                <div class="media-left">
                                    <a href="#"
                                       class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i
                                                class="icon-git-pull-request"></i></a>
                                </div>

                                <div class="media-body">
                                    Drop the IE <a href="#">specific hacks</a> for temporal inputs
                                    <div class="media-annotation">4 minutes ago</div>
                                </div>
                            </li>

                            <li class="media">
                                <div class="media-left">
                                    <a href="#"
                                       class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i
                                                class="icon-git-commit"></i></a>
                                </div>

                                <div class="media-body">
                                    Add full font overrides for popovers and tooltips
                                    <div class="media-annotation">36 minutes ago</div>
                                </div>
                            </li>

                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i
                                                class="icon-git-branch"></i></a>
                                </div>

                                <div class="media-body">
                                    <a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span>
                                    branch
                                    <div class="media-annotation">2 hours ago</div>
                                </div>
                            </li>

                            <li class="media">
                                <div class="media-left">
                                    <a href="#"
                                       class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i
                                                class="icon-git-merge"></i></a>
                                </div>

                                <div class="media-body">
                                    <a href="#">Eugene Kopyov</a> merged <span class="text-semibold">Master</span> and <span
                                            class="text-semibold">Dev</span> branches
                                    <div class="media-annotation">Dec 18, 18:36</div>
                                </div>
                            </li>

                            <li class="media">
                                <div class="media-left">
                                    <a href="#"
                                       class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i
                                                class="icon-git-pull-request"></i></a>
                                </div>

                                <div class="media-body">
                                    Have Carousel ignore keyboard events
                                    <div class="media-annotation">Dec 12, 05:46</div>
                                </div>
                            </li>
                        </ul>

                        <div class="dropdown-content-footer">
                            <a href="#" data-popup="tooltip" title="All activity"><i
                                        class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li>-->

                <!--<li class="dropdown" data-popup="tooltip" title="Facebook" data-placement="bottom">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-facebook"></i>
                    </a>

                    <div class="dropdown-menu dropdown-content">

                        <div style="width: 360px; height: 435px;">
                                <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FRiodasOstrasGov%2F&amp;width=360&amp;height=435&amp;colorscheme=light&amp;show_faces=true&amp;stream=true&amp;header=true&amp;border_color=%23" scrolling="no" frameborder="0" style="border:1px solid #; overflow:hidden; width:100%; height:435px;" allowtransparency="true"></iframe>
                        </div>
                        <div class="dropdown-content-footer">
                            <a href="https://www.facebook.com/RiodasOstrasGov/" target="_blank" data-popup="tooltip" title="Ir para o Facebook"><i class="icon-menu display-block"></i></a>
                        </div>

                    </div>
                </li>-->

            </ul>

            <div class="navbar-right">

                <p class="navbar-text " id="teste-notification">
                    <span class="displaySaldacao">Bem-vindo(a), </span>
                    <span class="displayUserName"></span> <a id="btnLogout2" data-popup="tooltip" title="Sair" data-placement="bottom"><i class="icon-switch2" style="font-size: 12px; color: #ffffff;"></i></a>
                </p>
                <!--<p class="navbar-text">
                    <span class="label bg-success-400">Online</span>
                </p>-->

                <ul class="nav navbar-nav right">
                    <li class="sessionTimeout" style="padding: 15px 20px;">
                        <i class="icon-alarm"></i>
                        <span>00:00:00</span>
                    </li>

                    <li class="">
                        <a id="btnOpenModalBugReport" title="BugReport" data-placement="bottom" data-toggle="modal" data-target="#modalBugReport">
                            <i class="icon-bug2"></i>
                            <span class="visible-xs-inline-block position-right">BugReport</span>
                        </a>
                    </li>

                    <li class="dropdown" title="Notificações" data-placement="bottom">
                        <a id="btnOpenDropdownNotificacoes"  class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-bell2"></i>
                            <span class="visible-xs-inline-block position-right">notificações</span>
                            <span id="spanTotalNotificacoes" class="jubarteStatusMark">0</span>
                        </a>

                        <div class="dropdown-menu dropdown-content">
                            <div class="dropdown-content-heading">
                                Notificações
                                <ul class="icons-list">
                                    <li><a id="btnLimparNotificacoes"><i class="icon-trash-alt"></i></a></li>
                                </ul>
                            </div>

                            <ul id="notificacoesContainer" class="media-list dropdown-content-body width-350">
                                <!--<li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs">
                                            <i class="icon-mention"></i>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="#">Leonardo Calheiros</a> adicionou comentário na solicitação: 2018.06260225191345
                                        <div class="media-annotation">1 minuto</div>
                                    </div>
                                </li>-->
                                <li>Sem notificações no momento!</li>
                            </ul>
                        </div>
                    </li>

                    <!--<li class="dropdown" data-popup="tooltip" title="Mensagens" data-placement="bottom">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-bubble8"></i>
                            <span class="visible-xs-inline-block position-right">Mensagens</span>
                            <span class="status-mark border-orange-400"></span>
                        </a>

                        <div id="mailDropdownContainer" class="dropdown-menu dropdown-content width-350">
                            <div class="dropdown-content-heading">
                                Mensagens
                                <ul class="icons-list">
                                    <li><a href="#"><i class="icon-compose"></i></a></li>
                                </ul>
                            </div>

                            <ul class="media-list dropdown-content-body">

                                <li class="media">
                                    <div class="media-left">
                                        <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                        <span class="badge bg-danger-400 media-badge">5</span>
                                    </div>

                                    <div class="media-body">
                                        <a href="#" class="media-heading">
                                            <span class="text-semibold">James Alexander</span>
                                            <span class="media-annotation pull-right">04:58</span>
                                        </a>

                                        <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                        <span class="badge bg-danger-400 media-badge">4</span>
                                    </div>

                                    <div class="media-body">
                                        <a href="#" class="media-heading">
                                            <span class="text-semibold">Margo Baker</span>
                                            <span class="media-annotation pull-right">12:16</span>
                                        </a>

                                        <span class="text-muted">That was something he was unable to do because...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left"><img src="/cdn/Vendor/limitless/material/images/placeholder.jpg"
                                                                 class="img-circle img-sm" alt=""></div>
                                    <div class="media-body">
                                        <a href="#" class="media-heading">
                                            <span class="text-semibold">Jeremy Victorino</span>
                                            <span class="media-annotation pull-right">22:48</span>
                                        </a>

                                        <span class="text-muted">But that would be extremely strained and suspicious...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left"><img src="/cdn/Vendor/limitless/material/images/placeholder.jpg"
                                                                 class="img-circle img-sm" alt=""></div>
                                    <div class="media-body">
                                        <a href="#" class="media-heading">
                                            <span class="text-semibold">Beatrix Diaz</span>
                                            <span class="media-annotation pull-right">Tue</span>
                                        </a>

                                        <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left"><img src="/cdn/Vendor/limitless/material/images/placeholder.jpg"
                                                                 class="img-circle img-sm" alt=""></div>
                                    <div class="media-body">
                                        <a href="#" class="media-heading">
                                            <span class="text-semibold">Richard Vango</span>
                                            <span class="media-annotation pull-right">Mon</span>
                                        </a>

                                        <span class="text-muted">Other travelling salesmen live a life of luxury...</span>
                                    </div>
                                </li>

                            </ul>

                            <div class="dropdown-content-footer">
                                <a href="#" data-popup="tooltip" title="All messages"><i
                                            class="icon-menu display-block"></i></a>
                            </div>
                        </div>
                    </li>-->

                    <li class="dropdown" title="E-Mail" data-placement="bottom">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-envelop"></i>
                            <span class="visible-xs-inline-block position-right">E-mail</span>
                            <span class="jubarteStatusMark">0</span>
                        </a>

                        <div class="dropdown-menu dropdown-content width-350">
                            <div class="dropdown-content-heading">
                                Email
                                <!--<ul class="icons-list">
                                    <li><a href="#"><i class="icon-compose"></i></a></li>
                                </ul>-->
                            </div>

                            <ul id="lastEmailsContainer" class="media-list dropdown-content-body">
                                <li class="media">
                                    <div class="media-left">
                                        <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                        <span class="badge bg-danger-400 media-badge">0</span>
                                    </div>

                                    <div class="media-body">
                                        <a href="#" class="media-heading">
                                            <span class="text-semibold">E-mail não sincronizado</span>
                                            <span class="media-annotation pull-right">00:00</span>
                                        </a>

                                        <span class="text-muted">Entre em contato com os administradores do sistema...</span>
                                    </div>
                                </li>
                            </ul>

                            <div class="dropdown-content-footer">
                                <a href="#" data-popup="tooltip" title="Todas os E-mails"><i class="icon-menu display-block"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /main navbar -->

    <!-- Page container -->
    <div class="page-container containerCustom">

        <!-- Page content -->
        <div class="page-content containerCustom">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main sidebar-default sidebar-fixed">
                <div class="sidebar-content">

                    <!-- User menu -->
                    <div class="sidebar-user-material">
                        <div class="category-content" id="userInfoContainer">
                            <div class="sidebar-user-material-content" id="userInfoBox">
                                <a style="box-shadow: none" >
                                    <!--<img src="/cdn/Vendor/limitless/material/images/placeholder.jpg"
                                    class="img-circle img-responsive" alt="">-->

                                </a>
                                <h6 class="displayUserName"></h6>
                                <span class="text-size-small" id="user-info-cargo">
                                    Servidor
                                </span>
                            </div>

                            <div class="sidebar-user-material-menu">
                                <a href="#user-nav" data-toggle="collapse">
                                    <span>Sair</span>
                                    <i class="caret"></i>
                                </a>
                            </div>
                        </div>

                        <div class="navigation-wrapper collapse" id="user-nav">
                            <ul class="navigation">
                                <!--
                                <li>
                                    <a href="#">
                                        <i class="icon-comment-discussion"></i>
                                        <span>
                                            <span class="badge bg-teal-400 pull-right">58
                                            </span>
                                            Mensagens
                                        </span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <i class="icon-cog5"></i>
                                        <span>Configurações</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/pages/meuPerfil" target="iframeShowPage">
                                        <i class="icon-user-plus"></i>
                                        <span>Meu perfil</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/pages/extratoBiometria" target="iframeShowPage">
                                        <i class="icon-alarm"></i>
                                        <span>Ponto Eletrônico</span>
                                    </a>
                                </li>-->
                                <li>
                                    <a href="#" id="btnLogout">
                                        <i class="icon-switch2"></i>
                                        <span>Confirmar logout?</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /user menu -->

                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul id="sidebarMainMenu" class="navigation navigation-main navigation-accordion"></ul>
                        </div>
                    </div>
                    <!-- /main navigation -->

                </div>
            </div>
            <!-- /main sidebar -->

            <!-- iFrame Main Content ../ciente/mainView.php -->
            <div class="content-wrapper containerCustom">
                <iframe id="iframeShowPage" src="pages/home" scrolling="no" name="iframeShowPage" class="iframeCustom" allowtransparency="false"></iframe>
            </div>
            <!-- /iFrame Main Content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

</div>
<!-- pageMainView -->

<!-- pageLoginView -->
<div class="pageLoginView" id="pageLoginView" style="width: 100%;height: 100%;">

    <div class="videoContainer">

        <video autoplay muted loop id="videoPlay" class="videoPlay">
            <!-- <source src="/cdn/Assets/video/bgJubarteNovo.mp4" type="video/mp4">-->
            Seu navegador não suporta video HTML5.
        </video>

        <div class="bgVideoCor"></div>
        <div class="bgVideoTextura"></div>

    </div>

    <div class="formLoginContainer">

        <div class="formLoginContent">

            <div class="login-form">

                <div class="text-center">
                    <div class="icon-object border-orange-800 text-orange-800"><i class="icon-user"></i></div>
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    <input id="inputNomeUsuario" type="text" class="form-control input-lg" placeholder="Login">
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    <input id="inputSenha" type="password" class="form-control input-lg" placeholder="Senha">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group login-options">
                    <div class="row no-padding no-margin">
                        <div class="col-sm-12 no-padding no-margin">
                            <div class="jSwitch" style="margin-left: -20px;">
                                <label>
                                    <input type="checkbox" id="checkBoxLembrarSenha">
                                    <span class="jThumb"></span>
                                    Memorizar
                                </label>
                            </div>
                        </div>

                        <!--<div class="col-sm-6 text-right no-padding no-margin">
                            <a href="login_password_recover.html">Esqueceu sua senha?</a>
                        </div>-->
                    </div>
                </div>

                <div class="form-group">
                    <button id="btnLogar" class="btn bg-primary-400 btn-block btn-lg">Login <i class="icon-arrow-right14 position-right"></i></button>
                </div>

                <!--<div class="content-divider text-muted form-group"><span>Ainda não possui acesso?</span></div>
                <a href="#" class="btn bg-slate btn-block btn-lg content-group">Registrar-se</a>-->
                <span class="help-block text-center">Sistema desenvolvido pela COTINF.</span>
            </div>

            <div class="pmroLogo">
                <!-- Logo 2018 -->
                <svg width="425pt" height="140pt" viewBox="0 0 425 140" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <g id="#ffffffff">
                        <path fill="#ffffff" opacity="1.00" d=" M 51.71 3.93 C 56.36 2.86 60.97 1.56 65.72 1.02 C 65.87 2.23 66.02 3.45 66.17 4.67 C 61.68 5.20 57.30 6.32 52.91 7.37 C 52.51 6.23 52.11 5.08 51.71 3.93 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 70.82 0.48 C 75.35 0.18 79.88 0.14 84.41 0.50 C 84.39 1.36 84.36 3.10 84.34 3.97 C 79.84 3.79 75.34 3.82 70.85 3.97 C 70.84 3.10 70.83 1.35 70.82 0.48 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 89.36 0.92 C 94.13 1.49 98.79 2.65 103.44 3.81 C 103.03 4.99 102.62 6.17 102.21 7.34 C 97.84 5.99 93.31 5.32 88.84 4.41 C 88.97 3.53 89.23 1.79 89.36 0.92 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 302.64 3.66 C 303.13 3.63 304.10 3.57 304.59 3.54 C 304.53 10.16 304.57 16.79 304.57 23.41 C 304.09 23.38 303.13 23.32 302.65 23.29 C 302.69 16.75 302.71 10.20 302.64 3.66 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 377.27 3.58 C 382.19 4.11 389.12 1.76 392.16 6.99 C 394.24 10.76 390.72 14.40 387.23 15.39 C 389.51 17.97 391.62 20.70 393.64 23.49 C 389.10 23.50 388.17 17.72 384.92 15.41 C 382.97 15.24 381.02 15.33 379.08 15.30 C 379.04 18.03 379.07 20.75 379.07 23.47 C 378.60 23.37 377.66 23.16 377.19 23.06 C 377.29 16.56 377.17 10.07 377.27 3.58 M 379.05 5.26 C 379.06 8.04 379.07 10.82 379.01 13.61 C 382.45 13.43 386.33 14.46 389.40 12.41 C 391.59 10.84 391.34 7.28 388.95 6.04 C 385.84 4.69 382.33 5.42 379.05 5.26 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 413.33 5.03 C 413.76 4.17 414.28 3.04 415.45 3.35 C 417.66 7.14 419.20 11.28 421.12 15.21 C 422.31 18.10 424.16 20.77 424.66 23.90 C 421.64 23.26 421.95 19.73 420.11 18.00 C 416.50 17.92 412.89 18.08 409.29 17.93 C 407.97 19.80 407.87 24.04 404.73 23.36 C 407.80 17.35 410.36 11.09 413.33 5.03 M 414.51 6.00 C 413.24 9.52 411.61 12.88 409.91 16.21 C 413.16 16.18 416.41 16.20 419.67 16.18 C 417.68 12.93 417.02 8.87 414.51 6.00 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 161.77 3.62 C 165.64 3.85 169.87 2.79 173.46 4.63 C 177.00 6.44 177.44 11.84 174.36 14.30 C 171.35 16.88 167.14 15.95 163.51 16.24 C 163.59 18.58 163.63 20.92 163.69 23.26 L 161.78 23.38 C 161.80 16.79 161.81 10.21 161.77 3.62 M 163.55 5.31 C 163.62 8.34 163.62 11.37 163.57 14.40 C 166.33 14.30 169.22 14.78 171.88 13.80 C 174.67 12.78 175.71 8.64 173.25 6.69 C 170.52 4.52 166.76 5.40 163.55 5.31 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 189.60 3.62 C 193.05 3.64 196.52 3.41 199.97 3.74 C 203.54 4.09 206.44 8.29 204.63 11.65 C 203.75 13.73 201.48 14.43 199.64 15.38 C 201.93 17.99 204.17 20.67 206.02 23.61 C 201.68 23.22 200.40 18.01 197.56 15.36 C 195.52 15.33 193.49 15.33 191.46 15.33 C 191.49 17.99 191.52 20.64 191.57 23.29 L 189.61 23.36 C 189.65 16.78 189.67 10.20 189.60 3.62 M 191.45 5.31 C 191.52 8.08 191.52 10.85 191.45 13.61 C 194.83 13.43 198.60 14.44 201.65 12.52 C 203.41 11.49 203.53 9.08 202.85 7.36 C 200.03 4.08 195.21 5.55 191.45 5.31 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 219.02 3.65 C 223.78 3.54 228.55 3.59 233.31 3.61 L 233.30 5.25 C 229.19 5.26 225.09 5.26 220.98 5.24 C 220.93 7.70 220.94 10.15 221.09 12.60 C 224.74 12.47 228.40 12.50 232.05 12.55 L 232.05 14.28 C 228.38 14.31 224.71 14.32 221.04 14.25 C 220.94 16.72 220.94 19.19 221.02 21.66 C 225.15 21.61 229.28 21.64 233.41 21.62 C 233.41 22.05 233.42 22.91 233.42 23.35 C 228.63 23.31 223.83 23.37 219.04 23.30 C 219.02 16.75 219.06 10.20 219.02 3.65 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 246.92 3.62 C 251.63 3.57 256.35 3.58 261.06 3.61 L 261.08 5.24 C 256.99 5.27 252.90 5.22 248.81 5.29 C 248.86 7.81 248.87 10.33 248.88 12.85 C 252.64 12.85 256.41 12.80 260.18 12.90 C 260.02 13.31 259.69 14.11 259.52 14.52 C 255.97 14.72 252.40 14.53 248.85 14.59 C 248.85 17.52 248.86 20.45 248.97 23.38 C 248.48 23.33 247.48 23.23 246.98 23.18 C 246.84 16.67 246.98 10.14 246.92 3.62 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 274.48 3.63 C 279.16 3.62 283.86 3.46 288.54 3.68 L 289.11 5.18 C 284.85 5.33 280.59 5.21 276.33 5.29 C 276.39 7.70 276.39 10.10 276.32 12.51 C 279.97 12.57 283.62 12.39 287.27 12.60 L 287.80 14.22 C 283.98 14.36 280.15 14.27 276.33 14.32 C 276.39 16.75 276.38 19.19 276.33 21.62 C 280.55 21.66 284.78 21.58 289.00 21.69 L 289.01 23.29 C 284.17 23.37 279.33 23.33 274.49 23.32 C 274.54 16.75 274.56 10.19 274.48 3.63 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 317.99 3.64 C 323.17 3.56 328.36 3.58 333.54 3.62 L 333.51 5.25 C 331.24 5.26 328.98 5.25 326.72 5.25 C 326.77 11.25 326.61 17.25 326.84 23.24 C 326.17 23.28 325.50 23.33 324.84 23.37 C 324.84 17.34 324.79 11.30 324.89 5.27 C 322.59 5.26 320.30 5.25 318.00 5.22 L 317.99 3.64 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 346.43 3.67 L 348.40 3.58 C 348.49 8.22 348.07 12.90 348.60 17.51 C 349.66 23.20 359.06 23.51 360.55 17.96 C 361.25 13.18 360.68 8.30 360.84 3.48 C 361.34 3.57 362.34 3.75 362.84 3.84 C 362.46 8.86 363.50 14.08 362.08 18.97 C 359.65 25.66 348.41 25.06 346.83 18.07 C 346.04 13.33 346.75 8.46 346.43 3.67 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 40.00 8.40 C 42.32 7.41 44.66 6.46 47.01 5.54 C 47.53 6.68 48.05 7.83 48.57 8.98 C 46.25 9.73 43.99 10.66 41.79 11.72 C 41.18 10.62 40.58 9.51 40.00 8.40 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 71.35 6.50 C 75.65 6.26 79.97 6.20 84.27 6.46 C 84.29 6.96 84.32 7.95 84.34 8.45 C 85.32 8.47 87.28 8.53 88.26 8.56 C 88.46 8.20 88.87 7.49 89.07 7.13 C 93.35 7.40 97.52 8.53 101.64 9.65 C 101.41 10.23 100.97 11.40 100.75 11.99 C 102.13 12.40 103.50 12.82 104.88 13.24 C 105.15 12.69 105.69 11.58 105.95 11.03 C 108.19 11.84 110.42 12.69 112.58 13.68 C 111.94 14.77 111.26 15.85 110.55 16.90 C 109.40 17.68 107.58 16.46 106.52 17.58 C 104.92 19.50 103.86 21.81 102.60 23.96 C 104.34 24.51 107.42 26.15 104.26 27.49 C 87.38 20.35 67.72 20.51 50.87 27.68 C 50.47 27.20 49.66 26.26 49.26 25.78 C 50.47 25.17 51.68 24.57 52.91 23.98 C 50.85 21.47 49.89 15.89 45.58 17.14 C 44.10 17.04 43.77 14.82 42.82 13.85 C 44.97 12.88 47.16 11.99 49.35 11.10 C 49.71 11.70 50.43 12.90 50.80 13.50 C 52.46 12.64 55.33 12.28 54.31 9.60 C 58.13 8.47 62.09 7.90 65.98 7.05 C 66.49 9.35 68.95 8.32 70.64 8.48 C 70.82 7.98 71.17 7.00 71.35 6.50 M 74.37 19.32 C 76.61 19.35 78.84 19.35 81.08 19.34 C 80.89 15.89 82.53 8.83 76.91 9.47 C 72.85 10.92 74.88 16.10 74.37 19.32 M 58.32 13.14 C 58.17 15.80 58.99 18.40 59.34 21.01 C 61.45 20.74 63.56 20.47 65.68 20.20 C 65.12 17.54 64.99 14.73 63.86 12.23 C 62.30 10.55 59.31 11.16 58.32 13.14 M 91.22 12.29 C 89.81 14.65 89.92 17.54 89.34 20.15 C 91.36 20.42 93.38 20.75 95.37 21.23 C 95.93 18.65 96.78 16.07 96.64 13.41 C 95.96 11.25 92.66 10.35 91.22 12.29 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 108.09 5.40 C 110.57 6.25 112.99 7.27 115.43 8.20 C 114.80 9.32 114.15 10.41 113.50 11.51 C 111.29 10.47 109.00 9.59 106.70 8.77 C 107.16 7.64 107.62 6.52 108.09 5.40 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 0.00 22.17 C 4.02 23.43 8.20 24.65 11.55 27.31 C 14.78 29.87 16.59 33.66 18.86 37.00 C 21.21 40.60 24.09 43.81 26.96 46.99 C 29.64 45.83 32.31 44.64 34.98 43.46 C 31.21 49.25 27.81 55.60 27.68 62.69 C 28.36 62.15 29.73 61.07 30.41 60.53 C 31.84 61.62 32.63 63.21 33.22 64.87 C 31.94 66.12 30.68 67.38 29.42 68.65 C 30.71 74.91 32.87 80.94 34.04 87.22 C 35.73 84.89 37.72 82.72 39.00 80.13 C 39.21 63.50 39.12 46.85 39.05 30.22 C 45.16 29.80 51.62 31.30 57.38 28.65 C 70.28 23.71 85.03 23.80 97.87 28.87 C 103.23 31.23 109.19 29.81 114.84 30.22 C 114.66 46.93 114.90 63.65 114.71 80.36 C 116.44 82.78 118.23 85.15 120.12 87.44 C 121.38 81.21 123.55 75.21 124.95 69.01 C 123.58 67.70 122.23 66.37 120.90 65.03 C 121.70 63.54 122.62 62.13 123.74 60.86 C 124.47 61.39 125.93 62.46 126.66 62.99 C 126.71 55.92 122.96 49.78 119.28 44.04 C 122.01 45.14 124.71 46.31 127.39 47.53 C 132.23 42.90 136.15 37.46 139.79 31.86 C 143.30 26.39 149.87 24.54 155.69 22.65 C 148.91 31.04 141.82 39.42 137.24 49.29 C 135.12 53.69 134.06 58.63 134.62 63.52 C 137.11 63.15 140.84 60.73 142.79 63.16 C 141.66 66.56 138.84 68.99 136.49 71.56 C 138.37 76.89 139.88 82.37 140.72 87.97 C 144.28 84.62 148.55 82.20 152.99 80.21 C 150.49 87.69 145.54 93.87 141.53 100.53 C 137.15 108.57 141.53 117.57 144.63 125.22 C 145.86 126.97 143.76 128.85 141.98 128.27 C 136.44 126.81 131.66 123.31 127.63 119.34 C 120.35 112.17 116.28 102.45 114.20 92.58 C 111.73 108.02 98.41 120.57 83.08 122.92 C 63.55 126.61 42.14 112.12 39.83 92.06 C 38.54 97.17 37.41 102.38 35.04 107.12 C 30.74 116.19 23.59 124.49 13.98 128.02 C 12.46 128.84 9.78 128.08 10.26 126.00 C 12.48 119.85 15.48 113.71 15.28 107.00 C 15.18 102.42 12.61 98.49 10.15 94.83 C 7.01 90.21 4.39 85.22 2.54 79.94 C 6.83 81.90 10.83 84.45 14.29 87.67 C 15.10 82.05 16.57 76.55 18.32 71.15 C 15.83 68.66 13.67 65.86 11.96 62.78 C 14.35 60.56 17.48 62.58 20.15 63.11 C 20.95 57.03 18.88 51.06 16.18 45.71 C 11.72 37.40 6.19 29.62 0.00 22.52 L 0.00 22.17 M 43.21 34.23 C 43.20 52.15 43.43 70.07 43.26 87.99 C 43.02 94.98 46.33 101.39 50.03 107.10 C 58.40 99.41 66.50 91.42 74.58 83.42 C 75.91 82.34 75.94 80.58 75.94 79.01 C 76.00 64.08 75.88 49.15 75.95 34.22 C 65.04 34.22 54.12 34.21 43.21 34.23 M 77.79 34.23 C 77.69 43.53 77.78 52.83 77.73 62.14 C 77.45 63.55 78.30 64.76 78.83 65.98 L 79.18 64.05 C 85.28 59.99 92.16 57.17 98.43 53.38 C 99.69 52.40 97.90 50.70 97.74 49.46 C 96.03 49.50 94.52 48.86 93.53 47.45 C 90.44 48.34 87.32 46.89 84.16 47.26 C 82.74 48.21 81.44 49.48 79.69 49.78 C 81.00 46.22 84.01 43.33 87.71 42.39 C 90.34 40.33 93.75 39.89 96.98 39.65 C 99.06 40.80 101.37 41.52 103.42 42.66 C 104.13 44.27 105.41 46.45 104.10 48.07 C 103.26 49.58 102.17 51.13 102.17 52.94 C 103.21 54.99 105.07 56.57 105.79 58.79 C 106.52 61.45 104.74 63.71 103.73 65.99 C 105.85 67.73 107.70 69.85 108.37 72.59 C 100.78 70.16 92.89 68.68 84.92 68.40 C 92.17 69.70 99.91 69.77 106.57 73.28 C 107.53 74.09 109.72 74.90 108.73 76.46 C 103.66 77.74 98.54 78.83 93.45 80.02 C 91.90 77.18 90.11 74.39 87.58 72.30 C 84.51 69.46 80.37 68.12 77.46 65.08 C 78.12 70.40 77.51 75.77 77.85 81.11 C 77.81 82.46 78.93 83.36 79.74 84.26 C 87.59 91.93 95.55 99.49 103.40 107.16 C 107.79 101.82 110.41 94.93 110.56 88.00 C 110.67 70.10 110.42 52.20 110.68 34.30 C 99.72 34.17 88.75 34.32 77.79 34.23 M 51.68 108.55 C 59.50 117.01 71.74 121.11 83.07 118.92 C 90.38 117.75 96.88 113.73 102.21 108.73 C 93.86 100.55 85.40 92.48 76.98 84.37 C 68.38 92.23 60.35 100.74 51.68 108.55 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 265.51 27.76 C 273.26 26.47 281.50 27.39 288.45 31.19 C 297.08 35.67 303.39 44.32 304.92 53.93 C 306.82 64.44 303.00 75.79 295.04 82.93 C 282.10 94.93 259.62 94.48 247.45 81.58 C 237.97 72.00 235.90 56.20 242.36 44.42 C 246.93 35.64 255.85 29.53 265.51 27.76 M 266.46 43.60 C 255.95 47.22 252.99 61.91 259.80 70.17 C 264.05 75.96 272.49 77.76 278.88 74.64 C 286.60 71.04 289.70 61.03 286.77 53.31 C 284.08 45.25 274.44 40.46 266.46 43.60 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 162.81 28.53 C 173.17 28.40 183.53 28.47 193.89 28.50 C 200.84 28.59 208.31 30.56 213.06 35.95 C 217.86 41.13 218.59 48.87 217.17 55.51 C 215.76 61.73 210.66 66.45 204.97 68.91 C 209.77 75.29 214.00 82.08 218.61 88.59 C 218.86 88.78 219.36 89.18 219.60 89.38 C 219.22 69.09 219.68 48.79 219.38 28.50 C 225.18 28.43 230.98 28.51 236.79 28.45 C 236.76 49.09 236.61 69.74 236.86 90.38 C 224.60 90.50 212.33 90.40 200.07 90.43 C 195.87 84.27 191.87 77.98 187.63 71.85 C 185.13 71.36 182.54 71.72 180.01 71.68 C 180.21 77.92 180.05 84.17 180.12 90.42 C 174.36 90.43 168.61 90.43 162.85 90.42 C 162.85 69.79 162.93 49.16 162.81 28.53 M 180.09 43.33 C 180.09 48.29 180.16 53.25 180.04 58.20 C 185.60 57.82 191.50 59.21 196.81 57.10 C 202.20 54.62 201.74 45.52 195.87 43.96 C 190.72 42.73 185.33 43.63 180.09 43.33 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 62.66 51.06 C 64.11 49.85 65.52 48.60 66.96 47.38 C 68.13 48.55 69.43 49.60 70.93 50.35 C 67.17 50.51 69.79 53.05 70.91 54.14 C 72.05 57.13 72.88 60.25 73.43 63.40 C 69.96 62.90 66.46 62.11 63.33 60.47 C 62.19 59.22 64.38 57.84 64.71 56.66 C 64.18 55.16 64.62 53.85 65.76 52.77 C 64.99 51.77 63.96 51.20 62.66 51.06 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 390.87 56.00 C 392.75 52.03 396.80 49.54 401.01 48.70 C 408.78 47.22 417.17 48.95 423.50 53.80 C 421.36 56.44 419.44 59.25 417.52 62.05 C 413.29 59.33 408.15 57.09 403.04 58.40 C 400.86 59.11 400.89 62.46 403.14 63.09 C 409.55 65.84 417.80 65.55 422.49 71.47 C 427.17 78.08 423.23 88.19 415.58 90.45 C 407.96 92.56 399.37 91.81 392.35 88.10 C 392.69 88.86 393.38 90.40 393.72 91.17 C 389.54 91.07 385.36 91.12 381.18 91.12 C 380.12 88.60 379.11 86.06 378.02 83.56 C 372.63 83.56 367.24 83.58 361.86 83.55 C 360.79 86.00 359.83 88.49 358.86 90.98 C 354.71 90.97 350.57 91.12 346.43 91.16 C 352.43 77.03 358.51 62.94 364.31 48.73 C 368.12 48.57 371.94 48.63 375.75 48.68 C 380.46 59.87 385.21 71.04 389.91 82.24 C 391.28 80.48 392.66 78.73 394.00 76.95 C 398.78 80.50 404.92 83.05 410.93 81.50 C 413.21 80.85 413.36 77.44 410.99 76.76 C 405.17 74.09 398.02 74.33 393.03 69.89 C 389.11 66.51 388.80 60.47 390.87 56.00 M 369.49 63.49 C 368.17 67.20 366.77 70.88 365.15 74.47 C 368.38 74.46 371.61 74.46 374.84 74.47 C 373.16 70.71 371.53 66.91 370.45 62.92 C 370.21 63.07 369.73 63.35 369.49 63.49 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 310.75 48.85 C 321.25 49.39 332.88 46.89 342.25 52.95 C 353.61 60.21 353.60 79.08 342.50 86.58 C 333.22 93.10 321.35 90.62 310.76 91.07 C 310.76 77.00 310.76 62.92 310.75 48.85 M 322.34 59.37 C 322.45 66.44 322.46 73.52 322.33 80.59 C 326.24 80.55 330.49 81.18 334.01 79.06 C 340.75 75.42 340.47 63.82 333.47 60.60 C 330.05 58.81 326.05 59.43 322.34 59.37 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 46.20 64.99 C 46.04 60.56 47.29 55.94 50.95 53.13 C 57.32 59.00 65.12 64.12 74.05 64.51 C 74.47 66.09 74.64 67.72 74.68 69.36 C 63.86 70.80 53.47 74.45 43.93 79.72 C 44.45 75.37 43.92 70.98 44.27 66.62 C 51.85 66.65 59.43 66.39 67.01 66.34 C 68.14 66.34 69.34 66.31 70.33 65.67 C 62.31 65.03 54.19 65.94 46.20 64.99 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 181.51 92.70 C 189.46 91.25 198.22 93.18 204.09 98.93 C 209.25 103.73 211.71 111.09 210.96 118.02 C 210.13 126.58 203.94 134.19 195.92 137.13 C 185.42 141.34 172.06 137.72 165.91 128.01 C 161.20 120.80 161.08 110.90 165.68 103.61 C 169.09 97.93 175.06 94.02 181.51 92.70 M 182.42 106.46 C 174.58 110.38 176.29 124.00 185.06 125.48 C 192.42 127.13 198.29 118.43 195.41 111.93 C 193.93 106.61 187.27 103.66 182.42 106.46 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 214.71 98.56 C 217.23 95.39 221.12 93.64 225.01 92.84 C 234.25 91.35 244.19 93.10 251.69 98.93 C 251.50 97.04 251.38 95.15 251.31 93.26 C 265.02 93.12 278.73 93.31 292.45 93.16 C 292.53 97.39 292.48 101.62 292.48 105.85 C 288.14 105.80 283.80 105.87 279.47 105.79 C 279.36 116.48 279.46 127.18 279.43 137.88 C 274.45 137.85 269.48 137.83 264.51 137.89 C 264.45 127.19 264.56 116.49 264.46 105.79 C 260.09 105.84 255.72 105.86 251.36 105.79 C 251.31 103.19 252.09 100.29 250.17 98.17 C 248.99 102.14 245.71 105.12 243.46 108.54 C 239.24 105.55 234.00 103.82 228.81 104.24 C 226.70 104.22 225.98 107.25 228.24 107.76 C 234.63 109.95 242.06 109.92 247.55 114.34 C 253.28 118.50 253.11 127.55 248.67 132.58 C 245.04 136.81 239.28 138.39 233.91 138.66 C 225.14 139.04 215.92 136.94 209.12 131.14 C 212.04 128.12 214.42 124.63 217.38 121.65 C 222.01 125.47 228.17 127.10 234.11 126.81 C 235.49 126.73 237.27 125.87 236.74 124.20 C 234.02 122.00 230.33 122.07 227.11 121.15 C 221.81 119.86 215.73 118.07 212.90 112.96 C 210.80 108.33 211.43 102.50 214.71 98.56 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 293.95 93.21 C 301.96 93.24 309.97 93.16 317.98 93.25 C 323.37 93.41 329.17 95.05 332.70 99.39 C 335.97 103.22 336.37 108.71 335.26 113.43 C 334.13 117.71 330.63 120.82 326.86 122.84 C 329.89 126.62 332.48 130.74 335.16 134.78 C 341.19 120.88 346.83 106.81 352.79 92.89 C 357.77 93.01 362.75 92.62 367.72 92.92 C 372.65 105.40 378.14 117.65 383.07 130.12 C 385.57 127.43 387.91 124.58 390.15 121.68 C 395.06 125.17 401.04 127.20 407.11 126.82 C 408.51 126.77 410.24 125.92 409.88 124.24 C 406.87 121.81 402.75 122.01 399.21 120.91 C 393.76 119.58 387.52 117.24 385.33 111.57 C 384.11 107.48 384.77 102.82 387.24 99.31 C 389.71 95.75 393.85 93.68 398.02 92.86 C 406.96 91.78 416.64 92.75 424.01 98.38 C 421.57 101.75 419.08 105.08 416.70 108.50 C 411.86 105.62 405.52 102.62 399.99 105.09 C 399.99 105.55 399.98 106.46 399.98 106.91 C 403.17 109.19 407.33 108.95 410.96 110.09 C 416.20 111.36 422.15 113.71 424.29 119.12 C 425.55 123.42 425.07 128.51 422.18 132.09 C 419.04 136.14 413.86 138.00 408.91 138.50 C 400.35 139.34 391.39 137.59 384.19 132.76 C 384.94 134.48 385.73 136.18 386.46 137.91 C 381.04 137.80 375.62 137.88 370.20 137.85 C 369.39 135.85 368.61 133.84 367.82 131.84 C 362.62 131.85 357.41 131.83 352.20 131.85 C 351.44 133.85 350.69 135.85 349.93 137.85 C 340.05 137.85 330.17 137.89 320.30 137.82 C 317.51 133.58 314.73 129.33 311.87 125.13 C 311.08 125.13 309.50 125.15 308.71 125.15 C 308.73 129.38 308.71 133.61 308.78 137.83 C 303.79 137.88 298.79 137.84 293.80 137.86 C 293.73 122.98 293.86 108.09 293.95 93.21 M 308.71 105.75 C 308.73 108.66 308.73 111.57 308.70 114.48 C 312.16 114.27 315.98 115.21 319.14 113.41 C 321.86 111.93 321.49 107.24 318.51 106.27 C 315.36 105.26 311.96 105.91 308.71 105.75 M 359.58 110.98 C 358.61 114.53 357.30 117.97 355.81 121.33 C 358.63 121.31 361.45 121.31 364.27 121.33 C 362.81 118.11 361.77 114.72 360.48 111.45 C 360.26 111.33 359.81 111.09 359.58 110.98 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 74.11 95.70 C 75.77 93.70 78.49 94.00 80.28 95.66 C 83.17 95.25 84.58 98.00 87.05 98.91 C 88.12 101.14 91.24 103.37 89.54 106.03 C 87.73 109.44 84.08 111.21 80.82 112.95 C 80.63 113.41 80.26 114.33 80.08 114.79 C 78.45 115.00 76.50 116.10 74.98 115.14 C 71.67 110.79 64.44 109.44 63.96 103.04 C 66.14 101.52 66.56 98.20 69.54 97.80 C 70.54 96.16 72.22 95.48 74.11 95.70 M 74.97 112.47 C 74.44 113.98 75.03 114.57 76.76 114.24 C 77.30 112.72 76.71 112.13 74.97 112.47 Z" />
                        <path fill="#ffffff" opacity="1.00" d=" M 42.95 110.34 C 50.45 118.36 59.88 125.22 70.97 126.90 C 86.25 129.70 101.33 121.48 111.22 110.28 C 112.10 111.70 112.95 113.15 113.82 114.58 C 115.79 113.72 117.76 112.89 119.75 112.08 C 120.16 114.42 120.48 116.78 121.06 119.09 C 123.74 120.09 126.51 120.81 129.15 121.89 C 123.90 126.91 117.76 131.11 110.88 133.55 C 110.60 132.80 110.04 131.30 109.76 130.55 C 90.33 142.77 63.96 143.24 44.68 130.48 C 44.18 131.51 43.66 132.54 43.15 133.57 C 36.38 131.01 30.30 126.91 25.07 121.96 C 27.64 120.81 30.36 120.06 33.03 119.17 C 33.71 116.87 34.02 114.48 34.31 112.11 C 36.38 112.85 38.41 113.71 40.40 114.65 C 41.28 113.23 42.12 111.79 42.95 110.34 Z" />
                    </g>
                </svg>
                <!-- Logo 2017 -->
                <!-- <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="923.954px" height="341.982px" viewBox="0 0 923.954 341.982" enable-background="new 0 0 923.954 341.982"
                     xml:space="preserve">
<g>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M379.728,50.69c-13.47,3.4-25.522,8.861-32.952,21.594
        c-5.141,8.809-10.958,17.172-17.8,24.785c-5.624,6.258-5.593,6.275-13.307,2.969c-2.79-1.194-5.598-2.346-9.083-3.805
        c7.594,12.998,15.394,25.008,14.388,40.508c-1.897-1.832-3.257-4.055-5.868-3.199c-2.472,0.809-3.249,3.132-4.004,5.413
        c-0.77,2.325-0.35,4.137,1.604,5.685c1.193,0.943,2.146,2.188,3.324,3.155c1.315,1.081,1.729,2.255,1.453,3.986
        c-0.723,4.538-1.966,8.938-3.147,13.36c-2.154,8.063-4.287,16.131-6.489,24.428c-3.457-4.785-6.754-9.351-10.357-14.339
        c-2.182,10.21-2.013,19.733-0.301,29.226c4.229,23.45,14.385,43.773,32.188,59.932c6.314,5.729,13.469,10.207,21.535,13.068
        c2.396,0.85,5.013,1.493,7.105-0.824c2.029-2.247,0.961-4.552-0.021-6.83c-2.576-5.981-4.889-12.063-6.686-18.325
        c-2.292-7.987-3.796-16.054-2.201-24.408c1.374-7.193,5.207-13.196,9.163-19.132c6.166-9.254,11.814-18.777,15.666-29.261
        c0.429-1.168,1.218-2.301,0.945-3.872c-8.941,3.952-16.988,8.92-24.2,15.959c-2.047-11.958-4.816-23.086-8.388-34.001
        c-0.517-1.58,0.231-2.208,1.067-3.093c3.922-4.15,7.92-8.27,10.282-13.574c1.603-3.601,0.384-5.281-3.501-5.093
        c-3.401,0.164-6.591,1.246-9.715,2.49c-1.686,0.671-2.126,0.3-2.368-1.557c-0.713-5.454-0.227-10.784,1.074-16.065
        c3.339-13.554,10.28-25.382,17.78-36.94c7.161-11.036,15.408-21.279,23.143-31.897c0.206-0.219,0.485-0.446,0.059-0.693
        C380.067,50.313,379.86,50.567,379.728,50.69z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M110.926,249.362c-6.628,12.371-13.063,24.46-19.604,36.493
        c-0.859,1.58,0.02,2.175,0.916,3.017c7.896,7.415,16.368,14.099,25.541,19.859c31.098,19.534,64.827,27.548,101.283,22.136
        c32.543-4.831,60.241-19.765,84.186-42.048c1.362-1.267,1.271-2.149,0.478-3.608c-6.02-11.083-11.956-22.212-17.945-33.313
        c-0.402-0.745-0.547-1.728-1.611-2.188c-0.83,1.048-1.641,2.074-2.455,3.1c-7.582,9.556-16.133,18.122-26.119,25.165
        c-23.365,16.481-49.007,22.973-77.257,16.909c-22.111-4.746-40.302-16.481-55.99-32.436
        C118.359,258.389,114.736,254.004,110.926,249.362z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M198.783,11.14c-24.309-0.083-45.408,2.877-66.075,8.977
        c-15.069,4.448-29.541,10.358-43.532,17.472c-4.024,2.046-4.888,5.263-1.716,7.959c6.852,5.822,10.828,13.399,14.021,21.513
        c0.759,1.927,1.457,2.032,3.279,1.193c24.822-11.426,51.032-17.256,78.221-18.66c35.913-1.855,70.603,4.268,104.182,16.911
        c2.381,0.896,3.069,0.21,3.903-1.825c2.921-7.129,6.733-13.649,12.705-18.795c3.478-2.996,2.782-6.199-1.514-8.381
        C268.868,20.552,233.656,10.926,198.783,11.14z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M97.825,175.264c-3.705,5.13-6.968,9.647-10.5,14.538
        c-2.34-11.121-5.44-21.633-8.393-32.178c-1.509-5.388-1.365-9.655,3.701-13.181c2.812-1.956,2.276-6.7-0.511-9.657
        c-2.095-2.224-3.829-1.89-7.144,1.35c-0.092,0.091-0.349,0.012-0.633,0.012c-0.962-15.086,6.951-27.064,14.415-40.008
        c-5.107,2.201-9.455,3.897-13.63,5.943c-2.34,1.146-3.698,0.592-5.376-1.205c-7.897-8.454-14.907-17.59-20.563-27.652
        C41.843,60.149,29.71,54.43,16.125,50.685c-0.199-0.055-0.471,0.15-0.974,0.327c3.426,4.526,6.765,8.873,10.037,13.27
        c10.159,13.649,20.066,27.468,26.84,43.214c3.779,8.783,6.248,17.817,5.369,27.572c-0.261,2.894-1.034,3.078-3.44,2.074
        c-2.806-1.171-5.762-2.039-8.859-2.148c-3.74-0.133-4.927,1.439-3.54,4.891c1.267,3.151,3.466,5.727,5.505,8.4
        c1.962,2.572,5.647,4.393,5.983,7.412c0.332,2.973-1.611,6.193-2.531,9.312c-2.436,8.267-4.208,16.692-5.92,25.705
        c-7.277-7.046-15.286-12.087-24.576-16.025c1.516,4.798,3.261,8.797,5.084,12.765c4.182,9.105,9.954,17.27,15.295,25.682
        c5.465,8.608,7.65,17.827,5.959,27.979c-1.092,6.56-2.951,12.882-5.213,19.099c-1.32,3.626-2.856,7.175-4.299,10.756
        c-0.753,1.868-1.15,3.704,0.285,5.464c1.503,1.844,3.46,1.975,5.552,1.454c1.276-0.318,2.549-0.698,3.767-1.189
        c5.99-2.416,11.508-5.675,16.483-9.773c18.963-15.619,29.769-36.033,34.722-59.777C99.808,196.819,100.267,186.417,97.825,175.264z
        "/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M530.701,224.728c0,7.444,0.029,14.365-0.022,21.286
        c-0.012,1.545,1.13,1.768,2.104,2.221c7.726,3.589,15.942,4.784,24.363,4.966c7.402,0.16,14.674-0.57,21.527-3.589
        c10.612-4.676,16.782-12.697,17.553-24.396c0.752-11.399-4.09-19.834-14.059-25.435c-4.179-2.349-8.554-4.264-12.842-6.373
        c-3.466-1.704-7.031-3.241-10.168-5.541c-1.944-1.426-3.021-3.323-2.541-5.813c0.484-2.513,2.322-3.791,4.575-4.416
        c2.063-0.57,4.208-0.653,6.371-0.509c6.701,0.45,12.955,2.509,19.058,5.149c1.032,0.447,1.881,1.064,2.537-0.691
        c2.064-5.522,4.311-10.977,6.531-16.439c0.48-1.182,0.219-1.828-0.969-2.311c-14.229-5.787-28.789-8.27-43.854-3.83
        c-10.362,3.054-17.65,9.474-19.184,20.642c-1.626,11.838,1.773,21.774,12.442,28.399c3.728,2.316,7.652,4.231,11.627,6.065
        c3.784,1.745,7.649,3.334,11.189,5.566c2.559,1.613,4.438,3.67,3.826,7.006c-0.602,3.277-2.979,4.638-5.944,5.343
        c-3.335,0.795-6.691,0.597-10.033,0.183C546.55,231.191,538.767,228.602,530.701,224.728z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M847.335,224.796c0,6.991,0.085,13.584-0.056,20.172
        c-0.039,1.883,0.692,2.654,2.277,3.361c7.674,3.42,15.758,4.684,24.073,4.861c9.844,0.212,19.245-1.223,27.685-6.849
        c14.915-9.943,16.346-35.504-0.443-45.316c-4.493-2.626-9.139-4.882-13.816-7.112c-3.67-1.75-7.403-3.404-10.765-5.716
        c-2.109-1.451-3.683-3.386-3.01-6.171c0.678-2.807,2.829-4.103,5.514-4.6c1.909-0.354,3.835-0.417,5.784-0.272
        c6.588,0.487,12.755,2.491,18.728,5.161c1.382,0.617,2.075,0.617,2.673-0.98c2.029-5.424,4.15-10.814,6.36-16.168
        c0.507-1.227,0.398-1.781-0.827-2.287c-13.9-5.742-28.205-8.197-42.958-4.201c-11.052,2.992-18.836,9.641-20.29,21.731
        c-1.428,11.868,2.431,21.431,12.916,27.866c3.65,2.241,7.5,4.071,11.368,5.884c4.046,1.896,8.252,3.493,11.919,6.119
        c2.107,1.51,3.557,3.458,3.098,6.198c-0.492,2.932-2.496,4.608-5.243,5.349c-1.46,0.394-3,0.582-4.515,0.66
        c-4.516,0.23-8.921-0.561-13.309-1.54C858.646,229.641,853.14,227.352,847.335,224.796z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M646.982,215.444c0-10.906,0.104-21.814-0.068-32.718
        c-0.046-2.935,0.467-4.103,3.748-3.913c5.588,0.322,11.209,0.014,16.813,0.13c1.877,0.04,2.431-0.491,2.384-2.393
        c-0.133-5.399-0.101-10.804-0.014-16.204c0.026-1.65-0.342-2.318-2.165-2.314c-22.221,0.057-44.441,0.053-66.662,0.005
        c-1.692-0.004-2.305,0.421-2.27,2.206c0.107,5.502,0.111,11.01-0.002,16.511c-0.037,1.804,0.6,2.208,2.271,2.183
        c5.707-0.089,11.421,0.114,17.122-0.098c2.738-0.104,3.521,0.609,3.504,3.447c-0.13,22.221-0.031,44.441-0.13,66.662
        c-0.011,2.439,0.65,3.081,3.046,3.02c6.52-0.166,13.049-0.158,19.568-0.002c2.291,0.056,2.934-0.578,2.909-2.886
        C646.917,237.869,646.982,226.657,646.982,215.444z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M522.658,91.716c0,15.998,0.043,31.994-0.049,47.99
        c-0.013,2.225,0.452,2.948,2.835,2.89c7.434-0.181,14.876-0.151,22.311-0.012c2.091,0.038,2.515-0.646,2.512-2.577
        c-0.052-32.196-0.058-64.393,0.011-96.59c0.005-2.17-0.84-2.449-2.679-2.428c-7.335,0.086-14.675,0.153-22.007-0.029
        c-2.499-0.063-2.998,0.742-2.984,3.072C522.705,59.927,522.658,75.821,522.658,91.716z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M198.492,57.003c-19.359,0.136-37.683,1.822-55.729,6.027
        c-12.131,2.827-23.771,7.04-34.931,12.561c-0.762,0.377-2.298,0.189-1.739,2.132c1.976,6.852,6.551,10.001,13.576,8.685
        c8.611-1.615,16.76-4.927,25.204-7.195c26.335-7.076,52.923-8.99,79.911-4.673c14.51,2.321,28.541,6.446,42.515,10.87
        c10.474,3.314,14.641,1.184,18.705-8.96c0.038-0.095,0.063-0.197,0.114-0.283c0.722-1.21,0.528-1.933-0.921-2.468
        c-2.762-1.019-5.423-2.312-8.178-3.354C251.436,60.672,224.781,57.35,198.492,57.003z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M773.127,128.396c0,3.938,0.028,7.398-0.017,10.858
        c-0.015,1.067,0.359,1.692,1.367,2.073c8.604,3.258,17.277,3.968,25.826,0.094c5.336-2.418,8.159-6.831,8.53-12.764
        c0.383-6.106-2.035-10.689-7.351-13.68c-2.3-1.295-4.718-2.377-7.062-3.595c-1.892-0.983-3.795-1.957-5.617-3.06
        c-1.224-0.74-1.831-1.937-1.443-3.404c0.35-1.326,1.368-2.019,2.658-2.201c1.198-0.172,2.43-0.289,3.634-0.219
        c3.079,0.18,6.046,1.006,8.815,2.295c1.721,0.801,2.514,0.534,3.109-1.238c0.746-2.212,1.604-4.396,2.568-6.521
        c0.677-1.486,0.579-2.24-1.139-2.879c-6.519-2.426-13.152-3.519-20.081-2.371c-7.138,1.184-12.015,5.393-13.153,11.408
        c-1.406,7.434,1.179,12.983,7.983,16.86c2.202,1.255,4.548,2.263,6.81,3.417c1.628,0.829,3.275,1.636,4.824,2.596
        c1.195,0.741,1.829,1.9,1.541,3.389c-0.281,1.453-1.222,2.271-2.592,2.711c-1.893,0.608-3.807,0.568-5.749,0.338
        C782.015,131.96,777.702,130.514,773.127,128.396z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M65.706,282.48c5.062,5.144,10.236,9.696,15.607,14.012
        c8.656,6.955,17.479,13.685,28.126,17.424c1.164,0.409,2.744,1.743,3.506-0.542c0.603-1.809,2.348-3.458-0.593-5.33
        c-8.09-5.146-15.387-11.352-22.43-17.862c-1.827-1.688-2.349-2.893-0.97-5.297c4.244-7.403,8.075-15.042,12.228-22.499
        c1.113-1.998,0.707-2.736-1.328-3.352c-3.01-0.912-5.966-2.008-8.925-3.085c-1.573-0.572-2.248-0.267-2.085,1.554
        c0.337,3.773-0.262,7.523-0.442,11.284c-0.134,2.798-1.404,4.537-3.914,5.895C78.588,277.873,72.329,280.145,65.706,282.48z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M329.87,282.52c-7.117-2.452-13.609-4.771-19.63-8.263
        c-1.83-1.061-2.916-2.288-3.109-4.412c-0.371-4.057-0.926-8.105-0.63-12.187c0.141-1.944-0.482-2.299-2.231-1.636
        c-2.94,1.117-5.9,2.211-8.917,3.09c-2.044,0.594-2.196,1.361-1.205,3.159c4.217,7.651,8.226,15.42,12.475,23.056
        c1.02,1.833,0.989,2.847-0.614,4.341c-7.242,6.747-14.863,13-23.066,18.538c-1.138,0.769-2.094,1.273-1.399,3.081
        c1.416,3.688,1.437,3.929,5.147,2.422C303.455,306.901,316.393,294.813,329.87,282.52z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M796.039,287.51c-0.006,0-0.011,0-0.017,0
        c0,5.1,0.084,10.201-0.019,15.297c-0.168,8.276-4.514,12.998-12.713,14.007c-8.03,0.988-14.532-2.906-16.439-9.927
        c-0.616-2.271-0.668-4.632-0.669-6.977c-0.007-9.587-0.025-19.176,0.019-28.761c0.007-1.541-0.156-2.417-2.096-2.432
        c-2.053-0.016-2.003,1.06-1.998,2.495c0.041,10.504-0.08,21.011,0.099,31.513c0.174,10.148,5.412,16.272,15.414,17.625
        c11.595,1.568,22.779-3.827,22.625-18.814c-0.104-10.197-0.037-20.397,0.009-30.597c0.006-1.443-0.181-2.24-1.947-2.207
        c-1.686,0.032-2.337,0.466-2.303,2.255C796.103,276.494,796.039,282.002,796.039,287.51z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M635.551,294.369c0,7.746,0.058,15.492-0.043,23.236
        c-0.023,1.854,0.436,2.426,2.36,2.397c7.744-0.116,15.491-0.066,23.236-0.032c1.53,0.006,2.708,0.103,2.666-2.13
        c-0.042-2.194-1.34-1.854-2.629-1.855c-6.421-0.006-12.843-0.059-19.262,0.035c-1.735,0.024-2.264-0.493-2.232-2.233
        c0.102-5.501,0.117-11.008-0.007-16.508c-0.042-1.904,0.537-2.412,2.409-2.371c5.603,0.121,11.212,0.129,16.813-0.023
        c1.232-0.033,3.491,1.352,3.529-1.722c0.041-3.261-2.364-1.841-3.681-1.878c-5.601-0.155-11.21-0.126-16.813-0.03
        c-1.709,0.029-2.295-0.448-2.252-2.209c0.113-4.583,0.139-9.174-0.009-13.757c-0.063-2.003,0.526-2.57,2.53-2.531
        c6.418,0.125,12.841,0.001,19.261,0.078c1.648,0.019,2.342-0.346,2.33-2.178c-0.012-1.854-0.96-1.889-2.311-1.884
        c-7.849,0.027-15.696,0.072-23.543-0.03c-1.881-0.025-2.424,0.494-2.398,2.389C635.612,278.876,635.551,286.622,635.551,294.369z"
    />
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M538.861,294.354c0,7.746,0.056,15.493-0.04,23.238
        c-0.023,1.831,0.399,2.44,2.346,2.412c7.744-0.119,15.491-0.066,23.237-0.036c1.517,0.006,2.719,0.133,2.677-2.116
        c-0.04-2.182-1.316-1.866-2.617-1.867c-6.421-0.003-12.843-0.057-19.264,0.034c-1.722,0.024-2.274-0.468-2.242-2.222
        c0.104-5.502,0.116-11.009-0.005-16.51c-0.041-1.892,0.517-2.419,2.4-2.381c5.909,0.122,11.822,0.058,17.734,0.035
        c1.217-0.005,2.626,0.514,2.672-1.762c0.05-2.426-1.438-1.953-2.792-1.956c-5.811-0.011-11.621-0.078-17.429,0.037
        c-1.937,0.038-2.667-0.413-2.593-2.498c0.161-4.479,0.146-8.971,0.006-13.45c-0.062-1.967,0.462-2.6,2.505-2.557
        c6.419,0.134,12.842,0.007,19.263,0.077c1.622,0.019,2.366-0.296,2.351-2.156c-0.016-1.83-0.917-1.911-2.292-1.905
        c-7.746,0.032-15.494,0.09-23.238-0.033c-2.107-0.033-2.77,0.502-2.73,2.682C538.944,279.063,538.861,286.709,538.861,294.354z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M588.982,294.229c0,7.75,0.004,15.5-0.003,23.25
        c-0.001,1.319-0.282,2.522,1.882,2.558c2.239,0.037,2.156-1.127,2.147-2.648c-0.03-5.813,0.099-11.629-0.068-17.435
        c-0.063-2.218,0.663-2.684,2.731-2.636c5.911,0.136,11.827,0.022,17.741,0.065c1.46,0.011,2.506,0.021,2.469-2.013
        c-0.035-1.919-1.079-1.817-2.366-1.813c-6.016,0.019-12.032-0.046-18.047,0.041c-1.778,0.026-2.556-0.38-2.513-2.351
        c0.118-5.401,0.144-10.812-0.011-16.211c-0.061-2.07,0.8-2.284,2.506-2.264c6.423,0.079,12.848,0.013,19.271,0.046
        c1.441,0.009,2.515,0.046,2.511-2c-0.005-1.994-0.99-2.057-2.476-2.049c-7.749,0.038-15.5,0.079-23.248-0.024
        c-1.973-0.026-2.612,0.478-2.578,2.543C589.061,278.934,588.982,286.582,588.982,294.229z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M724.127,296.452c0,7.136,0.061,14.271-0.042,21.403
        c-0.028,1.849,0.694,2.096,2.303,2.155c2.22,0.083,1.846-1.319,1.846-2.597c0.005-13.964,0.049-27.928-0.046-41.892
        c-0.014-2.096,0.468-2.822,2.657-2.718c3.864,0.184,7.745-0.011,11.616,0.082c1.516,0.036,2.192-0.271,2.131-1.98
        c-0.052-1.492-0.305-2.164-2.013-2.153c-10.906,0.07-21.813,0.061-32.718,0.006c-1.538-0.007-2.104,0.36-2.146,2.019
        c-0.046,1.869,0.719,2.146,2.319,2.109c3.973-0.093,7.951,0.052,11.923-0.068c1.748-0.052,2.228,0.51,2.205,2.229
        C724.072,282.182,724.125,289.317,724.127,296.452z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M689.617,294.541c0-7.647,0.009-15.294-0.01-22.94
        c-0.004-1.326,0.524-2.856-1.915-2.884c-2.305-0.025-2.069,1.271-2.067,2.734c0.012,15.293,0.011,30.586,0.001,45.879
        c0,1.45-0.265,2.742,2.07,2.705c2.445-0.04,1.906-1.546,1.91-2.861C689.628,309.629,689.617,302.085,689.617,294.541z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M753.874,244.42c2.378-7.271,4.751-14.479,7.094-21.697
        c6.75-20.789,13.516-41.571,20.181-62.388c0.628-1.961,1.407-2.658,3.547-2.626c9.584,0.141,19.17,0.112,28.755,0.017
        c1.831-0.02,2.631,0.544,3.199,2.288c9.721,29.764,19.5,59.508,29.306,89.244c0.622,1.885,0.776,2.777-1.821,2.714
        c-7.54-0.183-15.091-0.123-22.635-0.023c-1.852,0.024-2.668-0.454-3.091-2.373c-0.964-4.365-2.348-8.637-3.342-12.997
        c-0.39-1.704-0.988-2.322-2.797-2.302c-8.667,0.097-17.335,0.099-26.001-0.001c-1.787-0.021-2.434,0.539-2.833,2.26
        c-1.01,4.355-2.352,8.635-3.411,12.98c-0.423,1.735-1.065,2.459-3.036,2.445c-14.987-0.1-29.979-0.091-44.968-0.008
        c-1.913,0.01-2.884-0.686-3.797-2.278c-5.667-9.889-11.436-19.718-17.174-29.565c-1.141-1.955-5.114-3.248-7.046-2.287
        c-1.125,0.562-0.602,1.619-0.604,2.436c-0.041,9.586-0.095,19.171,0.023,28.755c0.029,2.217-0.442,3.014-2.83,2.953
        c-6.726-0.17-13.459-0.133-20.188-0.015c-2.029,0.035-2.549-0.588-2.545-2.589c0.063-29.57,0.063-59.142,0.002-88.713
        c-0.004-1.968,0.463-2.652,2.52-2.616c11.824,0.21,23.656-0.286,35.477,0.396c4.283,0.247,8.475,1.018,12.579,2.308
        c9.227,2.9,15.787,8.49,17.751,18.284c2.082,10.383-0.171,19.635-8.201,27.023c-1.121,1.031-2.357,1.947-3.604,2.827
        c-3.24,2.287-3.256,2.269-0.955,5.718c6.158,9.235,12.311,18.472,18.486,27.695C752.397,243.004,752.689,243.918,753.874,244.42z
         M799.326,174.655c-1.185,1.107-0.963,2.555-1.232,3.803c-2.345,10.844-5.209,21.557-8.104,32.26
        c-0.618,2.282-0.264,2.963,2.236,2.853c4.783-0.21,9.587-0.177,14.374-0.01c2.244,0.079,2.483-0.623,1.961-2.579
        C805.347,198.937,802.055,186.909,799.326,174.655z M708.216,177.483c0-0.043,0-0.084,0-0.126c-0.609,0-1.237,0.093-1.826-0.016
        c-2.662-0.495-3.217,0.727-3.071,3.165c0.213,3.544,0.056,7.109,0.056,10.666c0,8.596,0,8.596,8.677,7.127
        c6.218-1.051,9.344-4.977,9.212-11.563c-0.107-5.388-3.435-8.583-9.699-9.237C710.459,177.384,709.332,177.483,708.216,177.483z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M125.562,252.741c-9.275-11.936-15.235-25.133-18.081-39.751
        c-1.271-6.525-1.728-13.126-1.726-19.769c0.009-28.047-0.005-56.094,0.024-84.142c0.002-1.927,0.144-3.878,0.471-5.776
        c0.928-5.373,4.593-8.932,9.985-9.699c2.011-0.286,4.063-0.383,6.097-0.387c18.46-0.027,36.92-0.017,55.381-0.016
        c0.714,0,1.429-0.014,2.142,0.015c9.859,0.384,14.292,4.865,14.318,14.73c0.052,20.603,0.006,41.204,0.038,61.806
        c0.002,1.494-0.289,2.711-1.303,3.899c-22.102,25.907-44.168,51.848-66.24,77.78C126.337,251.82,126.011,252.21,125.562,252.741z
         M138.049,138.767c-5.534-0.877-10.813,2.566-15.326,7.735c-0.675,0.772-1.263,1.489-1.025,2.694
        c2.213,11.213,7.828,19.713,18.811,24.109c1.655,0.662,2.723,0.446,4.083-0.669c11.969-9.823,24.854-18.02,40.04-21.999
        c0.826-0.217,1.568-0.334,1.593-1.451c0.026-1.178-0.626-1.506-1.625-1.801C169.943,143.05,155.169,139.356,138.049,138.767z
         M115.968,215.246c16.412-26.565,37.049-48.179,65.021-62.11c-1.362,0.388-2.693,0.819-3.987,1.342
        c-11.932,4.807-22.327,12.059-32.065,20.316c-1.428,1.212-2.601,1.459-4.339,0.752c-5.384-2.188-10.166-5.193-13.65-9.903
        c-1.111-1.502-1.913-1.618-3.377-0.628c-2.946,1.988-5.983,3.844-9,5.727c-1.136,0.709-1.598,1.615-1.581,3.014
        c0.089,7.536-0.105,15.079,0.147,22.607C113.345,202.616,113.83,208.888,115.968,215.246z M161.72,139.182
        c6.736,1.755,13.309,3.479,19.894,5.159c0.565,0.144,1.382,0.669,1.63-0.568c0.438-2.188-2.203-9.104-4.191-10.311
        c-1.955-1.186-3.328-1.908,0.075-3.096c2.506-0.873,2.634-2.917,0.581-4.688c-0.767-0.662-1.573-1.196-2.044-2.186
        c-1.077-2.261-2.859-1.963-4.606-0.936c-0.856,0.503-1.565,1.214-2.502,1.674c-2.694,1.322-2.76,2.793-0.388,4.787
        c0.574,0.482,1.77,0.589,1.483,1.656c-0.294,1.097-1.435,1.122-2.305,1.042c-3.565-0.329-5.35,1.589-6.348,4.703
        C162.695,137.367,162.163,138.241,161.72,139.182z M144.395,116.075c-0.487-0.53-0.728-0.838-1.013-1.096
        c-2.632-2.395-5.194,1.65-6.353,0.853c-2.5-1.722-4.435-2.718-7.079-0.874c-1.582,1.102-2.968,2.413-4.514,5.012
        c4.759-2.92,8.972-5.429,11.939,1C139.152,118.136,140.584,115.585,144.395,116.075z M191.919,149.465
        c-0.494,0-1.055-0.154-1.459,0.032c-0.849,0.392-2.943-1.064-2.362,1.046c0.198,0.719,2.566-0.366,3.856-0.966
        C191.959,149.575,191.929,149.495,191.919,149.465z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M110.926,249.362c3.811,4.642,7.433,9.026,11.424,13.086
        c15.688,15.954,33.879,27.689,55.99,32.436c28.25,6.063,53.892-0.428,77.257-16.909c9.985-7.043,18.537-15.609,26.119-25.165
        c0.813-1.025,1.625-2.052,2.455-3.1c1.064,0.461,1.209,1.443,1.611,2.188c5.989,11.101,11.925,22.229,17.945,33.313
        c0.793,1.459,0.884,2.342-0.478,3.608c-23.944,22.283-51.642,37.217-84.186,42.048c-36.456,5.412-70.186-2.602-101.283-22.136
        c-9.173-5.761-17.645-12.444-25.541-19.859c-0.896-0.842-1.775-1.437-0.916-3.017C97.863,273.822,104.297,261.733,110.926,249.362z
        "/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M269.737,252.661c-5.418-6.354-10.77-12.621-16.11-18.898
        c-16.912-19.877-33.806-39.768-50.754-59.613c-1.189-1.393-1.792-2.721-1.785-4.607c0.071-20.292,0.049-40.585,0.037-60.877
        c-0.001-1.945,0.124-3.865,0.548-5.769c1.161-5.202,4.719-8.573,10.032-9.306c1.912-0.264,3.86-0.37,5.791-0.373
        c18.559-0.027,37.119-0.02,55.678-0.01c1.324,0.001,2.654,0.029,3.97,0.158c7.848,0.768,11.637,4.654,12.275,12.542
        c0.049,0.61,0.105,1.222,0.104,1.833c-0.036,30.285,0.13,60.572-0.194,90.854c-0.2,18.638-6.346,35.517-17.025,50.758
        c-0.526,0.75-1.079,1.48-1.632,2.211C270.438,251.873,270.169,252.157,269.737,252.661z M259.612,202.052
        c3.172,4.943,6.279,9.236,8.773,13.857c1.804,3.345,4.028,4.796,7.828,4.76c2.158-0.021,3.14-0.678,3.815-2.523
        c1.593-4.352,1.915-8.914,2.561-13.448c0.604-4.231-0.337-7.547-3.862-10.041c-0.11-0.078-0.09-0.339-0.129-0.515
        c4.175-0.561,4.175-0.561,4.175-4.963c0-1.835-0.091-3.674,0.025-5.502c0.108-1.693-0.435-2.348-2.215-2.291
        c-3.665,0.117-7.397-0.385-10.992,0.131c-5.588,0.803-8.649-2.688-12.659-6.313c7.267,0,13.849,0,20.432,0
        c5.709,0,5.661,0.002,5.442-5.737c-0.053-1.384-0.321-1.92-1.861-1.977c-3.938-0.146-7.743-0.016-10.826,2.873
        c-3.354,3.144-6.717,3.141-10.661,0.834c-2.749-1.607-5.659-3.672-8.947-3.541c-3.539,0.142-6.304-1.023-8.909-3.097
        c-0.095-0.076-0.112-0.25-0.167-0.382c0.505-0.146,0.971-0.279,1.503-0.432c-0.657-0.826-2.698-0.854-1.87-2.213
        c2.532-4.155-0.935-2.733-2.56-2.858c-1.723-0.133-3.47-0.13-5.194-0.007c-2.663,0.189-4.681-1.095-7.359-2.748
        c5.865,0,11.009,0,16.898,0c-10.876-3.422-21.53-3.128-31.795-4.372c0.906,2.544,3.73,3.36,6.027,4.086
        c2.695,0.852,5.863,0.192,8.08,2.669c-0.761,0.805-2.064-0.111-2.938,0.705c4.85,4.312,4.853,4.283,10.94,5.012
        c2.13,0.254,3.403,1.785,5.133,3.711c-2.33,0-4.073,0-6.785,0c2.167,1.977,3.892,3.165,5.102,4.747
        c1.742,2.276,3.798,2.917,6.575,2.787c4.695-0.221,7.483,1.616,10.169,6.263c-2.838,0-5.521,0-8.764,0
        c1.429,1.872,2.764,3.168,3.556,4.738c3.291,6.521,8.416,9.016,15.564,7.651c1.006-0.192,2.225-0.396,3.135,0.626
        c2.119,2.387,4.278,4.736,6.792,7.51C268.73,202.052,264.482,202.052,259.612,202.052z M259.365,153.126
        c8.023-0.048,14.533-6.671,14.463-14.714c-0.069-8.024-6.744-14.676-14.652-14.601c-7.947,0.074-14.539,6.812-14.472,14.79
        C244.773,146.66,251.349,153.175,259.365,153.126z M249.318,151.453c-0.564-0.131-0.742,0.45-0.951,0.815
        c-1.566,2.737-3.018,5.543-4.665,8.23c-0.918,1.496,0.156,1.715,1.053,2.123c6.108,2.776,12.24,5.504,18.321,8.34
        c1.189,0.555,2.056,0.424,3.092-0.254c2.984-1.945,5.991-3.859,9.047-5.687c1.214-0.726,1.394-1.429,0.821-2.718
        c-1.486-3.343-2.896-6.726-4.173-10.153c-0.709-1.905-1.273-1.89-2.881-0.694c-5.827,4.331-11.997,4.523-18.28,0.891
        C250.263,152.093,249.848,151.796,249.318,151.453z M243.878,133.212c-2.765,0.469-5.035,1.267-7.224,2.3
        c-6.693,3.158-8.438,5.681-6.876,14.804c0.243,1.416,0.948,1.856,2.229,1.929c3.769,0.213,7.457,0.94,11.107,1.864
        c1.224,0.311,2.285,0.219,2.657-1.175c0.371-1.387,2.5-2.285,0.91-4.248C243.095,144.254,242.495,139.149,243.878,133.212z
         M222.996,151.126c0.983,0.071,3.368,0.973,4.503,0.149c1.573-1.14-0.229-3.554,0.08-5.429c0.033-0.199,0.006-0.407,0.017-0.611
        c0.2-3.777,0.182-3.837-3.44-2.682c-1.633,0.521-3.234,1.226-4.74,2.047c-1.715,0.935-3.193,2.179-3.747,4.219
        c-0.39,1.438-0.299,2.413,1.586,2.322C218.882,151.063,220.516,151.126,222.996,151.126z M257.395,113.563
        c-2.755,0.007-5.214,1.701-5.485,3.858c-0.072,0.575-0.079,1.347,0.24,1.739c0.483,0.594,1.066-0.043,1.563-0.32
        c1.915-1.068,3.924-1.568,6.132-1.201c0.794,0.133,1.848,1.117,2.36,0.045c0.512-1.071-0.248-2.142-1.138-2.918
        C260.017,113.853,258.742,113.588,257.395,113.563z M251.729,123.856c4.245-1.754,8.262-2.083,12.77-0.922
        c-1.499-3.071-3.799-4.109-6.55-3.938C255.13,119.171,252.794,120.366,251.729,123.856z M208.298,150.849
        C208.879,150.788,208.589,150.817,208.298,150.849C208.59,150.871,208.883,150.894,208.298,150.849z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M198.783,11.14c34.873-0.214,70.084,9.412,103.472,26.363
        c4.296,2.182,4.992,5.385,1.514,8.381c-5.972,5.146-9.783,11.666-12.705,18.795c-0.834,2.035-1.522,2.722-3.903,1.825
        C253.583,53.86,218.893,47.737,182.98,49.593c-27.188,1.404-53.398,7.234-78.221,18.66c-1.822,0.839-2.52,0.733-3.279-1.193
        c-3.193-8.113-7.169-15.69-14.021-21.513c-3.172-2.696-2.308-5.913,1.716-7.959c13.991-7.113,28.463-13.023,43.532-17.472
        C153.375,14.017,174.475,11.057,198.783,11.14z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M97.825,175.264c2.441,11.153,1.983,21.556-0.171,31.882
        c-4.953,23.744-15.759,44.158-34.722,59.777c-4.976,4.099-10.493,7.357-16.483,9.773c-1.218,0.491-2.491,0.871-3.767,1.189
        c-2.091,0.521-4.049,0.39-5.552-1.454c-1.435-1.76-1.038-3.596-0.285-5.464c1.443-3.581,2.979-7.13,4.299-10.756
        c2.262-6.217,4.121-12.539,5.213-19.099c1.691-10.152-0.494-19.371-5.959-27.979c-5.341-8.412-11.113-16.576-15.295-25.682
        c-1.823-3.968-3.568-7.967-5.084-12.765c9.29,3.938,17.299,8.979,24.576,16.025c1.712-9.013,3.484-17.438,5.92-25.705
        c0.919-3.118,2.862-6.339,2.531-9.312c-0.336-3.02-4.021-4.84-5.983-7.412c-2.039-2.674-4.239-5.249-5.505-8.4
        c-1.388-3.451-0.201-5.023,3.54-4.891c3.097,0.109,6.053,0.978,8.859,2.148c2.406,1.004,3.18,0.819,3.44-2.074
        c0.879-9.755-1.589-18.789-5.369-27.572c-6.774-15.746-16.681-29.564-26.84-43.214c-3.272-4.396-6.61-8.743-10.037-13.27
        c0.503-0.177,0.775-0.382,0.974-0.327c13.584,3.745,25.717,9.465,33.066,22.541c5.655,10.063,12.665,19.198,20.563,27.652
        c1.679,1.797,3.036,2.352,5.376,1.205c4.176-2.046,8.523-3.742,13.63-5.943c-7.464,12.943-15.377,24.922-14.415,40.008
        c0.284,0,0.541,0.079,0.633-0.012c3.315-3.239,5.049-3.573,7.144-1.35c2.787,2.957,3.322,7.701,0.511,9.657
        c-5.066,3.525-5.21,7.793-3.701,13.181c2.953,10.545,6.053,21.057,8.393,32.178C90.857,184.911,94.121,180.394,97.825,175.264z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M380.055,51.034c-7.736,10.616-15.984,20.859-23.145,31.896
        c-7.5,11.559-14.441,23.387-17.78,36.94c-1.3,5.281-1.787,10.611-1.074,16.065c0.242,1.856,0.683,2.228,2.368,1.557
        c3.125-1.244,6.314-2.326,9.715-2.49c3.885-0.188,5.104,1.492,3.501,5.093c-2.362,5.305-6.36,9.424-10.282,13.574
        c-0.836,0.885-1.584,1.513-1.067,3.093c3.572,10.915,6.341,22.043,8.388,34.001c7.212-7.039,15.259-12.007,24.2-15.959
        c0.273,1.571-0.516,2.704-0.945,3.872c-3.852,10.483-9.5,20.007-15.666,29.261c-3.956,5.936-7.79,11.938-9.163,19.132
        c-1.595,8.354-0.091,16.421,2.201,24.408c1.797,6.262,4.11,12.344,6.686,18.325c0.982,2.278,2.05,4.583,0.021,6.83
        c-2.093,2.317-4.709,1.674-7.105,0.824c-8.066-2.861-15.221-7.339-21.535-13.068c-17.802-16.158-27.958-36.481-32.188-59.932
        c-1.712-9.492-1.881-19.016,0.301-29.226c3.604,4.988,6.901,9.554,10.357,14.339c2.202-8.297,4.335-16.364,6.489-24.428
        c1.181-4.423,2.424-8.822,3.147-13.36c0.276-1.731-0.138-2.905-1.453-3.986c-1.178-0.968-2.131-2.212-3.324-3.155
        c-1.954-1.548-2.374-3.359-1.604-5.685c0.755-2.281,1.533-4.604,4.004-5.413c2.61-0.855,3.97,1.367,5.868,3.199
        c1.006-15.5-6.794-27.51-14.388-40.508c3.485,1.459,6.294,2.61,9.083,3.805c7.714,3.307,7.683,3.289,13.307-2.969
        c6.842-7.613,12.66-15.977,17.8-24.785c7.43-12.732,19.482-18.193,32.952-21.594C379.835,50.808,379.944,50.923,380.055,51.034z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M612.438,39.583c6.67-0.119,13.238,0.645,19.576,2.73
        c14.718,4.841,23.519,15.225,27.13,30.023c3.241,13.28,3.271,26.688-0.361,39.9c-4.957,18.027-17.204,28.029-35.446,30.854
        c-8.822,1.365-17.694,1.272-26.419-0.791c-16.148-3.82-26.772-13.711-31.301-29.696c-4-14.121-4.05-28.399,0.171-42.485
        c5.218-17.41,17.416-26.875,35.08-29.77C604.703,39.72,608.567,39.593,612.438,39.583z M632.529,91.583
        c0.016-5.937-0.495-11.815-2.563-17.426c-2.948-7.996-8.928-12.092-17.521-12.203c-8.546-0.112-14.964,3.78-17.814,11.754
        c-4.248,11.886-4.27,24.018,0.045,35.893c2.848,7.834,9.352,11.629,18.009,11.449c8.678-0.182,14.554-4.318,17.403-12.324
        C632.061,103.184,632.536,97.416,632.529,91.583z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M519.018,142.526c-10.139,0-19.71-0.049-29.281,0.045
        c-1.702,0.017-2.252-0.932-2.934-2.106c-6.276-10.823-12.578-21.631-18.877-32.441c-1.178-2.022-5.563-3.331-7.637-2.277
        c-1.246,0.634-0.682,1.807-0.686,2.724c-0.043,10.294-0.104,20.59,0.029,30.883c0.032,2.42-0.389,3.326-3.082,3.248
        c-7.332-0.215-14.678-0.146-22.014-0.026c-1.931,0.032-2.352-0.56-2.349-2.398c0.055-32.21,0.047-64.42,0.016-96.63
        c-0.001-1.631,0.054-2.619,2.211-2.564c13.546,0.334,27.111-0.517,40.647,0.583c4.479,0.363,8.867,1.249,13.1,2.778
        c19.05,6.878,25.004,30.949,11.412,46.085c-2.261,2.519-4.742,4.853-7.732,6.4c-2.283,1.183-1.882,2.126-0.699,3.878
        c8.715,12.906,17.332,25.88,25.976,38.835C517.668,140.364,518.184,141.212,519.018,142.526z M459.578,73.312
        c0,3.255-0.009,6.51,0.004,9.764c0.005,0.893-0.176,1.904,1.272,1.902c4.163-0.007,8.356,0.244,12.249-1.695
        c4.477-2.229,6.609-7.002,5.803-12.973c-0.566-4.184-3.563-6.953-8.469-7.955c-2.92-0.596-5.865-0.469-8.809-0.574
        c-1.606-0.059-2.133,0.479-2.082,2.074C459.648,67.004,459.577,70.159,459.578,73.312z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M523.269,204.112c-0.029,7.154-0.55,13.546-2.304,19.771
        c-4.695,16.669-17.146,27.006-34.461,28.809c-7.767,0.808-15.46,0.729-23.085-1.106c-14.759-3.554-24.372-12.627-28.582-27.164
        c-3.681-12.709-3.717-25.604-0.26-38.338c4.487-16.522,16.719-26.704,33.797-28.813c7.856-0.97,15.685-0.925,23.413,0.829
        c17.318,3.93,28.067,16.075,30.593,34.23C522.957,196.485,523.135,200.651,523.269,204.112z M496.68,203.472
        c0.12-1.94-0.292-5.292-0.827-8.607c-0.354-2.195-0.944-4.392-1.731-6.474c-2.626-6.944-8.044-10.717-15.406-10.921
        c-8.168-0.229-14.107,3.014-16.826,10.146c-4.33,11.355-4.361,22.97-0.025,34.335c2.711,7.1,8.486,10.19,16.883,9.982
        c7.57-0.188,12.813-3.828,15.438-10.794C496.154,215.91,496.581,210.437,496.68,203.472z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M197.875,179.241c5.145,6.047,10.292,12.08,15.422,18.127
        c16.618,19.591,33.205,39.209,49.89,58.742c1.498,1.754,1.543,2.671-0.094,4.364c-35.781,36.998-95,37.033-130.826,0.023
        c-1.186-1.225-2.132-2.021-0.515-3.907c21.891-25.544,43.681-51.176,65.499-76.782C197.38,179.654,197.55,179.534,197.875,179.241z
         M185.565,217.954c-2.065,1.438-4.012,2.704-5.866,4.095c-6.513,4.892-11.454,10.957-13.829,18.883
        c-2.096,6.99,2.697,18.3,9.187,21.737c0.09,0.048,0.167,0.126,0.262,0.156c1.604,0.533,2.815,1.604,3.889,2.855
        c1.748,2.034,4.012,3.148,6.622,3.413c1.786,0.182,3.291,0.808,4.802,1.735c4.681,2.875,9.406,2.846,14.118-0.036
        c0.943-0.577,1.966-1.314,3-1.399c3.883-0.32,7.001-1.888,9.49-4.884c0.552-0.665,1.458-1.082,2.267-1.481
        c4.112-2.031,10.62-11.703,10.833-16.217c0.033-0.705-0.063-1.423-0.167-2.126c-1.159-7.796-5.145-14.022-10.714-19.399
        c-2.913-2.813-6.353-4.92-9.872-7.313c0.581-0.378,0.925-0.563,1.226-0.804c0.516-0.412,1.557-0.346,1.498-1.252
        c-0.051-0.778-0.854-1.111-1.498-1.371c-0.939-0.377-1.91-0.752-2.901-0.907c-6.072-0.947-12.169-1.148-18.268-0.301
        c-1.702,0.235-3.389,0.656-5.041,1.139c-0.632,0.185-1.539,0.705-1.627,1.197c-0.158,0.886,0.76,1.278,1.545,1.584
        C184.862,217.392,185.148,217.67,185.565,217.954z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M530.701,224.728c8.065,3.874,15.849,6.464,24.09,7.483
        c3.342,0.414,6.698,0.612,10.033-0.183c2.965-0.705,5.343-2.065,5.944-5.343c0.611-3.336-1.268-5.393-3.826-7.006
        c-3.54-2.232-7.405-3.821-11.189-5.566c-3.975-1.834-7.899-3.749-11.627-6.065c-10.669-6.625-14.068-16.562-12.442-28.399
        c1.533-11.168,8.821-17.588,19.184-20.642c15.064-4.439,29.625-1.957,43.854,3.83c1.188,0.482,1.449,1.129,0.969,2.311
        c-2.221,5.463-4.467,10.917-6.531,16.439c-0.656,1.756-1.505,1.139-2.537,0.691c-6.103-2.641-12.356-4.699-19.058-5.149
        c-2.163-0.145-4.309-0.062-6.371,0.509c-2.253,0.625-4.091,1.903-4.575,4.416c-0.479,2.49,0.597,4.388,2.541,5.813
        c3.137,2.3,6.702,3.837,10.168,5.541c4.288,2.109,8.663,4.024,12.842,6.373c9.969,5.601,14.811,14.035,14.059,25.435
        c-0.771,11.698-6.94,19.72-17.553,24.396c-6.854,3.019-14.125,3.749-21.527,3.589c-8.421-0.182-16.638-1.377-24.363-4.966
        c-0.975-0.453-2.116-0.676-2.104-2.221C530.73,239.093,530.701,232.172,530.701,224.728z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M847.335,224.796c5.805,2.556,11.312,4.845,17.163,6.15
        c4.388,0.979,8.793,1.771,13.309,1.54c1.515-0.078,3.055-0.267,4.515-0.66c2.747-0.74,4.751-2.417,5.243-5.349
        c0.459-2.74-0.99-4.688-3.098-6.198c-3.667-2.626-7.873-4.224-11.919-6.119c-3.868-1.813-7.718-3.643-11.368-5.884
        c-10.485-6.436-14.344-15.998-12.916-27.866c1.454-12.091,9.238-18.739,20.29-21.731c14.753-3.996,29.058-1.541,42.958,4.201
        c1.226,0.506,1.334,1.061,0.827,2.287c-2.21,5.354-4.331,10.744-6.36,16.168c-0.598,1.598-1.291,1.598-2.673,0.98
        c-5.973-2.67-12.14-4.674-18.728-5.161c-1.949-0.145-3.875-0.081-5.784,0.272c-2.685,0.497-4.836,1.793-5.514,4.6
        c-0.673,2.785,0.9,4.72,3.01,6.171c3.361,2.312,7.095,3.966,10.765,5.716c4.678,2.23,9.323,4.486,13.816,7.112
        c16.789,9.813,15.358,35.373,0.443,45.316c-8.439,5.626-17.841,7.061-27.685,6.849c-8.315-0.178-16.399-1.441-24.073-4.861
        c-1.585-0.707-2.316-1.479-2.277-3.361C847.42,238.38,847.335,231.787,847.335,224.796z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M646.982,215.444c0,11.213-0.065,22.425,0.054,33.636
        c0.024,2.308-0.618,2.941-2.909,2.886c-6.52-0.156-13.049-0.164-19.568,0.002c-2.396,0.062-3.057-0.58-3.046-3.02
        c0.099-22.221,0-44.441,0.13-66.662c0.017-2.838-0.766-3.551-3.504-3.447c-5.701,0.212-11.415,0.009-17.122,0.098
        c-1.671,0.025-2.308-0.379-2.271-2.183c0.113-5.501,0.109-11.009,0.002-16.511c-0.035-1.785,0.577-2.21,2.27-2.206
        c22.221,0.048,44.441,0.052,66.662-0.005c1.823-0.004,2.191,0.664,2.165,2.314c-0.087,5.4-0.119,10.805,0.014,16.204
        c0.047,1.901-0.507,2.433-2.384,2.393c-5.604-0.116-11.225,0.192-16.813-0.13c-3.281-0.189-3.794,0.979-3.748,3.913
        C647.086,193.63,646.982,204.538,646.982,215.444z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M522.658,91.716c0-15.895,0.047-31.789-0.051-47.684
        c-0.014-2.33,0.485-3.135,2.984-3.072c7.332,0.183,14.672,0.115,22.007,0.029c1.839-0.021,2.684,0.258,2.679,2.428
        c-0.068,32.197-0.063,64.394-0.011,96.59c0.003,1.932-0.421,2.615-2.512,2.577c-7.435-0.14-14.877-0.169-22.311,0.012
        c-2.383,0.059-2.848-0.665-2.835-2.89C522.701,123.71,522.658,107.714,522.658,91.716z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M198.492,57.003c26.289,0.347,52.944,3.669,78.527,13.342
        c2.755,1.042,5.416,2.335,8.178,3.354c1.45,0.535,1.644,1.258,0.921,2.468c-0.051,0.086-0.076,0.188-0.114,0.283
        c-4.064,10.144-8.231,12.274-18.705,8.96c-13.975-4.424-28.005-8.549-42.515-10.87c-26.988-4.317-53.576-2.403-79.911,4.673
        c-8.444,2.269-16.593,5.58-25.204,7.195c-7.025,1.316-11.6-1.833-13.576-8.685c-0.56-1.942,0.977-1.755,1.739-2.132
        c11.16-5.521,22.799-9.733,34.931-12.561C160.81,58.825,179.133,57.139,198.492,57.003z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M677.979,117.423c0-7.534,0.062-15.069-0.041-22.604
        c-0.026-2.007,0.349-2.928,2.628-2.82c7.611,0.358,15.287-0.671,22.842,0.844c10.076,2.021,15.991,8.038,17.59,18.105
        c0.785,4.941,0.66,9.947-0.686,14.84c-2.886,10.479-11.187,16.877-22.782,17.307c-5.796,0.214-11.607,0-17.407,0.127
        c-1.811,0.039-2.194-0.607-2.177-2.279C678.021,133.103,677.979,125.263,677.979,117.423z M691.884,117.166
        c0,4.272-0.002,8.546,0.004,12.817c0.001,0.892-0.169,1.67,1.264,1.875c6.458,0.924,11.775-2.356,13.239-8.488
        c0.688-2.875,0.935-5.824,0.613-8.789c-0.907-8.361-4.358-11.348-12.761-11.311c-1.785,0.008-2.499,0.316-2.41,2.301
        C692.007,109.43,691.884,113.301,691.884,117.166z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M772.786,143.178c-4.742,0-9.023-0.066-13.3,0.035
        c-1.546,0.036-2.256-0.501-2.342-1.993c-0.012-0.194-0.145-0.38-0.197-0.576c-1.924-7.094-1.924-7.094-9.146-7.094
        c-1.327,0-2.652,0-3.978,0c-5.263,0-5.263,0-6.64,5.234c-1.156,4.395-1.156,4.395-5.728,4.395c-2.753,0-5.517-0.141-8.258,0.039
        c-2.737,0.179-2.043-1.134-1.525-2.721c4.664-14.307,9.275-28.631,13.918-42.945c1.87-5.764,1.889-5.758,7.94-5.758
        c3.467,0,6.936,0.027,10.401-0.016c1.2-0.014,2.027,0.106,2.488,1.521C761.795,109.818,767.24,126.313,772.786,143.178z
         M746.775,101.098c-1.802,7.284-3.492,14.11-5.248,21.204c3.178,0,6.196-0.036,9.215,0.02c1.176,0.021,1.384-0.489,1.129-1.475
        C750.204,114.396,748.541,107.942,746.775,101.098z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M773.127,128.396c4.575,2.118,8.888,3.564,13.464,4.107
        c1.942,0.23,3.856,0.271,5.749-0.338c1.37-0.44,2.311-1.258,2.592-2.711c0.288-1.488-0.346-2.647-1.541-3.389
        c-1.549-0.96-3.196-1.767-4.824-2.596c-2.262-1.154-4.607-2.162-6.81-3.417c-6.805-3.877-9.39-9.427-7.983-16.86
        c1.139-6.016,6.016-10.225,13.153-11.408c6.929-1.147,13.563-0.055,20.081,2.371c1.718,0.639,1.815,1.393,1.139,2.879
        c-0.965,2.125-1.822,4.31-2.568,6.521c-0.596,1.772-1.389,2.039-3.109,1.238c-2.77-1.289-5.736-2.115-8.815-2.295
        c-1.204-0.07-2.436,0.047-3.634,0.219c-1.29,0.183-2.309,0.875-2.658,2.201c-0.388,1.468,0.22,2.664,1.443,3.404
        c1.822,1.103,3.726,2.076,5.617,3.06c2.344,1.218,4.762,2.3,7.062,3.595c5.315,2.99,7.733,7.573,7.351,13.68
        c-0.371,5.933-3.194,10.346-8.53,12.764c-8.549,3.874-17.223,3.164-25.826-0.094c-1.008-0.381-1.382-1.006-1.367-2.073
        C773.155,135.794,773.127,132.333,773.127,128.396z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M65.706,282.48c6.623-2.336,12.883-4.607,18.78-7.799
        c2.509-1.357,3.779-3.097,3.914-5.895c0.18-3.761,0.78-7.511,0.442-11.284c-0.163-1.82,0.512-2.126,2.085-1.554
        c2.958,1.077,5.915,2.173,8.925,3.085c2.035,0.615,2.441,1.354,1.328,3.352c-4.153,7.457-7.984,15.096-12.228,22.499
        c-1.378,2.404-0.857,3.608,0.97,5.297c7.043,6.511,14.34,12.716,22.43,17.862c2.94,1.872,1.195,3.521,0.593,5.33
        c-0.762,2.285-2.342,0.951-3.506,0.542c-10.647-3.739-19.47-10.469-28.126-17.424C75.941,292.177,70.768,287.624,65.706,282.48z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M329.87,282.52c-13.477,12.294-26.415,24.382-43.18,31.189
        c-3.71,1.507-3.731,1.266-5.147-2.422c-0.695-1.808,0.262-2.313,1.399-3.081c8.203-5.538,15.824-11.791,23.066-18.538
        c1.603-1.494,1.634-2.508,0.614-4.341c-4.249-7.636-8.257-15.404-12.475-23.056c-0.991-1.798-0.839-2.565,1.205-3.159
        c3.017-0.879,5.977-1.973,8.917-3.09c1.749-0.663,2.372-0.309,2.231,1.636c-0.296,4.081,0.259,8.13,0.63,12.187
        c0.194,2.124,1.28,3.352,3.109,4.412C316.26,277.748,322.752,280.067,329.87,282.52z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M844.959,296.936c4.534,7.649,8.975,15.142,13.448,22.687
        c-3.432,1.108-5.255-0.095-6.788-2.956c-2.972-5.553-6.401-10.857-9.492-16.35c-0.955-1.696-1.941-2.602-4.015-2.401
        c-2.223,0.214-4.493,0.184-6.723,0.008c-2.074-0.162-2.812,0.394-2.743,2.624c0.171,5.604,0.031,11.217,0.071,16.826
        c0.011,1.559,0.024,2.673-2.173,2.662c-2.114-0.013-1.938-1.129-1.938-2.507c0.016-15.401,0.046-30.802-0.034-46.202
        c-0.011-1.982,0.47-2.663,2.525-2.581c5.792,0.231,11.638-0.435,17.36,0.901c6.731,1.573,10.372,5.391,10.822,11.117
        c0.621,7.896-1.988,12.521-8.686,15.402C846.131,296.366,845.68,296.596,844.959,296.936z M828.705,283.294
        c0,3.058-0.019,6.114,0.012,9.172c0.007,0.74-0.299,1.83,0.993,1.799c5.259-0.127,10.639,0.822,15.681-1.43
        c4.152-1.856,6.034-5.766,5.582-11.178c-0.365-4.373-2.656-7.043-7.265-8.255c-4.389-1.155-8.895-0.801-13.367-0.884
        c-1.438-0.026-1.663,0.727-1.649,1.908C828.729,277.382,828.705,280.338,828.705,283.294z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M519.59,319.619c-3.539,1.052-5.261-0.172-6.746-2.941
        c-3.068-5.723-6.61-11.188-9.825-16.836c-0.814-1.431-1.675-2.012-3.326-1.916c-3.136,0.181-7.251-1.041-9.161,0.52
        c-1.99,1.627-0.513,5.903-0.605,9.017c-0.104,3.461-0.124,6.932,0.015,10.39c0.075,1.873-0.734,2.117-2.336,2.157
        c-1.762,0.044-1.96-0.75-1.956-2.2c0.035-15.587,0.021-31.173,0.023-46.76c0-1.096-0.278-2.325,1.545-2.271
        c6.293,0.189,12.639-0.546,18.855,0.975c6.857,1.678,9.961,5.343,10.563,12.338c0.522,6.049-2.399,11.316-8.114,13.688
        c-2.418,1.005-2.1,1.792-0.988,3.601C511.606,306.013,515.516,312.748,519.59,319.619z M489.902,283.468
        c0,3.05-0.006,6.099,0.005,9.147c0.003,0.784-0.197,1.733,1.109,1.68c4.94-0.206,9.972,0.697,14.778-1.163
        c4.66-1.804,6.588-5.171,6.291-10.917c-0.255-4.951-2.312-7.521-7.221-8.812c-4.478-1.179-9.072-0.795-13.631-0.88
        c-1.418-0.026-1.336,0.86-1.334,1.798C489.906,277.37,489.902,280.419,489.902,283.468z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M870.412,319.643c2.877-7.158,5.748-14.285,8.605-21.417
        c3.695-9.225,7.393-18.447,11.054-27.685c0.428-1.081,0.681-2.023,2.211-1.979c1.235,0.036,1.503,0.759,1.84,1.622
        c6.425,16.417,12.855,32.833,19.37,49.47c-2.826,0.647-4.752,0.64-5.764-2.725c-1.311-4.354-3.313-8.496-4.877-12.78
        c-0.581-1.591-1.405-2.145-3.107-2.106c-5.195,0.115-10.398,0.113-15.594,0c-1.689-0.037-2.532,0.479-3.115,2.082
        c-1.526,4.19-3.494,8.237-4.781,12.494C875.292,319.796,873.609,320.579,870.412,319.643z M892.133,276
        c-2.801,7.18-5.436,13.919-8.055,20.663c-0.64,1.646,0.496,1.577,1.564,1.575c4.168-0.007,8.337-0.066,12.502,0.026
        c1.9,0.044,2.263-0.489,1.568-2.269C897.188,289.528,894.78,283.014,892.133,276z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M796.039,287.51c0-5.508,0.063-11.016-0.035-16.522
        c-0.034-1.789,0.617-2.223,2.303-2.255c1.767-0.033,1.953,0.764,1.947,2.207c-0.046,10.199-0.113,20.399-0.009,30.597
        c0.154,14.987-11.03,20.383-22.625,18.814c-10.002-1.353-15.24-7.477-15.414-17.625c-0.179-10.502-0.058-21.009-0.099-31.513
        c-0.005-1.436-0.055-2.511,1.998-2.495c1.939,0.015,2.103,0.891,2.096,2.432c-0.044,9.585-0.025,19.174-0.019,28.761
        c0.001,2.345,0.053,4.705,0.669,6.977c1.907,7.021,8.409,10.915,16.439,9.927c8.199-1.009,12.545-5.73,12.713-14.007
        c0.103-5.096,0.019-10.197,0.019-15.297C796.028,287.51,796.033,287.51,796.039,287.51z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M635.551,294.369c0-7.747,0.062-15.493-0.044-23.236
        c-0.025-1.895,0.518-2.414,2.398-2.389c7.847,0.103,15.694,0.058,23.543,0.03c1.351-0.005,2.299,0.029,2.311,1.884
        c0.012,1.832-0.682,2.196-2.33,2.178c-6.42-0.077-12.843,0.047-19.261-0.078c-2.004-0.039-2.594,0.528-2.53,2.531
        c0.147,4.583,0.122,9.174,0.009,13.757c-0.043,1.761,0.543,2.238,2.252,2.209c5.604-0.096,11.213-0.125,16.813,0.03
        c1.316,0.037,3.722-1.383,3.681,1.878c-0.038,3.073-2.297,1.688-3.529,1.722c-5.602,0.152-11.211,0.145-16.813,0.023
        c-1.872-0.041-2.451,0.467-2.409,2.371c0.124,5.5,0.108,11.007,0.007,16.508c-0.031,1.74,0.497,2.258,2.232,2.233
        c6.419-0.094,12.841-0.041,19.262-0.035c1.289,0.001,2.587-0.339,2.629,1.855c0.042,2.232-1.136,2.136-2.666,2.13
        c-7.745-0.034-15.492-0.084-23.236,0.032c-1.925,0.028-2.384-0.544-2.36-2.397C635.608,309.861,635.551,302.115,635.551,294.369z"
    />
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M538.861,294.354c0-7.645,0.083-15.291-0.052-22.934
        c-0.039-2.18,0.623-2.715,2.73-2.682c7.744,0.123,15.492,0.065,23.238,0.033c1.375-0.006,2.276,0.075,2.292,1.905
        c0.016,1.86-0.729,2.175-2.351,2.156c-6.421-0.07-12.844,0.057-19.263-0.077c-2.043-0.043-2.566,0.59-2.505,2.557
        c0.14,4.479,0.155,8.971-0.006,13.45c-0.074,2.085,0.656,2.536,2.593,2.498c5.808-0.115,11.618-0.048,17.429-0.037
        c1.354,0.003,2.842-0.47,2.792,1.956c-0.046,2.275-1.455,1.757-2.672,1.762c-5.912,0.022-11.825,0.087-17.734-0.035
        c-1.884-0.038-2.441,0.489-2.4,2.381c0.121,5.501,0.109,11.008,0.005,16.51c-0.032,1.754,0.521,2.246,2.242,2.222
        c6.421-0.091,12.843-0.037,19.264-0.034c1.301,0.001,2.577-0.314,2.617,1.867c0.042,2.249-1.16,2.122-2.677,2.116
        c-7.746-0.03-15.493-0.083-23.237,0.036c-1.946,0.028-2.369-0.581-2.346-2.412C538.917,309.847,538.861,302.1,538.861,294.354z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M433.204,294.098c0-7.643-0.008-15.286,0.009-22.929
        c0.003-1.058-0.354-2.421,1.469-2.374c6.395,0.164,12.848-0.622,19.156,1.01c6.218,1.606,9.645,5.538,10.332,11.697
        c0.767,6.884-2.021,12.465-7.717,15.248c-5.015,2.449-10.435,2.564-15.829,2.308c-2.632-0.126-3.5,0.503-3.36,3.284
        c0.26,5.184,0.018,10.392,0.109,15.587c0.027,1.592-0.42,2.113-2.048,2.079c-1.54-0.034-2.164-0.418-2.15-2.065
        C433.241,309.995,433.204,302.046,433.204,294.098z M437.339,284.042c0,3.16,0.052,6.321-0.024,9.479
        c-0.033,1.388,0.311,1.992,1.85,1.988c3.878-0.007,7.759,0.013,11.578-0.685c5.989-1.093,8.979-4.716,9.111-10.799
        c0.129-5.918-2.652-9.609-8.557-10.872c-4.102-0.877-8.314-0.61-12.49-0.633c-1.577-0.009-1.476,0.99-1.472,2.041
        C437.346,277.723,437.338,280.882,437.339,284.042z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M588.982,294.229c0-7.646,0.078-15.295-0.051-22.94
        c-0.034-2.065,0.605-2.569,2.578-2.543c7.748,0.104,15.499,0.063,23.248,0.024c1.485-0.008,2.471,0.055,2.476,2.049
        c0.004,2.046-1.069,2.009-2.511,2c-6.424-0.033-12.849,0.033-19.271-0.046c-1.706-0.021-2.566,0.193-2.506,2.264
        c0.154,5.399,0.129,10.81,0.011,16.211c-0.043,1.971,0.734,2.377,2.513,2.351c6.015-0.087,12.031-0.022,18.047-0.041
        c1.287-0.004,2.331-0.105,2.366,1.813c0.037,2.034-1.009,2.023-2.469,2.013c-5.914-0.043-11.83,0.07-17.741-0.065
        c-2.068-0.048-2.795,0.418-2.731,2.636c0.167,5.806,0.038,11.622,0.068,17.435c0.009,1.521,0.092,2.686-2.147,2.648
        c-2.164-0.035-1.883-1.238-1.882-2.558C588.986,309.729,588.982,301.979,588.982,294.229z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M724.125,296.452c0-7.135-0.053-14.271,0.038-21.404
        c0.022-1.72-0.457-2.281-2.205-2.229c-3.972,0.12-7.95-0.024-11.923,0.068c-1.601,0.037-2.365-0.24-2.319-2.109
        c0.042-1.658,0.607-2.025,2.146-2.019c10.905,0.055,21.812,0.064,32.718-0.006c1.708-0.011,1.961,0.661,2.013,2.153
        c0.062,1.709-0.615,2.017-2.131,1.98c-3.871-0.093-7.752,0.102-11.616-0.082c-2.189-0.104-2.671,0.622-2.657,2.718
        c0.095,13.964,0.051,27.928,0.046,41.892c0,1.277,0.374,2.68-1.846,2.597c-1.608-0.06-2.331-0.307-2.303-2.155
        C724.188,310.723,724.127,303.588,724.125,296.452z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M689.617,294.541c0,7.544,0.011,15.088-0.011,22.633
        c-0.004,1.315,0.535,2.821-1.91,2.861c-2.335,0.037-2.07-1.255-2.07-2.705c0.01-15.293,0.011-30.586-0.001-45.879
        c-0.002-1.463-0.237-2.76,2.067-2.734c2.439,0.027,1.911,1.558,1.915,2.884C689.626,279.247,689.617,286.894,689.617,294.541z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M379.728,50.69c0.132-0.123,0.339-0.377,0.384-0.352
        c0.426,0.247,0.147,0.475-0.058,0.695C379.944,50.923,379.835,50.808,379.728,50.69z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M191.919,149.465c0.01,0.03,0.041,0.11,0.035,0.112
        c-1.29,0.6-3.658,1.685-3.856,0.966c-0.582-2.11,1.513-0.654,2.362-1.046C190.864,149.311,191.425,149.465,191.919,149.465z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M208.298,150.849C208.883,150.894,208.59,150.871,208.298,150.849
        C208.589,150.817,208.879,150.788,208.298,150.849z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M184.916,247.525c-1.461,3.287-2.574,6.095-3.94,8.771
        c-1.105,2.168,0.021,3.505,1.436,4.713c1.753,1.498,3.824,2.384,6.184,1.94c0.778-0.147,0.724-1.13,0.92-1.796
        c0.645-2.18,1.293-4.359,2.151-6.479c0.468,2.326-0.38,4.432-0.994,6.525c-0.542,1.849,0.09,2.85,1.614,3.709
        c2.633,1.486,5.421,1.77,8.272,1.029c3.799-0.987,4.441-2.244,3.621-6.053c-0.373-1.729-1.094-3.422-0.917-6.059
        c1.481,2.745,1.788,5.081,2.331,7.297c0.453,1.843,1.498,2.205,3.093,1.874c1.516-0.314,2.911-0.906,4.1-1.927
        c1.76-1.51,2.631-2.959,1.27-5.47c-2.155-3.974-3.81-8.22-5.174-12.588c1.938,3.938,3.777,7.932,5.876,11.784
        c0.613,1.124,0.394,3.725,3.079,2.643c2.497-1.008,4.082-3.553,3.441-5.717c-0.316-1.066-0.805-2.084-1.236-3.114
        c-0.42-1.004-0.867-1.995-0.706-3.297c0.674,1.342,1.454,2.644,1.997,4.037c0.73,1.873,1.515,1.718,2.722,0.409
        c1.149-1.244,1.685-2.688,1.981-4.351c1.361,2.054,0.567,3.902-0.796,5.402c-1.319,1.45-2.007,3.238-3.07,4.747
        c-3.269,4.643-8.045,7.761-13.188,9.794c-2.027,0.802-4.25,1.063-6.219,2.41c-3.446,2.357-7.816,2.089-11.103-0.561
        c-1.336-1.076-2.557-1.911-4.327-1.565c-0.29,0.057-0.649,0.053-0.906-0.07c-5.23-2.497-10.182-5.441-13.483-10.354
        c-0.869-1.294-1.403-2.784-2.575-3.968c-1.72-1.736-2.398-3.884-1.43-6.373c0.542,2.505,1.521,4.687,3.853,6.225
        c1.551-2.84,3.04-5.566,4.529-8.292c0.146,0.072,0.291,0.146,0.436,0.219c-1.256,2.831-2.582,5.634-3.746,8.504
        c-0.908,2.238,1.906,6.165,4.287,6.214c1.151,0.023,1.194-0.918,1.536-1.578c1.398-2.708,2.759-5.435,4.142-8.149
        C184.015,247.939,184.152,247.916,184.916,247.525z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M218.172,243.779c-0.817-0.602-1.133-1.123-1.202-2.046
        C217.769,242.224,218.064,242.707,218.172,243.779z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M179.192,240.61c0.023-0.354,0.047-0.709,0.07-1.064
        c0.097,0.014,0.269,0.008,0.279,0.045c0.109,0.413-0.05,0.726-0.413,0.941L179.192,240.61z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M207.054,239.318c-0.02,0.087-0.04,0.176-0.06,0.264
        c-0.075-0.106-0.18-0.204-0.213-0.322c-0.016-0.055,0.109-0.147,0.17-0.224C206.986,239.13,207.02,239.224,207.054,239.318z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M186.34,243.45c-0.03,0.388-0.06,0.776-0.09,1.165
        c-0.146-0.057-0.412-0.102-0.417-0.169c-0.033-0.428,0.111-0.786,0.568-0.935L186.34,243.45z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M186.402,243.512c0.123-0.305,0.247-0.609,0.37-0.914
        c0.051,0.084,0.143,0.165,0.145,0.248c0.009,0.381,0.028,0.797-0.575,0.605C186.34,243.45,186.402,243.512,186.402,243.512z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M208.262,241.896c-0.004,0.064-0.004,0.129-0.004,0.193
        c-0.117-0.037-0.233-0.074-0.35-0.111c0.062-0.063,0.114-0.144,0.188-0.178C208.131,241.785,208.208,241.861,208.262,241.896z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M178.193,242.183c-0.095-0.06-0.207-0.131-0.319-0.202
        c0.06-0.062,0.138-0.186,0.177-0.174c0.125,0.034,0.235,0.12,0.35,0.187C178.337,242.052,178.273,242.108,178.193,242.183z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M179.128,240.532c-0.161,0.135-0.322,0.269-0.483,0.404
        c-0.024-0.086-0.048-0.173-0.072-0.259c0.205-0.024,0.409-0.05,0.616-0.071C179.192,240.61,179.128,240.532,179.128,240.532z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M218.531,244.139c0.058,0.127,0.143,0.259,0.168,0.4
        c0.01,0.052-0.118,0.131-0.183,0.197c-0.063-0.135-0.149-0.265-0.178-0.405C218.329,244.281,218.461,244.205,218.531,244.139z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M185.667,245.743c-0.074,0.08-0.136,0.146-0.198,0.212
        c-0.063-0.132-0.148-0.258-0.177-0.396c-0.011-0.052,0.112-0.131,0.174-0.196C185.533,245.491,185.601,245.62,185.667,245.743z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M207.507,240.969c-0.051-0.064-0.161-0.143-0.157-0.215
        c0.003-0.073,0.121-0.139,0.188-0.209c0.061,0.076,0.172,0.156,0.166,0.227C207.699,240.842,207.577,240.904,207.507,240.969z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M185.164,246.886c-0.129,0.068-0.255,0.155-0.394,0.187
        c-0.048,0.01-0.126-0.123-0.191-0.191c0.13-0.066,0.255-0.155,0.393-0.188C185.018,246.683,185.098,246.816,185.164,246.886z"/>
</g>
</svg>-->
            </div>

        </div>
    </div>
    <button id="bgBtn" onclick="myFunction()">
        <i class="icon-pause position-right tamanhoPlayPause">
        </i>
    </button>

    <script>
        var video = document.getElementById("videoPlay");
        var btn = document.getElementById("bgBtn");

        function myFunction() {
            if (video.paused) {
                video.play();
                btn.innerHTML = "<i class=\"icon-pause position-right tamanhoPlayPause\"></i>";
            }
            else {
                video.pause();
                btn.innerHTML = "<i class=\"icon-play3 position-right tamanhoPlayPause\"></i>";
            }
        }
    </script>

</div>
<!-- /pageLoginView -->

<!-- Modal BUG-REPORT -->
<div id="modalBugReport" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Informar Problema!</h6>
            </div>

            <div class="modal-body">
                <!-- modal content -->

                <div class="form-horizontal" id="formCadSistema">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label col-sm-6">
                                        Sistema
                                        <span class="text-danger"></span>
                                    </label>
                                    <div class="col-sm-6">
                                        <select id="inputNomeSistema" name="inputNomeSistema"
                                                class="form-control select2"
                                                data-placeholder="Selecione o sistema" required>
                                            <option value="Ciente">Ciente</option>
                                            <option value="Jubarte">Jubarte</option>
                                            <option value="Siscec">Siscec</option>
                                            <option value="PmroPadrao">PmroPadrao</option>
                                            <option value="CDN">CDN</option>
                                            <option value="BancoDeEmpregos">BancoDeEmpregos</option>
                                            <option value="Delco">Delco</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-6">
                                        Pagina do sistema
                                        <span class="text-danger"></span>
                                    </label>
                                    <div class="col-sm-6">
                                        <input id="inputPaginaSistema" name="inputPaginaSistema"
                                               type="text" maxlength="16" class="form-control"
                                               placeholder="Pagina do sistema" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="printScreenThumbnail" style="width: 260px;height: 130px; background: rgba(128,128,128,0.34);display: block;">

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">
                            Descrição do Problema
                            <span class="text-danger"></span>
                        </label>
                        <div class="col-lg-10">
                            <textarea id="textareaDescricaoProblema" name="textareaDescricaoProblema" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="text-right">
                        <button id="btnSendBugReport" class="btn bg-blue  legitRipple">
                            Enviar
                        </button>
                    </div>

                </div>

                <!-- fim modal content -->
            </div>
        </div>
    </div>
</div>
<!-- /primary modal -->
<!-- Modais da MainView -->
<div id="defaultModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-large">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Selecione o Setor</h6>
            </div>
            <div class="modal-body">
                <!--<div id="treeViewContainer" class="mtvContainer"></div>-->
            </div>
        </div>
    </div>
</div>
<!-- /Modais da MainView -->
<!-- google  analytics --
<script src="https://www.googletagmanager.com/gtag/js" type="text/javascript"></script>-->
</body>
</html>