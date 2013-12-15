<?php
App::import('Model','ConsultasPaginado');
App::import('Model','Pedido');
App::import('Model','MovimientoInventario');


class ProyectosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
    }


   public function view($id = null) {
        $this->Proyecto->id = $id;
        $this->set('proyecto', $this->Proyecto->read());
   }
	function ajaxData() {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$privilegios = $this->Session->read("privilegios");
			$output = $paginado->getDataProyectos($privilegios);
	        echo json_encode($output);
	}

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Proyecto->save($this->request->data)) {
                $this->render('/General/Success');
        	}else{
				$this->render('/General/Error');
			}
        }
    }

	function edit($id = null) {
		$this->Proyecto->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Proyecto->read();
		} else {
			if ($this->Proyecto->save($this->request->data)) {
				$this->render('/General/Success');
        	}else{
				$this->render('/General/Error');
			}
		}
	}
 //Si el proyecto se esta usando en algun lugar,se pone el campo en inactivo,sino ,se borra
	function delete($id) {
		$MovDetalle=new MovimientoInventario();
		$pedido=new Pedido();
		$resultMovimientoDetalle=$MovDetalle->find('list', array('conditions' => array('IdProyecto =' => $id)));
		$cantidadEnMovDetall = sizeof($resultMovimientoDetalle);
		$resultPedido=$pedido->find('list', array('conditions' => array('IdProyecto =' => $id)));
		$cantidadEnPedido = sizeof($resultPedido);

		if ($cantidadEnPedido==0 && $cantidadEnMovDetall==0){
			$this->Proyecto->delete($id);
		} else {
			$this->Proyecto->id = $id;
			$this->Proyecto->saveField('inactivo', 'V');

		}
			$this->render('/General/Success');
	}

}
?>
