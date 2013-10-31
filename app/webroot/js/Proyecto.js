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
    }
});

proyectoRender=new Proyecto()