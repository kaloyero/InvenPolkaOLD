var MovimientoInventario = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='movimientoInventario';
        this.breadcrumb='movimientoInventarios';
        this.descripcion="Desde aqui administre los Movimientos"
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
          jQuery('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });

          jQuery('.save').bind("click", function(e) {
              translator.save(self.type, self.getForm());
              self.addLoader();
              return false;
         });

         jQuery('.desactiva').bind("click", function(e) {
             jQuery(this).parent().parent().remove();
         })

   	}

});

movimientoInventarioRender=new MovimientoInventario();