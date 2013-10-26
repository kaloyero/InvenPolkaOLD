<?php
class Categoria extends AppModel {
        public $name = 'Categoria';

		public $validate = array(
			'Nombre' => array(
				'ruleName' => array(
					'rule' => 'notEmpty',
					'message' => 'El campo no puede estar vacio'
				),
				'ruleName3' => array(
					'rule' => array('maxLength', '50'),
					'message' => 'Maximo 50 caracteres'
				),
			),
		);
public function GetData() {
		/** Paging*/
			$results =$this->query('SELECT Nombre FROM categorias limit '.$_GET['iDisplayStart'].' ,'.$_GET['iDisplayLength']);
			$arrayData=array();

			foreach($results as $j){
				array_push($arrayData, array($j["categorias"]["Nombre"]));
			}

			$test = array(
							"sEcho" => intval($_GET['sEcho']),
 		                	"iTotalRecords" => 130,
		                	"iTotalDisplayRecords" => 13,
							"aaData"=> $arrayData
						  );
			return $test;
	}
}
?>