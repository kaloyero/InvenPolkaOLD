<?php
class DecoradosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('decorados', $this->Decorado->find('all'));
    }	

   public function view($id = null) {

   }	
   
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Decorado->save($this->request->data)) {
                $this->Session->setFlash('Decorado Guardado con Exito.');
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
