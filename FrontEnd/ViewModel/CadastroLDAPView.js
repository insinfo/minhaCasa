$(function () {
    var cadastroLDAPViewModel = new CadastroLDAPViewModel();
    cadastroLDAPViewModel.init();
});
function CadastroLDAPViewModel() {

    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = new ModalAPI();
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;

    this.inputNomePessoa = $("#inputNomePessoa");
    this.inputUserName = $("#inputUserName");
    this.inputSenha = $("#inputSenha");
    this.inputRepetirSenha = $("#inputRepetirSenha");
    this.selectPerfil = $("#selectPerfil");
    this.selectSistema = $("#selectSistema");
    this.idOrganograma = null;
    this.dataTableServidores = new ModernDataTable('tableListServidores');
    this.modalListaServidor = $("#modalListaServidor");
    this.btnCadastrar = $("#btnCadastrar");
    this.btnGeneratePassIcon = $("#btnGeneratePassIcon");
    this.btnGeneretePassTop = $("#btnGeneretePassTop");
    this.btnImprimir = $("#btnImprimir");
    this.servidorData = null;
    this.idSistemaJubarte = 1;
    this.idPerfilServidor = 9;
    this.firstName = null;
    this.lastName = null;
    this.userEmail = null;
    this.sobrenomes = null;
    this.selectLocalDeRede = $("#selectLocalDeRede");
}
CadastroLDAPViewModel.prototype.init = function () {
    var self = this;
    self.eventos();
    self.getSistemas();
    self.getAllServidores();
};
CadastroLDAPViewModel.prototype.eventos = function () {
    var self = this;

    //
    self.btnCadastrar.on('click', function () {
        self.save();
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

    self.btnGeneratePassIcon.on('click', function () {
        var senhaGerada = generateSimplePassword(8);

        self.btnGeneretePassTop.find('span').text(senhaGerada);
        self.btnGeneretePassTop.find('span').css({"text-transform": "none"});
        self.inputSenha.val(senhaGerada);
        self.inputRepetirSenha.val(senhaGerada);
        //console.log(selectText( self.btnGeneretePassTop.find('span')));
        copyTextToClipboard(senhaGerada);

    });

    self.btnGeneretePassTop.on('click', function () {
        var senhaGerada = generateSimplePassword(8);

        self.btnGeneretePassTop.find('span').text(senhaGerada);
        self.btnGeneretePassTop.find('span').css({"text-transform": "none"});
        self.inputSenha.val(senhaGerada);
        self.inputRepetirSenha.val(senhaGerada);
        //console.log(selectText( self.btnGeneretePassTop.find('span')));
        copyTextToClipboard(senhaGerada);
    });

    self.btnImprimir.on('click', function () {
        self.imprimir();
    });
};
//LISTA SERVIDORES
CadastroLDAPViewModel.prototype.getAllServidores = function () {
    var self = this;
    self.dataTableServidores.setDisplayCols([
        {"key": "id"},
        {"key": "matricula"},
        {"key": "nome"},
        {
            "key": "dataNascimento", "render": function (row) {
                return sqlDateToBrasilDate(row['dataNascimento']);
            }
        },
        {
            "key": "cpf", "render": function (row) {
                return row['cpf'];
            }
        },
        {"key": "rg"},
        {"key": "siglaLotacao"}
    ]);
    self.dataTableServidores.hideActionBtnDelete();
    self.dataTableServidores.hideRowSelectionCheckBox();
    self.dataTableServidores.setIsColsEditable(false);
    self.dataTableServidores.setDataToSender({});
    self.dataTableServidores.setSourceURL(self.webserviceJubarteBaseURL + 'servidores');
    self.dataTableServidores.setSourceMethodPOST();
    self.dataTableServidores.setOnDeleteItemAction(function (ids) {
    });
    self.dataTableServidores.setOnClick(function (data) {
        self.servidorData = data;
        self.inputNomePessoa.val(data['nome']);
        self.userEmail = (data['emailPrincipal']);
        self.generateLogin(data['nome'], data['cpf']);
        self.modalListaServidor.modal('hide');
    });
    //desabilita o Loader padrão
    //self.dataTablePerfil.defaultLoader(false);
    self.dataTableServidores.setOnReloadAction(function () {
    });
    // mostra o Loader quando clicar no botão reload do dataTable
    self.dataTableServidores.setOnLoadedContent(function () {
    });
    // quando concluir o carregamento esconde o loader
    self.dataTableServidores.setOnAddItemAction(function () {

    });
    self.dataTableServidores.setOnDeleteItemAction(function (ids) {

    });
    self.dataTableServidores.load();
};
CadastroLDAPViewModel.prototype.getPerfis = function (idSistema, selecionado) {
    var self = this;
    self.loaderApi.show();
    self.restClient.setMethodPOST();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'perfis');
    self.restClient.setDataToSender({"idSistema": idSistema});
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        data = data['data'];
        populateSelect(self.selectPerfil, data, 'id', 'sigla', selecionado, null);
        self.selectPerfil.selectpicker('refresh');
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};
CadastroLDAPViewModel.prototype.getSistemas = function () {
    var self = this;
    self.loaderApi.show();
    self.restClient.setMethodPOST();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'sistemas');
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        data = data['data'];
        populateSelect(self.selectSistema, data, 'id', 'sigla', self.idSistemaJubarte, null);
        self.selectSistema.selectpicker('refresh');
        self.getPerfis(self.idSistemaJubarte, self.idPerfilServidor);
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};
CadastroLDAPViewModel.prototype.validaForm = function () {
    var self = this;

    if (self.servidorData == null) {
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

    if (self.selectLocalDeRede.val() === 'null') {
        var inputBlock4 = self.selectLocalDeRede.closest('.inputBlock');
        inputBlock4.removeClass('has-success');
        inputBlock4.removeClass('has-error').addClass('has-error');
        self.modalApi.notify(ModalAPI.ERROR, "Erro", 'Selecione um local de rede!');
        return false;
    } else {
        self.inputRepetirSenha.closest('.inputBlock').removeClass('has-error');
        self.inputRepetirSenha.closest('.inputBlock').removeClass('has-success').toggleClass('has-success');
    }

    return true;
};
CadastroLDAPViewModel.prototype.generateLogin = function (fullName, cpf) {
    var self = this;

    fullName = fullName.trim();
    self.sobrenomes = fullName.substr(fullName.indexOf(" ") + 1);
    var nameArr = fullName.split(/[\s]+/);
    // /\s+/g corresponde a qualquer caractere de espaço em branco

    self.firstName = nameArr[0].trim();//nameArr.slice(0, -1).join(" ");
    self.lastName = nameArr.pop().trim();

    self.userNameOp1 = sanitationString(self.firstName) + '.' + sanitationString(self.lastName);

    if(nameArr.length > 1) {
        self.userNameOp2 = sanitationString(self.firstName) + '.' + sanitationString(nameArr[1]);
    }else {
        self.userNameOp2 = sanitationString(self.firstName) + '.' + sanitationString(self.lastName)+'2';
    }

    var dataToSender = {
        "fullName": fullName,
        "cpf": cpf,
        "userName": [self.userNameOp1, self.userNameOp2]
    };

    self.checkIfExist(dataToSender, function (data) {
        self.inputUserName.val(data['result']);
    });
};
CadastroLDAPViewModel.prototype.checkIfExist = function (dataToSender, callback) {
    var self = this;
    self.loaderApi.show();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setMethodPOST();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'usuarios/exist');
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        if (typeof  callback === 'function') {
            callback(data);
        }
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", callback.responseJSON, "OK");
    });
    self.restClient.exec();
};
CadastroLDAPViewModel.prototype.save = function () {
    var self = this;

    if (!self.validaForm()) {
        return;
    }

    var usuarioJubarte = {
        "idPessoa": self.servidorData['idPessoa'],
        "idOrganograma": self.servidorData['idLotacao'],
        "login": self.inputUserName.val(),
        "ativo": true,
        "idSistema": self.idSistemaJubarte,
        "idPerfil": self.idPerfilServidor
    };

    var usuarioLDAP = {
        "fullName": self.inputNomePessoa.val().trim(),
        "firstName": self.firstName.trim(),
        "lastName": self.lastName.trim(),
        "userName": self.inputUserName.val().trim(),
        "userCpf": self.servidorData['cpf'],
        "userEmail": self.userEmail ? self.userEmail.trim() : 'vazio',
        "userPassword": self.inputSenha.val(),
        "description": 'Local de Trabalho: ' + self.servidorData['siglaLocalTrabalho'] + ' | Lotacão: ' + self.servidorData['siglaLotacao'],
        "company": self.servidorData['siglaLocalTrabalho'].trim(),
        "sobrenomes":self.sobrenomes,
        "descricao":self.selectLocalDeRede.val()
    };

    var dataToSender = {
        "usuarioJubarte": usuarioJubarte,
        "usuarioLDAP": usuarioLDAP
    };

    console.log(dataToSender);

    self.loaderApi.show();
    self.restClient.setMethodPUT();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'usuarios/create');
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.SUCCESS, "Sucesso", 'Login: ' + data['userName'] + ' ' + data['message'], "OK");
    });
    self.restClient.setErrorCallbackFunction(function (xhr) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", xhr['responseJSON'], "OK");
    });
    self.restClient.exec();
};
CadastroLDAPViewModel.prototype.imprimir = function () {
    var self = this;

    var body = $('body');
    body.find("iframe[name='print_frame']").remove();//style="position: fixed;"
    body.append('<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank" ></iframe>');
    var frame = body.find("iframe[name='print_frame']");

    var style = '';
    //frame.contents().find('head').append(style);
    //frame.contents().find('body').html($('#templateCartaSenha').html());

    var iFrameDoc = frame[0].contentDocument || frame[0].contentWindow.document;
    frame.on('load', function () {
        frame.focus();
        window.frames["print_frame"].window.onbeforeprint = function () {
            //console.log('onbeforeprint');
        };
        window.frames["print_frame"].window.onafterprint = function () {
            //console.log('onafterprint');

            body.find("iframe[name='print_frame']").remove();
        };
        window.frames["print_frame"].window.print();
    });

    iFrameDoc.write($('#templateCartaSenha').html());
    iFrameDoc.close();
    $(iFrameDoc).find('#spanData').text(moment().format('DD/MM/YYYY'));
    var texto = 'Senhor(a) ' + self.inputNomePessoa.val()
        + '</BR> Sua senha é: <span style="font-size: 20px;">' + self.inputSenha.val()+'</span>'
        + '</BR> Seu login é: <span style="font-size: 20px;">'+ self.inputUserName.val()+'</span>';

    $(iFrameDoc).find('#paragrafoTexto').html(texto);

};