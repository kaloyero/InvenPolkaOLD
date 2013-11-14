<?php
	App::import('Model','ConsultasSelect');


class ConfiguracionesController extends AppController {



    function index() {

    }

   public function view($id = null) {

   }

    public function add() {

    }

	function configuraciones($id = null) {
		$consultasSelect = new ConsultasSelect();
		$this->set('data', $consultasSelect ->getConfiguraciones($id));
		//echo json_encode($consultasSelect ->getConfiguraciones());
	}

	function edit($id = null) {

	}

	function delete($id) {

	}
}
?>
