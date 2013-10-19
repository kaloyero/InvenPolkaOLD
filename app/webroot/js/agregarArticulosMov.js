$(document).ready(function() {

    var MaxInputs       = 8; //Número Maximo de Campos
    var contenedor       = $("#contenedor"); //ID del contenedor
    var AddButton       = $("#agregarCampo"); //ID del Botón Agregar
	var ArtCantidad       = $("#Articulo.Cantidad"); //Articulo cantidad
	var ArtArticulo       = $("#Articulo.Articulo option:selected"); 
	var ArtUbicacionOrig       = $("#Articulo.UbicacionOrig option:selected"); 
	var ArtUbicacionDest       = $("#Articulo.UbicacionDest option:selected"); 

    //var x = número de campos existentes en el contenedor
    var x = $("#contenedor div").length ;
    var FieldCount = x-1; //para el seguimiento de los campos

    $(AddButton).click(function (e) {
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++;
            //agregar campo
            $(contenedor).append('' +
				' <div>' +
				'	Articulo: <input name="nomArticulo" type="text" value="Nom Articulo ' + $(ArtArticulo).val() + '" readonly="readonly" />' +			
				'	Cantidad: <input name="data[Detalle]['+FieldCount+'][Cantidad]" type="text" value="' + 1 + '" readonly="readonly" />' +			
				'	Ubicacion Origen: <input name="nomUbicacion" type="text" value="Ubicacion ' + $(ArtUbicacionOrig).val() + '" readonly="readonly" />' +						    
				'	Ubicacion Destino: <input name="nomUbicacion" type="text" value="Ubicacion ' + $(ArtUbicacionDest).val() + '" readonly="readonly" />' +						    				
				'  <input name="data[Detalle]['+FieldCount+'][IdArticulo]" type="hidden" value="' + 1 + '" readonly="readonly" />' +			
				'  <input name="data[Detalle]['+FieldCount+'][IdUbicacionOrig]" type="hidden" value="' + 1 + '" readonly="readonly" />' +							
				'  <input name="data[Detalle]['+FieldCount+'][IdUbicacionDest]" type="hidden" value="' + 1 + '" readonly="readonly" />' +							

				'</div>');
            x++; 			
			//<input type="text" name="mitexto[0]" id="campo_1" placeholder="Texto 1"/><a href="#" class="eliminar">&times;</a>


        }
        return false;
    });

    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });
});