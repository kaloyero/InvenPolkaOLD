var Estilo = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="estilo";
    },
    onList: function(data){
            this.parent(data);
            this.hacerTablaEditable();
    }
});

estiloRender=new Estilo();