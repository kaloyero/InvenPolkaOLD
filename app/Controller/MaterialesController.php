<?php
class MaterialesController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('materiales', $this->Materiale->find('all'));
    }	

   public function view($id = null) {

   }	
   
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Materiale->save($this->request->data)) {
                $this->Session->setFlash('Material Guardada con Exito.');
                $this->redirect(array('action' => 'index'));
            }
        }

    }

	function edit($id = null) {

	}	

	function delete($id) {

	}
}
?>
