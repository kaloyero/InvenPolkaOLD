var Message = new Class({
    initialize: function(name){
    },
    createMessage: function(data){

       	if (String(data)=="Ok"){
       	    jQuery.jGrowl("Actualizado Satisfactoriamente.", {
				theme : 'success'
			});
       	}else{
            jQuery.jGrowl("Hubo un problema con la operacion", {
				theme : 'error'
			});
       	}
       },
       createMessageConfiguraciones: function(data){

           if (String(data)=="Ok"){
               jQuery.jGrowl("Actualizado Satisfactoriamente.", {
                   theme : 'success'
   			});
          	}else{
                jQuery.jGrowl("No se permite borrar ,ya que se encuentra asociado a un articulo", {
   				theme : 'error'
   			});
          	}
          }

});

messageRender=new Message();