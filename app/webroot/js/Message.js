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
       }

});

messageRender=new Message();