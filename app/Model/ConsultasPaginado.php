<?php
	App::import('Model','Articulo');
	App::import('Model','Categoria');
	App::import('Model','Proyecto');
	App::import('Model','Estudio');
	App::import('Model','Deposito');
	App::import('Model','Inventario');
	App::import('Model','Pedido');
	App::import('Model','MovimientoInventario');

class ConsultasPaginado extends AppModel {
	public $name = 'ConsultasPaginado';


/********************************************************************************\
****************************** {INICIO} CONFIGURACION -> DATATABLE ***************
\********************************************************************************/

	/*   */
	function getDataCategorias() {
		$tabla = 'categorias';
		$model=new Categoria();
		//Columnas que voy a mostrar
	    $aColumns = array( 'id','Nombre');
        //Columnas por las que se va a filtrar
	    $aColumnsFilter = array( 'Nombre' );
		//Columna por la cual se va ordenar
		$orderByfield = 'Nombre';

		$output = $this->getDataDefault($model,$tabla,$aColumns,$aColumnsFilter,$orderByfield,false);

		return $output;
	}

	function getDataConfig($tabla,$modelo,$columnaId) {
		$model=new Categoria();
		$output = $this->getDataConfigExe($model,$tabla,$modelo,$columnaId);

		return $output;
	}

	/* Este metodo crearía la tabla para aquellas tablas que muestren datos solamente de una tabla */
	private function getDataConfigExe($model,$tabla,$modelo,$columnaId) {
			//Consigue el query que se va ejecutar
			$query=$this->getDataConfigQuery($tabla,$modelo,$columnaId);
			//Ejecuta el query, obtengo las filas
			$rows =$model->query("".$query['select'].";");
			//Obtengo los totales
			$totales = $this->getTotales($model,$query);
			//Proceso los campos para llenar la tabla
			$arrayData=$this->getArrayDataConfig($rows);
			//Obtengo la tabla
			$output = $this->createConfigTable($arrayData,$totales["total"],$totales["tDisplay"]);
	
			return $output;
	}

	/* Este metodo crea el query que se va ejecutar para obtener la lista de configuracion
		Devuelve 	query['select'] -> Sentencia select
					query['where']  -> Sentencia where
	*/
	private function getDataConfigQuery($tabla,$modelo,$columnaId) {

		//Partes del query
		$select = "SELECT `tab`.`id`,`tab`.`Nombre` ,`cat`.`IdCategoria`";
		$from = " FROM `".$tabla."` `tab` LEFT JOIN  `".$modelo."_categorias`  `cat` ON (  `tab`.`id` =  `cat`.`".$columnaId."` AND  `cat`.`Inactivo` LIKE  'F' )  ";
		$sWhere = " WHERE  `tab`.`Inactivo` LIKE  'F' ";
		$limit = 'limit '.$_GET['iDisplayStart'].' ,'.$_GET['iDisplayLength'] ;
		$orderBy = " order by `tab`.`Nombre`, `cat`.`IdCategoria` ";
		
		/*BUSQUEDA*/
		//Si el wehre viene vacio
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
			$sWhere .= " AND `tab`.`Nombre` LIKE '%".( $_GET['sSearch'] )."%'";
		}

		$query['select'] = $select.$from.$sWhere.$orderBy.$limit;
		$query['selectWOL'] = $select.$from.$sWhere;
		$query['from'] =  $from;
		$query['where'] = $sWhere;

		return $query;

	}

