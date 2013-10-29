<?php
	App::import('Model','ConsultasPaginado');

class DecoradosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$this->paginate = array(
			'order' => array('Result.created ASC'),
		     'limit' => 10
		 );
        $this->set('decorados', $this->paginate('Decorado'));
    }

   public function view($id = null) {

   }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Decorado->save($this->request->data)) {
                $this->Session->setFlash('Decorado Guardado con Exito.');
				$this->addRedirect('Decorado');
            }
        }
    }

	function ajaxData() {
			$consultas =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $consultas->getDataConfig('decorados');
	        echo json_encode($output);
	}

	function edit($id = null) {
		$this->Decorado->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Decorado->read();
		} else {
			if ($this->Decorado->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				echo "Ok";
				//$this->redirect(array('action' => 'index'));
			}
		}
	}

	function delete($id) {

	}
}
?>
