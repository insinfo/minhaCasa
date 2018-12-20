$(function () {
    var gerenciarOrganogramaVM = new GerenciarOrganogramaVM();
    gerenciarOrganogramaVM.init();
});

function GerenciarOrganogramaVM() {
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;
    this.modalApi = window.location!=window.parent.location ? window.parent.getModal() : new ModalAPI();
    this.parentModal = window.location!=window.parent.location ? window.parent.getPrincipalVM().defaultModal : $('#defaultModal');
    this.loaderApi = new LoaderAPI();
    this.restClient = new RESTClient();
    this.dataTableSetor = new ModernDataTable('tableListSetores');
    this.treeView = new ModernTreeView('treeViewContainer');
    this.treeViewModal = null;

    this.painel = $('#painelSetores');
    this.formulario = $('#formOrganograma');
    this.idSetor = null;
    this.idOrganograma = null;
    this.idPai = $('[name="idPai"]');
    this.dataInicio = $('[name="dataInicio"]');
    this.sigla = $('[name="sigla"]');
    this.numeroLei = $('[name="numeroLei"]');
    this.anoLei = $('[name="anoLei"]');
    this.dataDiario = $('[name="dataDiario"]');
    this.numeroDiario = $('[name="numeroDiario"]');
    this.nome = $('[name="nome"]');
    this.isOficial = $('[name="isOficial"]');

    this.dataIniOriginal = null;
    this.btnCadSetor = $('#btn-cadastrar-setor');
    this.btnSalvar = $('[name="btnSalvar"]');
    this.inputFiltroData = $('#inputFiltroData');

    // Botões de Navegação
    this.btnOpenArvoreSetor = $('#btnOpenArvoreSetor');
    this.btnOpenHistorico = $('#btnOpenHistorico');
    this.btnOpenCadastro = $('#btnOpenCadastro');
}

