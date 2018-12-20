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
    <script type="text/javascript" src="/ViewModel/ProfileViewModel.js"></script>
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
                            <h4><i class="icon-user position-left"></i> <span class="text-semibold">Meu Perfil</span></h4>
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

                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-solid nav-tabs-component">
                            <li class="active">
                                <a href="#tabMeuPerfil" data-toggle="tab" class="legitRipple"
                                   aria-expanded="true">Meu Perfil</a>
                            </li>
                            <li class="">
                                <a href="#tabRedesSociais" data-toggle="tab" class="legitRipple"
                                   aria-expanded="false">Redes Sociais</a>
                            </li>
                            <li class="">
                                <a href="#tabTrocarSenha" data-toggle="tab" class="legitRipple"
                                   aria-expanded="false">Alterar Senha</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tabMeuPerfil">

                                <!-- FORMS -->
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">

                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Informações Pessoais</h6>
                                            </div>
                                            <!-- form Pessoa -->
                                            <div id="formPessoa" class="panel-body">

                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-3 inputBlock">
                                                                    <label>CPF</label>
                                                                    <input id="inputCPF" type="text" class="form-control" readonly disabled data-type="cpf">
                                                                </div>
                                                                <div class="col-md-6 inputBlock">
                                                                    <label>Nome Completo</label>
                                                                    <input id="inputNomePeFisica" type="text" class="form-control" readonly disabled data-type="string">
                                                                </div>
                                                                <div class="col-md-3 inputBlock">
                                                                    <label>Data de Nascimento</label>
                                                                    <input id="inputDataNascimento" type="text" class="form-control" readonly disabled data-type="date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6 inputBlock">
                                                                    <label>E-mail Principal</label>
                                                                    <input id="inputEmailPrinPeFisica" type="text"
                                                                           class="form-control" readonly disabled data-type="email" maxlength="100">
                                                                </div>
                                                                <div class="col-md-6 inputBlock">
                                                                    <label>E-mail Adicional</label>
                                                                    <input id="inputEmailAdPeFisica" type="text"
                                                                           class="form-control" data-type="email" maxlength="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div id="inputFotoPerfil" class="inputFotoContainer">
                                                            <div tabindex="0" class="inputUserFoto">
                                                                <img src="/cdn/Assets/icons/userNoImage.jpg">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3 inputBlock">
                                                            <label>RG</label>
                                                            <input id="inputRG" type="text" class="form-control"
                                                                   readonly disabled data-type="string" maxlength="15">
                                                        </div>
                                                        <div class="col-md-3 inputBlock">
                                                            <label>Orgão Emissor</label>
                                                            <input id="inputOrgaoEmissor" type="text"
                                                                   class="form-control" readonly disabled data-type="string" maxlength="50">
                                                        </div>
                                                        <div class="col-md-3 inputBlock">
                                                            <label>Data de Emissão</label>
                                                            <input id="inputDataEmissao" type="text"
                                                                   class="form-control" data-type="date" readonly disabled>
                                                        </div>
                                                        <div class="col-md-3 inputBlock">
                                                            <label>UF do Emissor</label>
                                                            <select id="selectEstadoOrgaoEmissor" class="select" disabled data-type="int">
                                                                <option>Selecione</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3 inputBlock">
                                                            <label>Sexo</label>
                                                            <select id="selectSexo" class="select" disabled data-type="string">
                                                                <option value="null">Selecione</option>
                                                                <option value="Feminino">Feminino</option>
                                                                <option value="Masculino">Masculino</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 inputBlock">
                                                            <label>Estado Civil</label>
                                                            <select id="selectEstadoCivil" class="select" disabled data-type="string">
                                                                <option value="null">Selecione</option>
                                                                <option value="Solteiro(a)">Solteiro(a)</option>
                                                                <option value="União Estável">União Estável</option>
                                                                <option value="Casado(a)">Casado(a)</option>
                                                                <option value="Divorciado(a)">Divorciado(a)</option>
                                                                <option value="Viúvo(a)">Viúvo(a)</option>
                                                                <option value="Outros">Outros</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 inputBlock">
                                                            <label>PIS</label>
                                                            <input id="inputPIS" type="text" class="form-control" readonly disabled>
                                                        </div>
                                                        <div class="col-md-3 inputBlock">
                                                            <label>Profissão</label>
                                                            <input id="inputProfissao" type="text" class="form-control" data-type="string">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4 inputBlock">
                                                            <label>Nome da Mãe</label>
                                                            <input id="inputNomeMae" type="text" class="form-control" readonly disabled>
                                                        </div>
                                                        <div class="col-md-4 inputBlock">
                                                            <label>Nome do Pai</label>
                                                            <input id="inputNomePai" type="text" class="form-control" readonly disabled>
                                                        </div>
                                                        <div class="col-md-2 inputBlock">
                                                            <label>Grupo Sanguíneo</label>
                                                            <select id="selectGrupoSanguineo" class="select" data-type="string">
                                                                <option value="">Selecione</option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="AB">AB</option>
                                                                <option value="O">O</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 inputBlock">
                                                            <label>Fator RH</label>
                                                            <select id="selectFatorRH" class="select" data-type="string">
                                                                <option value="">Selecione</option>
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
                                                            <select id="selectNacionalidade" class="select" disabled data-type="int">
                                                                <option value="Brasil" selected="selected">Brasil</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 inputBlock">
                                                            <label>Naturalidade UF</label>
                                                            <select id="selectNaturalidadeUF" class="select" disabled data-type="int">
                                                                <option value="RJ" selected="selected">Rio de Janeiro</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 inputBlock">
                                                            <label>Naturalidade Município</label>
                                                            <select id="selectNaturalidadeMunicipio" class="select" disabled data-type="int">
                                                                <option value="Rio das Ostras" selected="selected">
                                                                    Rio das Ostras
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /form Pessoa -->
                                        </div>


                                        <!-- Telefones -->
                                        <div class="panel panel-flat">
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
                                                                <input name="numeroTelefone" type="text" class="form-control" required data-type="string">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /telefoneItem -->
                                                </div>
                                                <!-- /telefoneContainer -->


                                            </div>
                                        </div>
                                        <!-- /Telefones -->

                                        <!-- enderecoContainer -->
                                        <div id="enderecoContainer">

                                            <div class="enderecoItem panel panel-flat">

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

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4 inputBlock">
                                                                <label>País</label>
                                                                <select name="pais" class="select" required data-type="string">
                                                                    <option>Selecione</option>
                                                                    <option selected>Brasil</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 inputBlock">
                                                                <label>Estado</label>
                                                                <select name="uf" class="select" required data-type="string">
                                                                    <option>Selecione</option>
                                                                    <option selected>Rio de Janeiro</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 inputBlock">
                                                                <label>Municipio</label>
                                                                <select name="municipio" class="select"
                                                                        required data-type="string">
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
                                                                <label>Complemento</label>
                                                                <input name="complemento" type="text"
                                                                       class="form-control">
                                                            </div>
                                                            <div class="col-md-6 inputBlock">
                                                                <label>Bairro</label>
                                                                <input name="bairro" type="text" class="form-control" required data-type="string">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="validacao" value="false"/>
                                                    <div class="form-group">
                                                        <div class="row jSwitch">
                                                            <label>
                                                                <input name="divergente"
                                                                       value="false" onclick="$(this).val(this.checked ? 'true' : 'false')"
                                                                       type="checkbox"/>
                                                                <span class="jThumb"></span>
                                                                Marque aqui caso o endereço dos correios seja divergente
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <!-- /enderecoContainer -->

                                        <!-- matriculaContainer -->
                                        <div id="matriculaContainer">
                                            <div class="matriculaItem panel panel-flat">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">Matrícula</h6>
                                                </div>

                                                <div class="panel-body">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 inputBlock">
                                                                <label>Matrícula</label>
                                                                <input name="inputMatricula" type="text"
                                                                       class="form-control" readonly data-type="string">
                                                            </div>
                                                            <div class="col-md-3 inputBlock">
                                                                <label>Data de Admissão</label>
                                                                <input name="inputDataAdmissao" type="text"
                                                                       class="form-control" readonly data-type="date">
                                                            </div>
                                                            <div class="col-md-3 inputBlock">
                                                                <label>Cargo / Cargo Comissionado</label>
                                                                <select name="selectCargo" class="select"
                                                                        disabled data-type="string"
                                                                >
                                                                    <option selected="" disabled="">Selecione
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 inputBlock">
                                                                <label>Função Gratificada</label>
                                                                <select name="selectFG" class="select" data-type="string" disabled>
                                                                    <option selected="" disabled="" value="null">Selecione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 inputBlock">
                                                                <label>Vínculo</label>
                                                                <select name="selectVinculo" class="select"
                                                                        disabled data-type="string">
                                                                    <option selected="" disabled="">Selecione
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 inputBlock">
                                                                <label>Jornada de Trabalho</label>
                                                                <select name="selectJornadaTrabalho" class="select"
                                                                        disabled data-type="string">
                                                                    <option selected="" disabled="">Selecione
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 inputBlock">
                                                                <label>Lotação</label>
                                                                <input name="inputLotacao" type="text"
                                                                       class="form-control" readonly required data-type="string">
                                                            </div>
                                                            <div class="col-md-3 inputBlock">
                                                                <label>Local de Trabalho</label>
                                                                <input name="inputLocalTrabalho" type="text"
                                                                       class="form-control" readonly required data-type="string">
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 inputBlock">
                                                                <label>Data de Exoneração</label>
                                                                <input name="inputDataExoneracao" type="text" value=""
                                                                       class="form-control" readonly
                                                                >
                                                            </div>
                                                            <div class="col-md-3 inputBlock">
                                                                <label class="control-label ">Capturou a Biometria</label>
                                                                <div class="jSwitch jSwitchAjustes">
                                                                    <label>
                                                                        <input name="checkboxCapturouBiometria" type="checkbox" checked="" readonly>
                                                                        <span class="jThumb"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 inputBlock">
                                                                <label class="control-label ">Ativo</label>
                                                                <div class="jSwitch jSwitchAjustes">
                                                                    <label>
                                                                        <input name="checkboxMatriculaAtivo" type="checkbox" checked="" readonly>
                                                                        <span class="jThumb"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <!--<label class="control-label correcaoAlturaLabel col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2">Observações</label>-->
                                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                                <textarea name="textareaObservacao" rows="3" cols="5" class="form-control" placeholder="Se necessário, utilize essa área para alguma observação" readonly></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- /matriculaContainer -->

                                        <!-- Escala de Trabalho -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Escala de Trabalho</h6>
                                                <div class="heading-elements">
                                                    <!-- <ul class="icons-list">
                                                         <li><a data-action="collapse"></a></li>
                                                         <li><a data-action="reload"></a></li>
                                                     </ul> -->
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <div id="timeline"></div>
                                            </div>
                                        </div>
                                        <!-- /Escala de Trabalho -->

                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button id="btnSalvarCadastroServidor" class=" btn bg-orange btn-labeled heading-btn legitRipple">
                                                    <b><i class="icon-floppy-disk"></i></b>Salvar Perfil
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /FORMS -->

                            </div>

                            <div class="tab-pane" id="tabRedesSociais">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Redes Sociais -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Redes Sociais</h6>
                                            </div>

                                            <div class="panel-body">
                                                <form action="#">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label><i class="icon-facebook2"> </i> Facebook</label>
                                                                <input id="inputFacebook" type="text" placeholder="URL do seu perfil no Facebook" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><i class="icon-google-plus2"> </i> Google Plus</label>
                                                                <input id="inputGooglePlus" type="text" placeholder="URL do seu perfil no Google Plus" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label><i class="icon-instagram"> </i> Instagram</label>
                                                                <input id="inputInstagram" type="text" placeholder="ID Instagram" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><i class="icon-linkedin"> </i> Linkedin</label>
                                                                <input id="inputLinkedin" type="text" placeholder="URL do seu perfil no Linkedin" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label><i class="icon-twitter2"> </i> Twitter</label>
                                                                <input id="inputTwitter" type="text" placeholder="ID Twitter" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><i class="icon-youtube"> </i> YouTube</label>
                                                                <input id="inputYoutube" type="text" placeholder="URL do seu perfil no YouTube" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <a id="btnSaveRedesSociais" class="btn bg-orange btn-sm btn-labeled btn-labeled-left heading-btn">Salvar Redes Sociais<b><i class="icon-floppy-disk"></i></b></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /Redes Sociais -->
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tabTrocarSenha">
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

