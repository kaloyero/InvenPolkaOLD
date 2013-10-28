<?php
	App::import('Model','Proyecto');
	App::import('Model','Articulo');
	App::import('Model','Deposito');
	App::import('Model','Ubicacione');
	App::import('Model','Estudio');
	App::import('Model','Categoria');


class ConsultasSelect extends AppModel {
	public $name = 'ConsultasSelect';

//////////////////////////////PROYECTOS
	function getProyectos() {
		$proyecto=new Proyecto();
		$proyectos=$proyecto->find('list',array('fields'=>array('Proyecto.id','Proyecto.Nombre')));
		return $proyectos;
	}

//////////////////////////////UBICACIONES
	function getUbicaciones() {
		$ubicacione=new Ubicacione();
		$ubicaciones=$ubicacione->find('list',array('fields'=>array('Ubicacione.id','Ubicacione.CodigoUbicacion','Ubicacione.Descripcion')));
		return $ubicaciones;
	}

    function getUbicacionesByDeposito($id = null) {
		$model=new Ubicacione();
		$ubicaciones = $model->find('list', array('fields' => array('Ubicacione.id','Ubicacione.CodigoUbicacion'),
        'conditions' => array('Ubicacione.IdDeposito =' => $id)));
		return $ubicaciones;
    }

//////////////////////////////DEPOSITOS
	function getDepositos() {
		$deposito=new Deposito();
		$depositos=$deposito->find('list',array('fields'=>array('Deposito.id','Deposito.Nombre')));
		return $depositos;
	}

//////////////////////////////ARTICULOS
	function getArticulos() {
		$articulo=new Articulo();
		$articulos=$articulo->find('list',array('fields'=>array('Articulo.id','Articulo.Codigoarticulo')));
		return $articulos;
	}

//////////////////////////////ESTUDIOS
	function getEstudios() {
		$estudio=new Estudio();
		$estudios=$estudio->find('list',array('fields'=>array('Estudio.id','Estudio.Nombre')));
		return $estudios;
	}

//////////////////////////////CONFIGURACION -> DATATABLE

	/*   */
	function getDataConfig($tabla) {
		$model=new Categoria();
		//Consigue el query que se va ejecutar
		$query=$this->getConfigDataQuery($tabla);
		//Ejecuta el query, obtengo las filas
		$rows =$model->query("".$query['select'].";");
		//Obtengo el total de registros en la tabla
		$total = $this->getVarParam($model->query($this->getConfigDisplayCountQuery($tabla,"")));
		//Obtengo el total de registros filtrados
		$totalDisplay = $this->getVarParam($model->query($this->getConfigDisplayCountQuery($tabla,$query['where'])));
		//Proceso la tabla
		$output = $this->createConfigTable($tabla,$rows,$total,$totalDisplay);
		return $output;
	}

/* Este metodo crea el query que se va ejecutar para obtener la lista de configuracion
	Devuelve 	query['select'] -> Sentencia select
				query['where']  -> Sentencia where
 */
private function getConfigDataQuery($tabla) {

        //Columnas por las que se va a filtrar
	    $aColumnsFilter = array( 'Nombre' );
		//Partes del query
		$select = "SELECT id ,Nombre FROM ".$tabla." ";
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

		$query['select'] = $select.$sWhere.$orderBy.$limit;
		$query['where'] = $sWhere;

		return $query;

}

/* Este metodo devuelve la sentencia COUNT para obtener la cantidad de itms que abarca la consulta*/
private function getConfigDisplayCountQuery($tabla,$where) {
	$select = "SELECT COUNT( * ) AS var FROM ".$tabla." ".$where;

	return $select;
}

//TODO modificar este metodo
public function getVarParam($number) {
	  //Estoy recuperando el parametro Var que traigo cuando ejecuto el select count
      foreach($number as $j){
		$var = array($j[0]["var"]);
	  }

	  return $var;
}

/* Devuelve la informacion que necesita la tabla */
private function createConfigTable($tabla,$rows,$total,$totalDisplay) {
      $arrayData=array();

      foreach($rows as $j){
		 $newData=array();
		array_push($newData, $j[$tabla]["id"]);
		array_push($newData, $j[$tabla]["Nombre"]);

        array_push($arrayData, $newData);
      }

      $display = array(
              "sEcho" => intval($_GET['sEcho']),
                       "iTotalRecords" => $total,
                       "iTotalDisplayRecords" => $totalDisplay,
              "aaData"=> $arrayData
               );
			return $display;
}


}
?>