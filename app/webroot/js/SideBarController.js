var SideBarController = new Class({
    initialize: function(){

    },
    onOptionSelected: function(objectType){
        this.removerBasuraPluginZoom();
    	translator.show(objectType);
    },
    onSearchSelected: function(objectType){
        this.removerBasuraPluginZoom();
    	translator.showFinder(objectType);
    },

    bindMenuOptionsEvents:function() {

    	jQuery('.option').bind("click", function(e) {
    		var objectId=jQuery(this).attr("id");
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