var Pedido = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='pedido';
        this.breadcrumb='Pedidos';
        this.descripcion="Desde aqui administre los Pedidos"
    },
     onSaved:function() {
         this.parent();
          translator.show("articulo");
     },
      onSavedConfirmado:function() {
          //Esto actualiza la tabla
          jQuery('.paginate_active').click();
      },

    onAdd: function(data){
        this.cleanCanvas();
        jQuery(".contentinner").append(data);
        this.bindAddEvents();
		//this.makeAddTable();
		//this.drawHeader();
    },
     bindAddEvents:function() {
        var self=this;
        this.parent();
        jQuery('.agregarOtro').bind("click", function(e) {
             articuloRender.setContext("pedidos");
             self.saveTableStatus();
             translator.show('articulo');
     		return false;
     	})
     	jQuery('.desactiva').bind("click", function(e) {
     	       if (jQuery(".desactiva").length >1) {
                      var idArticuloToRemove=self.getSelectedRow(this).attr("id");
                 	    //remuevo el articulo del array de articulos seleccionados
                 	    delete articuloRender.currentSelectedArticulos[idArticuloToRemove];
                        //Remuevo la fila del datatable
                 	    self.oTable.fnDeleteRow(self.getSelectedRow(this)[0]);
                 }else{
                     jQuery.jGrowl("No puede quedar el listado vacio", {
        				theme : 'error'
                 })
             }

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
			return false;
		})
    },
	 afterDataTable:function() {
		self = this;
	    this.parent();
		jQuery('.confirm').bind("click", function(e) {
		    if (confirm("Desea confirmar el pedido?"))
            {
                translator.confirmarPedido(self.type,self.getSelectedRowId(this));

            }
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
						   "bFilter": false,
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
     },
     getSelectedRow:function(column){
         return jQuery(column).parent().parent();
     }
});

pedidoRender=new Pedido();