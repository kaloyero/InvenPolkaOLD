var Estilo = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="estilo";
        this.breadcrumb='Estilos';
        this.descripcion="Desde aqui administre los Estilos"
    },
    onList: function(data){
            this.parent(data);
            this.hacerTablaEditable();

    },
    bindListEvents:function() {
			var self=this;
			this.generateValidation();

          	jQuery('.save').bind("click", function(e) {
          	    if (self.getForm().valid()){
          	        self.addLoader();
          		    translator.save(self.type, self.getForm());
				    //limpio el formulario
				    //jQuery(".input-medium").val("");
				    //Actualizo la tabla en la pagina en q esta
				    //jQuery('.paginate_active').click();
				    //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
				    return false;
				}
			});
    },
     checkContinue:function() {
         //limpio el formulario
        jQuery('.stdform')[0].reset();
        //Actualizo la tabla en la pagina en q esta
		jQuery('.paginate_active').click();
    }
});

estiloRender=new Estilo();