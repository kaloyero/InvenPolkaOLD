var Categoria = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="categoria"
    },
    onList: function(data){
            this.parent(data);
            this.hacerTablaEditable();
    },
    bindListEvents:function() {
			var self=this;
          	jQuery('.save').bind("click", function(e) {
          		translator.save(self.type, self.getForm());
				//Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
				return false;
			});
    },
});

categoriaRender=new Categoria();