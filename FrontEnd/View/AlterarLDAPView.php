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

    <!-- DEPENDEICIAS JUBARTE -->
    <link href="/cdn/Assets/css/jubarteStyle.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/jSwitch.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/jCheckBox.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/modernDataTable.css" rel="stylesheet" type="text/css"/>
    <link href="/cdn/Assets/css/ModernTreeView.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="/cdn/Vendor/select2/4.0.6/select2.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/defaults-pt_BR.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/cropperjs/1.3.5/cropper.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/cropperjs/1.3.5/jQueryCropper.js"></script>

    <script type="text/javascript" src="/cdn/Vendor/webcamjs/1.0.25/webcam.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/moment.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/locale/pt-br.js"></script>
    <script type="text/javascript" src="/cdn/utils/jTimeline.js"></script>
    <link href="/cdn/Assets/css/jTimeline.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/ModernTreeView.css" rel="stylesheet" type="text/css">

    <!-- DEPENDECIAS DA VIEW MODEL -->
    <script type="text/javascript" src="/cdn/utils/utils.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernBlockUI.js"></script>
    <script type="text/javascript" src="/cdn/utils/jubarte.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModalAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/LoaderAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/RESTClient.js"></script>
    <script type="text/javascript" src="/cdn/utils/FormValidationAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernDataTable.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernTreeView.js"></script>

    <!-- VIEW MODEL -->
    <script type="text/javascript" src="/ViewModel/Constants.js"></script>
    <script type="text/javascript" src="/ViewModel/AlterarLDAPView.js"></script>

</head>
<body>
<!-- /page container -->
<div class="containerInsideIframe">
    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header">

                    <!-- Header content -->
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4>
                                <i class="icon-user-plus position-left"></i>
                                <span class="text-semibold">Alterar Senha de Usuário</span>
                            </h4>
                            <ul class="breadcrumb position-right">
                            </ul>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <button id="btnCadastrar" class="btn bg-orange btn-labeled heading-btn legitRipple">
                                    <b><i class="icon-floppy-disk"></i></b>Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /header content -->

                </div>
                <!-- /page header -->

                <!-- Content area -->
                <div class="content">


                    <!-- FORMS -->
                    <div class="row">
                        <div class="col-md-12 col-lg-12">

                            <div class="panel panel-flat border3-grey">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Todos os campos abaixo são obrigatórios.</h6>
                                </div>
                                <!-- form Pessoa -->
                                <div id="formPessoa" class="panel-body">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="text-center">
                                                <div class="icon-object border-orange-600 text-orange-600"><i class="icon-user-plus"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6 inputBlock">
                                                        <label>Nome Completo</label>
                                                        <input id="inputNomePessoa" data-toggle="modal" data-target="#modalListaLDAP" type="text" class="form-control" readonly data-type="string">
                                                        <small  class="help-block">

                                                        </small>
                                                    </div>
                                                    <div class="col-md-6 inputBlock">
                                                        <label>Login</label>
                                                        <input id="inputUserName" type="text" class="form-control" disabled data-type="string">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6 inputBlock ">
                                                        <label>Senha</label>
                                                        <input id="inputSenha" type="password" class="form-control " maxlength="100">
                                                        <small class="help-block">
                                                            Deve ter 8 a 20 caracteres.
                                                        </small>
                                                    </div>
                                                    <div class="col-md-6 inputBlock">
                                                        <label>Repetir Senha</label>
                                                        <input id="inputRepetirSenha" type="password" class="form-control" maxlength="100">
                                                        <small  class="help-block">

                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-info alert-styled-left">
                                                <!--<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>-->
                                                A senha deve conter pelo menos 8 caracteres, é recomendável que a senha não seja um nome ou telefone e que contenha caracteres alfanuméricos, incluindo letras maiúsculas, minúsculas, números e caracteres especiais.
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!-- /form Pessoa -->
                            </div>
                        </div>
                    </div>
                    <!-- /FORMS -->
                </div>

                <!-- Footer -->
                <div class="footer text-muted">

                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->
</div>
<!-- /page container -->

<!-- modalListaLDAP -->
<div id="modalListaLDAP" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-large">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">LISTA USUÁIOS</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="modernDataTable">
                            <table id="tableListaLoginLDAP" >
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    <th>CPF</th>
                                    <th>E-mail</th>
                                    <th>Descrição</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /modalListaLDAP -->

</body>
</html>
