var Render = new Class({
    initialize: function(name){
        this.name = name;
    },
    hacerTablaEditable: function(typeObject){
        $("td").dblclick(function () {
             var OriginalContent = $(this).text();

             $(this).addClass("cellEditing");
             $(this).html("<input type='text' value='" + OriginalContent + "' />");
             $(this).children().first().focus();

             $(this).children().first().keypress(function (e) {
                 if (e.which == 13) {
                     var newContent = $(this).val();
                     var elementIdToEdit=$(this).parent().siblings().first().text();
                     $(this).parent().text(newContent);
                     $(this).parent().removeClass("cellEditing");
                     serverManager.update({
     					object : typeObject,editObject:elementIdToEdit,value:newContent});
                 }
             });

         $(this).children().first().blur(function(){
             $(this).parent().text(OriginalContent);
             $(this).parent().removeClass("cellEditing");
         });
         });
    },

});

render=new Render();