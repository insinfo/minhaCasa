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
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/forms/tags/tokenfield.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/bootstrap-select.min.js"></script>
    <!-- /JS CORE LIMITLESS -->

    <!-- Editor de Texto -->
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/ckeditor/ckeditorCustom/ckeditor.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/ckeditor/ckeditorCustom/adapters/jquery.js"></script>
    <!-- /Editor de Texto -->

    <!-- DEPENDEICIAS JUBARTE -->
    <link href="/cdn/Assets/css/jubarteStyle.css" rel="stylesheet" type="text/css">

    <!-- DEPENDECIAS DA VIEW MODEL -->
    <script type="text/javascript" src="/cdn/utils/utils.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernBlockUI.js"></script>
    <script type="text/javascript" src="/cdn/utils/jubarte.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModalAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/customModal.js"></script>
    <script type="text/javascript" src="/cdn/utils/LoaderAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/RESTClient.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernDataGrid.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/moment.js"></script>

    <!-- VIEW MODEL -->
    <script type="text/javascript" src="/ViewModel/Constants.js"></script>
    <script type="text/javascript">
        // Exibe o IP Público e Privado do Usuário
        $(document).ready(function () {
            $.getJSON('//gd.geobytes.com/GetCityDetails?callback=?', function (data) {
                // console.log(JSON.stringify(data, null, 2));
                getUserIP(function (ip) {
                    $('#displayIpPrivate').text(' - IP Privado: ' + ip);
                });
                $('#displayIpPublic').text('- IP Público: ' + data['geobytesipaddress']);
            });
        });
    </script>
    <script type="text/javascript" src="/ViewModel/suporteFAQ.js"></script>

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
                                    <i class="icon-comment-discussion position-left"></i>
                                    <span class="text-semibold">Suporte e FAQ</span>
                                    <span id="displayIpPublic"></span>
                                    <span id="displayIpPrivate"></span>
                                </h4>

                                <ul class="breadcrumb position-right">

                                </ul>
                            </div>

                            <div class="heading-elements">
                                <a id="add-new" href="#" class="btn bg-orange btn-labeled heading-btn legitRipple">
                                    <b>
                                        <i class="icon-file-plus"></i>
                                    </b>
                                    Adicionar novo item
                                </a>

                                <a href="creditos" class="btn bg-blue btn-labeled heading-btn legitRipple">
                                    <b>
                                        <i class="icon-info3"></i>
                                    </b>
                                    Créditos
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /page header -->


                    <!-- Content area -->
                    <div class="content">

                        <div class="row">
                            <div class="col-md-9 col-lg-9">

                                <!-- Search -->
                                <div class="panel panel-flat border3-primary">
                                    <div class="panel-body">
                                        <form action="#">
                                            <div class="input-group content-group">
                                                <input type="text" class="form-control input-lg token-input" placeholder="Pesquisar..." id="search" >
                                                <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary btn-lg btn-icon" id="search-go"><i class="icon-search4"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /search -->

                                <!-- Questions area -->
                                <h4 class="text-center content-group">
                                    FAQ - Perguntas Mais Frequentes
                                    <small class="display-block">Abaixo, temos as respostas das perguntas que mais se repetem no suporte</small>
                                </h4>

                                <!-- Questions list -->
                                <div class="panel-group panel-group-control panel-group-control-right" id="questions">
                                </div>
                                <!-- /questions list -->

                            </div>

                            <div class="col-md-3 col-lg-3">

                                <!-- Info blocks -->

                                <div class="col">
                                    <div class="panel">
                                        <div class="panel-body text-center">
                                            <div class="icon-object border-orange text-orange"><i class="icon-lifebuoy"></i></div>
                                            <h5 class="text-semibold">Suporte</h5>
                                            <p class="mb-15">Para entrar em contato com a equipe de suporte,<br>ligue no telefone (22) 2771-6187 ou<br>em um dos ramais 6187 e 6249.</p>
                                            <!--<a href="#" class="btn bg-orange">Abrir Chamado</a>-->
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="panel">
                                        <div class="panel-body text-center">
                                            <div class="icon-object border-blue text-blue"><i class="icon-bug2"></i></div>
                                            <h5 class="text-semibold">BugReport</h5>
                                            <p class="mb-15">Clique aqui para reportar erro no sistema</p>
                                            <a href="#" class="btn bg-blue" onclick="$(window.parent.document.getElementById('modalBugReport')).modal('show');">Reportar</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="panel">
                                        <div class="panel-body text-center">
                                            <div class="icon-object border-indigo text-indigo"><i class="icon-reading"></i></div>
                                            <h5 class="text-semibold">BIT</h5>
                                            <p class="mb-15">Artigos, Notícias e Tutorias sobre TI</p>
                                            <a href="http://bit.riodasostras.rj.gov.br/" target="_blank" class="btn bg-indigo">Blog</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- /info blocks -->

                            </div>
                        </div>
                        <!-- /questions area -->

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

<div id="questions-template" class="hide">

    <div class="panel panel-white border3-orange">
        <a href="#questions-group" class="collpased" data-toggle="collapse" >
            <div class="panel-heading suporteHeader">
                <h6 class="panel-title category-title"></h6>
            </div>
        </a>

        <div id="questions-group" class="panel-collapse collapse suporteSubHeader">
            <div class="panel-body">

                <!-- questions -->
                <!-- / questions -->

            </div>
        </div>
    </div>
</div>

<!-- TEMPLATES -->

<div id="questions-template-item" class="hide">
    <div class="panel-group">
        <div class="panel panel-white ">
            <a class="collapsed" data-toggle="collapse" href="#question1">
                <div class="panel-heading border3-darkPrimary">
                    <h6 class="panel-title">
                        <i class="icon-help position-left text-slate"></i>
                        <span class="question"></span>
                        <span class="question-edit">
                        </span>
                    </h6>
                </div>
            </a>
            <div id="question1" class="panel-collapse collapse">
                <div class="panel-body border3-primary"></div>

                <div class="panel-footer panel-footer-transparent border3-primary">
                    <div class="heading-elements">
                        <span class="text-muted heading-text date">
                            Última atualização: 01 de Janeiro de 2018
                        </span>

                        <ul class="list-inline list-inline-condensed heading-text pull-right button-like-unlike">
                            <li>
                                <a href="#" class="text-muted btn-like">
                                    <i class="icon-thumbs-up2 position-left"></i>
                                </a>
                                <span class="like-count">0</span>
                            </li>
                            <li>
                                <a href="#" class="text-muted btn-unlike">
                                    <i class="icon-thumbs-down2 position-left"></i>
                                </a>
                                <span class="unlike-count">0</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="templateFormFaq" class="hide">
    <div class="container-fluid">
        <form action="#" id="form-faq">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="titulo">
                            Título
                        </label>
                        <input type="text" class="form-control" required name="titulo" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="titulo">
                            Categoria
                        </label>
                        <div class="input-group">
                            <select name="categoria" id="cmbCategoria"></select>
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="nova-categoria" title="Nova Categoria" value="nova-categoria">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="titulo">
                            Descrição
                        </label>
                        <textarea type="text" class="form-control" required name="descricao" ></textarea>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<div class="modal primary" tabindex="-1" role="dialog" id="modalFormFaq">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">
                    Adicionar novo item
                </h5>
                <button type="button" class="close customModalCloseBtn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


            </div>
        </div>
    </div>
</div>

</body>
</html>

