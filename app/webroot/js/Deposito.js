var Deposito = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="deposito";
        this.breadcrumb='Depositos';
        this.descripcion="Desde aqui administre los Depositos"
    }
});

depositoRender=new Deposito()