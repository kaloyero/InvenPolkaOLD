<?php
App::import('Model','ConsultasPaginado');

class DepositosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
		$depositos = $this->Deposito->find('list');
		foreach ($depositos as &$depo) {
			$id = $depo['id'];
		}
		$this->redirect(array('action' => 'edit/'.$id));
		
    }

   public function view($id = null) {

   }

	function ajaxData() {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataDepositos();
	        echo json_encode($output);
	}
    public function add() {
	    if ($this->request->is('post')) {
    		if ($this->Deposito->save($this->request->data)) {
				$this->render('/General/Success');
        	}else{
				$this->render('/General/Error');
			}
		}
    }

	function edit($id = null) {
		    $this->Deposito->id = $id;
		    if ($this->request->is('get')) {
		        $this->request->data = $this->Deposito->read();
		    } else {
		        if ($this->Deposito->save($this->request->data)) {
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
