var Objeto = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
    },
    hacerTablaEditable: function(){
        this.parent("Objeto");
    },

});

objeto=new Objeto();