var Deposito = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="deposito";
        this.breadcrumb='Decorados';
        this.descripcion="Desde aqui administre los Decorados"
    }
});

depositoRender=new Deposito()