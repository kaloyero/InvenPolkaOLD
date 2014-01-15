<?php

class Configuracion extends Model {
	
	public function GetData() {
        //Columnas por las que se va a filtrar
	    $aColumnsFilter = array( 'Nombre' );
		//Partes del query
		$select = "SELECT Nombre FROM categorias ";
		$limit = 'limit '.$_GET['iDisplayStart'].' ,'.$_GET['iDisplayLength'] ;
		$orderBy = " order by Nombre ";
		$sWhere = "";
		
		/*BUSQUEDA*/
        if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumnsFilter) ; $i++ )
            {
                $sWhere .= "`Nombre` LIKE '%".$_GET['sSearch']."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
		
		$query = $select.$sWhere.$orderBy.$limit;

		/** Paging*/
		$results =$this->query($query);
//		$total = $this->find('count');
		$total = 35;

		// Verify it worked
//		if (!$result) echo mysql_error();
//		$row = mysql_fetch_row($result);


      $arrayData=array();

      foreach($results as $j){
        array_push($arrayData, array($j["categorias"]["Nombre"]));
      }

      $test = array(
              "sEcho" => intval($_GET['sEcho']),
                       "iTotalRecords" => $total,
                       "iTotalDisplayRecords" => $total,
              "aaData"=> $arrayData
               );
			return $test;
	}
	
}
