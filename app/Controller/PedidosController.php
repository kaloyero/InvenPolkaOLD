<?php
class PedidosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('pedidos', $this->Pedido->find('all'));
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
