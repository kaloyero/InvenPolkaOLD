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

            jQuery('.edit').bind("click", function(e) {
				   translator.view(self.type,self.getSelectedRowId(this));
				   return false;
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
		}
	
	
});



	

usuarioRender=new Usuario()