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
    <link href="/cdn/Assets/css/jSwitch.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/jubarteStyle.css" rel="stylesheet" type="text/css">

    <!-- JS PLUGINS EXTRA PARA ESTA PAGINA -->
    <script type="text/javascript" src="/cdn/Vendor/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/select2/4.0.6/select2.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/moment.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/locale/pt-br.js"></script>
    <!-- /JS PLUGINS EXTRA PARA ESTA PAGINA -->

    <!-- DEPENDECIAS DA VIEW MODEL -->
    <script type="text/javascript" src="/cdn/utils/utils.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernBlockUI.js"></script>
    <script type="text/javascript" src="/cdn/utils/jubarte.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModalAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/LoaderAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/RESTClient.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernDataTable.js"></script>

    <link rel="stylesheet" type="text/css" href="/cdn/Assets/css/modernDataTable.css"/>

    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/moment.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/locale/pt-br.js"></script>


    <script type="text/javascript" src="/ViewModel/Constants.js"></script>
    <script type="text/javascript" src="/ViewModel/GerenciarPerfisViewModel.js"></script>

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
                                <i class="icon-user-tie position-left"></i>
                                <span class="text-semibold">Perfis</span>
                            </h4>

                            <ul class="breadcrumb position-right">

                            </ul>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <button data-toggle="collapse" data-parent="#accordion-controls" href="#blocoCadPerfil" class="btnSalvar btn bg-orange btn-labeled heading-btn legitRipple"><b><i class="icon-user-plus"></i></b>Cadastrar</button>
                                <button data-toggle="collapse" data-parent="#accordion-controls" href="#blocoListarPerfil" class="btnSalvar btn bg-blue btn-labeled heading-btn legitRipple"><b><i class="icon-list"></i></b>Listar</button>
                            </div>
                        </div>
                    </div>
                    <!-- /header content -->

                    <!-- Content area -->
                    <div class="content">
                        <div class="panel-group accordion-sortable content-group-lg ui-sortable" id="accordion-controls">
                            <div class="panel panel-white" id="panelTreeView"><!-- painel 01 -->
                                <a id="linkOpenForm" data-toggle="collapse" data-parent="#accordion-controls" href="#blocoCadPerfil" aria-expanded="true">
                                    <div class="panel-heading border3-darkOrange">
                                        <h6 class="panel-title">
                                            Cadastro de Perfis
                                        </h6>
                                    </div>
                                </a>
                                <div id="blocoCadPerfil" class="panel-collapse collapse in" aria-expanded="true" style="">
                                    <div class="panel-body border3-orange">

                                        <!-- Form horizontal -->
                                        <p class="content-group-lg">Tela para cadastramento de perfis de usuários.</p>

                                        <div class="form-horizontal" id="formCadPerfil">
                                            <fieldset class="content-group">

                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Sistema</label>
                                                    <div class="col-sm-10">
                                                        <select name="idSistema" class="form-control" data-placeholder="Selecione o perfil">
                                                            <!--<option value="" />-->
                                                            <option value="null">Todos os Sistemas</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Sigla <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input name="sigla" maxlength="16" type="text" class="form-control" placeholder="Sigla do sistema" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Descrição <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <textarea name="descricao" class="form-control" placeholder="Descrição do perfil" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Prioridade <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input name="prioridade" maxlength="4" type="text" class="form-control mskInteger" placeholder="Prioridade de exibição" required>
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
                                                <button name="btnSalvarPerfil" class="btn btn-primary btn-sm btn-labeled btn-labeled-right heading-btn">Salvar <b><i class="icon-arrow-right14"></i></b></button>
                                            </div>
                                        </div>
                                        <!-- /form horizontal -->

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white" id="tablePerfis"><!-- painel 02 -->
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-controls" href="#blocoListarPerfil" aria-expanded="false">
                                    <div class="panel-heading border3-darkPrimary">
                                        <h6 class="panel-title">
                                            Perfis Jubarte
                                    </div>
                                </a>
                                <div id="blocoListarPerfil" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body border3-primary no-padding">

                                        <!-- ModernDataTable -->
                                        <div class="modernDataTable">
                                            <table id="tableListPerfil" class="">
                                                <thead>
                                                <tr>
                                                    <th>Sistema</th>
                                                    <th>Sigla</th>
                                                    <th>Descrição</th>
                                                    <th>Prioridade</th>
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
</body>
</html>