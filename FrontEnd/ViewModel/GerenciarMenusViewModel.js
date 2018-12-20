$(function () {
    var gerenciarMenusVM = new GerenciarMenusVM();
    gerenciarMenusVM.init();
});

function GerenciarMenusVM() {
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.treeView = new ModernTreeView('treeViewContainer');
    this.modalTreeView = new ModernTreeView('treeViewModal');
    this.modalApi = window.location!=window.parent.location ? window.parent.getModal() : new ModalAPI();

    this.formCadMenu = $('#formCadMenu')
    this.idMenu = null;
    this.idPai = $('[name="idPai"]');
    this.idSistema = $('[name="idSistema"]');
    this.icone = $('[name="icone"]');
    this.label = $('[name="label"]');
    this.rota = $('[name="rota"]');
    this.cor = $('[name="cor"]');
    this.ordem = $('[name="ordem"]');
    this.ativo = $('[name="ativo"]');

    this.btnSalvarMenu = $('[name="btnSalvarMenu"]');
    this.btnApagarMenu = $('[name="btnApagarMenu"]');
    this.linkNovoMenu = $('#linkNovoMenu');

    this.iconFormat = function (icon) {
        var originalOption = icon.element;
        var classe = $(originalOption).val();
        if (classe==='null') classe = 'icon-enlarge noIconColor';
        if (!icon.id) { return icon.text; }
        var $icon = "<i class='" + classe +"'></i>" + icon.text;
        return $icon;
    }; // Formatação dos ícones do Select2 para exibição na combo
}

