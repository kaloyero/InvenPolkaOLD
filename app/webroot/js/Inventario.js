var Inventario = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
    },
    hacerTablaEditable: function(){
        //this.parent("Categoria");
    },
    onList: function(data){
        this.cleanCanvas();
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
            translator.save("inventario", self.getForm());
      	    //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
      	    return false;
      });
  }

});

inventarioRender=new Inventario();