<?php
class ObjetosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('objetos', $this->Objeto->find('all'));
    }	

   public function view($id = null) {

   }	
   
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Objeto->save($this->request->data)) {
                $this->Session->setFlash('Tipo de objeto Guardado con Exito.');
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
