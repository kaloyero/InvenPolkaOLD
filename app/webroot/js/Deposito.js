var Deposito = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="deposito";
    }
});

depositoRender=new Deposito()