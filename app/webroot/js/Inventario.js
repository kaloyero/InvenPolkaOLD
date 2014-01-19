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
  			    translator.showWithParam("inventario",jQuery('.filtroDepo').val());
               	return false;
          })

          jQuery('.filtroDeposito').bind("click", function(e) {
  			    if (jQuery('#checkFiltro').attr('checked')){
					translator.showWithParam("inventario","DEPOSITO");
				} else {
					translator.show("inventario");
				}

               	return false;
          })

        },
    onUpdated: function(data){
            this.parent();
            translator.show(this.type);
    },

});

inventarioRender=new Inventario()
