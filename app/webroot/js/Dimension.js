var Dimension = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
    },
    hacerTablaEditable: function(){
        this.parent("Dimensione");
    },

});

dimension=new Dimension();