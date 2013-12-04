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
         this.getForm().ajaxForm({
                    // any other options,
                 beforeSubmit: function () {
                     console.log("JAJA")

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
 			         console.log("JAsJA")

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
         this.getForm().ajaxForm({
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
  			    console.log("Error")
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
         jQuery('.categoria').bind("change", function(e) {
                    console.log("Excutado de " ,jQuery(this).closest("form"))
                    self.findInForm=jQuery(this).closest("form");
                	translator.getConfiguraciones(self.type,this.value);
              })
         jQuery('.save').bind("click", function(e) {
             translator.search(self.type, self.getForm());
             //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
             return false;
          });

    },
     bindFinderStaticEvents:function() {
         var self=this;
         jQuery('.categoria').bind("change", function(e) {
                    console.log("Excutado de " ,jQuery(this).closest("form"))
                    self.findInForm=jQuery(this).closest("form");
                	translator.getConfiguraciones(self.type,this.value);
              })
          jQuery('.saveBuscador' ).bind("click", function(e) {
              translator.search("articulo", jQuery(".formBuscador"));
              return false;
          })
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
        var self=this;
        //FindInFOrm,guarda referencia para saber en que formulario ponemos la informacion,o en el de busqueda o en el de articuloss
        //Removemos lo que habia antes
        this.findInForm.find('#ArticuloIdDecorado').find('option').remove()
        this.findInForm.find("#ArticuloIdDecorado").prev().empty();

        jQuery.each(data.decorados, function (index, value) {
            self.findInForm.find("#ArticuloIdDecorado").append('<option value="'+value["decorado"]["id"]+'">'+value["decorado"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
        if( this.findInForm.find('#ArticuloIdDecorado').has('option').length > 0 ) {
            var primerOpcionValor=this.findInForm.find('#ArticuloIdDecorado option:first-child').text();
            self.findInForm.find("#ArticuloIdDecorado").prev().text(primerOpcionValor);
        }
        //Removemos lo que habia antes
        this.findInForm.find('#ArticuloIdMaterial').find('option').remove()
        this.findInForm.find("#ArticuloIdMaterial").prev().empty();

        jQuery.each(data.materiales, function (index, value) {
            self.findInForm.find("#ArticuloIdMaterial").append('<option value="'+value["material"]["id"]+'">'+value["material"]["Nombre"]+'</option>');
        });

         //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( this.findInForm.find('#ArticuloIdMaterial').has('option').length > 0 ) {
             var primerOpcionValor=this.findInForm.find('#ArticuloIdMaterial option:first-child').text();
             this.findInForm.find("#ArticuloIdMaterial").prev().text(primerOpcionValor);
         }

         //Removemos lo que habia antes
        this.findInForm.find('#ArticuloIdDimension').find('option').remove()
        this.findInForm.find("#ArticuloIdDimension").prev().empty();


        jQuery.each(data.dimensiones, function (index, value) {
            self.findInForm.find("#ArticuloIdDimension").append('<option value="'+value["dimension"]["id"]+'">'+value["dimension"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( this.findInForm.find('#ArticuloIdDimension').has('option').length > 0 ) {
             var primerOpcionValor=this.findInForm.find('#ArticuloIdDimension option:first-child').text();
             this.findInForm.find("#ArticuloIdDimension").prev().text(primerOpcionValor);
         }

         //Removemos lo que habia antes
        this.findInForm.find('#ArticuloIdObjeto').find('option').remove()
        this.findInForm.find('#ArticuloIdObjeto').prev().empty();


        jQuery.each(data.objetos, function (index, value) {
            self.findInForm.find('#ArticuloIdObjeto').append('<option value="'+value["objeto"]["id"]+'">'+value["objeto"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( this.findInForm.find('#ArticuloIdObjeto').has('option').length > 0 ) {
             var primerOpcionValor=this.findInForm.find('#ArticuloIdObjeto option:first-child').text();
             self.findInForm.find('#ArticuloIdObjeto').prev().text(primerOpcionValor);
         }

         //Removemos lo que habia antes
        this.findInForm.find('#ArticuloIdEstilo').find('option').remove()
        this.findInForm.find("#ArticuloIdEstilo").prev().empty();


        jQuery.each(data.estilos, function (index, value) {
            self.findInForm.find("#ArticuloIdEstilo").append('<option value="'+value["estilo"]["id"]+'">'+value["estilo"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( this.findInForm.find('#ArticuloIdEstilo').has('option').length > 0 ) {
             var primerOpcionValor=this.findInForm.find('#ArticuloIdEstilo option:first-child').text();
             self.findInForm.find("#ArticuloIdEstilo").prev().text(primerOpcionValor);
         }
         //Llamo al validar,para que de ultima,me limpie el mensajito de error
         this.validateConfiguraciones();
    },
    afterDataTable:function(data){
        var self=this;
        this.drawTableWithThumbnails(data);
        this.toogleToolbar();
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
              self.toogleToolbar();
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
													'<B><c style="display:inline;float:right;margin-top:0.0cm;"> '+data[i]["_aData"][9]+' ('+ data[i]["_aData"][10]+') </c></B>'+
													'</div>')

        }
         this.checkElements();
    },
    getSelectedRowId:function(selectedRow) {
        return jQuery(selectedRow).attr('id');
   },
   getArticuloIdFromCheckBoxSelection:function(selectedCheck) {
       return jQuery(selectedCheck).next().attr("id");
   },
   toogleToolbar:function() {
        if (jQuery('input:checked').length >0){
                jQuery('.crearPedido').removeAttr("disabled");
                jQuery('.asignarDepo').removeAttr("disabled");
                jQuery('.devolucionArt').removeAttr("disabled");
                jQuery('.deleteArt').removeAttr("disabled");
                jQuery('.transferir').removeAttr("disabled");

           }else{
               jQuery('.crearPedido').attr("disabled", "disabled");
               jQuery('.asignarDepo').attr("disabled", "disabled");
               jQuery('.devolucionArt').attr("disabled", "disabled");
               jQuery('.deleteArt').attr("disabled", "disabled");
               jQuery('.transferir').attr("disabled", "disabled");


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



