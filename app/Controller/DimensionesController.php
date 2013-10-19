<?php
class DimensionesController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('dimensiones', $this->Dimensione->find('all'));
    }	

   public function view($id = null) {

   }	
   
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Dimensione->save($this->request->data)) {
                $this->Session->setFlash('Dimension Guardada con Exito.');
				$this->addRedirect('Dimensione');
            }
        }
    }

	function edit($id = null) {
		$this->Dimensione->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Dimensione->read();
		} else {
			if ($this->Dimensione->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				$this->redirect(array('action' => 'index'));
			}
		}
	}	

	function delete($id) {

	}
}
?>
