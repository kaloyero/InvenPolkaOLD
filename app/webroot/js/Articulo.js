var Articulo = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='articulo';
    },
    onList: function(data){
            this.parent(data);
            this.hacerTablaEditable();
            this.oTable = jQuery('#browserList').dataTable({
                       "bProcessing": true,
                       "bServerSide": true,
                       "bPaginate": true,
                       "sPaginationType": "full_numbers",
                       "sAjaxSource": "articulos/ajaxData",
                       "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                           console.log("DATa",arguments)
                       },
                       "fnInitComplete": function(oSettings, json) {
                             console.log("ARGUU",arguments)
                           },
                   });


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
                        return true;
                    }
                },
                 success: function () {
                     alert("Guardado!")
                 }

           });
       },
     bindEditEvents:function() {
         var self=this;
         this.styleForm();
         jQuery('form').ajaxForm({
             success: function () {
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



