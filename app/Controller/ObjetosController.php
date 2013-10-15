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
				if ($this->request->data['Objeto']['RedirectAction'] == 'siguiente'){
					$this->redirect(array('action' => 'add'));
				} else {
					$this->redirect(array('action' => 'index'));
				}

            }
        }

    }

	function edit($id = null) {
		$this->Objeto->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Objeto->read();
		} else {
			if ($this->Objeto->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				$this->redirect(array('action' => 'index'));
			}
		}

	}	

	function delete($id) {

	}
}
?>
