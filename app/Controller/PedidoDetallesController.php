<?php
class PedidoDetallesController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('pedidodetalles', $this->PedidoDetalle->find('all'));
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
