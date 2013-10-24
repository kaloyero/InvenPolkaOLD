<?php
class EstudiosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		//Si la session tiene cargada la variable estudios,viene de un redireccionamiento,si no,se pidio el listado completo
		if ($this->Session->check("estudios")){
			$this->paginate = array(
				 'conditions' => $this->Session->read("estudios"),
				 'order' => array('Result.created ASC'),
				 'limit' => 5
			 );
			$this->set("estudios",$this->paginate('Estudio'));
			$this->Session->delete("estudios");
		}else{
				//paginate as normal
				$this->paginate = array(
					'order' => array('Result.created ASC'),
					 'limit' => 10
				 );
			//$this->set("estudios",$this->Estudio->find('all'));
			$this->set("estudios",	$this->paginate('Estudio'));

		}
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
