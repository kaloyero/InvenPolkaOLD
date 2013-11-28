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

	}
}
?>
