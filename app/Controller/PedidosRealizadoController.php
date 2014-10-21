<?php
	App::import('Model','ConsultasSelect');
	App::import('Model','ConsultasPaginado');
	App::import('Model','PedidoDetalle');
	App::import('Model','Pedido');	
	App::import('Model','Articulo');

class PedidosRealizadoController extends AppController {
	public $helpers = array('Html','Form');
	var $uses = array('Pedido','PedidoDetalle');
	public $findResult;

    function index() {
		$proyectoId = $_GET['isSearch'];
		if ($proyectoId !='undefined' ) {
			//Seteo el Proyecto del cual quiero obtener los pedidos...@todo CAMBIAR
			$this->Session->write("filtroProyectoPedido",$proyectoId);
		} else {
			//Obtengo datos del usuario
			$usuario = $this->Session->read("usuario");
			//Seteo el Proyecto del usuario
			$this->Session->write("filtroProyectoPedido",$usuario['Proyecto']);
		}
    }

	function ajaxData() {		
		//Obtengo de la session el proyecto por cual voy a filtrar....@todo CAMBIAR
		$filtroProyecto = $this->Session->read("filtroProyectoPedido");
		//Obtengo los privilegios
		$privilegios = $this->Session->read("privilegios");
		$paginado =new ConsultasPaginado();
		$select =new ConsultasSelect();
		$this->autoRender = false;

		//Tomo cada Pedido y reviso si es necesario marcarlo como devuelto
		$select->actualizaTodosPedidosPorProyecto($filtroProyecto);

		//Tomo los Pedidos Realizados
		$output = $paginado->getDataPedidosRealizados($filtroProyecto,$privilegios);
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
