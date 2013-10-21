<?php
class EstudiosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
        $this->set('estudios', $this->Estudio->find('all'));
    }

   public function view($id = null) {
        $this->Estudio->id = $id;
        $this->set('estudio', $this->Estudio->read());
        $this->Session->setFlash($this->Estudio->read());
   }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Estudio->save($this->request->data)) {
                $this->Session->setFlash('Estudio Guardado con Exito.');
                $this->redirect(array('action' => 'index'));
            }
        } else {



		}

    }

	function edit($id = null) {
		$this->Estudio->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Estudio->read();
		} else {
			if ($this->Estudio->save($this->request->data)) {
				$this->Session->setFlash('Los cambios se han guardado con exito');
				$this->redirect(array('action' => 'index'));
			}
		}

	}

	function delete($id) {

	}
}
?>
