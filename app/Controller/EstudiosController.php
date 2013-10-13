<?php
class EstudiosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('estudios', $this->Estudio->find('all'));
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
