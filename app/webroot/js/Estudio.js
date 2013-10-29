var Estudio = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="estudio";
        this.breadcrumb='Estudios';
        this.descripcion="Desde aqui administre los Estudios"
    }
});

estudioRender=new Estudio()