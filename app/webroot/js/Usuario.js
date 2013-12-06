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
    }
});

usuarioRender=new Usuario()