var RenderConfiguracion = new Class({
    initialize: function(name){
        this.name = name;
    },
    hacerTablaEditable: function(){
        var self=this;
        jQuery("td").dblclick(function () {
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
                     serverManager.updateConfigurations({
     					object : self.type,editObject:elementIdToEdit,value:newContent});
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
        return jQuery("form");
    },
    onList: function(data){
           this.cleanCanvas();
           jQuery(".contentinner").append(data);
           this.bindListEvents();
           jQuery('#browserList').dataTable({
                       "bProcessing": true,
                       "bServerSide": true,
                       "bPaginate": true,
                       "sPaginationType": "full_numbers",
                       "sAjaxSource": "categorias/ajaxData",
                       "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                           console.log("DATa",arguments)
                       },
                       "fnInitComplete": function(oSettings, json) {
                             console.log("ARGUU",arguments)
                           },


                   });

      },
    onAdd: function(data){
        this.cleanCanvas();
        jQuery(".contentinner").append(data);
        // Transform upload file
        jQuery('.uniform-file').uniform();
        this.bindAddEvents();
         },
    onUpdated: function(data){
           alert("Actualizado!")
       },

    bindListEvents:function() {
           var self=this;

        	jQuery('#add').bind("click", function(e) {
        	    translator.add(self.type);
           })
           jQuery('.edit').bind("click", function(e) {
               console.log("DATaaa",self.getSelectedRowId(this))
               translator.view(self.type,self.getSelectedRowId(this));

               return false;
       	    //translator.view(self.type);
          })

          	jQuery('.save').bind("click", function(e) {
          		translator.save(self.type, self.getForm());
				this.cleanCanvas();
				//Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
				return false;
			});		  
        },
    bindAddEvents:function() {
          var self=this;
          jQuery('.save').bind("click", function(e) {
          translator.save(self.type, self.getForm());
         //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
         return false;
         });
     },
     bindEditEvents:function() {
         var self=this;
         jQuery('.edit').bind("click", function(e) {
             translator.update(self.type, self.getForm());
             //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
            return false;
             });
         },
      getSelectedRowId:function(selectedRow) {
          return jQuery(selectedRow).parent().parent().find(":first" ).text()
      }

});

renderConfiguracion=new RenderConfiguracion();