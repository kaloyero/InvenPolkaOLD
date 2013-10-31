var Deposito = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="deposito";
        this.breadcrumb='Depositos';
        this.descripcion="Desde aqui administre los Depositos"
    },
    onUpdated: function(data){
            this.parent();
            translator.show(this.type);
       }
});

depositoRender=new Deposito()