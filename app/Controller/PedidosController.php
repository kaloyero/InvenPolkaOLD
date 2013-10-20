<?php
	App::import('Model','Proyecto');
	App::import('Model','Estudio');	
	App::import('Model','Articulo');	
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
		$this->set('proyectos',$this->getProyectos());
		$this->set('estudios',$this->getEstudios());		
		$this->set('articulos',$this->getArticulos());		
	}
	
	private function getProyectos() {
		$proyecto=new Proyecto();
		$proyectos=$proyecto->find('list',array('fields'=>array('Proyecto.id','Proyecto.Nombre')));
		return $proyectos;
	}

	private function getEstudios() {
		$estudio=new Estudio();
		$estudios=$estudio->find('list',array('fields'=>array('Estudio.id','Estudio.Nombre')));
		return $estudios;
	}

	private function getArticulos() {
		$articulo=new Articulo();
		$articulos=$articulo->find('list',array('fields'=>array('Articulo.id','Articulo.Codigoarticulo','Articulo.Descripcion')));
		return $articulos;
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
	
}
?>
