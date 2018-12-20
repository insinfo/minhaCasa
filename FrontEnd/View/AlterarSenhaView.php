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
    <script type="text/javascript" src="/ViewModel/AlterarSenhaViewModel.js"></script>
    <style>
        .img-container {
            text-align: center;
            width: 100%;
            max-height: 320px;
            min-height: 320px;
        }

        .img-container > img {
            max-width: 100%;
        }

        .img-preview {
            background: grey;
            z-index: 2;
            position: relative;
            top: -320px;
            left: 0;
            text-align: center;
            width: 70px;
            height: 70px;
            overflow: hidden;
        }

        .img-preview > img {
            max-width: 100%;
        }
    </style>
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
                            <h4><i class="icon-user position-left"></i> <span class="text-semibold">Alterar Senha</span></h4>
                            <ul class="breadcrumb position-right">
                            </ul>
                        </div>

                        <!--<div class="heading-elements">
                            <div class="heading-btn-group">
                                <button class="btnSalvar btn bg-orange btn-labeled heading-btn legitRipple">
                                    <b><i class="icon-floppy-disk"></i></b>Salvar Perfil
                                </button>
                            </div>
                        </div>-->
                    </div>
                    <!-- /header content -->

                </div>
                <!-- /page header -->

                <!-- Content area -->
                <div class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Alterar Senha</h6>
                                </div>
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="text-center">
                                                <div class="icon-object border-orange-600 text-orange-600"><i class="icon-key"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-warning alert-styled-left">
                                                        <!-- <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>-->
                                                        <span class="text-semibold">Atenção: </span> alterando a senha do seu perfil na Jubarte, você estará automaticamente alterando sua senha de acesso a rede da Prefeitura (login no computador).
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4 inputBlock">
                                                        <label>Senha Atual</label>
                                                        <input id="inputCurrentPassword" type="password" class="form-control" maxlength="100">
                                                    </div>
                                                    <div class="col-md-4 inputBlock">
                                                        <label>Nova Senha</label>
                                                        <input id="inputNewPassword" type="password" class="form-control" maxlength="100">
                                                    </div>
                                                    <div class="col-md-4 inputBlock">
                                                        <label>Repetir Senha</label>
                                                        <input id="inputRepeatNewPassword" type="password" class="form-control" maxlength="100">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button id="btnSalvarAlteracaoSenha" class="btn bg-orange btn-labeled heading-btn legitRipple">
                                                        <b><i class="icon-floppy-disk"></i></b>Salvar Nova Senha
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

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

</body>
</html>
