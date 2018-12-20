$(function () {
    var gerenciarPermissoesVM = new GerenciarPermissoesVM();
    gerenciarPermissoesVM.init();
});

function GerenciarPermissoesVM() {
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = window.location!=window.parent.location ? window.parent.getModal() : new ModalAPI();
    this.treeView = new ModernTreeView('treeViewContainer');

    this.formCadPermissoes = $('#formCadPermissoes');
    this.idSistema = $('[name="idSistema"]');
    this.idPerfil = $('[name="idPerfil"]');
    this.idPessoa = $('[name="idPessoa"]');

    this.btnRecarregar = $('[name="btnRecarregar"]');
    this.btnSalvar = $('[name="btnSalvarPermissoes"]');

}
GerenciarPermissoesVM.prototype.init = function () {
    var self = this;
    // Carregamento
    self.popularSistemas();
    // Load de plugins
    $('select').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Selecione'
    });
    // Eventos
    self.eventos();
};
GerenciarPermissoesVM.prototype.eventos = function () {
    var self = this;
    self.idSistema.on('change', function () {
        // Limpa select do perfil
        self.idPerfil.val('').trigger('change');
        self.idPerfil.find('option').not(':first').remove();
        // Faz carregamento do menu e dos perfis
        var idSistema = parseInt(self.idSistema.val());
        self.popularPerfis(idSistema);
        self.popularMenus(idSistema);
        self.idSistema.blur();
    });
    self.idPerfil.on('change', function () {
        if ($(this).val()!=='') {
            self.carregarPermissoes();
            self.btnSalvar[0].disabled = false;
        }
    });
    self.btnRecarregar.on('click', function () {
        console.log(validarCamposRequeridos(self.formCadPermissoes));
        if (validarCamposRequeridos(self.formCadPermissoes)) self.carregarPermissoes();
        else self.modalApi.showModal(ModalAPI.WARNING, "Permissões", "Para recarregar as permissões de um sistema/perfil, primeiro selecione os mesmos nos campos correspondentes.", "OK");
    });
    self.btnSalvar.on('click', function () {
        if (validarCamposRequeridos(self.formCadPermissoes)) {
            var menus = self.treeView.getChecked(ModernTreeView.ID);
            var mensagem = menus.length>0 ? 'Confirma a alteração de permissões do sistema/perfil selecionado? A operação não poderá ser desfeita!'
                : 'Tem certeja que deseja remover as permissões do sistema/perfil?  A operação não poderá ser desfeita!';
            self.modalApi.showConfirmation(ModalAPI.WARNING, 'Confirmação', mensagem, 'Sim', 'Não').onClick('Sim', function () {
                self.salvarPermissoes(menus);
            });
        }
    });
};
GerenciarPermissoesVM.prototype.carregarPermissoes = function () {
    var self = this;
    var postData = {
        "idSistema":self.idSistema.val(),
        "idPerfil":self.idPerfil.val(),
        "idPessoa":null};
    self.loaderApi.show( $('#panelTreeView') );
    self.restClient.setMethodPOST();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'permissoes');
    self.restClient.setDataToSender(postData);
    self.restClient.setSuccessCallbackFunction(function (response) {
        self.treeView.resetDataLoaded();
        self.treeView.showCheck();
        var ids = [];
        $.each(response['data'], function (idx, item) {
            ids[ids.length] = item['idMenu'];
        });
        self.treeView.setDataParam(ModernTreeView.CHECKED, true, ids);
        self.treeView.draw();
        self.loaderApi.hide();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Permissões", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};
GerenciarPermissoesVM.prototype.popularMenus = function (idSistema) {
    var self = this;
    self.loaderApi.show( $('#panelTreeView') );
    self.treeView.setupDisplayItems([
        {'key':'id',    'type':ModernTreeView.ID},
        {'key':'icone', 'type':ModernTreeView.ICON},
        {'key':'label', 'type':ModernTreeView.LABEL},
        {'key':'nodes', 'type':ModernTreeView.NODES},
        {'key':'cor',   'type':ModernTreeView.COLOR},
        {'key':'ativo', 'type':ModernTreeView.ENABLED}
    ]);
    self.treeView.hideCheck();
    self.treeView.setWebServiceURL(self.webserviceJubarteBaseURL + 'menus/hierarquia/'+ idSistema);
    self.treeView.setOnClick(function (obj, objParent) {
        self.retornarMenu(obj, objParent ? objParent.label : '');
    });
    self.treeView.setOnLoadSuccessCallback(function (response) {
        if (response.length === 0) {
            var classe = self.idSistema.val() ? 'alert-warning' : 'alert-info';
            var message = self.idSistema.val() ? 'Nenhum menu cadastrado para o sistema'
                : 'Primeiro <span class="text-semibold"> selecione o Sistema </span> no menu anterior.';
            var html =  '<div class="alert alert-styled-left '+ classe +'">' +
                '<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>' + message + '</div>';
            $('#treeViewContainer').append(html);
        }
        self.loaderApi.hide();
    });
    self.treeView.setOnLoadErrorCallback(function () {
        self.loaderApi.hide();
    });
    self.treeView.load();
};
GerenciarPermissoesVM.prototype.popularSistemas = function () {
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
        self.modalApi.showModal(ModalAPI.ERROR, "Menu do sistema", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};
GerenciarPermissoesVM.prototype.popularPerfis = function (idSistema) {
    var self = this;
    self.loaderApi.show( $('#painelPermissoes') );
    self.restClient.setMethodPOST();
    self.restClient.setDataToSender({"idSistema":idSistema});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'perfis');
    self.restClient.setSuccessCallbackFunction(function (response) {
        $.each(response.data, function (idx, item) {
            self.idPerfil.append('<option value="'+ item.id +'">'+ item.sigla +'</option>');
        });
        self.loaderApi.hide();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Menu do sistema", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};
GerenciarPermissoesVM.prototype.salvarPermissoes = function (menus) {
    var self = this;
    var postData = {
        "idSistema":self.idSistema.val(),
        "idPerfil":self.idPerfil.val(),
        "idPessoa":null,
        "menus":menus};
    self.loaderApi.show();
    self.restClient.setMethodPUT();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'permissoes');
    self.restClient.setDataToSender(postData);
    self.restClient.setSuccessCallbackFunction(function (dados) {
        self.modalApi.notify(ModalAPI.SUCCESS, 'Permissões', "Permissões alteradas com sucesso");
        self.loaderApi.hide();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Permissões", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};