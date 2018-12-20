$(function () {
    var loginViewModel = new LoginViewModel();
    loginViewModel.init();
});

function LoginViewModel()
{

    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;

    //FORMULARIO DE LOGIN
    this.btnLogar = $('#btnLogar');
    this.inputUserPass = $('#inputSenha');
    this.inputUserName = $('#inputNomeUsuario');

    //TOKEN CONFIG
    this.accessTokenKey = 'YWNjZXNzX3Rva2Vu';
    this.expiresInKey = 'ZXhwaXJlc19pbg==';
    this.loginStatusKey = 'bG9naW5TdGF0dXM=';
    this.tokenTypeKey = 'dG9rZW5fdHlwZQ==';
    this.userFullNameKey = 'ZnVsbF9uYW1l';
    this.expirationTimeKey = 'expirationTime';
    this.intervalFunctionIdKey = 'intervalFunctionId';

    //client ip
    this.ipPrivado = '';
    this.ipPublico = '';
}

LoginViewModel.prototype.init = function () {
    var self = this;

    //get client private ip
    getUserIP(function(ip){
        self.ipPrivado = ip;
    });
    //get client public ip
    $.getJSON('//gd.geobytes.com/GetCityDetails?callback=?', function(data) {
        //console.log(JSON.stringify(data, null, 2));
        self.ipPublico = data['geobytesremoteip'];
        // console.log(self.ipPublico);
    });

    self.eventos();

};
LoginViewModel.prototype.eventos = function () {
    var self = this;
    self.btnLogar.click(function () {
        //redirect('mainView');
        self.autenticar();
    });
};

LoginViewModel.prototype.autenticar = function () {
    var self = this;
    self.loaderApi.show();

    //obtem dados do formulario de login
    var dataToSender = {
        "userName": self.inputUserName.val(),
        "password": self.inputUserPass.val(),
        "ipPrivado": self.ipPrivado,
        "ipPublico": self.ipPublico
    };

    //console.log(dataToSender);

    //faz uma requisição a API Rest para autenticar
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'auth/login');
    self.restClient.setMethodPOST();
    //caso sucesso
    self.restClient.setSuccessCallbackFunction(function (data) {

        self.loaderApi.hide();
        sessionStorage.setItem(self.accessTokenKey, data['access_token']);
        sessionStorage.setItem(self.expiresInKey, data['expires_in']);
        sessionStorage.setItem(self.loginStatusKey, data['login']);
        sessionStorage.setItem(self.tokenTypeKey, data['token_type']);
        sessionStorage.setItem(self.userFullNameKey, data['full_name']);
        sessionStorage.setItem(self.expirationTimeKey, data['expires_in']);

    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        alert('Credencial Invalidaa!');
    });
    self.restClient.exec();
};
LoginViewModel.prototype.checkToken = function () {
    var self = this;
    self.loaderApi.show();
    //faz uma requisição a API Rest para validar token
    self.restClient.setDataToSender({"access_token": sessionStorage.getItem(self.accessTokenKey)});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'auth/check');
    self.restClient.setMethodPOST();
    //caso sucesso
    self.restClient.setSuccessCallbackFunction(function (data) {

        self.loaderApi.hide();
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {

        self.loaderApi.hide();
    });
    self.restClient.exec();
};
LoginViewModel.prototype.logout = function () {
    var self = this;
    sessionStorage.removeItem(self.accessTokenKey);
    sessionStorage.removeItem(self.expiresInKey);
    sessionStorage.removeItem(self.loginStatusKey);
    sessionStorage.removeItem(self.tokenTypeKey);
    sessionStorage.removeItem(self.userFullNameKey);
    sessionStorage.removeItem(self.expirationTimeKey);
    location.reload();
};