<!-- modalOrganograma -->
<div id="modalOrganograma" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-medium">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Organograma</h6>
            </div>
            <div class="modal-body">
                <div id="treeViewOrganograma"></div>
            </div>
        </div>
    </div>
</div>
<!-- /modalOrganograma -->

<!-- modalEscala -->
<div id="modalEscala" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-medium">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Inserir Escala e Local de Trabalho</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Local</label>
                            <select class="form-control" id="selectLocalBiometria" required>
                                <option value="null">Selecione</option>
                                <option value="1">Prefeitura Municipal de Rio das Ostras</option>
                                <option value="4">Centro Municipal de Inclusão Digital</option>
                                <option value="13">DEAGRO - Departamento de Agropeciária</option>
                                <option value="15">Parque Municipal dos Pássaros</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Entrada</label>
                        <select class="form-control" id="selectHoraEntrada" required>
                            <option value="08:00">08:00</option>
                            <option value="18:00">18:00</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Saída</label>
                        <select class="form-control" id="selectHoraSaida" required>
                            <option value="08:00">08:00</option>
                            <option value="11:45">11:45</option>
                            <option value="18:00">18:00</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div id="containerDiasSemana" class="row">
                        <div class="col-md-1 col-md-1-extra7 jCheckBox">
                            <input value="0" type="checkbox" id="dom">
                            <label for="dom">Domingo</label>
                        </div>
                        <div class="col-md-1 col-md-1-extra7 jCheckBox">
                            <input value="1" type="checkbox" id="seg">
                            <label for="seg">Segunda</label>
                        </div>
                        <div class="col-md-1 col-md-1-extra7 jCheckBox">
                            <input value="2" type="checkbox" id="ter">
                            <label for="ter">Terça</label>
                        </div>
                        <div class="col-md-1 col-md-1-extra7 jCheckBox">
                            <input value="3" type="checkbox" id="qua">
                            <label for="qua">Quarta</label>
                        </div>
                        <div class="col-md-1 col-md-1-extra7 jCheckBox">
                            <input value="4" type="checkbox" id="qui">
                            <label for="qui">Quinta</label>
                        </div>
                        <div class="col-md-1 col-md-1-extra7 jCheckBox">
                            <input value="5" type="checkbox" id="sex">
                            <label for="sex">Sexta</label>
                        </div>
                        <div class="col-md-1 col-md-1-extra7 jCheckBox">
                            <input value="6" type="checkbox" id="sab">
                            <label for="sab">Sábado</label>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button id="btnAddWorkload" type="button" class="btn bg-blue btn-sm btn-labeled btn-labeled-right heading-btn">Adicionar
                        <b>
                            <i class="icon-alarm-add"></i>
                        </b>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /modalEscala -->

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

