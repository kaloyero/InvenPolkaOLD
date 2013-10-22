var Decorado = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="decorado";
    },
    onList: function(data){
            this.parent(data);
            this.hacerTablaEditable();
    }

});

decoradoRender=new Decorado();