var RenderTranslator = new Class({
    initialize: function(){

    },

    getRender: function(type){
        console.log("TYPE",type)
    	switch (type) {
		case "articulo":
			return articuloRender;
			break;
	    case "categoria":
			return categoriaRender;
			break;
	    case "decorado":
			return decoradoRender;
			break;
	    case "dimension":
			return dimensionRender;
			break;
	    case "estilo":
			return estiloRender;
			break;
	    case "material":
			return materialRender;
			break;
	    case "objeto":
			return objetoRender;
			break;
		case "proyecto":
    	    return proyectoRender;
    		break;
    	case "deposito":
        	return depositoRender;
        	break;
        case "estudio":
            return estudioRender;
            break;
        case "inventario":
            return inventarioRender;
            break;
	}
 }

});

renderTranslator=new RenderTranslator();