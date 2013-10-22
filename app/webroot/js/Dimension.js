var Dimension = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="dimension";
    },
    onList: function(data){
            this.parent(data);
            this.hacerTablaEditable();
    }

});

dimensionRender=new Dimension();