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
    <link href="/cdn/Vendor/limitless/material/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Vendor/limitless/material/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Vendor/limitless/material/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Vendor/limitless/material/css/core.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Vendor/limitless/material/css/components.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Vendor/limitless/material/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /ESTILO LIMITLESS -->

    <!-- JS CORE LIMITLESS -->
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/moment.js"></script>
    <!-- /JS CORE LIMITLESS -->

    <!-- PERFECT-SCROLLBAR -->
    <script type="text/javascript" src="/cdn/Vendor/perfect-scrollbar-1.3.0/perfect-scrollbar.js"></script>
    <link href="/cdn/Vendor/perfect-scrollbar-1.3.0/perfect-scrollbar.css" rel="stylesheet" type="text/css">

    <!-- DEPENDEICIAS JUBARTE -->
    <link href="/cdn/Assets/css/jubarteStyle.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/modernDataTable.css" rel="stylesheet" type="text/css"/>

    <!-- DEPENDECIAS DA VIEW MODEL -->
    <script type="text/javascript" src="/cdn/utils/utils.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernBlockUI.js"></script>
    <script type="text/javascript" src="/cdn/utils/jubarte.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModalAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/LoaderAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/RESTClient.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernDataTable.js"></script>

    <!-- VIEW MODEL -->
    <script type="text/javascript" src="/ViewModel/Constants.js"></script>
    <script type="text/javascript" src="/ViewModel/IntranetViewModel.js"></script>

    <!-- Slider (Banner Principal) -->
    <link href="/cdn/Vendor/skitter-master/dist/skitter.css" type="text/css" media="all" rel="stylesheet"/>
    <script src="/cdn/Vendor/skitter-master/dist/jquery.easing.js"></script>
    <script src="/cdn/Vendor/skitter-master/dist/jquery.skitter.min.js"></script>

    <!-- Galeria de Fotos -->
    <link rel="stylesheet" href="/cdn/Vendor/magnific-popup/magnific-popup.css">
    <script src="/cdn/Vendor/magnific-popup/jquery.magnific-popup.js"></script>
    <script type="text/javascript">
        /* Script para Galeria de Fotos */
        $(document).ready(function () {
            $('.popup-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Carregando imagem #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">A imagem #%curr%</a> não pode ser carregada.',
                    titleSrc: function (item) {
                        return item.el.attr('title') + '<small></small>';
                    }
                }
            });
            $('.skitter-large').skitter({"navigation":true, "dots":false, "theme":"square", "height":250});
        });
        /* /Script para Galeria de Fotos */
    </script>

</head>
<body class="sidebar-detached-hidden">

