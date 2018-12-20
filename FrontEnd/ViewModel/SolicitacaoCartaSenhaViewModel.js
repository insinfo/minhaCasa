$(function () {
    var solicitacaoCartaSenhaViewModel = new SolicitacaoCartaSenhaViewModel();
    solicitacaoCartaSenhaViewModel.init();
});

function SolicitacaoCartaSenhaViewModel() {

    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;
    this.webservicePmroBaseURL = WEBSERVICE_PMRO_BASE_URL;
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = window.location !== window.parent.location ? window.parent.getModal() : new ModalAPI();

    //MODAL BUSCA CEP
    this.dataTableCEPCorreios = new ModernDataTable('tableListCEPCorreios');
    this.selectMunicipioBuscaCEP = $('#selectMunicipioBuscaCEP');
    this.selectUfBuscaCEP = $('#selectUfBuscaCEP');
    this.inputLogradouroBuscaCEP = $('#inputLogradouroBuscaCEP');
    this.inputBairroBuscaCEP = $('#inputBairroBuscaCEP');
    this.btnBuscarCEPEnd = $('#btnBuscarCEPEnd');
    this.modalBuscaCEP = $('#modalBuscaCEP');

    this.correntEndereco = null;
    this.mtvHierarchyOU = null;
    this.mtvOrganograma = null;
    this.modalHierarchyOU = $('#modalHierarchyOU');
    this.btnSelectLocalDeRede = $('#btnSelectLocalDeRede');
    this.modalOrganograma = $('#modalOrganograma');

    this.wizard = null;
    this.body = $('body');

    this.idPessoa = null;
    this.cpf = null;
    this.organogramaSigla = null;
    this.organogramaId = null;
    this.organogramaNome = null;
    this.nomeSolicitante = null;
    this.locaisDeRedeSelecionados = null;
    this.isUsuarioCadastradoPorAqui = false;
}

