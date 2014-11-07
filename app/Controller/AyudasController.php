<?php
        App::import('Model','ConsultasPaginado');
        App::import('Model','ConsultasSelect');

class AyudasController extends AppController {

    public $helpers = array ('Html','Form');
	var $components    = array('Cookie');

    function index() {
			$privilegios = $this->Session->read("privilegios");
			$this->set('privilegios',$privilegios);
			

    }

   public function view($id = null) {
   }

        function ajaxData() {
			echo json_encode($output);
        }


   public function add() {
    }

	function edit($id = null) {
	}
}
?>