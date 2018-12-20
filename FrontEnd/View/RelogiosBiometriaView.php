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
    <!-- /ESTILO LIMITLESS -->

    <!-- JS CORE LIMITLESS -->
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/notifications/jgrowl.min.js"></script>
    <!-- /JS CORE LIMITLESS -->

    <!-- JS PLUGINS EXTRA PARA ESTA PAGINA -->
    <script type="text/javascript" src="/cdn/Vendor/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/defaults-pt_BR.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/ui/dragula.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/core/libraries/jquery_ui/full.min.js"></script>
    <!-- /JS PLUGINS EXTRA PARA ESTA PAGINA -->

    <!-- DEPENDENCIAS JUBARTE -->
    <link href="/cdn/Assets/css/jubarteStyle.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/jSwitch.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/jCheckBox.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/modernDataTable.css" rel="stylesheet" type="text/css"/>
    <!-- /DEPENDENCIAS JUBARTE -->

    <!-- DEPENDENCIAS DA VIEW MODEL -->
    <script type="text/javascript" src="/cdn/utils/utils.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernBlockUI.js"></script>
    <script type="text/javascript" src="/cdn/utils/jubarte.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModalAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/LoaderAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/RESTClient.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernDataTable.js"></script>
    <!-- /DEPENDENCIAS DA VIEW MODEL -->

    <!-- VIEW MODEL -->
    <script type="text/javascript" src="/ViewModel/Constants.js"></script>
    <script type="text/javascript" src="/ViewModel/GerenciaRelogioViewModel.js"></script>

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

                    <!-- Header content -->
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4>
                                <i class="icon-alarm position-left"></i>
                                <span class="text-semibold">Gerencia Relógio</span>
                            </h4>

                            <ul class="breadcrumb position-right"></ul>
                        </div>
                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <button data-toggle="collapse" data-parent="#accordion-controls" href="#blocoListarLocais" class="btn bg-orange btn-labeled heading-btn legitRipple">
                                    <b><i class="icon-office"></i></b>Listar Locais
                                </button>
                                <button data-toggle="collapse" data-parent="#accordion-controls" href="#blocoListarPessoas" class="btn bg-blue btn-labeled heading-btn legitRipple">
                                    <b><i class="icon-users4"></i></b>Listar Pessoas
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /header content -->

                    <!-- Content area -->
                    <div class="content">

                        <div class="panel-group accordion-sortable content-group-lg ui-sortable" id="accordion-controls">

                            <div class="panel panel-white" id="formPanel"><!-- painel 01 -->
                                <a id="linkOpenForm" data-toggle="collapse" data-parent="#accordion-controls" href="#blocoListarLocais" aria-expanded="true">
                                    <div class="panel-heading border3-darkOrange">
                                        <h6 class="panel-title">
                                            Listar Locais
                                        </h6>
                                    </div>
                                </a>
                                <div id="blocoListarLocais" class="panel-collapse collapse in" aria-expanded="true" style="">
                                    <div class="panel-body border3-orange no-padding">

                                        <!-- ModernDataTable -->
                                        <div class="modernDataTable">
                                            <table id="tableListSistema" class=" ">
                                                <thead>
                                                <tr>
                                                    <th>Local</th>
                                                    <th>Endereço</th>
                                                    <th>Observação</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div><!-- Fim ModernDataTable -->

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white" id="tableSistemas"><!-- painel 02 -->
                                <a class="collapsed" id="lnkTabela" data-toggle="collapse" data-parent="#accordion-controls" href="#blocoListarPessoas" aria-expanded="false">
                                    <div class="panel-heading border3-darkPrimary">
                                        <h6 class="panel-title">
                                            Listar Pessoas
                                        </h6>
                                    </div>
                                </a>
                                <div id="blocoListarPessoas" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body border3-darkPrimary">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Total de Colaboradores</h6>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="Procurar...">
                                                                <span class="input-group-addon cursor-pointer btnHover">
                                                            <i class="icon-search4"></i>
                                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="Filtrar pelo Organograma">
                                                                <span class="input-group-addon cursor-pointer btnHover">
                                                                    <i class="icon-trash-alt" title="Limpar Filtro"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 text-right">
                                                        <span class="btn bg-primary cursor-pointer btnHover">
                                                            <i class="icon-select2" title="Selecionar Todos"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-1 text-right">
                                                        <span class="btn bg-primary cursor-pointer btnHover">
                                                            <i class="icon-arrow-right14" title="Enviar para Local"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <ul class="connected-sortable droppable-area1" style="list-style-type: none; margin: 0; padding: 0;">
                                                    <li class="draggable-item panel p-10">Item 1</li>
                                                    <li class="draggable-item panel p-10">Item 2</li>
                                                    <li class="draggable-item panel p-10">Item 3</li>
                                                    <li class="draggable-item panel p-10">Item 4</li>
                                                    <li class="draggable-item panel p-10">Item 5</li>
                                                    <li class="draggable-item panel p-10">Item 6</li>
                                                    <li class="draggable-item panel p-10">Item 7</li>
                                                </ul>
                                            </div>

                                            <div class="col-md-6">
                                                <h6>Colaboradores Inseridas neste Local: </h6>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Procurar...">
                                                        <span class="input-group-addon cursor-pointer btnHover">
                                                            <i class="icon-search4"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <ul class="connected-sortable droppable-area2" style="list-style-type: none; margin: 0; padding: 0;">
                                                    <li class="draggable-item panel p-10">Item 8</li>
                                                    <li class="draggable-item panel p-10">Item 9</li>
                                                    <li class="draggable-item panel p-10">Item 10</li>
                                                    <li class="draggable-item panel p-10">Item 11</li>
                                                    <li class="draggable-item panel p-10">Item 12</li>
                                                    <li class="draggable-item panel p-10">Item 13</li>
                                                    <li class="draggable-item panel p-10">Item 14</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /sortable media list -->

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /content area -->

                </div><!-- /main content -->

            </div><!-- /page content -->

            <!-- Footer -->
            <div class="footer text-muted">
            </div>
            <!-- /footer -->

        </div><!-- /page container -->
    </div>
