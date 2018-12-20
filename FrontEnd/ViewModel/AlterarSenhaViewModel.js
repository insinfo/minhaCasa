$(function () {
    var alterarSenhaViewModel = new AlterarSenhaViewModel();
    alterarSenhaViewModel.init();
});
function AlterarSenhaViewModel() {
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;
    this.webservicePmroBaseURL = WEBSERVICE_PMRO_BASE_URL;
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = window.location !== window.parent.location ? window.parent.getModal() : new ModalAPI();

    //form troca de senha
    this.inputCurrentPassword = $('#inputCurrentPassword');
    this.inputNewPassword = $('#inputNewPassword');
    this.inputRepeatNewPassword = $('#inputRepeatNewPassword');
    this.btnSalvarAlteracaoSenha = $('#btnSalvarAlteracaoSenha');
}
AlterarSenhaViewModel.prototype.init = function () {
    var self = this;
    //inicialiaza plugins
    $('.select').selectpicker();
    //FIX DE BUG DO select2 PRA FUNCIONAR NO MODAL
    $.fn.modal.Constructor.prototype.enforceFocus = function () {
    };
    self.eventos();
};
AlterarSenhaViewModel.prototype.eventos = function () {
    var self = this;
    //salva alteração de senha
    self.btnSalvarAlteracaoSenha.on('click', function (e) {
        self.changeUserPassword();
    });
};
AlterarSenhaViewModel.prototype.updateFields = function () {
    var self = this;
    var selects = $('.select');
    //selects.selectpicker('destroy');
    //selects.selectpicker('refresh');
    //selects.selectpicker();
    var template = document.getElementById("templateFormEndereco");
    var isInternetExplorer = template.content === undefined;
    if (!isInternetExplorer) {
        selects.selectpicker('refresh');
    } else {
        selects.selectpicker('destroy');
        //selects.selectpicker();
    }
    self.maskForm();
};
//troca senha
AlterarSenhaViewModel.prototype.changeUserPassword = function () {
    var self = this;

    if (self.inputCurrentPassword.val().length < 6) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Alterar Senha', 'Digite a senha atual!', 'OK');
        return;
    }

    if (self.inputNewPassword.val() !== self.inputRepeatNewPassword.val()) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Alterar Senha', 'As senhas não coincidem!', 'OK');
        return;
    }

    if (self.inputNewPassword.val().length < 8) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Alterar Senha', 'A senha deve ter pelo menos 8 caracteres.', 'OK');
        return;
    }

    var dataToSender = {
        "currentPassword": self.inputCurrentPassword.val(),
        "newPassword": self.inputNewPassword.val()
    };

    self.loaderApi.show();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'usuarios/change/password');
    self.restClient.setMethodPUT();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.SUCCESS, 'Alterar Senha', data['message'], 'OK');
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, 'Alterar Senha', callback.responseJSON, 'OK');
    });
    self.restClient.exec();
};