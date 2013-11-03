<?php
	App::import('Model','ConsultasPaginado');

class EstilosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$this->paginate = array(
			'order' => array('Result.created ASC'),
		     'limit' => 10
		 );
        $this->set('estilos', $this->paginate('Estilo'));
    }

   public function view($id = null) {

   }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Estilo->save($this->request->data)) {
                $this->Session->setFlash('Estilo Guardada con Exito.');
				$this->addRedirect('Estilo');
            }
        }
    }

	function ajaxData() {
			$consultas =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $consultas->getDataConfig('estilos');
	        echo json_encode($output);
	}

	function edit($id = null) {
		$this->Estilo->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Estilo->read();
		} else {
			if ($this->Estilo->save($this->request->data)) {
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
