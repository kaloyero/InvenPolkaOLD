<?php

	App::import('Model','Proyecto');
	App::import('Model','Articulo');
	App::import('Model','Deposito');
	App::import('Model','Ubicacione');
	App::import('Model','MovimientoDetalleInventario');

class MovimientoInventariosController extends AppController {
    
    public $helpers = array ('Html','Form');
	var $uses = array('MovimientoInventario','MovimientoDetalleInventario');

    function index() {
        $this->set('movimientos', $this->MovimientoInventario->find('all'));
    }	

   public function view($id = null) {
        $this->MovimientoInventario->id = $id;
        $this->set('movimiento', $this->MovimientoInventario->read());
   }	
   
    public function add() {
        if ($this->request->is('post')) {
            if ($this->MovimientoInventario->save($this->request->data)) {
				$this->agregarDetalles();
                $this->Session->setFlash('Movimiento Guardado');
                $this->redirect(array('action' => 'index'));
            }
        } else {
			$this->setViewData();
		}

    }

	function edit($id = null) {
		$this->MovimientoInventario->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->MovimientoInventario->read();
			$this->setViewData();			
		} else {
			if ($this->MovimientoInventario->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				$this->redirect(array('action' => 'index'));
			}else{
				$this->setViewData();
			}

		}		
	}	

	function delete($id) {

	}

	private function agregarDetalles() {
		$idInsertedMovimiento = $this->MovimientoInventario->getInsertID();
		$listDetalle = array ($this->request->data['Detalle']);
		foreach ($listDetalle as &$detalle) {
			foreach ($detalle as &$det) {
				$MovDetalle=new MovimientoDetalleInventario();
				$MovDetalle= array('IdMovimientoInventario' => $idInsertedMovimiento,
									  'IdArticulo' => $det['IdArticulo'],
									  'Cantidad' => $det['Cantidad']);
				$this->MovimientoDetalleInventario->saveall($MovDetalle);
			}
		}
	}
	
	private function setViewData() {
		$this->set('proyectos',$this->getProyectos());
		$this->set('articulos',$this->getArticulos());		
		$this->set('depositos',$this->getDepositos());
		$this->set('ubicaciones',$this->getUbicaciones());
	}
	
	private function getProyectos() {
		$proyecto=new Proyecto();
		$proyectos=$proyecto->find('list',array('fields'=>array('Proyecto.id','Proyecto.Nombre')));
		return $proyectos;
	}

	private function getUbicaciones() {
		$ubicacione=new Ubicacione();
		$ubicaciones=$ubicacione->find('list',array('fields'=>array('Ubicacione.id','Ubicacione.CodigoUbicacion','Ubicacione.Descripcion')));
		return $ubicaciones;
	}

	private function getDepositos() {
		$deposito=new Deposito();
		$depositos=$deposito->find('list',array('fields'=>array('Deposito.id','Deposito.Nombre')));
		return $depositos;
	}

	private function getArticulos() {
		$articulo=new Articulo();
		$articulos=$articulo->find('list',array('fields'=>array('Articulo.id','Articulo.Codigoarticulo')));
		return $articulos;
	}
	
	
}
?>
