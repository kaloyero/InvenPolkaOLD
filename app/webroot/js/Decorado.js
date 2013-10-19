var Decorado = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
    },
    hacerTablaEditable: function(){
        this.parent("Decorado");
    },

});

decorado=new Decorado();