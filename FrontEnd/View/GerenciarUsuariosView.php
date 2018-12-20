<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ciente - Jubarte - Prefeitura Municipal de Rio das Ostras - RJ</title>

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

    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/defaults-pt_BR.min.js"></script>

    <!-- DEPENDENCIAS DA VIEW MODEL -->
    <script type="text/javascript" src="/cdn/utils/utils.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernBlockUI.js"></script>
    <script type="text/javascript" src="/cdn/utils/jubarte.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModalAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/LoaderAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/RESTClient.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernDataTable.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernTreeView.js"></script>

    <!-- VIEW MODEL -->
    <script type="text/javascript" src="/ViewModel/Constants.js"></script>
    <script type="text/javascript" src="/ViewModel/GerenciaUsuarioViewModel.js"></script>
    <script type="text/javascript" src="/ViewModel/Util/ExtencaoAPI.js"></script>

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
                                    <i class="icon-vcard position-left"></i>
                                    <span class="text-semibold">Gerenciar Usuários</span>
                                </h4>
                                <ul class="breadcrumb position-right"></ul>
                            </div>
                            <div class="heading-elements">
                                <!-- <a data-toggle="collapse" data-parent="#accordion-controls" aria-expanded="true" href="#blocoCadastrarUsuario" class="btn bg-orange btn-labeled heading-btn legitRipple"><b><i class="icon-user-plus"></i></b>Cadastrar</a> -->
                                <a id="btnNovo" data-parent="#accordion-controls" class="btn bg-orange btn-labeled heading-btn legitRipple"><b><i class="icon-user-plus"></i></b>Novo Usuário</a>
                                <a data-toggle="collapse" data-parent="#accordion-controls" aria-expanded="true" href="#blocoListarUsuariosCadastrados" class="btn bg-blue btn-labeled heading-btn legitRipple"><b><i class="icon-list"></i></b>Listar</a>
                            </div>
                        </div>
                    </div>
                    <!-- /page header -->

                    <!-- Content area -->
                    <div class="content">

                        <div class="panel-group accordion-sortable content-group-lg ui-sortable" id="accordion-controls">
                            <div class="panel panel-white" id="painelFormulario">
                                <a id='panel-form' data-toggle="collapse" data-parent="#accordion-controls" href="#blocoCadastrarUsuario" aria-expanded="true">
                                    <div class="panel-heading border3-darkOrange">
                                        <h6 class="panel-title">
                                            Cadastro de Usuário
                                        </h6>
                                    </div>
                                </a>
                                <div id="blocoCadastrarUsuario" class="panel-collapse collapse in" aria-expanded="true" style="">
                                    <div class="panel-body border3-orange">

                                        <!-- Form horizontal -->
                                        <div id='formUsuario' class="form-horizontal">
                                            <div class="form-horizontal">
                                                <fieldset class="content-group" id="fdsFormulario">
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-1">Sistema <span class="text-danger">*</span></label>
                                                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xl-11">
                                                            <select id="selectSistema" name="selectSistema" class="form-control" title="Selecione o sistema" required >
                                                                <option value=""/>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-1">Perfil <span class="text-danger">*</span></label>
                                                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xl-11">
                                                            <select id="selectPerfil" name="selectPerfil" class="form-control select2" title="Selecione o perfil" required >
                                                                <option value=""/>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-1">Lotação <span class="text-danger">*</span></label>
                                                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xl-11">
                                                            <input id="inputOrganograma" type="text" class="form-control cursor-pointer" placeholder="Selecione" required readonly >
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-1">Nome Completo <span class="text-danger">*</span></label>
                                                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xl-11">
                                                            <input id="inputNomePessoa" type="text" class="form-control cursor-pointer" placeholder="Selecione" required readonly >
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-1">Login <span class="text-danger">*</span></label>
                                                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xl-11">
                                                            <input id="inputUserLoginLDAP" type="text" class="form-control cursor-pointer" placeholder="Selecione" required readonly />
                                                        </div>
                                                    </div>

                                                    <div class="form-group" id="grupoAtivo">
                                                        <label class="control-label control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-1">Ativo</label>
                                                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xl-11">
                                                            <div class="jSwitch jSwitchAjustes">
                                                                <label>
                                                                    <input id="checkboxAtivo" name="checkboxAtivo" type="checkbox" checked>
                                                                    <span class="jThumb"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <div class="text-right">
                                                    <button id="btnSaveUsuario" class="btn btn-primary btn-sm btn-labeled btn-labeled-right heading-btn">Salvar <b><i class="icon-arrow-right14"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /form horizontal -->

                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-white">
                                <a id='panel-datatables' class="collapsed" data-toggle="collapse" data-parent="#accordion-controls" href="#blocoListarUsuariosCadastrados" aria-expanded="false">
                                    <div class="panel-heading border3-darkPrimary">
                                        <h6 class="panel-title">
                                            Listar Usuários Cadastrados
                                        </h6>
                                    </div>
                                </a>
                                <div id="blocoListarUsuariosCadastrados" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body border3-primary no-padding">
                                        <div class="modernDataTable">
                                            <table id="tableListaUsuario" >
                                                <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Login</th>
                                                    <th>Sistema</th>
                                                    <th>Perfil</th>
                                                    <th>Ativo</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
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
<!-- Modal Default -->
<div id="defaultModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-large">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Selecione...</h6>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<!-- Modal Default -->
</body>
</html>