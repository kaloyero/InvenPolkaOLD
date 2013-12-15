<?php
	App::import('Model','ConsultasPaginado');
	App::import('Model','ConsultasSelect');
	App::import('Model','MaterialCategoria');

class MaterialesController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$consultas = new ConsultasSelect();
		$this->set('categorias',$consultas->getCategorias());

		$this->paginate = array(
			'order' => array('Result.created ASC'),
		     'limit' => 10
		 );
        $this->set('materiales', $this->paginate('Materiale'));
    }

   public function view($id = null) {
		$consultas = new ConsultasSelect();
		$this->Materiale->id = $id;
		if ($this->request->is('put') || $this->request->is('post')) {
		   	$id = $this->request->data['Materiale']['id'];
			$categs=$consultas->getCategoriasIdDesc();
			$consultas->deleteModelCategoriasById($id,'material','IdMaterial');
			$categoriaModel = new MaterialCategoria();
			foreach ($categs as $cat){
				$idCat =$cat['categorias']['id'];
				if(array_key_exists ($idCat , $this->request->data["checkCat"] )){
					if ($this->request->data["checkCat"][$idCat] == 'on'){
						$insert =array ('IdMaterial' => $id,'IdCategoria' => $idCat,'Inactivo' => 'F');
						$categoriaModel->saveAll($insert);
					}
				}
			}
			if ($this->Materiale->save($this->request->data)) {
				$this->render('/General/Success');
			} else {
				$this->render('/General/Error');
			}
		} else {
			$this->request->data = $this->Materiale->read();
			$this->set('categorias',$consultas->getCategoriasIdDesc());
			$categoriasSelected = $consultas->getCategoriasByIdDescripcion($id,"material","IdMaterial");
			$this->set('categoriasSelected',$categoriasSelected);
		}
   }

    public function add() {
        if ($this->request->is('post')) {
			$categoriaModel = new MaterialCategoria();
			//Guardo Material
			if($this->Materiale->save($this->request->data)){
				$idInserted = $this->Materiale->getInsertID();
				$categorias = $this->request->data['Materiale']['IdCategoria'];
				foreach ($categorias as $categoria):
					$insert =array ('IdMaterial' => $idInserted,'IdCategoria' => $categoria,'Inactivo' => 'F');
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
			$output = $consultas->getDataConfig('materiales','material','IdMaterial');
	        echo json_encode($output);
	}

	function edit($id = null) {
		$this->Materiale->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Materiale->read();
		} else {
			if ($this->Materiale->save($this->request->data)) {
				$this->render('/General/Success');
			} else {
				$this->render('/General/Error');
			}
		}
	}

	function delete($id) {
		if ($this->Materiale->delete($id)){
			$this->render('/General/Success');
		} else {
			$this->render('/General/Error');
		}
	}
}
?>
