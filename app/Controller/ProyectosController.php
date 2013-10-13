<?php
class ProyectosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('proyectos', $this->Proyecto->find('all'));
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
