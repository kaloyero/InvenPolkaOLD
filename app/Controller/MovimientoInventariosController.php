<?php
class MovimientoInventariosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('movimientos', $this->MovimientoInventario->find('all'));
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
