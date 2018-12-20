$(function () {
    var gerenciarPerfisVM = new GerenciarPerfisVM();
    gerenciarPerfisVM.init();
});

function GerenciarPerfisVM() {
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = window.location!=window.parent.location ? window.parent.getModal() : new ModalAPI();

    this.formCadPerfil = $('#formCadPerfil');
    this.idPerfil = null;
    this.idSistema = $('[name="idSistema"]');
    this.sigla = $('[name="sigla"]');
    this.descricao = $('[name="descricao"]');
    this.prioridade = $('[name="prioridade"]');
    this.ativo = $('[name="ativo"]');
    this.btnSalvarPerfil = $('[name="btnSalvarPerfil"]');
    this.linkNovoPerfil = $('#linkNovoPerfil');

    this.dataTablePerfil= new ModernDataTable('tableListPerfil');
}
GerenciarPerfisVM.prototype.init = function () {
    var self = this;
    // Carregamento
    self.popularSistemas();
    self.carregarPerfis();
    // Load de plugins
    $('select').select2({
        minimumResultsForSearch: Infinity
    });
    $('.mskInteger').mask("#.##0", {reverse: true});
    // Eventos
    self.eventos();
};
GerenciarPerfisVM.prototype.eventos = function () {
    var self = this;
    self.linkNovoPerfil.on('click', function () {
        self.resetFormPerfil();
        $('#blocoCadPerfil').collapse('show');
    });
    self.btnSalvarPerfil.on('click', function () {
        self.salvarPerfil();
    });
};

GerenciarPerfisVM.prototype.carregarPerfis = function () {
    var self = this;
    self.loaderApi.show();
    self.dataTablePerfil.setDisplayCols([
        {"key": "id"},
        {"key": "sistema.sigla", 'render': function (row) {
            if (!row['sistema']) return '';
            else return row['sistema']['sigla'];
        }},
        {"key": "sigla"},
        {"key": "descricao"},
        {"key": "prioridade",'align':'center'},
        {"key": "ativo","type":"boolLabel",'align':'center'}
    ]);
    self.dataTablePerfil.setIsColsEditable(false);
    self.dataTablePerfil.showActionBtnAdd();
    self.dataTablePerfil.setSourceURL(self.webserviceJubarteBaseURL + 'perfis');
    self.dataTablePerfil.setSourceMethodPOST();
    self.dataTablePerfil.setOnDeleteItemAction(function (ids) {
        self.apagarPerfis(ids)
    });
    self.dataTablePerfil.setOnClick(function (obj) {
        self.resetFormPerfil();
        self.retornarPerfil(obj);
        $('#blocoCadPerfil').collapse('show');
    });
    self.dataTablePerfil.defaultLoader(false); //desabilita o Loader padrão
    self.dataTablePerfil.setOnReloadAction(function () {
        self.loaderApi.show( $('#tablePerfis') );
    }); // mostra o Loader quando clicar no botão reload do dataTable
    self.dataTablePerfil.setOnLoadedContent(function () {
        self.loaderApi.hide();
    }); // quando concluir o carregamento esconde o loader
    self.dataTablePerfil.setOnAddItemAction(function () {
        self.resetFormPerfil();
        $('#blocoCadPerfil').collapse('show');
    });
    self.dataTablePerfil.setOnDeleteItemAction(function(ids){
        self.apagarPerfis(ids);
    });
    self.dataTablePerfil.load();
};
GerenciarPerfisVM.prototype.popularSistemas = function () {
    var self = this;
    self.loaderApi.show();
    self.restClient.setMethodPOST();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'sistemas');
    self.restClient.setSuccessCallbackFunction(function (dados) {
        $.each(dados.data, function (idx, item) {
            self.idSistema.append('<option value="'+ item.id +'">'+ item.sigla +'</option>');
        });
        self.loaderApi.hide();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};
GerenciarPerfisVM.prototype.apagarPerfis = function (ids) {
    var self = this;
    if (ids.length===0) {
        self.modalApi.showModal(ModalAPI.WARNING, 'Perfis de usuário', 'É necessário selecionar ao menos um perfil!', 'OK');
        return;
    }
    self.modalApi.showConfirmation(ModalAPI.WARNING, 'Confirmação', 'Tem certeza que deseja remover o(s) perfil(s) selecionado(s)? A operação não poderá ser desfeita.', 'Sim', 'Não').onClick('Sim', function () {
        self.loaderApi.show( $('#tablePanel') );
        var dataToSend = {'ids':ids};
        self.restClient.setDataToSender(dataToSend);
        self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'perfis');
        self.restClient.setMethodDELETE();
        self.restClient.setSuccessCallbackFunction(function () {
            self.dataTablePerfil.load();
            self.loaderApi.hide();
            self.modalApi.notify(ModalAPI.SUCCESS, 'Perfis de usuário', 'Perfil(s) excluído(s) com sucesso');
        });
        self.restClient.setErrorCallbackFunction(function (callback) {
            self.modalApi.showModal(ModalAPI.ERROR, 'Perfis de usuário', callback.responseJSON, 'OK');
            self.loaderApi.hide();
        });
        self.restClient.exec();
    });
};
GerenciarPerfisVM.prototype.salvarPerfil = function () {
    var self = this;

    if (!validarCamposRequeridos(self.formCadPerfil)) {
        self.modalApi.notify(ModalAPI.WARNING, 'Perfis', 'É necessário entrar com os campos requeridos');
        return false;
    }

    var id = self.idPerfil ? self.idPerfil : '';
    var postData = self.formCadPerfil.serializeJSON();
    postData['prioridade'] = self.prioridade.unmask().val();

    self.loaderApi.show();
    self.restClient.setMethodPUT();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'perfis/' + id);
    self.restClient.setDataToSender(postData);
    self.restClient.setSuccessCallbackFunction(function (dados) {
        self.resetFormPerfil();
        self.dataTablePerfil.load();
        self.loaderApi.hide();
        self.modalApi.notify(ModalAPI.SUCCESS, 'Perfis', dados['message']);
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Perfis", callback.responseJSON, "OK");
    });
    self.restClient.exec();


    // IMPLEMENTAR AO SALVAR: CASO SEJA EDICAO DE ALGUM PERFIL, DEVE-SE FECHAR O FORMULÁRIO

};
GerenciarPerfisVM.prototype.retornarPerfil = function (obj) {
    var self = this;
    self.idPerfil = obj['id'];
    self.idSistema.val(obj['idSistema']).trigger('change');
    self.sigla.val(obj['sigla']);
    self.descricao.val(obj['descricao']);
    self.prioridade.val(obj['prioridade']);
    self.ativo.prop('checked', obj['ativo']);
};
GerenciarPerfisVM.prototype.resetFormPerfil = function () {
    var self = this;
    resetarValidacao( self.formCadPerfil );
    self.idPerfil = null;
    self.idSistema.val('0').trigger('change');
    self.sigla.val('');
    self.descricao.val('');
    self.prioridade.val('');
    self.ativo.prop('checked', true);
};