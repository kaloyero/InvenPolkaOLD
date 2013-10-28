var Estudio = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="estudio";
    }
});

estudioRender=new Estudio()