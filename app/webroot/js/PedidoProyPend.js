var PedidoProyPend = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='pedidoProyPend';
        this.breadcrumb='Pedidos Pendientes';
        this.descripcion="Pedidos Pendientes por Proyecto"
    },
    onAdd: function(data){
        this.cleanCanvas();
        jQuery(".contentinner").append(data);
        this.bindAddEvents();
		this.makeAddTable();
		this.drawHeader();
    },
     bindAddEvents:function() {
        var self=this;
        this.parent();

     	jQuery('input[type=number]').bind("change", function(e) {
            articuloRender.currentSelectedArticulos[self.getIdFromSelectedNumberType(this)]=jQuery(this).val();
     	})
     },
     bindEditEvents:function() {
        var self=this;
        this.parent();

     	jQuery('input[type=number]').bind("change", function(e) {
            articuloRender.currentSelectedArticulos[self.getIdFromSelectedNumberType(this)]=jQuery(this).val();
     	})

     },
	 afterDataTable:function() {
		self = this;
	    this.parent();

		jQuery('.devolucionArtPorProy').bind("click", function(e) {
			translator.addMovimiento("movimientoInventario",null,"devolucionArtPorPedido/"+self.getSelectedRowId(this));
			return false;
		})
	 },
     getIdFromSelectedNumberType: function(selectedNumberType){
            return jQuery(selectedNumberType).parent().parent().find(":first" ).find("input").val()
        },

    onView: function(data){
        this.parent(data);
        jQuery('.confirm').bind("click", function(e) {
			return false;
		})
    },


});

pedidoProyPendRender=new PedidoProyPend();