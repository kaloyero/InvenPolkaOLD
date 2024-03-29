<?php

	App::import('Model','ConsultasSelect');
	App::import('Model','ConsultasPaginado');
	App::import('Model','MovimientoDetalleInventario');
	App::import('Model','MovimientoInventario');
	App::import('Model','Pedido');

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

	private function getListaArticulosDePedidosAdevolver($idPedido,$idProyecto){
		$consultasSelect = new ConsultasSelect();
		$articulos = $consultasSelect->getDetallesPedidoAdevolverByIdPedido($idPedido,$idProyecto);
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
			//verifico que tenga al menos un articulo con CANTIDAD > a cero
			if ($this->verificarCantidadMayorCero()) {
				//Inserto el movimiento y los detalles
				$this->insertMovimiento();
			}
          	//Sale por success
			$this->render('/General/Success');
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
			if ($this->verificarCantidadMayorCero()) {
				//Inserto el movimiento y los detalles
				$this->insertMovimiento();
			}
          	$this->render('/General/Success');
		} else {
			//CargarLista de Articulos
			$this->getListaArticulos();
			$this->setViewData();
		}
	}

	public function transferirADeposito(){
        if ($this->request->is('post')) {
			if ($this->verificarCantidadMayorCero()) {
				//Inserto el movimiento y los detalles
				$this->insertMovimiento();
			}
          	$this->render('/General/Success');
		} else {
			//CargarLista de Articulos
			$this->getListaArticulos();
			//Cargo la lista de depositos
			$consultas = new ConsultasSelect();
			$this->set('depositos',$consultas->getDepositos());
		}
	}

	public function devolucionDeArticulos(){
        if ($this->request->is('post')) {
			if ($this->verificarCantidadMayorCero()) {
				//Si es devolucion por proyecto
				$this->devolucionArtPorPedidoPOST();
				//Inserto el movimiento y los detalles
				$this->insertMovimiento();
			}
          	$this->render('/General/Success');
		} else {
			$this->setViewData();
			//CargarLista de Articulos
			$this->getListaArticulos();
		}
	}

	private function devolucionArtPorPedidoPOST(){
		if(!empty($this->request->data["MovimientoInventario"]["IdPedido"])){
			$consultas = new ConsultasSelect();
			$idPedido = $this->request->data["MovimientoInventario"]["IdPedido"];
			$idProyecto = $this->request->data["MovimientoInventario"]["IdProyecto"];

			$listDetalle = array ($this->request->data['Detalle']);
			//En el caso de que se devuelvan todos los articulos del Pedido lo cierra.			
			$consultas->actualizaPedidosEnviadosPorProyecto($idPedido,$idProyecto, $listDetalle);
			
		}
	}

	public function devolucionArtPorPedido($idPedido){
        if ($this->request->is('post')) {
			if ($this->verificarCantidadMayorCero()) {
				//Inserto el movimiento y los detalles
				$this->insertMovimiento();
			}
          	$this->render('/General/Success');
		} else {
			$this->devolucionArtPorPedidoGET($idPedido);
		}
	}

	private function devolucionArtPorPedidoGET($idPedido){
			print_r("teta");
			print_r($idPedido);
			print_r("culo");
			
			$consultas = new ConsultasSelect();
			//Obtengo la informacion del Pedido
			$pedido = $consultas->getPedidoById($idPedido);
			$this->set("pe", $pedido);
			//Cargar Lista de Articulos del Pedido
			$ped = $pedido;
			$this->getListaArticulosDePedidosAdevolver($idPedido,$ped['id_proyecto']);
			//Cargo la lista de depositos
			$this->set('depositos',$consultas->getDepositos());
	}

	public function asignacionAProyectos($id = null){
        if ($this->request->is('post')) {
			if ($this->verificarCantidadMayorCero()) {
				//Inserto el movimiento y los detalles
				$this->insertMovimiento();
				//modifico el estado del pedido a 'enviado'
				$this->estadoPedidoEnviado($this->request->data['MovimientoInventario']['IdPedido']);
			}
          	$this->render('/General/Success');
		} else {
			$this->asignacionAProyectosGET($id);
		}
	}

	private function asignacionAProyectosGET($id){
			$consultas = new ConsultasSelect();
			//Agarro la informacion del Pedido
			$pedido = $consultas->getPedidoById($id);
			$this->set("pe", $pedido);
			//Cargar Lista de Articulos del Pedido
			$this->getListaArticulosDePedidos($id);
			//Cargo la lista de depositos
			$this->set('depositos',$consultas->getDepositos());

	}

	private function verificarCantidadMayorCero(){
		$existArts = false ;
		$listDetalle = array ($this->request->data['Detalle']);
		foreach ($listDetalle as &$detalle) {
			foreach ($detalle as &$det) {
				if ($det['Cantidad'] > 0){
					$existArts = true ;
				}
			}
			if ($existArts){
				 break;
			}
		}
		return $existArts;
	}

	//Hace el insert en la Tabla de Movimientos
	private function insertMovimiento(){
			//Guardo el numero de movimiento en cero para despues hacerlo igual al id.
			$this->request->data['MovimientoInventario']['Numero'] = 0;
			//Setea el id del usuario logueado
			$this->setUsuarioId();
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
					if ($tipoMov == 'P'){
						$MovDetalle= array('IdMovimientoInventario' => $idInsertedMovimiento,
									   'IdArticulo' => $det['IdArticulo'],
									   'Cantidad' => $det['Cantidad'],
									   'IdPedidoDetalle' => $det['IdPedidoDetalle']);
					} else {
						$MovDetalle= array('IdMovimientoInventario' => $idInsertedMovimiento,
									   'IdArticulo' => $det['IdArticulo'],
									   'Cantidad' => $det['Cantidad']);
					}
				//Si el detalle tiene Cantidad > 0
				if ($MovDetalle['Cantidad'] > 0 ){
					//Guarda el detalle
					$this->MovimientoDetalleInventario->saveall($MovDetalle);
					//
					$this->balanceInventario($tipoMov,$MovDetalle);
				}

			}
		}
	}

    public function balanceInventario($tipoMov,$MovDetalle){
			$consultas = new ConsultasSelect();
			$articulo = $MovDetalle['IdArticulo'];
			$deposito = $this->request->data['MovimientoInventario']['IdDepositoOrig'];
			$cantidad = $MovDetalle['Cantidad'];

			switch ($tipoMov) {
				case 'P':
					$proyecto = $this->request->data['MovimientoInventario']['IdProyecto'];
					//Inserto/modifico al inventario que el proyecto tiene X cantidad de ese articulo
					$consultas ->sumaInventarioEnProyecto($articulo,$deposito,$proyecto,$cantidad);
					//Descuento del deposito la cantidad del articulo
					$consultas ->restaInventarioEnDeposito($articulo,$deposito,$cantidad);
					break;
				case 'D':
					$proyecto = $this->request->data['MovimientoInventario']['IdProyecto'];
					//Inserto/modifico para el deposito X cantidad de articulos
					$consultas ->sumaInventarioEnDeposito($articulo,$deposito,$cantidad);
					//Resto X cantidad de articulo al proyecto seleccionado
					$consultas ->restaInventarioEnProyecto($articulo,$deposito,$proyecto,$cantidad);
					break;
				case 'I':
					//Inserto/modifico para el deposito X cantidad de articulos
					$consultas ->sumaInventarioEnDeposito($articulo,$deposito,$cantidad);
					break;
				case 'B':
					$proyecto = $this->request->data['MovimientoInventario']['IdProyecto'];
					//Si se selecciono proyecto
					if (empty($proyecto) ){
						//Resto X cantidad de articulo al deposito seleccionado
						$consultas ->restaInventarioEnDeposito($articulo,$deposito,$cantidad);
					} else {
						//Resto X cantidad de articulo al proyecto seleccionado
						$consultas ->restaInventarioEnProyecto($articulo,$deposito,$proyecto,$cantidad);
					}
					//Borro o dejo al articulo inactivo.
					$consultas ->borraInactivoArticulo($articulo);
					break;
				case 'T':
					$depositoDest = $this->request->data['MovimientoInventario']['IdDepositoDest'];
					//Resto para el deposito Origen, X cantidad de articulos
					$consultas ->restaInventarioEnDeposito($articulo,$deposito,$cantidad);
					//Inserto/modifico para el deposito Destino, X cantidad de articulos
					$consultas ->sumaInventarioEnDeposito($articulo,$depositoDest,$cantidad);
					break;
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

	public function reciboPdf($id = null) {
		$model = new ConsultasSelect();
		//Obtengo la informacion del Movimiento
		$movimiento = $model->getMovimientoByIdPedido($id);
		//Obtengo los detalles del movimiento
		$detalles = $model->getDetallesMoviPedidoByIdPedido($id);
		//Obtengo la informacion del pedido
		$pedido = $model->getPedidoById($id);
		$this->set('detalles',$detalles);
		$this->set('pedidoId',$id);
		$this->set('pedido',$pedido);
		$this->set('movi',$movimiento);
		$this->response->type('application/pdf');
		$this->layout = 'pdf'; //this will use the pdf.ctp layout
		$this->render();
	}

	function ajaxData() {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataMovimientos();

	        echo json_encode($output);
	}

	function edit($id = null) {

			$model = new ConsultasSelect();
			$this->MovimientoInventario->id = $id;
		if ($this->request->is('get')) {
			//$this->request->data = $this->MovimientoInventario->read();
			$movimiento = $model->getMovimientoById($id);
			$detalles = $model->getDetallesMovimientoByIdMovimiento($id);
			$this->set('movimiento',$movimiento);
			$this->set('detalles',$detalles);
			$this->setViewData();
		} else {
			//Setea el id del usuario logueado
			$this->setUsuarioId();			
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

	private function estadoPedidoEnviado($idPedido){
		$model = new Pedido();
		$pedido = $model->read(null,$idPedido);
		if ($pedido['Pedido']['estado'] == 'confirmado'){
			$model->set('estado', 'enviado');
			$model->save();
		}
	}

	function setUsuarioId(){
		$usuario = $this->getUsuario();
		$this->request->data['MovimientoInventario']['id_usuario'] = $usuario["id"];
		
	}


}
?>
