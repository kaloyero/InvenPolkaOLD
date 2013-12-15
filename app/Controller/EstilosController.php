<?php
	App::import('Model','ConsultasPaginado');
	App::import('Model','ConsultasSelect');
	App::import('Model','EstiloCategoria');

class EstilosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$consultas = new ConsultasSelect();
		$this->set('categorias',$consultas->getCategorias());

		$this->paginate = array(
			'order' => array('Result.created ASC'),
		     'limit' => 10
		 );
        $this->set('estilos', $this->paginate('Estilo'));
    }

   public function view($id = null) {
	   $consultas = new ConsultasSelect();
		$this->Estilo->id = $id;
		if ($this->request->is('put') || $this->request->is('post')) {
		   	$id = $this->request->data['Estilo']['id'];
			$categs=$consultas->getCategoriasIdDesc();
			$consultas->deleteModelCategoriasById($id,'estilo','IdEstilo');
			$categoriaModel = new EstiloCategoria();
			foreach ($categs as $cat){
				$idCat =$cat['categorias']['id'];
				if(array_key_exists ($idCat , $this->request->data["checkCat"] )){
					if ($this->request->data["checkCat"][$idCat] == 'on'){
						$insert =array ('IdEstilo' => $id,'IdCategoria' => $idCat,'Inactivo' => 'F');
						$categoriaModel->saveAll($insert);
					}
				}
			}if ($this->Estilo->save($this->request->data)) {
				$this->render('/General/Success');
			} else {
				$this->render('/General/Error');
			}

		} else {
			$this->Estilo->id = $id;
			$this->request->data = $this->Estilo->read();
			$this->set('categorias',$consultas->getCategoriasIdDesc());
			$categoriasSelected = $consultas->getCategoriasByIdDescripcion($id,"estilo","IdEstilo");
			$this->set('categoriasSelected',$categoriasSelected);
		}
   }

    public function add() {
        if ($this->request->is('post')) {
			$categoriaModel = new EstiloCategoria();
			//Guardo Estilo
			if($this->Estilo->save($this->request->data)){
				$idInserted = $this->Estilo->getInsertID();
				$categorias = $this->request->data['Estilo']['IdCategoria'];
				foreach ($categorias as $categoria):
					$insert =array ('IdEstilo' => $idInserted,'IdCategoria' => $categoria,'Inactivo' => 'F');
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
			$output = $consultas->getDataConfig('estilos','estilo','IdEstilo');

	        echo json_encode($output);
	}

	function edit($id = null) {
		$this->Estilo->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Estilo->read();
		} else {
			if ($this->Estilo->save($this->request->data)) {
				$this->render('/General/Success');
        	}else{
				$this->render('/General/Error');
			}
		}
	}

	function delete($id) {
		if ($this->Estilo->delete($id)){
			$this->render('/General/Success');
		} else {
			$this->render('/General/Error');
		}
	}
}
?>
