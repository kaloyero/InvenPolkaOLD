<?php
class UbicacionesController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('ubicaciones', $this->Ubicacione->find('all'));
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
