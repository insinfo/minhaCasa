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

    <!-- Editor de Texto -->
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/ckeditor/ckeditorFull/ckeditor.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/ckeditor/ckeditorFull/adapters/jquery.js"></script>

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
                                    <i class="icon-newspaper position-left"></i>
                                    <span class="text-semibold">Adicionar Nova Notícia</span>
                                </h4>
                                <ul class="breadcrumb position-right"></ul>
                            </div>
                            <div class="heading-elements">
                                <a href="#" class="btn bg-orange btn-labeled heading-btn legitRipple btn-solicitar mb-15">
                                    <b><i class="icon-file-plus"></i></b>Salvar Publicação
                                </a>
                                <a href="#" class="btn bg-blue btn-labeled heading-btn legitRipple btn-solicitar mb-15">
                                    <b><i class="icon-list"></i></b>Listar Todas
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /page header -->

                    <!-- Content area -->
                    <div class="content">

                        <div class="row">

                            <div class="col-md-9">
                                <div class="panel panel-flat">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" class="form-control" placeholder="Digite o título aqui">
                                        </div>
                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <div class="content-group">
                                                <textarea name="postSite" id="postSite"></textarea>
                                            </div>
                                            <script>
                                                CKEDITOR.replace('postSite');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="panel panel-flat">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="control-label correcaoAlturaLabel col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">Status</label>
                                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8" style="margin-top: 0;">
                                                            <select name="statusPublicacao" class="form-control">
                                                                <option value="">Publicado</option>
                                                                <option value="">Revisão Pendente</option>
                                                                <option value="">Rascunho</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="control-label correcaoAlturaLabel col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">Visibilidade</label>
                                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8" style="margin-top: 0;">
                                                            <select name="statusPublicacao" class="form-control">
                                                                <option value="">Público</option>
                                                                <option value="">Protegido por Senha</option>
                                                                <option value="">Privado</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="control-label correcaoAlturaLabel col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" title="Data e Horário da Publicação">Data</label>
                                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8" style="margin-top: 0;">
                                                            <input type="text" class="form-control" placeholder="00/00/0000 - 00:00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <a href="#" class="btn bg-grey btn-labeled heading-btn legitRipple btn-solicitar mb-15">
                                                        <b><i class="icon-trash-alt"></i></b>Excluir
                                                    </a>
                                                    <a href="#" class="btn bg-orange btn-labeled heading-btn legitRipple btn-solicitar mb-15">
                                                        <b><i class="icon-file-plus"></i></b>Salvar Publicação
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-flat">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="control-label correcaoAlturaLabel col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">Categorias</label>
                                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8" style="margin-top: 0;">
                                                            <input type="checkbox">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label title="Nome da Nova Categoria" class="control-label correcaoAlturaLabel col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">Nome</label>
                                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8" style="margin-top: 0;">
                                                            <input type="text" class="form-control" placeholder="Nome da Nova Categoria">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label title="Categoria Ascendente" class="control-label correcaoAlturaLabel col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">Categoria Pai</label>
                                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8" style="margin-top: 0;">
                                                            <select name="statusPublicacao" class="form-control">
                                                                <option value="">Categoria Ascendente</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <a href="#" class="btn bg-grey btn-labeled heading-btn legitRipple btn-solicitar mb-15">
                                                        <b><i class="icon-file-plus"></i></b>Adicionar Nova Categoria
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

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