var Material = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
    },
    hacerTablaEditable: function(){
        this.parent("Materiale");
    },

});

material=new Material();