var Render = new Class({
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

      },
    onAdd: function(data){
        this.cleanCanvas();
        jQuery(".contentinner").append(data);
        // Transform upload file
        jQuery('.uniform-file').uniform();
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
        },
    bindAddEvents:function() {
          var self=this;
          this.styleForm();
          jQuery('.save').bind("click", function(e) {
          translator.save(self.type, self.getForm());
         //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
         return false;
         });
     },
     bindEditEvents:function() {
         var self=this;
         this.styleForm();
         jQuery('.edit').bind("click", function(e) {
             translator.update(self.type, self.getForm());
             //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
            return false;
             });
         },
      getSelectedRowId:function(selectedRow) {
          return jQuery(selectedRow).parent().parent().find(":first" ).text()
      },
      styleForm:function() {
          jQuery('input:checkbox, input:radio, select.uniformselect').uniform();
        },


});

render=new Render();