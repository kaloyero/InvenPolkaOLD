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
       },
    bindListEvents:function() {
           var self=this;
           jQuery('.edit').bind("click", function(e) {
             if (self.getForm().valid()){
                 translator.update(self.type, self.getForm());
                 self.addLoader();
	         }
            //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
            return false;
          })
        },
	   
});

depositoRender=new Deposito()