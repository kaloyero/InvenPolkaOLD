var Proyecto = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="proyecto";
        this.breadcrumb='Proyectos';
        this.descripcion="Desde aqui administre los Proyectos"
    },
    onUpdated: function(data){
            this.parent();
            translator.show(this.type);
      },
    getFormValidate:function(){

                // Specify the validation rules
                return     '{rules: {data[Proyecto][Nombre]: "required",data[Proyecto][Descripcion]: "required"}}'
    },
    afterDataTable:function(){
        this.parent();
        var self=this;

        jQuery('.desactivar').bind("click", function(e) {
			  translator.delete(self.type,self.getSelectedRowId(this));
		  })
    },
    onDeleted:function() {
             //Actualizo la tabla en la pagina en q esta
        	jQuery('.paginate_active').click();
    }
});

proyectoRender=new Proyecto()