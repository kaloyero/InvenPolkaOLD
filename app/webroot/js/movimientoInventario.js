var MovimientoInventario = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='movimientoInventario';
        this.breadcrumb='movimientoInventarios';
        this.descripcion="Desde aqui administre los Movimientos"
    },
    onAdd: function(data){
		  this.parent();
//          this.makeAddTable();	  
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
	 afterAddDataTable:function() {
			//ACA ES EL AFTER DATA TABKE

	 },
    bindListEvents:function() {
          var self=this;
		  this.parent();
          jQuery('.devolucion').bind("click", function(e) {
				translator.addMovimiento("movimientoInventario",null,"devolucionDeArticulos");
               	return false;
          })
          jQuery('.asignacion').bind("click", function(e) {
				translator.addMovimiento("movimientoInventario",null,"asignacionAProyectos/".self.getSelectedRowId(this));
               	return false;
          })
		  
        },
     bindAddEvents:function() {
        var self=this;
          this.styleForm();
          this.generateValidation();

          jQuery('.save').bind("click", function(e) {
              //Si pasa la validacion,salvamos
			  
//              if (self.getForm().valid()){

                   translator.save(self.type, self.getForm());
                   self.addLoader();
//              }
              //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
              return false;
         });

   	}
	
});

movimientoInventarioRender=new MovimientoInventario();