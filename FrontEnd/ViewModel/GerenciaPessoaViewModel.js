$(document).ready(function () {
    var gerenciaPessoaViewModel = new GerenciaPessoaViewModel();
    gerenciaPessoaViewModel.init();
});

function GerenciaPessoaViewModel() {
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;
    this.webservicePmroBaseURL = WEBSERVICE_PMRO_BASE_URL;
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = window.location !== window.parent.location ? window.parent.getModal() : new ModalAPI();

    //tab control
    this.tabPessoaFisica = $('#tabPessoaFisica');
    this.tabPessoaJuridica = $('#tabPessoaJuridica');
    this.btnShowTabPessoaFisica = $('#btnShowTabPessoaFisica');
    this.btnShowTabPessoaJuridica = $('#btnShowTabPessoaJuridica');
    this.tipoPessoaSendoEditada = 'fisica';

    //form pessoa fisica
    this.formPeFisicaValidate = new FormValidationAPI('tabPessoaFisica');
    this.idPessoa = null;
    this.inputNomePeFisica = $('#inputNomePeFisica');
    this.inputEmailPrinPeFisica = $('#inputEmailPrinPeFisica');
    this.inputEmailAdPeFisica = $('#inputEmailAdPeFisica');
    this.inputCPF = $('#inputCPF');
    this.selectSexo = $('#selectSexo');
    this.inputDataNascimento = $('#inputDataNascimento');
    this.inputRG = $('#inputRG');
    this.inputOrgaoEmissor = $('#inputOrgaoEmissor');
    this.inputDataEmissao = $('#inputDataEmissao');
    this.selectEstadoOrgaoEmissor = $('#selectEstadoOrgaoEmissor');
    this.selectNacionalidade = $('#selectNacionalidade');
    this.selectNaturalidadeUF = $('#selectNaturalidadeUF');
    this.selectNaturalidadeMunicipio = $('#selectNaturalidadeMunicipio');
    this.inputProfissao = $('#inputProfissao');
    this.selectGrupoSanguineo = $('#selectGrupoSanguineo');
    this.selectFatorRH = $('#selectFatorRH');
    this.inputPIS = $('#inputPIS');
    this.selectEstadoCivil = $('#selectEstadoCivil');
    this.inputNomePai = $('#inputNomePai');
    this.inputNomeMae = $('#inputNomeMae');
    this.dataTablePessoaFisica = new ModernDataTable('tablePessoaFisica');

    //form pessoa juridica
    this.formPeJuridicaValidate = new FormValidationAPI('tabPessoaJuridica');
    this.inputRasaoSocial = $('#inputRasaoSocial');
    this.inputEmailPrinPeJuridica = $('#inputEmailPrinPeJuridica');
    this.inputEmailAdPeJuridica = $('#inputEmailAdPeJuridica');
    this.inputNomeFantasia = $('#inputNomeFantasia');
    this.inputCNPJ = $('#inputCNPJ');
    this.inputInscricaoEstadual = $('#inputInscricaoEstadual');
    this.dataTablePessoaJuridica = new ModernDataTable('tablePessoaJuridica');

    //form telefone
    this.formTelefoneValidate = new FormValidationAPI('telefoneContainer');
    this.telefoneContainer = $('#telefoneContainer');
    this.btnAddTelefone = $('#btnAddTelefone');
    this.btnRemoveTelefone = $('#btnRemoveTelefone');
    this.limitTelefones = 3;


    //form endereco
    this.formEnderecoValidate = new FormValidationAPI('enderecoContainer');
    this.templateFormEndereco = $('#templateFormEndereco');
    this.enderecoContainer = $('#enderecoContainer');
    this.limitEndereco = 3;

    this.btnSalvar = $('.btnSalvar');

    //form busca CEP
    this.selectUfBuscaCEP = $('#selectUfBuscaCEP');
    this.selectMunicipioBuscaCEP = $('#selectMunicipioBuscaCEP');
    this.inputBairroBuscaCEP = $('#inputBairroBuscaCEP');
    this.inputLogradouroBuscaCEP = $('#inputLogradouroBuscaCEP');
    this.btnBuscarCEPEnd = $('#btnBuscarCEPEnd');
    this.correntEndereco = null;
    // lista CEPS
    this.tableListCEPCorreios = $('#tableListCEPCorreios');
    this.dataTableCEPCorreios = new ModernDataTable('tableListCEPCorreios');
    this.modalBuscaCEP = $('#modalBuscaCEP');

    //tabs buttons
    this.btnShowTabCadPessoa = $('#btnShowTabCadPessoa');
    this.btnShowTabListaPessoaFisica = $('#btnShowTabListaPessoaFisica');
    this.btnShowTabListaPessoaJuridica = $('#btnShowTabListaPessoaJuridica');
}

