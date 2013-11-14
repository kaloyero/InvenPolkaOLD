<?php
	App::import('Model','Proyecto');
	App::import('Model','Articulo');
	App::import('Model','Deposito');
	App::import('Model','Ubicacione');
	App::import('Model','Estudio');
	App::import('Model','Categoria');
   	App::import('Model','Materiale');
	App::import('Model','Dimensione');
	App::import('Model','Decorado');
	App::import('Model','Estilo');
	App::import('Model','Objeto');
	App::import('Model','Pedido');
	App::import('Model','Inventario');
class ConsultasSelect extends AppModel {
	public $name = 'ConsultasSelect';

/********************************************************************************\
****************************** {INICIO} PROYECTOS ********************************
\********************************************************************************/
	function getProyectos() {
		$proyecto=new Proyecto();
		$proyectos=$proyecto->find('list',array('fields'=>array('Proyecto.id','Proyecto.Nombre')));
		return $proyectos;
	}
////////////////////////////// {FIN} PROYECTOS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} UBICACIONES ******************************
\********************************************************************************/
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
////////////////////////////// {FIN} UBICACIONES //////////////////////////////

/********************************************************************************\
****************************** {INICIO} DEPOSITOS ********************************
\********************************************************************************/
	function getDepositos() {
		$deposito=new Deposito();
		$depositos=$deposito->find('list',array('fields'=>array('Deposito.id','Deposito.Nombre')));
		return $depositos;
	}
////////////////////////////// {FIN} DEPOSITOS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} ARTICULOS ********************************
\********************************************************************************/
	function getArticulos() {
		$articulo=new Articulo();
		$articulos=$articulo->find('list',array('fields'=>array('Articulo.id','Articulo.Codigoarticulo')));
		return $articulos;
	}

	function getArticulosByArrayId($ids) {
		$articulo=new Articulo();
		$condiciones = array("Articulo.id" => $ids);
		$inCondition="";
		foreach ($ids as $id){
			$inCondition= $inCondition.$id.",";
		}
		//Borro la ultima coma
		$inCondition = substr_replace( $inCondition, "", -1 );
		$articulos =$articulo->query("Select * from `articulos`  WHERE `id` IN (".$inCondition.");");
//		$articulos=$articulo->find('all');


	//	$articulos=$articulo->find($condiciones);
		return $articulos;
	}

////////////////////////////// {FIN} ARTICULOS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} ESTUDIOS *********************************
\********************************************************************************/
	function getEstudios() {
		$estudio=new Estudio();
		$estudios=$estudio->find('list',array('fields'=>array('Estudio.id','Estudio.Nombre')));
		return $estudios;
	}

////////////////////////////// {FIN} ESTUDIOS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} CATEGORIAS ********************************
\********************************************************************************/
	function getCategorias() {
		$categoria=new Categoria();
		$categorias=$categoria->find('list',array('fields'=>array('Categoria.id','Categoria.Nombre')));
		return $categorias;
	}
////////////////////////////// {FIN} CATEGORIAS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} ESTILOS ********************************
\********************************************************************************/
	function getEstilos() {
		$estilo=new Estilo();
		$estilos=$estilo->find('list',array('fields'=>array('Estilo.id','Estilo.Nombre')));
		return $estilos;
	}
////////////////////////////// {FIN} ESTILOS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} MATERIALES ********************************
\********************************************************************************/
	function getMateriales() {
		$material=new Materiale();
		$materiales=$material->find('list',array('fields'=>array('Materiale.id','Materiale.Nombre')));
		return $materiales;
	}
////////////////////////////// {FIN} MATERIALES //////////////////////////////

/********************************************************************************\
****************************** {INICIO} DIMENSIONES ********************************
\********************************************************************************/
	function getDimensiones() {
		$dimension=new Dimensione();
		$dimensiones=$dimension->find('list',array('fields'=>array('Dimensione.id','Dimensione.Nombre')));
		return 	$dimensiones;
	}
////////////////////////////// {FIN} DIMENSIONES //////////////////////////////

/********************************************************************************\
****************************** {INICIO} DECORADOS ********************************
\********************************************************************************/
	function getDecorados() {
		$decorado=new Decorado();
		$decorados=$decorado->find('list',array('fields'=>array('Decorado.id','Decorado.Nombre')));
		return $decorados;
	}
////////////////////////////// {FIN} DECORADOS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} OBJETOS ********************************
\********************************************************************************/
	function getObjetos() {
		$objeto=new Objeto();
		$objetos=$objeto->find('list',array('fields'=>array('Objeto.id','Objeto.Nombre')));
		return $objetos;
	}
////////////////////////////// {FIN} OBJETOS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} PEDIDOS ********************************
\********************************************************************************/
	function getPedidoById($id) {
		$model=new Proyecto();
		$pedidos=$model->query("SELECT * FROM `pedidos_vista` WHERE id = '".$id."';");

		return $pedidos;
	}
	//Para que? Porque el modelo es proyecto?
	function getDetallesPedidoByIdPedido($id) {
		$model=new Proyecto();
		$query="SELECT  `det`.`id` AS  `IdDetalle`, `det`.`IdArticulo` AS  `IdArticulo` ,  `det`.`Cantidad` AS  `Cantidad` ,  `art`.`Descripcion` AS  `Descripcion` ,  `art`.`dir` AS  `dir` , `art`.`idFoto` AS  `idFoto` ,`art`.`CodigoArticulo` AS  `codigo`
FROM  `pedido_detalles` AS  `det`
LEFT JOIN  `articulos`  `art` ON (  `det`.`IdArticulo` =  `art`.`id` )
WHERE  `det`.`IdPedido` ='".$id."';";
		$pedidos=$model->query($query);
		return $pedidos;
	}
	function getConfiguraciones($id) {
		$model=new Categoria();

		$decorados=$model->query("SELECT decorado.Nombre, decorado.id FROM Decorados as decorado INNER JOIN DecoradoCategorias as decoCate	ON decoCate.idDecorado=decorado.id WHERE  `decoCate`.`IdCategoria` ='".$id."'");

		$estilos=$model->query("SELECT estilo.Nombre, estilo.id FROM Estilos as estilo INNER JOIN EstiloCategorias as estiloCate	ON estiloCate.idEstilo=estilo.id WHERE  `estiloCate`.`IdCategoria` ='".$id."'");

		$materiales=$model->query("SELECT material.Nombre, material.id  FROM Materiales as material INNER JOIN MaterialCategorias as mateCate	ON mateCate.idMaterial=material.id WHERE  `mateCate`.`IdCategoria` ='".$id."'");

		$objetos=$model->query("SELECT objeto.Nombre, objeto.id FROM Objetos as objeto INNER JOIN ObjetoCategorias as objetoCate	ON objetoCate.idObjeto=objeto.id WHERE  `objetoCate`.`IdCategoria` ='".$id."'");

		$dimensiones=$model->query("SELECT dimension.Nombre, dimension.id FROM Dimensiones as dimension INNER JOIN DimensionCategorias as dimenCate ON dimenCate.idDimension=dimension.id WHERE  `dimenCate`.`IdCategoria` ='".$id."'");

		$configuraciones= array("decorados"=> $decorados,"estilos"=> $estilos,"materiales"=> $materiales,"objetos"=> $objetos,"dimensiones"=> $dimensiones);


		return $configuraciones;
	}

////////////////////////////// {FIN} PEDIDOS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} INVENTARIOS ********************************
\********************************************************************************/

