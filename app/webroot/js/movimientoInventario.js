var MovimientoInventario = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='movimientoInventario';
        this.breadcrumb='Movimientos Inventario';
        this.descripcion="Desde aqui administre los Movimientos"
    },

     onSaved:function() {
         this.parent();
         if (this.currentStatus=="pedidoSalida"){
             translator.show("pedidoSalida");

         }else{
             translator.show("articulo");

         }
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
         //En caso de que use el volver,a este Render,le asignamos la tabla de articulos,ya que este no usa ningun listado para volver
         //this.oTable=articuloRender.oTable;
         this.parent();
         var self=this;
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

    jQuery('.asignar').bind("click", function(e) {
         //Si pasa la validacion,salvamos
         if (self.getForm().valid()){
              translator.save(self.type, self.getForm());
              self.currentStatus="pedidoSalida";
              var numeroPedido=jQuery('.pedido').val();
              var cantidadFilas=Math.ceil((jQuery("#listaArticulos").find("tr").length -1)/2);
              jQuery.post("movimientoInventarios/reciboPdf/"+numeroPedido,function(){


                  //for (var i=0;i<cantidadFilas;i++)
                 // {
                       window.open("app/webroot/Recibo"+numeroPedido+".pdf", '_blank')
                 // }
                  //window.open("app/webroot/Recibo"+numeroPedido+"-1.pdf", '_blank')


                   //jQuery.fileDownload("app/webroot/Recibo"+numeroPedido+".pdf")
                        //.done(function () { alert('File download a success!'); })
                        //.fail(function () { alert('File download failed!'); });
              })


               self.addLoader();
         }
         //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
         return false;
    });

    }

});

movimientoInventarioRender=new MovimientoInventario();