<?php
	App::import('Model','ConsultasPaginado');

class CategoriasController extends AppController {

    public $helpers = array ('Html','Form');


    function index() {
	//$this->redirect(array('controller' => 'pages', 'action' => 'display'));
		//Si fue un pedido ajax,uso un layout donde nada mas devuelve el contenido,sin los <html> <Headt> etc
 		//if ($this->Session->check("ajaxRequest")){
			////$this->layout = 'empty';
		//	$this->Session->delete("ajaxRequest");
	//	}
		$this->paginate = array(
			'order' => array('Result.created ASC'),
		     'limit' => 10
		 );
        $this->set('categorias', $this->paginate('Categoria'));
    }

   public function view($id = null) {

   }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Categoria->save($this->request->data)) {
              	    $this->render('/General/Success');
	        	}else{
					$this->render('/General/Error');
				}
        }
    }

	function ajaxData() {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataCategorias();
	        echo json_encode($output);
	}

	function edit($id = null) {
		$this->Categoria->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Categoria->read();
		} else {
			if ($this->Categoria->save($this->request->data)) {
				$this->render('/General/Success');
			} else {
				$this->render('/General/Error');
			}
		}
	}

	function delete($id) {
			if ($this->Categoria->delete($id)){
				$this->render('/General/Success');
			} else {
				$this->render('/General/Error');
			}
	}
}
?>