private function getArrayDataConfig($rows) {
	  $model=new Categoria();
	  $categoryList = $model->find('list',array('fields'=>array('Categoria.id','Categoria.Nombre')));
      $arrayDt=array();	  

	  $add = false;	
	  $repe = 0;	
	  $fila=array();
  	  $icono = "<div><div style= 'width:20%; float:left; min-width:100px; text-align:center;'> <a><img style= 'width:30px;height:30px' src='/InvenPolka/app/webroot/files/gif/desactivar.png' /></a></div></div>";

      foreach($rows as $j){
			$id = array($j['tab']['id']);	
			if ($repe == $id){
				$fila[2] = $fila[2]."<BR>".$categoryList[$j['cat']['IdCategoria']];
			} else {
				if ($add) {
					array_push($arrayDt, $fila);
				    $fila=array();
				}
				$add = true;
				$repe = array($j['tab']['id']);	
				$fila[0] = $repe;
				$fila[1] = array($j['tab']['Nombre']);
				$fila[2] = $categoryList[$j['cat']['IdCategoria']];
				$fila[3] = array($icono);

			}
      }
	  array_push($arrayDt, $fila);
	  return $arrayDt;

}

	////////////////////////////// {FIN} CONFIGURACION -> DATATABLE //////////////////////////////

	/********************************************************************************\
	****************************** {INICIO} Proyecto -> DATATABLE ***************
	\********************************************************************************/

		/*   */
		function getDataProyectos() {
				$model=new Proyecto();
				$tabla="proyectos";
				//Columnas que voy a mostrar
			    $aColumns = array( 'id','Nombre','Director');
		        //Columnas por las que se va a filtrar
			    $aColumnsFilter = array( 'Nombre','Director' );
				//Columna por la cual se va ordenar
				$orderByfield = 'Nombre';
				$output = $this->getDataDefault($model,$tabla,$aColumns,$aColumnsFilter,$orderByfield,true);
				return $output;
		}

////////////////////////////// {FIN} PROYECTO -> DATATABLE //////////////////////////////

/********************************************************************************\
****************************** {INICIO} ESTUDIOS -> DATATABLE ********************
\********************************************************************************/

			/*   */
		function getDataEstudios() {
				$model=new Estudio();
				$tabla="estudios";
				//Columnas que voy a mostrar
				$aColumns = array( 'id','Nombre','Descripcion');
				//Columnas por las que se va a filtrar
				$aColumnsFilter = array( 'Nombre','Descripcion' );
				//Columna por la cual se va ordenar
				$orderByfield = 'Nombre';
				$output = $this->getDataDefault($model,$tabla,$aColumns,$aColumnsFilter,$orderByfield,true);
				return $output;
			}
////////////////////////////// {FIN} ESTUDIOS -> DATATABLE //////////////////////////////

/*************************************************************************************\
****************************** {INICIO} DEPOSITOS -> DATATABLE *************************
\*************************************************************************************/

		function getDataDepositos() {
			$model=new Estudio();
			$tabla="depositos";
			//Columnas que voy a mostrar
			$aColumns = array( 'id','Nombre');
			//Columnas por las que se va a filtrar
			$aColumnsFilter = array( 'Nombre' );
			//Columna por la cual se va ordenar
			$orderByfield = 'Nombre';
			$output = $this->getDataDefault($model,$tabla,$aColumns,$aColumnsFilter,$orderByfield,true);
			return $output;
		}

////////////////////////////// {FIN} DEPOSITOS -> DATATABLE //////////////////////////////


/*************************************************************************************\
****************************** {INICIO} Inventario -> DATATABLE *************************
\*************************************************************************************/

		function getDataInventarios() {
			$model=new Inventario();
			$tabla="inventarios_vista";
			//Columnas que voy a mostrar

			$aColumns = array( 'id' ,'articulo', 'dir' ,'idFoto',  'Disponibilidad'   ,  'proyecto');
			//Columnas por las que se va a filtrar
			$aColumnsFilter = array(  'Disponibilidad' ,'articulo' ,  'proyecto'  ,  'ubicacion' );
			//Columna por la cual se va ordenar
			$orderByfield = 'articulo,proyecto';
			$output = $this->getDataDefault($model,$tabla,$aColumns,$aColumnsFilter,$orderByfield,true);
			return $output;
		}

////////////////////////////// {FIN} Inventario -> DATATABLE //////////////////////////////

/********************************************************************************\
****************************** {INICIO} Movimiento -> DATATABLE ***************
\********************************************************************************/

		/*   */
		function getDataMovimientos() {
				$model=new MovimientoInventario();
				$tabla="movimientos_vista";
				//Columnas que voy a mostrar
			    $aColumns = array( 'id','Numero','Fecha','TipoMovimiento','deposito_orig','deposito_dest','pedido','proyecto');
		        //Columnas por las que se va a filtrar
			    $aColumnsFilter = array( 'Numero','Fecha','Descripcion','TipoMovimiento','deposito_orig','deposito_dest','pedido','proyecto' );
				//Columna por la cual se va ordenar
				$orderByfield = 'Numero desc';
				$output = $this->getDataDefault($model,$tabla,$aColumns,$aColumnsFilter,$orderByfield,true);
				return $output;
		}

