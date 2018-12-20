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

    <!-- DEPENDENCIAS JUBARTE -->
    <link href="/cdn/Assets/css/jubarteStyle.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/jSwitch.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/jCheckBox.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/modernDataTable.css" rel="stylesheet" type="text/css"/>
    <link href="/cdn/Assets/css/ModernTreeView.css" rel="stylesheet" type="text/css">

    <!-- JS PLUGINS EXTRA PARA ESTA PAGINA -->
    <script type="text/javascript" src="/cdn/Vendor/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/select2/4.0.6/select2.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/moment.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/locale/pt-br.js"></script>
    <!-- /JS PLUGINS EXTRA PARA ESTA PAGINA -->

    <!-- DEPENDENCIAS DA VIEW MODEL -->
    <script type="text/javascript" src="/cdn/utils/utils.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernBlockUI.js"></script>
    <script type="text/javascript" src="/cdn/utils/jubarte.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModalAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/LoaderAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/RESTClient.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernTreeView.js"></script>

    <script type="text/javascript" src="/ViewModel/Constants.js"></script>
    <script type="text/javascript" src="/ViewModel/GerenciarMenusViewModel.js"></script>
</head>

<body class="sidebar-detached-hidden">

<div class="sidebar-xs has-detached-right">
    <!-- Main content -->
    <div class="containerInsideIframe">
        <!-- Page container -->
        <div class="page-container" id="pageContainer">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Header content -->
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4>
                                <i class="icon-menu7 position-left"></i>
                                <span class="text-semibold">Menus</span>
                            </h4>

                            <ul class="breadcrumb position-right">

                            </ul>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <button id="linkNovoMenu" class="btnSalvar btn bg-orange btn-labeled heading-btn legitRipple">
                                    <b><i class="icon-menu2"></i></b>Novo Menu
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /header content -->

                    <!-- Content area -->
                    <div class="content">


                        <div class="row">
                            <div class="col-sm-8">
                                <div class="panel panel-flat border3-grey">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">Cadastro de menu</h5>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a data-action="collapse"></a></li>
                                                <li><a data-action="reload"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <!-- Form horizontal -->
                                        <p class="content-group-lg">Tela para cadastramento de itens de menu dos sistemas da plataforma Jubarte.</p>

                                        <div class="form-horizontal" id="formCadMenu">
                                            <fieldset class="content-group">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Sistema <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <select name="idSistema" class="form-control select2" data-placeholder="Selecione o sistema" required>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Menu pai</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <input name="idPai" type="text" maxlength="16" class="form-control cursor-pointer" placeholder="Menu pai" data-content="null" readonly >
                                                            <span id="icoEraser" class="input-group-addon cursor-pointer" title="Apagar"><i class="icon-eraser"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Ícone</label>
                                                    <div class="col-sm-10">
                                                        <select name="icone" class="form-control select-icons" data-placeholder="Nenhum ícone selecionado">
                                                            <option value="null" selected>Nenhum ícone</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Label <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input name="label" type="text" maxlength="25" class="form-control" placeholder="Label do menu" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Rota</label>
                                                    <div class="col-sm-10">
                                                        <input name="rota" type="text" maxlength="255" class="form-control" placeholder="Rota do link">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Cor</label>
                                                    <div class="col-sm-10">
                                                        <input name="cor" type="text" maxlength="16" class="form-control" placeholder="Cor de exibição">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Ordem <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input name="ordem" type="text" maxlength="4" class="form-control mskInteger" placeholder="Ordem de exibição" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Ativo</label>
                                                    <div class="col-sm-10">
                                                        <div class="jSwitch jSwitchAjustes">
                                                            <label>
                                                                <input name="ativo" type="checkbox" checked>
                                                                <span class="jThumb"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <div class="text-right">
                                                <button name="btnApagarMenu" class="btn bg-slate btn-icon btn-sm legitRipple hidden"><i class="icon-trash-alt"></i></button>
                                                <!--<button name="btnApagarMenu" class="btn border-warning text-warning-600 btn-flat btn-sm btn-icon legitRipple hidden"><i class="icon-trash-alt"></i></button>-->
                                                <button name="btnSalvarMenu" class="btn btn-primary btn-sm btn-labeled btn-labeled-right heading-btn">Salvar <b><i class="icon-arrow-right14"></i></b></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">Exibição de menu</h5>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a data-action="collapse"></a></li>
                                                <li><a data-action="reload"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <!-- ModernTreeView -->
                                        <div id="treeViewContainer" class="mtvContainer">
                                            <div style="height:100px;">
                                                <div class="alert alert-info alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                                                    Primeiro <span class="text-semibold"> selecione o Sistema </span> no menu anterior.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /ModernTreeView -->
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

<!-- Modal treeView -->
<div id="modalTreeView" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Cadastro de Menu</h6>
            </div>

            <div class="modal-body">
                <h6 class="text-semibold">Selecione o Menu Pai</h6>
                <div id="treeViewModal" class="mtvContainer"></div>
            </div>
        </div>
    </div>
</div>
<!-- /primary modal -->


</body>
</html>