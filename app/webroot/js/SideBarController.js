var SideBarController = new Class({
    initialize: function(){

    },
    onOptionSelected: function(objectType){
        this.removerBasuraPluginZoom();
        if (objectType=="articulo"){
            articuloRender.context=""
        }
    	translator.show(objectType);
    },
    onSearchSelected: function(objectType){
        this.removerBasuraPluginZoom();
    	translator.showFinder(objectType);
    },

    bindMenuOptionsEvents:function() {

    	jQuery('.option').bind("click", function(e) {
    		var objectId=jQuery(this).attr("id");
    		appStatus.actualSearch="";
    		sideBarController.onOptionSelected(objectId);
    });
    	jQuery('.search').bind("click", function(e) {
    		var objectId=jQuery(this).attr("id");
    		sideBarController.onSearchSelected(objectId);
    });

    },
    removerBasuraPluginZoom:function() {
        jQuery('.zoomContainer').remove();

    }

});
var sideBarController=new SideBarController();