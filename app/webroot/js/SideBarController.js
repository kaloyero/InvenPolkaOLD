var SideBarController = new Class({
    initialize: function(){

    },
    onOptionSelected: function(objectType){
    	translator.show(objectType);
    },
    onSearchSelected: function(objectType){
    	translator.showFinder(objectType);
    },

    bindMenuOptionsEvents:function() {
console.log("asdff");
    	jQuery('.option').bind("click", function(e) {
    		var objectId=jQuery(this).attr("id");
    		sideBarController.onOptionSelected(objectId);
    });
    	jQuery('.search').bind("click", function(e) {
    		var objectId=jQuery(this).attr("id");
    		sideBarController.onSearchSelected(objectId);
    });

    }

});
var sideBarController=new SideBarController();