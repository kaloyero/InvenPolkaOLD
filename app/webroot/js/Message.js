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
       createMessageConfiguraciones: function(objectType,data){

           if (String(data)=="Ok"){
               jQuery.jGrowl("Actualizado Satisfactoriamente.", {
                   theme : 'success'
   			});
          	}else if (objectType=="categoria"){
                jQuery.jGrowl("No se permite borrar ,ya que se encuentra asociado a un articulo o bien asociado a una configuracion", {
   				theme : 'error'
   			});
          	}else{
          	     jQuery.jGrowl("No se permite borrar ,ya que se encuentra asociado a un articulo", {
       				theme : 'error'
          	})
          }
      },
      createMessageProyecto: function(data){

            	if (String(data)=="Ok"){
            	    jQuery.jGrowl("Borrado Satisfactoriamente.", {
     				theme : 'success'
     			});
            	}else{
                 jQuery.jGrowl("Hubo un problema con la operacion", {
     				theme : 'error'
     			});
            	}
            },

});

messageRender=new Message();