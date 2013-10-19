<?php

	App::import('Model','Proyecto');
	App::import('Model','Articulo');
	App::import('Model','Deposito');
	App::import('Model','Ubicacione');
	App::import('Model','Estudio');	
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
			$tipoMovi = $this->request->data['MovimientoInventario']['TipoMovimiento'];
			$this->addValidationMov($tipoMovi);
            if ($this->MovimientoInventario->save($this->request->data)) {
				$this->agregarDetalles($tipoMovi);
                $this->Session->setFlash('Movimiento Guardado');
                $this->redirect(array('action' => 'index'));
            }
        } else {
			$this->setViewData();
		}

    }

    private function addValidationMov($tipoMovi) {
		if ($tipoMovi == 'P'){
			$this->request->data['MovimientoInventario']['IdDepositoDest'] = null;
		} else if ($tipoMovi  == 'D'){
			$this->request->data['MovimientoInventario']['IdDepositoDest'] = null;
		} else if ($tipoMovi  == 'I'){		
			$this->request->data['MovimientoInventario']['IdDepositoDest'] = null;
			$this->request->data['MovimientoInventario']['IdEstudio'] = null;
			$this->request->data['MovimientoInventario']['IdProyecto'] = null;
		} else if ($tipoMovi == 'B'){		
			$this->request->data['MovimientoInventario']['IdDepositoDest'] = null;
			$this->request->data['MovimientoInventario']['IdEstudio'] = null;
			$this->request->data['MovimientoInventario']['IdProyecto'] = null;
		} else if ($tipoMovi  == 'T'){
			$this->request->data['MovimientoInventario']['IdEstudio'] = null;
			$this->request->data['MovimientoInventario']['IdProyecto'] = null;
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

	private function agregarDetalles($tipoMovi) {
		$idInsertedMovimiento = $this->MovimientoInventario->getInsertID();
		$listDetalle = array ($this->request->data['Detalle']);
		foreach ($listDetalle as &$detalle) {
			foreach ($detalle as &$det) {
			$det = $this->addValidationMovDetalle($det,$tipoMovi);

				$MovDetalle=new MovimientoDetalleInventario();
				$MovDetalle= array('IdMovimientoInventario' => $idInsertedMovimiento,
									  'IdArticulo' => $det['IdArticulo'],
									  'Cantidad' => $det['Cantidad'],
									  'IdUbicacionOrig' => $det['IdUbicacionOrig'],
									  'IdUbicacionDest' => $det['IdUbicacionDest'],
									  'IdProyectoDetalle' => $det['IdProyectoDetalle']);
				$this->MovimientoDetalleInventario->saveall($MovDetalle);
			}
		}
	}
    private function addValidationMovDetalle($det,$tipoMovi) {
		$det['IdProyectoDetalle'] = null;
		if ($tipoMovi != 'T'){
			$det['IdUbicacionDest'] = null;
		} 
		return $det;
	}

	
	private function setViewData() {
		$this->set('proyectos',$this->getProyectos());
		$this->set('articulos',$this->getArticulos());		
		$this->set('depositos',$this->getDepositos());
		$this->set('ubicaciones',$this->getUbicaciones());
		$this->set('estudios',$this->getEstudios());		
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

	private function getEstudios() {
		$estudio=new Estudio();
		$estudios=$estudio->find('list',array('fields'=>array('Estudio.id','Estudio.Nombre')));
		return $estudios;
	}
	
}
?>