<div class="sidebar-xs has-detached-right">
    <!-- Main content -->
    <div class="containerInsideIframe">
        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Page header -->
                    <div class="page-header">
                        <div class="page-header-content">
                            <div class="page-title">
                                <h4>
                                    <i class="icon-home2 position-left"></i>
                                    <span class="text-semibold">Bem-vindo(a) a Intranet da Prefeitura de Rio das Ostras</span>
                                </h4>
                                <ul class="breadcrumb position-right"></ul>
                            </div>
                            <div class="heading-elements">
                                <a href="login" class="btn bg-orange btn-labeled heading-btn legitRipple"><b><i class="icon-user-lock"></i></b>Login</a>
                                <a href="suporte" class="btn bg-blue btn-labeled heading-btn legitRipple"><b><i class="icon-comment-discussion"></i></b>Suporte</a>
                                <a href="creditos" class="btn bg-indigo btn-labeled heading-btn legitRipple"><b><i class="icon-info3"></i></b>Créditos</a>
                            </div>
                        </div>
                    </div>
                    <!-- /page header -->

                    <!-- Content area -->
                    <div class="content">

                        <div class="row">
                            <!-- Banners (Slider) -->
                            <div class="col-md-3">

                                <div class="skitter skitter-large with-dots">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="/cdn/Vendor/skitter-master/examples/images/example/dawn-sun-mountain-landscape.jpg" class="cut"/>
                                            </a>
                                            <div class="label_text">
                                                <p></p>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="/cdn/Vendor/skitter-master/examples/images/example/aurora-borealis-over-mountains-at-night.jpg" class="swapBlocks"/>
                                            </a>
                                            <div class="label_text">
                                                <p></p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <!-- /Banners (Slider) -->

                            <!-- Galeria de Fotos -->
                            <div class="col-md-3">
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title"><i class="icon-camera"></i> Fotos</h6>
                                        <div class="heading-elements" style="padding-top: 11px;">
                                            <a href="#"><i class="icon-images3"></i> mais...</a>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="popup-gallery">
                                                    <a href="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_b.jpg" title="The Cleaner"><img src="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_s.jpg"></a>
                                                    <a href="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_b.jpg" title="Winter Dance"><img src="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_s.jpg"></a>
                                                    <a href="http://farm9.staticflickr.com/8225/8558295635_b1c5ce2794_b.jpg" title="The Uninvited Guest"><img src="http://farm9.staticflickr.com/8225/8558295635_b1c5ce2794_s.jpg"></a>
                                                    <a href="http://farm9.staticflickr.com/8383/8563475581_df05e9906d_b.jpg" title="Oh no, not again!"><img src="http://farm9.staticflickr.com/8383/8563475581_df05e9906d_s.jpg"></a>
                                                    <a href="http://farm9.staticflickr.com/8235/8559402846_8b7f82e05d_b.jpg" title="Swan Lake"><img src="http://farm9.staticflickr.com/8235/8559402846_8b7f82e05d_s.jpg"></a>
                                                    <a href="http://farm9.staticflickr.com/8235/8558295467_e89e95e05a_b.jpg" title="The Shake"><img src="http://farm9.staticflickr.com/8235/8558295467_e89e95e05a_s.jpg"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Galeria de Fotos -->

                            <!-- Listar Telefones -->
                            <div class="col-md-6">
                                <div class="panel-body no-padding" style="height: 274px;">
                                    <!-- ModernDataTable -->
                                    <div class="modernDataTable">
                                        <table id="tableListPhones" class="">
                                            <thead>
                                            <tr>
                                                <th>Localidade</th>
                                                <th>Telefone / Ramal</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div><!-- Fim ModernDataTable -->
                                </div>
                            </div>
                            <!-- /Listar Telefones -->
                        </div>

                        <!-- Card de Notícias, Previsão do Tempo e Aniversariantes -->
                        <div class="row">

                            <div class="col-md-3">
                                <div class="panel panel-flat noticiasBITHome">
                                    <div class="panel-heading">
                                        <h6 class="panel-title"><i class="icon-newspaper"></i> Notícias - BIT</h6>
                                    </div>

                                    <div class="panel-body noticiasBITHomeIn">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <ul class="media-list content-group" id="bit-feed">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <!-- Aniversariantes -->
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title"><i class="fa fa-birthday-cake"></i> Aniversariantes - <span id='data_niver'></span></h6>
                                    </div>

                                    <!-- Tabs -->
                                    <ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-blue border-top border-top-primary" id='lista_niver'>
                                        <li class="">
                                            <a href="#aniversariantesOntem" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                                Ontem
                                            </a>
                                        </li>

                                        <li class="active">
                                            <a href="#aniversariantesHoje" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="true">
                                                Hoje
                                            </a>
                                        </li>

                                        <li class="">
                                            <a href="#aniversariantesAmanha" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                                Amanhã
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- /tabs -->


                                    <!-- Tabs content -->
                                    <div class="tab-content aniversariantesHome">
                                        <div class="tab-pane fade has-padding aniversariantesHomeOntem minW" id="aniversariantesOntem">
                                            <ul class="media-list">
                                                <li class="media">
                                                    <div class="media-left">
                                                        <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                                    </div>

                                                    <div class="media-body">
                                                        Ops! Não foi possível encontrar aniversariantes.
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-pane fade has-padding aniversariantesHomeHoje minW active in" id="aniversariantesHoje">
                                            <ul class="media-list">
                                                <li class="media">
                                                    <div class="media-left">
                                                        <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                                    </div>

                                                    <div class="media-body">
                                                        Ops! Não foi possível encontrar aniversariantes.
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-pane fade has-padding aniversariantesHomeAmanha minW" id="aniversariantesAmanha">
                                            <ul class="media-list">
                                                <li class="media">
                                                    <div class="media-left">
                                                        <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                                    </div>

                                                    <div class="media-body">
                                                        Ops! Não foi possível encontrar aniversariantes.
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /tabs content -->

                                </div>
                                <!-- /Aniversariantes -->
                            </div>


                            <div class="col-md-3">
                                <!-- Previsão do Tempo -->
                                <div class="panel panel-body bg-default has-bg-image">
                                    <div class="media no-margin">
                                        <div class="media-left media-middle">
                                            <img id="iconeTempo" src="">
                                        </div>

                                        <div class="media-body text-right">
                                            <h3 id="temperatura" class="no-margin"></h3>
                                            <span class="text-uppercase text-size-mini">Rio das Ostras</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Previsão do Tempo -->

                                <!-- Contra-Cheque - Demonstrativo de Pagamento de Salário -->
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title"><i class="icon-coins"></i> Contra-Cheque</h6>
                                    </div>
                                    <div class="panel-body">
                                        <form action="/proventos/logon_digitado.asp" method="post" target="_blank">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input name="UID" type="text" class="form-control" id="UID" value="" placeholder="Login"/>
                                                </div>
                                                <div class="col-md-12">
                                                    <input name="senha" type="password" class="form-control" id="senha" placeholder="Senha"/>
                                                </div>
                                                <div class="col-md-12 mt-20 text-right">
                                                    <button type="submit" class="btnPreencherEndereco btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">Entrar <b><i class="icon-arrow-right14"></i></b>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /Contra-Cheque - Demonstrativo de Pagamento de Salário -->

                                <div class="content-group">
                                    <div class="row row-seamless btn-block-group">
                                        <div class="col-xs-6">
                                            <a href="http://sali.pmro.rj.gov.br/" target="_blank">
                                                <button type="button" class="btn btn-default btn-block btn-float btn-float-lg legitRipple" style="border-bottom: solid 1px #dddddd;">
                                                    <i class="icon-gear text-warning"></i>
                                                    <span>Sali</span>
                                                </button>
                                            </a>

                                            <a href="https://jubarte.riodasostras.rj.gov.br/siscec/" target="_blank">
                                                <button type="button" class="btn btn-default btn-block btn-float btn-float-lg legitRipple">
                                                    <i class="icon-coin-dollar text-blue"></i>
                                                    <span>SISCEC</span>
                                                </button>
                                            </a>
                                        </div>

                                        <div class="col-xs-6">
                                            <a href="http://bit.riodasostras.rj.gov.br/" target="_blank">
                                                <button type="button" class="btn btn-default btn-block btn-float btn-float-lg legitRipple" style="border-bottom: solid 1px #dddddd;">
                                                    <i class="icon-qrcode text-blue"></i>
                                                    <span>BIT</span>
                                                </button>
                                            </a>

                                            <a href="http://ostrasprev.rj.gov.br/" target="_blank">
                                                <button type="button" class="btn btn-default btn-block btn-float btn-float-lg legitRipple">
                                                    <i class="icon-collaboration text-success"></i>
                                                    <span>Ostraprev</span>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Card de Notícias, Previsão do Tempo e Aniversariantes -->

                        <!-- Cards de Usuários -->
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="panel panel-body panel-body-accent">
                                    <div class="media no-margin">
                                        <div class="media-body">
                                            <h3 class="no-margin text-semibold" id="sistemas_ativos">0</h3>
                                            <span class="text-uppercase text-size-mini text-muted">Sistemas Integrados</span>
                                        </div>

                                        <div class="media-right media-middle">
                                            <i class="icon-display icon-3x text-orange"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="panel panel-body">
                                    <div class="media no-margin">
                                        <div class="media-body">
                                            <h3 class="no-margin text-semibold" id="usuarios_online"></h3>
                                            <span class="text-uppercase text-size-mini text-muted">Usuários Online</span>
                                        </div>

                                        <div class="media-right media-middle">
                                            <i class="icon-user icon-3x text-blue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="panel panel-body">
                                    <div class="media no-margin">
                                        <div class="media-body">
                                            <h3 class="no-margin text-semibold" id="usuarios_ativos">0</h3>
                                            <span class="text-uppercase text-size-mini text-muted">Usuários Ativos</span>
                                        </div>

                                        <div class="media-right media-middle">
                                            <i class="icon-user-check icon-3x text-indigo"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="panel panel-body">
                                    <div class="media no-margin">
                                        <div class="media-body">
                                            <h3 class="no-margin text-semibold" id="usuarios_cadastrados">0</h3>
                                            <span class="text-uppercase text-size-mini text-muted">Cadastros</span>
                                        </div>

                                        <div class="media-right media-middle">
                                            <i class="icon-users4 icon-3x text-grey"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Cards de Usuários -->

                        <!-- Cards de Solicitações -->
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="panel panel-body bg-orange has-bg-image">
                                    <div class="media no-margin">
                                        <div class="media-left media-middle">
                                            <i class="icon-enter6 icon-3x opacity-75"></i>
                                        </div>

                                        <div class="media-body text-right">
                                            <h3 class="no-margin" id="solicitacoes_abertas">0</h3>
                                            <span class="text-uppercase text-size-mini">Solicitações<br>Abertas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="panel panel-body bg-blue has-bg-image">
                                    <div class="media no-margin">
                                        <div class="media-left media-middle">
                                            <i class="icon-esc icon-3x opacity-75 rotate-90"></i>
                                        </div>

                                        <div class="media-body text-right">
                                            <h3 class="no-margin" id="solicitacoes_andamento">0</h3>
                                            <span class="text-uppercase text-size-mini">Solicitações<br>em Andamento</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="panel panel-body bg-indigo has-bg-image">
                                    <div class="media no-margin">
                                        <div class="media-left media-middle">
                                            <i class="icon-thumbs-up2 icon-3x opacity-75"></i>
                                        </div>

                                        <div class="media-body text-right">
                                            <h3 class="no-margin" id="solicitacoes_concluidas">0</h3>
                                            <span class="text-uppercase text-size-mini">Solicitações<br>Concluídas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="panel panel-body bg-grey has-bg-image">
                                    <div class="media no-margin">
                                        <div class="media-left media-middle">
                                            <i class="icon-archive icon-3x opacity-75"></i>
                                        </div>

                                        <div class="media-body text-right">
                                            <h3 class="no-margin" id="solicitacoes_total">0</h3>
                                            <span class="text-uppercase text-size-mini">Total de<br>Solicitações</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Cards de Solicitações -->

                    </div>
                    <!-- /content area -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->
            <!-- Footer -->
            <div class="footer text-muted">
            </div>
            <!-- /footer -->
        </div>
        <!-- /page container -->
    </div>