	//Suma (inserta/modifica) en inventario para deposito
	function sumaInventarioEnDeposito($articulo,$deposito,$cantidad) {
		if ($this->getExisteArticulo($articulo,$deposito,NULL)){
			//Si existe le sumo la cantidad
			$this->sumaInventario($articulo,$deposito,NULL,$cantidad);
			print_r("--   SUMO CANTIDAD  ".$articulo." --");
		} else {
			print_r("--   INSERTO   ".$articulo." --");
			//Sino existe inserto el registro
			$this->insertarInventario($articulo,$deposito,NULL,$cantidad);
		}
	}

	//Suma (inserta/modifica) en inventario para Proyecto
	function sumaInventarioEnProyecto($articulo,$deposito,$proyecto,$cantidad) {
		if ($this->getExisteArticulo($articulo,$deposito,$proyecto)){
			//Si existe le sumo la cantidad
			$this->sumaInventario($articulo,$deposito,$proyecto,$cantidad);
		} else {
			//Sino existe inserto el registro
			$this->insertarInventario($articulo,$deposito,$proyecto,$cantidad);
		}
	}

	//Resta (modifica) en inventario para deposito
	function restaInventarioEnDeposito($articulo,$deposito,$cantidad) {
		if ($this->getExisteArticulo($articulo,$deposito,NULL)){
			//Si existe le resto la cantidad
			$this->restaInventario($articulo,$deposito,NULL,$cantidad);
		}
	}

	//Resta (modifica) en inventario para proyecto
	function restaInventarioEnProyecto($articulo,$deposito,$proyecto,$cantidad) {
		if ($this->getExisteArticulo($articulo,$deposito,$proyecto)){
			//Si existe le resto la cantidad
			$this->restaInventario($articulo,$deposito,$proyecto,$cantidad);
		}
	}

	//Verifica si el articulo existe en el deposito
	function getExisteArticulo($articulo,$deposito,$proyecto) {
		$model=new Inventario();
		$conditions = array(
			'IdArticulo' => $articulo,
			'IdDeposito' => $deposito,
			'IdProyecto' => $proyecto
		);
		if ($model->hasAny($conditions)){
			return true;
		} else {
			return false;
		}
	}

	function insertarInventario($articulo,$deposito,$proyecto,$cantidad) {
		$model=new Inventario();
		$model->save(array('IdArticulo' => $articulo,'IdDeposito' => $deposito,'IdProyecto' => $proyecto,'Disponibilidad' => $cantidad));
	}

	function sumaInventario($articulo,$deposito,$proyecto,$cantidad) {
		$model=new Inventario();
		$conditions = array(
			'Inventario.IdArticulo' => $articulo,
			'Inventario.IdDeposito' => $deposito,
			'Inventario.IdProyecto' => $proyecto
		);
		//Tomo el inventario
		$inventario = $model->find('first',array('conditions' => $conditions));
		//Sumo
		$total = $inventario['Inventario']['Disponibilidad'] + $cantidad;
		//Actualizo
		$model->updateAll(array('Disponibilidad'=>$total), $conditions);
	}
	//Para que? Deberiamos mover los metodos que hacen transacciones a algun SaveOrUpdatephp?
	function restaInventario($articulo,$deposito,$proyecto,$cantidad) {
		$model=new Inventario();

		$conditions = array(
			'Inventario.IdArticulo' => $articulo,
			'Inventario.IdDeposito' => $deposito,
			'Inventario.IdProyecto' => $proyecto
		);
		//Tomo el inventario
		$inventario = $model->find('first',array('conditions' => $conditions));
		//resto
		$total = $inventario['Inventario']['Disponibilidad'] - $cantidad;
		//Actualizo
		$model->updateAll(array('Disponibilidad'=>$total), $conditions);
	}

////////////////////////////// {FIN} INVENTARIOS //////////////////////////////

}
?>