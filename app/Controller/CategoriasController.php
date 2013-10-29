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
                $this->Session->setFlash('Categoria Guardada con Exito.');
				echo "OK";
				//$this->addRedirect('Categoria');
            }else{
			echo "Rp[oblema]";
}
        } else {

/*			if ($this->params['check'] = 1){
				$this->set('check',1);
			} else {
				$this->set('check',0);
			}*/

		}
    }

	function ajaxData() {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataConfig('categorias');
	        echo json_encode($output);
	}

	function edit($id = null) {
		$this->Categoria->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Categoria->read();
		} else {
			if ($this->Categoria->save($this->request->data)) {
				//$this->Session->setFlash('Cambios guardados');
				//$this->Session->write("ajaxRequest",true);
				//$this->redirect(array('action' => 'index'));
				echo "Ok";
			}
		}
	}

	function delete($id) {

	}
}
?>
