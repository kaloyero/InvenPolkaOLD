<?php
class DepositosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('depositos', $this->Deposito->find('all'));
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