<!-- templateFormEndereco -->
<template id="templateFormEndereco">
    <div class="enderecoItem panel panel-flat">

        <div class="panel-heading">
            <h6 class="panel-title">Endereço</h6>
        </div>

        <div class="panel-body">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3 inputBlock">
                        <label>Tipo de Endereço</label>
                        <select name="tipoEndereco" class="select" required data-type="string" disabled>
                            <option selected="" disabled="">Selecione</option>
                            <option value="Residencial">Residencial</option>
                            <option value="Comercial">Comercial</option>
                        </select>
                    </div>
                    <div class="col-md-3 inputBlock">
                        <label>CEP</label>
                        <input name="cep" type="text" class="form-control" required data-type="string" readonly disabled>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 inputBlock">
                        <label>País</label>
                        <select name="pais" class="select" required data-type="string" disabled>
                            <option>Selecione</option>
                            <option selected>Brasil</option>
                        </select>
                    </div>
                    <div class="col-md-4 inputBlock">
                        <label>Estado</label>
                        <select name="uf" class="select" required data-type="string" disabled>
                            <option>Selecione</option>
                            <option selected>Rio de Janeiro</option>
                        </select>
                    </div>
                    <div class="col-md-4 inputBlock">
                        <label>Municipio</label>
                        <select name="municipio" class="select"
                                required data-type="string" disabled>
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
                        <select name="tipoLogradouro" class="select" required data-type="string" disabled>
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
                               class="form-control" required data-type="string" readonly disabled>
                    </div>
                    <div class="col-md-3 inputBlock">
                        <label>Número</label>
                        <input name="numeroLogradouro" type="text"
                               class="form-control" required data-type="string" readonly disabled>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 inputBlock">
                        <label>Complemento</label>
                        <input name="complemento" type="text"
                               class="form-control" readonly disabled>
                    </div>
                    <div class="col-md-6 inputBlock">
                        <label>Bairro</label>
                        <input name="bairro" type="text" class="form-control" required data-type="string" readonly disabled>
                    </div>
                </div>
            </div>
            <input type="hidden" name="validacao" value="false"/>
            <div class="form-group">
                <div class="row jSwitch">
                    <label>
                        <input name="divergente"
                               value="false" onclick="$(this).val(this.checked ? 'true' : 'false')"
                               type="checkbox" readonly disabled/>
                        <span class="jThumb"></span>
                        Marque aqui caso o endereço dos correios seja divergente
                    </label>
                </div>
            </div>

        </div>
    </div>