GerenciarOrganogramaVM.prototype.init = function () {
    var self = this;
    // Objetos
    // Carregamentos
    self.listarSetores();
    self.inputFiltroData.val( moment().format('L') );
    // Load de plugins
    $('select').select2({
        minimumResultsForSearch: Infinity
    });
    $('.mskData').mask("00/00/0000", {clearIfNotMatch: true});
    self.inputFiltroData.datepicker({
        "language": "pt-BR",
        "format": 'dd/mm/yyyy',
        "autoclose": true
    });
    // Eventos
    this.eventos();
};
GerenciarOrganogramaVM.prototype.eventos = function () {
    var self = this;
    $('.icon-eraser').on('click', function () {
        self.idPai.val('');
        self.idPai.removeAttr('data-content');
        self.dataInicio.select();
    });
    self.idPai.on('click', function () {
        self.listarSetoresModal();
    });

    self.btnCadSetor.on('click', function () {
        $('#blocoRelacaoSetoresCadastrados').collapse('hide');
        $('#blocoHistoricoSetores').collapse('hide');
        $('#blocoDetalhesSetoresCadastrados').collapse('show');
        self.treeView.load();
        self.listarHistoricoSetor(-1);
        self.resetFormulario();
    });
    self.btnSalvar.on('click', function () {
        self.salvarSetor();
    });
    // toggle dos botoes
    $('a.toggle').on('click', function () {
        console.log( $(this).attr('href') );
    });
    // evento click no filtro por data do tree view setores
    $('#headingListaSetores').on('click', function () {
        $('#blocoRelacaoSetoresCadastrados').collapse('toggle');
    });
    $('.heading-elements').on('click', function (e) {
        e.stopPropagation();
    });
    self.inputFiltroData.on('click',function (e) {
        e.stopPropagation();
    });
    self.inputFiltroData.on('changeDate', function () {
        console.log($(this).val());
        self.listarSetores();
    });

    // Botões de Navegação
    this.btnOpenArvoreSetor.click(function () {
        $('#blocoRelacaoSetoresCadastrados').collapse('toggle');
    });
    this.btnOpenHistorico.click(function () {
        $('#blocoHistoricoSetores').collapse('toggle');
    });
    this.btnOpenCadastro.click(function () {
        $('#blocoRelacaoSetoresCadastrados').collapse('hide');
        $('#blocoHistoricoSetores').collapse('hide');
        $('#blocoDetalhesSetoresCadastrados').collapse('show');

        //if($('#blocoDetalhesSetoresCadastrados').attr('aria-expanded')==='false')
        //    $('#lnkForm').trigger('click');

        self.resetFormulario();

    });


    // buscar lei mais atual com o numero
    this.numeroLei.blur(function () {
        //alert(this.value);
        self.localizaLei(this.value);
    });

};
GerenciarOrganogramaVM.prototype.carregarSetor = function (setor) {
    var self = this;
    console.log(setor);
    self.idOrganograma = setor['idOrganograma'];
    self.idPai.attr('data-content', setor['idPai']);
    self.idPai.val(setor['nomePai']);
    self.dataInicio.val( sqlDateToBrasilDate(setor['dataInicio']) );
    self.sigla.val(setor['sigla']);
    self.numeroLei.val(setor['numeroLei']);
    self.anoLei.val(setor['anoLei']);
    self.dataDiario.val(sqlDateToBrasilDate(setor['dataDiario']));
    self.numeroDiario.val(setor['numeroDiario']);
    self.nome.val(setor['nome']);
    self.isOficial.prop('checked', setor['isOficial']);
    self.dataIniOriginal = setor['dataInicio'];
};
GerenciarOrganogramaVM.prototype.listarSetores = function () {
    var self = this;
    self.loaderApi.show(self.painel);
    self.treeView.setupDisplayItems([
        //{'key':'idSetor', 'type':ModernTreeView.ID},
        {'key':'idOrganograma', 'type':ModernTreeView.ID},
        {'key':'text', 'type':ModernTreeView.LABEL},
        {'key':'ativo', 'type':ModernTreeView.ENABLED}
    ]);
    self.treeView.setExplorerStyle();
    self.treeView.setMethodPOST();
    self.treeView.setDataToSend({
        dataInicio:self.inputFiltroData.val()
    });
    //console.log(self.webserviceJubarteBaseURL);
    //self.treeView.setWebServiceURL(self.webserviceJubarteBaseURL + 'setores/hierarquia');
    self.treeView.setWebServiceURL(self.webserviceJubarteBaseURL + 'organogramas/hierarquia');
    self.treeView.setOnLoadSuccessCallback(function () {
        self.loaderApi.hide();
    });
    self.treeView.setOnLoadErrorCallback(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Setores", callback.responseJSON, "OK");
    });
    self.treeView.setOnClick(function (response) {
        console.log(response);
        self.idOrganograma = response['idOrganograma'];
        self.listarHistoricoSetor(response['idOrganograma']);
        $('#blocoRelacaoSetoresCadastrados').collapse('hide');
        $('#blocoHistoricoSetores').collapse('show');
        $('#blocoDetalhesSetoresCadastrados').collapse('hide');
    });
    self.treeView.load();
};
GerenciarOrganogramaVM.prototype.listarSetoresModal = function () {
    var self = this;
    self.parentModal.find('.modal-body').empty();
    self.parentModal.find('.modal-body').append('<div id="treeViewModal" class="mtvContainer"></div>');
    self.treeViewModal = new ModernTreeView( self.parentModal.find('#treeViewModal') );
    self.treeViewModal.setupDisplayItems([
        {'key':'idOrganograma', 'type':ModernTreeView.ID},
        {'key':'text', 'type':ModernTreeView.LABEL},
        {'key':'ativo', 'type':ModernTreeView.ENABLED}
    ]);
    self.treeViewModal.setExplorerStyle();
    self.treeViewModal.setMethodPOST();
    self.treeViewModal.setDataToSend({
        dataInicio:self.inputFiltroData.val()
    });
    //self.treeViewModal.setWebServiceURL(self.webserviceJubarteBaseURL + 'setores/hierarquia');
    self.treeViewModal.setWebServiceURL(self.webserviceJubarteBaseURL + 'organogramas/hierarquia');
    self.treeViewModal.setOnLoadSuccessCallback(function (response) {
        self.loaderApi.hide();
    });
    self.treeViewModal.setOnLoadErrorCallback(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Setores", callback.responseJSON, "OK");
    });
    self.treeViewModal.setOnClick(function (response) {
        var idOrganograma = response['idOrganograma'];
        self.idPai.attr('data-content', idOrganograma);
        self.idPai.val(response['text']);
        self.parentModal.modal('hide');
    });
    self.treeViewModal.load();

    self.parentModal.modal('show');
};
GerenciarOrganogramaVM.prototype.listarHistoricoSetor = function (idOrganograma) {
    var self = this;
    self.loaderApi.show();
    self.dataTableSetor.setDisplayCols([
        {'key':'idOrganograma'},
        {'key':'nomePai', 'render':function (row) {
            if (!row['idPai']) return '';
            else return row['nomePai'];
        }},
        {'key':'dataInicio', 'type':'date'},
        {'key':'sigla'},
        {'key':'nome'}
    ]);
    self.dataTableSetor.setIsColsEditable(false);
    self.dataTableSetor.showActionBtnAdd();
    self.dataTableSetor.setPrimaryKey('idOrganograma');
    self.dataTableSetor.setSourceMethodPOST();
    self.dataTableSetor.setDataToSender({"draw":1, "length":10, "start":0, "search":"", "idOrganograma":self.idOrganograma});

    self.dataTableSetor.setSourceURL(self.webserviceJubarteBaseURL + 'organogramas/historico');
    self.dataTableSetor.defaultLoader(false);
    self.dataTableSetor.setOnLoadedContent(function () {
        self.loaderApi.hide();
    });
    self.dataTableSetor.setOnClick(function (setor) {
        self.carregarSetor(setor);

        $('#blocoRelacaoSetoresCadastrados').collapse('hide');
        $('#blocoHistoricoSetores').collapse('hide');
        $('#blocoDetalhesSetoresCadastrados').collapse('show');
    });
    self.dataTableSetor.setOnAddItemAction(function () {
        var idOrganograma = self.idOrganograma;
        self.resetFormulario();
        self.idOrganograma = idOrganograma;
        $('#blocoRelacaoSetoresCadastrados').collapse('hide');
        $('#blocoHistoricoSetores').collapse('hide');
        $('#blocoDetalhesSetoresCadastrados').collapse('show');
    });
    self.dataTableSetor.setOnDeleteItemAction(function (ids, td) {
        self.modalApi.showConfirmation(ModalAPI.WARNING, 'Confirmação', 'Tem certeza que deseja remover o(s) históricos(s) selecionado(s)? A operação não poderá ser desfeita.', 'Sim', 'Não')
            .onClick('Sim', function () {
                var json = [];
                for (var i=0; i<td.length; i++) {
                    json[i] = {idOrganograma:td[i]['idOrganograma'],dataInicio:td[i]['dataInicio']};
                }
                self.apagarHistorico(json);
            });
    });

    self.loaderApi.hide();
    self.dataTableSetor.load();
};

