$(function () {
    var alterarLDAPView = new AlterarLDAPView();
    alterarLDAPView.init();
});

function AlterarLDAPView() {
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = new ModalAPI();
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;

    this.inputNomePessoa = $("#inputNomePessoa");
    this.inputUserName = $("#inputUserName");
    this.inputSenha = $("#inputSenha");
    this.inputRepetirSenha = $("#inputRepetirSenha");

    this.idOrganograma = null;
    this.dataTableServidores = new ModernDataTable('tableListServidores');
    this.modalListaLDAP = $("#modalListaLDAP");
    this.btnCadastrar = $("#btnCadastrar");


    this.firstName = null;
    this.lastName = null;

    this.userEmail = null;
}

AlterarLDAPView.prototype.init = function () {
    var self = this;
    self.eventos();
    self.getLogins();
};
AlterarLDAPView.prototype.eventos = function () {
    var self = this;

    //
    self.btnCadastrar.on('click', function () {
        self.changeUserPassword();
    });

    self.inputSenha.on('blur', function () {
        if (self.inputSenha.val().length < 8) {
            var inputBlock = self.inputSenha.closest('.inputBlock');
            inputBlock.find('small').text('A senha deve ter 8 caracteres no minimo.');
            inputBlock.removeClass('has-success');
            inputBlock.removeClass('has-error').addClass('has-error');

        } else {
            self.inputSenha.closest('.inputBlock').removeClass('has-error');
            self.inputSenha.closest('.inputBlock').removeClass('has-success').toggleClass('has-success');
        }
    });

    self.inputRepetirSenha.on('blur', function () {
        if (self.inputRepetirSenha.val() !== self.inputSenha.val()) {
            var inputBlock2 = self.inputRepetirSenha.closest('.inputBlock');
            inputBlock2.find('small').text('A senha deve coincidir!');
            inputBlock2.removeClass('has-success');
            inputBlock2.removeClass('has-error').addClass('has-error');
        } else {
            self.inputRepetirSenha.closest('.inputBlock').find('small').text('ok!');
            self.inputRepetirSenha.closest('.inputBlock').removeClass('has-error');
            self.inputRepetirSenha.closest('.inputBlock').removeClass('has-success').toggleClass('has-success');
        }
        if (self.inputRepetirSenha.val().length < 8) {
            var inputBlock3 = self.inputRepetirSenha.closest('.inputBlock');
            inputBlock3.find('small').text('A senha deve ter 8 caracteres no minimo.');
            inputBlock3.removeClass('has-success');
            inputBlock3.removeClass('has-error').addClass('has-error');
            return false;
        } else {
            self.inputRepetirSenha.closest('.inputBlock').removeClass('has-error');
            self.inputRepetirSenha.closest('.inputBlock').removeClass('has-success').toggleClass('has-success');
        }
    });
    /*self.selectSistema.on('change',function () {
        var idSistema = $(this).val();
        self.getPerfis(idSistema);
    });*/
};
//LISTA USUARIOS LDAP
AlterarLDAPView.prototype.getLogins = function () {
    var self = this;
    //self.loaderApi.show();
    self.dataTableLoginLDAP = new ModernDataTable('tableListaLoginLDAP');
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
        //self.loaderApi.hide();
        self.modalListaLDAP.modal('show');
    });
    self.dataTableLoginLDAP.setOnClick(function (data) {
        self.inputNomePessoa.val(data['nome']);
        self.inputUserName.val(data['login']);
        self.modalListaLDAP.modal('hide');
    });
    self.dataTableLoginLDAP.load();
};

AlterarLDAPView.prototype.validaForm = function () {
    var self = this;

    if (self.inputNomePessoa.val() === '') {
        var inputBlock1 = self.inputNomePessoa.closest('.inputBlock');
        inputBlock1.find('small').text('Selecione uma pessoa.');
        inputBlock1.removeClass('has-success');
        inputBlock1.removeClass('has-error').addClass('has-error');
        return false;
    } else {
        self.inputNomePessoa.closest('.inputBlock').find('small').text('');
        self.inputNomePessoa.closest('.inputBlock').removeClass('has-error');
        self.inputNomePessoa.closest('.inputBlock').removeClass('has-success').toggleClass('has-success');
    }

    if (self.inputSenha.val().length < 8) {
        var inputBlock = self.inputSenha.closest('.inputBlock');
        inputBlock.find('small').text('A senha deve ter 8 caracteres no minimo.');
        inputBlock.removeClass('has-success');
        inputBlock.removeClass('has-error').addClass('has-error');
        return false;
    } else {
        self.inputSenha.closest('.inputBlock').removeClass('has-error');
        self.inputSenha.closest('.inputBlock').removeClass('has-success').toggleClass('has-success');
    }

    if (self.inputRepetirSenha.val() !== self.inputSenha.val()) {
        var inputBlock2 = self.inputRepetirSenha.closest('.inputBlock');
        inputBlock2.find('small').text('A senha deve coincidir!');
        inputBlock2.removeClass('has-success');
        inputBlock2.removeClass('has-error').addClass('has-error');
        return false;
    } else {
        self.inputRepetirSenha.closest('.inputBlock').find('small').text('ok!');
        self.inputRepetirSenha.closest('.inputBlock').removeClass('has-error');
        self.inputRepetirSenha.closest('.inputBlock').removeClass('has-success').toggleClass('has-success');
    }

    if (self.inputRepetirSenha.val().length < 8) {
        var inputBlock3 = self.inputRepetirSenha.closest('.inputBlock');
        inputBlock3.removeClass('has-success');
        inputBlock3.removeClass('has-error').addClass('has-error');
        return false;
    } else {
        self.inputRepetirSenha.closest('.inputBlock').removeClass('has-error');
        self.inputRepetirSenha.closest('.inputBlock').removeClass('has-success').toggleClass('has-success');
    }
    return true;
};
AlterarLDAPView.prototype.changeUserPassword = function () {
    var self = this;

    if (self.inputSenha.val().length < 8) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Alterar Senha', 'A senha deve ter no minimo 8 caracteres!', 'OK');
        return;
    }

    if (self.inputSenha.val() !== self.inputRepetirSenha.val()) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Alterar Senha', 'As senhas não coincidem!', 'OK');
        return;
    }

    var dataToSender = {
        "userName": self.inputUserName.val(),
        "newPassword": self.inputSenha.val()
    };

    self.loaderApi.show();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'usuarios/change/password');
    self.restClient.setMethodPUT();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.SUCCESS, 'Alterar Senha', data['message'], 'OK',function () {
            var currentLocation = window.location.href;
            window.location.href = currentLocation;
        });

    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, 'Alterar Senha', callback.responseJSON, 'OK');
    });
    self.restClient.exec();
};