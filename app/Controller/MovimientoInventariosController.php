<?php

	App::import('Model','ConsultasSelect');
	App::import('Model','ConsultasPaginado');	
	App::import('Model','MovimientoDetalleInventario');

class MovimientoInventariosController extends AppController {
    
    public $helpers = array ('Html','Form');
	var $uses = array('MovimientoInventario','MovimientoDetalleInventario');

    function index() {
		//Si la session tiene cargada la variable articulos,viene de un redireccionamiento,si no,se pidio el listado completo
		if ($this->Session->check("movimientos")){
			$this->paginate = array(
				 'conditions' => $this->Session->read("movimientoss"),
				 'order' => array('Result.created ASC'),
				 'limit' => 5
			 );
			$this->set("movimientos",$this->paginate('MovimientoInventario'));
			$this->Session->delete("movimientos");
		}else{
				//paginate as normal
				$this->paginate = array(
					'order' => array('Result.created ASC'),
					 'limit' => 10
				 );
			//$this->set("articulos",$this->Articulo->find('all'));
			$this->set("movimientos",	$this->paginate('MovimientoInventario'));

		}

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

	function ajaxData() {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataMovimientos();
	        echo json_encode($output);
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
									  'IdPedidoDetalle' => $det['IdPedidoDetalle']);
				$this->MovimientoDetalleInventario->saveall($MovDetalle);
			}
		}
	}
	
    private function addValidationMov($tipoMovi) {
		switch ($tipoMovi) {
			case 'P':
				$this->request->data['MovimientoInventario']['IdDepositoDest'] = null;
				break;
			case 'D':
				$this->request->data['MovimientoInventario']['IdDepositoDest'] = null;
				break;
			case 'I':
				$this->request->data['MovimientoInventario']['IdDepositoDest'] = null;
				$this->request->data['MovimientoInventario']['IdEstudio'] = null;
				$this->request->data['MovimientoInventario']['IdProyecto'] = null;
				break;
			case 'B':
				$this->request->data['MovimientoInventario']['IdDepositoDest'] = null;
				$this->request->data['MovimientoInventario']['IdEstudio'] = null;
				$this->request->data['MovimientoInventario']['IdProyecto'] = null;
				break;
			case 'T':
				$this->request->data['MovimientoInventario']['IdEstudio'] = null;
				$this->request->data['MovimientoInventario']['IdProyecto'] = null;
				break;
		}

	}
	
    private function addValidationMovDetalle($det,$tipoMovi) {
		$det['IdUbicacionDest'] = null;
		$det['IdUbicacionOrig'] = null;
		switch ($tipoMovi) {
			case 'P':
				break;
			case 'D':
				break;
			case 'I':
				$det['IdPedidoDetalle'] = null;
				break;
			case 'B':
				$det['IdPedidoDetalle'] = null;
				break;
			case 'T':
				$det['IdPedidoDetalle'] = null;
				break;
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

   function getArticuloByDeposito($id = null) {
		return "loco";
   }

	
}
?>
