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