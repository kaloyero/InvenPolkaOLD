var Material = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="material";
    },
    onList: function(data){
            this.parent(data);
            this.hacerTablaEditable();
            this.oTable = jQuery('#browserList').dataTable({
                       "bProcessing": true,
                       "bServerSide": true,
                       "bPaginate": true,
                       "sPaginationType": "full_numbers",
                       "sAjaxSource": "materiales/ajaxData",
                       "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                           console.log("DATa",arguments)
                       },
                       "fnInitComplete": function(oSettings, json) {
                             console.log("ARGUU",arguments)
                           },
                   });


    },
    bindListEvents:function() {
			var self=this;
          	jQuery('.save').bind("click", function(e) {
          		translator.save(self.type, self.getForm());
				//limpio el formulario
				jQuery(".input-medium").val("");
				//Actualizo la tabla en la pagina en q esta
				jQuery('.paginate_active').click();
				jQuery.growlUI('Growl Notification', 'Have a nice day!'); 
				//Este false,hace que el form,no se submitee sin Ajax,osea,de la accion propia del boton submit
				return false;
			});			
    },
});

materialRender=new Material();