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

    <script type="text/javascript" src="/cdn/Vendor/moment/2.19.1/moment.js"></script>

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
    <script type="text/javascript" src="/ViewModel/CadastroLDAPView.js"></script>
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
                                <span class="text-semibold">Cadastrar Usuário</span>
                            </h4>
                            <ul class="breadcrumb position-right">
                            </ul>
                        </div>
                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <button id="btnGeneretePassTop" class="btn bg-success btn-labeled heading-btn legitRipple">
                                    <b><i class="icon-key"></i></b><span spellcheck="false" contenteditable="true">Gerar Senha</span>
                                </button>
                                <button id="btnCadastrar" class="btn bg-orange btn-labeled heading-btn legitRipple">
                                    <b><i class="icon-floppy-disk"></i></b>Cadastrar
                                </button>
                                <button id="btnImprimir" class="btn bg-blue btn-labeled heading-btn legitRipple">
                                    <b><i class="icon-floppy-disk"></i></b>Imprimir
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
                                                        <input id="inputNomePessoa" data-toggle="modal" data-target="#modalListaServidor" type="text" class="form-control" readonly data-type="string">
                                                        <small class="help-block">

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
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <label class="control-label ">Senha</label><!--col-sm-2-->
                                                            <input id="inputSenha" type="password" class="form-control" placeholder="">
                                                            <div class="input-group-btn">
                                                                <button id="btnGeneratePassIcon" class="btn btn-default">
                                                                     <i class="icon-key"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <small class="help-block">
                                                            Deve ter 8 a 20 caracteres.
                                                        </small>
                                                    </div>
                                                    <!-- <div class="col-md-6 inputBlock ">
                                                         <label>Senha</label>
                                                         <input id="inputSenha" type="password" class="form-control " maxlength="100">
                                                         <small class="help-block">
                                                             Deve ter 8 a 20 caracteres.
                                                         </small>
                                                     </div>-->
                                                    <div class="col-md-6 inputBlock">
                                                        <label>Repetir Senha</label>
                                                        <input id="inputRepetirSenha" type="password" class="form-control" maxlength="100">
                                                        <small class="help-block">

                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4 inputBlock">
                                                        <label class="">Perfil </label>
                                                        <select id="selectPerfil" name="selectPerfil" class="form-control select2" title="Selecione o perfil" required disabled>
                                                            <option value=""/>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 inputBlock">
                                                        <label class="">Sistema </label>
                                                        <select id="selectSistema" name="selectSistema" class="form-control" title="Selecione o sistema" required disabled>
                                                            <option value=""/>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 inputBlock">
                                                        <label class="">Local de rede </label>
                                                        <select id="selectLocalDeRede" name="selectLocalDeRede" class="form-control" title="Selecione o sistema" required >
                                                            <option value="null">Selecione</option>
                                                            <option value="EDUCACAO">EDUCACAO</option>
                                                            <option value="CASA-EDUCACAO">CASA-EDUCACAO</option>
                                                            <option value="ESPORTE LAZER">ESPORTE LAZER</option>
                                                            <option value="PROCURADORIA">PROCURADORIA</option>
                                                            <option value="CONTROLADORIA">CONTROLADORIA</option>
                                                            <option value="OBRAS">OBRAS</option>
                                                            <option value="PLANEJAMENTO">PLANEJAMENTO</option>
                                                            <option value="SEMUSA">SEMUSA</option>
                                                            <option value="TURISMO">TURISMO</option>
                                                            <option value="FAZENDA">FAZENDA</option>
                                                            <option value="SAUDE">SAUDE</option>
                                                            <option value="HOSPITAL">HOSPITAL</option>
                                                            <option value="GABINETE">GABINETE</option>
                                                            <option value="COMUNICACAO">COMUNICACAO</option>
                                                            <option value="SEMAD">SEMAD</option>
                                                            <option value="SEMAD-ALMOXARIFADO">SEMAD-ALMOXARIFADO</option>
                                                            <option value="SEMAD-RH">SEMAD-RH</option>
                                                            <option value="SEMAD-VEICULOS-OFICIAIS">SEMAD-VEICULOS-OFICIAIS</option>
                                                            <option value="SEMAD-PROTOCOLO">SEMAD-PROTOCOLO</option>
                                                            <option value="SEMAD-PATRIMONIO">SEMAD-PATRIMONIO</option>
                                                            <option value="SEMAD-GAB">SEMAD-GAB</option>
                                                            <option value="SEMAD-FOLHA">SEMAD-FOLHA</option>
                                                            <option value="SEMAD-DELCO">SEMAD-DELCO</option>
                                                            <option value="SEMAD-CPL">SEMAD-CPL</option>
                                                            <option value="TRANSPORTE">TRANSPORTE</option>

                                                        </select>
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

<!-- modalListaServidor -->
<div id="modalListaServidor" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-large">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">LISTA SERVIDORES</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="modernDataTable">
                            <table id="tableListServidores" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Matricula</th>
                                    <th>Nome</th>
                                    <th>Data Nascimento</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>Lotação</th>
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
<!-- /modalListaServidor -->

<template id="templateCartaSenha">
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Carta Senha</title>
        <style type="text/css">
            * {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                color: #333333;
            }
            body{
                background: white;
            }
        </style>
    </head>
    <body>
    <div style="width: 100%;">
        <div style="float: left; padding: 20px 0 20px 20px;">
            <img src="http://local.riodasostras.rj.gov.br/cdn/Assets/images/Brasao.svg" style="height: 80px;" alt="Brasão do Município de Rio das Ostras - RJ">
        </div>
        <div style="float: left; padding: 20px 0 20px 20px;">
            <p style="border-bottom: solid 1px #333333;">
                ESTADO DO RIO DE JANEIRO<br>
                MUNICÍPIO DE RIO DAS OSTRAS<br>
                SECRETARIA DE ADMINISTRAÇÃO PÚBLICA
            </p>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div style="width: 100%;">
        <div style="text-align: right; padding-right: 20px;">
            <p>Rio das Ostras, <span id="spanData">31/08/2018</span>. </p>
        </div>
        <div style="width: 100%;">
            <p id="paragrafoTexto" style="padding: 20px;">
                Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.
            </p>
        </div>
    </div>
    </body>
    </html>
</template>

</body>
</html>
