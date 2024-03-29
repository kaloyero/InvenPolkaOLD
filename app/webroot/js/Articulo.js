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
    },
    setContext:function(context) {
        this.context=context;
    },
    getContext:function() {
        return this.context;
    },
    removerBasuraPluginZoom:function() {
          jQuery('.zoomContainer').remove();
      },
    bindListEvents:function() {
          var self=this;
		  this.parent();
		  jQuery('#addArticulo').bind("click", function(e) {
		        self.removerBasuraPluginZoom();
      	        translator.add(self.type);
         })


		  jQuery('#artDisponibles').bind("click", function(e) {
			if (jQuery("#artDisponibles").attr("value") == "Mostrar Articulos Disponibles"){
				jQuery("#artDisponibles").attr("value", "Mostrar  Todos  los  Articulos");
		  	} else {
				jQuery("#artDisponibles").attr("value", "Mostrar Articulos Disponibles");
			}
			/* ACA DEBERIA RECARGAR LA LISTA*/
            appStatus.oTable.fnDraw();
         })

          jQuery('.crearPedido').bind("click", function(e) {
		self.setContext("pedido");
                self.removerBasuraPluginZoom();
				translator.add("pedido",self.getDataToSendInJsonFormat());
               	return false;
          })
          jQuery('.asignarDepo').bind("click", function(e) {
		self.setContext("pedido");
                self.removerBasuraPluginZoom();
				translator.addMovimiento("movimientoInventario",self.getDataToSendInJsonFormat(),"ingresoDeArticulos");
               	return false;
          })
          jQuery('.devolucionArt').bind("click", function(e) {
		self.setContext("pedido");
                self.removerBasuraPluginZoom();
				translator.addMovimiento("movimientoInventario",self.getDataToSendInJsonFormat(),"devolucionDeArticulos");
               	return false;
          })
          jQuery('.deleteArt').bind("click", function(e) {
		self.setContext("pedido");
                self.removerBasuraPluginZoom();
				translator.addMovimiento("movimientoInventario",self.getDataToSendInJsonFormat(),"darDeBajaArticulos");
               	return false;
          })
          jQuery('.comandaArtSel').bind("click", function(e) {
          self.setContext("pedido")
               // self.removerBasuraPluginZoom();
				//translator.addMovimiento("articulo",self.getDataToSendInJsonFormat(),"comandaArticulosSelectPdf");
				//e.preventDefault();
				var cadena="?"
				var primero =true;
				var obj = self.getDataToSendInJsonFormat();
				for  (var item in obj) {
				    if (primero==false){
				        cadena+="&";
				    }else{
				        primero =false;
				    }
                 cadena +="data"+obj[item]+"=" +obj[item];
                }
				console.log("DATa",cadena)
				jQuery(this).attr("href", "/InvenPolka/articulos/generateComanda"+cadena)
                       // e.preventDefault();
                       // document.location.href = "www.google.com.ar";
//               	return false;
          })
          jQuery('.transferir').bind("click", function(e) {
		self.setContext("pedido");
				translator.addMovimiento("movimientoInventario",self.getDataToSendInJsonFormat(),"transferirADeposito");
               	return false;
          })
          this.deleteSelectedArticlesArray();
        },

     deleteSelectedArticlesArray:function(){
         //Ponemos en 0 nuevamente el array de seleccionados si el contexto no es Pedidos
       		  if (this.getContext()!='pedido'){
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
                     console.log("Entra")


                     if (self.isActualFormValid){
                         jQuery(".save").attr("disabled", "disabled");
                         self.addLoader();
                     }else{
                         //jQuery('.save').removeAttr("disabled");
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
              jQuery('.volver').bind("click", function(e) {
                    self.saveTableStatus();
                    if (self.currentStatus=="Search"){
                        translator.search("articulo", jQuery(".formBuscador"));
                    }else{
                        translator.show("articulo");
                    }
                  });

           jQuery('.categoria').bind("change", function(e) {
                self.findInForm=jQuery(this).closest("form");
               	translator.getConfiguraciones(self.type,this.value);
             })

            jQuery('#ArticuloIdFoto').bind("change", function(e) {
                 //Ponemos la preview de la foto
                    e.preventDefault();
                               var f = e.target.files[0];
                               if(f && window.FileReader)
                               {
                                   var reader = new FileReader();
                                   reader.onload = function(evt) { jQuery('#preview>img').attr('src', evt.target.result); };
                                   reader.readAsDataURL(f);
                               }
                  })


       },
     bindEditEvents:function() {

         var self=this;
         self.removerBasuraPluginZoom();
		 self.removerBasuraPluginZoom();
		 self.setContext("pedido");
         this.styleForm();
         this.generateValidation();
         this.getForm().ajaxForm({
             beforeSubmit: function () {
                 if (self.isActualFormValid){
                     jQuery(".save").attr("disabled", "disabled");
                     self.addLoader();
                 }else{
                     self.currentStatus="";
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
            self.findInForm=jQuery(this).closest("form");
            translator.getConfiguraciones(self.type,this.value);
        })
        jQuery('.volver').bind("click", function(e) {
                     self.saveTableStatus();

                        if (self.currentStatus=="Search"){
                            translator.search("articulo", jQuery(".formBuscador"));

                        }else{
                            translator.show("articulo");
                        }
                  });
        jQuery('.save').bind("click", function(e) {
            self.currentStatus="Editing";
            self.validateGeneral();
         });
         jQuery('#ArticuloIdFoto').bind("change", function(e) {
                  //Ponemos la preview de la foto
                     e.preventDefault();
                                var f = e.target.files[0];
                                if(f && window.FileReader)
                                {
                                    var reader = new FileReader();
                                    reader.onload = function(evt) { jQuery('#preview>img').attr('src', evt.target.result); };
                                    reader.readAsDataURL(f);
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
           this.currentStatus='Search';
       },

     bindFinderStaticEvents:function() {
         var self=this;
         jQuery('.categoria').bind("change", function(e) {
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
         if(  this.getForm().find('#ArticuloIdMaterial').has('option').length == 0 || this.getForm().find('#ArticuloIdEstilo').has('option').length  == 0 ||
                this.getForm().find('#ArticuloIdDimension').has('option').length  == 0 || this.getForm().find('#ArticuloIdDecorado').has('option').length  ==
                    0 || this.getForm().find('#ArticuloIdObjeto').has('option').length  == 0) {
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
         //Sacamos la imagen
         jQuery('#preview>img').attr('src', "");

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
        this.findInForm.find("#ArticuloIdDecorado").prev("span").empty();

        //Si estamos en el form del buscador,agregamos una opcion vacia a cada uno
        if (self.findInForm.attr('id')=="ArticuloSearchFindForm"){
            self.findInForm.find("#ArticuloIdDecorado").append('<option value=""></option>');
        }
        jQuery.each(data.decorados, function (index, value) {
            self.findInForm.find("#ArticuloIdDecorado").append('<option value="'+value["decorado"]["id"]+'">'+value["decorado"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
        if( this.findInForm.find('#ArticuloIdDecorado').has('option').length > 0 ) {
            var primerOpcionValor=this.findInForm.find('#ArticuloIdDecorado option:first-child').text();
            self.findInForm.find("#ArticuloIdDecorado").prev("span").text(primerOpcionValor);
        }
        //Removemos lo que habia antes
        this.findInForm.find('#ArticuloIdMaterial').find('option').remove()
        this.findInForm.find("#ArticuloIdMaterial").prev("span").empty();

         //Si estamos en el form del buscador,agregamos una opcion vacia a cada uno
         if (self.findInForm.attr('id')=="ArticuloSearchFindForm"){
             self.findInForm.find("#ArticuloIdMaterial").append('<option value=""></option>');
         }

        jQuery.each(data.materiales, function (index, value) {
            self.findInForm.find("#ArticuloIdMaterial").append('<option value="'+value["material"]["id"]+'">'+value["material"]["Nombre"]+'</option>');
        });

         //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( this.findInForm.find('#ArticuloIdMaterial').has('option').length > 0 ) {
             var primerOpcionValor=this.findInForm.find('#ArticuloIdMaterial option:first-child').text();
             this.findInForm.find("#ArticuloIdMaterial").prev("span").text(primerOpcionValor);
         }

         //Removemos lo que habia antes
        this.findInForm.find('#ArticuloIdDimension').find('option').remove()
        this.findInForm.find("#ArticuloIdDimension").prev("span").empty();
         //Si estamos en el form del buscador,agregamos una opcion vacia a cada uno
         if (self.findInForm.attr('id')=="ArticuloSearchFindForm"){
             self.findInForm.find("#ArticuloIdDimension").append('<option value=""></option>');
         }

        jQuery.each(data.dimensiones, function (index, value) {
            self.findInForm.find("#ArticuloIdDimension").append('<option value="'+value["dimension"]["id"]+'">'+value["dimension"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( this.findInForm.find('#ArticuloIdDimension').has('option').length > 0 ) {
             var primerOpcionValor=this.findInForm.find('#ArticuloIdDimension option:first-child').text();
             this.findInForm.find("#ArticuloIdDimension").prev("span").text(primerOpcionValor);
         }

         //Removemos lo que habia antes
        this.findInForm.find('#ArticuloIdObjeto').find('option').remove()
        this.findInForm.find('#ArticuloIdObjeto').prev("span").empty();

        //Si estamos en el form del buscador,agregamos una opcion vacia a cada uno
        if (self.findInForm.attr('id')=="ArticuloSearchFindForm"){
            self.findInForm.find("#ArticuloIdObjeto").append('<option value=""></option>');
        }

        jQuery.each(data.objetos, function (index, value) {
            self.findInForm.find('#ArticuloIdObjeto').append('<option value="'+value["objeto"]["id"]+'">'+value["objeto"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( this.findInForm.find('#ArticuloIdObjeto').has('option').length > 0 ) {
             var primerOpcionValor=this.findInForm.find('#ArticuloIdObjeto option:first-child').text();
             self.findInForm.find('#ArticuloIdObjeto').prev("span").text(primerOpcionValor);
         }

         //Removemos lo que habia antes
        this.findInForm.find('#ArticuloIdEstilo').find('option').remove()
        this.findInForm.find("#ArticuloIdEstilo").prev("span").empty();

        //Si estamos en el form del buscador,agregamos una opcion vacia a cada uno
        if (self.findInForm.attr('id')=="ArticuloSearchFindForm"){
            self.findInForm.find("#ArticuloIdEstilo").append('<option value=""></option>');
        }

        jQuery.each(data.estilos, function (index, value) {
            self.findInForm.find("#ArticuloIdEstilo").append('<option value="'+value["estilo"]["id"]+'">'+value["estilo"]["Nombre"]+'</option>');
        });
        //Si el combo no esta vacio,tengo que escribir en el span que se encuentra arriba el nombre al menos del primer seleccionado(El disenio template,pide eso)
         if( this.findInForm.find('#ArticuloIdEstilo').has('option').length > 0 ) {
             var primerOpcionValor=this.findInForm.find('#ArticuloIdEstilo option:first-child').text();
             self.findInForm.find("#ArticuloIdEstilo").prev("span").text(primerOpcionValor);
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

		mostrarStock = 'S';
		//Si NO se muestra la leyenda de mostrar articulos disponibles, muestra SOLO los Articulos DISPONIBLES
		if ( ! (jQuery("#artDisponibles").attr("value") == "Mostrar Articulos Disponibles") ){
			mostrarStock = 'N';
		}

        for(i=0; i< data.length; i++) {
			//Pregunto si tiene Stock
			conStock = 'S';
			if ((data[i]["_aData"][10] <= 0 || data[i]["_aData"][14] == 'F') ){
				conStock = 'N';
			}
			//Pregunto si muestro SOLO los articulos DISPONiBLES
			if (mostrarStock == 'S' || ( mostrarStock == 'N' && conStock == 'S')){

				var htmlDiv="";
				htmlDiv +='<div class="infoShow">'+data[i]["_aData"][2];

				//Pregunto si tiene stock, sino, no parece el check
				if (data[i]["_aData"][10] <= 0 || data[i]["_aData"][14] == 'F'){
					//ARTICULO NO DISPONIBLE
					htmlDiv +='<div style="position: absolute;margin-top: -115px;margin-left: 15px;"><h4 style="text-align: center;font-size: 14px;color: #C59191;">ARTICULO<BR>TEMPORALMENTE<BR>NO DISPONIBLE</h4></div >'
				}

				console.log(data[i]["_aData"][13]);
				//Si se debe mostrar el selector
				if (data[i]["_aData"][13] == 'S'){
					htmlDiv += '<input type="checkbox" name="option3" class="optionGrande"> ';
				}
				htmlDiv += data[i]["_aData"][1];

	//Preguntamos si estan los botones antes de ponerlos (Por ahi esta conectado un usuario que no le haya venido el boton para usar)
				if (data[i]["_aData"][11])
					htmlDiv +=data[i]["_aData"][11];
				if (data[i]["_aData"][12])
					htmlDiv +=data[i]["_aData"][12];

				htmlDiv +='<B><c style="display:inline;float:right;margin-top:0.0cm;"> '+data[i]["_aData"][10]+'</c></B></div>';
	// 			htmlDiv +='<B><c style="display:inline;float:right;margin-top:0.0cm;"> '+data[i]["_aData"][9]+' ('+ data[i]["_aData"][10]+') </c></B></div>';

				jQuery("#configurationTable").before(htmlDiv);
			}
        }
        //jQuery('.preview').elevateZoom({ zoomType: "inner",cursor: "crosshair" });
        jQuery('.preview').elevateZoom({zoomWindowPosition: 6});



        this.checkElements();
	},
    getSelectedRowId:function(selectedRow) {
        return jQuery(selectedRow).attr('id');
   },
   getArticuloIdFromCheckBoxSelection:function(selectedCheck) {
       return jQuery(selectedCheck).next().attr("id");
   },
   toogleToolbar:function() {

        if (!jQuery.isEmptyObject(this.currentSelectedArticulos)){
                jQuery('.crearPedido').removeAttr("disabled");
                jQuery('.asignarDepo').removeAttr("disabled");
                jQuery('.devolucionArt').removeAttr("disabled");
                jQuery('.deleteArt').removeAttr("disabled");
				jQuery('.comandaArtSel').removeAttr("disabled");
                jQuery('.transferir').removeAttr("disabled");

           }else{
               jQuery('.crearPedido').attr("disabled", "disabled");
               jQuery('.asignarDepo').attr("disabled", "disabled");
               jQuery('.devolucionArt').attr("disabled", "disabled");
               jQuery('.deleteArt').attr("disabled", "disabled");
			   jQuery('.comandaArtSel').attr("disabled", "disabled");
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



