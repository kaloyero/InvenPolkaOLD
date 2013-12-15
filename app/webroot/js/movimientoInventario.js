var MovimientoInventario = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='movimientoInventario';
        this.breadcrumb='movimientoInventarios';
        this.descripcion="Desde aqui administre los Movimientos"
    },

     onSaved:function() {
         this.parent();
          translator.show("articulo");
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

          jQuery('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });

        },
     bindAddEvents:function() {
         this.parent();
         jQuery('.desactiva').bind("click", function(e) {
             //Solo se borra si la lista tiene mas de 1 elemento para que no quede vacia
             if (jQuery(".desactiva").length >1) {
                 jQuery(this).parent().parent().remove();
             }else{
                 jQuery.jGrowl("No puede quedar el listado vacio", {
    				theme : 'error'
             })
         }
   	})
   	//Se setea la fecha del dia,en este caso,solo se va a setear en la pantalla de despacho,porque busca un id,que solo tiene la view de despacho
   	jQuery('#fechaDespacho').datepicker( "setDate", new Date());

    }

});

movimientoInventarioRender=new MovimientoInventario();