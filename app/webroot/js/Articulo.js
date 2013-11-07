var Articulo = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.currentSelectedArticulos={};

        this.context="articulo";
        this.type='articulo';
        this.breadcrumb='Articulos';
        this.descripcion="Desde aqui administre los Articulos"
    },
    setContext:function(context) {
        this.context=context;
    },
    getContext:function() {
        return this.context;
    },
    bindListEvents:function() {
          var self=this;
		  this.parent();
          jQuery('.crearPedido').bind("click", function(e) {
				translator.add("pedido",self.getDataToSendInJsonFormat());
               	return false;
          })
          this.deleteSelectedArticlesArray();
        },

     deleteSelectedArticlesArray:function(){
         //Ponemos en 0 nuevamente el array de seleccionados si el contexto no es Pedidos
       		  if (this.getContext()!='pedidos'){
       		      this.currentSelectedArticulos={};
       		  }else{
       		      //Vuelvo el contexto a articulos
       		      this.setContext('articulo')
       		  }
     },

     bindAddEvents:function() {
         var self=this;
         this.styleForm();
         this.generateValidation();

         jQuery('form').ajaxForm({
                    // any other options,
                 beforeSubmit: function () {
                     //Si pasa la validacion del Form(Excepto la de la imagen que la preguntamos luego)
                           if (self.getForm().valid()){
                               if (!self.validateImage()){
                                        alert("Seleccione una Foto del ARticulooo")
                                        return false;
                                    }else{
                                        self.addLoader();
                                        return true;
                                    }
                                }
                },
                 success: function (data) {
                     self.onSaved();
                     messageRender.createMessage(data);
                 },
 			     error: function(data) {
 			         self.onSaved();
 			         messageRender.createMessage(data);
 			     }

           });
       },
     bindEditEvents:function() {
         var self=this;
         this.styleForm();
         this.generateValidation();

         jQuery('form').ajaxForm({
             beforeSubmit: function () {
                 if (self.getForm().valid()){
                     self.addLoader();
                     return true;
                }
             },
             success: function (data) {
                 self.onUpdated();
                 messageRender.createMessage(data);
             },
  			error: function(data) {
  			    self.onUpdated();
  			    messageRender.createMessage(data);
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
    },
     checkContinue:function() {
         this.parent();
         //Limpio el campo Span donde se guarda el nombre del archivo seleccionado
         jQuery('.filename').empty();
         jQuery('.filename').append('No file selected');

     },
     onUpdated: function(){
             this.parent();
             translator.show(this.type);
    },
    afterDataTable:function(data){
        var self=this;
        this.drawTableWithThumbnails(data);
        this.toogleCrearPedidoButton();
        jQuery('.edit').bind("click", function(e) {
				   translator.view(self.type,self.getSelectedRowId(this));
				   return false;
		})
		jQuery(':checkbox').bind("change", function(e) {
		    var articuloId=self.getArticuloIdFromCheckBoxSelection(this);

            if(jQuery(this).is(":checked")) {
                self.currentSelectedArticulos[articuloId] = 0
            }else{
                delete self.currentSelectedArticulos[articuloId];
                 }
              self.toogleCrearPedidoButton();
           })


},
    checkElements:function(){
        for (var id in this.currentSelectedArticulos)
        {
            if (jQuery("#"+id).length >0){
                jQuery("#"+id).prev().prop('checked', true);
            }
      }
    },
    drawTableWithThumbnails:function(data){
        jQuery("tr").remove();
        jQuery(".infoShow").remove();
        for(i=0; i< data.length; i++) {
            jQuery("#configurationTable").before('<div  class="infoShow">'+data[i]["_aData"][2]+'<input type="checkbox" name="option3"><a href="#" id='+data[i]["_aData"][0][0]+' class="edit"><img style="width:20px;height:20;display:inline" src="/InvenPolka/app/webroot/files/gif/edit.jpg"></a><img style="width:20px;height:20px;display:inline" src="/InvenPolka/app/webroot/files/gif/desactivar.png"></div>')
        }
         this.checkElements();
    },
    getSelectedRowId:function(selectedRow) {
        return jQuery(selectedRow).attr('id');
   },
   getArticuloIdFromCheckBoxSelection:function(selectedCheck) {
       return jQuery(selectedCheck).next().attr("id");
   },
   toogleCrearPedidoButton:function() {
        if (jQuery('input:checked').length >0){
                jQuery('.crearPedido').removeAttr("disabled");
           }else{
               jQuery('.crearPedido').attr("disabled", "disabled");
           }
   },
   getDataToSendInJsonFormat:function(data){
       var jsonToSend={};

       jQuery.each(this.currentSelectedArticulos, function(key, value) {
            jsonToSend["id"+key] = key
       });
       return jsonToSend;
   }
});

articuloRender=new Articulo();



