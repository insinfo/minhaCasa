$(function () {
    var profileViewModel = new ProfileViewModel();
    profileViewModel.init();
});

function ProfileViewModel() {

    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;
    this.webservicePmroBaseURL = WEBSERVICE_PMRO_BASE_URL;
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = window.location !== window.parent.location ? window.parent.getModal() : new ModalAPI();

    //form pessoa fisica
    this.formPeFisicaValidate = new FormValidationAPI('formPessoa');
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
    this.dataTableServidores = new ModernDataTable('tableListServidores');

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

    this.btnSalvarCadastroServidor = $('#btnSalvarCadastroServidor');

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

    //form modal escala de trabalho
    this.modalEscala = $('#modalEscala');
    this.selectLocalBiometria = $('#selectLocalBiometria');
    this.selectHoraEntrada = $('#selectHoraEntrada');
    this.selectHoraSaida = $('#selectHoraSaida');
    this.btnAddWorkload = $('#btnAddWorkload');
    this.containerDiasSemana = $('#containerDiasSemana');
    this.jTimeline = new jTimeline($('#timeline'));

    //form matricula
    this.templateFormMatricula = $('#templateFormMatricula');
    this.matriculaContainer = $('#matriculaContainer');
    this.formMatriculaValidate = new FormValidationAPI('matriculaContainer');

    //modal
    this.modalListaServidor = $('#modalListaServidor');
    this.modalOrganograma = $('#modalOrganograma');
    this.treeViewOrganograma = new ModernTreeView('treeViewOrganograma');
    this.correntInputOrganograma = null;

    //photo
    this.btnAddPhoto = $('#btnAddPhoto');
    this.btnOnWebCam = $('#btnOnWebCam');
    this.btnTakePhoto = $('#btnTakePhoto');
    this.canvasPhotoView = $('#canvasPhotoView');
    this.inputFileSelectPhoto = $('#inputFileSelectPhoto');
    this.videoWebCamView = $('#videoWebCamView');
    this.currentCapturedImage = null;
    this.isPhoto = false;
    this.inputFotoPerfil = $('#inputFotoPerfil');
    this.modalGetFoto = $('#modalGetFoto');
    this.imgPhotoEditor = $('#imgPhotoEditor');

    //form Redes Sociais
    this.btnSaveRedesSociais = $('#btnSaveRedesSociais');
    this.inputFacebook = $('#inputFacebook');
    this.inputGooglePlus = $('#inputGooglePlus');
    this.inputInstagram = $('#inputInstagram');
    this.inputLinkedin = $('#inputLinkedin');
    this.inputTwitter = $('#inputTwitter');
    this.inputYoutube = $('#inputYoutube');

    //form troca de senha
    this.inputCurrentPassword = $('#inputCurrentPassword');
    this.inputNewPassword = $('#inputNewPassword');
    this.inputRepeatNewPassword = $('#inputRepeatNewPassword');
    this.btnSalvarAlteracaoSenha = $('#btnSalvarAlteracaoSenha');
}

