<?php
class InventariosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('inventarios', $this->Inventario->find('all'));
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
