var Pedido = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='pedido';
        this.breadcrumb='Pedidos';
        this.descripcion="Desde aqui administre los Pedidos"
    },
    onUpdated: function(data){
            this.parent();
            translator.show(this.type);
    },
	 afterDataTable:function() {
		self = this;
	    this.parent();

		jQuery('.confirm').bind("click", function(e) {
			translator.confirmarPedido(self.type,self.getSelectedRowId(this));
			return false;
		})

	 },

     bindAddEvents:function() {
		this.parent();
		var self=this;

		//TODO ver de sacar
      	jQuery('.save').bind("click", function(e) {
            translator.save("pedido", self.getForm());
      	    //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
      	    return false;
        });


  	}
});

pedidoRender=new Pedido();