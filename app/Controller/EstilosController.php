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
			$output = $consultas->getDataConfig('estilos');
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

	}
}
?>
