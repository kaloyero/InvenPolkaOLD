<?php
class MovimientoDetalleInventariosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('detalles', $this->MovimientoDetalleInventario->find('all'));
    }	

   public function view($id = null) {

   }	
   
    public function add() {

    }

	function edit($id = null) {

	}	

	function delete($id) {

	}
}
?>
