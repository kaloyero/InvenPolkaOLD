<?php
	App::import('Model','ConsultasPaginado');

class ObjetosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$this->paginate = array(
			'order' => array('Result.created ASC'),
		     'limit' => 10
		 );
        $this->set('objetos', $this->paginate('Objeto'));
    }

   public function view($id = null) {

   }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Objeto->save($this->request->data)) {
                $this->Session->setFlash('Tipo de objeto Guardado con Exito.');
				$this->addRedirect('Objeto');
            }
        }

    }

	function ajaxData() {
			$consultas =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $consultas->getDataConfig('objetos');
	        echo json_encode($output);
	}

	function edit($id = null) {
		$this->Objeto->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Objeto->read();
		} else {
			if ($this->Objeto->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				//$this->redirect(array('action' => 'index'));
				echo "Ok";
			}
		}

	}

	function delete($id) {

	}
}
?>
