var Inventario = new Class({
    Extends: Render,
    initialize: function(name){
        this.name = name;
        this.type='inventario';
        this.breadcrumb='Inventarios';
        this.descripcion="Desde aqui administre el Inventario"
    },
    bindListEvents:function() {
          var self=this;
		  this.parent();

          jQuery('.deleteArt').bind("click", function(e) {
				translator.addMovimiento("movimientoInventario",self.getDataToSendInJsonFormat(),"darDeBajaArticulos");
               	return false;
          })
          jQuery('.filtroDepo').bind("change", function(e) {
				alert("filtra deposito");
               	return false;
          })

        },
    onUpdated: function(data){
            this.parent();
            translator.show(this.type);
    },

});

inventarioRender=new Inventario()
