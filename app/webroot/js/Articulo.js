var Articulo = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='articulo';
    },

     bindAddEvents:function() {
         var self=this;
         jQuery('form').ajaxForm({
                    // any other options,
                 beforeSubmit: function () {
                     if (!self.validateImage()){
                         alert("Seleccione una Foto del ARticulooo")
                         return false;
                    }else{
                        return true;
                    }
                },
                 submit: function () {
                     alert("Guardado!")
                 }

           });
       },
     bindEditEvents:function() {
         var self=this;
         console.log("EDIT")
         jQuery('form').ajaxForm({
             success: function () {
                        alert("Guardado!")
             }
        })
    },
     validateImage:function() {
        var fileName = jQuery("input:file").val();
            if (fileName){
                 return true
             }else{
                 return false;
             }
         }
});

articuloRender=new Articulo();

