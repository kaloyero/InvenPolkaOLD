var Inventario = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="inventario";
        jQuery(".contentinner").append(data);
        this.bindListEvents();
     },
     onAdd: function(data){
         this.cleanCanvas();
         jQuery(".contentinner").append(data);
         // Transform upload file
     	jQuery('.uniform-file').uniform();
         this.bindAddEvents();
      },
     bindListEvents:function() {

     	jQuery('#add').bind("click", function(e) {
     	    translator.add("inventario")
        })
     },
     bindAddEvents:function() {
        var self=this;
      	jQuery('.save').bind("click", function(e) {
        this.type="inventario";

			});			
    },

});

inventarioRender=new Inventario()