SolicitacaoCartaSenhaViewModel.prototype.init = function () {
    var self = this;

    self.initPlugins();
    self.events();

    self.getPaises();
    self.getUFs();
    self.getMunicipios();
    self.listCEPbyEndereco();
    self.getAllHierarchyOU();
    self.getAllHierarchyOrganograma();

    /* self.getAllOrgao();
     self.getAllUnidade();
     self.getAllDepartamento();\\192.168.66.80\vol_ti\desenvolvimento*/
};
SolicitacaoCartaSenhaViewModel.prototype.initPlugins = function () {
    var self = this;

    self.wizard = $(".steps-basic").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        labels: {
            finish: 'Finalizar', next: 'Proximo', previous: 'Anterior'
        },
        disableChangeStepBtn: true
    });
    //event click on title
    self.wizard.on('click', 'ul[role="tablist"] li a:not([href="#next"])', function (e) {
        e.preventDefault();
    });

    //event click on next btn
    self.wizard.on('click', 'ul[role="menu"] li a[href="#next"]', function (e) {
        var currentIndex = self.wizard.steps('getCurrentIndex');
        switch (currentIndex) {
            case 0:
                self.getPessoa();
                break;
            case 1:
                self.savePessoa();
                break;
            case 2:
                self.createCartaSenha();
                break;
            default:
        }
        e.preventDefault();
    });
    //event click on previous btn
    self.wizard.on('click', 'ul[role="menu"] li a[href="#previous"]', function (e) {
        //  wizard.steps("setStep", 2);
        e.preventDefault();
    });
    disableNewTabOnMiddleMouseBtn();
    //inicialiaza plugin select
    $('body').find('select').not('.dataTableSelectItemsPerPage').each(function (idx, item) {
        $(this).selectpicker();
    });
    self.maskForm();

    /*
    // Basic wizard setup
    var wizard = $(".steps-basic").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="number">#index#</span> #title#',
        labels: {
            finish: 'Finalizar', next: 'Proximo', previous: 'Anterior'
        },
        enableAllSteps: true,
        enableKeyNavigation: false,
        enablePagination: true,
        onStepChanging: function (event, currentIndex, newIndex) {

            //  return false;
            wizard.steps("setStep", 2);
            //wizard.find('ul[role="tablist"] li a').get(2).click();

            return false;
        },
        onStepChanged: function (event, currentIndex, newIndex) {
           // console.log(wizard.find('ul[role="tablist"] li a').get(2).click());
        },
        onFinished: function (event, currentIndex) {
            alert("Form submitted.");
        }
    });*/
};
SolicitacaoCartaSenhaViewModel.prototype.events = function () {
    var self = this;

    //evento on change do select uf para obter municipios
    self.body.on('change', '[name="uf"]', function (e) {
        var divEndereco = $(this).closest(('div[class^="enderecoItem"]'));
        var selectMunicipio = divEndereco.find('[name="municipio"]');
        var selectUF = $(this);
        self.getMunicipios(selectMunicipio, selectUF.val());
    });

    //quando selecionar um estado de UfBuscaCEP obtem os municipios deste estado
    self.selectUfBuscaCEP.change(function (e) {
        self.getMunicipios(self.selectMunicipioBuscaCEP, self.selectUfBuscaCEP.val());
    });

    //quando selecionar um pais diferente de Brasil desativa os selects uf e municipio
    self.body.on('change', '[name="pais"]', function (e) {
        var divEndereco = $(this).closest(('div[class^="enderecoItem"]'));

        if ($(this).find("option:selected").text() !== 'Brasil') {
            divEndereco.find('[name="municipio"]').prop('disabled', true);
            divEndereco.find('[name="uf"]').prop('disabled', true);
        }
        else {
            divEndereco.find('[name="municipio"]').prop('disabled', false);
            divEndereco.find('[name="uf"]').prop('disabled', false);
        }
        self.updateFields();
    });

    //BUSCA CEP POR ENDERECO
    self.btnBuscarCEPEnd.click(function () {
        var dataToSender = {
            'uf': converterEstados(self.selectUfBuscaCEP.find('option:selected').text()),
            'municipio': self.selectMunicipioBuscaCEP.find('option:selected').text(),
            'bairro': self.inputBairroBuscaCEP.val(),
            'logradouro': self.inputLogradouroBuscaCEP.val()
        };
        console.log(dataToSender);
        self.dataTableCEPCorreios.setDataToSender(dataToSender);
        self.dataTableCEPCorreios.reload();
    });

    self.body.on('click', '.btnShowModalBuscaCEP', function () {
        self.correntEndereco = $(this).closest(('div[class^="enderecoItem"]'));
    });

    //buscar endeço nos correios pelo cep informado e preencher os campos de endereço
    self.body.on('click', '.btnPreencherEndereco', function () {
        var divEndereco = $(this).closest(('div[class^="enderecoItem"]'));
        var correntCep = divEndereco.find('[name="cep"]').cleanVal();
        if (!correntCep) {
            //alert('CEP não pode ser vazio');
            self.modalApi.showModal(ModalAPI.ERROR, "Erro", 'CEP não pode ser vazio', "OK");
        }
        else {
            self.getEnderecoByCEP(correntCep, divEndereco);
        }

    });
    //
    self.body.on('change', '#selectTipoDeConta', function (e) {
        var currentOptionVal = $(this).find('option:selected').val();
        self.showTabByName(currentOptionVal);
    });

    self.body.on('click', '#inputLDAPLocalDeRede', function () {
        self.modalHierarchyOU.modal('show');
    });

    self.body.on('click', '#inputOrganograma', function () {
        self.modalOrganograma.modal('show');
    });

    self.btnSelectLocalDeRede.click(function (e) {
        self.modalHierarchyOU.modal('hide');
        self.locaisDeRedeSelecionados = self.mtvHierarchyOU.getChecked('id');
        var locais = self.mtvHierarchyOU.getChecked('label');
        self.body.find('#inputLDAPLocalDeRede').val(locais.join(' ,'));
    });

};
SolicitacaoCartaSenhaViewModel.prototype.maskForm = function () {
    var self = this;
    //$("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
    self.body.find('#cpf').mask('000.000.000-00', {reverse: true});
    self.body.find('#dataNascimento').mask('00/00/0000');
    self.body.find('#enderecoContainer').find('[name="cep"]').each(function () {
        $(this).mask('99999-999');
    });

    self.body.off('focus', '[name="numeroTelefone"]');
    self.body.on('focus', '[name="numeroTelefone"]', function () {
        var numeroTelefone = $(this);
        var tipoTelefone = numeroTelefone.closest('div[class^="telefoneItem"]').find('[name="tipoTelefone"]');

        if (!tipoTelefone.val()) {
            $(this).keydown(function () {
                return false;
            });
            self.modalApi.warning('Selecione o tipo de telefone primeiro!');
            tipoTelefone.focus();
        }
        else if (tipoTelefone.val() === 'Móvel') {
            numeroTelefone.unbind('keydown');
            numeroTelefone.mask("(00)00000-0000");
        }
        else if (tipoTelefone.val() === 'WhatsApp') {
            numeroTelefone.unbind('keydown');
            numeroTelefone.mask("(00)00000-0000");
        }
        else {
            numeroTelefone.unbind('keydown');
            numeroTelefone.mask("(00)0000-0000");
        }

    });

};
//INICIALIZA DATATABLE BUSCA CEP POR ENDERECO
SolicitacaoCartaSenhaViewModel.prototype.listCEPbyEndereco = function () {
    var self = this;
    var columnsConfiguration = [
        {"key": "tipo"},
        {"key": "logradouro"},
        {"key": "complemento"},
        {"key": "bairro"},
        {"key": "municipio"},
        {"key": "uf"},
        {"key": "cep"}
    ];
    var dataToSender = {
        'uf': 'RJ',
        'municipio': 'Rio das Ostras',
        'bairro': 'Centro',
        'logradouro': 'Rodovia Amaral'
    };
    self.dataTableCEPCorreios.setDisplayCols(columnsConfiguration);
    self.dataTableCEPCorreios.hideTableHeader();
    self.dataTableCEPCorreios.hideActionBtnDelete();
    self.dataTableCEPCorreios.hideRowSelectionCheckBox();
    self.dataTableCEPCorreios.setIsColsEditable(false);
    self.dataTableCEPCorreios.showActionBtnAdd();
    self.dataTableCEPCorreios.setDataToSender(dataToSender);
    self.dataTableCEPCorreios.setSourceURL(self.webserviceJubarteBaseURL + "correios/cep");
    self.dataTableCEPCorreios.setSourceMethodPOST();
    self.dataTableCEPCorreios.setOnClick(function (data) {
        var cep = data['cep'].replace('-', '').trim();
        self.getEnderecoByCEP(cep, self.correntEndereco);
        self.modalBuscaCEP.modal('hide');
    });
    self.dataTableCEPCorreios.load();
};
SolicitacaoCartaSenhaViewModel.prototype.getEnderecoByCEP = function (cep, refCorrentDivEndereco) {
    var self = this;
    self.loaderApi.show();

    /*refCorrentDivEndereco.find('[name="bairro"]').prop('disabled', true);
    refCorrentDivEndereco.find('[name="uf"]').prop('disabled', true);
    refCorrentDivEndereco.find('[name="municipio"]').prop('disabled', true);
    refCorrentDivEndereco.find('[name="logradouro"]').prop('disabled', true);
    refCorrentDivEndereco.find('[name="tipoLogradouro"]').prop('disabled', true);*/

    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'correios/endereco/' + cep);
    self.restClient.setMethodGET();
    self.restClient.setDataToSender(null);
    self.restClient.setSuccessCallbackFunction(function (data) {
        //set o input validacao para true
        var estadoCorreios = data['uf'];
        var municipioCorreios = data['municipio'];
        var tipoLogradouroCorreios = data['tipo'];

        refCorrentDivEndereco.find('[name="validacao"]').val('true');
        refCorrentDivEndereco.find('[name="cep"]').val(data['cep']);

        //seleciona o PAIS
        var selectPais = refCorrentDivEndereco.find('[name="pais"]');
        setSelectIsContain(selectPais, 'brasil');
        self.updateFields();

        //seleciona o ESTADO
        var selectUf = refCorrentDivEndereco.find('[name="uf"]');
        setSelectIsContain(selectUf, estadoCorreios);
        self.updateFields();

        //dispara o evento change preenchendo o select municipio com as municipios
        //do estado do CEP e seta o municipio do CEP
        var timerFunc = setInterval(function () {
            if (self.loaderApi.isLoading() === false) {
                clearInterval(timerFunc);
                var selectMunicipio = refCorrentDivEndereco.find('[name="municipio"]');
                setSelectIsContain(selectMunicipio, municipioCorreios);
                self.updateFields();
            }
        }, 500);

        refCorrentDivEndereco.find('[name="bairro"]').val(data['bairro']);
        refCorrentDivEndereco.find('[name="logradouro"]').val(data['logradouro']);

        var selectTipoLogradouro = refCorrentDivEndereco.find('[name="tipoLogradouro"]');
        if (!setSelectIsContain(selectTipoLogradouro, tipoLogradouroCorreios)) {
            selectTipoLogradouro.append($('<option>', {
                value: tipoLogradouroCorreios, text: tipoLogradouroCorreios
            }).attr("selected", true));
        }
        self.updateFields();
        self.loaderApi.hide();
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        refCorrentDivEndereco.find('[name="bairro"]').prop('disabled', false);
        refCorrentDivEndereco.find('[name="uf"]').prop('disabled', false);
        refCorrentDivEndereco.find('[name="municipio"]').prop('disabled', false);
        refCorrentDivEndereco.find('[name="logradouro"]').prop('disabled', false);
        refCorrentDivEndereco.find('[name="tipoLogradouro"]').prop('disabled', false);
        //alert('Não foi possível obter endereço pelo CEP informado.');
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", jqXHR.responseJSON, "OK");
    });
    self.restClient.exec();
};
SolicitacaoCartaSenhaViewModel.prototype.updateFields = function () {
    var self = this;

    $('body').find('select').not('.dataTableSelectItemsPerPage').each(function (idx, item) {
        $(this).selectpicker('refresh');
    });

    //$('*:not(.bootstrap-select) > .selectpicker').selectpicker('refresh');

    /* var remove = $('.bootstrap-select');
     $(remove).replaceWith($(remove).contents('.selectpicker'));
     $('.selectpicker').selectpicker();*/

    //self.maskForm();
};
SolicitacaoCartaSenhaViewModel.prototype.getPessoa = function () {
    var self = this;
    var inputCheckCPF = $('#inputCheckCPF');
    var cpf = inputCheckCPF.val();

    if (validaCPF(cpf)) {
        cpf = cpf.replace(/\D/g, '');

        self.loaderApi.show();
        self.restClient.setDataToSender(null);
        self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'cartasenha/pessoas/' + cpf);
        self.restClient.setMethodGET();
        self.restClient.setSuccessCallbackFunction(function (data) {
            self.loaderApi.hide();
            if (data) {
                self.wizard.steps("setStep", 2);
                self.cpf = data['cpf'];
                self.nomeSolicitante = data['nome'];
                self.idPessoa = data['id'];
            } else {
                self.wizard.steps("setStep", 1);
                self.body.find('#cpf').val(self.body.find('#inputCheckCPF').val());
            }
        });
        self.restClient.setErrorCallbackFunction(function (callback) {
            self.modalApi.showModal(ModalAPI.ERROR, 'Sistemas', callback.responseJSON, 'OK');
            self.loaderApi.hide();
        });
        self.restClient.exec();
    } else {
        inputCheckCPF.next().text('CPF Invalido!');
        inputCheckCPF.closest('.inputBlock').addClass('has-error');
        inputCheckCPF.focus();
        //self.modalApi.showModal(ModalAPI.ERROR, 'Carta Senha', 'CPF Invalido!', 'OK');
    }
};
SolicitacaoCartaSenhaViewModel.prototype.getPaises = function (select, idPaisToSelect) {
    var self = this;
    self.loaderApi.show();
    self.restClient.setWebServiceURL(self.webservicePmroBaseURL + 'pais');
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        if (!select) {
            select = $('[name="pais"]');
            populateSelect(select, data, 'id', 'nome', 'brasil');
        }
        else {
            populateSelect(select, data, 'id', 'nome', 'brasil');
            if (idPaisToSelect) {
                select.val(idPaisToSelect);
            }
        }
        self.updateFields();
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        //alert('Erro em obter Paises');
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", jqXHR.responseJSON, "OK");
        self.loaderApi.hide();
    });
    self.restClient.exec();
};
SolicitacaoCartaSenhaViewModel.prototype.getUFs = function (select, idUfToSelect) {
    var self = this;
    self.loaderApi.show();
    var dataToSender = {'idPais': 33};
    self.restClient.setWebServiceURL(self.webservicePmroBaseURL + 'uf');
    self.restClient.setMethodPOST();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        if (!select) {
            populateSelect($('[name="uf"]'), data, 'id', 'nome', 'rio de janeiro');
            populateSelect(self.selectUfBuscaCEP, data, 'id', 'nome', 'rio de janeiro');
        }
        else {
            populateSelect(select, data, 'id', 'nome', 'rio de janeiro');
            if (idUfToSelect) {
                select.val(idUfToSelect);
            }
        }
        self.updateFields();
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        //alert('Erro em obter lista de estados');
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", jqXHR.responseJSON, "OK");
    });
    self.restClient.exec();
};
SolicitacaoCartaSenhaViewModel.prototype.getMunicipios = function (select, idUF, idMunicipioToSelect) {
    var self = this;
    self.loaderApi.show();
    if (idUF == null) {
        idUF = 20;
    }
    var dataToSender = {'idUF': idUF};
    self.restClient.setWebServiceURL(self.webservicePmroBaseURL + 'municipio');
    self.restClient.setMethodPOST();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        if (!select) {
            populateSelect($('[name="municipio"]'), data, 'id', 'nome', 'rio das ostras');
            populateSelect(self.selectMunicipioBuscaCEP, data, 'id', 'nome', 'rio das ostras');
        }
        else {
            populateSelect(select, data, 'id', 'nome', 'rio das ostras');
            if (idMunicipioToSelect) {
                select.val(idMunicipioToSelect);
            }
        }
        self.updateFields();
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        // alert('Erro em obter lista de municipios');
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", jqXHR.responseJSON, "OK");
    });
    self.restClient.exec();
};
SolicitacaoCartaSenhaViewModel.prototype.validaForm = function () {
    var self = this;

    this.formPeFisicaValidate = new FormValidationAPI($('.formCadPessoa'));
    //form telefone
    this.formTelefoneValidate = new FormValidationAPI('telefoneContainer');
    //form endereco
    this.formEnderecoValidate = new FormValidationAPI('enderecoContainer');

    //valida pessoa fisica
    if (!self.formPeFisicaValidate.validate(true, true)) {
        self.modalApi.modalError('Os campos ' + self.formPeFisicaValidate.getInvalidFields() + ' são obrigatorios!');
        return false;
    }

    //valida telefones
    if (!self.formTelefoneValidate.validate(true, true)) {
        self.modalApi.modalError('Os campos ' + self.formTelefoneValidate.getInvalidFields() + ' são obrigatorios!');
        return false;
    }
    //valida endereços
    if (!self.formEnderecoValidate.validate(true, true)) {
        self.modalApi.modalError('Os campos ' + self.formEnderecoValidate.getInvalidFields() + ' são obrigatorios!');
        return false;
    }
    return true;
};
SolicitacaoCartaSenhaViewModel.prototype.savePessoa = function () {
    var self = this;

    //valida
    if (!self.validaForm()) {
        return;
    }

    // OBTEM DADOS DO FORMULARIO
    var tipoPessoa = 'fisica';
    var cpf = $('#cpf').val();
    var nome = $('#nome').val();
    var dataNascimento = $('#dataNascimento').val();
    var rg = $('#rg').val();
    var orgaoEmissor = $('#orgaoEmissor').val();
    var emailPrincipal = $('#emailPrincipal').val();
    var sexo = $('#sexo').val();

    var tipoTelefone = $('select[name="tipoTelefone"]').val();
    var numeroTelefone = $('input[name="numeroTelefone"]').val();
    var enderecoContainer = $('#enderecoContainer');
    var telefoneContainer = $('#telefoneContainer');

    var dataToSender = {
        'idPessoa': null,
        'tipo': tipoPessoa,
        'nome': smartCapitalize(nome),
        'emailPrincipal': emailPrincipal.toLowerCase(),
        'emailAdicional': null,
        'cpf': cpf.replace(/[^\d]+/g, ''),
        'rg': rg,
        'dataEmissao': null,
        'orgaoEmissor': orgaoEmissor,
        'idUfOrgaoEmissor': null,
        'dataNascimento': dataNascimento,
        'sexo': sexo,
        'cnpj': null,
        'nomeFantasia': null,
        'inscricaoEstadual': null
    };
    // OBTEM TELEFONES
    var telefones = [];
    telefoneContainer.find('.telefoneItem').each(function (index) {
        var telefoneItem = {};
        $(this).find(':input').not('button, input[aria-label="Search"]').each(function (index) {
            if (this.name === 'numeroTelefone') {
                telefoneItem[this.name] = this.value.replace(/[^\d]+/g, '');
            }
            else {
                telefoneItem[this.name] = this.value;
            }
        });
        telefones.push(telefoneItem);
    });
    dataToSender['telefones'] = telefones;

    // OBTEM ENDEREÇOS
    var enderecos = [];
    enderecoContainer.find('.enderecoItem').each(function (index) {
        var enderecoItem = {};
        $(this).find(':input').not('button, input[aria-label="Search"]').each(function (index) {

            if (this.name === 'cep') {
                enderecoItem[this.name] = this.value.replace(/[^\d]+/g, '');
            }
            else {
                enderecoItem[this.name] = this.value;
            }
        });
        enderecos.push(enderecoItem);
    });
    dataToSender['enderecos'] = enderecos;
    //console.log(JSON.stringify(dataToSender));

    self.loaderApi.show();
    var id = /*self.idPessoa ? self.idPessoa :*/ '';
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'cartasenha/pessoas/' + id);
    self.restClient.setMethodPUT();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        self.idPessoa = data['idPessoa'];
        self.nomeSolicitante = nome;
        self.isUsuarioCadastradoPorAqui = true;
        self.modalApi.success(data['message']);
        self.wizard.steps("setStep", 2);
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        console.log(jqXHR);
        self.modalApi.modalError(jqXHR.responseJSON);
    });
    self.restClient.exec();
};

