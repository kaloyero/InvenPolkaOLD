<?php
	App::import('Model','Articulo');
	App::import('Model','Categoria');	

class ConsultasPaginado extends AppModel {
	public $name = 'ConsultasPaginado';


/********************************************************************************\		
****************************** {INICIO} CONFIGURACION -> DATATABLE ***************
\********************************************************************************/

	/*   */
	function getDataConfig($tabla) {
		$model=new Categoria();
		//Columnas que voy a mostrar
	    $aColumns = array( 'Nombre' );
        //Columnas por las que se va a filtrar
	    $aColumnsFilter = array( 'Nombre' );
		//Columna por la cual se va ordenar
		$orderByfield = 'Nombre';

		$output = $this->getDataDefault($model,$tabla,$aColumns,$aColumnsFilter,$orderByfield);

		return $output;
	}

////////////////////////////// {FIN} CONFIGURACION -> DATATABLE //////////////////////////////

/********************************************************************************\		
****************************** {INICIO} ARTICULO -> DATATABLE ***************
\********************************************************************************/

	/*   */
	function getDataArticulos() {
		$model=new Articulo();
		$tabla="articulos";
		//Columnas que voy a mostrar
	    $aColumns = array( 'id','CodigoArticulo','idFoto','dir' );
        //Columnas por las que se va a filtrar
	    $aColumnsFilter = array( 'CodigoArticulo' );
		//Columna por la cual se va ordenar
		$orderByfield = 'CodigoArticulo';

		$output = $this->getDataDefault($model,$tabla,$aColumns,$aColumnsFilter,$orderByfield);

		return $output;
	}

	private function getArrayDataArticulos($tabla,$rows,$aColumns,$titi) {			
      $arrayDt=array();

//      array_push($arrayDt, array($titi));					
		
      foreach($rows as $j){
			$fila=array();
	        array_push($fila, array($j[$tabla]['CodigoArticulo']));					
			array_push($fila, '<img src="/InvenPolka/app/webroot/files/articulo/IdFoto/'.$j[$tabla]['dir'].'/'.$j[$tabla]['idFoto'].'" alt="CakePHP" width="200px">');					
			array_push($fila, "<a href='/InvenPolka/articulos/edit/".$j[$tabla]['id']."' class='edit'>Edit</a>");					

			array_push($arrayDt, $fila);					
      }
	 return $arrayDt;
	}


////////////////////////////// {FIN} ARTICULOS -> DATATABLE //////////////////////////////


/********************************************************************************\
**********************************************************************************
****************************** {INICIO} GENERAL -> DATATABLE *********************
**********************************************************************************
\********************************************************************************/

/* Este metodo devuelve la sentencia COUNT para obtener la cantidad de itms que abarca la consulta*/
private function getConfigDisplayCountQuery($tabla,$where) {
	$select = "SELECT COUNT( * ) AS var FROM ".$tabla." ".$where;	
	
	return $select;
}

/*TODO modificar este metodo*/
public function getVarParam($number) {
	  //Estoy recuperando el parametro Var que traigo cuando ejecuto el select count
      foreach($number as $j){
		$var = array($j[0]["var"]);
	  }
	  
	  return $var;
}


/* Devuelve la informacion que necesita la tabla 
$tabla			->	nombre de la tabla 
$rows			->	filas de la consulta
$aColumns		->	columnas que vamos a mostrar
$total			->	Total de registros en la tabla
$totalDisplay	->	Total de registros filtrados
*/
private function createConfigTable($arrayData,$total,$totalDisplay) {			
      $display = array(
              "sEcho" => intval($_GET['sEcho']),
                       "iTotalRecords" => $total,
                       "iTotalDisplayRecords" => $totalDisplay,
              "aaData"=> $arrayData
               );
			return $display;
}		

private function getTotales ($model,$tabla,$where){
		//Obtengo el total de registros en la tabla
		$total = $this->getVarParam($model->query($this->getConfigDisplayCountQuery($tabla,"")));
		//Obtengo el total de registros filtrados
		$totalDisplay = $this->getVarParam($model->query($this->getConfigDisplayCountQuery($tabla,$where)));

		$totales["total"]=$total;
		$totales["tDisplay"]=$totalDisplay;		
		
		return $totales;
}


private function getArrayData($tabla,$rows,$aColumns,$titi) {			
      $arrayDt=array();

      array_push($arrayDt, array($titi));					
		
      foreach($rows as $j){
			$fila=array();
	        foreach($aColumns as $column){
			        array_push($fila, array($j[$tabla][$column]));					
			}
			array_push($arrayDt, $fila);					
      }
	 return $arrayDt;

}

/* Este metodo crearía la tabla para aquellas tablas que muestren datos solamente de una tabla */
private function getDataDefault($model,$tabla,$aColumns,$aColumnsFilter,$orderByfield) {			
		//Consigue el query que se va ejecutar
		$query=$this->getDataDefaultQuery($tabla,$aColumns,$aColumnsFilter,$orderByfield);
		//Ejecuta el query, obtengo las filas
		$rows =$model->query("".$query['select'].";");
		//Obtengo los totales
		$totales = $this->getTotales($model,$tabla,$query['where']); 
		//Proceso los campos para llenar la tabla
		$arrayData=$this->getArrayDataArticulos($tabla,$rows,$aColumns,$query['select']);
		//Obtengo la tabla
		$output = $this->createConfigTable($arrayData,$totales["total"],$totales["tDisplay"]);
		
		return $output;
}

/* Este metodo crea el query que se va ejecutar para obtener la lista de configuracion
	Devuelve 	query['select'] -> Sentencia select
				query['where']  -> Sentencia where
 */
private function getDataDefaultQuery($tabla,$aColumns,$aColumnsFilter,$orderByfield) {

        //Columnas por las que se va a filtrar
	    $aColumnsShow = "";
		$firstColumn=0;
		foreach($aColumns as $column){
			if ($firstColumn == 0){
				$aColumnsShow = $column;
				$firstColumn=1;
			} else {
				$aColumnsShow = $aColumnsShow.','.$column;
			}
		}

		//Partes del query
		$select = "SELECT ".$aColumnsShow." FROM ".$tabla." ";
		$limit = 'limit '.$_GET['iDisplayStart'].' ,'.$_GET['iDisplayLength'] ;
		$orderBy = " order by ".$orderByfield." ";
		$sWhere = "";
		
		/*BUSQUEDA*/
        if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
        {
            $sWhere = "WHERE (";
			            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= "`".$aColumns[$i]."` LIKE '%".( $_GET['sSearch'] )."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
		
		$query['select'] = $select.$sWhere.$orderBy.$limit;
		$query['where'] = $sWhere;

		return $query;

}

}
?>