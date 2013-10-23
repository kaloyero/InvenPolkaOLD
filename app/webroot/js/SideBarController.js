var SideBarController = new Class({
    initialize: function(){

    },
    onOptionSelected: function(objectType){
    	translator.show(objectType);
    },

    bindMenuOptionsEvents:function() {

    	jQuery('.option').bind("click", function(e) {
    		var objectId=jQuery(this).attr("id");
    		sideBarController.onOptionSelected(objectId);
    });
    }

});
var sideBarController=new SideBarController();