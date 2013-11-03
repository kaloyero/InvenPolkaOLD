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
		jQuery('.edit').bind("click", function(e) {
			console.log("ESESES",self.getSelectedRowId(this))
			translator.view(self.type,self.getSelectedRowId(this));
	
			return false;
			//translator.view(self.type);
		})
		jQuery('.confirm').bind("click", function(e) {
			console.log("ESESES",self.getSelectedRowId(this))
			translator.confirmarPedido(self.type,self.getSelectedRowId(this));
			return false;
			//translator.view(self.type);
		})

		
		//Ocultamos la columna ID
		jQuery("#configurationTable td:first-child").css('display','none');
		
		//Si la tabla es de configuraciones,hacerla editable
		if (self.isConfigurationTable())
			self.hacerTablaEditable();
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