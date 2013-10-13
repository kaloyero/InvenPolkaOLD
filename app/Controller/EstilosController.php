<?php
class EstilosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('estilos', $this->Estilo->find('all'));
    }	

   public function view($id = null) {

   }	
   
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Estilo->save($this->request->data)) {
                $this->Session->setFlash('Estilo Guardada con Exito.');
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
