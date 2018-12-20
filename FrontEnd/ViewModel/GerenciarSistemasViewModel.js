$(function () {
    var gerenciarSistemasVM = new GerenciarSistemasVM();
    gerenciarSistemasVM.init();
});
function GerenciarSistemasVM()
{
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = window.location!=window.parent.location ? window.parent.getModal() : new ModalAPI();

    // FORMULARIO CADASTRO SISTEMA
    this.formCadSistema = $('#formCadSistema');
    this.idSistema = null;
    this.inputSiglaSistema = $('#inputSiglaSistema');
    this.textareaDescricaoSistema = $('#textareaDescricaoSistema');
    this.inputOrdemSistema = $('#inputOrdemSistema');
    this.checkboxAtivoSistema = $('#checkboxAtivoSistema');

    this.extencoes = null;
    this.countExtencoes = 0;

    this.buttonAdiExtencao = $('#buttonAdiExtencao');
    this.buttonCadSistema = $('#buttonCadSistema');
    this.linkNovoSistema =$('#linkNovoSistema');

    // LISTA SISTEMA
    this.tableListSistema = $('#tableListSistema');
    this.dataTableSistema = new ModernDataTable('tableListSistema');
}
GerenciarSistemasVM.prototype.init = function () {
    var self = this;
    // Carregamento
    self.carregarSistemas();
    // Load de plugins
    $('.mskInteger').mask("#.##0", {reverse: true});
    $('select').selectpicker();
    // Eventos
    self.eventos();
};
GerenciarSistemasVM.prototype.eventos = function () {
    var self = this;
    self.formCadSistema.on('click', '.icon-eraser', function () {
        $(this).closest('.form-group').remove();
    });
    self.linkNovoSistema.on('click', function () {
        self.resetFormSistema();
        $('#blocoCadSistema').collapse('show');
    });
    self.buttonAdiExtencao.on('click', function () {
        self.adicionarBlocoExtensao();
    });
    self.buttonCadSistema.on('click', function () {
        self.salvarSistema();
    });
};