GerenciaPessoaViewModel.prototype.init = function () {
    var self = this;
    //inicialiaza plugins
    $('select').selectpicker();
    self.eventos();
    self.maskForm();
    self.getPaises();
    self.getUFs();
    self.getMunicipios();
    self.listCEPbyEndereco();
    self.getAllPessoasFisica();
    self.getAllPessoasJuridica();
};
GerenciaPessoaViewModel.prototype.eventos = function () {
    var self = this;
    //tab control
    self.btnShowTabPessoaFisica.click(function () {
        self.tabPessoaJuridica.css('display', 'none');
        self.tabPessoaFisica.css('display', 'block');
        self.tipoPessoaSendoEditada = 'fisica';
    });
    self.btnShowTabPessoaJuridica.click(function () {
        self.tabPessoaFisica.css('display', 'none');
        self.tabPessoaJuridica.css('display', 'block');
        self.tipoPessoaSendoEditada = 'juridica';
    });
    self.btnSalvar.click(function () {
        self.savePessoa();
    });

    //adiciona/remove form de telefone
    self.btnAddTelefone.on('click', function () {
        self.addFormTelefone();
    });
    self.btnRemoveTelefone.on('click', function () {
        self.removeFormTelefone();
    });
    //adiciona/remove form de endereco
    self.enderecoContainer.on('click', '.btnAddEndereco', function () {
        self.addFormEndereco();
    });
    self.enderecoContainer.on('click', '.btnRemoveEndereco', function () {
        self.removeFormEndereco($(this).closest('.enderecoItem'));
    });
    //buscar endeço nos correios pelo cep informado e preencher os campos de endereço
    $(document).on('click', '.btnPreencherEndereco', function () {
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
    $(document).on('click', '.btnShowModalBuscaCEP', function () {
        self.correntEndereco = $(this).closest(('div[class^="enderecoItem"]'));
    });

    //evento on change do select uf para obter municipios
    self.enderecoContainer.on('change', '[name="uf"]', function (e) {
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
    self.enderecoContainer.on('change', '[name="pais"]', function (e) {
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

    //quando selecionar um estado de selectNaturalidadeUF obtem os municipios deste estado
    self.selectNaturalidadeUF.change(function (e) {
        self.getMunicipios(self.selectNaturalidadeMunicipio, self.selectNaturalidadeUF.val());
    });

};
GerenciaPessoaViewModel.prototype.updateFields = function () {
    var self = this;
    var selects = $('select');
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
GerenciaPessoaViewModel.prototype.resetForm = function () {
    var self = this;

    //form pessoa fisica
    self.idPessoa = null;
    self.inputNomePeFisica.val();
    self.inputEmailPrinPeFisica.val();
    self.inputEmailAdPeFisica.val();
    self.inputCPF.val('');
    self.selectSexo.val('');
    self.inputDataNascimento.val('');
    self.inputRG.val('');
    self.inputOrgaoEmissor.val('');
    self.inputDataEmissao.val('');
    self.selectEstadoOrgaoEmissor.val('');
    self.selectNacionalidade.val('');

    self.selectNaturalidadeUF.val('');
    self.selectNaturalidadeMunicipio.val('');
    self.inputProfissao.val('');
    self.selectGrupoSanguineo.val('');
    self.selectFatorRH.val('');

    self.inputPIS.val('');
    self.selectEstadoCivil.val('');
    self.inputNomePai.val('');
    self.inputNomeMae.val('');

    //form pessoa juridica
    self.inputRasaoSocial.val('');
    self.inputEmailPrinPeJuridica.val('');
    self.inputEmailAdPeJuridica.val('');
    self.inputNomeFantasia.val('');
    self.inputCNPJ.val('');
    self.inputInscricaoEstadual.val('');

    self.updateFields();

};
GerenciaPessoaViewModel.prototype.maskForm = function () {
    var self = this;
    //$("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
    self.inputCPF.mask('000.000.000-00', {reverse: true});
    self.inputDataEmissao.mask('00/00/0000');
    self.inputDataNascimento.mask('00/00/0000');
    self.inputCNPJ.mask('00.000.000/0000-00', {reverse: true});

    self.enderecoContainer.find('[name="cep"]').each(function () {
        $(this).mask('99999-999');
    });

    $(document).on('focus', '[name="numeroTelefone"]', function () {
        var numeroTelefone = $(this);
        var tipoTelefone = numeroTelefone.closest('div[class^="telefoneItem"]').find('[name="tipoTelefone"]');

        if (!tipoTelefone.val()) {
            $(this).keydown(function () {
                return false;
            });
            //self.modalApi.warning('Selecione o tipo de telefone primeiro!');
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
GerenciaPessoaViewModel.prototype.validaForm = function (tipoPessoa) {
    var self = this;

    //valida pessoa fisica e juridica
    if (tipoPessoa === 'fisica') {
        if (!self.formPeFisicaValidate.validate(true, true)) {
            self.modalApi.modalError('Os campos ' + self.formPeFisicaValidate.getInvalidFields() + ' são obrigatorios!');
            return false;
        }
    }
    else {
        if (!self.formPeJuridicaValidate.validate(true, true)) {
            self.modalApi.modalError('Os campos ' + self.formPeJuridicaValidate.getInvalidFields() + ' são obrigatorios!');
            return false;
        }
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
GerenciaPessoaViewModel.prototype.addFormTelefone = function (numeroTelefone, tipoTelefone) {
    var self = this;

    var correntCountTel = self.telefoneContainer.find('.telefoneItem').length;

    if (correntCountTel < self.limitTelefones ) {
        var html = $('<div class="telefoneItem"><!-- telefoneItem -->\n' +
            '        <div class="col-md-2 inputBlock">\n' +
            '            <label>Tipo</label>\n' +
            '            <select name="tipoTelefone" class="select" required>\n' +
            '                <option selected="" disabled="">Selecione</option>\n' +
            '                <option value="Residencial">Residencial</option>\n' +
            '                <option value="Comercial">Comercial</option>\n' +
            '                <option value="Móvel">Móvel</option>\n' +
            '                <option value="WhatsApp">WhatsApp</option>\n' +
            '                <option value="Outro">Outro</option>\n' +
            '            </select>\n' +
            '        </div>\n' +
            '        <div class="col-md-2 inputBlock">\n' +
            '            <label>Telefone</label>\n' +
            '            <input name="numeroTelefone" type="text"\n' +
            '                    class="form-control" required>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div><!-- /telefoneItem -->');

        if (numeroTelefone && tipoTelefone) {
            html.find('[name="numeroTelefone"]').val(numeroTelefone);
            html.find('[name="tipoTelefone"]').val(tipoTelefone);
        }

        self.telefoneContainer.append(html);
        self.updateFields();
    }
};
GerenciaPessoaViewModel.prototype.removeFormTelefone = function () {
    var self = this;
    var telefoneItem = null;
    self.telefoneContainer.find('.telefoneItem').each(function () {
        telefoneItem = this;
    });

    var correntCountTel = self.telefoneContainer.find('.telefoneItem').length;

    if (correntCountTel > 1)
    {
        $(telefoneItem).remove();
    }

};
GerenciaPessoaViewModel.prototype.addFormEndereco = function (enderecoData) {
    var self = this;

    var correntCountEnde = self.telefoneContainer.find('.enderecoItem').length;

    //get the template element:
    var template = document.getElementById("templateFormEndereco");

    //get the DIV element from the template:
    var html = template.content === undefined ? template.querySelector("div") : template.content.querySelector("div");
    html = $(html).clone();

    var idEnderecoDivergente = 'enderecoDivergente' + genId();
    html.find('input[name="enderecoDivergente"]').prop('id', idEnderecoDivergente);
    html.find('label[for="enderecoDivergente"]').prop('for', idEnderecoDivergente);

    if (correntCountEnde < self.limitEndereco) {
        self.enderecoContainer.append(html);

        if (enderecoData) {
            html.find('[name="cep"]').val(enderecoData['cep']);
            html.find('[name="tipoEndereco"]').val(enderecoData['tipo']);
            html.find('[name="bairro"]').val(enderecoData['bairro']);
            html.find('[name="tipoLogradouro"]').val(enderecoData['tipoLogradouro']);
            html.find('[name="logradouro"]').val(enderecoData['logradouro']);
            html.find('[name="numeroLogradouro"]').val(enderecoData['numero']);
            html.find('[name="complemento"]').val(enderecoData['complemento']);
            html.find('[name="divergente"]').prop('checked', enderecoData['divergente']);
            html.find('[name="validacao"]').val(enderecoData['validacao']);

            self.getPaises(html.find('[name="pais"]'), enderecoData['idPais']);
            self.getUFs(html.find('[name="uf"]'), enderecoData['idUf']);
            self.getMunicipios(html.find('[name="municipio"]'), enderecoData['idUf'], enderecoData['idMunicipio']);

        } else {
            self.getPaises(html.find('[name="pais"]'));
            self.getUFs(html.find('[name="uf"]'));
            self.getMunicipios(html.find('[name="municipio"]'));
        }
        self.updateFields();
    }
};
GerenciaPessoaViewModel.prototype.removeFormEndereco = function (enderecoItem) {
    var self = this;

    var correntCountEnd = self.enderecoContainer.find('.enderecoItem').length;

    if (correntCountEnd > 1) {
        $(enderecoItem).remove();
    }
};
//CARREGA DADOS DE ENDERECO
GerenciaPessoaViewModel.prototype.getPaises = function (select, idPaisToSelect) {
    var self = this;
    self.loaderApi.show();
    self.restClient.setWebServiceURL(self.webservicePmroBaseURL + 'pais');
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        if (!select) {
            populateSelect($('[name="pais"]'), data, 'id', 'nome', 'brasil');
            populateSelect(self.selectNacionalidade, data, 'id', 'nome', 'brasil');
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
GerenciaPessoaViewModel.prototype.getUFs = function (select, idUfToSelect) {
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
            populateSelect(self.selectEstadoOrgaoEmissor, data, 'id', 'nome', 'rio de janeiro');
            populateSelect(self.selectUfBuscaCEP, data, 'id', 'nome', 'rio de janeiro');
            populateSelect(self.selectNaturalidadeUF, data, 'id', 'nome', 'rio de janeiro');
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
GerenciaPessoaViewModel.prototype.getMunicipios = function (select, idUF, idMunicipioToSelect) {
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
            populateSelect(self.selectNaturalidadeMunicipio, data, 'id', 'nome', 'rio das ostras');
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
GerenciaPessoaViewModel.prototype.getEnderecoByCEP = function (cep, refCorrentDivEndereco) {
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
//INICIALIZA DATATABLE BUSCA CEP POR ENDERECO
GerenciaPessoaViewModel.prototype.listCEPbyEndereco = function () {
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
//CRIA OU ATUALIZA PESSOA
GerenciaPessoaViewModel.prototype.savePessoa = function () {
    var self = this;
    var tipoPessoa = self.tipoPessoaSendoEditada;

    //valida
    if (!self.validaForm(tipoPessoa)) {
        return;
    }

    // OBTEM DADOS DO FORMULARIO
    var nome = self.inputNomePeFisica.val();
    var emailPrincipal = self.inputEmailPrinPeFisica.val();
    var emailAdicional = self.inputEmailAdPeFisica.val();

    if (tipoPessoa === 'juridica') {
        nome = self.inputRasaoSocial.val();
        emailPrincipal = self.inputEmailPrinPeJuridica.val();
        emailAdicional = self.inputEmailAdPeJuridica.val();
    }

    var dataToSender = {
        'idPessoa': self.idPessoa,
        'tipo': tipoPessoa,
        'nome': smartCapitalize(nome),
        'emailPrincipal': emailPrincipal.toLowerCase(),
        'emailAdicional': emailAdicional.toLowerCase(),

        'cpf': self.inputCPF.val().replace(/[^\d]+/g, ''),
        'rg': self.inputRG.val(),
        'dataEmissao': self.inputDataEmissao.val(),
        'orgaoEmissor': self.inputOrgaoEmissor.val(),
        'idUfOrgaoEmissor': self.selectEstadoOrgaoEmissor.val(),
        'idPaisNacionalidade': self.selectNacionalidade.val(),
        'dataNascimento': self.inputDataNascimento.val(),
        'sexo': self.selectSexo.val(),

        'cnpj': self.inputCNPJ.val(),
        'nomeFantasia': smartCapitalize(self.inputNomeFantasia.val()),
        'inscricaoEstadual': self.inputInscricaoEstadual.val(),

        'grupoSanguineo': self.selectGrupoSanguineo.val(),
        'fatorRH': self.selectFatorRH.val(),
        'profissao': self.inputProfissao.val(),

        'pis': self.inputPIS.val(),
        'estadoCivil': self.selectEstadoCivil.val(),
        'nomePai': self.inputNomePai.val(),
        'nomeMae': self.inputNomeMae.val(),

        'naturalidadeMunicipio': self.selectNaturalidadeMunicipio.val(),
        'naturalidadeUF': self.selectNaturalidadeUF.val()
    };

    // OBTEM TELEFONES
    var telefones = [];
    self.telefoneContainer.find('.telefoneItem').each(function (index) {
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
    self.enderecoContainer.find('.enderecoItem').each(function (index) {
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

    console.log(JSON.stringify(dataToSender));

    self.loaderApi.show();
    var id = self.idPessoa ? self.idPessoa : '';
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'pessoas/' + id);
    self.restClient.setMethodPUT();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        self.modalApi.success(data['message']);
        location.reload();
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        console.log(jqXHR.responseJSON);
        self.modalApi.modalError(jqXHR.responseJSON);
    });
    self.restClient.exec();

};
//LISTA PESSOAS FISICA
GerenciaPessoaViewModel.prototype.getAllPessoasFisica = function () {
    var self = this;

    self.dataTablePessoaFisica.setDisplayCols([
        {"key": "id"},
        {"key": "nome"},
        {"key": "emailPrincipal"},
        {"key": "sexo"},
        {"key": "cpf"},
        {"key": "rg"}
    ]);
    self.dataTablePessoaFisica.setIsColsEditable(false);
    self.dataTablePessoaFisica.showActionBtnAdd();
    self.dataTablePessoaFisica.setDataToSender({'tipo': 'fisica'});
    self.dataTablePessoaFisica.setSourceURL(self.webserviceJubarteBaseURL + 'pessoas');
    self.dataTablePessoaFisica.setSourceMethodPOST();
    self.dataTablePessoaFisica.setOnDeleteItemAction(function (ids) {
    });
    self.dataTablePessoaFisica.setOnClick(function (data) {
        //console.log(data);
        self.getPessoa(data['id'], 'fisica');
    });
    //desabilita o Loader padrão
    //self.dataTablePerfil.defaultLoader(false);
    self.dataTablePessoaFisica.setOnReloadAction(function () {
    });
    // mostra o Loader quando clicar no botão reload do dataTable
    self.dataTablePessoaFisica.setOnLoadedContent(function () {
    });
    // quando concluir o carregamento esconde o loader
    self.dataTablePessoaFisica.setOnAddItemAction(function () {

    });
    self.dataTablePessoaFisica.setOnDeleteItemAction(function (ids) {
        self.deletePessoas(ids, "fisica")
    });
    self.dataTablePessoaFisica.load();
};
//LISTA PESSOAS JURIDICA
GerenciaPessoaViewModel.prototype.getAllPessoasJuridica = function () {
    var self = this;

    self.dataTablePessoaJuridica.setDisplayCols([
        {"key": "id"},
        {"key": "nome"},
        {"key": "emailPrincipal"},
        {"key": "cnpj"},
        {"key": "nomeFantasia"},
        {"key": "inscricaoEstadual"}
    ]);
    self.dataTablePessoaJuridica.setIsColsEditable(false);
    self.dataTablePessoaJuridica.showActionBtnAdd();
    self.dataTablePessoaJuridica.setDataToSender({'tipo': 'juridica'});
    self.dataTablePessoaJuridica.setSourceURL(self.webserviceJubarteBaseURL + 'pessoas');
    self.dataTablePessoaJuridica.setSourceMethodPOST();
    self.dataTablePessoaJuridica.setOnDeleteItemAction(function (ids) {
    });
    self.dataTablePessoaJuridica.setOnClick(function (data) {
        self.getPessoa(data['id'], 'juridica');
    });
    //desabilita o Loader padrão
    //self.dataTablePerfil.defaultLoader(false);
    self.dataTablePessoaJuridica.setOnReloadAction(function () {
    });
    // mostra o Loader quando clicar no botão reload do dataTable
    self.dataTablePessoaJuridica.setOnLoadedContent(function () {
    });
    // quando concluir o carregamento esconde o loader
    self.dataTablePessoaJuridica.setOnAddItemAction(function () {

    });
    self.dataTablePessoaJuridica.setOnDeleteItemAction(function (ids) {
        self.deletePessoas(ids, "juridica")
    });
    self.dataTablePessoaJuridica.load();
};
GerenciaPessoaViewModel.prototype.deletePessoas = function (ids, tipoPessoa) {
    var self = this;

    //console.log(ids);

    if (ids.length === 0) {
        self.modalApi.showModal(ModalAPI.WARNING, 'Pessoas', 'É necessário selecionar ao menos uma pessoa!', 'OK');
        return;
    }

    self.modalApi.showConfirmation(ModalAPI.WARNING, 'Confirmação', 'Tem certeza que deseja remover o(s) pessoa(s) selecionada(s)? A operação não poderá ser desfeita.', 'Sim', 'Não').onClick('Sim', function () {

        self.loaderApi.show();
        var dataToSend = {"ids": ids, "tipo": tipoPessoa};
        self.restClient.setDataToSender(dataToSend);
        self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'pessoas');
        self.restClient.setMethodDELETE();
        self.restClient.setSuccessCallbackFunction(function () {
            self.dataTablePessoaFisica.reload();
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
GerenciaPessoaViewModel.prototype.getPessoa = function (id, tipoPessoa) {
    var self = this;

    self.loaderApi.show();

    self.restClient.setDataToSender({});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'pessoas/' + id + '/' + tipoPessoa);
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.dataTablePessoaFisica.reload();
        self.loaderApi.hide();
        self.fillFormPessoa(data, tipoPessoa);
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Sistemas', callback.responseJSON, 'OK');
        self.loaderApi.hide();
    });
    self.restClient.exec();

};
GerenciaPessoaViewModel.prototype.fillFormPessoa = function (data, tipoPessoa) {
    var self = this;

    if (tipoPessoa === 'fisica') {
        self.idPessoa = data['id'];
        self.inputNomePeFisica.val(data['nome']);
        self.inputEmailPrinPeFisica.val(data['emailPrincipal']);
        self.inputEmailAdPeFisica.val(data['emailAdicional']);
        self.inputCPF.val(data['cpf']);
        self.inputCPF.mask("000.000.000-00");
        self.selectSexo.val(data['sexo']);
        self.inputDataNascimento.val(sqlDateToBrasilDate(data['dataNascimento']));
        self.inputRG.val(data['rg']);
        self.inputOrgaoEmissor.val(data['orgaoEmissor']);
        self.inputDataEmissao.val(sqlDateToBrasilDate(data['dataEmissao']));
        self.selectEstadoOrgaoEmissor.val(data['idUfOrgaoEmissor']);
        self.selectNacionalidade.val(data['idPaisNacionalidade']);

        self.getUFs(self.selectNaturalidadeUF, data['naturalidadeUF']);
        self.getMunicipios(self.selectNaturalidadeMunicipio, data['naturalidadeUF'], data['naturalidadeMunicipio']);

        self.inputProfissao.val(data['profissao']);
        self.selectGrupoSanguineo.val(data['grupoSanguineo']);
        self.selectFatorRH.val(data['fatorRH']);
        self.inputPIS.val(data['pis']);
        self.selectEstadoCivil.val(data['estadoCivil']);
        self.inputNomePai.val(data['nomePai']);
        self.inputNomeMae.val(data['nomeMae']);
        self.btnShowTabPessoaFisica.trigger('click');
    }
    else {
        self.inputRasaoSocial.val(data['nome']);
        self.inputEmailPrinPeJuridica.val(data['emailPrincipal']);
        self.inputEmailAdPeJuridica.val(data['emailAdicional']);
        self.inputNomeFantasia.val(data['nomeFantasia']);
        self.inputCNPJ.val(data['cnpj']);
        self.inputInscricaoEstadual.val(data['inscricaoEstadual']);
        self.btnShowTabPessoaJuridica.trigger('click');
    }

    self.updateFields();

    var enderecos = data['enderecos'];
    if (enderecos.length >= 1) {
        self.enderecoContainer.empty();
    }

    enderecos.forEach(function (item, index, array) {
        self.addFormEndereco(item);
    });

    var telefones = data["telefones"];
    //isaque corrigiu aqui
    if(telefones) {
        if (telefones.length >= 1) {
            self.telefoneContainer.empty();
        }

        telefones.forEach(function (item, index, array) {
            //console.log(item);
            self.addFormTelefone(item['numero'], item['tipo']);
        });
    }


    self.btnShowTabCadPessoa.tab('show');

};