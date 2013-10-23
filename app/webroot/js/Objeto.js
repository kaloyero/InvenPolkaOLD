var Objeto = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="objeto";
    },
    onList: function(data){
            this.parent(data);
            this.hacerTablaEditable();
    }
});

objetoRender=new Objeto();