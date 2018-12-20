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


    <script type="text/javascript" src="/cdn/utils/steps.js"></script>

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
    <script type="text/javascript" src="/ViewModel/SolicitacaoCartaSenhaViewModel.js"></script>

    <style>
        .tabItem {
            display: none;
        }

        .tabItemAtive {
            display: block;
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
                            <h4><i class="icon-user position-left"></i> <span class="text-semibold">Solicitação de Criação e Alteração de Conta de Acesso</span></h4>
                            <ul class="breadcrumb position-right">
                            </ul>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">

                            </div>
                        </div>
                    </div>
                    <!-- /header content -->

                </div>
                <!-- /page header -->

                <!-- Content area -->
                <div class="content">

                    <!------------------------------------------->
                    <!-- Basic setup -->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h6 class="panel-title">Solicitação Conta de Acesso</h6>
                            <div class="heading-elements">
                                <!-- <ul class="icons-list">
                                     <li><a data-action="collapse"></a></li>
                                     <li><a data-action="reload"></a></li>
                                     <li><a data-action="close"></a></li>
                                 </ul>-->
                            </div>
                        </div>

                        <div class="steps-basic">
                            <!-- Passo 1 Checa se o usuario ja esta cadastrado -->
                            <h6>1º Checar Cadastro</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Digite o seu CPF para prosseguir.</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 inputBlock ">
                                        <div class="form-group">
                                            <label></label>
                                            <input type="text" id="inputCheckCPF" name="inputCPF" class="form-control" placeholder="">
                                            <small class="help-block">

                                            </small>
                                        </div>
                                    </div>
                                </div>


                            </fieldset>
                            <!-- Passo 2 cadastra usuario que não esta cadastrado -->
                            <h6>2º Cadastrar Pessoa</h6>
                            <fieldset class="formCadPessoa">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Preencha o cadastro para prosseguir.</h5>
                                        <br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- form pessoa -->
                                        <div class="form-group">
                                            <div class="row">

                                                <div class="col-md-3 inputBlock">
                                                    <label>CPF</label>
                                                    <input id="cpf" name="cpf" type="text" class="form-control" required data-type="cpf" data-visited="false" maxlength="14">
                                                </div>

                                                <div class="col-md-6 inputBlock">
                                                    <label>Nome Completo</label>
                                                    <input id="nome" name="nome" type="text"
                                                           class="form-control" required data-type="string">
                                                </div>

                                                <div class="col-md-3 inputBlock">
                                                    <label>Data de Nascimento</label>
                                                    <input id="dataNascimento" name="dataNascimento" type="text"
                                                           class="form-control" required data-type="date">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 inputBlock">
                                                    <label>RG</label>
                                                    <input id="rg" name="rg" type="text"
                                                           class="form-control" data-type="string">
                                                </div>
                                                <div class="col-md-3 inputBlock">
                                                    <label>Orgão Emissor</label>
                                                    <input id="orgaoEmissor" name="orgaoEmissor" type="text"
                                                           class="form-control" data-type="string">
                                                </div>
                                                <div class="col-md-4 inputBlock">
                                                    <label>Email</label>
                                                    <input id="emailPrincipal" name="emailPrincipal" type="text"
                                                           class="form-control" data-type="date">
                                                </div>
                                                <div class="col-md-2 inputBlock">
                                                    <label>Sexo</label>
                                                    <select id="sexo" name="sexo" class="select" required
                                                            data-type="string">
                                                        <option value="null">Selecione</option>
                                                        <option value="Feminino">Feminino</option>
                                                        <option value="Masculino">Masculino</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- form telefone  -->
                                        <div class="form-group ">
                                            <div id="telefoneContainer" class="row">
                                                <!-- telefoneItem -->
                                                <div class="telefoneItem">
                                                    <div class="col-md-2 inputBlock">
                                                        <label>Tipo</label>
                                                        <select name="tipoTelefone" class="select" required data-type="string">
                                                            <option selected="" disabled="">Selecione</option>
                                                            <option value="Residencial">Residencial</option>
                                                            <option value="Comercial">Comercial</option>
                                                            <option value="Móvel">Móvel</option>
                                                            <option value="WhatsApp">WhatsApp</option>
                                                            <option value="Outro">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 inputBlock">
                                                        <label>Telefone</label>
                                                        <input name="numeroTelefone" type="text"
                                                               class="form-control" required
                                                               data-type="string">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /telefoneItem -->
                                        </div>
                                        <!-- /form telefone -->
                                        <div id="enderecoContainer">
                                            <div class="enderecoItem">
                                                <!-- form endereco  -->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3 inputBlock">
                                                            <label>Tipo de Endereço</label>
                                                            <select name="tipoEndereco" class="select"
                                                                    required data-type="string">
                                                                <option selected="" disabled="">Selecione
                                                                </option>
                                                                <option value="Residencial">Residencial
                                                                </option>
                                                                <option value="Comercial">Comercial</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 inputBlock">
                                                            <label>CEP</label>
                                                            <input name="cep" type="text" class="form-control" required data-type="string">
                                                        </div>
                                                        <div class="col-md-6 mt-20">
                                                            <button name="btnPreencherEndereco"
                                                                    class="btnPreencherEndereco btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">
                                                                Preencher <b><i class="icon-mailbox"></i></b>
                                                            </button>
                                                            <button name="btnShowModalBuscaCEP" data-toggle="modal" data-target="#modalBuscaCEP"
                                                                    class="btnShowModalBuscaCEP btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">
                                                                Buscar CEP <b><i class="icon-search4"></i></b>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4 inputBlock">
                                                            <label>País</label>
                                                            <select name="pais" class="" data-live-search="true" required data-type="string">
                                                                <option>Selecione</option>
                                                                <option selected>Brasil</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 inputBlock">
                                                            <label>Estado</label>
                                                            <select name="uf" class="" data-live-search="true" required data-type="string">
                                                                <option>Selecione</option>
                                                                <option selected>Rio de Janeiro</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 inputBlock">
                                                            <label>Municipio</label>
                                                            <select name="municipio" class=""
                                                                    data-live-search="true" required
                                                                    data-type="string">
                                                                <option>Selecione</option>
                                                                <option selected>Rio das Ostras</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3 inputBlock">
                                                            <label>Tipo de Logradouro</label>
                                                            <select name="tipoLogradouro" class="select"
                                                                    required data-type="string">
                                                                <option value="" selected="" disabled="">
                                                                    Selecione
                                                                </option>
                                                                <option value="Rua">Rua</option>
                                                                <option value="Avenida">Avenida</option>
                                                                <option value="Beco">Beco</option>
                                                                <option value="Estrada">Estrada</option>
                                                                <option value="Praça">Praça</option>
                                                                <option value="Rodovia">Rodovia</option>
                                                                <option value="Travessa">Travessa</option>
                                                                <option value="Largo">Largo</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 inputBlock">
                                                            <label>Logradouro</label>
                                                            <input name="logradouro" type="text"
                                                                   class="form-control" required
                                                                   data-type="string">
                                                        </div>
                                                        <div class="col-md-3 inputBlock">
                                                            <label>Número</label>
                                                            <input name="numeroLogradouro" type="text"
                                                                   class="form-control" required
                                                                   data-type="string">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6 inputBlock">
                                                            <label>Bairro</label>
                                                            <input name="bairro" type="text"
                                                                   class="form-control" required
                                                                   data-type="string">
                                                        </div>
                                                        <div class="col-md-6 inputBlock">
                                                            <label>Complemento</label>
                                                            <input name="complemento" type="text"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="validacao" value="false"/>
                                                <div class="form-group">
                                                    <div class="row jSwitch">
                                                        <label>
                                                            <input name="divergente"
                                                                   value="false"
                                                                   onclick="$(this).val(this.checked ? 'true' : 'false')"
                                                                   type="checkbox"/>
                                                            <span class="jThumb"></span>
                                                            Marque aqui caso o endereço dos correios seja
                                                            divergente
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /form endereco -->
                                    </div>
                                </div>
                            </fieldset>
                            <!-- Passo 3 faz a solicitação -->
                            <h6>3º Novo Acesso</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="formSoliCartaSenha">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h5>Preencha o cadastro para prosseguir.</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 inputBlock">
                                                    <label>Organograma</label>
                                                    <input id="inputOrganograma" name="organograma" required data-type="string" type="text" class="form-control" placeholder="Selecione">
                                                </div>
                                                <div class="col-md-2 inputBlock">
                                                    <label>Telefone do Setor</label>
                                                    <input id="inputTelefoneSetor" name="telefone" required data-type="phone" type="text" class="form-control" placeholder="">
                                                </div>
                                                <div class="col-md-2 inputBlock">
                                                    <label>Matrícula</label>
                                                    <input id="inputMatricula" name="matricula" data-type="string" type="text" class="form-control" placeholder="">
                                                </div>
                                                <div class="col-md-3 inputBlock">
                                                    <label>Cargo</label>
                                                    <input id="inputCargo" name="cargo" data-type="string" type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4 inputBlock">
                                                    <label>Senha</label>
                                                    <input id="inputSenha" name="senha" required data-type="string"
                                                           type="password" class="form-control" maxlength="100">
                                                    <small class="help-block">
                                                        Deve ter entre 8 e 20 caracteres.
                                                    </small>
                                                </div>
                                                <div class="col-md-4 inputBlock">
                                                    <label>Repetir Senha</label>
                                                    <input id="inputRepetirSenha" name="resenha" required data-type="string"
                                                           type="password" class="form-control" maxlength="100">
                                                    <small class="help-block">
                                                    </small>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-5 inputBlock">
                                                    <label>Tipo de Conta</label>
                                                    <select id="selectTipoDeConta" name="tipo" class="select" required data-type="string">
                                                        <option value="">Selecione</option>
                                                        <option value="0">Rede | E-mail | Internet</option>
                                                        <option value="1">SALI - Sistema de Protocolo</option>
                                                        <option value="2">EasyGed - Sistema de Documentos</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="tabsContainer">

                                                    <!-- FORM Rede | E-mail | Internet -->
                                                    <div class="tabItem tabItem_0 formCartaSenhaRede">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <h6>Rede de Dados</h6>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6>E-mail</h6>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6>Internet</h6>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="radio">
                                                                    <label class="jRadio">Acesso de pasta padrão
                                                                        <input type="radio" name="optModoAcessoPasta" checked>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="radio">
                                                                    <label class="jRadio">Email de usuário padrão
                                                                        <input type="radio" name="optTipoEmail" checked>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="radio">
                                                                    <label class="jRadio">Acesso de internet padrão
                                                                        <input type="radio" name="optTipoAcessoInternet" checked>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-8 inputBlock">
                                                                <label>Local de Rede</label>
                                                                <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class=" icon-folder-open"></i>
                                                                        </span>
                                                                    <input id="inputLDAPLocalDeRede" name="LocalDeRede" required data-type="string" type="text" class="form-control" placeholder="Selecione">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>

                                                    <!-- SALI - Sistema de Protocolo -->
                                                    <div class="tabItem tabItem_1">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6></h6>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>SALI - Orgão</label>
                                                                <select id="selecSaliOrgao" name="selecSaliOrgao" class="select" required data-type="string">
                                                                    <option disabled="">Selecione</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>SALI - Unidade</label>
                                                                <select id="selecSaliUnidade" name="selecSaliUnidade" class="select" required data-type="string">
                                                                    <option disabled="">Selecione</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>SALI - Departamento (Onde será USADA A CONTA)*</label>
                                                                <select id="selecSaliDepartamento" name="selecSaliDepartamento" class="select" required data-type="string">
                                                                    <option disabled="">Selecione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>SALI - Setor (Onde será USADA A CONTA)*</label>
                                                                <select id="selecSaliSetor" name="selecSaliSetor" class="select" required data-type="string">
                                                                    <option disabled="">Selecione</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>SALI - Perfil </label>
                                                                <select id="selecSaliPerfil" name="selecSaliPerfil" class="select" required data-type="string">
                                                                    <option disabled selected>Selecione</option>
                                                                    <option value="0">Conta Padrao (Consulta, Recebe, Encaminha...)</option>
                                                                    <option value="1">Conta Padrão + Apensar/Desapensar Processo</option>
                                                                    <option value="2">Conta Padrão + Arquivar/Desarquivar Processo</option>
                                                                    <option value="3">Conta Padrão + Despachar/Apensar/Desapensar</option>
                                                                    <option value="4">Conta Padrão + Despachar/Apensar/Desapensar/Arquivar</option>
                                                                    <option value="5">Conta Padrão + Despachar Processo</option>
                                                                    <option value="6">Conta Padrão + Usuario Protocolo (Incluir Processo, CGM)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="alert alert-info alert-styled-left" id="infoSaliPerfil">
                                                                    <!--<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>-->
                                                                    Selecione o perfil para ver informações!
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Observação</label>
                                                    <textarea id="textareaObservacao" name="textareaObservacao" rows="3" cols="5" class="form-control" placeholder="Se necessário, utilize essa área para alguma observação"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </fieldset>
                            <h6>4º Alteração de Acesso</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Você já tem as seguintes contas.</h5>
                                    </div>
                                </div>
                            </fieldset>
                            <h6>5º Finalizar</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Processo concluído.</h5>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <!-- /basic setup -->
                    <!--------------------------------------------->

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

<!-- modalBuscaCEP -->
<div id="modalBuscaCEP" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-large">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Busca CEP</h6>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Estado</label>
                            <select id="selectUfBuscaCEP" name="selectUfBuscaCEP" class="form-control">
                                <option></option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Municipio</label>
                            <select id="selectMunicipioBuscaCEP" name="selectMunicipioBuscaCEP" class="form-control">
                                <option></option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Bairro</label>
                            <input id="inputBairroBuscaCEP" name="inputBairroBuscaCEP" type="text" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Logradouro</label>
                            <input id="inputLogradouroBuscaCEP" name="inputLogradouroBuscaCEP" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button id="btnBuscarCEPEnd" type="button"
                            class="btn bg-blue btn-sm btn-labeled btn-labeled-right heading-btn">
                        Procurar<b><i class="icon-search4"></i></b>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="modernDataTable">
                            <table id="tableListCEPCorreios" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Logradouro</th>
                                    <th>Complemento</th>
                                    <th>Bairro</th>
                                    <th>Localidade</th>
                                    <th>UF</th>
                                    <th>CEP</th>
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
<!-- /modalBuscaCEP -->

<!-- modalHierarchyOU -->
<div id="modalHierarchyOU" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-large">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Selecione local de rede</h6>
            </div>
            <div class="modal-body">
                <div id="mtvHierarchyOU"></div>
            </div>
            <div class="modal-footer">
                <button id="btnSelectLocalDeRede" class="btn bg-primary legitRipple" >
                    Concluir
                </button>
            </div>
        </div>
    </div>
</div>
<!-- /modalHierarchyOU -->

<!-- modalOrganograma -->
<div id="modalOrganograma" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-large">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Selecione Organograma</h6>
            </div>
            <div class="modal-body">
                <div id="mtvOrganograma"></div>
            </div>
        </div>
    </div>
</div>
<!-- /modalOrganograma -->

</body>
</html>
