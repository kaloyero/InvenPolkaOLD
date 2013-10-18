<?php

    App::import('Model','Articulo');
	App::import('Model','Deposito');
	App::import('Model','Ubicacione');
	App::import('Model','Proyecto');

class InventariosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('inventarios', $this->Inventario->find('all'));
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
		$this->set('articulos',$this->getArticulos());
		$this->set('depositos',$this->getDepositos());
		$this->set('ubicaciones',$this->getUbicaciones());
		$this->set('proyectos',$this->getProyectos());
	}
	
	function getArticulos() {
		$articulo=new Articulo();
		$articulos=$articulo->find('list',array('fields'=>array('Articulo.id','Articulo.CodigoArticulo')));
		return $articulos;
	}
	function getDepositos() {
		$deposito=new Deposito();
		$depositos=$deposito->find('list',array('fields'=>array('Deposito.id','Deposito.Nombre')));
		return $depositos;
	}
	function getUbicaciones() {
		$ubicacione=new Ubicacione();
		$ubicaciones=$ubicacione->find('list',array('fields'=>array('Ubicacione.id','Ubicacione.CodigoUbicacion')));
		return $ubicaciones;
	}
	function getProyectos() {
		$proyecto=new Proyecto();
		$proyectos=$proyecto->find('list',array('fields'=>array('Proyecto.id','Proyecto.Nombre')));
		return $proyectos;
	}


}
?>
