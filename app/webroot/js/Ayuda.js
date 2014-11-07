var Ayuda = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type="ayuda";
        this.breadcrumb='Ayudas';
        this.descripcion="Ayuda"
    },

    bindListEvents:function() {
		
		var self=this;
		this.parent();
		jQuery(".ayudaCont").on("click", function() {
			alert("asd");
			var id = jQuery(this).data("section");
			alert(id);
			jQuery("section:visible").fadeOut(function() {
				jQuery(id).fadeIn();
			});
		});

     },
    bindEditEvents:function() {

		var self=this;
		this.parent();
        jQuery('#UsuarioTipoRol').bind("change", function(e) {
			//Pregunta si es usuario 'arte' (id 3 en la base de datos)
			if (jQuery('#UsuarioTipoRol').val() == 3){
				jQuery('#proyectoId').removeAttr("disabled");
				jQuery('#proyectoId').attr("required", "required");
			} else {
				jQuery('#proyectoId').attr("disabled", "disabled");
				jQuery('#proyectoId').removeAttr("required");
			}
              return false;
         });

     },



});
ayudaRender=new Ayuda()