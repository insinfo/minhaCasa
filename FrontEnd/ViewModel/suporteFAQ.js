function SuporteFaq() {
    this.loader = new LoaderAPI();
    this.modal = new ModalAPI();

    this.questionSearch = "";
    this.init();
}

SuporteFaq.prototype.init = function () {
    this.initdataGridQuestionBase();
    this.initEvents();
};

SuporteFaq.prototype.initdataGridQuestionBase = function () {
    var self = this;

    var urlFaqQuestions = WEBSERVICE_JUBARTE_FAQ_BASE_URL;
    var dataFilter = {};

    if (this.questionSearch) {
        dataFilter = {search: this.questionSearch};
    }

    this.loader.show();

    this.dataGridQuestionBase = new ModernDataGrid("questions", "questions-template");
    this.dataGridQuestionBase.setWebServiceURL(urlFaqQuestions);
    this.dataGridQuestionBase.setMethodGET();
    this.dataGridQuestionBase.setupDisplayItems([
        {
            key: "categoria",
            target: "category-title"
        }
    ]);
    this.dataGridQuestionBase.setDataToSend(dataFilter);

    this.dataGridQuestionBase.onPageChange = function () {
        self.loader.show();
    }

    this.dataGridQuestionBase.setItemsPerPage(100);
    this.dataGridQuestionBase.setPaginationStyleCaroulsel();
    this.dataGridQuestionBase.setButtonsQuantity(11);

    this.dataGridQuestionBase.onLoadDataSuccess = function (d) {
        this.allData = d;
        this.dataLoaded['data'] = d.data.categories;

        self.permissions = d.data.userPermissions;

        if (self.permissions) {
            if (!self.permissions.faq.add) {
                $("#add-new").hide();
            }
        };

        self.loader.hide();
    }
    this.dataGridQuestionBase.onLoadSuccess = function () {
        if (self.questionSearch) {
            $("#questions div.panel-collapse").collapse("show");
        }
    }
    this.dataGridQuestionBase.onLoadError = function (evt) {
        self.loader.hide();

        var msg = "<p>Você será redirecionado para a página de login </p>";

        self.modal.modalError(evt.responseJSON.message +  msg).onClick(function () {
            if (evt.status === 401) {
                setTimeout(function () {
                    location.href='/';
                }, 1000);
            }
        });


    }
    this.dataGridQuestionBase.onItemDraw = function (template, item, i) {
        var id = template.find('a').attr('href');
        var cid = template.find('.panel-collapse').attr('id');

        template.find('a').attr('href', id + '-' + i);
        var temp = template.find('.panel-collapse').attr('id', cid + '-' + i);

        var dataGridQuestion = new ModernDataGrid(cid + '-' + i, "questions-template-item");
        dataGridQuestion.container = temp;
        dataGridQuestion.onLoadError = function (evt) {};
        dataGridQuestion.onLoadSuccess = function (data) {};
        dataGridQuestion.onItemDraw = function (template, itemData, i2) {
            var s = "item-" + i + '-' + i2;

            template.find('a').attr('href', "#" + s);
            var item = template.find('.panel-collapse').attr('id', s);

            var buttons = item.find('.button-like-unlike');
            var likeCount = item.find('.like-count');
            var unlikeCount = item.find('.unlike-count');

            likeCount.html(itemData.like);
            unlikeCount.html(itemData.unlike);

            var sessionLike = localStorage.getItem('like' + itemData.id);
            var sessionUnlike = localStorage.getItem('unlike' + itemData.id);

            var notification = new ModalAPI();

            if (sessionLike || sessionUnlike) {
                if (sessionLike) {
                    buttons.find('.btn-like').removeClass('text-muted').addClass('text-primary');
                } else {
                    buttons.find('.btn-unlike').removeClass('text-muted').addClass('text-primary');
                }
                buttons.find('a').click(function (evt) { evt.preventDefault();
                    if (sessionLike) {
                        notification.notify(ModalAPI.INFO, 'Notificação', "Você já deu <strong>like</strong> neste faq!");
                    } else if (sessionUnlike) {
                        notification.notify(ModalAPI.INFO, 'Notificação', "Você já deu <strong>unlike</strong> neste faq!");
                    }
                });

            } else {
                buttons.find('.btn-like').click(function (evt) {
                    evt.preventDefault();
                    self.eventButtonLikeClick(buttons, likeCount, itemData, evt);
                    buttons.find('a').off().click(function (evt) {evt.preventDefault()});
                });
                buttons.find('.btn-unlike').click(function (evt) {
                    evt.preventDefault();
                    self.eventButtonUnlikeClick(buttons, unlikeCount, itemData, evt);
                    buttons.find('a').off().click(function (evt) {evt.preventDefault()});
                });
            }

            var buttonEditLine = template.find(".question-edit");
            buttonEditLine[0].dataset.object= JSON.stringify(itemData);

            buttonEditLine.off();
            $(buttonEditLine).click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                self.eventButtonNewFaqItemClick(buttonEditLine);
            });

        };
        dataGridQuestion.setupDisplayItems([
            {
                key: 'titulo',
                target: 'question'
            },
            {
                key: 'descricao',
                target: 'panel-body',
                render: function (value) {
                    return value;
                }
            },
            {
                key: 'dataCriacao',
                target: 'date'
            },
            {
                key: 'id',
                target: 'question-edit',
                render: function (value) {
                    if (self.permissions) {
                        if (!self.permissions.faq.edit) {
                            return "";
                        }
                    }

                    var buttonHtml = "<button data-key=\"" + value + "\" class=\"pull-right btn btn-default question-edit\" title=\"Editar\">\n" +
                        "<span class=\"glyphicon glyphicon-pencil\"></span>\n" +
                        "</button>\n"
                    return buttonHtml;
                }
            }
        ]);
        dataGridQuestion.setMethodGET();

        var filterData = [];

        this.allData.data.itens.forEach(function (el) {
           if (el.categoria == item.categoria) {
                filterData.push(el);
           }
        });

        try {
            dataGridQuestion.loadFromJson(filterData);
        } catch (e) {
            console.log(e);
        }

    }
    this.dataGridQuestionBase.loadDataFromURL();
    this.dataGridQuestionBase.renderPagination();
};

