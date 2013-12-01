var Render = new Class({
    initialize: function(name){
        this.name = name;
    },
    hacerTablaEditable: function(){
        var self=this;
        jQuery('table tr td:not(:last-child)').dblclick(function () {
             var OriginalContent = jQuery(this).text();

             jQuery(this).addClass("cellEditing");
             jQuery(this).html("<input type='text' value='" + OriginalContent + "' />");
             jQuery(this).children().first().focus();

             jQuery(this).children().first().keypress(function (e) {
                 if (e.which == 13) {
                     var newContent = jQuery(this).val();
                     var elementIdToEdit=jQuery(this).parent().siblings().first().text();
                     jQuery(this).parent().text(newContent);
                     jQuery(this).parent().removeClass("cellEditing");
                     self.addLoader();
                     translator.updateConfigurations(self.type,elementIdToEdit,newContent);
                 }
             });

         jQuery(this).children().first().blur(function(){
             jQuery(this).parent().text(OriginalContent);
             jQuery(this).parent().removeClass("cellEditing");
         });
         });
    },
    cleanCanvas: function(){
          jQuery(".contentinner").empty();
    },
    getForm: function(){
        return jQuery(".stdform");
    },
    onList: function(data){
           var self=this;
           this.cleanCanvas();
           jQuery(".contentinner").append(data);
           this.makeDatatable();
		   this.bindListEvents();
           this.drawHeader();
	},
    onAdd: function(data){
        this.cleanCanvas();
        jQuery(".contentinner").append(data);
        //jQuery("#DepositoAddForm").validate();
        // Transform upload file
        jQuery('.uniform-file').uniform();
    	//Inicializo calendario
     	jQuery('.datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
        this.bindAddEvents();
         },
    onView: function(data){
        this.cleanCanvas();
        jQuery(".contentinner").append(data);
        // Transform upload file
        jQuery('.uniform-file').uniform();
        this.bindEditEvents();
    },
    onUpdated: function(data){
            this.removeLoader();
       },
    onSaved: function(data){
             this.checkContinue();
             this.removeLoader();
      },
    //SIRVE ESTO?Que ahora casi todo depende de cuando termine de carga la tabla
    bindListEvents:function() {
           var self=this;
        	jQuery('#add').bind("click", function(e) {
        	    translator.add(self.type);
           })
           jQuery('.edit').bind("click", function(e) {
               translator.view(self.type,self.getSelectedRowId(this));

               return false;
       	    //translator.view(self.type);
          })
        },
    bindAddEvents:function() {
          var self=this;
          this.styleForm();
          this.generateValidation();

          jQuery('.save').bind("click", function(e) {
              //Si pasa la validacion,salvamos
              if (self.getForm().valid()){

                   translator.save(self.type, self.getForm());
                    self.addLoader();
              }
              //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
              return false;
         });

         //Agregamos los calendar
          jQuery('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
     },

     bindEditEvents:function() {
         var self=this;
         this.styleForm();
         this.generateValidation();
         jQuery('.edit').bind("click", function(e) {
             if (self.getForm().valid()){
                 translator.update(self.type, self.getForm());
                 self.addLoader();
            }
            //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
            return false;
             });
          //Agregamos los Calendar
         jQuery('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
         },
      getSelectedRowId:function(selectedRow) {
          return jQuery(selectedRow).parent().parent().parent().parent().find(":first" ).text()
      },
      styleForm:function() {
          this.getForm().find('input:checkbox, input:radio, select.uniformselect').uniform();
        },
      addLoader:function() {
           jQuery('.stdformbutton').append('<img src="/invenPolka/app/webroot/files/gif/16.GIF" class ="loader" alt="CakePHP" height="50px" width="50px">');

      },
      removeLoader:function() {
          jQuery('.loader').remove();
       },
       makeDatatable:function() {
           var self=this;
            var oTable=   jQuery('#configurationTable').dataTable({
                           "bProcessing": true,
                           "bServerSide": true,
                           "bPaginate": true,
                           "sPaginationType": "full_numbers",
                           "sAjaxSource": serverManager.services[this.type]["controllerName"]+"/ajaxData",
/*							"oLanguage": {
								"sUrl": "dataTables.german.txt"
							},
*/
                           "oLanguage": {
									"sProcessing":     	"Procesando...",
                                    "sSearch": 			"Busqueda:",
									"sLengthMenu":     	"Mostrar _MENU_ registros",
									"sZeroRecords":    	"No se encontraron resultados",
									"sEmptyTable":     	"Ningún dato disponible en esta tabla",
									"sInfo": 			"Mostrando _START_ hasta _END_ de un total de  _TOTAL_ registros",
									"sInfoEmpty":      	"Mostrando registros del 0 al 0 de un total de 0 registros",
									"sInfoFiltered":   	"(filtrado de un total de _MAX_ registros)",
									"sLoadingRecords": "Cargando...",
                                    "oPaginate": {
                                            "sNext": "Proxima",
                                            "sFirst": "Primera",
                                            "sLast": "Ultima",
                                            "sPrevious": "Previo"

                                          }
                                  },

                                  "fnPreDrawCallback": function( nRow, aData, iDisplayIndex ) {

                                  },
                                   "fnCreatedRow": function( nRow, aData, iDisplayIndex ) {
                                        //jQuery("tr").remove();
                                        //jQuery(nRow).remove();
                                       // nRow.
                                    },
                                    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                                            //jQuery("tr").remove();
                                            //jQuery(nRow).addClass('row_selected')

                                        },
                            //Este CallBack se ejecuta cuando esta lista la tabla
                           "fnDrawCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
							   self.afterDataTable(nRow.aoData);
                           }
                       });
       // oTable.fnSetColumnVis( 0, false );
          },
     drawHeader:function() {
         jQuery('.headerBig').empty();
         jQuery('.headerBig').append(this.breadcrumb);
         jQuery('.headerDescription').empty();
         jQuery('.headerDescription').append(this.descripcion);
         jQuery('.activeBreadcrum').empty();
         jQuery('.activeBreadcrum').append(this.breadcrumb);

     },
     isConfigurationTable:function() {
        if (this.type=="categoria"||this.type=="material"||this.type=="estilo"||this.type=="objeto"||this.type=="dimension"||this.type=="decorado")  {
            return true;
        }
        return false;
      },
      checkContinue:function() {
          if (jQuery('.seguir').length >0 ){
            if (jQuery('.seguir').is(':checked')) {
                //Limpio el Form
                jQuery('.stdform')[0].reset();
                //Ponemos el foco en el primer input
                jQuery(".stdform input:text").first().focus();

            }else{
               translator.show(this.type);
              //llamo al listado correspondiente
            }
        }
      },
      setValidationMessage:function(){
             jQuery.validator.messages.required = "El siguiente campo es necesario!";
        },
      afterDataTable:function(){
          var self=this;
            jQuery('.edit').bind("click", function(e) {
				   translator.view(self.type,self.getSelectedRowId(this));
				   return false;
			  })
			 //Ocultamos la columna ID
             jQuery("#configurationTable td:first-child").css('display','none');

             if (self.isConfigurationTable())
    			    self.hacerTablaEditable();
    	},
      generateValidation:function(){
          this.getForm().validate({
                  errorLabelContainer: "#message_box", wrapper: "li"
              });

          this.setValidationMessage();
      }


});

render=new Render();