SolicitacaoCartaSenhaViewModel.prototype.getAllOrganogramaOrgao = function () {
    var self = this;
    self.loaderApi.show();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'cartasenha/organogramas/orgao');
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        var select = $('[name="orgao"]');
        populateSelect(select, data, 'id', 'nome', 'Prefeitura Municipal de Rio das Ostras');
        self.updateFields();
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        //alert('Erro em obter Paises');
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", jqXHR.responseJSON, "OK");
        self.loaderApi.hide();
    });
    self.restClient.exec();
};
SolicitacaoCartaSenhaViewModel.prototype.getAllOrganogramaUnidade = function (idOrgao) {
    var self = this;
    idOrgao = idOrgao ? idOrgao : 389;
    self.loaderApi.show();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'cartasenha/organogramas/unidade/' + idOrgao);
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();

        var select = $('[name="unidade"]');
        populateSelect(select, data, 'id', 'nome', 'Secretaria Municipal de Administração Pública ');

        self.updateFields();
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        //alert('Erro em obter Paises');
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", jqXHR.responseJSON, "OK");
        self.loaderApi.hide();
    });
    self.restClient.exec();
};
SolicitacaoCartaSenhaViewModel.prototype.getAllOrganogramaDepartamento = function (idUnidade) {
    var self = this;
    idUnidade = idUnidade ? idUnidade : 1;
    self.loaderApi.show();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'cartasenha/organogramas/departamento/' + idUnidade);
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();

        var select = $('[name="departamento"]');
        populateSelect(select, data, 'id', 'nome', 'Comissão Permanente de Licitação e Pregão');

        self.updateFields();
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        //alert('Erro em obter Paises');
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", jqXHR.responseJSON, "OK");
        self.loaderApi.hide();
    });
    self.restClient.exec();
};

