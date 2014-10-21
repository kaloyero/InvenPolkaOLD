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
	App::import('Model','PedidoDetalle');
	App::import('Model','Inventario');
	App::import('Model','DecoradoCategoria');
	App::import('Model','EstiloCategoria');
	App::import('Model','DimensionCategoria');
	App::import('Model','MaterialCategoria');
	App::import('Model','ObjetoCategoria');
	App::import('Model','MovimientoInventario');
	App::import('Model','MovimientoDetalleInventario');
	App::import('Model','Role');

class ConsultasSelect extends AppModel {
	public $name = 'ConsultasSelect';

/********************************************************************************\
****************************** {INICIO} PROYECTOS ********************************
\********************************************************************************/
	function getProyectos() {
		$proyecto=new Proyecto();
		$proyectos=$proyecto->find('list',array('fields'=>array('Proyecto.id','Proyecto.Nombre'), 'conditions' => array(	'Proyecto.Inactivo =' => 'F')));

		return $proyectos;
	}

	function getProyectosFull() {
		$model=new Proyecto();
		$proyectos=$model->query("select * from `proyectos` where `Inactivo` like 'F'; ");
		return $proyectos;
	}
	
////////////////////////////// {FIN} PROYECTOS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} USUARIOS  ********************************
\********************************************************************************/
	function getRolesUsuarios() {
//		$rolesList = array('A'=>'Us. Administrador','D'=>'Us. Deposito','R'=>'Us. Arte');
		$model=new Role();
		$acciones=$model->find('list',array('fields'=>array('Role.id','Role.Nombre')));

		return $acciones;
	}
////////////////////////////// {FIN} USUARIOS //////////////////////////////

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

	function getArticuloById($id) {
		$model=new Articulo();
		$articulos=$model->query("SELECT * FROM `articulos_vista` WHERE id = '".$id."';");
		$articulo = array();
		foreach ($articulos as $art){
			$articulo= $art;
		}

		return $articulo;
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
		//$articulos=$articulo->find('all');


		//$articulos=$articulo->find($condiciones);
		return $articulos;
	}

	function getArticulosVistaByArrayId($ids) {
		$articulo=new Articulo();
		$inCondition="";
		foreach ($ids as $id){
			$inCondition= $inCondition.$id.",";
		}
		//Borro la ultima coma
		$inCondition = substr_replace( $inCondition, "", -1 );
		$articulos =$articulo->query("Select * from `articulos_vista`  WHERE `id` IN (".$inCondition.");");

		return $articulos;
	}

	//Devuelve TRUE si el Codigo de articulo existe
	//Devuelve FALSE si el Codigo de articulo NO existe
	//Si idEdit es null no valida que el id de articulo sea distinto de el mismo
	function existeCodigoArticulo($codigo,$idEdit) {
		$model=new Articulo();
		$valido = false;
		if (is_null($idEdit)){
			$conditions = array(
				'CodigoArticulo' => $codigo
			);
		} else {
			$conditions = array(
				'CodigoArticulo' => $codigo,
				'id <>' => $idEdit
			);
		}

		if ($model->hasAny($conditions)){
			$valido = true;
		}
		return $valido;
	}

	function borraInactivoArticulo($idArticulo){
		//Pregunto si tiene stock > 0
		$stock = $this->getStockInventarioByArticuloId($idArticulo);
		//Si no tiene stock
		if ( $stock < 1){
			//Pregunto si tiene algun Movimiento. Omito el movimiento de alta.
			$existMov = $this->existeMovimientosByArticuloId($idArticulo);
			//Pregunto si tiene algun Pedido Detalle
			$existPed = $this->existePedidoDetalleByArticuloId($idArticulo);

			//Si no tiene detalle de movimiento ni pedido
			if ((! $existMov) && (! $existPed)){
				//Borro el movimiento de Alta y los detalles de la baja
				$this->deleteMovimientosAltaBajaByArticuloId($idArticulo);
				//Borro el articulo
				$this->deleteArticulo($idArticulo);

			} else {
				//Pongo el articulo inactivo
				$this->inactivoArticulo($idArticulo);
			}
		}

	}

	function deleteArticulo($idArticulo){
		$model = new Articulo();
		$model->query("DELETE FROM  `articulos` WHERE  `id` =".$idArticulo.";");
	}

