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
				if ($this->request->data['Decorado']['RedirectAction'] == 'siguiente'){
					$this->redirect(array('action' => 'add'));
				} else {
					$this->redirect(array('action' => 'index'));
				}

            }
        }
    }

	function edit($id = null) {
		$this->Decorado->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Decorado->read();
		} else {
			if ($this->Decorado->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				$this->redirect(array('action' => 'index'));
			}
		}
	}	

	function delete($id) {

	}
}
?>