</div>

<template id="aniversariante">
    <li class="media">
        <div class="media-left">
            <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-xs foto" alt="">
        </div>

        <div class="media-body">
            <a href="#">
                <span class='nome'>Leonardo Calheiros</span>
            </a>
            <span class="display-block text-muted local">SEMAD/COTINF</span>
        </div>
    </li>
</template>
<template id="templateFeed">
    <li class="media stack-media-on-mobile">
        <div class="media-left">
            <div class="thumb">
                <a class="rssLink" href="http://bit.riodasostras.rj.gov.br/index.php/2018/04/17/como-nomear-seus-arquivos-de-trabalho/" target="_blank">
                    <img class="rssImage img-responsive img-rounded media-preview thumbnailBIT" src="http://bit.riodasostras.rj.gov.br/wp-content/uploads/2018/04/meme-nome-arquivo.png" alt="Como nomear seus arquivos de trabalho!?">
                    <span class="zoom-image"><i class="icon-newspaper"></i></span>
                </a>
            </div>
        </div>
        <div class="media-body">
            <h6 class="media-heading">
                <a class="rssLink" href="http://bit.riodasostras.rj.gov.br/index.php/2018/04/17/como-nomear-seus-arquivos-de-trabalho/" target="_blank">
                    <span class="rssTitle">Como nomear seus arquivos de trabalho!?</span>
                </a>
            </h6>
            <ul class="list-inline list-inline-separate text-muted mb-5">
                <li class="rssCategory">Administrativo</li>
                <li class="rssDate">17 de Abril de 2018</li>
            </ul>
            <p class="rssDescription">
                Para evitarmos a situação da tirinha acima, vamos apresentar boas práticas para nomear seus aquivos e pastas...
            </p>
        </div>
    </li>
</template>
</body>
</html>

<!--
select distinct nome, "dataNascimento", "siglaLocalTrabalho", (extract('YEAR' from current_date)||to_char(current_date,'MMDD'))::date as niver, to_char("dataNascimento",'MMDD')::integer as aniversario

from portal_rh.view_servidores

where to_char("dataNascimento",'MMDD')::integer BETWEEN to_char(current_date - '1day'::interval,'MMDD')::integer AND to_char(current_date + '1day'::interval,'MMDD')::integer

order by aniversario, nome;
-->