GerenciarMenusVM.prototype.init = function () {
    var self = this;
    // Carregamento
    self.popularIcones(); // ALEX - removido pois estava dando erro
    self.popularSistemas();
    // Load de plugins
    $('.select2').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Selecione'
    });
    $(".select-icons").select2({
        templateResult: self.iconFormat,
        templateSelection: self.iconFormat,
        escapeMarkup: function(m) { return m; }
    });
    $('.mskInteger').mask("#.##0", {reverse: true});
    // Eventos
    self.eventos();
};
GerenciarMenusVM.prototype.eventos = function () {
    var self = this;
    self.btnSalvarMenu.on('click', function () {
        self.salvarMenu();
    });
    self.btnApagarMenu.on('click', function () {
        self.modalApi.showConfirmation(ModalAPI.WARNING, 'Menu do sistema', 'Tem certeza que deseja apagar o menu <b>'+ self.label.val().toUpperCase() +'</b>? A operação não poderá ser desfeita.', 'Sim', 'Não').onClick('Sim', function () {
            self.apagarMenu(self.idMenu);
        });
    });
    self.linkNovoMenu.on('click', function () {
        self.idSistema.val('').trigger('change');
        self.resetFormMenu();
    });
    self.idSistema.on('change', function () {
        self.carregarMenus( $(this).val() );
    });
    self.idPai.on('click', function () {
        if ( self.idSistema.val() ) {
            self.carregarMenusModal( self.idSistema.val() );
            $('#modalTreeView').modal('show');
        }
        else self.modalApi.showModal(ModalAPI.WARNING, 'Menu do sistema', 'Por favor, selecione um sistema e tente novamente', 'Ok');
    });
    $('#icoEraser').on('click', function () {
        self.idPai.val('');
        self.idPai.attr('data-content', 'null');
    });
};
GerenciarMenusVM.prototype.carregarMenusModal = function (idSistema) {
    var self = this;
    self.loaderApi.show();
    self.modalTreeView.setupDisplayItems([]);
    self.modalTreeView.setupDisplayItems([
        {'key':'icone', 'type':ModernTreeView.ICON},
        {'key':'cor',   'type':ModernTreeView.COLOR},
        {'key':'ativo', 'type':ModernTreeView.ENABLED}
    ]);
    self.modalTreeView.setWebServiceURL('/api/menus/hierarquia/'+ idSistema);
    self.modalTreeView.setOnClick(function (obj) {
        self.idPai.val(obj.label);
        self.idPai.attr('data-content', obj.id);
        $('#modalTreeView').modal('hide');
    });
    self.modalTreeView.setOnLoadSuccessCallback(function (response) {
        self.loaderApi.hide();
    });
    self.modalTreeView.setOnLoadErrorCallback(function (callback, status, error) {
        self.loaderApi.hide();
    });
    self.modalTreeView.load();
};
GerenciarMenusVM.prototype.carregarMenus = function (idSistema) {
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
    self.treeView.setWebServiceURL('/api/menus/hierarquia/'+ idSistema);
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
GerenciarMenusVM.prototype.popularIcones = function () {
    var self = this;
    self.loaderApi.show();
    self.restClient = new RESTClient();
    self.restClient.setMethodGET();
    self.restClient.setWebServiceURL('/Assets/iconmoon.json');
    self.restClient.setSuccessCallbackFunction(function (dados) {
        $.each(dados, function (idx, item) {
            self.icone.append('<option value="'+ item.icon +'">'+ item.icon +'</option>');
        });
        self.loaderApi.hide();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Menu do sistema", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};
GerenciarMenusVM.prototype.popularSistemas = function () {
    var self = this;
    self.loaderApi.show();
    self.restClient.setMethodPOST();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'sistemas');
    self.restClient.setSuccessCallbackFunction(function (dados) {
        $.each(dados.data, function (idx, item) {
            self.idSistema.append('<option value="'+ item.id +'">'+ item.sigla +'</option>');
        });
//        self.popularIcones(); // ALEX - Para garantir que uma execute depois da outra
        self.loaderApi.hide();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Menu do sistema", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};
GerenciarMenusVM.prototype.resetFormMenu = function () {
    var self = this;
    resetarValidacao( self.formCadMenu );
    self.idMenu = null;
    self.idPai.val('');
    self.icone.val('null').trigger('change');
    self.label.val('');
    self.rota.val('');
    self.cor.val('');
    self.ordem.val('');
    self.ativo.prop('checked', true);
    self.btnApagarMenu.addClass('hidden');
};
GerenciarMenusVM.prototype.retornarMenu = function (obj, parentLabel) {
    var self = this;
    self.idMenu = obj.id;
    self.idPai.val(parentLabel);
    self.idPai.attr('data-content', obj.idPai);
    if ( parseInt(self.idSistema.val()) !== obj.idSistema ) self.idSistema.val(obj.idSistema).trigger('change');
    self.icone.val(obj.icone).trigger('change');
    self.label.val(obj.label);
    self.rota.val(obj.rota);
    self.cor.val(obj.cor);
    self.ordem.val(obj.ordem);
    self.ativo.prop('checked', obj.ativo);
    self.btnApagarMenu.removeClass('hidden');
};
GerenciarMenusVM.prototype.salvarMenu = function () {
    var self = this;

    if (!validarCamposRequeridos(self.formCadMenu)) return false;
    var id = self.idMenu ? self.idMenu : '';
    var postData = self.formCadMenu.serializeJSON();
    postData['idPai'] = self.idPai.attr('data-content')==='null' ? null : self.idPai.attr('data-content');
    postData['ordem'] = self.ordem.unmask().val();

    self.loaderApi.show();
    self.restClient.setMethodPUT();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'menus/' + id);
    self.restClient.setDataToSender(postData);
    self.restClient.setSuccessCallbackFunction(function (dados) {
        self.resetFormMenu();
        self.loaderApi.hide();
        self.modalApi.notify(ModalAPI.SUCCESS, 'Menu do sistema', dados['message']);
        self.treeView.load();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Menu do sistema", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};
GerenciarMenusVM.prototype.apagarMenu = function (idMenu) {
    var self = this;
    self.loaderApi.show( $('#pageContainer') );
    self.restClient.setDataToSender({'ids':[idMenu]});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'menus');
    self.restClient.setMethodDELETE();
    self.restClient.setSuccessCallbackFunction(function () {
        self.resetFormMenu();
        self.treeView.load();
        self.loaderApi.hide();
        self.modalApi.notify(ModalAPI.SUCCESS, 'Menu do sistema', 'Menu excluído com sucesso.');
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, 'Menu do sistema', callback.responseJSON, 'OK');
    });
    self.restClient.exec();
};