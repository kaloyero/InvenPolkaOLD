<?php
 App::import('Model','Deposito');
class UbicacionesController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
        $this->set('ubicaciones', $this->Ubicacione->find('all'));
    }

   public function view($id = null) {

   }

   public function add() {
	        if ($this->request->is('post')) {

	            if ($this->Ubicacione->save($this->request->data)) {
	                $this->Session->setFlash('Ubicacion Guardada con Exito.');
	                $this->redirect(array('action' => 'index'));
	            }
	        } else {

				$this->set('depositos',$this->getDepositos());

			}

    }

	function edit($id = null) {
		    $this->Ubicacione->id = $id;
		    if ($this->request->is('get')) {
				$this->set('depositos',$this->getDepositos());
		        $this->request->data = $this->Ubicacione->read();
		    } else {
		        if ($this->Ubicacione->save($this->request->data)) {
		            $this->Session->setFlash('Your post has been updated.');
		            $this->redirect(array('action' => 'index'));
		        }
		    }
	}

	function delete($id) {

	}

	function getDepositos() {
		$deposito=new Deposito();
		$depositos=$deposito->find('list',array('fields'=>array('Deposito.id','Deposito.Nombre')));
		return 	$depositos;
	}
}
?>
