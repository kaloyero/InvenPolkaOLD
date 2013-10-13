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
                $this->redirect(array('action' => 'index'));
            }
        }
    }

	function edit($id = null) {

	}	

	function delete($id) {

	}
}
?>
