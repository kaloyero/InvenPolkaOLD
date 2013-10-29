var Articulo = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='articulo';
        this.breadcrumb='Articulo';
        this.descripcion="Desde aqui administre los Articlos"
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
                     jQuery.jGrowl("Creado con exito.", {
					        theme : 'success'
				        });
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
                 jQuery.jGrowl("Creado con exito.", {
				        theme : 'success'
			        });
             }
        })
    },

    onFinder:function(data) {
        this.cleanCanvas();
        jQuery(".contentinner").append(data);
        // Transform upload file
        jQuery('.uniform-file').uniform();
        this.drawSearchHeader();
        this.bindFinderEvents()
    },
    onSearched:function(data) {

           this.cleanCanvas();
           jQuery(".contentinner").append(data);
           // Transform upload file
           jQuery('.uniform-file').uniform();
           this.bindListEvents()
           this.makeDatatable();
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
         },
    drawSearchHeader:function() {
        jQuery('.headerBig').empty();
        jQuery('.headerBig').append("Busqueda de Articulos");
        jQuery('.headerDescription').empty();
        jQuery('.headerDescription').append("Realize busqueda de articulos");
        jQuery('.activeBreadcrum').empty();
        jQuery('.activeBreadcrum').append("Busqueda de Articulos");

            }
});

articuloRender=new Articulo();