	function inactivoArticulo($idArticulo){
		$model = new Articulo();
		$conditions = array(
			'id' => $idArticulo
		);

		$model->updateAll(array('Inactivo'=>"'T'"), $conditions);
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

	function getCategoriasIdDesc() {
		$model=new Categoria();
		$categorias = $model->query("SELECT * FROM  `categorias` where `Inactivo` like 'F';");
		return $categorias;
	}

	function getCategoriasByIdDescripcion($id,$modelo,$columnaId) {
		$model=new Categoria();
		$categorias = $model->query("SELECT `IdCategoria` FROM  `".$modelo."_categorias` WHERE  `".$columnaId."` = ".$id.";");
		return $categorias;
	}

	function deleteModelCategoriasById($id,$modelo,$columnaId) {
		$model=new Categoria();
		$categorias = $model->query("DELETE FROM  `".$modelo."_categorias` WHERE  `".$columnaId."` =".$id.";");
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
	function getMovimientoById($id) {
		$model=new Proyecto();
		$movimientos=$model->query("SELECT * FROM `movimientos_vista` WHERE id = '".$id."';");

		return $movimientos;
	}

	function getDetallesMovimientoByIdMovimiento($id) {
		$model=new Proyecto();
		$query="SELECT  `mov`.`id` AS  `IdDetalle`, `mov`.`IdArticulo` AS  `IdArticulo` ,  `mov`.`Cantidad` AS  `Cantidad` ,  `art`.`Descripcion` AS  `Descripcion` ,  `art`.`dir` AS  `dir` , `art`.`idFoto` AS  `idFoto` ,`art`.`CodigoArticulo` AS  `codigo`
FROM  `movimiento_detalle_inventarios` AS  `mov`
LEFT JOIN  `articulos`  `art` ON (  `mov`.`IdArticulo` =  `art`.`id` )
WHERE  `mov`.`IdMovimientoInventario` ='".$id."';";
		$detalleMovimiento=$model->query($query);
		return $detalleMovimiento;
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

	function existePedidoDetalleByArticuloId($idArticulo){
		$model=new PedidoDetalle();
		$valido = false;
			$conditions = array(
				'IdArticulo' => $idArticulo
			);

		if ($model->hasAny($conditions)){
			$valido = true;
		}
		return $valido;

	}

	function getConfiguraciones($id) {


		$decorados=$this->getDecoradosByCategoria($id);
		$estilos=$this->getEstilosByCategoria($id);
		$materiales=$this->getMaterialesByCategoria($id);
		$objetos=$this->getObjetosByCategoria($id);

		$dimensiones=$this->getDimensionesByCategoria($id);

		$configuraciones= array("decorados"=> $decorados,"estilos"=> $estilos,"materiales"=> $materiales,"objetos"=> $objetos,"dimensiones"=> $dimensiones);

		return $configuraciones;
	}
	function getDecoradosByCategoria($id) {
		$model=new Categoria();
		return	$model->query("SELECT decorado.Nombre, decorado.id FROM decorados as decorado INNER JOIN decorado_categorias as decoCate	ON 	decoCate.idDecorado=decorado.id WHERE  `decoCate`.`IdCategoria` ='".$id."'");

	}
	function getDecoradosByCategoriaTest($id) {
		$model=new DecoradoCategoria();
		$decorados=$model->find('list',array('fields'=>array('Deco.id','Deco.Nombre'),'joins' => array(
		        array(
		            'table' => 'decorados',
		            'alias' => 'Deco',
		            'type' => 'INNER',
		            'conditions' => array(
		                'Deco.id = DecoradoCategoria.IdDecorado',
						'DecoradoCategoria.IdCategoria ='.$id,

		            )
		        )
		    )));
		return $decorados;
	}
	function getEstilosByCategoriaTest($id) {
		$model=new EstiloCategoria();
		$estilos=$model->find('list',array('fields'=>array('Esti.id','Esti.Nombre'),'joins' => array(
		        array(
		            'table' => 'estilos',
		            'alias' => 'Esti',
		            'type' => 'INNER',
		            'conditions' => array(
		                'Esti.id = EstiloCategoria.IdEstilo',
						'EstiloCategoria.IdCategoria ='.$id,

		            )
		        )
		    )));
		return $estilos;
	}

	function getDimensionesByCategoriaTest($id) {
		$model=new DimensionCategoria();
		$dimensiones=$model->find('list',array('fields'=>array('Dimen.id','Dimen.Nombre'),'joins' => array(
		        array(
		            'table' => 'dimensiones',
		            'alias' => 'Dimen',
		            'type' => 'INNER',
		            'conditions' => array(
		                'Dimen.id = DimensionCategoria.IdDimension',
						'DimensionCategoria.IdCategoria ='.$id,

		            )
		        )
		    )));
		return $dimensiones;
	}

	function getMaterialesByCategoriaTest($id) {
		$model=new MaterialCategoria();
		$materiales=$model->find('list',array('fields'=>array('Mate.id','Mate.Nombre'),'joins' => array(
		        array(
		            'table' => 'materiales',
		            'alias' => 'Mate',
		            'type' => 'INNER',
		            'conditions' => array(
		                'Mate.id = MaterialCategoria.IdMaterial',
						'MaterialCategoria.IdCategoria ='.$id,

		            )
		        )
		    )));
		return $materiales;
	}

	function getObjetosByCategoriaTest($id) {
		$model=new ObjetoCategoria();
		$objetos=$model->find('list',array('fields'=>array('Obje.id','Obje.Nombre'),'joins' => array(
		        array(
		            'table' => 'objetos',
		            'alias' => 'Obje',
		            'type' => 'INNER',
		            'conditions' => array(
		                'Obje.id = ObjetoCategoria.IdObjeto',
						'ObjetoCategoria.IdCategoria ='.$id,

		            )
		        )
		    )));
		return $objetos;
	}







	function getEstilosByCategoria($id) {
		$model=new Categoria();
		return $model->query("SELECT estilo.Nombre, estilo.id FROM estilos as estilo INNER JOIN estilo_categorias as estiloCate	ON estiloCate.idEstilo=estilo.id WHERE  `estiloCate`.`IdCategoria` ='".$id."'");
	}
	function getDimensionesByCategoria($id) {
		$model=new Categoria();
		return $model->query("SELECT dimension.Nombre, dimension.id FROM dimensiones as dimension INNER JOIN dimension_categorias as dimenCate ON dimenCate.idDimension=dimension.id WHERE  `dimenCate`.`IdCategoria` ='".$id."'");
	}
	function getMaterialesByCategoria($id) {
		$model=new Categoria();
		return $model->query("SELECT material.Nombre, material.id  FROM materiales as material INNER JOIN material_categorias as mateCate	ON mateCate.idMaterial=material.id WHERE  `mateCate`.`IdCategoria` ='".$id."'");
	}
	function getObjetosByCategoria($id) {
		$model=new Categoria();
		return $model->query("SELECT objeto.Nombre, objeto.id FROM objetos as objeto INNER JOIN objeto_categorias as objetoCate	ON objetoCate.idObjeto=objeto.id WHERE  `objetoCate`.`IdCategoria` ='".$id."'");

	}

////////////////////////////// {FIN} PEDIDOS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} INVENTARIOS ********************************
\********************************************************************************/

	function getEstadisticaInventario() {
		$model=new Inventario();
//		$cantDeposito=$model->query("SELECT sum(Disponibilidad) FROM `inventarios` WHERE idProyecto is null;");
		$cantProyecto=$model->query("SELECT sum(Disponibilidad) as cantidad FROM `inventarios` WHERE idProyecto is not null;");
		$total = $model->query("SELECT sum(Disponibilidad)  as cantidad  FROM `inventarios` ");

		$cantProyecto = $cantProyecto[0];
		$total = $total[0];
		
		if ($total <> 0){
			$porcen = ($cantProyecto[0]['cantidad'] * 100) / $total[0]['cantidad'];
		} else {
			$porcen =  0;
		}
		
		$porcen =  100 - $porcen;
		
		return $porcen;
	}

	//
	function getDataInventarioByIdArticulo($idArticulo) {
		$model=new Inventario();
		$inventarioDeposito= $this->getDataInventarioDepositoByIdArticulo($idArticulo);
		$inventarioProyecto= $this->getDataInventarioProyectoByIdArticulo($idArticulo);
		
		print_r($inventarioProyecto);
		
	}


	//
	function getDataInventarioDepositoByIdArticulo($idArticulo) {
		$model=new Inventario();
		$inventarioDeposito=$model->query("SELECT * FROM `inventarios_vista` WHERE id_articulo = '".$idArticulo."' order by 'Disponibilidad','deposito','proyecto' asc;");
		return $inventarioDeposito;
	}

	function getDataInventarioProyectoByIdArticulo($idArticulo) {
		$model=new Inventario();
		$query = "
			SELECT `pd`.`proyecto`,`pdt`.`cantidad` , `pd`.`FechaDev`
			FROM  `pedidos_vista`  `pd` 
			
			
			LEFT OUTER JOIN  `pedido_detalles`  `pdt` ON (  `pdt`.`IdPedido` =  `pd`.`id` ) 
			LEFT OUTER JOIN  `inventarios`  `inv` ON (  `inv`.`IdProyecto` =  `pd`.`id_proyecto` AND `inv`.`IdArticulo` =  
			
			`pdt`.`idArticulo` AND `inv`.`Disponibilidad` > 0 ) 
			
			WHERE 
			`pd`.`estado` =  'enviado'
			AND  `inv`.`IdArticulo` =  '".$idArticulo."'
			ORDER BY  `pd`.`proyecto` ASC, `pd`.`FechaDev` ASC 

		";
		
		$inventarioPedidos=$model->query($query);
		return $inventarioPedidos;
	}


	//Suma (inserta/modifica) en inventario para deposito
	function sumaInventarioEnDeposito($articulo,$deposito,$cantidad) {
		if ($this->getExisteArticulo($articulo,$deposito,NULL)){
			//Si existe le sumo la cantidad
			$this->sumaInventario($articulo,$deposito,NULL,$cantidad);
		} else {
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

	function insertarInventarioEntidad($inventario) {

		$this->insertarInventario($inventario['IdArticulo'], $inventario['IdDeposito'], $inventario['IdProyecto'], $inventario['Disponibilidad']);
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
		//Valida que total no sea menor a 0
		if ($total < 0){
			$total = 0;
		}

//		if ( (!empty($proyecto)) && $total < 1){
		if ($total < 1){
			//Si no tengo stock en el proyecto o en el deposito lo borro
			$model->deleteAll($conditions);
		} else {
			//Actualizo el stock
			$model->updateAll(array('Disponibilidad'=>$total), $conditions);
		}
	}

	function getStockInventarioByArticuloId($idArticulo){
		$model=new Inventario();
		$articulos=	$model->query("SELECT Disponibilidad FROM `inventarios` WHERE IdArticulo = '".$idArticulo."';");

		$stock = 0;
		foreach ($articulos as $art){
			$stock += $art["inventarios"]["Disponibilidad"];
		}

		return $stock;

	}

////////////////////////////// {FIN} INVENTARIOS //////////////////////////////

/********************************************************************************\
****************************** {INICIO} MOVIMIENTOS ********************************
\********************************************************************************/

	/* Devuleve TRUE si tiene movimientos
		OMITE los movimientos de Alta y Baja*/
	function existeMovimientosByArticuloId($idArticulo){
		$model=new MovimientoDetalleInventario();
		$valido = false;

		$movimientos = $model->query("Select * from movimiento_inventarios where TipoMovimiento not like 'A' and TipoMovimiento not like 'B' and exists (Select id from movimiento_detalle_inventarios where IdArticulo = '".$idArticulo."');");

		//Si el array NO esta vacio quiere decir que tiene movimientos
		if (! empty($movimientos)){
			$valido = true;
		}

		return $valido;

	}

	/* BORRA los movimientos de Alta y Baja para el articulo
		en el caso de baja solo borra el movimiento Detalle*/
	function deleteMovimientosAltaBajaByArticuloId($idArticulo){
		$model=new MovimientoInventario();
		//Primero borro los detalle inventarios
		$model->query("delete from movimiento_detalle_inventarios where IdArticulo = '".$idArticulo."';");
		//Luego borro el movimiento del alta
		$model->query("delete from movimiento_inventarios where TipoMovimiento like 'A' and exists (Select id from movimiento_detalle_inventarios where IdArticulo = '".$idArticulo."');");

	}


////////////////////////////// {FIN} MOVIMIENTOS //////////////////////////////

}
?>