var Estilo = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
    },
    hacerTablaEditable: function(){
        this.parent("Estilo");
    },

});

estilo=new Estilo();