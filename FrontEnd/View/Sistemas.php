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

    <!-- DEPENDECIAS DA VIEW MODEL -->
    <script type="text/javascript" src="/cdn/utils/utils.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModernBlockUI.js"></script>
    <script type="text/javascript" src="/cdn/utils/jubarte.js"></script>
    <script type="text/javascript" src="/cdn/utils/ModalAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/LoaderAPI.js"></script>
    <script type="text/javascript" src="/cdn/utils/RESTClient.js"></script>

    <!-- VIEW MODEL -->
    <script type="text/javascript" src="/ViewModel/Constants.js"></script>
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
                                    <i class="icon-circle-code position-left"></i>
                                    <span class="text-semibold">Sistemas</span>
                                </h4>

                                <ul class="breadcrumb position-right">
                                </ul>
                            </div>

                            <div class="heading-elements">
                                <a href="intranet" class="btn bg-orange btn-labeled heading-btn legitRipple"><b><i class="icon-home2"></i></b>Página Inicial</a>
                                <a href="suporte" class="btn bg-blue btn-labeled heading-btn legitRipple"><b><i class="icon-comment-discussion"></i></b>Suporte</a>
                            </div>
                        </div>
                    </div>
                    <!-- /page header -->


                    <!-- Content area -->
                    <div class="content">

                        <div class="row">
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=//192.168.66.4/&conta=SALI" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">SALI</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/images/logoSiamWeb.png" alt="SALI" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=webponto/&conta=WebPonto" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Registro de Ponto</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/webponto/imagens/web_ponto.png" alt="Registro de Ponto" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=novosimco/&conta=SAGAS" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">SAGAS</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p style="height: 80px;">
                                                <br><strong>SAGAS</strong><br>Atendimentos e Serviços
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=CSI/&conta=CSI" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">CSI</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p style="height: 80px;">
                                                <br><strong>CSI</strong><br>Consulta aos Sistemas
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=SCS/&conta=SCS" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">SCS</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p style="height: 80px;">
                                                <br><strong>SCS</strong><br>Solicitação de Contas
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="https://jubarte.riodasostras.rj.gov.br" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Jubarte</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="/cdn/Assets/images/jubarteLogoSis.svg" alt="Jubarte" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=proteu/&conta=PROTEU" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Transporte</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/proteu/imagens/logo_proteu.jpg" alt="Transporte Universitário" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=BCI/&conta=BCI" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">BCI</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p style="height: 80px;">
                                                <br><strong>BCI</strong><br>Boletim Imobiliário
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=ppa/&conta=SIGO" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">SIGO</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p style="height: 80px;">
                                                <br><strong>SIGO</strong><br>Gestão Orçamentária
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=cartaosocial/&conta=CartaoBem" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Cartão do Bem</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/cartaosocial/includes/bemsocial.jpg" alt="Cartão do Bem" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=COGA/&conta=COGA" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">COGA</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/COGA/imagens/cartao_sus.jpg" alt="COGA" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="https://producao.riodasostras.rj.gov.br" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Produção</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="/cdn/Assets/images/jubarteLogoSis.svg" alt="Jubarte / Produção" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=projovem/&conta=ProJovem" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Jovem Cidadão</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/projovem/imagens/projovem3.png" alt="Jovem Cidadão" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=sibem/&conta=SIBEM" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Empregos</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/sibem/imagens/logoUBE.png" alt="Banco de Empregos" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=sipros/&conta=SIPROS" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Projetos Sociais</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/sipros/imagens/logo_sembes.jpg" alt="Projetos Sociais" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=recall/&conta=RECALL" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Recadastramento</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/recall/imagens/recall.png" alt="Recadastramento" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://licitacoes.riodasostras.rj.gov.br/avisos" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">PREGÃO</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p style="height: 80px;">
                                                <br><strong>PREGÃO</strong><br>Aviso de Licitação
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="https://jubarte.riodasostras.rj.gov.br/siscec" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">SISCEC</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="https://jubarte.riodasostras.rj.gov.br/siscec/img/logoSISCEC.png" alt="SISCEC" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=cep/cep.php&conta=CEP" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Consulta CEP</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/cep/cep.jpg" alt="Consulta CEP" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=gabinete/&conta=ListaProc" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">PROCESSOS</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p style="height: 80px;">
                                                <br><strong>PROCESSOS</strong><br>Lista Secretaria/Órgão
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=//192.168.66.4/assin/cons_proc1.php&conta=ConsProc" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">PROCESSOS</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p style="height: 80px;">
                                                <br><strong>PROCESSOS</strong><br>Consulta
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=normas/intranet/&conta=NORMAS" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">NORMAS</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p style="height: 80px;">
                                                <br><strong>NORMAS</strong><br>Consulta
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=http://ciente.riodasostras.rj.gov.br/&conta=CIENTE" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">CIENTE!</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/ciente/imagens/logoCiente.png" alt="CIENTE!" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=creche/&conta=CRECHE" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">CRECHE</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p style="height: 80px;">
                                                <br><strong>CRECHE</strong><br>Creches Municipais
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=proformacao/&conta=ProFormacao" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Pró-Formação</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/proformacao/imagens/probolsa.png" alt="Pró-Formação" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=aux_qualify/&conta=AuxQualify" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Qualificação</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/aux_qualify/includes/logo_aux_qualify.jpg" alt="Qualificação Profissional" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=sasp/&conta=SIGA" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">SIGA</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p style="height: 80px;">
                                                <br><strong>SIGA</strong><br>Serviços Públicos
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=op2017/gerencia/&conta=OP" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">OP 2017</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/op2017/WEB_logo_orcamentoNOVO.png" alt="OP 2017" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=opj2017/gerencia/&conta=OPJ" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">OPJ 2017</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/opj2017/WEB_logo_orcamentoNOVO.png" alt="OPJ 2017" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <a href="http://sis.riodasostras.rj.gov.br/indexsis.php?sistema=sigep/&conta=SIGEP" target="_blank">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">SIGEP</h6>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p>
                                                <img src="http://sis.riodasostras.rj.gov.br/sigep/imagens/logo_proformacao.jpg" alt="SIGEP" style="height: 80px; max-width: 100%;">
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <a href="https://www.riodasostras.rj.gov.br" target="_blank">
                            <div class="panel panel-flat">
                                <div class="panel-body text-center">
                                    <p>
                                        <img src="/cdn/Assets/images/logo-pmro-2017-cinza.png" alt="Prefeitura Municipal de Rio das Ostras" height="100">
                                    </p>
                                </div>
                            </div>
                        </a>

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

</body>
</html>