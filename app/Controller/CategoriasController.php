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
				if ($this->request->data['Categoria']['RedirectAction'] == 'siguiente'){
					$this->redirect(array('action' => 'add'));
				} else {
					$this->redirect(array('action' => 'index'));
				}
            }
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