</template>
<!-- /templateFormEndereco -->

<!-- templateFormMatricula -->
<template id="templateFormMatricula">
    <div class="matriculaItem panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Matrícula</h6>
        </div>

        <div class="panel-body">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3 inputBlock">
                        <label>Matrícula</label>
                        <input name="inputMatricula" type="text"
                               class="form-control" required data-type="string" readonly disabled>
                    </div>
                    <div class="col-md-3 inputBlock">
                        <label>Data de Admissão</label>
                        <input name="inputDataAdmissao" type="text"
                               class="form-control" required data-type="date" readonly disabled>
                    </div>
                    <div class="col-md-3 inputBlock">
                        <label>Cargo / Cargo Comissionado</label>
                        <select name="selectCargo" class="select"
                                required data-type="string"
                                disabled>
                            <option selected="" disabled="">Selecione
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3 inputBlock">
                        <label>Função Gratificada</label>
                        <select name="selectFG" class="select" data-type="string" disabled>
                            <option selected="" disabled="" value="null">Selecione</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3 inputBlock">
                        <label>Vínculo</label>
                        <select name="selectVinculo" class="select"
                                required data-type="string" disabled>
                            <option selected="" disabled="">Selecione
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3 inputBlock">
                        <label>Jornada de Trabalho</label>
                        <select name="selectJornadaTrabalho" class="select"
                                required data-type="string" disabled>
                            <option selected="" disabled="">Selecione
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3 inputBlock">
                        <label>Lotação</label>
                        <input name="inputLotacao" type="text"
                               class="form-control" required data-type="string" readonly disabled>
                    </div>
                    <div class="col-md-3 inputBlock">
                        <label>Local de Trabalho</label>
                        <input name="inputLocalTrabalho" type="text"
                               class="form-control" required data-type="string" readonly disabled>
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3 inputBlock">
                        <label>Data de Exoneração</label>
                        <input name="inputDataExoneracao" type="text" value=""
                               class="form-control" readonly disabled
                        >
                    </div>
                    <div class="col-md-3 inputBlock">
                        <label class="control-label ">Capturou a Biometria</label>
                        <div class="jSwitch jSwitchAjustes">
                            <label>
                                <input name="checkboxCapturouBiometria" type="checkbox" checked="" readonly disabled>
                                <span class="jThumb"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2 inputBlock">
                        <label class="control-label ">Ativo</label>
                        <div class="jSwitch jSwitchAjustes">
                            <label>
                                <input name="checkboxMatriculaAtivo" type="checkbox" checked="" readonly disabled>
                                <span class="jThumb"></span>
                            </label>
                        </div>
                    </div>
                    <!--<label class="control-label correcaoAlturaLabel col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2">Observações</label>-->
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <textarea name="textareaObservacao" rows="3" cols="5" class="form-control" placeholder="Se necessário, utilize essa área para alguma observação" readonly disabled></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<!-- /templateFormMatricula -->

