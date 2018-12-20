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
    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/locale/pt-br.js"></script>
    <!-- /JS CORE LIMITLESS -->

    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/defaults-pt_BR.min.js"></script>

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
    <script type="text/javascript" src="/cdn/utils/ModernDataGrid.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernDataTable.js"></script>

    <!-- VIEW MODEL -->
    <script type="text/javascript" src="/ViewModel/Constants.js"></script>
    <script type="text/javascript" src="/ViewModel/ModeracaoCartaSenhaViewModel.js"></script>

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
                                    <i class="icon-envelop2 position-left"></i>
                                    <span class="text-semibold">Moderar Carta Senha</span>
                                </h4>

                                <ul class="breadcrumb position-right">

                                </ul>
                            </div>
                            <div class="heading-elements">
                                <!--
                                <a href="intranet" class="btn bg-orange btn-labeled heading-btn legitRipple"><b><i class="icon-home2"></i></b>Página Inicial</a>
                                <a href="suporte" class="btn bg-blue btn-labeled heading-btn legitRipple"><b><i class="icon-comment-discussion"></i></b>Suporte</a>
                                <a href="creditos" class="btn bg-indigo btn-labeled heading-btn legitRipple"><b><i class="icon-info3"></i></b>Créditos</a>
                                -->
                            </div>
                        </div>
                    </div>
                    <!-- /page header -->

                    <!-- Content area -->
                    <div class="content">

                        <!-- Tasks options -->
                        <div class="panel " style="border-radius: 0px;">
                            <div class="panel-body  " style="padding: 10px;">
                                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="icon-sort-amount-asc text-size-base text-muted"></i>
                                        </div>
                                        <select class="" name="selectFiltroOrder" id="selectFiltroOrder">
                                            <option value="asc" selected>Recentes</option>
                                            <option value="desc">Antigos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
                                    <div class="has-feedback has-feedback-left">
                                        <input id="inputSearch" type="text" class="form-control" placeholder="digite algo a ser pesquisado..." value="">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4 text-size-base text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3  ">
                                </div>

                               <div class="ol-xs-12 col-sm-6 col-md-3 col-lg-3 text-right">
                                   <div class="form-group mb-5">
                                       <button id="btnBuscar" class="btn bg-orange btn-icon legitRipple" title="Buscar">
                                           <i class="icon-search4"></i>
                                       </button>
                                       <button id="btnReload" class="btn bg-default btn-icon legitRipple" title="Recarregar">
                                           <i class="icon-reload-alt"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>

                       <!-- /tasks options -->
                        <!-- Cards  -->
                        <div id="gridContainer">
                            <div class="row">
                                <!-- Card item -->

                                <!-- /Card item -->
                            </div>
                        </div>
                        <!-- /Cards -->
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

<template id="templateCardCartaSenha">
    <div class="col-sm-6 col-md-3">
        <div class="panel panel-flat border-left-lg border-left-blue">
            <div class="panel-heading">
                <h6 class="panel-title  text-semibold"><span class="tipoDeConta">Rede</span></h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a><i class="icon-sphere icon-2x text-blue"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body ">
                <div class="row">
                    <div class="col-md-12">
                        <span class="no-margin  text-size-mini text-muted">Solicitante</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="text-uppercase text-size-mini text-semibold nomeSolicitante">
                            Leonardo Calheiros Oliveira<br>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="no-margin text-size-mini text-muted ">Organograma</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="text-uppercase text-semibold organogramaSigla">
                            SEMAD
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="no-margin text-size-mini text-muted ">Telefone do Setor</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="text-uppercase text-semibold telefoneSetor">
                            2777-2339
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="no-margin text-size-mini text-muted">Data Solicitação</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="text-uppercase text-muted dataSolicitacao">
                            11/09/2018
                        </span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <button class="btn btn-success btn-xs btnAtivar">Ativar</button>
                            <button class="btn btn-danger btn-xs  btnExcluir">Excluir</button>
                            <button class="btn btn-primary btn-xs btnExibir ">
                                <i class="icon-menu6"></i>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

</body>
</html>