ProfileViewModel.prototype.init = function () {
    var self = this;

    self.iniciarTimeline();

    //inicialiaza plugins
    $('.select').selectpicker();
    //FIX DE BUG DO select2 PRA FUNCIONAR NO MODAL
    $.fn.modal.Constructor.prototype.enforceFocus = function () {
    };
    self.selectLocalBiometria.select2();
    self.selectHoraEntrada.select2();
    self.selectHoraSaida.select2();

    self.eventos();
    self.maskForm();
    self.getPaises();
    self.getUFs();
    self.getMunicipios();
    self.getCargos();
    self.getFuncoes();
    self.getVinculos();
    self.getJornadas();
    self.getLocais();
    self.getOrganogramas();

    var cont = 0;
    var identi = setInterval(function () {
        if (self.loaderApi.isLoading() === false) {
            clearInterval(identi);
            cont++;
            self.getServidor();
        }
    }, 300);

};
ProfileViewModel.prototype.eventos = function () {
    var self = this;

    //salva o cadastro do servidor
    self.btnSalvarCadastroServidor.click(function () {
        self.saveServidor();
    });

    //inicializa a webcam para tirar foto
    var isOpenWebCam = false;
    self.btnOnWebCam.click(function () {
        if (isOpenWebCam === false) {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'png',
                jpeg_quality: 100
            });
            Webcam.attach('#videoWebCamView');
            isOpenWebCam = true;
        } else {
            Webcam.reset();
            isOpenWebCam = false;
        }
    });

    //tira uma photo da imagem da webcam
    self.btnTakePhoto.click(function () {
        Webcam.snap(function (data_uri) {
            self.canvasPhotoView.find('#imgPhotoEditor').cropper('replace', data_uri);
        });
    });

    //seleciona um arquivo para fazer upload
    self.inputFileSelectPhoto.on('change', function () {
        var selectedFile = this.files[0];
        var reader = new FileReader();
        reader.onloadend = function (e) {
            var data_uri = e.target.result;
            self.canvasPhotoView.find('#imgPhotoEditor').cropper('replace', data_uri);
        };
        reader.readAsDataURL(selectedFile);
    });

    //btn modal get cropped image
    self.btnAddPhoto.click(function () {
        // Get the Cropper.js instance after initialized
        var cropper = self.canvasPhotoView.find('#imgPhotoEditor').data('cropper');
        var imageData = cropper.getCroppedCanvas({
            width: 256,
            height: 256,
            minWidth: 256,
            minHeight: 256,
            maxWidth: 4096,
            maxHeight: 4096,
            fillColor: '#fff',
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        }).toDataURL();
        self.inputFotoPerfil.find('img').attr('src', imageData);

        Webcam.reset();
        isOpenWebCam = false;
        self.modalGetFoto.modal('hide');
        self.inputFotoPerfil.find('div').focus();
    });

    //remove a photo ao pressionar delete
    self.inputFotoPerfil.on('keyup', 'div', function (e) {
        var key = event.keyCode || event.charCode;
        if (key === 8 || key === 46 || key === 110) {
            self.inputFotoPerfil.find('img').attr('src', '/cdn/Assets/icons/userNoImage.jpg');
        }
    });

    //opem modal get photo
    var isOpenPhotoEditor = false;
    self.inputFotoPerfil.on('click', 'div', function (e) {
        self.modalGetFoto.one('shown.bs.modal', function (e) {
            if (isOpenPhotoEditor === false) {
                // cropper foto perfil
                $('#imgPhotoEditor').cropper({
                    aspectRatio: 1 / 1,
                    responsive: true,
                    preview: '#photoPreview'
                });
                isOpenPhotoEditor = true;
            } else {
                isOpenPhotoEditor = false;
            }

        }).one('hide.bs.modal', function () {
            Webcam.reset();
            isOpenWebCam = false;
            self.inputFotoPerfil.find('div').focus();
        }).modal('show');
    });

    self.btnSaveRedesSociais.on('click', function (e) {
        self.saveRedesSociais();
    });
    //salva alteração de senha
    self.btnSalvarAlteracaoSenha.on('click', function (e) {
        self.changeUserPassword();
    });
};

ProfileViewModel.prototype.iniciarTimeline = function () {
    var self = this;
    self.jTimeline.hideResetBtn();
    self.jTimeline.disableDelItem();
    self.jTimeline.setTitle('Carga Horária');
    self.jTimeline.setOverlapCallback(function () {
        self.modalApi.showModal(ModalAPI.WARNING, 'Carga Horária', 'Você está tentando inserir um horário que sobrepõe uma jornada previamente inserida.', 'OK');
    });
    self.jTimeline.load();
};

