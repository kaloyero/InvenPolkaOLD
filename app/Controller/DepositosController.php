<?php
class DepositosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
        $this->set('depositos', $this->Deposito->find('all'));
    }

   public function view($id = null) {

   }

    public function add() {
	    if ($this->request->is('post')) {
    		if ($this->Deposito->save($this->request->data)) {

				$this->Session->setFlash('Deposito Guardada con Exito.');
            	$this->redirect(array('action' => 'index'));
        	}
		}
    }

	function edit($id = null) {
		    $this->Deposito->id = $id;
		    if ($this->request->is('get')) {
		        $this->request->data = $this->Deposito->read();
		    } else {
		        if ($this->Deposito->save($this->request->data)) {
		            $this->Session->setFlash('Your post has been updated.');
		            $this->redirect(array('action' => 'index'));
		        }
		    }
	}

	function delete($id) {

	}
}
?>
