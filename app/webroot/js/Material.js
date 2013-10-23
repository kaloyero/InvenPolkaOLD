var Material = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="material";
    },
    onList: function(data){
            this.parent(data);
            this.hacerTablaEditable();
    }
});

materialRender=new Material();