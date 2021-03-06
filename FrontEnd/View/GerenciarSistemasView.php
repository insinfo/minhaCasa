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
    <script type="text/javascript" src="/ViewModel/GerenciarSistemasViewModel.js"></script>

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
                                <i class="icon-display position-left"></i>
                                <span class="text-semibold">Sistemas</span>
                            </h4>

                            <ul class="breadcrumb position-right"></ul>
                        </div>
                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <button data-toggle="collapse" data-parent="#accordion-controls" href="#blocoCadSistema" class="btnSalvar btn bg-orange btn-labeled heading-btn legitRipple">
                                    <b><i class="icon-database-add"></i></b>Cadastrar
                                </button>
                                <button data-toggle="collapse" data-parent="#accordion-controls" href="#blocoListarModeloEquipamento" class="btnSalvar btn bg-blue btn-labeled heading-btn legitRipple">
                                    <b><i class="icon-database-add"></i></b>Listar
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /header content -->

                    <!-- Content area -->
                    <div class="content">

                        <div class="panel-group accordion-sortable content-group-lg ui-sortable" id="accordion-controls">

                            <div class="panel panel-white" id="formPanel"><!-- painel 01 -->
                                <a id="linkOpenForm" data-toggle="collapse" data-parent="#accordion-controls" href="#blocoCadSistema" aria-expanded="true">
                                    <div class="panel-heading border3-darkOrange">
                                        <h6 class="panel-title">
                                            Cadastro de Sistemas
                                        </h6>
                                    </div>
                                </a>
                                <div id="blocoCadSistema" class="panel-collapse collapse in" aria-expanded="true" style="">
                                    <div class="panel-body border3-orange">

                                        <!-- Form horizontal -->
                                        <p class="content-group-lg">Tela para cadastramento de sistemas da plataforma Jubarte.</p>

                                        <div class="form-horizontal" id="formCadSistema">
                                            <fieldset class="content-group" id="fdsInputs">
                                                <div class="form-group original">
                                                    <label class="control-label col-sm-2">Sigla <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input id="inputSiglaSistema" name="sigla" type="text" maxlength="16" class="form-control" placeholder="Sigla do sistema" required>
                                                    </div>
                                                </div>

                                                <div class="form-group original">
                                                    <label class="control-label col-sm-2">Descrição <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <textarea id="textareaDescricaoSistema" name="descricao" class="form-control" placeholder="Descrição do sistema" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group original">
                                                    <label class="control-label col-sm-2">Ordem <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input id="inputOrdemSistema" name="ordem" maxlength="4" type="text" class="form-control mskInteger" placeholder="Ordem de visualização" required>
                                                    </div>
                                                </div>

                                                <div class="form-group original">
                                                    <label class="control-label col-sm-2">Ativo</label>
                                                    <div class="col-sm-10">
                                                        <div class="jSwitch jSwitchAjustes">
                                                            <label>
                                                                <input id="checkboxAtivoSistema" name="ativo" type="checkbox" checked>
                                                                <span class="jThumb"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="text-right">
                                                <button id="buttonAdiExtencao" class="btn btn-sm btn-labeled btn-labeled-right heading-btn">Adicionar Extensão <b><i class="icon-plus3"></i></b></button>
                                                <button id="buttonCadSistema" class="btn btn-primary btn-sm btn-labeled btn-labeled-right heading-btn">Salvar <b><i class="icon-arrow-right14"></i></b></button>
                                            </div>
                                        </div>
                                        <!-- /form horizontal -->

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white" id="tableSistemas"><!-- painel 02 -->
                                <a class="collapsed" id="lnkTabela" data-toggle="collapse" data-parent="#accordion-controls" href="#blocoListarModeloEquipamento" aria-expanded="false">
                                    <div class="panel-heading border3-darkPrimary">
                                        <h6 class="panel-title">
                                            Sistemas Jubarte
                                        </h6>
                                    </div>
                                </a>
                                <div id="blocoListarModeloEquipamento" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body border3-primary no-padding">

                                        <!-- ModernDataTable -->
                                        <div class="modernDataTable">
                                            <table id="tableListSistema" class=" ">
                                                <thead>
                                                <tr>
                                                    <th>Sigla</th>
                                                    <th>Descrição</th>
                                                    <th>Ordem</th>
                                                    <th>Ativo</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div><!-- Fim ModernDataTable -->

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
                        <input name="destino" type="text" class="form-control" placeholder="Nome extenção" title="Nome de requisição da extensão pela API" required >
                    </div>
                    <div class="col-sm-6">
                        <input name="rotaLeitura" type="text" class="form-control" placeholder="Rota de leitura" required>
                    </div>
                    <div class="col-sm-4">
                        <select name="metodoLeitura" class="form-control" title="Método de leitura" required >
                            <option value="put">PUT</option>
                            <option value="post">POST</option>
                            <option value="get">GET</option>
                            <option value="delete">DELETE</option>
                        </select>
                    </div>
                </div>
                <div class="row content-group-xs">
                    <div class="col-sm-2">
                        <select name="tipoExibicao" class="form-control" title="Tipo de exibição" required >
                            <option value="datatables">DataTables</option>
                            <option value="treeview">Treeview</option>
                            <option value="select">Select</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <input name="rotaExibicao" type="text" class="form-control" placeholder="Rota de exibição" required>
                    </div>
                    <div class="col-sm-4">
                        <select name="metodoExibicao" class="form-control" title="Método de exibição" required >
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
                        <select name="metodoGravacao" class="form-control" title="Método de gravação" required >
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