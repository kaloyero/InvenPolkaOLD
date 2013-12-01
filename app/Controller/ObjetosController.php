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
        if ($this->request->is('post')) {
			if ($this->Objeto->save($this->request->data)) {
				$this->render('/General/Success');
			} else {
				$this->render('/General/Error');
			}
		} else {
			$this->Objeto->id = $id;
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

	}
}
?>
