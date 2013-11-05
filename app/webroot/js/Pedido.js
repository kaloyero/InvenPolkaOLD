var Pedido = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='pedido';
        this.breadcrumb='Pedidos';
        this.descripcion="Desde aqui administre los Pedidos"
    },
    onAdd: function(data){
        this.cleanCanvas();
        jQuery(".contentinner").append(data);
        this.bindAddEvents();
		this.makeAddTable();

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


  	},
	
    makeAddTable: function(data){
//		jQuery('#listaArticulos').dataTable();
            var oTable=   jQuery('#listaArticulos').dataTable({
                           "bPaginate": true,
                           "sPaginationType": "full_numbers",
                           "oLanguage": {
                                    "sSearch": "Busqueda:",
                                    "sInfo": "Mostrando _START_ hasta _END_ de un total de  _TOTAL_ registros",
                                    "sInfoFiltered": " - (Filtrando de un maximo de _MAX_ registros)",
                                    "oPaginate": {
                                            "sNext": "Proxima",
                                            "sFirst": "Primera",
                                            "sLast": "Ultima",
                                            "sPrevious": "Previo"

                                          }
                                  },
                                  "fnPreDrawCallback": function( nRow, aData, iDisplayIndex ) {
                                      console.log("s",arguments)
                                  },
                            //Este CallBack se ejecuta cuando esta lista la tabla
                           "fnDrawCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {

                           }
                       });
		
    },
	
});

pedidoRender=new Pedido();