SolicitacaoCartaSenhaViewModel.prototype.getAllHierarchyOU = function () {
    var self = this;
    self.loaderApi.show();
    self.mtvHierarchyOU = new ModernTreeView('mtvHierarchyOU');
    self.mtvHierarchyOU.setupDisplayItems([
        {'key': 'dn', 'type': ModernTreeView.ID},
        {'key': 'name', 'type': ModernTreeView.LABEL}
    ]);
    self.mtvHierarchyOU.setExplorerStyle();
    self.mtvHierarchyOU.parseFields();
    self.mtvHierarchyOU.showCheck();
    self.mtvHierarchyOU.setPrimaryKeyIsString();
    self.mtvHierarchyOU.setMethodGET();
    self.mtvHierarchyOU.setWebServiceURL(self.webserviceJubarteBaseURL + 'cartasenha/ldap/hierarquia/ou');
    self.mtvHierarchyOU.setOnLoadSuccessCallback(function (response) {
        self.loaderApi.hide();
    });
    self.mtvHierarchyOU.setOnLoadErrorCallback(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", jqXHR.responseJSON, "OK");
    });
    self.mtvHierarchyOU.setOnClick(function (data) {
    });
    self.mtvHierarchyOU.load();
};
SolicitacaoCartaSenhaViewModel.prototype.getAllHierarchyOrganograma = function () {
    var self = this;
    self.loaderApi.show();
    self.mtvOrganograma = new ModernTreeView('mtvOrganograma');
    self.mtvOrganograma.setupDisplayItems([
        {'key': 'idOrganograma', 'type': ModernTreeView.ID},
        {'key': 'text', 'type': ModernTreeView.LABEL}
    ]);
    self.mtvOrganograma.setExplorerStyle();
    self.mtvOrganograma.setMethodGET();
    self.mtvOrganograma.setWebServiceURL(self.webserviceJubarteBaseURL + 'cartasenha/organogramas/hierarquia');
    self.mtvOrganograma.setOnLoadSuccessCallback(function (response) {
        self.loaderApi.hide();
    });
    self.mtvOrganograma.setOnLoadErrorCallback(function (callback) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", jqXHR.responseJSON, "OK");
    });
    self.mtvOrganograma.setOnClick(function (data) {
        self.modalOrganograma.modal('hide');
        self.body.find('#inputOrganograma').val(data['text']);
        self.body.find('#inputOrganograma').attr('data-id', data['idOrganograma']);
        self.organogramaSigla = data['sigla'];
        self.organogramaId = data['idOrganograma'];
        self.organogramaNome = data['nome'];
    });
    self.mtvOrganograma.load();
};

