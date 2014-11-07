var RenderTranslator = new Class({
    initialize: function(){

    },

    getRender: function(type){
    	switch (type) {
		case "articulo":
			return articuloRender;
			break;
		case "ayuda":
			return ayudaRender;
			break;
		case "pedido":
			return pedidoRender;
			break;
		case "pedidoSalida":
			return pedidoSalidaRender;
			break;
		case "pedidoHisto":
			return pedidoHistoRender;
			break;
		case "pedidoRealizado":
			return pedidoRealizadoRender;
			break;
		case "pedidoProyPend":
			return pedidoProyPendRender;
			break;
		case "estudio":
			return estudioRender;
			break;
		case "deposito":
			return depositoRender;
			break;
		case "movimientoInventario":
			return movimientoInventarioRender;
			break;
		case "inventario":
			return inventarioRender;
			break;
		case "proyecto":
			return proyectoRender;
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
		case "usuario":
			return usuarioRender;
			break;
	}
 }

});

renderTranslator=new RenderTranslator();