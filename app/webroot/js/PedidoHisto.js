var PedidoHisto = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='pedidoHisto';
        this.breadcrumb='Pedidos Historico';
        this.descripcion="Historico de pedido"
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
        jQuery('.agregarOtro').bind("click", function(e) {
             articuloRender.setContext("pedidos");
             translator.show('articulo');
     		return false;
     	})
     	jQuery('.desactiva').bind("click", function(e) {
     	    var rowIndex=jQuery(this).index();
     	    var idArticuloToRemove=jQuery(this).parent().parent().attr("id");
     	    //remuevo el articulo del array de articulos seleccionados
     	    delete articuloRender.currentSelectedArticulos[idArticuloToRemove];
            //Remuevo la fila del datatable
     	    self.oTable.fnDeleteRow(rowIndex);
     	});

     	jQuery('input[type=number]').bind("change", function(e) {
            articuloRender.currentSelectedArticulos[self.getIdFromSelectedNumberType(this)]=jQuery(this).val();
     	})

     },
     getIdFromSelectedNumberType: function(selectedNumberType){
            return jQuery(selectedNumberType).parent().parent().find(":first" ).find("input").val()
        },

    onUpdated: function(data){
            this.parent();
            translator.show(this.type);
    },
    onView: function(data){
        this.parent(data);
        jQuery('.confirm').bind("click", function(e) {
			alert("CON")
			return false;
		})
    },
	 afterDataTable:function() {
		self = this;
	    this.parent();

		jQuery('.confirm').bind("click", function(e) {
			translator.confirmarPedido(self.type,self.getSelectedRowId(this));
			return false;
		})
		jQuery('.asignarAProyecto').bind("click", function(e) {
			translator.addMovimiento("movimientoInventario",null,"asignacionAProyectos/"+self.getSelectedRowId(this));
			return false;
		})

        this.setQuantitiesonSelectedElementes();
	 },

    makeAddTable: function(data){
        var self=this;
//		jQuery('#listaArticulos').dataTable();
          this.oTable=   jQuery('#listaArticulos').dataTable({
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
                                  "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                                      //jQuery(nRow).append( "<td class='tdMiddleCells'>second</td>" );
                                  },
                                  "fnPreDrawCallback": function( nRow, aData, iDisplayIndex ) {
                                      console.log("s",arguments)
                                  },
                                  //Este CallBack se ejecuta cuando esta lista la tabla
                                  "fnDrawCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                                      self.afterDataTable();
                                  }
                       });

    },
    setQuantitiesonSelectedElementes:function(){
        for (var id in articuloRender.currentSelectedArticulos){
            if ( articuloRender.currentSelectedArticulos[id] != 0 ){
                        if (jQuery("#"+id).length >0){
                            jQuery("#"+id).find('input[type=number]').val(articuloRender.currentSelectedArticulos[id])
                        }
                }
            }
     }
});

pedidoHistoRender=new PedidoHisto();