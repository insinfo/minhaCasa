var mainViewVM = null;
$(function () {
    mainViewVM = new MainViewModel();
    mainViewVM.init();
});

function MainViewModel() {

    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.defaultModal = $('#defaultModal');
    this.menuAPI = new MenuAPI('sidebarMainMenu');
    this.modalApi = new ModalAPI();
    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;

    this.pageLoginView = $("#pageLoginView");
    this.pageMainView = $("#pageMainView");
    this.iframeShowPage = $("#iframeShowPage");
    this.userInfoCargo = $("#user-info-cargo");

    //FORMULARIO DE LOGIN
    this.btnLogar = $('#btnLogar');
    this.inputUserPass = $('#inputSenha');
    this.inputUserName = $('#inputNomeUsuario');

    //TOKEN CONFIG
    this.accessTokenKey = 'YWNjZXNzX3Rva2Vu';
    this.expiresInKey = 'ZXhwaXJlc19pbg==';
    this.userFullNameKey = 'ZnVsbF9uYW1l';

    this.intervalFunctionIdKey = 'intervalFunctionId';
    this.loginNameKey = 'loginName';
    this.idPessoaKey = 'idPessoa';
    this.idOrganogramaKey = 'idOrganograma';
    this.idPerfilKey = 'idPerfil';
    this.imagemPessoaKey = 'imagemPessoa';
    this.userInfoBox = $('#userInfoBox a');
    this.userInfoContainer = $('#userInfoContainer');

    //ULTIMOS EMAILS E NOTIFICAÇÕES
    this.lastEmailsContainer = $('#lastEmailsContainer');
    this.notificacoesContainer = $('#notificacoesContainer');
    this.spanTotalNotificacoes = $('#spanTotalNotificacoes');

    //MENU PRINCIPAL
    this.sidebarMainMenu = $('#sidebarMainMenu');
    this.btnMainMenu = $('[name="btn-main-menu"]');
    this.btnDetachedRBar = $('[name="btn-detached-right-bar"]');
    this.breadcrumb = null;

    //
    this.btnLogout = $('#btnLogout');
    this.btnLogout2 = $('#btnLogout2');
    this.displayUserName = $('.displayUserName');
    this.displaySaldacao = $('.displaySaldacao');

    //FORM BUG REPORT
    this.btnSendBugReport = $('#btnSendBugReport');
    this.btnOpenModalBugReport = $('#btnOpenModalBugReport');
    this.modalBugReport = $('#modalBugReport');
    this.pasteClipboardData = null;
    this.screenshotData = null;
    this.inputNomeSistema = $('#inputNomeSistema');
    this.inputPaginaSistema = $('#inputPaginaSistema');
    this.textareaDescricaoProblema = $('#textareaDescricaoProblema');
    this.printScreenThumbnail = $('#printScreenThumbnail');

    //mail Dropdown Menu Container
    this.mailDropdownContainer = $('#mailDropdownContainer');

    //client ip
    this.ipPrivado = '';
    this.ipPublico = '';

    this.btnLimparNotificacoes = $('#btnLimparNotificacoes');
    this.notificationsLoopId = null;
}

