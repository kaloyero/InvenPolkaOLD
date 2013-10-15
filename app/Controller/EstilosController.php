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
				if ($this->request->data['Estilo']['RedirectAction'] == 'siguiente'){
					$this->redirect(array('action' => 'add'));
				} else {
					$this->redirect(array('action' => 'index'));
				}

            }
        }
    }

	function edit($id = null) {
		$this->Estilo->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Estilo->read();
		} else {
			if ($this->Estilo->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				$this->redirect(array('action' => 'index'));
			}
		}	
	}	

	function delete($id) {

	}
}
?>
