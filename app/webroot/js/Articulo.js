var Articulo = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='articulo';
    },

     bindAddEvents:function() {
         var self=this;
         this.styleForm();
         jQuery('form').ajaxForm({
                    // any other options,
                 beforeSubmit: function () {
                     if (!self.validateImage()){
                         alert("Seleccione una Foto del ARticulooo")
                         return false;
                    }else{
                        self.addLoader();
                        return true;
                    }
                },
                 success: function () {
                     self.removeLoader();
                     alert("Guardado!")
                 }

           });
       },
     bindEditEvents:function() {
         var self=this;
         this.styleForm();
         jQuery('form').ajaxForm({
             beforeSubmit: function () {
                 self.addLoader();
                 return true;
             },
             success: function () {
                 self.removeLoader();
                 alert("Guardado!")
             }
        })
    },

    onFinder:function(data) {
        this.cleanCanvas();
        jQuery(".contentinner").append(data);
        // Transform upload file
        jQuery('.uniform-file').uniform();
        this.bindFinderEvents()
    },
    onSearched:function(data) {

           this.cleanCanvas();
           jQuery(".contentinner").append(data);
           // Transform upload file
           jQuery('.uniform-file').uniform();
           this.bindListEvents()
       },

     bindFinderEvents:function() {
         var self=this;
         this.styleForm();
         jQuery('.save').bind("click", function(e) {
         translator.search(self.type, self.getForm());
          //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
          return false;
          });
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



