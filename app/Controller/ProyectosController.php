<?php
class ProyectosController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
		//Si la session tiene cargada la variable articulos,viene de un redireccionamiento,si no,se pidio el listado completo
		if ($this->Session->check("proyectos")){
			$this->paginate = array(
				 'conditions' => $this->Session->read("proyectos"),
				 'order' => array('Result.created ASC'),
				 'limit' => 5
			 );
			$this->set("proyectos",$this->paginate('Proyecto'));
			$this->Session->delete("proyectos");
		}else{
				//paginate as normal
				$this->paginate = array(
					'order' => array('Result.created ASC'),
					 'limit' => 10
				 );
			//$this->set("articulos",$this->Articulo->find('all'));
			$this->set("proyectos",	$this->paginate('Proyecto'));
		}

    }	

   public function view($id = null) {
        $this->Proyecto->id = $id;
        $this->set('proyecto', $this->Proyecto->read());
   }	
   
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Proyecto->save($this->request->data)) {
                $this->Session->setFlash('Proyecto Guardado');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

	function edit($id = null) {
		$this->Proyecto->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Proyecto->read();
		} else {
			if ($this->Proyecto->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				$this->redirect(array('action' => 'index'));
			}
		}
	}	

	function delete($id) {

	}
}
?>
