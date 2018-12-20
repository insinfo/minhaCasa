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

    <script type="text/javascript" src="/cdn/Vendor/limitless/material/js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->

    <!-- DEPENDEICIAS JUBARTE -->
    <link href="/cdn/Assets/css/jSwitch.css" rel="stylesheet" type="text/css">
    <link href="/cdn/Assets/css/jubarteStyle.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="/cdn/Vendor/select2/4.0.6/select2.min.js"></script>

    <!-- DEPENDECIAS DA VIEW MODEL -->
    <script type="text/javascript" src="/cdn/utils/utils.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernBlockUI.js"></script>
    <script type="text/javascript" src="/cdn/utils/jubarte.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModalAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/LoaderAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/RESTClient.js"></script>
    <script>
        $(document).ready(function () {
            $('.select').select2({
                minimumResultsForSearch: Infinity
            });
            console.log('dfd');
        })
    </script>
</head>
<body>
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
                            <h4><i class="icon-grid position-left"></i> <span class="text-semibold">Meus Dados</span></h4>

                            <ul class="breadcrumb position-right">

                            </ul>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="#" class="btn bg-grey-300 btn-labeled heading-btn legitRipple"><b><i class="icon-warning2"></i></b>Informar Erros no Cadastro</a>
                                <a href="#" class="btn bg-orange-800 btn-labeled heading-btn legitRipple"><b><i class="icon-floppy-disk"></i></b>Salvar Tudo</a>
                            </div>
                        </div>
                    </div>
                    <!-- /header content -->


                    <!-- Toolbar -->
                    <div class="navbar navbar-default navbar-component navbar-xs">
                        <ul class="nav navbar-nav visible-xs-block">
                            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                        </ul>

                        <div class="navbar-collapse collapse" id="navbar-filter">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#info" data-toggle="tab"><i class="icon-user position-left"></i> Informações Pessoais</a></li>
                                <li><a href="#agenda" data-toggle="tab"><i class="icon-calendar3 position-left"></i> Agenda <span class="badge badge-primary badge-inline position-right">5</span></a></li>
                                <li><a href="#atividade" data-toggle="tab"><i class="icon-list2 position-left"></i> Atividade</a></li>
                                <li><a href="#senhaLDAP" data-toggle="tab"><i class="icon-lock5 position-left"></i> Senha</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /toolbar -->

                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    <!-- User profile -->
                    <div class="row">
                        <div class="col-md-9 col-lg-9">
                            <div class="tabbable">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="info">

                                        <!-- Profile info -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Informações Pessoais</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <form action="#">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <label>Nome Completo</label>
                                                                <input type="text" value="Leonardo Calheiros Oliveira" class="form-control" readonly disabled>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>CPF</label>
                                                                <input type="text" value="094.982.697-93" class="form-control" readonly disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>E-mail Principal</label>
                                                                <input type="text" value="leonardo.oliveira@riodasostras.rj.gov.br" class="form-control" readonly disabled>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>E-mail Adicional</label>
                                                                <input type="text" value="leonardomw@gmail.com" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>RG</label>
                                                                <input type="text" value="13132182-0" class="form-control" readonly disabled>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Orgão Emissor</label>
                                                                <input type="text" value="Detran" class="form-control" readonly disabled>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Data de Emissão</label>
                                                                <input type="text" value="02/01/2002" class="form-control" readonly disabled>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>UF do Emissor</label>
                                                                <select class="select" disabled>
                                                                    <option value="Rio de Janeiro" selected="selected">Rio de Janeiro</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Sexo</label>
                                                                <select class="select" disabled>
                                                                    <option value="Feminino">Feminino</option>
                                                                    <option value="Masculino" selected="selected" selected>Masculino</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Data de Nascimento</label>
                                                                <input type="text" value="25/10/1982" class="form-control" readonly disabled>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Profissão</label>
                                                                <input type="text" value="Designer" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Nacionalidade</label>
                                                                <select class="select" disabled>
                                                                    <option value="Brasil" selected="selected">Brasil</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Naturalidade</label>
                                                                <select class="select" disabled>
                                                                    <option value="Rio de Janeiro" selected="selected">Rio de Janeiro</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Grupo Sanguíneo</label>
                                                                <select class="select">
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="AB">AB</option>
                                                                    <option value="O" selected="selected">O</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Fator RH</label>
                                                                <select class="select">
                                                                    <option value="Negativo">Negativo</option>
                                                                    <option value="Positivo" selected="selected">Positivo</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <a href="#" class="btn btn-sm heading-btn">Informar Erro no Cadastro</a>
                                                        <a href="#" class="btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">Salvar <b><i class="icon-arrow-right14"></i></b></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /profile info -->

                                        <!-- Telefones -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Telefone(s)</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <form action="#">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>Tipo</label>
                                                                <select class="select">
                                                                    <option disabled>Selecione</option>
                                                                    <option>Residencial</option>
                                                                    <option>Comercial</option>
                                                                    <option selected>Móvel</option>
                                                                    <option>Ramal</option>
                                                                    <option>Outro</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Telefone</label>
                                                                <input type="text" value="(22)99282-6565" class="form-control">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Tipo</label>
                                                                <select class="select">
                                                                    <option>Selecione</option>
                                                                    <option>Residencial</option>
                                                                    <option>Comercial</option>
                                                                    <option>Móvel</option>
                                                                    <option selected>Ramal</option>
                                                                    <option>Outro</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Telefone</label>
                                                                <input type="text" value="108" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <a href="#" class="btn bg-blue btn-sm btn-labeled btn-labeled-right heading-btn">Adicionar Telefone <b><i class="icon-phone2"></i></b></a>
                                                        <a href="#" class="btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">Salvar <b><i class="icon-arrow-right14"></i></b></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /Telefones -->

                                        <!-- Endereço -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Endereço</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <form action="#">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>Tipo de Endereço</label>
                                                                <select class="select">
                                                                    <option>Selecione</option>
                                                                    <option>Residencial</option>
                                                                    <option>Comercial</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>CEP</label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                            <div class="col-md-6 mt-20">
                                                                <a href="#" class="btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">Preencher <b><i class="icon-mailbox"></i></b></a>
                                                                <a href="#" class="btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">Buscar CEP <b><i class="icon-search4"></i></b></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>País</label>
                                                                <select class="select">
                                                                    <option>Selecione</option>
                                                                    <option selected>Brasil</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Estado</label>
                                                                <select class="select">
                                                                    <option>Selecione</option>
                                                                    <option selected>Rio de Janeiro</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Cidade</label>
                                                                <select class="select">
                                                                    <option>Selecione</option>
                                                                    <option selected>Rio das Ostras</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>Tipo de Logradouro</label>
                                                                <select class="select">
                                                                    <option>Selecione</option>
                                                                    <option selected>Avenida</option>
                                                                    <option>Rua</option>
                                                                    <option>Beco</option>
                                                                    <option>Estrada</option>
                                                                    <option>Praça</option>
                                                                    <option>Rodovia</option>
                                                                    <option>Travessa</option>
                                                                    <option>Largo</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Logradouro</label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Número</label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Complemento</label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Bairro</label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <a href="#" class="btn bg-blue btn-sm btn-labeled btn-labeled-right heading-btn">Adicionar Endereço<b><i class="icon-location3"></i></b></a>
                                                        <a href="#" class="btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">Salvar <b><i class="icon-arrow-right14"></i></b></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /Endereço -->

                                        <!-- Servidor Municipal -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Servidor Municipal</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <form action="#">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Matrícula</label>
                                                                <input type="text" value="10901-0" class="form-control" readonly disabled>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Cargo</label>
                                                                <input type="text" value="Web Designer" class="form-control" readonly disabled>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Função</label>
                                                                <input type="text" value="Web Designer" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Data de Admissão</label>
                                                                <input type="text" value="18/07/2011" class="form-control" readonly disabled>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Vínculo</label>
                                                                <input type="text" value="Estatutário" class="form-control" readonly disabled>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Regime</label>
                                                                <input type="text" value="Estatutário" class="form-control" readonly disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Lotação</label>
                                                                <input type="text" value="SEMAD" class="form-control" readonly disabled>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <label>Localização</label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <a href="#" class="btn btn-sm heading-btn">Informar Erro no Cadastro</a>
                                                        <a href="#" class="btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">Salvar <b><i class="icon-arrow-right14"></i></b></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /Servidor Municipal -->

                                        <!-- Redes Sociais -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Redes Sociais</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <form action="#">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label><i class="icon-facebook2"> </i> Facebook</label>
                                                                <input type="text" placeholder="URL do seu perfil no Facebook" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><i class="icon-google-plus2"> </i> Google Plus</label>
                                                                <input type="text" placeholder="URL do seu perfil no Google Plus" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label><i class="icon-instagram"> </i> Instagram</label>
                                                                <input type="text" placeholder="ID Instagram" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><i class="icon-linkedin"> </i> Linkedin</label>
                                                                <input type="text" placeholder="URL do seu perfil no Linkedin" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label><i class="icon-twitter2"> </i> Twitter</label>
                                                                <input type="text" placeholder="ID Twitter" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><i class="icon-youtube"> </i> YouTube</label>
                                                                <input type="text" placeholder="URL do seu perfil no YouTube" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <a href="#" class="btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">Salvar <b><i class="icon-arrow-right14"></i></b></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /Redes Sociais -->

                                    </div>

                                    <div class="tab-pane fade" id="senhaLDAP">
                                        <!-- Calendar -->
                                        <!-- Account settings -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Senha</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <form action="#">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Usuário</label>
                                                                <input type="text" value="leonardo.oliveira" readonly="readonly" class="form-control" disabled>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label>Senha Atual</label>
                                                                <input type="password" placeholder="Digite sua senha atual" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Nova Senha</label>
                                                                <input type="password" placeholder="Digite a nova senha" class="form-control">
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label>Repetir Nova Senha</label>
                                                                <input type="password" placeholder="Repita a nova senha" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <a href="#" class="btn btn-sm heading-btn">Informar Erro no Cadastro</a>
                                                        <a href="#" class="btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">Salvar <b><i class="icon-arrow-right14"></i></b></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /account settings -->
                                        <!-- /calendar -->

                                    </div>

                                    <div class="tab-pane fade" id="agenda">
                                        <!-- Calendar -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Minha Agenda</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <div class="schedule"></div>
                                            </div>
                                        </div>
                                        <!-- /calendar -->

                                    </div>


                                    <div class="tab-pane fade" id="atividade">

                                        <!-- Timeline -->
                                        <div class="timeline timeline-left content-group">
                                            <div class="timeline-container">

                                                <!-- Blog post -->
                                                <div class="timeline-row">
                                                    <div class="timeline-icon">
                                                        <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" alt="">
                                                    </div>

                                                    <div class="panel panel-flat timeline-content">
                                                        <div class="panel-heading">
                                                            <h6 class="panel-title">Himalayan sunset</h6>
                                                            <div class="heading-elements">
                                                                <span class="heading-text"><i class="icon-checkmark-circle position-left text-success"></i> 49 minutes ago</span>
                                                                <ul class="icons-list">
                                                                    <li class="dropdown">
                                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                            <i class="icon-arrow-down12"></i>
                                                                        </a>

                                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                                            <li><a href="#"><i class="icon-user-lock"></i> Hide user posts</a></li>
                                                                            <li><a href="#"><i class="icon-user-block"></i> Block user</a></li>
                                                                            <li><a href="#"><i class="icon-user-minus"></i> Unfollow user</a></li>
                                                                            <li class="divider"></li>
                                                                            <li><a href="#"><i class="icon-embed"></i> Embed post</a></li>
                                                                            <li><a href="#"><i class="icon-blocked"></i> Report this post</a></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="panel-body">
                                                            <a href="#" class="display-block content-group">
                                                                <img src="/cdn/Vendor/limitless/material/images/cover.jpg" class="img-responsive content-group" alt="">
                                                            </a>

                                                            <h6 class="content-group">
                                                                <i class="icon-comment-discussion position-left"></i>
                                                                Comment from <a href="#">Jason Ansley</a>:
                                                            </h6>

                                                            <blockquote>
                                                                <p>When suspiciously goodness labrador understood rethought yawned grew piously endearingly inarticulate oh goodness jeez trout distinct hence cobra despite taped laughed the much audacious less inside tiger groaned darn stuffily metaphoric unihibitedly inside cobra.</p>
                                                                <footer>Jason, <cite title="Source Title">10:39 am</cite></footer>
                                                            </blockquote>
                                                        </div>

                                                        <div class="panel-footer panel-footer-transparent">
                                                            <div class="heading-elements">
                                                                <ul class="list-inline list-inline-condensed heading-text">
                                                                    <li><a href="#" class="text-default"><i class="icon-eye4 position-left"></i> 438</a></li>
                                                                    <li><a href="#" class="text-default"><i class="icon-comment-discussion position-left"></i> 71</a></li>
                                                                </ul>

                                                                <span class="heading-btn pull-right">
																	<a href="#" class="btn btn-link">Read post <i class="icon-arrow-right14 position-right"></i></a>
																</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /blog post -->


                                                <!-- Date stamp -->
                                                <div class="timeline-date text-muted">
                                                    <i class="icon-history position-left"></i> <span class="text-semibold">Monday</span>, April 18
                                                </div>
                                                <!-- /date stamp -->


                                                <!-- Invoices -->
                                                <div class="timeline-row">
                                                    <div class="timeline-icon">
                                                        <div class="bg-warning-400">
                                                            <i class="icon-cash3"></i>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <h6 class="text-semibold no-margin-top">Leonardo Fellini</h6>
                                                                            <ul class="list list-unstyled">
                                                                                <li>Invoice #: &nbsp;0028</li>
                                                                                <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                                                            </ul>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <h6 class="text-semibold text-right no-margin-top">$8,750</h6>
                                                                            <ul class="list list-unstyled text-right">
                                                                                <li>Method: <span class="text-semibold">SWIFT</span></li>
                                                                                <li class="dropdown">
                                                                                    Status: &nbsp;
                                                                                    <a href="#" class="label bg-danger-400 dropdown-toggle" data-toggle="dropdown">Overdue <span class="caret"></span></a>
                                                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                                                        <li class="active"><a href="#"><i class="icon-alert"></i> Overdue</a></li>
                                                                                        <li><a href="#"><i class="icon-alarm"></i> Pending</a></li>
                                                                                        <li><a href="#"><i class="icon-checkmark3"></i> Paid</a></li>
                                                                                        <li class="divider"></li>
                                                                                        <li><a href="#"><i class="icon-spinner2 spinner"></i> On hold</a></li>
                                                                                        <li><a href="#"><i class="icon-cross2"></i> Canceled</a></li>
                                                                                    </ul>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="panel-footer panel-footer-condensed">
                                                                    <div class="heading-elements">
																		<span class="heading-text">
																			<span class="status-mark border-danger position-left"></span> Due: <span class="text-semibold">2015/02/25</span>
																		</span>

                                                                        <ul class="list-inline list-inline-condensed heading-text pull-right">
                                                                            <li><a href="#" class="text-default" data-toggle="modal" data-target="#invoice"><i class="icon-eye8"></i></a></li>
                                                                            <li class="dropdown">
                                                                                <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
                                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                                    <li><a href="#"><i class="icon-printer"></i> Print invoice</a></li>
                                                                                    <li><a href="#"><i class="icon-file-download"></i> Download invoice</a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><i class="icon-file-plus"></i> Edit invoice</a></li>
                                                                                    <li><a href="#"><i class="icon-cross2"></i> Remove invoice</a></li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="panel border-left-lg border-left-success invoice-grid timeline-content">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <h6 class="text-semibold no-margin-top">Rebecca Manes</h6>
                                                                            <ul class="list list-unstyled">
                                                                                <li>Invoice #: &nbsp;0027</li>
                                                                                <li>Issued on: <span class="text-semibold">2015/02/24</span></li>
                                                                            </ul>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <h6 class="text-semibold text-right no-margin-top">$5,100</h6>
                                                                            <ul class="list list-unstyled text-right">
                                                                                <li>Method: <span class="text-semibold">Paypal</span></li>
                                                                                <li class="dropdown">
                                                                                    Status: &nbsp;
                                                                                    <a href="#" class="label bg-success-400 dropdown-toggle" data-toggle="dropdown">Paid <span class="caret"></span></a>
                                                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                                                        <li><a href="#"><i class="icon-alert"></i> Overdue</a></li>
                                                                                        <li><a href="#"><i class="icon-alarm"></i> Pending</a></li>
                                                                                        <li class="active"><a href="#"><i class="icon-checkmark3"></i> Paid</a></li>
                                                                                        <li class="divider"></li>
                                                                                        <li><a href="#"><i class="icon-spinner2 spinner"></i> On hold</a></li>
                                                                                        <li><a href="#"><i class="icon-cross2"></i> Canceled</a></li>
                                                                                    </ul>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="panel-footer panel-footer-condensed">
                                                                    <div class="heading-elements">
																		<span class="heading-text">
																			<span class="status-mark border-success position-left"></span> Due: <span class="text-semibold">2015/03/24</span>
																		</span>

                                                                        <ul class="list-inline list-inline-condensed heading-text pull-right">
                                                                            <li><a href="#" class="text-default" data-toggle="modal" data-target="#invoice"><i class="icon-eye8"></i></a></li>
                                                                            <li class="dropdown">
                                                                                <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
                                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                                    <li><a href="#"><i class="icon-printer"></i> Print invoice</a></li>
                                                                                    <li><a href="#"><i class="icon-file-download"></i> Download invoice</a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><i class="icon-file-plus"></i> Edit invoice</a></li>
                                                                                    <li><a href="#"><i class="icon-cross2"></i> Remove invoice</a></li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /invoices -->


                                                <!-- Messages -->
                                                <div class="timeline-row">
                                                    <div class="timeline-icon">
                                                        <div class="bg-info-400">
                                                            <i class="icon-comment-discussion"></i>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-flat timeline-content">
                                                        <div class="panel-heading">
                                                            <h6 class="panel-title">Conversation with James</h6>
                                                            <div class="heading-elements">
                                                                <ul class="icons-list">
                                                                    <li class="dropdown">
                                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                            <i class="icon-circle-down2"></i>
                                                                        </a>

                                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                                            <li><a href="#"><i class="icon-user-lock"></i> Hide user posts</a></li>
                                                                            <li><a href="#"><i class="icon-user-block"></i> Block user</a></li>
                                                                            <li><a href="#"><i class="icon-user-minus"></i> Unfollow user</a></li>
                                                                            <li class="divider"></li>
                                                                            <li><a href="#"><i class="icon-embed"></i> Embed post</a></li>
                                                                            <li><a href="#"><i class="icon-blocked"></i> Report this post</a></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="panel-body">
                                                            <ul class="media-list chat-list content-group">
                                                                <li class="media date-step">
                                                                    <span>Today</span>
                                                                </li>

                                                                <li class="media reversed">
                                                                    <div class="media-body">
                                                                        <div class="media-content">Thus superb the tapir the wallaby blank frog execrably much since dalmatian by in hot. Uninspiringly arose mounted stared one curt safe</div>
                                                                        <span class="media-annotation display-block mt-10">Tue, 8:12 am <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                                                                    </div>

                                                                    <div class="media-right">
                                                                        <a href="/cdn/Vendor/limitless/material/images/placeholder.jpg">
                                                                            <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-md" alt="">
                                                                        </a>
                                                                    </div>
                                                                </li>

                                                                <li class="media">
                                                                    <div class="media-left">
                                                                        <a href="/cdn/Vendor/limitless/material/images/placeholder.jpg">
                                                                            <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-md" alt="">
                                                                        </a>
                                                                    </div>

                                                                    <div class="media-body">
                                                                        <div class="media-content">Tolerantly some understood this stubbornly after snarlingly frog far added insect into snorted more auspiciously heedless drunkenly jeez foolhardy oh.</div>
                                                                        <span class="media-annotation display-block mt-10">Wed, 4:20 pm <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                                                                    </div>
                                                                </li>

                                                                <li class="media reversed">
                                                                    <div class="media-body">
                                                                        <div class="media-content">Satisfactorily strenuously while sleazily dear frustratingly insect menially some shook far sardonic badger telepathic much jeepers immature much hey.</div>
                                                                        <span class="media-annotation display-block mt-10">2 hours ago <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                                                                    </div>

                                                                    <div class="media-right">
                                                                        <a href="/cdn/Vendor/limitless/material/images/placeholder.jpg">
                                                                            <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-md" alt="">
                                                                        </a>
                                                                    </div>
                                                                </li>

                                                                <li class="media">
                                                                    <div class="media-left">
                                                                        <a href="/cdn/Vendor/limitless/material/images/placeholder.jpg">
                                                                            <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-md" alt="">
                                                                        </a>
                                                                    </div>

                                                                    <div class="media-body">
                                                                        <div class="media-content">Grunted smirked and grew less but rewound much despite and impressive via alongside out and gosh easy manatee dear ineffective yikes.</div>
                                                                        <span class="media-annotation display-block mt-10">13 minutes ago <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                                                                    </div>
                                                                </li>

                                                                <li class="media reversed">
                                                                    <div class="media-body">
                                                                        <div class="media-content"><i class="icon-menu display-block"></i></div>
                                                                    </div>

                                                                    <div class="media-right">
                                                                        <a href="/cdn/Vendor/limitless/material/images/placeholder.jpg">
                                                                            <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-md" alt="">
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            </ul>

                                                            <textarea name="enter-message" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea>

                                                            <div class="row">
                                                                <div class="col-xs-6">
                                                                    <ul class="icons-list icons-list-extended mt-10">
                                                                        <li><a href="#" data-popup="tooltip" title="Send photo" data-container="body"><i class="icon-file-picture"></i></a></li>
                                                                        <li><a href="#" data-popup="tooltip" title="Send video" data-container="body"><i class="icon-file-video"></i></a></li>
                                                                        <li><a href="#" data-popup="tooltip" title="Send file" data-container="body"><i class="icon-file-plus"></i></a></li>
                                                                    </ul>
                                                                </div>

                                                                <div class="col-xs-6 text-right">
                                                                    <button type="button" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Send</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /messages -->


                                                <!-- Video posts -->
                                                <div class="timeline-row">
                                                    <div class="timeline-icon">
                                                        <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" alt="">
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="panel panel-flat timeline-content">
                                                                <div class="panel-heading">
                                                                    <h6 class="panel-title">Woodturner master</h6>
                                                                    <div class="heading-elements">
                                                                        <span class="heading-text"><i class="icon-checkmark-circle position-left text-success"></i> Yesterday, 7:52 am</span>
                                                                        <ul class="icons-list">
                                                                            <li class="dropdown">
                                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                                    <i class="icon-arrow-down12"></i>
                                                                                </a>

                                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                                    <li><a href="#"><i class="icon-user-lock"></i> Hide user posts</a></li>
                                                                                    <li><a href="#"><i class="icon-user-block"></i> Block user</a></li>
                                                                                    <li><a href="#"><i class="icon-user-minus"></i> Unfollow user</a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><i class="icon-embed"></i> Embed post</a></li>
                                                                                    <li><a href="#"><i class="icon-blocked"></i> Report this post</a></li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="video-container content-group">
                                                                        <iframe allowfullscreen="" frameborder="0" mozallowfullscreen="" src="https://player.vimeo.com/video/126545288?title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen=""></iframe>
                                                                    </div>

                                                                    Bewitchingly amid heard by llama glanced fussily quetzal more that overcame eerie goodness badger woolly where since gosh accurate irrespective that pounded much winked urgent and furtive house gosh one while this more.
                                                                </div>

                                                                <div class="panel-footer panel-footer-transparent">
                                                                    <div class="heading-elements">
                                                                        <ul class="list-inline list-inline-condensed heading-text">
                                                                            <li><a href="#" class="text-default"><i class="icon-eye4 position-left"></i> 285</a></li>
                                                                            <li><a href="#" class="text-default"><i class="icon-comment-discussion position-left"></i> 12</a></li>
                                                                        </ul>

                                                                        <span class="heading-btn pull-right">
																			<a href="#" class="btn btn-link">Read post <i class="icon-arrow-right14 position-right"></i></a>
																		</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="panel panel-flat timeline-content">
                                                                <div class="panel-heading">
                                                                    <h6 class="panel-title"><i class="icon-comment-discussion position-left"></i> <a href="#">Jason</a> commented:</h6>
                                                                    <div class="heading-elements">
                                                                        <ul class="icons-list">
                                                                            <li class="dropdown">
                                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                                    <i class="icon-arrow-down12"></i>
                                                                                </a>

                                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                                    <li><a href="#"><i class="icon-user-lock"></i> Hide user posts</a></li>
                                                                                    <li><a href="#"><i class="icon-user-block"></i> Block user</a></li>
                                                                                    <li><a href="#"><i class="icon-user-minus"></i> Unfollow user</a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><i class="icon-embed"></i> Embed post</a></li>
                                                                                    <li><a href="#"><i class="icon-blocked"></i> Report this post</a></li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="video-container content-group">
                                                                        <iframe allowfullscreen="" frameborder="0" mozallowfullscreen="" src="https://player.vimeo.com/video/133217402?title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen=""></iframe>
                                                                    </div>

                                                                    <blockquote>
                                                                        <p>When suspiciously goodness labrador understood rethought yawned grew piously endearingly inarticulate oh goodness jeez trout distinct hence cobra.</p>
                                                                        <footer>Jason, <cite title="Source Title">10:39 am</cite></footer>
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /video posts -->

                                            </div>
                                        </div>
                                        <!-- /timeline -->

                                    </div>
                                    <div class="text-right">
                                        <a href="#" class="btn bg-grey-300 btn-labeled heading-btn legitRipple"><b><i class="icon-warning2"></i></b>Informar Erros no Cadastro</a>
                                        <a href="#" class="btn bg-orange-800 btn-labeled heading-btn legitRipple"><b><i class="icon-floppy-disk"></i></b>Salvar Tudo</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-lg-3">

                            <!-- User thumbnail -->
                            <div class="thumbnail">
                                <div class="thumb thumb-rounded thumb-slide">
                                    <img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" alt="">
                                    <div class="caption">
										<span>
											<a href="#" class="btn bg-success-400 btn-icon btn-xs" data-popup="lightbox"><i class="icon-plus2"></i></a>
											<a href="user_pages_profile.html" class="btn bg-success-400 btn-icon btn-xs"><i class="icon-link"></i></a>
										</span>
                                    </div>
                                </div>

                                <div class="caption text-center">
                                    <h6 class="text-semibold no-margin">Leonardo Calheiros
                                        <small class="display-block">SEMAD / COTINF</small>
                                    </h6>
                                    <ul class="icons-list mt-15">
                                        <li><a href="#" data-popup="tooltip" title="Facebook"><i class="icon-facebook2"></i></a></li>
                                        <li><a href="#" data-popup="tooltip" title="Google Plus"><i class="icon-google-plus2"></i></a></li>
                                        <li><a href="#" data-popup="tooltip" title="Instagram"><i class="icon-instagram"></i></a></li>
                                        <li><a href="#" data-popup="tooltip" title="Linkedin"><i class="icon-linkedin"></i></a></li>
                                        <li><a href="#" data-popup="tooltip" title="Twitter"><i class="icon-twitter2"></i></a></li>
                                        <li><a href="#" data-popup="tooltip" title="YouTube"><i class="icon-youtube3"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /user thumbnail -->


                            <!-- Navigation -->
                            <div class="panel panel-flat">
                                <div class="list-group no-border no-padding-top">
                                    <a href="#" class="list-group-item"><i class="icon-bell2"></i> Alertas <span class="badge bg-primary-400 pull-right">11</span></a>
                                    <a href="#" class="list-group-item"><i class="icon-bubble8"></i> Mensagens <span class="badge bg-primary-400 pull-right">3</span></a>
                                    <a href="#" class="list-group-item"><i class="icon-mail5"></i> E-mail <span class="badge bg-primary-400 pull-right">48</span></a>
                                    <a href="#" class="list-group-item"><i class="icon-calendar3"></i> Eventos <span class="badge bg-primary-400 pull-right">0</span></a>
                                </div>
                            </div>
                            <!-- /navigation -->

                            <!-- Connections -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Últimas Conexões</h6>
                                </div>

                                <ul class="media-list media-list-linked pb-5">
                                    <li class="media-header">Equipe</li>

                                    <li class="media">
                                        <a href="#" class="media-link">
                                            <div class="media-left"><img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
                                            <div class="media-body">
                                                <span class="media-heading text-semibold">Alex Amorin</span>
                                                <span class="media-annotation">Chefe de Setor</span>
                                            </div>
                                            <div class="media-right media-middle">
                                                <span class="status-mark bg-success"></span>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="media">
                                        <a href="#" class="media-link">
                                            <div class="media-left"><img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
                                            <div class="media-body">
                                                <span class="media-heading text-semibold">Isaque Neves</span>
                                                <span class="media-annotation">Programador</span>
                                            </div>
                                            <div class="media-right media-middle">
                                                <span class="status-mark bg-danger"></span>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="media">
                                        <a href="#" class="media-link">
                                            <div class="media-left"><img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
                                            <div class="media-body">
                                                <div class="media-heading"><span class="text-semibold">José Amaro Neto</span></div>
                                                <span class="text-muted">Programador</span>
                                            </div>
                                            <div class="media-right media-middle">
                                                <span class="status-mark bg-grey-300"></span>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="media-header">Prefeitura</li>

                                    <li class="media">
                                        <a href="#" class="media-link">
                                            <div class="media-left"><img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
                                            <div class="media-body">
                                                <span class="media-heading text-semibold">Alessandro Oliveira</span>
                                                <span class="media-annotation">Agente Administrativo</span>
                                            </div>
                                            <div class="media-right media-middle">
                                                <span class="status-mark bg-success"></span>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="media">
                                        <a href="#" class="media-link">
                                            <div class="media-left"><img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
                                            <div class="media-body">
                                                <span class="media-heading text-semibold">Mauricio Anjos</span>
                                                <span class="media-annotation">Coordenador da COTINF</span>
                                            </div>
                                            <div class="media-right media-middle">
                                                <span class="status-mark bg-warning-400"></span>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="media">
                                        <a href="#" class="media-link">
                                            <div class="media-left"><img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
                                            <div class="media-body">
                                                <span class="media-heading text-semibold">Stefan Pizzeta</span>
                                                <span class="media-annotation">Analista de Segurança</span>
                                            </div>
                                            <div class="media-right media-middle">
                                                <span class="status-mark bg-grey-300"></span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /connections -->

                        </div>
                    </div>
                    <!-- /user profile -->


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
</div>
</body>
</html>
