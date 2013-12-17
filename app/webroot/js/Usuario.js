var Usuario = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="usuario";
        this.breadcrumb='Usuarios';
        this.descripcion="Desde aqui administre los Usuarios"
    },
    onUpdated: function(data){
            this.parent();
            translator.show(this.type);
      },
    getFormValidate:function(){
                // Specify the validation rules
                return     '{rules: {data[Usuario][Nombre]: "required",data[Usuario][Usuario]: "required"}}'
    },
      afterDataTable:function(){
          var self=this;
			jQuery('.reset').bind("click", function(e) {

				translator.resetPassword(self.type,self.getSelectedRowId(this));
				return false;
			})
            jQuery("#configurationTable td:first-child").css('display','none');

            jQuery('.edit').bind("click", function(e) {
				   translator.view(self.type,self.getSelectedRowId(this));
				   return false;
		  	})
			jQuery('.desactivar').bind("click", function(e) {
				translator.delete(self.type,self.getSelectedRowId(this));
			})
			  
    	},
      validateLogin:function(){
          var self=this;
			jQuery('.reset').bind("click", function(e) {
				translator.resetPassword(self.type,self.getSelectedRowId(this));
				return false;
			})

            jQuery('.edit').bind("click", function(e) {
				   translator.view(self.type,self.getSelectedRowId(this));
				   return false;
			  })
			  			  
    	},
		onLoggedUser:function(){
				jQuery("body").empty();
				jQuery(data).appendTo("body");
				sideBarController.bindMenuOptionsEvents();
				articuloRender.bindFinderStaticEvents();;
		},
		onChangePass: function(data){
			var self=this;
			this.cleanCanvas();
			jQuery(".contentinner").append(data);
			// Transform upload file
			jQuery('.uniform-file').uniform();

			 jQuery('.cambioClave').bind("click", function(e) {
				  //Si pasa la validacion,salvamos
				  if (self.getForm().valid()){
					    translator.cambioPasswordPost(self.type, self.getForm());
						self.addLoader();
				  }
				  //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
				  return false;
			 });
		},
		


});





usuarioRender=new Usuario()