SuporteFaq.prototype.initEvents = function () {

    this.modalApi = window.location != window.parent.location ? window.parent.getModal() : new ModalAPI();

    var inputSearch = $("#search");
    var buttonSearchGo = $("#search-go");
    var buttonNewFaqItem = $("#add-new");

    var self = this;
    buttonNewFaqItem.click(function () {
        self.eventButtonNewFaqItemClick();
    });
    buttonSearchGo.click(function (e) {
        e.preventDefault();
        self.questionSearch = inputSearch.val();
        self.initdataGridQuestionBase();
    });

};

SuporteFaq.prototype.eventButtonLikeClick = function (buttons, count, itemData, evt) {

    var url = WEBSERVICE_JUBARTE_FAQ_BASE_URL + '/' + itemData.id  + '/like';

    var notification = new ModalAPI();
    var rest = new RESTClient();
    rest.setWebServiceURL(url);
    rest.setMethodPOST();
    rest.setSuccessCallbackFunction(function (d) {
        var d = d.data;
        if (d.like > itemData.like) {
            count.html(d.like);
            buttons.find('a').off().click(function (evt) {
                evt.preventDefault();
                notification.notify(ModalAPI.INFO, 'Notificação', "Você já deu <strong>like</strong> neste faq!");
            });
            buttons.find('.btn-like').addClass('text-primary').removeClass('text-muted');
            localStorage.setItem('like' + d.id, d.like);
            notification.notify(ModalAPI.SUCCESS, 'Like', "Seu like foi enviado com sucesso. Obrigado por participar!");
        }
    });
    rest.setErrorCallbackFunction(function () {
        notification.notify(ModalAPI.ERROR, 'Like', "Algum erro aconteceu, não foi possível enviar seu like. Tente novamente mais tarde!");
    });
    rest.exec();


};
SuporteFaq.prototype.eventButtonUnlikeClick = function (buttons, count, itemData, evt) {
    var rest = new RESTClient();
    var notification = new ModalAPI();
    rest.setWebServiceURL(WEBSERVICE_JUBARTE_FAQ_BASE_URL + '/' + itemData.id  + '/unlike');
    rest.setMethodPOST();
    rest.setSuccessCallbackFunction(function (d) {
        var d = d.data;
        if (d.unlike > itemData.unlike) {
            count.html(d.unlike);
            buttons.find('a').off().click(function (evt) {
                evt.preventDefault();
                notification.notify(ModalAPI.INFO, 'Notificação', "Você já deu <strong>unlike</strong> neste faq!");
            });

            buttons.find('.btn-unlike').addClass('text-primary').removeClass('text-muted');
            localStorage.setItem('unlike' + itemData.id, d.unlike);
            notification.notify(ModalAPI.SUCCESS, 'Unlike', "Seu <strong>unlike</strong> foi enviado com sucesso. Iremos trabalhar para melhorar o conteúdo disponibilizado. Obrigado por participar!");
        }
    });
    rest.setErrorCallbackFunction(function () {
        notification.notify(ModalAPI.ERROR, 'Unlike', "Algum erro aconteceu, não foi possível enviar seu unlike. Tente novamente mais tarde!");
    });
    rest.exec();
};
SuporteFaq.prototype.eventButtonNewFaqItemClick = function (button) {
    var self = this;

    var data_edit = null;

    if (button && button[0].dataset.object) {
        data_edit = JSON.parse(button[0].dataset.object);
    }

    var templateForm = $("#templateFormFaq");
    var modalApi = new ModalAPI();
    modalApi = window.location != window.parent.location ? window.parent.getModal() : new ModalAPI();

    modalApi.showTemplateModal(ModalAPI.PRIMARY, {
        mensagem: '',
        tituloMensagem: '',
        botoes: [
            {'label': 'Salvar', disableClose: true},
            {'label': 'Fechar'},
        ]
    }, templateForm, function onClose() {

    }).onLoaded(function (jqueryModalBody) {
        jqueryModalBody.find('textarea[name=descricao]').ckeditor();
        self.loader.show();

        var cmbCategory = jqueryModalBody.find('#cmbCategoria');
        cmbCategory.empty();

        var rest = new RESTClient();
        rest.setWebServiceURL(WEBSERVICE_JUBARTE_FAQ_BASE_URL + '/category');
        rest.setMethodGET();
        rest.setSuccessCallbackFunction(function (data) {
            if (data.data instanceof Array) {
                var option = document.createElement("option");
                option.value = "";
                option.innerHTML = "Selecione";
                cmbCategory.append($(option));

                data.data.forEach(function (el, index) {
                    var option = document.createElement('option');
                    option.value=el.categoria;
                    option.dataset.key = index;
                    option.innerHTML = el.categoria;

                    if (data_edit) {
                        if (data_edit.categoria === el.categoria) {
                            option.selected = true;
                        }
                    }

                    cmbCategory.append(option);
                });

                cmbCategory.selectpicker('refresh');
            }

            self.loader.hide();
        });
        rest.exec();

        if (data_edit) {
            jqueryModalBody.find("#form-faq input[name=titulo]").val(data_edit.titulo);
            jqueryModalBody.find("#form-faq textarea[name=descricao]").val(data_edit.descricao);
        }

        var btnNovaCategoria = $(jqueryModalBody).find("#nova-categoria");
        btnNovaCategoria.off();

        var txtInput = document.createElement("input");
        txtInput.name="categoria";
        txtInput.className="form-control";
        txtInput.id="inputCategoria";
        txtInput.placeholder = "Nome da nova categoria";

        var _memory = null;
        btnNovaCategoria.click(function (e) {
            e.preventDefault();

            if (this.value == 'nova-categoria') {
                _memory = cmbCategory;
                var cmbCategoryParent = cmbCategory.parent();
                cmbCategoryParent.empty();
                cmbCategoryParent.append(txtInput);
                txtInput.focus();

                btnNovaCategoria[0].innerHTML="<span class=\"glyphicon glyphicon-remove\"></span>";
                btnNovaCategoria[0].className="btn btn-danger";
                btnNovaCategoria[0].title="Listar categorias cadastradas";

                this.value = "listar-categorias";
            } else {
                this.value = "nova-categoria";
                var cmbCategoryParent = $(txtInput).parent();
                cmbCategoryParent.empty();
                cmbCategoryParent.append(cmbCategory);
                cmbCategory.selectpicker();

                btnNovaCategoria[0].innerHTML="<span class=\"glyphicon glyphicon-plus\"></span>";
                btnNovaCategoria[0].className="btn btn-default";
                btnNovaCategoria[0].title="Nova Categoria";

            }

        });


    }).onClick('salvar', function (objSerialized, modal) {

        var msg = "O campo título não pode ser vasio!";
        if (!validaString(objSerialized.titulo)) {
            modalApi.notify(ModalAPI.ERROR, 'Erro: ', msg);
            $(modal).find("#form-faq input[name=titulo]").focus();
            return false;
        }

        msg = "O campo categoria não pode ser vasio!";
        if (!validaString(objSerialized.categoria)) {
            modalApi.notify(ModalAPI.ERROR, 'Erro: ', msg);
            $(modal).find("#form-faq select[name=categoria]").focus();
            return false;
        }

        msg = "O campo descrição não pode ser vasio!";
        if (!validaString(objSerialized.descricao)) {
            modalApi.notify(ModalAPI.ERROR, 'Erro: ', msg);
            $(modal).find("#form-faq textarea[name=descricao]").focus();
            return false;
        }

        modalApi.closeModal(modal);
        self.loader.show();

        var rest = new RESTClient();

        if (!data_edit) {
            rest.setWebServiceURL(WEBSERVICE_JUBARTE_FAQ_BASE_URL);
            rest.setMethodPOST();
        } else {
            rest.setWebServiceURL(WEBSERVICE_JUBARTE_FAQ_BASE_URL + "/" + data_edit.id);
            rest.setMethodPUT();
        }

        rest.setDataToSender(objSerialized);
        rest.setErrorCallbackFunction(function (data) {
           modalApi.modalError(data.exception);
        });
        rest.setSuccessCallbackFunction(function (data) {
            self.loader.onClose = function () {
                if (!data_edit) {
                    modalApi.notify(ModalAPI.SUCCESS, 'FAQ', "Item adicionado com sucesso!");
                } else {
                    modalApi.notify(ModalAPI.SUCCESS, 'FAQ', "Item alterado com sucesso!");
                }
                self.loader.onClose = null;
            }
            self.initdataGridQuestionBase();
            self.loader.hide();
        });
        rest.exec();

    }, true);
};

var App = null;

$(document).ready(function () {
    App = new SuporteFaq();
});
