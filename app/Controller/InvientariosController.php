<?php
class InventariosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
     	$this->paginate = array(
			'order' => array('Result.created ASC'),
		     'limit' => 10
		 );
        $this->set('inventarios', $this->paginate('Inventario'));
    }

   public function view($id = null) {

   }

    public function add() {

    }

	function edit($id = null) {

	}

	function delete($id) {

	}
}
?>
