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
		$aColumns = array( 'Nombre' );
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		/* DB table to use */
		$sTable = "ajax";
		/*
	         * Paging
	        */
	        $sLimit = "";
	        if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	        {
	            $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
	                    intval( $_GET['iDisplayLength'] );
	        }
			//$this->query('SELECT * FROM categorias');



			$output = array(
			                "sEcho" => intval($_GET['sEcho']),
			                "iTotalRecords" => 10,
			                "iTotalDisplayRecords" => 10,
			                "aaData" => array()
			        );

					$results =$this->query('SELECT Nombre FROM categorias limit '.$_GET['iDisplayStart'].' ,'.$_GET['iDisplayLength']);

			        $arrayData=array(
			        );

					    foreach($results as $j){
							array_push($arrayData, array($j["categorias"]["Nombre"]));
						//return $j["categorias"]["Nombre"];

					        //if($j == $currItem['Item']['id']){
					           // $rank = $i;
					           // break;
					       // }
					    }

					//array_push($arrayData, "length");
						$test = array
						  (
						"sEcho" => intval($_GET['sEcho']),
 		                "iTotalRecords" => 130,
		                "iTotalDisplayRecords" => 13,
						"aaData"=> $arrayData
						  );
						return $test;





	}
}
?>