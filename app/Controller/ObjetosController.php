<?php
	App::import('Model','ConsultasPaginado');
	App::import('Model','ConsultasSelect');
	App::import('Model','ObjetoCategoria');

class ObjetosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$consultas = new ConsultasSelect();
		$this->set('categorias',$consultas->getCategorias());

		$this->paginate = array(
			'order' => array('Result.created ASC'),
		     'limit' => 10
		 );
        $this->set('objetos', $this->paginate('Objeto'));
    }

   public function view($id = null) {
	   $consultas = new ConsultasSelect();
		$this->Objeto->id = $id;
		if ($this->request->is('put') || $this->request->is('post')) {
		   	$id = $this->request->data['Objeto']['id'];
			$categs=$consultas->getCategoriasIdDesc();
			$consultas->deleteModelCategoriasById($id,'objeto','IdObjeto');
			$categoriaModel = new ObjetoCategoria();
			foreach ($categs as $cat){
				$idCat =$cat['categorias']['id'];
				if(array_key_exists ($idCat , $this->request->data["checkCat"] )){
					if ($this->request->data["checkCat"][$idCat] == 'on'){
						$insert =array ('IdObjeto' => $id,'IdCategoria' => $idCat,'Inactivo' => 'F');
						$categoriaModel->saveAll($insert);
					}
				}
			}
			if ($this->Objeto->save($this->request->data)) {
				$this->render('/General/Success');
			} else {
				$this->render('/General/Error');
			}

		} else {
			$this->request->data = $this->Objeto->read();
			$this->set('categorias',$consultas->getCategoriasIdDesc());
			$categoriasSelected = $consultas->getCategoriasByIdDescripcion($id,"objeto","IdObjeto");
			$this->set('categoriasSelected',$categoriasSelected);
		}
   }

    public function add() {
        if ($this->request->is('post')) {
			$categoriaModel = new ObjetoCategoria();
			//Guardo Objeto
			if($this->Objeto->save($this->request->data)){
				$idInserted = $this->Objeto->getInsertID();
				$categorias = $this->request->data['Objeto']['IdCategoria'];
				foreach ($categorias as $categoria):
					$insert =array ('IdObjeto' => $idInserted,'IdCategoria' => $categoria,'Inactivo' => 'F');
					if($categoriaModel->saveAll($insert)){
						$this->render('/General/Success');
					}
				endforeach;
			$this->render('/General/Success');
        	}
		}
    }

	function ajaxData() {
			$consultas =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $consultas->getDataConfig('objetos','objeto','IdObjeto');

	        echo json_encode($output);
	}

	function edit($id = null) {
		$this->Objeto->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Objeto->read();
		} else {
			if ($this->Objeto->save($this->request->data)) {
				$this->render('/General/Success');
			} else {
				$this->render('/General/Error');
			}
		}

	}

	function delete($id) {
		if ($this->Objeto->delete($id)){
			$this->render('/General/Success');
		} else {
			$this->render('/General/Error');
		}
	}
}
?>