GerenciarOrganogramaVM.prototype.preparePostData = function () {
    var self = this;
    var idPai = self.idPai.is('[data-content]') ? self.idPai.attr('data-content') : null;
    //var setores = {'ativo':self.numeroDiario.is(':checked')};
    var setores = {'ativo':'true'};
    var setoresHistorico = {
        'dataInicio':self.dataInicio.val()!=='' ? self.dataInicio.val() : null,
        'sigla':self.sigla.val().toUpperCase(),
        'numeroLei' : self.numeroLei.val(),
        'anoLei' : self.anoLei.val(),
        'dataDiario' : self.dataDiario.val(),
        'numeroDiario' : self.numeroDiario.val(),
        'isOficial' : self.isOficial.is(':checked'),

        'nome':self.nome.val(),
        'idPai': idPai
    };
    return {'setor':setores, 'setorHistorico':setoresHistorico}
};
GerenciarOrganogramaVM.prototype.resetFormulario = function () {
    var self = this;
    self.idSetor = null;
    self.idOrganograma = null;
    self.idPai.val('');
    self.idPai.removeAttr('data-content');
    self.dataInicio.val('');
    self.sigla.val('');
    self.nome.val('');

    self.numeroLei.val('');
    self.anoLei.val('');
    self.dataDiario.val('');
    self.numeroDiario.val('');

    self.isOficial.prop('checked', true);
    self.dataIniOriginal = null;

    console.log("idOrganograma:"+self.idOrganograma);
};
GerenciarOrganogramaVM.prototype.salvarSetor = function () {
    var self = this;

    if (!validarCamposRequeridos(self.formulario)) {
        self.modalApi.notify(ModalAPI.WARNING, 'Setores', 'É necessário entrar com os campos requeridos');
        return false;
    }

    var parametros = self.idOrganograma ? self.idOrganograma : '';
    parametros += self.dataIniOriginal ? '/'+self.dataIniOriginal : '';

    self.loaderApi.show();
    self.restClient.setMethodPUT();
    //self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'setores/' + parametros);
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'organograma/' + parametros);

    //var dataToSender = self.formulario.serializeJSON();
    var dataToSender = self.preparePostData();
    self.restClient.setDataToSender( dataToSender );
    console.log(dataToSender);


    self.restClient.setSuccessCallbackFunction(function (response) {
        if (self.idOrganograma) {
            $('#blocoRelacaoSetoresCadastrados').collapse('show');
            $('#blocoHistoricoSetores').collapse('hide');
            $('#blocoDetalhesSetoresCadastrados').collapse('hide');
        } else {
            $('#blocoRelacaoSetoresCadastrados').collapse('hide');
            $('#blocoHistoricoSetores').collapse('hide'); //show
            $('#blocoDetalhesSetoresCadastrados').collapse('hide');
        }
        self.resetFormulario();
        self.treeView.load();
        self.dataTableSetor.load();
        self.loaderApi.hide();
        self.modalApi.notify(ModalAPI.SUCCESS, 'Setores', response['message']);
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Setores", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};
GerenciarOrganogramaVM.prototype.apagarHistorico = function (json) {
    var self = this;
    self.loaderApi.show( $('#painelHistoricoSetores') );
    self.restClient.setMethodDELETE();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'setores');
    self.restClient.setDataToSender( json );
    self.restClient.setSuccessCallbackFunction(function (response) {
        $('#blocoRelacaoSetoresCadastrados').collapse('hide');
        $('#blocoHistoricoSetores').collapse('show');
        $('#blocoDetalhesSetoresCadastrados').collapse('hide');
        self.resetFormulario();
        self.treeView.load();
        self.dataTableSetor.load();
        self.loaderApi.hide();
        self.modalApi.notify(ModalAPI.SUCCESS, 'Setores', response['message']);
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Setores", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};

GerenciarOrganogramaVM.prototype.localizaLei = function () {
    var self = this;
    self.loaderApi.show();
    self.restClient.setMethodGET();
    //self.restClient.setDataToSender( self.numeroLei.val() );
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'numeroLei/' + self.numeroLei.val());
    self.restClient.setSuccessCallbackFunction(function (response) {
        self.loaderApi.hide();
        console.log(response);

        ano = (response) ? response['anoLei'] : '';
        data = (response) ? sqlDateToBrasilDate(response['dataDiario']) : '';
        numero = (response) ? response['numeroDiario'] : '';

        self.anoLei.val(ano);
        self.dataDiario.val(data);
        self.numeroDiario.val(numero);

    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
    });
    self.restClient.exec();
};