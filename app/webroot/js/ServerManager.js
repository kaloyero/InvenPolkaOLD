var ServerManager = new Class({
    initialize: function(name){
        this.name = name;
        this.services={};
        this.services['articulo']={};
        this.services['pedido']={};		
        this.services['inventario']={};		
        this.services['proyecto']={};						
        this.services['movimientoInventario']={};		
		this.services['categoria']={};
        this.services['material']={};
        this.services['decorado']={};
        this.services['dimension']={};
        this.services['estilo']={};
        this.services['objeto']={};

        this.services['articulo']["controllerName"]="articulos";
        this.services['articulo']["model"]="Articulo";
        this.services['pedido']["controllerName"]="pedidos";
        this.services['pedido']["model"]="Pedido";
        this.services['inventario']["controllerName"]="inventarios";
        this.services['inventario']["model"]="Inventario";
        this.services['proyecto']["controllerName"]="proyectos";
        this.services['proyecto']["model"]="Proyecto";
        this.services['movimientoInventario']["controllerName"]="movimientoInventarios";
        this.services['movimientoInventario']["model"]="MovimientoInventario";
        this.services['categoria']["controllerName"]="categorias";
        this.services['categoria']["model"]="Categoria"
        this.services['material']["controllerName"]="materiales";
        this.services['material']["model"]="Materiale";
        this.services['decorado']["controllerName"]="decorados";
        this.services['decorado']["model"]="Decorado"
        this.services['dimension']["controllerName"]="dimensiones";
        this.services['dimension']["model"]="Dimension";
        this.services['estilo']["controllerName"]="estilos";
        this.services['estilo']["model"]="Estilo";
        this.services['objeto']["controllerName"]="objetos";
        this.services['objeto']["model"]="Objeto"

    },

    update: function(config){
    	var self=this;
    	var type = config.object;
    	var dataAEnviar = {};
        dataAEnviar["data"] = {}
        dataAEnviar["data"][self.services[type]["model"]] = {}
        dataAEnviar["data"][self.services[type]["model"]]["Nombre"] = config.value;

    	jQuery.ajax( {
		      type: "POST",
		      url: self.services[type]["controllerName"]+"/edit/"+config.editObject,
		      data:  dataAEnviar,
		      success: function(data) {
		    	  console.log("LISTO",data);
				}
		    } );
    },
    showList: function(config){

    	var type = config.object;
    	var self=this;
    	jQuery.ajax({
			type: 'GET',
			url: self.services[type]["controllerName"],
			success: function(data) {
                config.onSuccess(data);
			}
		});
    },
    add: function(config){

    	var self=this;
    	var type = config.object;
    	jQuery.ajax({
			type: 'GET',
			url: self.services[type]["controllerName"]+"/add",
			success: function(data) {

				config.onSuccess(data);
			}
		});
    },
    save: function(config){
    	var self=this;
    	var type = config.object;
    	console.log("FOMM",config.data.serialize())
    	jQuery.ajax( {
		      type: "POST",
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		      url: self.services[type]["controllerName"]+"/add",
		      data: config.data.serialize(),
		      success: function(data) {
		    	  config.onSuccess(data);
				}
		    } );
    }

});

serverManager=new ServerManager();