</div>
<template id="blocoExtensao">
    <div class="form-group blocoExtensao">
        <label class="control-label col-sm-2">
            Extensão <span class="text-danger">*</span>
            <span id="icoEraser" class="cursor-pointer" title="Apagar Extensão"><i class="icon-eraser"></i></span>
        </label>
        <div class="col-sm-10">
            <div class="extensao">
                <div class="row content-group-xs">
                    <div class="col-sm-2">
                        <input name="destino" type="text" class="form-control" placeholder="Nome extenção" title="Nome de requisição da extensão pela API" required>
                    </div>
                    <div class="col-sm-6">
                        <input name="rotaLeitura" type="text" class="form-control" placeholder="Rota de leitura" required>
                    </div>
                    <div class="col-sm-4">
                        <select name="metodoLeitura" class="form-control" title="Método de leitura" required>
                            <option value="put">PUT</option>
                            <option value="post">POST</option>
                            <option value="get">GET</option>
                            <option value="delete">DELETE</option>
                        </select>
                    </div>
                </div>
                <div class="row content-group-xs">
                    <div class="col-sm-2">
                        <select name="tipoExibicao" class="form-control" title="Tipo de exibição" required>
                            <option value="datatables">DataTables</option>
                            <option value="treeview">Treeview</option>
                            <option value="select">Select</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <input name="rotaExibicao" type="text" class="form-control" placeholder="Rota de exibição" required>
                    </div>
                    <div class="col-sm-4">
                        <select name="metodoExibicao" class="form-control" title="Método de exibição" required>
                            <option value="put">PUT</option>
                            <option value="post">POST</option>
                            <option value="get">GET</option>
                            <option value="delete">DELETE</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <input name="rotaGravacao" type="text" class="form-control" placeholder="Rota de gravação" required>
                    </div>
                    <div class="col-sm-4">
                        <select name="metodoGravacao" class="form-control" title="Método de gravação" required>
                            <option value="put">PUT</option>
                            <option value="post">POST</option>
                            <option value="get">GET</option>
                            <option value="delete">DELETE</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
</body>
</html>
<!--
                <div class="row content-group-xs">
                    <div class="col-sm-5">
                        <input name="rotaLeitura" type="text" class="form-control" placeholder="Rota leitura" required>
                    </div>
                    <div class="col-sm-2">
                        <select name="metodoLeitura" class="form-control" title="Método leitura" required >
                            <option value="put">PUT</option>
                            <option value="post">POST</option>
                            <option value="get">GET</option>
                            <option value="delete">DELETE</option>
                        </select>
                    </div>
                    <div class="col-sm-5">
                        <input name="paramLeitura" type="text" class="form-control" placeholder="Parâmetro de Leitura" title="Parâmetro de Leitura" required>
                    </div>
                </div>
                <div class="row content-group-xs">
                    <div class="col-sm-3">
                        <input name="rotaGravacao" type="text" class="form-control" placeholder="Rota gravação" required>
                    </div>
                    <div class="col-sm-3">
                        <select name="metodoGravacao" class="form-control select2" title="Método gravação" required >
                            <option value="put">PUT</option>
                            <option value="post">POST</option>
                            <option value="get">GET</option>
                            <option value="delete">DELETE</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select name="modoGravacao" class="form-control" title="Modo gravação" required >
                            <option value="simples">Seleção simples</option>
                            <option value="multiplo">Seleção múltipla</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input name="valorGravacao" type="text" class="form-control" placeholder="Valor gravação" title="Valor a ser enviado para a rota de gravação" required >
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <input name="rotulo" type="text" class="form-control" placeholder="Rótulo" title="Label do input ou select" required >
                    </div>
                    <div class="col-sm-3">
                        <input name="valorExibido" type="text" class="form-control" placeholder="Valor Exibido" title="Valor exibido no input ou select" required>
                    </div>
                    <div class="col-sm-3">
                        <select name="tipoExibicao" class="form-control" title="Tipo de Exibição" required >
                            <option value="datatables">DataTables</option>
                            <option value="treeview">Treeview</option>
                            <option value="select">Select</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input name="destino" type="text" class="form-control" placeholder="Destino extensão" title="Para que a tela/view será destinado esta extensão" required >
                    </div>
                </div>
-->