MainViewModel.prototype.init = function () {
    var self = this;

    //coloca o video se for desktop
    var regexMob = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i;
    var regexDesk = /Linux|Windows|Macintosh/i;
    if (regexDesk.test(navigator.userAgent)) {
        $('#videoPlay').append('<source src="/cdn/Assets/video/bgJubarteNovo.mp4" type="video/mp4">');
        // PerfectScrollBar
        /*new PerfectScrollbar($(".sidebar-fixed .sidebar-content")[0], {
            wheelPropagation: true
        });*/
    }

    //get client private ip
    getUserIP(function (ip) {
        self.ipPrivado = ip;
    });
    //get client public ip
    $.getJSON('https://api.ipify.org?format=json', function (data) {
        self.ipPublico = data['ip'];
    });

    self.eventos();
    //verifica se é necessário logar
    if (sessionStorage.getItem(self.accessTokenKey)) {
        self.checkToken();
    }
    else {
        self.showLoginView();
    }

};
//inicializa itens depois do login
MainViewModel.prototype.initPostAuth = function () {
    var self = this;

    self.menuAPI.setMethod('GET');
    self.menuAPI.setDisplayItems([
        {'key': 'id', 'type': MenuAPI.ID},
        {'key': 'icone', 'type': MenuAPI.ICON},
        {'key': 'label', 'type': MenuAPI.LABEL},
        {'key': 'nodes', 'type': MenuAPI.NODES},
        {'key': 'rota', 'type': MenuAPI.ROUTE}
    ]);
    self.menuAPI.setWebServiceURL(this.webserviceJubarteBaseURL + 'menus');
    self.menuAPI.setTarget('iframeShowPage');
    self.menuAPI.setOnMenuItemClick(function (breadcrumb) {
        self.breadcrumb = breadcrumb;
        $('.sidebar-mobile-main-toggle').trigger('click');
    });
    self.menuAPI.load();
    self.getLastEmails();

    //set definições de apresentação de usuario
    self.displaySaldacao.html(self.saudacao());
    var userFullName = sessionStorage.getItem(self.userFullNameKey);
    var imagemPessoa = sessionStorage.getItem(self.imagemPessoaKey);
    self.displayUserName.text(userFullName);
    if (imagemPessoa === "/cdn/Assets/icons/userNoImage.jpg" || imagemPessoa == null || imagemPessoa == '') {
        self.userInfoBox.html('<span class="userThumbnailLarge" ><i>LE</i></span>');
        $('.userThumbnailLarge').css('background-color', stringToColour(userFullName));
        $('.userThumbnailLarge i').text(retornarIniciais(userFullName));
    } else {
        self.userInfoBox.html('<img src="' + imagemPessoa + '" class="img-circle img-responsive" alt="">');
    }
    self.userInfoContainer.css({'background-image': 'url(https://picsum.photos/200/300/?random&blur)'});

    //inicia o loop de interações dinamicas
    self.loop();

    //exibe e inicializa o timeout da Sessão
    if (sessionStorage.getItem(self.expiresInKey) != null) {
        clearTimeout(self.getSessionTimeoutId());
        self.displaySessionTimeout();
    }

    // get cargo servidor
    if ((idPessoa = sessionStorage.getItem('idPessoa')) !== undefined) {
        var restApi = new RESTClient();
        restApi.setMethodGET();
        restApi.setWebServiceURL(WEBSERVICE_JUBARTE_BASE_URL + 'cargo/pessoa/' + idPessoa);
        restApi.setSuccessCallbackFunction(function (data) {
            if (data.nome) {
                self.userInfoCargo.html(data.nome);
            }
        });
        restApi.exec();
    }

};
MainViewModel.prototype.getSessionTimeoutId = function () {
    var self = this;
    return sessionStorage.getItem(self.intervalFunctionIdKey);
};
MainViewModel.prototype.setSessionTimeoutId = function (intervalFunctionId) {
    var self = this;
    return sessionStorage.setItem(self.intervalFunctionIdKey, intervalFunctionId);
};
MainViewModel.prototype.displaySessionTimeout = function () {
    var self = this;
    var intervaloSec = 2;
    self.setSessionTimeoutId(setInterval(function () {
        var sessionTimeCount = sessionStorage.getItem(self.expiresInKey);
        $('.sessionTimeout span').text(secondsToHoursMinSec(sessionTimeCount));
        sessionTimeCount = sessionTimeCount - intervaloSec;
        sessionStorage.setItem(self.expiresInKey, sessionTimeCount);

        if (sessionTimeCount <= 0) {
            clearTimeout(self.getSessionTimeoutId());
            self.logout();
        }
    }, intervaloSec * 1000));

};
MainViewModel.prototype.loop = function () {
    var self = this;
    var intervaloSec = 60;
    self.getNotificationsFromServer();
    self.notificationsLoopId = setInterval(function () {
        self.getNotificationsFromServer();
    }, intervaloSec * 1000);
};
MainViewModel.prototype.getNotificationsFromServer = function () {
    var self = this;

    var limitNotificationLocal = 20;
    // Obtém os dados da localStorage
    var notifications = self.getNotificationsFromLocalStorage();

    var lastDataCriado = null;

    if (notifications) {
        //ordena por id desc
        notifications.sort(dynamicSort("-id"));
        var item = notifications[0];
        lastDataCriado = item['dataCriado'];
    }

    var dataToSend = {
        "idOrganograma": sessionStorage.getItem(self.idOrganogramaKey),
        "idPessoa": sessionStorage.getItem(self.idPessoaKey),
        "dataCriado": lastDataCriado
    };

    self.restClient.setDataToSender(dataToSend);

    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'notifications/latest');
    self.restClient.setMethodPOST();
    self.restClient.setSuccessCallbackFunction(function (data) {
        if (data['data'].length > 0) {
            var newNotifications = data['data'];
            if (notifications) {
                //converte para array
                var oldNotifications = $.map(notifications, function (value, index) {
                    return [value];
                });
                //mescla os novos com os velhos
                Array.prototype.push.apply(oldNotifications, newNotifications);
                //ordena
                oldNotifications.sort(dynamicSort("-id"));
                //limita a quandidade de itens salvos localmente
                if (oldNotifications.length > limitNotificationLocal) {
                    oldNotifications.length = limitNotificationLocal;
                }
                localStorage.setItem('notifications', JSON.stringify(oldNotifications));

            } else {
                //converte para array
                newNotifications = $.map(newNotifications, function (value, index) {
                    return [value];
                });
                //ordena
                newNotifications.sort(dynamicSort("-id"));
                //limita a quandidade de itens salvos localmente
                if (newNotifications.length > limitNotificationLocal) {
                    newNotifications.length = limitNotificationLocal;
                }
                localStorage.setItem('notifications', JSON.stringify(newNotifications));
            }
            //exibe a ultima notificação
            var count = newNotifications.length > 1 ? 1 : newNotifications.length;
            for (var i = 0; i < count; i++) {
                var item = newNotifications[i];
                var link = item['link'] ? 'href="' + item['link'] + '"' : '';
                link = link.replace('?', '?p='+ sessionStorage.getItem('YWNjZXNzX3Rva2Vu')+'&');
                $.jGrowl('<a ' + link + ' target="iframeShowPage">' + item['mensagem'] + '</a>', {
                        header: 'Notificação', theme: 'alert-styled-left bg-orange-600'
                    }
                );
                new Audio('/cdn/Assets/sounds/plucky.mp3').play();
            }

            self.renderNotifications();
        } else {

        }
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
    });
    self.restClient.exec();
    self.renderNotifications();
};
MainViewModel.prototype.getNotificationsFromLocalStorage = function () {
    var self = this;

    var notifications = localStorage.getItem('notifications');
    notifications = notifications !== undefined && notifications !== "undefined" && notifications !== null ? JSON.parse(notifications) : null;
    var userLogedIdPessoa = sessionStorage.getItem(self.idPessoaKey);
    var userLogedIdOrganograma = sessionStorage.getItem(self.idOrganogramaKey);

    var result = [];
    if (notifications) {
        //converte para array
        notifications = $.map(notifications, function (value, index) {
            return [value];
        });
        //ordena pelo mais recente primeiro
        notifications.sort(dynamicSort("-id"));

        notifications.forEach(function (item) {

            if (
                item['idPessoa'] == userLogedIdPessoa
                || item['idOrganograma'] == userLogedIdOrganograma
                || item['toAll'] == true) {

                result.push(item);
            }
        });

        return result.length > 0 ? result : null;
    }
    return null;

};
MainViewModel.prototype.renderNotifications = function () {
    var self = this;

    var notifications = self.getNotificationsFromLocalStorage();

    if (notifications) {

        var totalNotificacoesNotLidas = 0;
        var html = "";
        for (var i = 0; i < notifications.length; i++) {
            var item = notifications[i];


            var link = item['link'] ? 'href="' + item['link'] + '"' : '';
            link = link.replace('?', '?p='+ sessionStorage.getItem('YWNjZXNzX3Rva2Vu')+'&');

            var mensagem = item['mensagem'] ? item['mensagem'] : '';
            var dataCriado = item['dataCriado'] ? item['dataCriado'] : '';

            var icon = item['icon'] ? '<a style="width:40px;display:inline-block;height:40px;"><img src="' + item['icon'] + '" style="width:40px;display:inline-block;"></a>' : '<a  class="btn bg-success-400 btn-rounded btn-icon btn-xs"><i class="icon-mention"></i></a>';

            var isLido = item['isLido'];
            if (!isLido) {
                totalNotificacoesNotLidas++;
                var template = '<li class="media"><div class="media-left">' +
                    icon +
                    '</div><div class="media-body">' +
                    '<a ' + link + ' target="iframeShowPage">' + mensagem + '</a> ' +
                    '<div class="media-annotation">' + dataCriado + '</div>' +
                    '</div>' +
                    '</li>';
                html += template;
            }
        }
        self.spanTotalNotificacoes.text(totalNotificacoesNotLidas);
        self.notificacoesContainer.empty();
        self.notificacoesContainer.append(html);
    }

};
MainViewModel.prototype.eventos = function () {
    var self = this;
    //limpa as notificações
    self.btnLimparNotificacoes.on('click', function () {
        var notifications = self.getNotificationsFromLocalStorage();
        if (notifications) {
            for (var i = 0; i < notifications.length; i++) {
                var item = notifications[i];
                item['isLido'] = true;
            }

            if (notifications.length > 0) {
                self.spanTotalNotificacoes.text(notifications.length);
                localStorage.setItem('notifications', JSON.stringify(notifications));
                self.renderNotifications();
            }
        }

    });

    // oculta todos os botoes da top-bar com a classe dynamic
    self.btnMainMenu.on('click', function () {
        var frameBody = self.iframeShowPage.contents().find('body');
        if (!frameBody.hasClass('sidebar-detached-hidden')) {
            frameBody.addClass('sidebar-detached-hidden');
        }
    });

    // alternar com menu desanexado lateral
    self.btnDetachedRBar.on('click', function () {
        var frameBody = $("iframe#iframeShowPage").contents().find('body');
        frameBody.toggleClass('sidebar-detached-hidden');
        if (!frameBody.hasClass('sidebar-detached-hidden')) {
            $('body#window').addClass('sidebar-xs');
        }
    });

    //login
    self.btnLogar.click(function () {
        self.autenticar();
    });
    self.inputUserName.keypress(function (e) {
        if (e.which === 13) {
            self.autenticar();
        }
    });
    self.inputUserPass.keypress(function (e) {
        if (e.which === 13) {
            self.autenticar();
        }
    });
    //logout
    self.btnLogout.click(function () {
        self.logout();
    });
    self.btnLogout2.click(function () {
        self.logout();
    });

    //
    self.btnSendBugReport.click(function (e) {
        self.sendBugReport();
    });

    self.btnOpenModalBugReport.click(function () {
        self.printScreen();
    });

    //quando o iframe terminar de carregar uma pagina
    self.iframeShowPage.on('load', function () {
        self.onPageLoaded();
    });

    //evento que fechas os dropdowns da barra jubarte
    var listener = window.addEventListener('blur', function () {
        if (document.activeElement === document.getElementById('iframe')) {

        } else {
            $('.dropdown-toggle').each(function () {
                var ele = $(this);

                if (ele.attr('aria-expanded') == undefined) {

                } else if (ele.attr('aria-expanded') == 'true') {
                    //ele.trigger('click');
                    ele.dropdown('toggle');
                    return
                }
            });
        }
        window.removeEventListener('blur', listener);
    });

    //evento
    self.userInfoBox.on('click', function (e) {
        //e.stopPropagation();
        self.iframeShowPage.attr('src', "/pages/meuPerfil");
    });


};
MainViewModel.prototype.autenticar = function () {
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

        sessionStorage.setItem(self.accessTokenKey, data['accessToken']);
        sessionStorage.setItem(self.expiresInKey, data['expiresIn']);
        sessionStorage.setItem(self.loginNameKey, data['loginName']);
        sessionStorage.setItem(self.userFullNameKey, data['fullName']);
        sessionStorage.setItem(self.idPessoaKey, data['idPessoa']);
        sessionStorage.setItem(self.idOrganogramaKey, data['idOrganograma']);
        sessionStorage.setItem(self.idPerfilKey, data['idPerfil']);
        sessionStorage.setItem(self.imagemPessoaKey, data['imagemPessoa']);
        self.initPostAuth();
        self.showMainView();
        self.loaderApi.hide();
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
        alert('Credencial Invalida!');
    });
    self.restClient.exec();
};
MainViewModel.prototype.checkToken = function () {
    var self = this;
    self.loaderApi.show();
    //faz uma requisição a API Rest para validar token
    self.restClient.setDataToSender({"access_token": sessionStorage.getItem(self.accessTokenKey)});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'auth/check');
    self.restClient.setMethodPOST();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.showMainView();
        self.loaderApi.hide();
        self.initPostAuth();
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.showLoginView();
        self.loaderApi.hide();
    });
    self.restClient.exec();
};
MainViewModel.prototype.logout = function () {
    var self = this;
    sessionStorage.removeItem(self.accessTokenKey);
    sessionStorage.removeItem(self.expiresInKey);
    sessionStorage.removeItem(self.loginNameKey);
    sessionStorage.removeItem(self.userFullNameKey);
    sessionStorage.removeItem(self.idPessoaKey);
    sessionStorage.removeItem(self.idOrganogramaKey);
    sessionStorage.removeItem(self.idPerfilKey);
    sessionStorage.removeItem(self.imagemPessoaKey);
    sessionStorage.removeItem(self.intervalFunctionIdKey);

    if (self.notificationsLoopId) {
        clearInterval(self.notificationsLoopId);
    }
    //location.reload();
    redirect('/');
};
MainViewModel.prototype.showMainView = function () {
    var self = this;

    self.pageLoginView.css('display', 'none');
    self.pageMainView.css('display', 'block');
    self.pageMainView.css('opacity', '1');
    /*self.pageMainView.css('opacity', '1');
    $('.formLoginContainer').animate({
        height: ["toggle", "swing"]
    }, {
        duration: 300, specialEasing: {
            width: "easeOutBounce", height: "easeOutBounce"
        }, complete: function () {

            self.pageLoginView.animate({height: [ "toggle", "swing" ]
            }, 300, function () {

            });
        }
    });*/
};
MainViewModel.prototype.showLoginView = function () {
    var self = this;

    self.pageMainView.css('display', 'none');
    self.pageMainView.css('opacity', '0');

    self.pageLoginView.css('opacity', '1');
    self.pageLoginView.css('display', 'block');

};
MainViewModel.prototype.redirectToZimbra = function () {
    var self = this;

    self.restClient.setDataToSender({});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'emails/redirect');
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (data) {
        var redirectURL = data['redirectURL'];
        self.lastEmailsContainer.find('a').each(function (a, b) {
            $(this).attr('href', redirectURL);
            $(this).attr('target', '_blank');
        });

    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        console.log('erro ao obter emails');
    });
    self.restClient.exec();

};
MainViewModel.prototype.getLastEmails = function () {
    var self = this;

    var html = '<li class="media">'
        + '<a href="#" class="media-heading btnRedirectEmail">'
        + '<div class="media-left">'
        //+ '<img src="/cdn/Vendor/limitless/material/images/placeholder.jpg" class="img-circle img-sm" alt="">'
        + '<span class="userThumbnail" style="background:rgb(52,40,113);"><i>IA</i></span>'
        + '</div>'
        + '<div class="media-body">'
        + '<span class="text-semibold remetenteNomeEmail" >Margo Baker</span>'
        + '<span class="media-annotation pull-right horaEmail">12:16</span>'
        + '<br><span class="text-muted assuntoEmail">That was something he was unable to do because...'
        + '</span>'
        + '<p class="text-muted text-right dataEmail "></p>'
        + '</div>'
        + '</a>'
        + '</li>';

    //faz uma requisição a API Rest para validar token
    self.restClient.setDataToSender({});
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'emails');
    self.restClient.setMethodPOST();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.redirectToZimbra();
        var emails = data['data'];
        self.lastEmailsContainer.empty();
        for (var i = 0; i < emails.length; i++) {
            var template = $(html);
            template.find('.assuntoEmail').text(emails[i]['assunto']);
            template.find('.horaEmail').text(emails[i]['hora']);
            template.find('.remetenteNomeEmail').text(emails[i]['de']);
            template.find('.userThumbnail i').text(emails[i]['iniciais']);
            template.find('.userThumbnail').css('background-color', stringToColour(emails[i]['de']));
            template.find('.dataEmail').text(emails[i]['data']);
            if (emails[i]['lido'] === false) {
                template.addClass('emailNotRead');
            }
            self.lastEmailsContainer.append(template);
        }
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        console.log('erro ao obter emails');
    });
    self.restClient.exec();

};
MainViewModel.prototype.saudacao = function () {
    var self = this;

    var mdata = new Date();
    var mhora = mdata.getHours();
    var mdia = mdata.getDate();
    var mdiasemana = mdata.getDay();
    var mmes = mdata.getMonth();
    var mano = mdata.getYear();

    if (mhora < 12) {
        return 'Bom dia,';
    }
    else if (mhora >= 12 && mhora < 18) {
        return 'Boa Tarde,';
    }
    else if (mhora >= 18 && mhora < 24) {
        return 'Boa Noite,';
    }
};
//faz um printScreen da pagina
MainViewModel.prototype.printScreen = function () {
    var self = this;
    //e.clipboardData ||
    //var clipboardData =  window.clipboardData;
    //var pastedData = clipboardData.getData('Text');
    //var data = ClipboardEvent.clipboardData;
    //console.log(data);

    html2canvas(document.body).then(function (canvas) {
        //document.body.appendChild(canvas);
        self.screenshotData = canvas.toDataURL("image/jpeg", 0.5);
        self.printScreenThumbnail.css({
            "background": "url('" + self.screenshotData + "')",
            "background-repeat": "no-repeat",
            "background-size": "260px "
        });
    });

};
//reporta um bug encontrado
MainViewModel.prototype.sendBugReport = function (e) {
    var self = this;
    // console.log(self.screenshotData);
    var dataToSend = {
        "sistema": self.inputNomeSistema.val(),
        "pagina": self.inputPaginaSistema.val(),
        "descricaoProblema": self.textareaDescricaoProblema.val(),
        "screenshot": self.screenshotData
    };
    //console.log(JSON.stringify(dataToSend));
    self.loaderApi.show();
    self.restClient.setDataToSender(dataToSend);
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'bugreport/');
    self.restClient.setMethodPUT();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        alert("Enviado com sucesso!");
        self.modalBugReport.modal('hide');
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
        self.loaderApi.hide();
    });
    self.restClient.exec();
};
//QUANDO UMA PAGINA TERMINAR DE CARREGAR NO IFRAME
MainViewModel.prototype.onPageLoaded = function (e) {
    var self = this;

    var rodape = '&copy; 2017 - 2018. Plataforma Jubarte desenvolvida pela Coordenadoria de Tecnologia de Informação - COTINF <a href="/pages/creditos"><span class="ml-20 label label-info"><i class="icon-info3 position-left"></i>Info</span></a> <span class="ml-20 label label-success"><i class="icon-trophy2"></i> COMODO SSL </span>';

    self.iframeShowPage.contents().find('.breadcrumb').empty().append(self.breadcrumb);
    self.iframeShowPage.contents().find('.footer').empty().append(rodape);

};

//FUNÇÔES GLOBAIS PUBLICAS
function getModal() {
    return mainViewVM.modalApi;
}

function getPrincipalVM() {
    return mainViewVM;
}

function getMainNavbar() {
    return $('#navbar-mobile');
}


