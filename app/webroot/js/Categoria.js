var Categoria = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="categoria"
    },
    onList: function(data){
            this.parent(data);
            this.hacerTablaEditable();
         },

});

categoriaRender=new Categoria();