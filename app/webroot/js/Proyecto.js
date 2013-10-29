var Proyecto = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="proyecto";
        this.breadcrumb='Proyectos';
        this.descripcion="Desde aqui administre los Proyectos"
    }
});

proyectoRender=new Proyecto()