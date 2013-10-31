var Inventario = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='inventario';
        this.breadcrumb='Inventarios';
        this.descripcion="Desde aqui administre el Inventario"
    },
    onUpdated: function(data){
            this.parent();
            translator.show(this.type);
    },

});

inventarioRender=new Inventario()
