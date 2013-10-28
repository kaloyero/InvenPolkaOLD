var Pedido = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
		this.type = 'pedido';
    },
     bindAddEvents:function() {
		this.parent();
		var self=this;
 		var contenedor        		= jQuery('#contenedor'); //ID del contenedor
		var AddArticuloBtn			= jQuery('#agregarArticulo');
		var ArtCantidad       		= jQuery('#ArtCantidad'); //Articulo cantidad
		var ArtArticulo       		= jQuery('#ArtArticulo option:selected'); //Articulo seleccionado
		var x = jQuery('#contenedor div').length ;		//var x = número de campos existentes en el contenedor
		var FieldCount = x-1; //para el seguimiento de los campos

		//TODO ver de sacar
      	jQuery('.save').bind("click", function(e) {
            translator.save("pedido", self.getForm());
      	    //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
      	    return false;
        });

		//Agregar articulos en la tabla
		AddArticuloBtn.bind("click", function(e) {
			FieldCount++;
			//agregar campo
			contenedor.append('' +
				' <div>' +
				'	Articulo: <input name="nomArticulo" type="text" value="' + ArtArticulo.text() + '" readonly="readonly" />' +
				'	Cantidad: <input name="data[Detalle]['+FieldCount+'][Cantidad]" type="text" value="' + ArtCantidad.val() + '" readonly="readonly" />' +
				'  <input name="data[Detalle]['+FieldCount+'][IdArticulo]" type="hidden" value="' + ArtArticulo.val() + '" readonly="readonly" />' +
				'<a href="#" class="eliminar">&times;</a>' +
			'</div>');
				x++;
        });

  	}
});

pedidoRender=new Pedido();