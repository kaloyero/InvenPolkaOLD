<?php
class CategoriasController extends AppController {
    
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('categorias', $this->Categoria->find('all'));
    }	

   public function view($id = null) {

   }	
   
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Categoria->save($this->request->data)) {
                $this->Session->setFlash('Categoria Guardada con Exito.');
				$this->addRedirect('Categoria');
            }
        } else {
			
/*			if ($this->params['check'] = 1){
				$this->set('check',1);
			} else {
				$this->set('check',0);
			}*/
			
		}
    }

	function edit($id = null) {
		$this->Categoria->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Categoria->read();
		} else {
			if ($this->Categoria->save($this->request->data)) {
				$this->Session->setFlash('Cambios guardados');
				$this->redirect(array('action' => 'index'));
			}
		}
	}	

	function delete($id) {

	}
}
?>
