var Proyecto = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="proyecto";
    }
});

proyectoRender=new Proyecto()