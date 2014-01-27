<?php
	App::import('Model','ConsultasSelect');
	App::import('Model','ConsultasPaginado');
	App::import('Model','PedidoDetalle');
	App::import('Model','Articulo');

class PedidosSalidaController extends AppController {
	public $helpers = array('Html','Form');
	var $uses = array('Pedido','PedidoDetalle');
	public $findResult;

    function index() {

    }

	function ajaxData() {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataPedidos("S");
	        echo json_encode($output);
	}

	//Para que?
	function getEstilos() {
		$estilo=new Estilo();
		$estilos=$estilo->find('list',array('fields'=>array('Estilo.id','Estilo.Nombre')));
		return $estilos;
	}


//    function index() {
//        $this->set('pedidos', $this->Pedido->find('all'));
//    }

   public function view($id = null) {
        $this->Pedido->id = $id;
        $this->set('pedido', $this->Pedido->read());
   }

    public function add() {

        if ($this->request->is('post')) {
			$this->request->data['Pedido']['Numero'] = 0;
            if ($this->Pedido->save($this->request->data)) {
				//Para que?Si justo otro agrego un pedido en el medio,no seria mas el ultimo
				$idInsertedPedido = $this->Pedido->getInsertID();
				$this->Pedido->updateAll(array('Numero'=>$idInsertedPedido), array('Pedido.id'=>$idInsertedPedido));
				//hago el alta del detalle
				$this->agregarDetalles();
	          	$this->render('/General/Success');
            } else {
				$this->render('/General/Error');
			}
        } else {
			//CargarLista de Articulos
			$this->getListaArticulos();
			$this->setViewData();
		}
    }
	//Consulta a la base los datos de los articulos seleccionados
	function getListaArticulos() {
		$arts = array();
		foreach($_GET as $name => $value) {
			array_push($arts,$value);
		}
		$consultasSelect = new ConsultasSelect();
		$articulos = $consultasSelect->getArticulosByArrayId($arts);
		$this->set('articulos',$articulos);
	}

	function edit($id = null) {
		$model = new ConsultasSelect();
		$this->Pedido->id = $id;
		if ($this->request->is('get')) {
			$pedido = $model->getPedidoById($id);
			$detalles = $model->getDetallesPedidoByIdPedido($id);
			$this->set('Detalles',$detalles);
			$this->set('Pe',$pedido);
			//$this->set('Detalles',$pedido);
		} else {
			$this->confirmar($id);
		}
	}

	private function agregarDetalles() {
		$idInsertedPedido = $this->Pedido->getInsertID();
		$listDetalle = array ($this->request->data['Detalle']);
		$cont=0;
		foreach ($listDetalle as &$detalle) {
			foreach ($detalle as &$det) {
				$PedidoDetalle=new PedidoDetalle();
				$PedidoDetalle= array('IdPedido' => $idInsertedPedido,
									  'IdArticulo' => $det['IdArticulo'],
            						  'Cantidad' => $det['Cantidad']);
				if (! $this->PedidoDetalle->saveall($PedidoDetalle)) {
					$this->render('/General/Error');
				}
			}
		}
	}


	function delete($id) {

	}

	private function setViewData() {
		$consultasSelect = new ConsultasSelect();
		$this->set('proyectos',$consultasSelect ->getProyectos());
	}

	function confirmarPedido($id = null) {
		$this->confirmar($id);
      	$this->render('/General/Success');
        $this->redirect(array('action' => 'add'));
	}

	private function confirmar($id){
		$pedido = $this->Pedido->read(null, $id);
        if (!$this->Pedido->exists()) {
//            throw new NotFoundException(__('Invalid model'));
        } else {
			if ($pedido['Pedido']['estado'] == 'abierto'){
				$this->Pedido->set('estado', 'confirmado');
				$this->Pedido->save();
			}
		}
	}

}
?>
