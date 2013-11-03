<?php
	App::import('Model','ConsultasPaginado');

class MaterialesController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$this->paginate = array(
			'order' => array('Result.created ASC'),
		     'limit' => 10
		 );
        $this->set('materiales', $this->paginate('Materiale'));
    }

   public function view($id = null) {

   }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Materiale->save($this->request->data)) {
                $this->Session->setFlash('Material Guardado con Exito.');
				$this->addRedirect('Materiale');
            }
        }

    }

	function ajaxData() {
			$consultas =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $consultas->getDataConfig('materiales');
	        echo json_encode($output);
	}

	function edit($id = null) {
		$this->Materiale->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Materiale->read();
		} else {
			if ($this->Materiale->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				$this->redirect(array('action' => 'index'));
				echo "Ok";
			}
		}
	}

	function delete($id) {

	}
}
?>