GerenciarSistemasVM.prototype.adicionarBlocoExtensao = function () {
    var self = this;
    var blocoExtensao = $($('#blocoExtensao').html()).clone();
    blocoExtensao.attr("data-extension", self.countExtencoes);
    blocoExtensao.find('select').selectpicker();
    $('#fdsInputs').append( blocoExtensao );
    self.countExtencoes += 1;
};
GerenciarSistemasVM.prototype.carregarSistemas = function () {
    var self = this;
    var columnsConfiguration = [
        {"key": "id"},
        {"key": "sigla"},
        {"key": "descricao"},
        {"key": "ordem",'align':'center'},
        {"key": "ativo","type":"boolLabel",'align':'center'}];
    self.loaderApi.show();
    self.dataTableSistema.setDisplayCols(columnsConfiguration);
    self.dataTableSistema.setIsColsEditable(false);
    self.dataTableSistema.showActionBtnAdd();
    self.dataTableSistema.setDataToSender({});
    self.dataTableSistema.setSourceURL(self.webserviceJubarteBaseURL + 'sistemas');
    self.dataTableSistema.setSourceMethodPOST();

    self.dataTableSistema.setOnDeleteItemAction(function(ids){
        self.apagarSistema(ids);
    });
    self.dataTableSistema.setOnClick(function (obj) {
        self.resetFormSistema();
        self.retornarSistema(obj);
        $('#blocoCadSistema').collapse('show');
    });
    //disabilita o Loader padrão
    self.dataTableSistema.defaultLoader(false);
    //mostra o Loader quando clicar no botão reload do dataTable
    self.dataTableSistema.setOnReloadAction(function () {
        self.loaderApi.show( $('#tableSistemas') );
    });
    //quando concluir o carregamento esconde o loader
    self.dataTableSistema.setOnLoadedContent(function () {
        self.loaderApi.hide();
    });
    self.dataTableSistema.setOnAddItemAction(function () {
        self.resetFormSistema();
        $('#blocoCadSistema').collapse('show');
        self.inputSiglaSistema.focus();
    });
    self.dataTableSistema.load();
};
GerenciarSistemasVM.prototype.validaFormSistema = function () {
    var self = this;

    if (!self.inputSiglaSistema.val())
    {
        self.modalApi.notify(ModalAPI.WARNING, "Sigla", "Preencha a sigla do sistema!");
        self.inputSiglaSistema.focus();
        return false;
    }

    if (!self.textareaDescricaoSistema.val())
    {
        self.modalApi.notify(ModalAPI.WARNING, "Descrição", "Preencha a descrição do sistema!");
        self.textareaDescricaoSistema.focus();
        return false;
    }

    if (!self.inputOrdemSistema.val())
    {
        self.modalApi.notify(ModalAPI.WARNING, "Ordem", "Preencha a ordenação do sistema!");
        self.inputOrdemSistema.focus();
        return false;
    }

    return true;
};
GerenciarSistemasVM.prototype.resetFormSistema = function () {
    var self = this;
    resetarValidacao( self.formCadSistema );
    self.idSistema = null;
    self.inputSiglaSistema.val('');
    self.textareaDescricaoSistema.val('');
    self.inputOrdemSistema.val('');
    self.checkboxAtivoSistema.prop('checked', true);
};
GerenciarSistemasVM.prototype.retornarSistema = function (obj) {
    var self = this;
    self.idSistema = obj['id'];
    self.inputSiglaSistema.val(obj['sigla']);
    self.textareaDescricaoSistema.val(obj['descricao']);
    self.inputOrdemSistema.val(obj['ordem']);
    self.checkboxAtivoSistema.prop('checked',obj['ativo']);
    // Extenções do sistema
    $('#fdsInputs').find('.form-group:not(.original)').remove();
    obj['extencoes'].forEach(function (obj) {
        var blocoExtensao = $($('#blocoExtensao').html()).clone();
        blocoExtensao.find('[name="destino"]').val(obj['destino']);
        blocoExtensao.find('[name="rotaLeitura"]').val(obj['rotaLeitura']);
        blocoExtensao.find('[name="metodoLeitura"]').val(obj['metodoLeitura']);
        blocoExtensao.find('[name="tipoExibicao"]').val(obj['tipoExibicao']);
        blocoExtensao.find('[name="rotaExibicao"]').val(obj['rotaExibicao']);
        blocoExtensao.find('[name="metodoExibicao"]').val(obj['metodoExibicao']);
        blocoExtensao.find('[name="rotaGravacao"]').val(obj['rotaGravacao']);
        blocoExtensao.find('[name="metodoGravacao"]').val(obj['metodoGravacao']);
        /*
        blocoExtensao.find('[name="paramLeitura"]').val(obj['paramLeitura']);
        blocoExtensao.find('[name="modoGravacao"]').val(obj['modoGravacao']);
        blocoExtensao.find('[name="valorGravacao"]').val(obj['valorGravacao']);
        blocoExtensao.find('[name="rotulo"]').val(obj['rotulo']);
        blocoExtensao.find('[name="valorExibido"]').val(obj['valorExibido']);
        */
        blocoExtensao.find('select').find('option:selected').attr('selected', true);
        blocoExtensao.find('select').selectpicker();
        $('#fdsInputs').append( blocoExtensao );
    });
    $('#linkOpenForm').trigger('click');
};
GerenciarSistemasVM.prototype.prepararJSON = function () {
    var self = this;
    var extensoes = [];
    $.each(self.formCadSistema.find('.blocoExtensao'), function (idx, obj) {
        extensoes[idx] = $(obj).serializeJSON();
    });
    var json = {
        "sigla": self.inputSiglaSistema.val(),
        "descricao": self.textareaDescricaoSistema.val(),
        "ordem": self.inputOrdemSistema.unmask().val(),
        "ativo": self.checkboxAtivoSistema.is(':checked'),
        "extencoes": extensoes
    };
    return json;
};
GerenciarSistemasVM.prototype.salvarSistema = function () {
    var self = this;

    // if ( !validarCamposRequeridos($('#formCadSistema')) && !self.validaFormSistema() && !validarCamposRequeridos($(".blocoExtensao form")))
    // {
    //     return false;
    // }

    self.loaderApi.show();

    var id = self.idSistema ? self.idSistema : '';
    var dataToSender = self.prepararJSON();
    self.restClient.setMethodPUT();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'sistemas/' + id);
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setSuccessCallbackFunction(function (dados) {
        self.loaderApi.hide();
        self.modalApi.notify(ModalAPI.SUCCESS, 'Sistemas', dados['message']);
        self.resetFormSistema();
        self.dataTableSistema.load();
        $('#lnkTabela').trigger('click');
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", jqXHR.responseJSON, "OK");
    });
    self.restClient.exec();
};
GerenciarSistemasVM.prototype.apagarSistema = function (ids) {
    var self = this;
    if (ids.length===0) {
        self.modalApi.showModal(ModalAPI.WARNING, 'Sistemas', 'É necessário selecionar ao menos um sistema!', 'OK');
        return;
    }
    self.modalApi.showConfirmation(ModalAPI.WARNING, 'Confirmação', 'Tem certeza que deseja remover o(s) sistema(s) selecionado(s)? A operação não poderá ser desfeita.', 'Sim', 'Não').onClick('Sim', function () {
        self.loaderApi.show( $('#tableSistemas') );
        var dataToSend = {'ids':ids};
        self.restClient.setDataToSender(dataToSend);
        self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'sistemas');
        self.restClient.setMethodDELETE();
        self.restClient.setSuccessCallbackFunction(function () {
            self.dataTableSistema.load();
            self.loaderApi.hide();
            self.modalApi.notify(ModalAPI.SUCCESS, 'Sistemas', 'Sistema(s) excluído(s) com sucesso');
        });
        self.restClient.setErrorCallbackFunction(function (callback) {
            self.modalApi.showModal(ModalAPI.ERROR, 'Sistemas', callback.responseJSON, 'OK');
            self.loaderApi.hide();
        });
        self.restClient.exec();
    });
};