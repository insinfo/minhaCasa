// Constantes de tipos
ExtencaoAPI.SELECT = 'select';
ExtencaoAPI.TREEVIEW = 'treeview';
ExtencaoAPI.DATATABLES = 'datatables';

function ExtencaoAPI(extencao, sistema, callbackSucesso) {
    // Parametros do BD
    this.tipoExibicao = null;
    this.rotaExibicao = null;
    this.metodoExibicao = null;
    this.rotaLeitura = null;
    this.metodoLeitura = null;
    this.rotaGravacao = null;
    this.metodoGravacao = null;
    // Parametros configurados na execucao
    this.id = null;
    this.defaultModal = null;
    // Parametros de visualização
    this.rotulo = null;        // label exibido no formulario
    this.chave = null;         // chave/parametro que será gravado pela rota de gravacao
    this.valor = null;         // campo/parametro exibido para ser selecionado
    // Objetos de renderização
    this.dadosExibicao = [];
    this.dadosLeitura = [];
    this.treeView = null;
    // Metodo(s) de auxílio
    this.gerarId = function makeid() {
        var text = "ext_";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i < 10; i++) text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    };
    // Initialize
    this.init(extencao, sistema, callbackSucesso);
}

ExtencaoAPI.prototype.init = function (extencao, sistema, callbackSucesso) {
    var self = this;
    self.id = self.gerarId();
    self.accessDatabase('/api/sistemas/extencoes', 'post', {"idSistema":sistema,"destinos":[extencao]}, function (response) {
        if (response['data'].length > 0) {
            var data = response['data'][0];
            self.tipoExibicao = data['tipoExibicao'];
            self.rotaExibicao = data['rotaExibicao'];
            self.metodoExibicao = data['metodoExibicao'];
            self.rotaLeitura = data['rotaLeitura'];
            self.metodoLeitura = data['metodoLeitura'];
            self.rotaGravacao = data['rotaGravacao'];
            self.metodoGravacao = data['metodoGravacao'];
        } else $('[data-ref="'+ self.id +'"]').remove();
        if (callbackSucesso) callbackSucesso();
    });
};
ExtencaoAPI.prototype.events = function () {
    var self = this;
    var instancia = window.location != window.parent.location ? window.parent.document : window.document;
    $('body').on('click','#'+self.id, function () {
        if (self.defaultModal) {
            switch (self.tipoExibicao) {
                case ExtencaoAPI.TREEVIEW:
                    self.prepareTreeviewModal();
                    self.defaultModal.modal('show');
                    break;
                case ExtencaoAPI.DATATABLES:
                    break;
            }
        }
    });
    $('body', instancia).on('click','#'+self.id+'-button', function () {
        var objeto = $('#'+self.id);
        // Carrega IDs
        self.dadosLeitura = self.treeView.getChecked(ModernTreeView.ID);
        objeto.attr('data-ids', self.dadosLeitura);
        // Carrega labels
        var lista = self.treeView.getChecked(ModernTreeView.LABEL);
        var label = '';
        for (var idx in lista) {
            if (idx < 3) {
                var obj = lista[idx];
                if (label!=='') label += ', ';
                label += obj.substring( obj.indexOf('-')+1 ).trim();
            }
        }
        label += lista.length<=3 ? '' : ' e outro(s)...';
        objeto.val(label);
    });
};
// CRUD
ExtencaoAPI.prototype.accessDatabase = function (url, method, params, callbackSucesso) {
    var rest = new RESTClient();
    rest.setMethod(method);
    rest.setWebServiceURL(url);
    rest.setDataToSender(params);
    rest.setSuccessCallbackFunction(callbackSucesso);
    rest.setErrorCallbackFunction(function (callback) {
        console.log(callback['responseJSON']);
    });
    rest.exec();
};
ExtencaoAPI.prototype.loadData = function (paramExibicao, paramLeitura, modal) {
    this.defaultModal = modal;
    var self = this;
    var objeto = $('#'+self.id);

    if(!objeto[0])
    {
        return;
    }

    // Carrega dados de exibição
   self.accessDatabase(self.rotaExibicao, self.metodoExibicao, paramExibicao, function (exibicao) {
        self.dadosExibicao = exibicao;
        // Carrega dados de leitura
        self.accessDatabase(self.rotaLeitura, self.metodoLeitura, paramLeitura, function (leitura) {
            self.dadosLeitura = leitura['data'];
            switch (self.tipoExibicao) {
                case ExtencaoAPI.SELECT:
                    populateSelect(objeto, self.dadosExibicao, self.chave, self.valor, null, null);
                    objeto.selectpicker('refresh');
                    break;
                case ExtencaoAPI.TREEVIEW:
                    self.prepareTreeviewModal();
                    // Carrega labels
                    var lista = self.treeView.getChecked(ModernTreeView.LABEL);
                    var label = '';
                    for (var idx in lista) {
                        if (idx < 3) {
                            var obj = lista[idx];
                            if (label!=='') label += ', ';
                            label += obj.substring( obj.indexOf('-')+1 ).trim();
                        }
                    }
                    label += lista.length<=3 ? '' : ' e outro(s)...';
                    objeto.val(label);
                    objeto.attr('data-ids', self.dadosLeitura);
                    self.events();
                    break;
                default:
                    self.events();
                    break;
            }
        });
    });
};
ExtencaoAPI.prototype.saveData = function(paramGravacao) {
    var self = this;
    var objeto = $('#'+self.id);

    if(!objeto[0])
    {
        return;
    }

    self.accessDatabase(self.rotaGravacao, self.metodoGravacao, paramGravacao, function(response){
        console.log(response);
    });
};
ExtencaoAPI.prototype.remove = function (paramDelete) {

};
// Exhibition
ExtencaoAPI.prototype.clear = function () {
    $('[data-ref="'+ this.id +'"]').remove();
};
ExtencaoAPI.prototype.getSelected = function() {
    var self = this;
    var objeto = $('#'+self.id);
    switch (this.tipoExibicao) {
        case ExtencaoAPI.SELECT:
            return objeto.val();
            break;
        case ExtencaoAPI.TREEVIEW:
            return objeto.attr('data-ids').split(',');
            break;
        case ExtencaoAPI.DATATABLES:

            break;
    }
};
ExtencaoAPI.prototype.prepareTreeviewModal = function () {
    var self = this;
    self.defaultModal.find('.modal-body').empty();
    self.defaultModal.find('.modal-footer').remove();
    self.defaultModal.find('.modal-body').append('<div id="mtvExtencao" class="mtvContainer"></div>');
    self.defaultModal.find('.modal-content').append('<div class="modal-footer"><button id="'+ self.id +'-button" class="btn bg-primary legitRipple" data-dismiss="modal">Concluir</button></div>');
    self.renderTreeview();
};
ExtencaoAPI.prototype.render = function (rotulo, chave, valor) {
    var self = this;
    self.rotulo = rotulo;
    self.chave = chave;
    self.valor = valor;
    switch (self.tipoExibicao) {
        case ExtencaoAPI.SELECT:
            self.selectLayout().insertBefore('#grupoAtivo');
            var objeto = $('#'+self.id);
            objeto.selectpicker();
            break;
        default:
            self.inputLayout().insertBefore('#grupoAtivo');
            break;
    }
};
ExtencaoAPI.prototype.renderTreeview = function () {
    var self = this;
    self.treeView = new ModernTreeView(self.defaultModal.find('#mtvExtencao'));
    self.treeView.setupDisplayItems([
        {'key':'idSetor', 'type':ModernTreeView.ID},
        {'key':'text', 'type':ModernTreeView.LABEL}
    ]);
    self.treeView.parseFields();
    self.treeView.setExplorerStyle();
    self.treeView.showCheck();
    self.treeView.dataLoaded = JSON.parse(JSON.stringify(self.dadosExibicao));
    self.treeView.setDataParam(ModernTreeView.CHECKED, true, self.dadosLeitura);
    self.treeView.draw();
};
// Code insert for HTML element
ExtencaoAPI.prototype.inputLayout = function () {
    var html =  '<div class="form-group extencao" data-ref="'+ this.id +'">' +
                    '<label class="control-label control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-1">'+ this.rotulo +' <span class="text-danger">*</span></label>' +
                    '<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xl-11">' +
                        '<input id="'+ this.id +'" type="text" class="form-control cursor-pointer" placeholder="Clique para selecionar" readonly required >' +
                    '</div>' +
                '</div>';
    return $(html);
};
ExtencaoAPI.prototype.selectLayout = function () {
    var html =  '<div class="form-group extencao" data-ref="'+ this.id +'">' +
                    '<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-1">'+ this.rotulo +' <span class="text-danger">*</span></label>' +
                    '<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xl-11">' +
                        '<select id="'+ this.id +'" class="form-control" title="Selecione" required ><option value=""/></select>' +
                    '</div>' +
                '</div>';
    return $(html);
};