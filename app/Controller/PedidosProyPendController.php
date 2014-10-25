<?php
	App::import('Model','ConsultasSelect');
	App::import('Model','ConsultasPaginado');
	App::import('Model','PedidoDetalle');
	App::import('Model','Pedido');	
	App::import('Model','Articulo');

class PedidosProyPendController extends AppController {
	public $helpers = array('Html','Form');
	var $uses = array('Pedido','PedidoDetalle');
	public $findResult;

    function index() {

    }

	function ajaxData() {		
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataPedidos("PP");
	        echo json_encode($output);
	}

   public function view($id = null) {
        $this->Pedido->id = $id;
        $this->set('pedido', $this->Pedido->read());
   }

    public function add() {
    }

	function delete($id) {

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

}
?>
