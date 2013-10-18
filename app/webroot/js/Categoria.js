var Categoria = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
    },
    hacerTablaEditable: function(){
        this.parent("Categoria");
    },

});

categoria=new Categoria();