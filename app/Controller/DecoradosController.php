<?php
	App::import('Model','ConsultasPaginado');
	App::import('Model','ConsultasSelect');
	App::import('Model','DecoradoCategoria');

class DecoradosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$consultas = new ConsultasSelect();
		$this->set('categorias',$consultas->getCategorias());

		$this->paginate = array(
			'order' => array('Result.created ASC'),
		     'limit' => 10
		 );
        $this->set('decorados', $this->paginate('Decorado'));
    }

   public function view($id = null) {
		$consultas = new ConsultasSelect();
		$this->Decorado->id = $id;
		if ($this->request->is('put') || $this->request->is('post')) {
		   	$id = $this->request->data['Decorado']['id'];
			$categs=$consultas->getCategoriasIdDesc();
			$consultas->deleteModelCategoriasById($id,'decorado','IdDecorado');
			$categoriaModel = new DecoradoCategoria();
			foreach ($categs as $cat){
				$idCat =$cat['categorias']['id'];
				if(array_key_exists ($idCat , $this->request->data["checkCat"] )){
					if ($this->request->data["checkCat"][$idCat] == 'on'){
						$insert =array ('IdDecorado' => $id,'IdCategoria' => $idCat,'Inactivo' => 'F');
						$categoriaModel->saveAll($insert);
					}
				}
			}
			if ($this->Decorado->save($this->request->data)) {
				$this->render('/General/Success');
			} else {
				$this->render('/General/Error');
			}
		} else {
			$this->Decorado->id = $id;
			$this->request->data = $this->Decorado->read();
			$this->set('categorias',$consultas->getCategoriasIdDesc());
			$categoriasSelected = $consultas->getCategoriasByIdDescripcion($id,"decorado","IdDecorado");
			$this->set('categoriasSelected',$categoriasSelected);
		}
   }

    public function add() {
        if ($this->request->is('post')) {
			$categoriaModel = new DecoradoCategoria();
			//Guardo Decorado
			if($this->Decorado->save($this->request->data)){
				$idInserted = $this->Decorado->getInsertID();
				$categorias = $this->request->data['Decorado']['IdCategoria'];
				foreach ($categorias as $categoria):
					$insert =array ('IdDecorado' => $idInserted,'IdCategoria' => $categoria,'Inactivo' => 'F');
					if($categoriaModel->saveAll($insert)){
						$this->render('/General/Success');
					}
				endforeach;
			$this->render('/General/Success');
        }
/*
			$nombre = $this->request->data['Decorado']['Nombre'];
			$categorias = $this->request->data['Decorado']['IdCategoria'];
			foreach ($categorias as $categoria):
				$insert =array ('Nombre' => $nombre,'IdCategoria' => $categoria,'Inactivo' => 'F');
				if($this->Decorado->saveAll($insert)){
					$this->render('/General/Success');
				}
			endforeach;
			$this->render('/General/Success');
*/
        }


    }

	function ajaxData() {
			$consultas =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $consultas->getDataConfig('decorados','decorado','IdDecorado');
	        echo json_encode($output);
	}

	function edit($id = null) {
		$this->Decorado->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Decorado->read();
		} else {
			if ($this->Decorado->save($this->request->data)) {
				$this->render('/General/Success');
        	}else{
				$this->render('/General/Error');
			}
		}
	}

	function delete($id) {
		if ($this->Decorado->delete($id)){
			$this->render('/General/Success');
		} else {
			$this->render('/General/Error');
		}
	}
}
?>
