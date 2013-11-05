<?php
App::import('Model','ConsultasPaginado');

class EstudiosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$this->paginate = array(
				'order' => array('Result.created ASC'),
			     'limit' => 10
		 );
        $this->set('estudios', $this->paginate('Estudio'));


    }

   public function view($id = null) {
        $this->Estudio->id = $id;
        $this->set('estudio', $this->Estudio->read());
        $this->Session->setFlash($this->Estudio->read());
   }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Estudio->save($this->request->data)) {
               	$this->render('/General/Success');
        	}else{
				$this->render('/General/Error');
			}
        }

    }
	function ajaxData() {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataEstudios();
	        echo json_encode($output);
	}


	function edit($id = null) {
		$this->Estudio->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Estudio->read();
		} else {
			if ($this->Estudio->save($this->request->data)) {
				$this->render('/General/Success');
        	}else{
				$this->render('/General/Error');
			}
		}

	}

	function delete($id) {

	}
}
?>
