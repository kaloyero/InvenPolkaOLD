var Inventario = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="inventario";
    }
});

inventarioRender=new Inventario()