////////////////////////////// {FIN} PROYECTO -> DATATABLE //////////////////////////////


/*************************************************************************************\
****************************** {INICIO} Pedidos -> DATATABLE *************************
\*************************************************************************************/

		function getDataPedidos($tipoLista) {
			/*
			tipoLista
			E -> pedidos que entraron
			S -> pedidos de Salida
			H -> historico de pedidos

			*/

			$model=new Pedido();
			$tabla="pedidos_vista";
			//Columnas que voy a mostrar

			$aColumns = array( 'id' ,'Numero', 'Fecha' ,'proyecto', 'estado'  );
			//Columnas por las que se va a filtrar
			$aColumnsFilter = array(  'Numero' ,'proyecto'  );
			//Columna por la cual se va ordenar
			$orderByfield = 'Fecha, proyecto, Numero';

			//CREATE TABLE
			//Consigue el query que se va ejecutar
			$query=$this->getDataDefaultQuery($tabla,$aColumns,$aColumnsFilter,$orderByfield,"");
			//Ejecuta el query, obtengo las filas
			$rows =$model->query("".$query['select'].";");
			//Obtengo los totales
			$totales = $this->getTotales($model,$query);
			//Proceso los campos para llenar la tabla
			$arrayData=$this->getArrayDataPedido($tabla,$rows,$aColumns,$query['select'],$tipoLista);
			//Obtengo la tabla
			$output = $this->createConfigTable($arrayData,$totales["total"],$totales["tDisplay"]);

			return $output;
		}

private function getArrayDataPedido($tabla,$rows,$aColumns,$titi,$tipoLista) {
      $arrayDt=array();

  //    array_push($arrayDt, array($titi));

      foreach($rows as $j){
			$fila=array();
	        foreach($aColumns as $column){
					array_push($fila, array($j[$tabla][$column]));
			}

			$botonera = " <div>";

			$btnVer ="<div style= 'width:20%; float:left; min-width:10px; text-align:center;'> <a href='/InvenPolka/pedidos/edit/".$j[$tabla]['id']."' class='edit'><img style= 'width:30px;height:30px' src='/InvenPolka/app/webroot/img/view.png' /></a></div>";
			$btnAccion = "";
			$btnPrintPedido = "";
			$btnPrintComanda = "";
			switch ($tipoLista) {
				case 'E':
					$btnAccion= "<div style= 'width:20%; float:left; min-width:10px; text-align:center;'> <a href='/InvenPolka/pedidos/confirmarPedido/".$j[$tabla]['id']."' class='confirm'><img style= 'width:30px;height:30px' src='/InvenPolka/app/webroot/img/confirmar.png' /></a></div>";
					$btnPrintPedido = "";
				break;
				case 'S':
					$btnAccion = "<div style= 'width:20%; float:left; min-width:10px; text-align:center;'> <a href='/InvenPolka/movimientoInventarios/asignacionAProyectos/".$j[$tabla]['id']."' class='asignarAProyecto'><img style= 'width:30px;height:30px' src='/InvenPolka/app/webroot/img/armar.png' /></a></div>";
					$btnPrintComanda = "";
					break;
				case 'H':
					$btnPrintPedido = "";
					if ($j[$tabla]["estado"] == "confirmado"){
						$btnPrintComanda = "";
					}
					break;
			}
			$botonera = $botonera.$btnVer.$btnAccion.$btnPrintPedido.$btnPrintComanda ;

			array_push($fila, $botonera );

			array_push($arrayDt, $fila);
      }
	 return $arrayDt;
}


////////////////////////////// {FIN} Pedidos -> DATATABLE //////////////////////////////

