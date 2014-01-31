<?php

	App::import('Model','ConsultasSelect');
	App::import('Model','ConsultasPaginado');	

class InventariosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$consultas =new ConsultasSelect();		
		//Lista de proyectos
		$this->set('proyectos',$consultas->getProyectos());				
			
		//FILTRO
		$filtro = $_GET['isSearch'];
		if ($filtro !='undefined' ) {
			//Seteo el filtro
			$this->Session->write("filtroInventario",$filtro);
//			$this->Session->write("filtroInventario","DEPOSITO");
			if ($filtro != "DEPOSITO"){
				//seteo que en el combo el proyecto seleccionado
				$this->request->data['Inventario']['IdProyecto'] = $filtro;
			}
		} else {
			//Reseteo el buscador
			$this->Session->write("filtroInventario","");
		}
		
		
    }

	function ajaxData() {
		//Obtengo de la SESSION el proyecto o deposito por el cual voy a 
		$filtroProy = $this->Session->read("filtroInventario");
		$paginado =new ConsultasPaginado();
		$this->autoRender = false;
		$output = $paginado->getDataInventarios($filtroProy);
		echo json_encode($output);

	}

   public function view($id = null) {
        $this->Inventario->id = $id;
        $this->set('inventario', $this->Inventario->read());
   }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Inventario->save($this->request->data)) {
                $this->redirect(array('action' => 'index'));
            }
        } else {
			$this->setViewData();
		}

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
