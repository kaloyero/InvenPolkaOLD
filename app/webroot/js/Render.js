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
                     serverManager.update({
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
    bindListEvents:function() {
           var self=this;
        	jQuery('#add').bind("click", function(e) {
        	    translator.add(self.type);
           })
        },
    bindAddEvents:function() {
          var self=this;
          jQuery('.save').bind("click", function(e) {
          translator.save(self.type, self.getForm());
         //Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
         return false;
         });
     }

});

render=new Render();