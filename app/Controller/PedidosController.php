<?php
	App::import('Model','ConsutasSelect');
	App::import('Model','PedidoDetalle');	

class PedidosController extends AppController {
	public $helpers = array('Html','Form');
	var $uses = array('Pedido','PedidoDetalle');
    
    function index() {
        $this->set('pedidos', $this->Pedido->find('all'));
    }	

   public function view($id = null) {
        $this->Pedido->id = $id;
        $this->set('pedido', $this->Pedido->read());
   }	
   
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Pedido->save($this->request->data)) {
				$this->agregarDetalles();
                $this->Session->setFlash('Pedido Guardado');
                $this->redirect(array('action' => 'index'));
            }
        } else {
			$this->setViewData();
		}
    }

	function edit($id = null) {
		$this->Pedido->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Pedido->read();
			$this->setViewData();			
		} else {
			if ($this->Pedido->save($this->request->data)) {
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
		$this->set('proyectos',$consultasSelect ->getProyectos());
		$this->set('estudios',$consultasSelect ->getEstudios());		
		$this->set('articulos',$consultasSelect ->getArticulos());		
	}
	

	private function agregarDetalles() {
		$idInsertedPedido = $this->Pedido->getInsertID();
		$listDetalle = array ($this->request->data['Detalle']);
		foreach ($listDetalle as &$detalle) {
			foreach ($detalle as &$det) {
				$PedidoDetalle=new PedidoDetalle();
				$PedidoDetalle= array('IdPedido' => $idInsertedPedido,
									  'IdArticulo' => $det['IdArticulo'],
									  'Cantidad' => $det['Cantidad']);
				$this->PedidoDetalle->saveall($PedidoDetalle);
			}
		}
	}

	function confirmarPedido($id = null) {
		$pedido = $this->Pedido->read(null, $id);
        if (!$this->Pedido->exists()) {
//            throw new NotFoundException(__('Invalid model'));
        } else {		
			if ($pedido['Pedido']['estado'] == 'abierto'){
				$this->Pedido->set('estado', 'confirmado');
				$this->Pedido->save();
			}
		}
		$this->redirect(array('action' => 'index'));
		
//		$this->Status->id = 3; // This avoids the query performed by read()
//		$this->Status->saveField('amount', 5000);
	}	



}
?>
