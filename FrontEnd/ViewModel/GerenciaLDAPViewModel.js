$(function () {
    var gerenciaLDAPViewModel = new GerenciaLDAPViewModel();
    gerenciaLDAPViewModel.init();
});

function GerenciaLDAPViewModel() {
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = new ModalAPI();
    this.parentModal = window.location !== window.parent.location ? window.parent.getPrincipalVM().defaultModal : $('#defaultModal');
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;

    this.inputCPF = $("#inputCPF");
    this.inputNome = $("#inputNome");
    this.inputLogin = $("#inputLogin");
    this.inputEmail = $("#inputEmail");
    this.textareaDescricao = $("#textareaDescricao");
    this.btnSaveUser = $("#btnSaveUser");

    this.dataTableLoginLDAP = null;
    this.btnBuscarCPF = $("#btnBuscarCPF");

    this.blocoListarUsuariosLDAP = $('#blocoListarUsuariosLDAP');
    this.blocoEdiSistema = $('#blocoEdiSistema');
}

GerenciaLDAPViewModel.prototype.init = function () {
    var self = this;
    self.eventos();
    self.getLogins();
    self.maskForm();
};
GerenciaLDAPViewModel.prototype.eventos = function () {
    var self = this;

    self.btnSaveUser.on('click', function () {
        self.save();
    });

    self.btnBuscarCPF.on('click', function () {
        self.getPessoasFisica();
    });

};
//LISTA USUARIOS LDAP
GerenciaLDAPViewModel.prototype.getLogins = function () {
    var self = this;
    self.loaderApi.show();
    self.dataTableLoginLDAP = new ModernDataTable('tableListUserLdap');
    self.dataTableLoginLDAP.hideRowSelectionCheckBox();
    self.dataTableLoginLDAP.setDisplayCols([
        {"key": "nome"},
        {"key": "login"},
        {"key": "cpfnumber", "type": "cpf"},
        {"key": "mail"},
        {"key": "description"}
    ]);
    self.dataTableLoginLDAP.setIsColsEditable(false);
    //self.dataTableLoginLDAP.defaultLoader(false);
    self.dataTableLoginLDAP.hideActionBtnDelete();
    self.dataTableLoginLDAP.setDataToSender({});
    self.dataTableLoginLDAP.setSourceURL(self.webserviceJubarteBaseURL + 'usuarios/logins');
    self.dataTableLoginLDAP.setSourceMethodPOST();
    self.dataTableLoginLDAP.setOnLoadedContent(function () {
        self.loaderApi.hide();
    });
    self.dataTableLoginLDAP.setOnClick(function (data) {
        self.inputCPF.val(jMPMaskValue(data['cpfnumber'],'000.000.000-00'));
        self.inputNome.val(data['nome']);
        self.inputLogin.val(data['login']);
        self.inputEmail.val(data['mail']);
        self.textareaDescricao.val(data['description']);
        self.blocoEdiSistema.collapse('show');
        self.inputCPF.focus();
    });
    self.dataTableLoginLDAP.load();
};
GerenciaLDAPViewModel.prototype.maskForm = function () {
    var self = this;
    self.inputCPF.mask('000.000.000-00', {reverse: true});
};
GerenciaLDAPViewModel.prototype.validaEmailOnServer = function (email, callback) {
    var self = this;

    if (email) {

        self.restClient.setDataToSender(null);
        self.restClient.setWebServiceURL('https://api.trumail.io/v2/lookups/json?email=' + email);
        self.restClient.setMethodGET();
        self.restClient.setSuccessCallbackFunction(function (data) {

            /*
             {
                "address": "insinfo2008@gmail.com",
                "username": "insinfo2008",
                "domain": "gmail.com",
                "md5Hash": "4d8839b45e72960cbe23f5fe18ff13e5",
                "suggestion": "",
                "validFormat": true,
                "deliverable": true,
                "fullInbox": false,
                "hostExists": true,
                "catchAll": false,
                "gravatar": false,
                "role": false,
                "disposable": false,
                "free": false
            }*/

            if (typeof callback === 'function') {
                var isValid = data['deliverable'];
                callback(isValid);
            }

        });
        self.restClient.setErrorCallbackFunction(function (d) {

            if (typeof callback === 'function') {
                callback(false);
            }

        });
        self.restClient.exec();
    }

};
GerenciaLDAPViewModel.prototype.getPessoasFisica = function () {
    var self = this;

    var idDataTable = "tableListaPessoa";

    var html = "<div class=\"modernDataTable\">" +
        "<table class=\"table tasks-list table-lg dataTable no-footer\" id=\"" + idDataTable + "\">\n" +
        "<thead>" +
        "<tr>" +
        "<th>Nome</th>" +
        "<th>CPF</th>" +
        "<th>RG</th>" +
        "<th>Sigla Lotação</th>" +
        "<th>Local Trabalho</th>" +
        "</tr>" +
        "</thead>" +
        "<tbody>" +
        "</tbody>" +
        "</table>" +
        "</div>";

    self.parentModal.find('.modal-body').empty().append(html);

    // mostra loader
    self.loaderApi.show();

    self.parentModal.on('shown.bs.modal', function () {
        // self.setInputFocus("tableListaPessoa_inputSearch");
    });

    self.parentModal.modal('show');

    // cria o modernDataTable
    self.dataTablesPessoa = new ModernDataTable(self.parentModal.find('#' + idDataTable));

    // self.dataTablesPessoa.showActionBtnAdd();
    self.dataTablesPessoa.setDisplayCols([
        {"key": "nome"},
        {"key": "cpf"},
        {"key": "rg"},
        {"key": "siglaLotacao"},
        {"key": "nomeLocalTrabalho"}
    ]);
    self.dataTablesPessoa.setIsColsEditable(false);
    self.dataTablesPessoa.hideActionBtnDelete();
    self.dataTablesPessoa.hideRowSelectionCheckBox();
    self.dataTablesPessoa.setDataToSender({"tipo": "fisica"});
    self.dataTablesPessoa.setSourceURL(self.webserviceJubarteBaseURL + 'servidores');
    self.dataTablesPessoa.setSourceMethodPOST();

    self.dataTablesPessoa.setOnLoadedContent(function () {
        self.loaderApi.hide();

    });
    self.dataTablesPessoa.setOnClick(function (rowData) {
        // var idPessoa = rowData['idPessoa'];

        self.inputCPF.val(jMPMaskValue(rowData['cpf'],'000.000.000-00'));
        self.inputEmail.val(rowData['emailPrincipal']);


        self.parentModal.modal('hide');
    });
    self.dataTablesPessoa.setOnAddItemAction(function (response) {
        self.parentModal.on('hidden.bs.modal', function () {
            // location.href = '/pages/gerenciaPessoaMin';
        });
        self.parentModal.modal('hide');
    });

    self.dataTablesPessoa.load();
};
GerenciaLDAPViewModel.prototype.save = function () {
    var self = this;

    if (self.inputLogin.val() === '') {
        self.modalApi.notify(ModalAPI.ERROR, 'Gerencia LDAP', 'Você não selecionou ninguem na lista');
        self.blocoListarUsuariosLDAP.collapse('show');
        self.blocoEdiSistema.collapse('hide');
        return;
    }

    if (!validaCPF(self.inputCPF.cleanVal())) {
        self.modalApi.notify(ModalAPI.ERROR, 'Gerencia LDAP', 'CPF Invalido');
        return;
    }

    var dataToSender = {
        "cpf": self.inputCPF.cleanVal(),
        "nome": self.inputNome.val(),
        "userName": self.inputLogin.val(),
        "email": self.inputEmail.val(),
        "descricao": self.textareaDescricao.val()
    };

    //console.log(dataToSender);

    self.loaderApi.show();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'usuarios/change/cpf');
    self.restClient.setMethodPUT();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        self.modalApi.notify(ModalAPI.SUCCESS, 'Gerencia LDAP', data['message']);
        self.blocoListarUsuariosLDAP.collapse('show');
        self.blocoEdiSistema.collapse('hide');
        self.dataTablesPessoa.reload();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, 'Gerencia LDAP', callback.responseJSON, 'OK');
    });
    self.restClient.exec();
};