<!-- modalGetFoto -->
<div id="modalGetFoto" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-medium">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Obter Foto</h6>
            </div>
            <div class="modal-body">
                <div class="fluid-container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="sizeWebCam" id="videoWebCamView">
                                <div style="padding-top: 111px;">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M1.2,4.47L2.5,3.2L20,20.72L18.73,22L16.73,20H4A2,2 0 0,1 2,18V6C2,5.78 2.04,5.57 2.1,5.37L1.2,4.47M7,4L9,2H15L17,4H20A2,2 0 0,1 22,6V18C22,18.6 21.74,19.13 21.32,19.5L16.33,14.5C16.76,13.77 17,12.91 17,12A5,5 0 0,0 12,7C11.09,7 10.23,7.24 9.5,7.67L5.82,4H7M7,12A5,5 0 0,0 12,17C12.5,17 13.03,16.92 13.5,16.77L11.72,15C10.29,14.85 9.15,13.71 9,12.28L7.23,10.5C7.08,10.97 7,11.5 7,12M12,9A3,3 0 0,1 15,12C15,12.35 14.94,12.69 14.83,13L11,9.17C11.31,9.06 11.65,9 12,9Z"/>
                                    </svg>
                                    <p>Câmera desligada ou inexistente!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="img-container" id="canvasPhotoView">
                                <img id="imgPhotoEditor" src="/cdn/Assets/icons/userNoImage.jpg" alt="Fotografia">
                                <div class="img-preview" id="photoPreview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-20 tdLeft2">
                            <button id="btnOnWebCam" type="button" class="btn bg-orange btn-sm btn-labeled btn-labeled-right heading-btn">
                                Ligar WebCam<b><i class="icon-video-camera"></i></b>
                            </button>
                            <button id="btnTakePhoto" type="button" class="btn bg-blue btn-sm btn-labeled btn-labeled-right heading-btn">
                                Fotografar<b><i class="icon-camera"></i></b>
                            </button>
                        </div>
                        <div class="col-md-6 mt-20 text-right tdRight2">
                            <label for="inputFileSelectPhoto" class="btn bg-blue btn-sm btn-labeled btn-labeled-right heading-btn">
                                Selecionar Arquivo<b><i class="icon-image2"></i></b>
                            </label>
                            <input id="inputFileSelectPhoto" type="file" style="display: none;"/>
                            <button id="btnAddPhoto" type="button" class="btn bg-indigo btn-sm btn-labeled btn-labeled-right heading-btn">
                                Salvar<b><i class="icon-arrow-right14"></i></b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /modalGetFoto -->


</body>
</html>
