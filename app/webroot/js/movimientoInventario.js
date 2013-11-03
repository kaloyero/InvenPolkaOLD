var MovimientoInventario = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='movimientoInventario';
        this.breadcrumb='movimientoInventarios';
        this.descripcion="Desde aqui administre los Movimientos"
    },
     bindAddEvents:function() {
        var self=this;
		//AGREGAR ITEMS A LISTA DE ARTICULOS
 		var contenedor        		= jQuery('#contenedor'); //ID del contenedor
		var AddArticuloBtn			= jQuery('#agregarArticulo');
		var ArtCantidad       		= jQuery('#ArtCantidad'); //Articulo cantidad
		var ArtArticulo       		= jQuery('#ArtArticulo option:selected'); //Articulo seleccionado
//		var ArtUbicacionOrig        = jQuery('#ArtUbicacionOrig option:selected'); //Articulo seleccionado
//		var ArtUbicacionDest        = jQuery('#ArtUbicacionDest option:selected'); //Articulo seleccionado
		var x = jQuery('#contenedor div').length ;		//var x = número de campos existentes en el contenedor 
		var FieldCount = x-1; //para el seguimiento de los campos
		//Combo TIPO DE MOVIMIENTO
		var tipoMovimientoCmb		= jQuery('#comboInventario');
		//Combo DEPOSITO
		var depositoCmb		= jQuery('#depositoOriginal');

		
      	jQuery('.save').bind("click", function(e) {
            translator.save("movimientoInventario", self.getForm());
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

		//Combo tipo de movimiento
		tipoMovimientoCmb.bind("change", function(e) {
			var tipoSeleccionado = jQuery('#comboInventario option:selected').val();	
			var divProyecto = jQuery('#divProyecto');
			var divDepositoDest = jQuery('#divDepositoDest');
//			var divUbicacionDest = jQuery('#divUbicacionDest');	
		
			divProyecto.css("display", "none");
			divDepositoDest.css("display", "none");
//			hideDiv(divUbicacionDest);
		
			if (tipoSeleccionado == 'P'){
				divProyecto.css("display", "block");		
			} else if (tipoSeleccionado == 'D'){
				divProyecto.css("display", "block");		
			} else if (tipoSeleccionado == 'I'){		
		
			} else if (tipoSeleccionado== 'B'){		
		
			} else if (tipoSeleccionado == 'T'){
				divDepositoDest.css("display", "block");		
//				showDiv(divUbicacionDest);
			}
       	});
		
		//Combo Deposito
		depositoCmb.bind("change", function(e) {
			alert("");

			return false;
       	});
   	}
	
});

movimientoInventarioRender=new MovimientoInventario();