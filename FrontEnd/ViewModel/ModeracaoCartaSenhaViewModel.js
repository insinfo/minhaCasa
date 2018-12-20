$(function () {
    var moderacaoCartaSenhaViewModel = new ModeracaoCartaSenhaViewModel();
    moderacaoCartaSenhaViewModel.init();
});
function ModeracaoCartaSenhaViewModel() {

    this.webserviceJubarteBaseURL = WEBSERVICE_JUBARTE_BASE_URL;
    this.webservicePmroBaseURL = WEBSERVICE_PMRO_BASE_URL;
    this.restClient = new RESTClient();
    this.loaderApi = new LoaderAPI();
    this.modalApi = window.location !== window.parent.location ? window.parent.getModal() : new ModalAPI();

    //this.dataTableCEPCorreios = new ModernDataTable('tableListCEPCorreios');
    this.gridContainer = $('#gridContainer');
    this.templateCardCartaSenha = $('#templateCardCartaSenha');
    this.selectFiltroOrder = $('#selectFiltroOrder');
    this.inputSearch = $('#inputSearch');
    this.btnReload = $('#btnReload');
    this.btnBuscar = $('#btnBuscar');
    this.datagridSoliCartasSenha = new ModernDataGrid('gridContainer', 'templateCardCartaSenha');
}
ModeracaoCartaSenhaViewModel.prototype.init = function () {
    var self = this;
    self.initPlugins();
    self.events();
    self.getSolicitacoesCartaSenha();
};
ModeracaoCartaSenhaViewModel.prototype.initPlugins = function () {
    var self = this;
    $('select').selectpicker();
};
ModeracaoCartaSenhaViewModel.prototype.events = function () {
    var self = this;
    self.btnReload.click(function (e) {
        self.selectFiltroOrder.val('asc');
        self.inputSearch.val('');
        self.reloadSoliCartaSenha(true);
    });
    self.selectFiltroOrder.change(function (e) {
        self.reloadSoliCartaSenha();
    });
    self.inputSearch.keypress(function (e) {
        if (e.which === 13) {
            self.reloadSoliCartaSenha();
        }
    });
    self.btnBuscar.click(function (e) {
        self.reloadSoliCartaSenha();
    });
};
ModeracaoCartaSenhaViewModel.prototype.reloadSoliCartaSenha = function (reset) {
    var self = this;
    self.loaderApi.show();

    var dataToSender = {
        'ordering': [{direction: self.selectFiltroOrder.val(), columnKey: "id"}],
        'search': self.inputSearch.val()
    };
    if(reset){
        dataToSender = {};
    }

    self.datagridSoliCartasSenha.setDataToSend(dataToSender);
    self.datagridSoliCartasSenha.load();
};
ModeracaoCartaSenhaViewModel.prototype.getSolicitacoesCartaSenha = function () {
    var self = this;
    self.loaderApi.show();
    self.datagridSoliCartasSenha.setDatakey('id');
    self.datagridSoliCartasSenha.setupDisplayItems([
        {"key": 'tipoConta', "target": 'tipoDeConta', "tag": 'SPAN'},
        {"key": 'nomeSolicitante', "target": 'nomeSolicitante', "tag": 'SPAN'},
        {"key": 'organogramaSigla', "target": 'organogramaSigla', "tag": 'SPAN'},
        {"key": 'telefoneSetor', "target": 'telefoneSetor', "tag": 'SPAN'},
        {"key": 'dataSolicitacao', "target": 'dataSolicitacao', "tag": 'SPAN', "type": ModernDataGrid.SHORTDATETIME}
    ]);
    self.datagridSoliCartasSenha.setItemsPerPage(12);
    // Divisor SETUP
    // self.datagridAtendimento.setDivisor( 'divisor', self.paramDivisor() );
    // Pagination SETUP
    self.datagridSoliCartasSenha.setButtonsQuantity(5);
    self.datagridSoliCartasSenha.setPaginationStyleCaroulsel();
    // Ajax SETUP
    self.datagridSoliCartasSenha.setWebServiceURL(self.webserviceJubarteBaseURL + 'cartasenha');
    self.datagridSoliCartasSenha.setMethodPOST();
    self.datagridSoliCartasSenha.setDataToSend({});
    self.datagridSoliCartasSenha.setOnLoadSuccessCallback(function (d) {
        self.loaderApi.hide();
    });
    self.datagridSoliCartasSenha.setOnLoadErrorCallback(function (callback) {
        self.modalApi.showModal(ModalAPI.ERROR, "Erro", callback['responseJSON'], "OK");
    });
    self.datagridSoliCartasSenha.setOnPageChangeCallback(function (pageNumber) {
    });
    self.datagridSoliCartasSenha.load();
};