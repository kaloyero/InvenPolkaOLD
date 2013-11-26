<?php

	App::import('Model','ConsultasSelect');
	App::import('Model','ConsultasPaginado');	

class InventariosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
    }


   public function view($id = null) {
        $this->Inventario->id = $id;
        $this->set('inventario', $this->Inventario->read());
   }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Inventario->save($this->request->data)) {
                $this->Session->setFlash('Inventario Guardado');
                $this->redirect(array('action' => 'index'));
            }
        } else {
			$this->setViewData();
		}

    }

	function ajaxData() {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataInventarios();
	        echo json_encode($output);
	}


	function edit($id = null) {
		$this->Inventario->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Inventario->read();
			$this->setViewData();
		} else {
			if ($this->Inventario->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				$this->redirect(array('action' => 'index'));
			}else{
					$this->setViewData();
			}

		}
	}

	function delete($id) {

	}

	function setViewData() {
		$consultas = new ConsultasSelect();
		$this->set('articulos',$consultas->getArticulos());
		$this->set('depositos',$consultas->getDepositos());
		$this->set('proyectos',$consultas->getProyectos());
	}

}
?>