SolicitacaoCartaSenhaViewModel.prototype.showTabByName = function (tabIndex) {
    var self = this;
    var tabsContainer = self.body.find('#tabsContainer');
    tabsContainer.find('.tabItem').each(function (a, b) {
        var tab = $(this);
        if (tab.hasClass('tabItemAtive')) {
            tab.removeClass('tabItemAtive');
        }

        if (tab.hasClass('tabItem_' + tabIndex)) {
            tab.addClass('tabItemAtive');
        }
    });
};
SolicitacaoCartaSenhaViewModel.prototype.validaFormCartaSenha = function () {
    var self = this;
    this.formCartaSenhaRede = null;
    this.formCartaSenhaSali = null;
    this.formCartaSenha = new FormValidationAPI($('#formSoliCartaSenha'));
    if (!self.formCartaSenha.validate(true, true)) {
        self.modalApi.modalError('O(s) campo(s) ' + self.formCartaSenha.getInvalidFields() + ' são/é obrigatorio(s)!');
        return false;
    }
    var selectTipoDeConta = parseInt($('#selectTipoDeConta').val());
    switch (selectTipoDeConta) {
        case 0://Rede | E-mail | Internet
            self.formCartaSenhaRede = new FormValidationAPI($('.formCartaSenhaRede'));
            if (!self.formCartaSenhaRede.validate(true, true)) {
                self.modalApi.modalError('O(s) campo(s) ' + self.formCartaSenhaRede.getInvalidFields() + ' são/é obrigatorio(s)!');
                return false;
            }
            break;
        case 1://SALI - Sistema de Protocolo
            break;
        case 2://EasyGed - Sistema de Documentos
            break;
        default:
    }
    return true;
};
SolicitacaoCartaSenhaViewModel.prototype.createCartaSenha = function () {
    var self = this;
    if (!self.validaFormCartaSenha()) {
        return;
    }
    // OBTEM DADOS DO FORMULARIO
    var selectTipoDeConta = parseInt($('#selectTipoDeConta').val());
    var dadosDaConta = {};
    switch (selectTipoDeConta) {
        case 0://Rede | E-mail | Internet
            dadosDaConta = {
                "localDeRede": self.locaisDeRedeSelecionados
            };
            break;
        case 1://SALI - Sistema de Protocolo
            break;
        case 2://EasyGed - Sistema de Documentos
            break;
        default:
    }
    var dataToSender = {
        'tipoConta': $('#selectTipoDeConta').find('option:selected').text(),
        'idPessoa': self.idPessoa,
        'cpf': self.cpf,
        'dadosDaConta': dadosDaConta,
        'matricula': $('#inputMatricula').val(),
        'cargo': $('#inputCargo').val(),
        'telefoneSetor': $('#inputTelefoneSetor').val(),
        'organogramaSigla': self.organogramaSigla,
        'organogramaId': self.organogramaId,
        'organogramaNome': self.organogramaNome,
        'observacoes': $('#textareaObservacao').val(),
        'pass': $('#inputSenha').val(),
        'nomeSolicitante': self.nomeSolicitante,
        'isUsuarioCadastradoPorAqui':self.isUsuarioCadastradoPorAqui
    };
    console.log(JSON.stringify(dataToSender));
    self.loaderApi.show();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'cartasenha');
    self.restClient.setMethodPUT();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        self.modalApi.success(data['message']);
        self.wizard.steps("setStep", 3);
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        console.log(jqXHR);
        self.modalApi.modalError(jqXHR.responseJSON);
    });
    self.restClient.exec();
};