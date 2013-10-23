<?php

	App::import('Model','ConsultasSelect');
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
		$consultasSelect = new ConsultasSelect();
		$this->set('proyectos',$consultasSelect->getProyectos());
		$this->set('articulos',$consultasSelect->getArticulos());		
		$this->set('depositos',$consultasSelect->getDepositos());
		$this->set('ubicaciones',$consultasSelect->getUbicacionesByDeposito(1));
		$this->set('estudios',$consultasSelect->getEstudios());		
	}
	


   function getUbicacionesByDeposito($id = null) {
		$model=new Ubicacione();
		$ubicaciones = $model->find('list', array('fields' => array('Ubicacione.id','Ubicacione.CodigoUbicacion'),
        'conditions' => array('Ubicacione.IdDeposito =' => $id)));
		return $ubicaciones;
   }
	
}
?>
