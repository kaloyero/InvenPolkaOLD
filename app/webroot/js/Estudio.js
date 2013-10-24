var Estudio = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
    },
    hacerTablaEditable: function(){

    },
    onList: function(data){
        this.cleanCanvas();
        jQuery(".contentinner").append(data);
        this.bindListEvents();
     },
     onAdd: function(data){
         this.cleanCanvas();
         jQuery(".contentinner").append(data);
         // Transform upload file
     	jQuery('.uniform-file').uniform();
         this.bindAddEvents();
      },
     bindListEvents:function() {

     	jQuery('#add').bind("click", function(e) {
     	    translator.add("estudio")
        })
     },
     bindAddEvents:function() {
		var self=this;
 		var contenedor        		= jQuery('#contenedor'); //ID del contenedor
		var AddArticuloBtn			= jQuery('#agregarArticulo');
		var ArtCantidad       		= jQuery('#ArtCantidad'); //Articulo cantidad
		var ArtArticulo       		= jQuery('#ArtArticulo option:selected'); //Articulo seleccionado
		var x = jQuery('#contenedor div').length ;		//var x = número de campos existentes en el contenedor 
		var FieldCount = x-1; //para el seguimiento de los campos
		 
      	jQuery('.save').bind("click", function(e) {
            translator.save("estudio", self.getForm());
      	    //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
      	    //return false;
        });
		
		//Agregar articulos en la tabla
		AddArticuloBtn.bind("click", function(e) {
			FieldCount++;
			//agregar campo
			contenedor.append('' +
				' <div>' +
				'	Articulo: <input name="nomArticulo" type="text" value="' + ArtArticulo.text() + '" readonly />' +			
				'	Cantidad: <input name="data[Detalle]['+FieldCount+'][Cantidad]" type="text" value="' + ArtCantidad.val() + '" readonly />' +			
				'  <input name="data[Detalle]['+FieldCount+'][IdArticulo]" type="hidden" value="' + ArtArticulo.val() + '" readonly />' +
				'<a href="#" class="eliminar">×</a>' +
			'</div>');
				x++; 			
        });

  	}
	


});

estudioRender=new Estudio();