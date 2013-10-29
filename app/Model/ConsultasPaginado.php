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
	    $aColumns = array( 'id','Nombre' );
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
		$tabla="Art";
		//Columnas que voy a mostrar
	    $aColumns = array( 'id','CodigoArticulo' );

		//Consigue el query que se va ejecutar
		$query=$this->getDataArticuloQuery($tabla);
		//Ejecuta el query, obtengo las filas
		$rows =$model->query("".$query['select'].";");
		//Obtengo los totales
		$totales = $this->getTotales($model,$query);
		//Proceso los campos para llenar la tabla
		$arrayData=$this->getArrayDataArticulos($tabla,$rows,$query['select']);
		//Obtengo la tabla
 		$output = $this->createConfigTable($arrayData,$totales["total"],$totales["tDisplay"]);

		return $output;

	}

/*
	Devuelve 	query['select'] -> Sentencia select
				query['where']  -> Sentencia where
 */
private function getDataArticuloQuery($tabla) {

		//Partes del query
		$select = "SELECT `Art`.`id` as id, `Art`.`CodigoArticulo` as `CodigoArticulo`, `Art`.`dir` as `dir`, `Art`.`idFoto` as `idFoto`, `Cat`.`Nombre` , `Dec`.`Nombre` as `decorado`, `Obj`.`Nombre` as `objeto`, `Est`.`Nombre` as `estilo`, `Mat`.`Nombre` as `materia`, `Dim`.`Nombre` as `dimension` ";
		$from = " FROM `inventario`.`articulos` as `".$tabla."`
LEFT JOIN `inventario`.`categorias` AS `Cat` ON (`".$tabla."`.`IdCategoria` = `Cat`.`id`)
LEFT JOIN `inventario`.`decorados` AS `Dec` ON (`".$tabla."`.`IdDecorado` = `Dec`.`id`)
LEFT JOIN `inventario`.`objetos` AS `Obj` ON (`".$tabla."`.`IdObjeto` = `Obj`.`id`)
LEFT JOIN `inventario`.`estilos` AS `Est` ON (`".$tabla."`.`IdEstilo` = `Est`.`id`)
LEFT JOIN `inventario`.`materiales` AS `Mat` ON (`".$tabla."`.`IdMaterial` = `Mat`.`id`)
LEFT JOIN `inventario`.`dimensiones` AS `Dim` ON (`".$tabla."`.`IdDimension` = `Dim`.`id`) ";


		$limit = 'limit '.$_GET['iDisplayStart'].' ,'.$_GET['iDisplayLength'] ;
		$orderBy = " order by `".$tabla."`.`CodigoArticulo` ";
		$sWhere = "";

		/*BUSQUEDA*/
        if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
        {
            $sWhere = "WHERE (";
			            $sWhere = "WHERE (";
            $sWhere .= "`".$tabla."`.`CodigoArticulo` LIKE '%".( $_GET['sSearch'] )."%' OR ";
            $sWhere .= "`Cat`.`Nombre` LIKE '%".( $_GET['sSearch'] )."%' OR ";
            $sWhere .= "`Dec`.`Nombre` LIKE '%".( $_GET['sSearch'] )."%' OR ";
            $sWhere .= "`Obj`.`Nombre` LIKE '%".( $_GET['sSearch'] )."%' OR ";
            $sWhere .= "`Est`.`Nombre` LIKE '%".( $_GET['sSearch'] )."%' OR ";
            $sWhere .= "`Mat`.`Nombre` LIKE '%".( $_GET['sSearch'] )."%' OR ";
            $sWhere .= "`Dim`.`Nombre` LIKE '%".( $_GET['sSearch'] )."%' ";

            $sWhere .= ')';
        }

		$query['select'] = $select.$from.$sWhere.$orderBy.$limit;
		$query['from'] =   $from;
		$query['where'] = $sWhere;

		return $query;

}

	private function getArrayDataArticulos($tabla,$rows,$titi) {
      $arrayDt=array();

/*			$fila=array();
        	array_push($fila, "1");
	        array_push($fila, array($titi));
			array_push($arrayDt, $fila);
*/
//      array_push($arrayDt, array());

      foreach($rows as $j){
			$fila=array();
        	array_push($fila, array($j[$tabla]['id']));
	        array_push($fila, array($j[$tabla]['CodigoArticulo']));
			array_push($fila, '<img src="/InvenPolka/app/webroot/files/articulo/IdFoto/'.$j[$tabla]['dir'].'/'.$j[$tabla]['idFoto'].'" alt="CakePHP" width="200px">');
//	        array_push($fila, array($titi));
//			array_push($fila, array($j[$tabla]['Cat']['Nombre']));
//			array_push($fila, array($j[$tabla]['decorado']));
//			array_push($fila, array($j[$tabla]['materia']));
//			array_push($fila, array($j[$tabla]['dimension']));
//			array_push($fila, array($j[$tabla]['estilo']));
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
private function getConfigDisplayCountQuery($from,$where) {
	$select = "SELECT COUNT( * ) AS var ".$from." ".$where;

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

private function getTotales ($model,$query){
		//Obtengo el total de registros en la tabla
		$total = $this->getVarParam($model->query($this->getConfigDisplayCountQuery($query['from'],"")));
		//Obtengo el total de registros filtrados
		$totalDisplay = $this->getVarParam($model->query($this->getConfigDisplayCountQuery($query['from'],$query['where'])));

		$totales["total"]=$total;
		$totales["tDisplay"]=$totalDisplay;

		return $totales;
}


private function getArrayData($tabla,$rows,$aColumns,$titi) {
      $arrayDt=array();

  //    array_push($arrayDt, array($titi));

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
		$totales = $this->getTotales($model,$query);
		//Proceso los campos para llenar la tabla
		$arrayData=$this->getArrayData($tabla,$rows,$aColumns,$query['select']);
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
		$select = "SELECT ".$aColumnsShow;
		$from = " FROM ".$tabla." ";
		$limit = 'limit '.$_GET['iDisplayStart'].' ,'.$_GET['iDisplayLength'] ;
		$orderBy = " order by ".$orderByfield." ";
		$sWhere = "";

		/*BUSQUEDA*/
        if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
        {
            $sWhere = "WHERE (";
			            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumnsFilter) ; $i++ )
            {
                $sWhere .= "`".$aColumnsFilter[$i]."` LIKE '%".( $_GET['sSearch'] )."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

		$query['select'] = $select.$from.$sWhere.$orderBy.$limit;
		$query['from'] =  $from;
		$query['where'] = $sWhere;

		return $query;

}

}
?>