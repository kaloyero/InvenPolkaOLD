<?php
App::import('Model','ConsultasPaginado');

class ProyectosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$this->paginate = array(
				'order' => array('Result.created ASC'),
			     'limit' => 10
		 );
        $this->set('proyectos', $this->paginate('Proyecto'));
    }


   public function view($id = null) {
        $this->Proyecto->id = $id;
        $this->set('proyecto', $this->Proyecto->read());
   }
	function ajaxData() {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataProyectos();
	        echo json_encode($output);
	}

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Proyecto->save($this->request->data)) {
                $this->render('/General/Success');
        	}else{
				$this->render('/General/Error');
			}
        }
    }

	function edit($id = null) {
		$this->Proyecto->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Proyecto->read();
		} else {
			if ($this->Proyecto->save($this->request->data)) {
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
