<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limitless Exemplos Modais</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="Vendor/limitless/material/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="Vendor/limitless/material/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="Vendor/limitless/material/css/core.css" rel="stylesheet" type="text/css">
    <link href="Vendor/limitless/material/css/components.css" rel="stylesheet" type="text/css">
    <link href="Vendor/limitless/material/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="Vendor/limitless/material/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="Vendor/limitless/material/js/core/libraries/bootstrap.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="Vendor/limitless/material/js/core/app.js"></script>
    <script type="text/javascript" src="Vendor/limitless/material/js/plugins/ui/ripple.min.js"></script>
    <script type="text/javascript" src="Vendor/limitless/material/js/plugins/notifications/jgrowl.min.js"></script>
    <!-- /theme JS files -->

    <script type="text/javascript" src="ViewModel/Util/ModalAPI.js"></script>
    <script type="text/javascript" src="ViewModel/Util/RESTClient.js"></script>
    <script>
        $(document).ready(
            function () {
                // Alex Florindo
                var modalAPI = new ModalAPI();
                var btnAlert = $('[name="btnAlert"]');
                var btnModal = $('[name="btnModal"]');
                var btnConfirmation = $('[name="btnConfirmation"]');
                var btnCustom = $('[name="btnCustom"]');
                var btnNotification = $('[name="btnNotification"]');
                btnAlert.click(function () {
                    var msg = 'Donec in convallis risus. Aliquam quis elit a nunc porta tincidunt. Morbi vitae est facilisis, eleifend nulla tempor, rhoncus ipsum';
                    modalAPI.showAlert(msg, 'Mauris').onClick(function () {
                        alert('Cliquei em Mauris');
                    });
                });
                btnModal.click(function () {
                    var rest = new RESTClient();
                    rest.setMethodGET();
                    rest.setWebServiceURL('http://192.168.133.12/siscec/public/api/modalErro');
                    rest.setSuccessCallbackFunction(function () {
                        modalAPI.showAlert('Executado com sucesso');
                    });
                    rest.setErrorCallbackFunction(function (callback) {
                        modalAPI.showModal(ModalAPI.ERROR, 'Duis eget', callback.responseJSON, 'Quisque').onClick(function () {
                            alert('Cliquei em Quisque');
                        });
                    });
                    rest.exec();
                });
                btnConfirmation.click(function () {
                    var msg = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pharetra, erat nec iaculis rhoncus, risus diam pellentesque nibh, sed lacinia est nunc ac nulla. In hac habitasse platea dictumst?'
                    modalAPI.showConfirmation(ModalAPI.WARNING, 'Quisque pharetra', msg, 'Sed', 'Donec').onClick('Sed', function () {
                        alert('Cliquei em Sed');
                    }).onClick('Donec', function () {
                        alert('Cliquei em Donec');
                    });
                });
                btnCustom.click(function () {
                    var msg = 'Maecenas vehicula quis erat eget mollis. Sed lobortis purus in enim ornare pharetra. In cursus eros vel convallis porta. Morbi sed dui leo. Aliquam sed facilisis ligula. Morbi euismod, purus non porta ornare, enim sapien consequat felis, quis lacinia felis nibh non lacus. Vestibulum tincidunt lectus in mi viverra accumsan?';
                    var config = { tituloModal:'Curabitur luctus', mensagem:msg, botoes:[
                        {label:'Aliquam',callback:"callback"},
                        {label:'Nunc',callback:"callback"},
                        {label:'Proin',callback:"callback"}
                    ]};
                    modalAPI.showCustom(ModalAPI.INFO, config).onClick('Aliquam', function () {
                        alert('Cliquei em Aliquam');
                    }).onClick('Nunc', function () {
                        alert('Cliquei em Nunc');
                    }).onClick('Proin', function () {
                        alert('Cliquei em Proin');
                    });
                });
                btnNotification.click(function () {
                    modalAPI.notify(ModalAPI.SUCCESS, "Neque porro", "Sed dignissim dapibus neque.");
                });
            }
        );
    </script>
</head>


<body>

    <!-- Main navbar -->
    <div class="navbar navbar-inverse bg-indigo">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html"><img src="Vendor/limitless/material/images/logo_light.png" alt=""></a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Text link</a></li>

                <li>
                    <a href="#">
                        <i class="icon-cog3"></i>
                        <span class="visible-xs-inline-block position-right">Icon link</span>
                    </a>
                </li>

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="Vendor/limitless/material/images/placeholder.jpg" alt="">
                        <span>Victoria</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                        <li><a href="#"><i class="icon-coins"></i> My balance</a></li>
                        <li><a href="#"><span class="badge badge-warning pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                        <li><a href="#"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Plataforma Jubarte</span> - Modelos de Modais</h4>
                        </div>

                        <div class="heading-elements">
                            <a href="#" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Button <b><i class="icon-menu7"></i></b></a>
                        </div>
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="../jubarte"><i class="icon-home2 position-left"></i> Home</a></li>
                            <li><a href="1_col.html">Starters</a></li>
                            <li class="active">Full width</li>
                        </ul>

                        <ul class="breadcrumb-elements">
                            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Link</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-gear position-left"></i>
                                    Dropdown
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    <!-- Simple panel -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Modelos</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <h6 class="text-semibold">Modais</h6>
                            <div class="text-left">
                                <button name="btnAlert" class="btn btn-primary btn-labeled btn-labeled-right legitRipple"><b><i class="icon-play3"></i></b>Alert</button>
                                <button name="btnModal" class="btn btn-danger btn-labeled btn-labeled-right legitRipple"><b><i class="icon-play3"></i></b>Modal</button>
                                <button name="btnConfirmation" class="btn btn-warning btn-labeled btn-labeled-right legitRipple"><b><i class="icon-play3"></i></b>Confirmation</button>
                                <button name="btnCustom" class="btn btn-info btn-labeled btn-labeled-right legitRipple"><b><i class="icon-play3"></i></b>Custom</button>
                            </div>

                            <br/>
                            <h6 class="text-semibold">Notificação</h6>
                            <div class="text-left">
                                <button name="btnNotification" class="btn btn-success btn-labeled btn-labeled-right legitRipple"><b><i class="icon-play3"></i></b> Notification</button>
                            </div>
                        </div>
                    </div>
                    <!-- /simple panel -->

                    <!-- Footer -->
                    <div class="footer text-muted">
                        &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
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