var ServerManager = new Class({
    initialize: function(name){
        this.name = name;
        this.services={};
        this.services['categoria']={};
       // this.services['categorias']["load"]="actividad/load/";
        //this.services['categorias']["save"]="actividad/create";
        this.services['categoria']["edit"]="categorias/edit/";

    },

    update: function(config){
        console.log("Congi",config)
    	var self=this;
    	var dataAEnviar = {};
        dataAEnviar["data"] = {}
        dataAEnviar["data"][config.object] = {}
        dataAEnviar["data"][config.object]["Nombre"] = config.value;

    	$.ajax( {
		      type: "POST",
		      url: "edit/"+config.editObject,
		      data:  dataAEnviar,
		      success: function(data) {
		    	  console.log("LISTO",data);
				}
		    } );
    }

});

serverManager=new ServerManager();