ProfileViewModel.prototype.updateFields = function () {
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
ProfileViewModel.prototype.resetForm = function () {
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


    self.updateFields();

};
ProfileViewModel.prototype.maskForm = function () {
    var self = this;

    self.inputCPF.mask('000.000.000-00', {reverse: true});
    self.inputDataEmissao.mask('00/00/0000');
    self.inputDataNascimento.mask('00/00/0000');


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
ProfileViewModel.prototype.validaForm = function () {
    var self = this;

    //valida pessoa fisica
    if (self.formPeFisicaValidate.validate(true, true) === false) {

        self.modalApi.modalError('O(s) campo(s) ' + self.formPeFisicaValidate.getInvalidFields() + ' são obrigatorios!');
        return false;
    }

    //valida telefones
    if (!self.formTelefoneValidate.validate(true, true)) {
        self.modalApi.modalError('O(s) campo(s) ' + self.formTelefoneValidate.getInvalidFields() + ' são obrigatorios!');
        return false;
    }

    //valida endereços
    if (!self.formEnderecoValidate.validate(true, true)) {
        self.modalApi.modalError('O(s) campo(s) ' + self.formEnderecoValidate.getInvalidFields() + ' são obrigatorios!');
        return false;
    }

    //valida matriculas
    if (!self.formMatriculaValidate.validate(true, true)) {
        self.modalApi.modalError('O(s) campo(s) ' + self.formMatriculaValidate.getInvalidFields() + ' são obrigatorios!');
        return false;
    }
    return true;

};
ProfileViewModel.prototype.addFormTelefone = function (numeroTelefone, tipoTelefone) {
    var self = this;

    var correntCountTel = self.telefoneContainer.find('.telefoneItem').length;

    if (correntCountTel < self.limitTelefones) {
        var html = $('<div class="telefoneItem"><!-- telefoneItem -->\n' +
            '        <div class="col-md-2 inputBlock">\n' +
            '            <label>Tipo</label>\n' +
            '            <select name="tipoTelefone" class="select" required  disabled>\n' +
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
            '                    class="form-control" required readonly disabled>\n' +
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
ProfileViewModel.prototype.removeFormTelefone = function () {
    var self = this;
    var telefoneItem = null;
    self.telefoneContainer.find('.telefoneItem').each(function () {
        telefoneItem = this;
    });

    var correntCountTel = self.telefoneContainer.find('.telefoneItem').length;

    if (correntCountTel > 1) {
        $(telefoneItem).remove();
    }

};
ProfileViewModel.prototype.addFormEndereco = function (enderecoData) {
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
ProfileViewModel.prototype.removeFormEndereco = function (enderecoItem) {
    var self = this;

    var correntCountEnd = self.enderecoContainer.find('.enderecoItem').length;

    if (correntCountEnd > 1) {
        $(enderecoItem).remove();
    }
};
ProfileViewModel.prototype.addFormMatricula = function (data) {
    var self = this;

    var correntCount = self.matriculaContainer.find('.matriculaItem').length;

    //get the template element:
    var template = document.getElementById("templateFormMatricula");

    //get the DIV element from the template:
    var html = template.content === undefined ? template.querySelector("div") : template.content.querySelector("div");
    html = $(html).clone();

    if (correntCount < 2) {

        if (data) {

            var matricula = data['matricula'];

            html.find('[name="inputMatricula"]').val(matricula['matricula']);
            html.find('[name="inputDataAdmissao"]').val(sqlDateToBrasilDate(matricula['dataAdmissao']));
            html.find('[name="inputDataExoneracao"]').val(matricula['dataExoneracao']);
            html.find('[name="selectVinculo"]').val(matricula['idVinculo']);
            html.find('[name="selectCargo"]').val(matricula['idCargo']);
            html.find('[name="selectFG"]').val(matricula['idFuncaoGratificada']);
            html.find('[name="selectJornadaTrabalho"]').val(matricula['idJornadaTrabalho']);

            var inputLotacao = html.find('[name="inputLotacao"]');
            var inputLocalTrabalho = html.find('[name="inputLocalTrabalho"]');

            inputLotacao.attr('data-val', matricula['idLotacao']);
            inputLotacao.val(data['siglaLotacao']);

            inputLocalTrabalho.attr('data-val', matricula['idLocalTrabalho']);
            inputLocalTrabalho.val(data['siglaLocalTrabalho']);

            html.find('[name="checkboxCapturouBiometria"]').prop('checked', matricula['biometria']);
            html.find('[name="checkboxMatriculaAtivo"]').prop('checked', matricula['ativo']);
            html.find('[name="textareaObservacao"]').val(matricula['observacoes']);
        }
        self.matriculaContainer.append(html);
        self.updateFields();
    }
};
ProfileViewModel.prototype.removeFormMatricula = function (matriculaItem) {
    var self = this;

    var correntCount = self.matriculaContainer.find('.matriculaItem').length;

    if (correntCount > 1) {
        $(matriculaItem).remove();
    }
};
//CARREGA DADOS DE ENDERECO
ProfileViewModel.prototype.getPaises = function (select, idPaisToSelect) {
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
ProfileViewModel.prototype.getUFs = function (select, idUfToSelect) {
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
ProfileViewModel.prototype.getMunicipios = function (select, idUF, idMunicipioToSelect) {
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
ProfileViewModel.prototype.getRedesSociais = function () {
    var self = this;

    self.loaderApi.show();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'perfilusuario/' + self.idPessoa);
    self.restClient.setMethodGET();
    self.restClient.setDataToSender(null);
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        console.log(data);
        if(data) {
            self.inputFacebook.val(data['facebook']);
            self.inputGooglePlus.val(data['googlePlus']);
            self.inputInstagram.val(data['instagram']);
            self.inputLinkedin.val(data['linkedin']);
            self.inputTwitter.val(data['twitter']);
            self.inputYoutube.val(data['youtube']);
            self.updateFields();
        }
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", jqXHR.responseJSON, "OK");
    });
    self.restClient.exec();
};

ProfileViewModel.prototype.saveRedesSociais = function () {
    var self = this;

    var dataToSender = {
        "idPessoa": self.idPessoa,
        "profissao": self.inputProfissao.val(),
        "facebook": self.inputFacebook.val(),
        "googlePlus": self.inputGooglePlus.val(),
        "instagram": self.inputInstagram.val(),
        "linkedin": self.inputLinkedin.val(),
        "twitter": self.inputTwitter.val(),
        "youtube": self.inputYoutube.val()
    };

    // console.log(JSON.stringify(dataToSender));

    //self.loaderApi.show();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'perfilusuario');
    self.restClient.setMethodPUT();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        self.modalApi.success(data['message']);
        // window.location = "/pages/cadastroServidor"
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        console.log(jqXHR.responseJSON);
        self.modalApi.modalError(jqXHR.responseJSON);
    });
    self.restClient.setProgressCallbackFunction(function (evt) {
    });
    self.restClient.exec();
};

//CRIA OU ATUALIZA SERVIDOR
ProfileViewModel.prototype.saveServidor = function () {
    var self = this;

    //valida
    if (!self.validaForm()) {
        return;
    }

    // OBTEM DADOS DE PESSOA
    var dataToSender = {
        'idPessoa': self.idPessoa,
        'tipo': 'fisica',
        'nome': smartCapitalize(self.inputNomePeFisica.val()),
        'emailPrincipal': self.inputEmailPrinPeFisica.val().toLowerCase(),
        'emailAdicional': self.inputEmailAdPeFisica.val().toLowerCase(),

        'cpf': self.inputCPF.val().replace(/[^\d]+/g, ''),
        'rg': self.inputRG.val(),
        'dataEmissao': self.inputDataEmissao.val(),
        'orgaoEmissor': self.inputOrgaoEmissor.val(),
        'idUfOrgaoEmissor': self.selectEstadoOrgaoEmissor.val(),
        'idPaisNacionalidade': self.selectNacionalidade.val(),
        'dataNascimento': self.inputDataNascimento.val(),
        'sexo': self.selectSexo.val(),

        'grupoSanguineo': self.selectGrupoSanguineo.val(),
        'fatorRH': self.selectFatorRH.val(),
        'profissao': self.inputProfissao.val(),


        'pis': self.inputPIS.val(),
        'estadoCivil': self.selectEstadoCivil.val(),
        'nomePai': self.inputNomePai.val(),
        'nomeMae': self.inputNomeMae.val(),

        'naturalidadeMunicipio': self.selectNaturalidadeMunicipio.val(),
        'naturalidadeUF': self.selectNaturalidadeUF.val(),

        'imagem': self.inputFotoPerfil.find('img').attr('src')
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

    // OBTEM MATRICULAS DE SERVIDORES
    var servidores = [];
    self.matriculaContainer.find('.matriculaItem').each(function (index) {
        var matriculaItem = {};
        $(this).find(':input').not('button, input[aria-label="Search"]').each(function (index) {
            switch (this.name) {
                case 'inputMatricula':
                    matriculaItem['matricula'] = this.value === "null" ? null : this.value;
                    break;
                case 'selectCargo':
                    matriculaItem['idCargo'] = this.value === "null" ? null : this.value;
                    break;
                case 'selectFG':
                    matriculaItem['idFuncaoGratificada'] = this.value === "null" ? null : this.value;
                    break;
                case 'inputDataAdmissao':
                    matriculaItem['dataAdmissao'] = this.value === "null" ? null : this.value;
                    break;
                case 'inputDataExoneracao':
                    matriculaItem['dataExoneracao'] = null;
                    break;
                case 'selectVinculo':
                    matriculaItem['idVinculo'] = this.value;
                    break;
                case 'inputLotacao':
                    matriculaItem['idLotacao'] = $(this).attr('data-val');
                    break;
                case 'inputLocalTrabalho':
                    matriculaItem['idLocalTrabalho'] = $(this).attr('data-val');
                    break;
                case 'selectJornadaTrabalho':
                    matriculaItem['idJornadaTrabalho'] = this.value;
                    break;
                case 'checkboxCapturouBiometria':
                    matriculaItem['biometria'] = $(this).is(':checked');
                    break;
                case 'checkboxMatriculaAtivo':
                    matriculaItem['ativo'] = $(this).is(':checked');
                    break;
                case 'textareaObservacao':
                    matriculaItem['observacoes'] = this.value;
            }
        });
        servidores.push(matriculaItem);
    });
    dataToSender['servidores'] = servidores;

    // OBTEM CARGA HORARIA DE SERVIDORES
    dataToSender['cargaHoraria'] = self.jTimeline.getSeries();

    // console.log(JSON.stringify(dataToSender));

    //self.loaderApi.show();
    //var id = self.idPessoa ? self.idPessoa : '';
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'servidores');
    self.restClient.setMethodPUT();
    self.restClient.setDataToSender(dataToSender);
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        self.modalApi.success(data['message']);
        // window.location = "/pages/cadastroServidor"
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        console.log(jqXHR.responseJSON);
        self.modalApi.modalError(jqXHR.responseJSON);
    });
    self.restClient.setProgressCallbackFunction(function (evt) {
    });
    self.restClient.exec();
};

ProfileViewModel.prototype.getServidor = function () {
    var self = this;

    self.loaderApi.show();
    self.restClient.setDataToSender({});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'servidores/token');
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        self.fillFormPessoa(data);
        self.getRedesSociais();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Sistemas', callback.responseJSON, 'OK');
        self.loaderApi.hide();
    });
    self.restClient.exec();

};
ProfileViewModel.prototype.getCargos = function (select) {
    var self = this;

    self.loaderApi.show();
    self.restClient.setDataToSender({});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'cargos');
    self.restClient.setMethodPOST();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        if (!select) {
            var template = document.getElementById("templateFormMatricula");
            var templateContent = template.content === undefined ? template.querySelector("div") : template.content.querySelector("div");
            var selectCargo = templateContent.querySelector('select[name="selectCargo"]');
            nativeFillSelect(selectCargo, data['data'], 'id', 'nome');
            fillSelect($('[name="selectCargo"]'), data['data'], 'id', 'nome');
        } else {
            fillSelect(select, data['data'], 'id', 'nome');
        }
        self.updateFields();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Sistemas', callback.responseJSON, 'OK');
        self.loaderApi.hide();
    });
    self.restClient.exec();
};
ProfileViewModel.prototype.getFuncoes = function (select) {
    var self = this;

    self.loaderApi.show();
    self.restClient.setDataToSender({});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'funcoes');
    self.restClient.setMethodPOST();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        if (!select) {
            var template = document.getElementById("templateFormMatricula");
            var templateContent = template.content === undefined ? template.querySelector("div") : template.content.querySelector("div");
            var selectFG = templateContent.querySelector('select[name="selectFG"]');
            nativeFillSelect(selectFG, data['data'], 'id', 'nome');
            fillSelect($('[name="selectFG"]'), data['data'], 'id', 'nome');
        } else {
            fillSelect(select, data['data'], 'id', 'nome');
        }
        self.updateFields();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Sistemas', callback.responseJSON, 'OK');
        self.loaderApi.hide();
    });
    self.restClient.exec();
};
ProfileViewModel.prototype.getVinculos = function (select) {
    var self = this;
    self.loaderApi.show();
    self.restClient.setDataToSender({});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'vinculos');
    self.restClient.setMethodPOST();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        if (!select) {
            var template = document.getElementById("templateFormMatricula");
            var templateContent = template.content === undefined ? template.querySelector("div") : template.content.querySelector("div");
            var selectVinculo = templateContent.querySelector('select[name="selectVinculo"]');
            nativeFillSelect(selectVinculo, data['data'], 'id', 'vinculo');
            fillSelect($('[name="selectVinculo"]'), data['data'], 'id', 'vinculo');
        } else {
            fillSelect(select, data['data'], 'id', 'vinculo');
        }
        self.updateFields();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Sistemas', callback.responseJSON, 'OK');
        self.loaderApi.hide();
    });
    self.restClient.exec();
};
ProfileViewModel.prototype.getJornadas = function (select) {
    var self = this;
    self.loaderApi.show();
    self.restClient.setDataToSender({});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'jornadas');
    self.restClient.setMethodPOST();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        if (!select) {
            var template = document.getElementById("templateFormMatricula");
            var templateContent = template.content === undefined ? template.querySelector("div") : template.content.querySelector("div");
            var selectJornadaTrabalho = templateContent.querySelector('select[name="selectJornadaTrabalho"]');
            nativeFillSelect(selectJornadaTrabalho, data['data'], 'id', 'descricao');
            fillSelect($('[name="selectJornadaTrabalho"]'), data['data'], 'id', 'descricao');
        } else {
            fillSelect(select, data['data'], 'id', 'vinculo');
        }
        self.updateFields();
    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Sistemas', callback.responseJSON, 'OK');
        self.loaderApi.hide();
    });
    self.restClient.exec();
};
ProfileViewModel.prototype.getLocais = function () {
    var self = this;
    self.loaderApi.show();
    self.restClient.setDataToSender({});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'locais');
    self.restClient.setMethodPOST();
    self.restClient.setSuccessCallbackFunction(function (data) {

        self.loaderApi.hide();
        var options = '<option value=""></option>';
        var locais = data['data'];
        for (var j = 0; j < locais.length; j++) {
            var id = locais[j]['id'];
            var label = locais[j]['unidade'] + ' - ' + locais[j]['setor'];
            options += '<option value="' + id + '">' + label + '</option>';
        }
        self.selectLocalBiometria[0].innerHTML = options;
        /*self.selectLocalBiometria.selectpicker();
        self.updateFields();*/

    });
    self.restClient.setErrorCallbackFunction(function (callback) {
        self.modalApi.showModal(ModalAPI.ERROR, 'Sistemas', callback.responseJSON, 'OK');
        self.loaderApi.hide();
    });
    self.restClient.exec();
};
ProfileViewModel.prototype.getOrganogramas = function () {
    var self = this;
    self.loaderApi.show();

    self.treeViewOrganograma.setupDisplayItems(
        [
            {'key': 'idOrganograma', 'type': ModernTreeView.ID},
            {'key': 'text', 'type': ModernTreeView.LABEL}
        ]
    );
    self.treeViewOrganograma.setExplorerStyle();
    self.treeViewOrganograma.setMethodPOST();
    self.treeViewOrganograma.setWebServiceURL(self.webserviceJubarteBaseURL + 'organogramas/hierarquia');
    self.treeViewOrganograma.setOnLoadSuccessCallback(function (response) {
        self.loaderApi.hide();
    });
    self.treeViewOrganograma.setOnLoadErrorCallback(function (callback) {
        self.loaderApi.hide();
    });
    self.treeViewOrganograma.setOnClick(function (data) {
        if (self.correntInputOrganograma) {
            self.correntInputOrganograma.val(data['sigla']);
            self.correntInputOrganograma.attr('data-val', data['idOrganograma']);
            self.correntInputOrganograma = null;
        }
        self.modalOrganograma.modal('hide');
    });
    self.treeViewOrganograma.load();
};

