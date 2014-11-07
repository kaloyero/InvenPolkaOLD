var ServerManager = new Class({
    initialize: function(name){
        this.name = name;
        this.services={};
        this.services['articulo']={};
		this.services['ayuda']={};
        this.services['pedido']={};
        this.services['pedidoSalida']={};
        this.services['pedidoHisto']={};
		this.services['pedidoRealizado']={};
		this.services['pedidoProyPend']={};
        this.services['inventario']={};
        this.services['proyecto']={};
        this.services['estudio']={};
        this.services['deposito']={};
        this.services['movimientoInventario']={};
		this.services['categoria']={};
        this.services['material']={};
        this.services['decorado']={};
        this.services['dimension']={};
        this.services['estilo']={};
        this.services['objeto']={};
        this.services['proyecto']={};
        this.services['deposito']={};
        this.services['estudio']={};
        this.services['inventario']={};
        this.services['buscadorArticulo']={};
        this.services['configuracion']={};
        this.services['usuario']={};
		

        this.services['articulo']["controllerName"]="articulos";
        this.services['articulo']["model"]="Articulo";
        this.services['ayuda']["controllerName"]="ayudas";
        this.services['ayuda']["model"]="Ayuda";
        this.services['pedido']["controllerName"]="pedidos";
        this.services['pedido']["model"]="Pedido";
        this.services['pedidoSalida']["controllerName"]="pedidosSalida";
        this.services['pedidoSalida']["model"]="PedidoSalida";
        this.services['pedidoHisto']["controllerName"]="pedidosHisto";
        this.services['pedidoHisto']["model"]="PedidoHisto";
        this.services['pedidoRealizado']["controllerName"]="pedidosRealizado";
        this.services['pedidoRealizado']["model"]="pedidoRealizado";
        this.services['pedidoProyPend']["controllerName"]="pedidosProyPend";
        this.services['pedidoProyPend']["model"]="pedidoProyPend";		
        this.services['inventario']["controllerName"]="inventarios";
        this.services['inventario']["model"]="Inventario";
        this.services['estudio']["controllerName"]="estudios";
        this.services['estudio']["model"]="Estudio";
        this.services['deposito']["controllerName"]="depositos";
        this.services['deposito']["model"]="Deposito";
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
        this.services['objeto']["model"]="Objeto";
        this.services['proyecto']["controllerName"]="proyectos";
        this.services['proyecto']["model"]="Proyecto"
        this.services['deposito']["controllerName"]="depositos";
        this.services['deposito']["model"]="Deposito"
        this.services['estudio']["controllerName"]="estudios";
        this.services['estudio']["model"]="Estudio"
        this.services['inventario']["controllerName"]="inventarios";
        this.services['inventario']["model"]="Inventario"
        this.services['buscadorArticulo']["controllerName"]="articulos";
        this.services['buscadorArticulo']["model"]="Inventario"
        this.services['configuracion']["controllerName"]="configuraciones";
        this.services['usuario']["controllerName"]="usuarios";
        this.services['usuario']["model"]="Usuario";

    },

    updateConfigurations: function(config){
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
		    	  config.onSuccess(data);
				}
		    } );
    },
	viewPost: function(config){
    	var self=this;
    	var type = config.object;
    	jQuery.ajax( {
		      type: "POST",
		      url: self.services[type]["controllerName"]+"/view/"+config.editObject,
		      data: config.data.serialize(),
		      success: function(data) {
		    	 config.onSuccess(data);
				}
		    } );
    },


    update: function(config){
    	var self=this;
    	var type = config.object;

    	jQuery.ajax( {
		      type: "POST",
		      url: self.services[type]["controllerName"]+"/edit/"+config.editObject,
		      data: config.data.serialize(),
		      success: function(data) {
		    	 config.onSuccess(data);
				}
		    } );
    },
    showList: function(config,isSearch){
		var type = config.object;
    	var self=this;
    	jQuery.ajax({
			type: 'GET',
			data:"isSearch="+isSearch,
			url: self.services[type]["controllerName"],
			success: function(data) {
                config.onSuccess(data);
			}
		});
    },
	
    showFinder: function(config){

       	var type = config.object;
       	var self=this;
       	jQuery.ajax({
   			type: 'GET',
   			url: self.services[type]["controllerName"]+"/find",
   			success: function(data) {
                   config.onSuccess(data);
   			}
   		});
       },
     search: function(config){

         var type = config.object;
         var self=this;
          	jQuery.ajax({
      			type: 'POST',
      			url: self.services[type]["controllerName"]+"/find",
      			data: config.data.serialize(),
      			success: function(data) {
      			    self.showList({object:type,onSuccess:config.onSuccess},true)
      			}
      		});
          },
    add: function(config){
    	var self=this;
    	var type = config.object;
    	jQuery.ajax({
			type: 'GET',
			data:config.data,
			url: self.services[type]["controllerName"]+"/add",
			success: function(data) {

				config.onSuccess(data);
			}
		});
    },
    addMovimiento: function(config,funcion){
    	var self=this;
    	var type = config.object;
    	jQuery.ajax({
			type: 'GET',
			data:config.data,
			url: self.services[type]["controllerName"]+"/"+funcion,
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
				},
                error: function(data) {
                 config.onSuccess(data);
          	   }
		    } );
    },
    view: function(config){
    	var self=this;
    	var type = config.object;

    	jQuery.ajax( {
		      type: "GET",
		      url: self.services[type]["controllerName"]+"/edit/"+config.id,
		      success: function(data) {
		    	  config.onSuccess(data);
				}
		    } );
    },
    viewDetail: function(config){
    	var self=this;
    	var type = config.object;

    	jQuery.ajax( {
		      type: "GET",
		      url: self.services[type]["controllerName"]+"/view/"+config.id,
		      success: function(data) {
		    	  config.onSuccess(data);
				}
		    } );
    },
    delete: function(config){
    	var self=this;
    	var type = config.object;

    	jQuery.ajax( {
		      type: "POST",
		      url: self.services[type]["controllerName"]+"/delete/"+config.id,
		      success: function(data) {
		    	  config.onSuccess(data);
				},
                error: function(data) {
                    config.onSuccess(data);
        	   }
		    } );
    },


    getConfiguraciones: function(config){
       	var self=this;
       	var type = config.object;

       	jQuery.ajax( {
   		      type: "GET",
   		      dataType: 'json',
   		      url: self.services[type]["controllerName"]+"/configuraciones/"+config.id,
   		      success: function(data) {
   		    	  config.onSuccess(data);
   				}
   		    } );
       },

    confirmarPedido: function(config){
    	var self=this;
    	var type = config.object;

    	jQuery.ajax( {
		      type: "GET",
		      url: self.services[type]["controllerName"]+"/confirmarPedido/"+config.id,
		      success: function(data) {
		    	  config.onSuccess(data);
				}

		    } );
    },
    resetPassword: function(config){
    	var self=this;
    	var type = config.object;

    	jQuery.ajax( {
		      type: "GET",
		      url: self.services[type]["controllerName"]+"/resetPassword/"+config.id,
		      success: function(data) {
		    	  config.onSuccess(data);
				}

		    } );
    },
    loginUser: function(config){
    	var self=this;
    	var type = config.object;
    	jQuery.ajax( {
		      type: "POST",
				data: config.data.serialize(),
		      	url: "usuarios/login",
		      	success: function(data) {
		    	  	config.onSuccess(data);
				},
				error : function(data) {
				  	config.onError(data)
				}

		    } );
    },
    logOutUser: function(config){
    	var self=this;
    	var type = config.object;
    	jQuery.ajax( {
		  type: "POST",
			url: "usuarios/logOut",
			success: function(data) {
				config.onSuccess(data);
			},
			error : function(data) {
				config.onError(data)
			}

		} );
    },
    cambioPassword: function(config){
    	var self=this;
    	var type = config.object;
    	jQuery.ajax( {
		      type: "GET",
		      url: "usuarios/cambioClave",
		      success: function(data) {
		    	  config.onSuccess(data);
				}
		    } );
    },
    cambioPasswordPost: function(config){
    	var self=this;
    	var type = config.object;
    	jQuery.ajax( {
		      type: "POST",
		      url: "usuarios/cambioClave",
		      data: config.data.serialize(),
		      success: function(data) {
		    	  config.onSuccess(data);
				}
		    } );
    },


});

serverManager=new ServerManager();