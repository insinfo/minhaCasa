$(function () {
    var intranetViewModel = new IntranetViewModel();
    intranetViewModel.init();
});

function IntranetViewModel() {

    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;
    this.webservicePmroBaseURL = WEBSERVICE_PMRO_BASE_URL;
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = window.location !== window.parent.location ? window.parent.getModal() : new ModalAPI();

    //estatisticas usuarios
    this.sistemasAtivos = $('#sistemas_ativos');
    this.usuariosOnline = $('#usuarios_online');
    this.usuariosAtivos = $('#usuarios_ativos');
    this.usuariosCadastrados = $('#usuarios_cadastrados');

    this.solicitacoesAbertas = $('#solicitacoes_abertas');
    this.solicitacoesAndamento = $('#solicitacoes_andamento');
    this.solicitacoesConcluidas = $('#solicitacoes_concluidas');
    this.solicitacoesTotal = $('#solicitacoes_total');

    this.dataNiver = $('#data_niver');
    this.listaNiver = $('#lista_niver li a');
}
IntranetViewModel.prototype.init = function () {
    var self = this;
    self.eventos();
    self.initPlugins();


    //
    self.dataNiver.text(moment().format('DD/MM'));
    //preencher box dos aniversarios
    self.listaAniversariantes();

    self.getEstatisticasJubarte();
    self.getEstatisticasCiente();
    self.getWeatherToday();
    self.getBlogNoticias();
    self.getUserLoggedCount();
    setInterval(function(){ self.getUserLoggedCount(); }, 120000);
};
IntranetViewModel.prototype.initPlugins = function () {
    var self = this;
    // PERFECT-SCROLLBAR
    /*new PerfectScrollbar($(".containerInsideIframe")[0], {
        wheelPropagation: true
    });
    new PerfectScrollbar($('.noticiasBITHomeIn')[0], {
        wheelPropagation: true
    });*/
    /*new PerfectScrollbar( $('.aniversariantesHomeOntem')[0], {
        wheelPropagation: true
    });*/
    // noticias do BIT
    /* new PerfectScrollbar( $('.noticiasBITHomeIn')[0], {
         wheelPropagation: true
     });*/
};
IntranetViewModel.prototype.eventos = function () {
    var self = this;

    self.listaNiver.on('click', function (e) {
        if ($(this).attr('href') === "#aniversariantesOntem") {
            self.dataNiver.text(moment().subtract(1, 'days').format('DD/MM'));
        }
        if ($(this).attr('href') === "#aniversariantesHoje") {
            self.dataNiver.text(moment().format('DD/MM'));
        }
        if ($(this).attr('href') === "#aniversariantesAmanha") {
            self.dataNiver.text(moment().add(1, 'days').format('DD/MM'));
        }
    });

};
IntranetViewModel.prototype.getEstatisticasJubarte = function () {
    var self = this;
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'estatisticas/intranet/usuarios');
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.sistemasAtivos.text(data['sistemas_ativos']);
        self.usuariosAtivos.text(data['usuarios_ativos']);
        self.usuariosCadastrados.text(data['cadastros_ativos']);
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
    });
    self.restClient.exec();
};
IntranetViewModel.prototype.getEstatisticasCiente = function () {
    var self = this;

    self.loaderApi.show();
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'estatisticas/intranet/solicitacoes');
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.loaderApi.hide();
        self.solicitacoesAbertas.text(data['solicitacoesAbertas']);
        self.solicitacoesConcluidas.text(data['solicitacoesConcluidas']);
        self.solicitacoesAndamento.text(data['solicitacoesAndamento']);
        self.solicitacoesTotal.text(data['solicitacoesTotal']);
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {

        self.loaderApi.hide();
    });
    self.restClient.exec();
};
IntranetViewModel.prototype.listaAniversariantes = function () {
    var self = this;
    var template = $('#aniversariante');
    var content = template.find('li')[0] ? template.find('li') : $(template[0].content);
    var nome = content.find('.nome');
    var foto = content.find('.foto');
    var local = content.find('.local');
    var data_atual = moment().format('YYYYMMDD');

    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'intranet/aniversariantes');
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (dados) {

        $("#aniversariantesHoje ul").empty();
        $("#aniversariantesOntem ul").empty();
        $("#aniversariantesAmanha ul").empty();

        $.each(dados['data'], function (idx, item) {

            nome.text(item['nome']);
            foto.attr("src", item['image']);
            local.text(item['siglaLocalTrabalho']);

            if (item['aniversario'] < data_atual) {
                //console.log('ontem: '+ item['aniversario']);
                $("#aniversariantesOntem ul").append(template.html());
            }

            if (item['aniversario'] == data_atual) {
                //console.log('hoje: '+ item['niver']);
                $("#aniversariantesHoje ul").append(template.html());
            }

            if (item['aniversario'] > data_atual) {
                //console.log('amanha: '+ item['niver']);
                $("#aniversariantesAmanha ul").append(template.html());
            }

        });
    });
    self.restClient.exec();

};
//Obtem a previsão de tempo hoje
IntranetViewModel.prototype.getWeatherToday = function (){
    var self = this;
    $.getJSON('//api.wunderground.com/api/9f70a8fd69a1dfec/conditions/q/BR/Rio_das_Ostras.json', '', function (data) {
        //console.log(data);
        var current_observation = data['current_observation'];
        var display_location = current_observation['display_location'];
        var city = display_location['city'];
        var temperatura = current_observation['temp_c'];
        var icone = current_observation['icon_url'];
        $('#iconeTempo').attr('src', icone.replace("http://", "https://"));
        $('#temperatura').text(temperatura + 'º');
        $('#nomeCidade').text(city);
    });
};
//obtem as noticias do blog Bit
IntranetViewModel.prototype.getBlogNoticias = function (){
    var self = this;

    var template = $("#templateFeed").html();
    var container = $("#bit-feed");
    container.empty();

    $.get('/bit/index.php/feed/', function (data) {
        var $xml = $(data);
        $xml.find("item").each(function () {
            var $this = $(this),
                item = {
                    title: $this.find("title").text(),
                    link: $this.find("link").text(),
                    description: $this.find("description").text(),
                    pubDate: $this.find("pubDate").text(),
                    author: $this.find("author").text(),
                    encoded: $this.find("content\\:encoded").text()
                };

            $this.find("category").each(function (j) {
                item['category'] = $(this).text();
            });

            var regex = /<img.*?src="(.*?)"/;
            var src = regex.exec(item.encoded);
            var image = src ? src[1] : "/cdn/Vendor/limitless/material/images/newsThumb.jpg";
            image = image.replace("http://bit.riodasostras.rj.gov.br/", "/bit/");
            image = image.replace("http://", "https://");

            //console.log(stripHtmlTags(item.description).substring(0, 100));
            var temp = $(template);
            temp.find('.rssDescription').text(stripHtmlTags(item.description).substring(0, 100) + '...');
            //temp.find('.rssDescription').text();
            temp.find('.rssDate').text(moment(item.pubDate).format("DD/MM/YYYY"));
            temp.find('.rssCategory').text(item.category);

            temp.find('.rssLink').attr('href', item.link);
            temp.find('.rssTitle').text(item.title);
            temp.find('.rssImage').attr('src', image);
            temp.find('.rssImage').attr('alt', item.title);
            container.append(temp);
        });
    });
};
//obtem o total de usuarios logados
IntranetViewModel.prototype.getUserLoggedCount = function () {
    var self = this;
    self.restClient.setWebServiceURL(self.webserviceJubarteBaseURL + 'usuarios/count/logged');
    self.restClient.setMethodGET();
    self.restClient.setSuccessCallbackFunction(function (data) {
        self.usuariosOnline.text(data['usuariosOnline']);
    });
    self.restClient.setErrorCallbackFunction(function (jqXHR, textStatus, errorThrown) {
    });
    self.restClient.exec();
};