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

    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/bootstrap-select-1.12.4/defaults-pt_BR.min.js"></script>
    <script type="text/javascript" src="/cdn/Vendor/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <!-- DEPENDECIAS DA VIEW MODEL -->
    <script type="text/javascript" src="/cdn/utils/utils.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernBlockUI.js"></script>
    <script type="text/javascript" src="/cdn/utils/jubarte.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModalAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/LoaderAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/RESTClient.js"></script>
    <script type="text/javascript" src="/cdn/utils/FormValidationAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernDataTable.js"></script>

    <!-- VIEW MODEL -->
    <script type="text/javascript" src="/ViewModel/Constants.js"></script>
    <script type="text/javascript" src="/ViewModel/GerenciaPessoaViewModel.js"></script>

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
                            <h4>
                                <i class="icon-users2 position-left"></i>
                                <span class="text-semibold">Gerencia Pessoa</span>
                            </h4>

                            <ul class="breadcrumb position-right">
                            </ul>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <button class="btnSalvar btn bg-orange btn-labeled heading-btn legitRipple">
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

                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-solid nav-tabs-component">
                            <li class="active">
                                <a id="btnShowTabCadPessoa" href="#tabFormCadastro" data-toggle="tab" class="legitRipple"
                                   aria-expanded="true">Cadastrar Pessoa</a>
                            </li>
                            <li class="">
                                <a id="btnShowTabListaPessoaFisica" href="#tabListaPessoaFisica" data-toggle="tab" class="legitRipple"
                                   aria-expanded="false">Listar Pessoas Físicas</a>
                            </li>
                            <li class="">
                                <a id="btnShowTabListaPessoaJuridica" href="#tabListaPessoaJuridica" data-toggle="tab" class="legitRipple"
                                   aria-expanded="false">Listar Pessoas Jurídicas</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tabFormCadastro">
                                <!-- User profile -->
                                <div class="row">

                                    <div class="col-md-12 col-lg-12">

                                        <div class="tabbable">

                                            <div class="tab-content">

                                                <!-- Pessoa -->
                                                <div class="panel panel-flat border3-grey">
                                                    <div class="panel-body">

                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <!-- <a id="btnShowTabPessoaFisica" href="#" data-toggle="tab">
                                                                     <i class="icon-user position-left"></i> Pessoa Física
                                                                 </a>
                                                                 <a id="btnShowTabPessoaJuridica" href="#" data-toggle="tab">
                                                                     <i class="icon-office position-left"></i> Pessoa Jurídica
                                                                 </a>-->


                                                                <label class="jRadio">Pessoa Física
                                                                    <input type="radio" id="btnShowTabPessoaFisica" name="group1" checked>
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label class="jRadio">Pessoa Jurídica
                                                                    <input type="radio" id="btnShowTabPessoaJuridica" name="group1">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <br><br>
                                                        <!-- tabPessoaFisica -->
                                                        <div class="" id="tabPessoaFisica">

                                                            <!-- form Pessoa -->
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 inputBlock">
                                                                        <label>CPF</label>
                                                                        <input id="inputCPF" type="text"
                                                                               class="form-control"
                                                                               required data-type="cpf">
                                                                    </div>
                                                                    <div class="col-md-6 inputBlock">
                                                                        <label>Nome Completo</label>
                                                                        <input id="inputNomePeFisica" type="text"
                                                                               class="form-control" required
                                                                               data-type="string">
                                                                    </div>
                                                                    <div class="col-md-3 inputBlock">
                                                                        <label>Data de Nascimento</label>
                                                                        <input id="inputDataNascimento" type="text"
                                                                               class="form-control" required
                                                                               data-type="date">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">

                                                                    <div class="col-md-6 inputBlock">
                                                                        <label>E-mail Principal</label>
                                                                        <input id="inputEmailPrinPeFisica" type="text"
                                                                               class="form-control" required
                                                                               data-type="email">
                                                                    </div>
                                                                    <div class="col-md-6 inputBlock">
                                                                        <label>E-mail Adicional</label>
                                                                        <input id="inputEmailAdPeFisica" type="text"
                                                                               class="form-control" data-type="email">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 inputBlock">
                                                                        <label>RG</label>
                                                                        <input id="inputRG" type="text"
                                                                               class="form-control"
                                                                               required data-type="string">
                                                                    </div>
                                                                    <div class="col-md-3 inputBlock">
                                                                        <label>Orgão Emissor</label>
                                                                        <input id="inputOrgaoEmissor" type="text"
                                                                               class="form-control" required
                                                                               data-type="string">
                                                                    </div>
                                                                    <div class="col-md-3 inputBlock">
                                                                        <label>Data de Emissão</label>
                                                                        <input id="inputDataEmissao" type="text"
                                                                               class="form-control" required
                                                                               data-type="date">
                                                                    </div>
                                                                    <div class="col-md-3 inputBlock">
                                                                        <label>UF do Emissor</label>
                                                                        <select id="selectEstadoOrgaoEmissor"
                                                                                class="select"
                                                                                required data-type="int"
                                                                                data-live-search="true">
                                                                            <option>Selecione</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 inputBlock">
                                                                        <label>Sexo</label>
                                                                        <select id="selectSexo" class="select" required
                                                                                data-type="string">
                                                                            <option value="null">Selecione</option>
                                                                            <option value="Feminino">Feminino</option>
                                                                            <option value="Masculino">Masculino</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3 inputBlock">
                                                                        <label>Estado Civil</label>
                                                                        <select id="selectEstadoCivil" class="select"
                                                                                required data-type="string">
                                                                            <option value="null">Selecione</option>
                                                                            <option value="Solteiro">Solteiro(a)
                                                                            </option>
                                                                            <option value="União Estável">União
                                                                                Estável
                                                                            </option>
                                                                            <option value="Casado">Casado(a)</option>
                                                                            <option value="Divorciado">Divorciado(a)
                                                                            </option>
                                                                            <option value="Viúvo">Viúvo(a)</option>
                                                                            <option value="Outros">Outros</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3 inputBlock">
                                                                        <label>PIS</label>
                                                                        <input id="inputPIS" type="text"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="col-md-3 inputBlock">
                                                                        <label>Profissão</label>
                                                                        <input id="inputProfissao" type="text"
                                                                               class="form-control"
                                                                               data-type="string">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>Nome da Mãe</label>
                                                                        <input id="inputNomeMae" type="text"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>Nome do Pai</label>
                                                                        <input id="inputNomePai" type="text"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="col-md-2 inputBlock">
                                                                        <label>Grupo Sanguíneo</label>
                                                                        <select id="selectGrupoSanguineo" class="select"
                                                                                data-type="string">
                                                                            <option>Selecione</option>
                                                                            <option value="A">A</option>
                                                                            <option value="B">B</option>
                                                                            <option value="AB">AB</option>
                                                                            <option value="O">O</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2 inputBlock">
                                                                        <label>Fator RH</label>
                                                                        <select id="selectFatorRH" class="select"
                                                                                data-type="string">
                                                                            <option>Selecione</option>
                                                                            <option value="Negativo">Negativo</option>
                                                                            <option value="Positivo">Positivo</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>Nacionalidade</label>
                                                                        <select id="selectNacionalidade" class="select"
                                                                                required
                                                                                data-type="int" data-live-search="true">
                                                                            <option value="Brasil" selected="selected">
                                                                                Brasil
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>Naturalidade UF</label>
                                                                        <select id="selectNaturalidadeUF" class="select"
                                                                                required
                                                                                data-type="int" data-live-search="true">
                                                                            <option value="RJ" selected="selected">Rio
                                                                                de Janeiro
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>Naturalidade Município</label>
                                                                        <select id="selectNaturalidadeMunicipio"
                                                                                class="select" required
                                                                                data-type="int" data-live-search="true">
                                                                            <option value="Rio das Ostras"
                                                                                    selected="selected">Rio das Ostras
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <!-- tabPessoaJuridica -->
                                                        <div class="" id="tabPessoaJuridica" style="display: none">

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>Rasão Social</label>
                                                                        <input id="inputRasaoSocial"
                                                                               name="inputRasaoSocial" type="text"
                                                                               class="form-control" required
                                                                               data-type="string">
                                                                    </div>
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>E-mail Principal</label>
                                                                        <input id="inputEmailPrinPeJuridica"
                                                                               name="inputEmailPrinPeJuridica"
                                                                               type="text"
                                                                               class="form-control" required
                                                                               data-type="email">
                                                                    </div>
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>E-mail Adicional</label>
                                                                        <input id="inputEmailAdPeJuridica"
                                                                               name="inputEmailAdPeJuridica" type="text"
                                                                               class="form-control" data-type="email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>Nome Fantasia</label>
                                                                        <input id="inputNomeFantasia"
                                                                               name="inputNomeFantasia" type="text"
                                                                               class="form-control" required
                                                                               data-type="string">
                                                                    </div>
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>CNPJ</label>
                                                                        <input id="inputCNPJ" name="inputCNPJ"
                                                                               type="text" class="form-control"
                                                                               required data-type="string">
                                                                    </div>
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>Inscrição Estadual</label>
                                                                        <input id="inputInscricaoEstadual"
                                                                               name="inputInscricaoEstadual" type="text"
                                                                               class="form-control" required
                                                                               data-type="string">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- /Pessoa -->

                                                <!-- Telefones -->
                                                <div class="panel panel-flat border3-grey">
                                                    <div class="panel-heading">
                                                        <h6 class="panel-title">Telefone(s)</h6>
                                                    </div>

                                                    <div class="panel-body">
                                                        <!-- telefoneContainer -->
                                                        <div class="form-group ">
                                                            <div id="telefoneContainer" class="row">
                                                                <!-- telefoneItem -->
                                                                <div class="telefoneItem">
                                                                    <div class="col-md-2 inputBlock">
                                                                        <label>Tipo</label>
                                                                        <select name="tipoTelefone" class="select"
                                                                                required data-type="string">
                                                                            <option selected="" disabled="">Selecione
                                                                            </option>
                                                                            <option value="Residencial">Residencial
                                                                            </option>
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
                                                        <!-- /telefoneContainer -->

                                                        <div class="text-right">
                                                            <a href="#" id="btnAddTelefone"
                                                               class="btn bg-blue btn-sm btn-labeled btn-labeled-right heading-btn">
                                                                Adicionar Telefone <b><i class="icon-phone2"></i></b>
                                                            </a>
                                                            <a href="#" id="btnRemoveTelefone"
                                                               class="btn bg-grey btn-sm btn-labeled btn-labeled-right heading-btn"
                                                            >
                                                                Remover Telefone <b><i class="icon-phone2"></i></b>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- /Telefones -->

                                                <!-- enderecoContainer -->
                                                <div id="enderecoContainer">

                                                    <div class="enderecoItem panel panel-flat border3-grey">

                                                        <div class="panel-heading">
                                                            <h6 class="panel-title">Endereço</h6>
                                                        </div>

                                                        <div class="panel-body">

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
                                                                        <input name="cep" type="text"
                                                                               class="form-control" required
                                                                               data-type="string">
                                                                    </div>
                                                                    <div class="col-md-6 mt-20">
                                                                        <button name="btnPreencherEndereco"
                                                                                class="btnPreencherEndereco btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">
                                                                            Preencher <b><i
                                                                                        class="icon-mailbox"></i></b>
                                                                        </button>
                                                                        <button name="btnShowModalBuscaCEP"
                                                                                data-toggle="modal"
                                                                                data-target="#modalBuscaCEP"
                                                                                class="btnShowModalBuscaCEP btn bg-primary btn-sm btn-labeled btn-labeled-right heading-btn">
                                                                            Buscar CEP <b><i
                                                                                        class="icon-search4"></i></b>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>País</label>
                                                                        <select name="pais" class="select"
                                                                                data-live-search="true" required
                                                                                data-type="string">
                                                                            <option>Selecione</option>
                                                                            <option selected>Brasil</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>Estado</label>
                                                                        <select name="uf" class="select"
                                                                                data-live-search="true" required
                                                                                data-type="string">
                                                                            <option>Selecione</option>
                                                                            <option selected>Rio de Janeiro</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 inputBlock">
                                                                        <label>Municipio</label>
                                                                        <select name="municipio" class="select"
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
                                                            <div class="text-right">
                                                                <a href="#"
                                                                   class="btnAddEndereco btn bg-blue btn-sm btn-labeled btn-labeled-right heading-btn">
                                                                    Adicionar Endereço <b><i class="icon-location3"></i></b>
                                                                </a>
                                                                <a href="#"
                                                                   class="btnRemoveEndereco btn bg-grey btn-sm btn-labeled btn-labeled-right heading-btn">
                                                                    Remover Endereço <b><i
                                                                                class="icon-location3"></i></b>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /enderecoContainer -->

                                                <div class="text-right">
                                                    <button id="btnSalvar"
                                                            class="btnSalvar btn bg-orange btn-labeled heading-btn legitRipple">
                                                        <b><i class="icon-floppy-disk"></i></b>Salvar
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /user profile -->
                            </div>

                            <div class="tab-pane" id="tabListaPessoaFisica">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-flat">
                                            <div class="panel-body no-padding">
                                                <div class="modernDataTable">
                                                    <table id="tablePessoaFisica">
                                                        <thead>
                                                        <tr>
                                                            <th>Nome</th>
                                                            <th>E-mail Principal</th>
                                                            <th>Sexo</th>
                                                            <th>CPF</th>
                                                            <th>RG</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tabListaPessoaJuridica">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-flat">
                                            <div class="panel-body no-padding">
                                                <div class="modernDataTable">
                                                    <table id="tablePessoaJuridica">
                                                        <thead>
                                                        <tr>
                                                            <th>Nome Fantasia</th>
                                                            <th>Razão Social</th>
                                                            <th>CNPJ</th>
                                                            <th>Inscrição Estadual</th>
                                                            <th>E-mail</th>
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
<!-- templateFormEndereco -->
<template id="templateFormEndereco">
    <div class="enderecoItem panel panel-flat border3-grey">

        <div class="panel-heading">
            <h6 class="panel-title">Endereço</h6>
        </div>

        <div class="panel-body">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3 inputBlock">
                        <label>Tipo de Endereço</label>
                        <select name="tipoEndereco" class="select" required data-type="string">
                            <option selected="" disabled="">Selecione</option>
                            <option value="Residencial">Residencial</option>
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
                        <button name="btnShowModalBuscaCEP" data-toggle="modal"
                                data-target="#modalBuscaCEP"
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
                        <select name="pais" class="select" data-live-search="true" required data-type="string">
                            <option>Selecione</option>
                            <option selected>Brasil</option>
                        </select>
                    </div>
                    <div class="col-md-4 inputBlock">
                        <label>Estado</label>
                        <select name="uf" class="select" data-live-search="true" required data-type="string">
                            <option>Selecione</option>
                            <option selected>Rio de Janeiro</option>
                        </select>
                    </div>
                    <div class="col-md-4 inputBlock">
                        <label>Municipio</label>
                        <select name="municipio" class="select"
                                data-live-search="true" required data-type="string">
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
                        <select name="tipoLogradouro" class="select" required data-type="string">
                            <option value="" selected="" disabled="">Selecione
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
                               class="form-control" required data-type="string">
                    </div>
                    <div class="col-md-3 inputBlock">
                        <label>Número</label>
                        <input name="numeroLogradouro" type="text"
                               class="form-control" required data-type="string">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 inputBlock">
                        <label>Bairro</label>
                        <input name="bairro" type="text" class="form-control" required data-type="string">
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
                <div class="row jCheckBox">
                    <input id="enderecoDivergente" name="enderecoDivergente"
                           value="false"
                           onclick="$(this).val(this.checked ? 'true' : 'false')"
                           type="checkbox">
                    <label for="enderecoDivergente">
                        Marque aqui caso o endereço dos correios seja divergente
                    </label>
                </div>
            </div>
            <div class="text-right">
                <a href="#"
                   class="btnAddEndereco btn bg-blue btn-sm btn-labeled btn-labeled-right heading-btn">
                    Adicionar Endereço <b><i class="icon-location3"></i></b>
                </a>
                <a href="#"
                   class="btnRemoveEndereco btn bg-grey btn-sm btn-labeled btn-labeled-right heading-btn">
                    Remover Endereço <b><i class="icon-location3"></i></b>
                </a>
            </div>
        </div>
    </div>
</template>
<!-- /templateFormEndereco -->

</body>
</html>