/********************************************************************************\
****************************** {INICIO} ARTICULO -> DATATABLE ***************
\********************************************************************************/

	/* Para el listado de Articulos */
	function getDataArticulos() {
		$tabla="articulos_vista";
		$model=new Articulo();
		//Columnas que voy a mostrar
	    $aColumns = array( 'id','CodigoArticulo','dir','idFoto','descripcion','categoria','decorado','objeto','estilo','material','dimension','stock_total','stock_dispo' );
        //Columnas por las que se va a filtrar
	    $aColumnsFilter = array( 'CodigoArticulo','descripcion','categoria','decorado','objeto','estilo','material','dimension' );
		//Columna por la cual se va ordenar
		$orderByfield = 'CodigoArticulo';

		//CREATE TABLE//
		//Consigue el query que se va ejecutar
		$query=$this->getDataDefaultQuery($tabla,$aColumns,$aColumnsFilter,$orderByfield,"");
		//Ejecuta el query, obtengo las filas
		$rows =$model->query("".$query['select'].";");
		//Obtengo los totales
		$totales = $this->getTotales($model,$query);
		//Proceso los campos para llenar la tabla
		$arrayData=$this->getArrayDataArticulos($tabla,$rows,$query['select']);
		//Obtengo la tabla
		$output = $this->createConfigTable($arrayData,$totales["total"],$totales["tDisplay"]);
//		$output = $this->createConfigTable($arrayData,40,40);

		return $output;

	}

	/* Para la funcionalidad Busqueda de Articulos */
	function getDataArticulosSearch($whereFilter) {
		$tabla="articulos_vista";
		$model=new Articulo();
		//Columnas que voy a mostrar
	    $aColumns = array( 'id','CodigoArticulo','dir','idFoto','descripcion','categoria','decorado','objeto','estilo','material','dimension' ,'id_categoria','id_decorado','id_objeto','id_estilo','id_material','id_dimension','stock_total','stock_dispo');
        //Columnas por las que se va a filtrar
	    $aColumnsFilter = array(  );
		//Columna por la cual se va ordenar
		$orderByfield = 'CodigoArticulo,categoria,decorado,objeto,estilo,material,dimension';

		//CREATE TABLE//
		//Consigue el query que se va ejecutar
		$query=$this->getDataDefaultQuery($tabla,$aColumns,$aColumnsFilter,$orderByfield,$whereFilter);
	    $aColumnsFilter = array('CodigoArticulo','descripcion','categoria','decorado','objeto','estilo','material','dimension');
		$query=$this->getDataArticuloQuerySearch($tabla,$query,$aColumnsFilter,$orderByfield);
		//Ejecuta el query, obtengo las filas
		$rows =$model->query("".$query['select'].";");
		//Obtengo los totales
		$totales = $this->getTotales($model,$query);
		//Proceso los campos para llenar la tabla
		$arrayData=$this->getArrayDataArticulos($tabla,$rows,$query['select']);
		//Obtengo la tabla
		$output = $this->createConfigTable($arrayData,$totales["total"],$totales["tDisplay"]);
//		$output = $this->createConfigTable($arrayData,40,40);

		return $output;
	}

/*
	Devuelve 	query['select'] -> Sentencia select
				query['where']  -> Sentencia where
 */
