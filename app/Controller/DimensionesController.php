<?php
	App::import('Model','ConsultasPaginado');
	App::import('Model','ConsultasSelect');	
	App::import('Model','DimensionCategoria');		

class DimensionesController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$consultas = new ConsultasSelect();
		$this->set('categorias',$consultas->getCategorias());
		
		$this->paginate = array(
			'order' => array('Result.created ASC'),
		     'limit' => 10
		 );
        $this->set('dimensiones', $this->paginate('Dimensione'));
    }

   public function view($id = null) {

   }

    public function add() {
        if ($this->request->is('post')) {
			$categoriaModel = new DimensionCategoria();
			//Guardo Dimension
			if($this->Dimensione->save($this->request->data)){
				$idInserted = $this->Dimensione->getInsertID();
				$categorias = $this->request->data['Dimensione']['IdCategoria'];
				foreach ($categorias as $categoria):
					$insert =array ('IdDimension' => $idInserted,'IdCategoria' => $categoria,'Inactivo' => 'F');
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
			$output = $consultas->getDataConfig('dimensiones','dimension','IdDimension');			
	        echo json_encode($output);
	}

	function edit($id = null) {
		$this->Dimensione->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Dimensione->read();
		} else {
			if ($this->Dimensione->save($this->request->data)) {
				$this->render('/General/Success');
        	}else{
				$this->render('/General/Error');
			}
		}
	}

	function delete($id) {

	}
}
?>
