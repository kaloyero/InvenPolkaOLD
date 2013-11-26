var Articulo = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.currentSelectedArticulos={};

        this.context="articulo";
        this.type='articulo';
        this.breadcrumb='Articulos';
        this.descripcion="Desde aqui administre los Articulos";
        this.isActualFormValid=false;
        this.currentStatus;
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
          jQuery('.asignarDepo').bind("click", function(e) {
				translator.addMovimiento("movimientoInventario",self.getDataToSendInJsonFormat(),"ingresoDeArticulos");
               	return false;
          })
          jQuery('.devolucionArt').bind("click", function(e) {
				translator.addMovimiento("movimientoInventario",self.getDataToSendInJsonFormat(),"devolucionDeArticulos");
               	return false;
          })
          jQuery('.deleteArt').bind("click", function(e) {
				translator.addMovimiento("movimientoInventario",self.getDataToSendInJsonFormat(),"darDeBajaArticulos");
               	return false;
          })
          jQuery('.transferir').bind("click", function(e) {
				translator.addMovimiento("movimientoInventario",self.getDataToSendInJsonFormat(),"transferirADeposito");
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
                     if (self.isActualFormValid){
                         self.addLoader();
                     }else{
                         return false;
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
            jQuery('.save').bind("click", function(e) {
                self.currentStatus="Adding";
                self.validateGeneral();
             });
           jQuery('.categoria').bind("change", function(e) {
               	translator.getConfiguraciones(self.type,this.value);
             })
       },
     bindEditEvents:function() {
         var self=this;
         this.styleForm();
         this.generateValidation();

         jQuery('form').ajaxForm({
             beforeSubmit: function () {
                 if (self.isActualFormValid){
                     self.addLoader();
                 }else{
                     return false;
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
        jQuery('.categoria').bind("change", function(e) {
            translator.getConfiguraciones(self.type,this.value);
        })
        jQuery('.save').bind("click", function(e) {
            self.currentStatus="Editing";
            self.validateGeneral();
         });
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

    validateGeneral:function() {
           var isValid=true;
            //Se hacen todas las validaciones aca
              if (!this.validateConfiguraciones()){
                    isValid=false;
                }
             //Se ejecutan las valdiacioens basicas con requiered
              if (!this.getForm().valid()){
                  isValid=false;
              }
              //Se valida la imagen ,pero solo en el Add,porque en el edit,al menos una hay ya agregada
              if (this.currentStatus!='Editing'){
               if (!this.validateImage()){
                   jQuery('.errorFoto').text("Porfavor elija una foto para el articulo");
                   isValid=false;
                 }else{
                jQuery('.errorFoto').empty();
                 }
             }
            this.isActualFormValid=isValid;
    },
     validateConfiguraciones:function() {
         if( jQuery('#ArticuloIdMaterial').has('option').length == 0 || jQuery('#ArticuloIdEstilo').has('option').length  == 0 ||
                jQuery('#ArticuloIdDimension').has('option').length  == 0 || jQuery('#ArticuloIdDecorado').has('option').length  ==
                    0 || jQuery('#ArticuloIdObjeto').has('option').length  == 0) {
                        jQuery('.errorConfiguration').text("Complete todas las configuraciones!");
                        return false;
            }else{
                jQuery('.errorConfiguration').empty();
                return true;
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
    onRetrievedConfiguraciones: function(data){
        //Removemos lo que habia antes
        jQuery('#ArticuloIdDecorado').find('option').remove()
        jQuery("#ArticuloIdDecorado").prev().empty();

        jQuery.each(data.decorados, function (index, value) {
            jQuery("#ArticuloIdDecorado").append('<option value="'+value["decorado"]["id"]+'">'+value["decorado"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
        if( jQuery('#ArticuloIdDecorado').has('option').length > 0 ) {
            var primerOpcionValor=jQuery('#ArticuloIdDecorado option:first-child').text();
            jQuery("#ArticuloIdDecorado").prev().text(primerOpcionValor);
        }
        //Removemos lo que habia antes
        jQuery('#ArticuloIdMaterial').find('option').remove()
        jQuery("#ArticuloIdMaterial").prev().empty();

        jQuery.each(data.materiales, function (index, value) {
            jQuery("#ArticuloIdMaterial").append('<option value="'+value["material"]["id"]+'">'+value["material"]["Nombre"]+'</option>');
        });

         //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( jQuery('#ArticuloIdMaterial').has('option').length > 0 ) {
             var primerOpcionValor=jQuery('#ArticuloIdMaterial option:first-child').text();
             jQuery("#ArticuloIdMaterial").prev().text(primerOpcionValor);
         }

         //Removemos lo que habia antes
        jQuery('#ArticuloIdDimension').find('option').remove()
        jQuery("#ArticuloIdDimension").prev().empty();


        jQuery.each(data.dimensiones, function (index, value) {
            jQuery("#ArticuloIdDimension").append('<option value="'+value["dimension"]["id"]+'">'+value["dimension"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( jQuery('#ArticuloIdDimension').has('option').length > 0 ) {
             var primerOpcionValor=jQuery('#ArticuloIdDimension option:first-child').text();
             jQuery("#ArticuloIdDimension").prev().text(primerOpcionValor);
         }

         //Removemos lo que habia antes
        jQuery('#ArticuloIdObjeto').find('option').remove()
        jQuery("#ArticuloIdObjeto").prev().empty();


        jQuery.each(data.objetos, function (index, value) {
            jQuery("#ArticuloIdObjeto").append('<option value="'+value["objeto"]["id"]+'">'+value["objeto"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( jQuery('#ArticuloIdObjeto').has('option').length > 0 ) {
             var primerOpcionValor=jQuery('#ArticuloIdObjeto option:first-child').text();
             jQuery("#ArticuloIdObjeto").prev().text(primerOpcionValor);
         }

         //Removemos lo que habia antes
        jQuery('#ArticuloIdEstilo').find('option').remove()
        jQuery("#ArticuloIdEstilo").prev().empty();


        jQuery.each(data.estilos, function (index, value) {
            jQuery("#ArticuloIdEstilo").append('<option value="'+value["estilo"]["id"]+'">'+value["estilo"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( jQuery('#ArticuloIdEstilo').has('option').length > 0 ) {
             var primerOpcionValor=jQuery('#ArticuloIdEstilo option:first-child').text();
             jQuery("#ArticuloIdEstilo").prev().text(primerOpcionValor);
         }
         //Llamo al validar,para que de ultima,me limpie el mensajito de error
         this.validateConfiguraciones();
    },
    afterDataTable:function(data){
        var self=this;
        this.drawTableWithThumbnails(data);
        this.toogleCrearPedidoButton();
        jQuery('.edit').bind("click", function(e) {
				   translator.view(self.type,self.getSelectedRowId(this));
				   return false;
		})
        jQuery('.view').bind("click", function(e) {
				   translator.viewDetail(self.type,self.getSelectedRowId(this));
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
 			jQuery("#configurationTable").before('<div  class="infoShow">'+data[i]["_aData"][2]+
													'<input type="checkbox" name="option3"> '+data[i]["_aData"][1]+
													'<a href="#" id='+data[i]["_aData"][0][0]+' class="edit"><img style="width:20px;height:20;display:inline;float:right;margin-top:0.1cm;" src="/InvenPolka/app/webroot/files/gif/edit.jpg"></a>'+
													' <a href="#" id="'+data[i]["_aData"][0][0]+'" class="view"><img style="width:20px;height:20;display:inline;float:right;margin-top:0.1cm;" src="/InvenPolka/app/webroot/img/view.png"></a>' +		
//
													'<img style="width:20px;height:20px;display:inline;float:right;margin-top:0.1cm;" src="/InvenPolka/app/webroot/files/gif/desactivar.png">'+
													'<B><c style="display:inline;float:right;margin-top:0.0cm;"> '+data[i]["_aData"][9]+' ('+ data[i]["_aData"][10]+') </c></B>'+
													'</div>')
//            jQuery("#configurationTable").before('<div  class="infoShow">'+data[i]["_aData"][2]+'<input type="checkbox" name="option3"/>'+data[i]["_aData"][1]+'</c>'+
//												'<img style="width:20px;height:20px;display:inline;float:right;margin-top:0.1cm;" src="/InvenPolka/app/webroot/files/gif/desactivar.png">'+
//												' <a href="#" id='+data[i]["_aData"][0][0]+' class="edit"><img style="width:20px;height:20;display:inline;float:right;margin-top:0.1cm;" src="/InvenPolka/app/webroot/files/gif/edit.jpg"></a>' +
//												' <a href="#" id='+data[i]["_aData"][0][0]+' class="view"><img style="width:20px;height:20;display:inline;float:right;margin-top:0.1cm;" src="/InvenPolka/app/webroot/img/view.png"></a>' +		
//												'<B><c style="display:inline;float:right;margin-top:0.0cm;"> '+data[i]["_aData"][9]+' ('+ data[i]["_aData"][10]+') </c></B>'+
//												'</div>')
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



