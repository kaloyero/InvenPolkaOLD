<?php

	App::import('Model','ConsultasSelect');
	App::import('Model','ConsultasPaginado');	
	App::import('Model','MovimientoDetalleInventario');
	App::import('Model','MovimientoInventario');	

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

	private function getListaArticulosDePedidos($idPedido){
		$consultasSelect = new ConsultasSelect();
		$articulos = $consultasSelect->getDetallesPedidoByIdPedido($idPedido);
		$this->set('artis',$articulos);
	}

	//Consulta a la base los datos de los articulos seleccionados
	private function getListaArticulos() {
		$arts = array();
		foreach($_GET as $name => $value) {
			array_push($arts,$value);
		}
		$consultasSelect = new ConsultasSelect();
		$articulos = $consultasSelect->getArticulosByArrayId($arts);
		$this->set('artis',$articulos);
	}

   	public function ingresoDeArticulos() {
        if ($this->request->is('post')) {
			//Inserto el movimiento y los detalles			
			$this->insertMovimiento();		
			//Inserto/modifico para el deposito X cantidad de articulos
			
		} else {
			//Cargo Lista de Articulos
			$this->getListaArticulos();
			//Cargo la lista de depositos		
			$consultas = new ConsultasSelect();
			$this->set('depositos',$consultas->getDepositos());
		}
		
   	}		

   	public function darDeBajaArticulos() {
        if ($this->request->is('post')) {
			//Inserto el movimiento y los detalles			
			$this->insertMovimiento();		
			//Resto X cantidad de articulo al deposito seleccionado
			
		} else {
			//CargarLista de Articulos
			$this->getListaArticulos();
			$this->setViewData();			
		}
	}
	
	public function transferirADeposito(){
        if ($this->request->is('post')) {
			//Inserto el movimiento y los detalles
			$this->insertMovimiento();		
			//Resto para el deposito Origen, X cantidad de articulos

			//Inserto/modifico para el deposito Destino, X cantidad de articulos
			
		} else {
			//CargarLista de Articulos
			$this->getListaArticulos();
			//Cargo la lista de depositos		
			$consultas = new ConsultasSelect();
			$this->set('depositos',$consultas->getDepositos());
		}
	}

	public function devolucionDeArticulos(){
	}

	public function asignacionAProyectos($id = null){
		$id = 93;
        if ($this->request->is('post')) {
			//Inserto el movimiento y los detalles
			$this->insertMovimiento();
			//Descuento del deposito la cantidad del articulo
			
			//Inserto/modifico al inventario que el proyecto tiene X cantidad de ese articulo
			
		} else {
			$this->asignacionAProyectosGET($id);
		}
	}
	
	private function asignacionAProyectosGET($id){
			$consultas = new ConsultasSelect();
			//Agarro la informacion del Pedido
			$pedido = $consultas->getPedidoById($id);
			$this->set("pedido", $pedido);			
			//Cargar Lista de Articulos del Pedido
			$this->getListaArticulosDePedidos($id);
			//Cargo la lista de depositos		
			$this->set('depositos',$consultas->getDepositos());
	}

	//Hace el insert en la Tabla de Movimientos
	private function insertMovimiento(){
			//Guardo el numero de movimiento en cero para despues hacerlo igual al id.
			$this->request->data['MovimientoInventario']['Numero'] = 0;
            $res= $this->MovimientoInventario->save($this->request->data);
			if ($res) {
				$idInsertedPedido = $this->MovimientoInventario->getInsertID();
				//Actualizo el Numero del Movimiento/
				$this->MovimientoInventario->updateAll(array('Numero'=>$idInsertedPedido), array('MovimientoInventario.id'=>$idInsertedPedido));
				//hago el alta del detalle
				$this->agregarDetalles();
	          	$this->render('/General/Success'); 
           } else {
				$this->render('/General/Error');
			}
	}

	private function agregarDetalles() {
		$idInsertedMovimiento = $this->MovimientoInventario->getInsertID();
		$listDetalle = array ($this->request->data['Detalle']);
		$tipoMov = $this->request->data['MovimientoInventario']['TipoMovimiento'];
		foreach ($listDetalle as &$detalle) {
			foreach ($detalle as &$det) {
				$MovDetalle=new MovimientoDetalleInventario();
					if ($det['Cantidad'] !=0){
						if ($tipoMov == 'I'){
							$MovDetalle= array('IdMovimientoInventario' => $idInsertedMovimiento,
										   'IdArticulo' => $det['IdArticulo'],
										   'Cantidad' => $det['Cantidad'],
										   'IdPedidoDetalle' => $det['IdPedidoDetalle']);
						} else {
							$MovDetalle= array('IdMovimientoInventario' => $idInsertedMovimiento,
										   'IdArticulo' => $det['IdArticulo'],
										   'Cantidad' => $det['Cantidad']);
						}
					}
				$this->MovimientoDetalleInventario->saveall($MovDetalle);
			}
		}
	}

   
    public function add() {
		
        if ($this->request->is('post')) {
			$tipoMovi = $this->request->data['MovimientoInventario']['TipoMovimiento'];
			switch ($tipoMovi) {
				case 'P':
					$this->asignacionAProyectos(null);
					break;
				case 'D':
					$this->devolucionDeArticulos();
					break;
				case 'I':
					$this->ingresoDeArticulos();
					break;
				case 'B':
					$this->darDeBajaArticulos();		
					break;
				case 'T':
					$this->transferirADeposito();
					break;
			}
        } else {

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

	private function setViewData() {
		$consultasSelect = new ConsultasSelect();
		$this->set('proyectos',$consultasSelect->getProyectos());
		$this->set('depositos',$consultasSelect->getDepositos());
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