private function getDataArticuloQuerySearch($tabla,$query,$aColumnsFilter,$orderBy) {

	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" ){
		$select = "SELECT id, CodigoArticulo, dir, idFoto, descripcion, categoria, decorado, objeto, estilo, material, dimension, id_categoria, id_decorado, id_objeto, id_estilo, id_material, id_dimension";
		$from = " FROM (".$query['selectWOL'].") as `".$tabla."` ";
		$sWhere = "";
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

		$limit = 'limit '.$_GET['iDisplayStart'].' ,'.$_GET['iDisplayLength'] ;
		$orderBy = " order by ".$orderBy." ";

		$query['select'] = $select.$from.$sWhere.$orderBy.$limit;
		$query['from'] =   $from;
		$query['where'] = $sWhere;
	}

	return $query;

}

	private function getArrayDataArticulos($tabla,$rows,$titi) {
      $arrayDt=array();

/*			$fila=array();
        	array_push($fila, "1");
	        array_push($fila, array($titi));

			array_push($arrayDt, $fila);
//*/
//      array_push($arrayDt, array());
      foreach($rows as $j){
			$fila=array();
        	array_push($fila, array($j[$tabla]['id']));
	        array_push($fila, array($j[$tabla]['CodigoArticulo']));
			array_push($fila, '<img style="width:250px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/idFoto/'.$j[$tabla]['dir'].'/small_'.$j[$tabla]['idFoto'].'" alt="CakePHP" >');
//	        array_push($fila, array($titi));
			array_push($fila, array($j[$tabla]['categoria']));
			array_push($fila, array($j[$tabla]['objeto']));
			array_push($fila, array($j[$tabla]['decorado']));
			array_push($fila, array($j[$tabla]['material']));
			array_push($fila, array($j[$tabla]['dimension']));
			array_push($fila, array($j[$tabla]['estilo']));
			array_push($fila, array($j[$tabla]['stock_total']));
			array_push($fila, array($j[$tabla]['stock_dispo']));
			array_push($arrayDt, $fila);
      }
//*/

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
			array_push($fila, "<div><div style= 'width:20%; float:left; min-width:100px; text-align:center;'> <a><img style= 'width:30px;height:30px' src='/InvenPolka/app/webroot/files/gif/desactivar.png' /></a></div></div>");
			array_push($arrayDt, $fila);
      }
	 return $arrayDt;

}
private function getArrayDataWithEditLink($tabla,$rows,$aColumns,$titi) {
      $arrayDt=array();

  //    array_push($arrayDt, array($titi));

      foreach($rows as $j){
			$fila=array();
	        foreach($aColumns as $column){
				if ($column != "dir" && $column != "idFoto"){
					array_push($fila, array($j[$tabla][$column]));
				} else {
					//Si es foto
					if ($column == "idFoto"){
						array_push($fila, '<img src="/InvenPolka/app/webroot/files/articulo/idFoto/'.$j[$tabla]['dir'].'/small_'.$j[$tabla]['idFoto'].'" alt="CakePHP" width="200px">');
					}
				}
			}
			array_push($fila, " <div><div style= 'width:20%; float:left; min-width:100px; text-align:center;'> <a href='/InvenPolka/articulos/edit/".$j[$tabla]['id']."' class='edit'><img style= 'width:30px;height:30px' src='/InvenPolka/app/webroot/files/gif/edit.jpg' /></a></div><div style= 'width:20%; float:left; min-width:100px; text-align:center;'> <a><img style= 'width:30px;height:30px' src='/InvenPolka/app/webroot/files/gif/desactivar.png' /></a></div></div>");
			array_push($arrayDt, $fila);
      }
	 return $arrayDt;

}

/* Este metodo crearía la tabla para aquellas tablas que muestren datos solamente de una tabla */
private function getDataDefault($model,$tabla,$aColumns,$aColumnsFilter,$orderByfield,$withEditLink) {
		//Consigue el query que se va ejecutar
		$query=$this->getDataDefaultQuery($tabla,$aColumns,$aColumnsFilter,$orderByfield,"");
		//Ejecuta el query, obtengo las filas
		$rows =$model->query("".$query['select'].";");
		//Obtengo los totales
		$totales = $this->getTotales($model,$query);
		//Proceso los campos para llenar la tabla
		if ($withEditLink==true){
			$arrayData=$this->getArrayDataWithEditLink($tabla,$rows,$aColumns,$query['select']);

		}else{
			$arrayData=$this->getArrayData($tabla,$rows,$aColumns,$query['select']);

		}
		//Obtengo la tabla
		$output = $this->createConfigTable($arrayData,$totales["total"],$totales["tDisplay"]);

		return $output;
}

/* Este metodo crea el query que se va ejecutar para obtener la lista
	Devuelve 	query['select'] -> Sentencia select
				query['where']  -> Sentencia where
 */
private function getDataDefaultQuery($tabla,$aColumns,$aColumnsFilter,$orderByfield,$where) {

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
		//Si el wehre viene vacio
		if ($where == ""){
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
		} else {
			$sWhere = " WHERE (".$where.")";
		}

		$query['select'] = $select.$from.$sWhere.$orderBy.$limit;
		$query['selectWOL'] = $select.$from.$sWhere;
		$query['from'] =  $from;
		$query['where'] = $sWhere;

		return $query;

}

}
?>