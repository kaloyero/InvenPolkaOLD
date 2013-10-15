<?php
class ProyectosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('proyectos', $this->Proyecto->find('all'));
    }	

   public function view($id = null) {
        $this->Proyecto->id = $id;
        $this->set('proyecto', $this->Proyecto->read());
   }	
   
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Proyecto->save($this->request->data)) {
                $this->Session->setFlash('Proyecto Guardado');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

	function edit($id = null) {
		$this->Proyecto->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Proyecto->read();
		} else {
			if ($this->Proyecto->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				$this->redirect(array('action' => 'index'));
			}
		}
	}	

	function delete($id) {

	}
}
?>