ProfileViewModel.prototype.fillFormPessoa = function (data) {
    var self = this;

    var pessoa = data['pessoa']['fisica'];
    var enderecos = data['pessoa']['enderecos'];
    var telefones = data['pessoa']["telefones"];
    var cargaHoraria = data['cargaHoraria'];

    self.idPessoa = pessoa['id'];
    self.inputNomePeFisica.val(pessoa['nome']);
    self.inputEmailPrinPeFisica.val(pessoa['emailPrincipal']);
    self.inputEmailAdPeFisica.val(pessoa['emailAdicional']);
    self.inputCPF.val(pessoa['cpf']);
    self.inputCPF.mask("000.000.000-00");
    self.selectSexo.val(pessoa['sexo']);
    self.inputDataNascimento.val(sqlDateToBrasilDate(pessoa['dataNascimento']));
    self.inputRG.val(pessoa['rg']);
    self.inputOrgaoEmissor.val(pessoa['orgaoEmissor']);
    self.inputDataEmissao.val(sqlDateToBrasilDate(pessoa['dataEmissao']));
    self.selectEstadoOrgaoEmissor.val(pessoa['idUfOrgaoEmissor']);
    self.selectNacionalidade.val(pessoa['idPaisNacionalidade']);
    self.inputFotoPerfil.find('img').attr('src', pessoa['image']);

    self.getUFs(self.selectNaturalidadeUF, pessoa['naturalidadeUF']);
    self.getMunicipios(self.selectNaturalidadeMunicipio, pessoa['naturalidadeUF'], pessoa['naturalidadeMunicipio']);

    self.inputProfissao.val(pessoa['profissao']);
    self.selectGrupoSanguineo.val(pessoa['grupoSanguineo']);
    self.selectFatorRH.val(pessoa['fatorRH']);
    self.inputPIS.val(pessoa['pis']);
    self.selectEstadoCivil.val(pessoa['estadoCivil']);
    self.inputNomePai.val(pessoa['nomePai']);
    self.inputNomeMae.val(pessoa['nomeMae']);

    self.updateFields();

    if (enderecos.length >= 1) {
        self.enderecoContainer.empty();
    }

    enderecos.forEach(function (item, index, array) {
        self.addFormEndereco(item);
    });

    if (telefones.length >= 1) {
        self.telefoneContainer.empty();
    }

    telefones.forEach(function (item, index, array) {
        self.addFormTelefone(item['numero'], item['tipo']);
    });

    self.matriculaContainer.empty();
    var servidor = data['servidor'];
    servidor.forEach(function (item, index, array) {
        self.addFormMatricula(item);
    });
    //reseta o jTimeline
    self.jTimeline.reset();
    if (cargaHoraria) {
        cargaHoraria.forEach(function (carga, index, array) {
            var horarios = carga['horarios'];
            var localBio = carga['localBiometria'];
            if (horarios) {
                horarios.forEach(function (horario, index, array) {
                    self.jTimeline.addDatetimeSerie(carga['idLocalBiometria'], localBio['unidade'], horario['entrada'], horario['saida']);
                });
            }
        });
    }
};
//troca senha
ProfileViewModel.prototype.changeUserPassword = function () {
    var self = this;

    if(self.inputCurrentPassword.val().length < 6){
        self.modalApi.showModal(ModalAPI.ERROR, 'Alterar Senha', 'Digite a senha atual!','OK');
        return;
    }

    if(self.inputNewPassword.val() !== self.inputRepeatNewPassword.val()){
        self.modalApi.showModal(ModalAPI.ERROR, 'Alterar Senha', 'As senhas não coincidem!', 'OK');
        return;
    }

    if(self.inputNewPassword.val().length < 8){
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