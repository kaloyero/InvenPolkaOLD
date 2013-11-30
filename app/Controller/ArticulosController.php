<?php
//TODO session_start(); le habia puesto esto para que ande las sesiones,pero tras mucho tiempo de busqueda,le agregue algo al core.php y no hay necesidad de usar esto

    App::import('Model','Materiale');
	App::import('Model','Categoria');
	App::import('Model','Dimensione');
	App::import('Model','Decorado');
	App::import('Model','Estilo');
	App::import('Model','Objeto');
	App::import('Model','MovimientoInventario');
	App::import('Model','MovimientoDetalleInventario');
	App::import('Model','ConsultasSelect');
	App::import('Model','ConsultasPaginado');


class ArticulosController extends AppController {
    public $helpers = array ('Html','Form');
	public $findResult;
    function index() {
 	if ($_GET['isSearch']=='undefined' || $_GET['isSearch']!=true ) {
	   	//Borramos de la sesion,las condiciones de los articulos,porque el usuario entro a el listado completo
		$this->Session->delete("articulos");
	}
    }

   public function view($id = null) {
			$this->Articulo->id = $id;
		    if ($this->request->is('get')) {
				$consultas = new ConsultasSelect();
				$articulo = $consultas->getArticuloById($id);
				$inventario = $consultas->getDataInventarioByIdArticulo($id);
		        $this->set('articulo', $articulo);
		        $this->set('inventario', $inventario);
				$this->setViewData("view");
		    } else {
				$this->redirect(array('action' => 'index'));
			}
   }

    public function add() {
        if ($this->request->is('post')) {
			$this->preSave();
            if ($this->Articulo->save($this->request->data)) {
					//Actualizo el id de articulo
					$this->request->data['Inventario']['IdArticulo'] = $this->Articulo->getInsertID();
					//Guardo en la tabla inventario
					$this->GuardarInventario($this->request->data['Inventario']);
					//Guardo el movimiento
					$this->insertMovimiento();

              	    $this->render('/General/Success');
	        	}else{
					$this->render('/General/Error');
				}
        } else {
			$this->setViewData("add");
			}
    }

	private function GuardarInventario($inventario){
		$consultas = new ConsultasSelect();
		//Guardo el invetario correspondiente
		$consultas->insertarInventarioEntidad($inventario);
		//Si se le asigna al proyecto agrego un registro para el stock del deposito en cero
		if (! empty($inventario["IdProyecto"])){
			$inventario["IdProyecto"] = NULL;
			$inventario["Disponibilidad"] = 0;
			$consultas->insertarInventarioEntidad($inventario);
		}

	}

	//Hace el insert en la Tabla de Movimientos
	private function insertMovimiento(){
			$model = new MovimientoInventario();
			$model2 = new MovimientoDetalleInventario();

			//Agrego el detalle para la alta de Articulo
			$res= $model->save(array('Numero' => 0,'Fecha' => '2013-11-15','TipoMovimiento' => 'A','IdDepositoOrig' => $this->request->data['Inventario']['IdDeposito']));
			if ($res) {
				$idInserted = $model->getInsertID();
				//Actualizo el Numero del Movimiento/
				$model->updateAll(array('Numero'=>$idInserted), array('MovimientoInventario.id'=>$idInserted));
				//hago el alta del detalle
	            $detalle = $this->getMovimientoDetalle($idInserted);
				$model2->save($detalle);
           	} else {
				$this->render('/General/Error');
			}
	}

	private function getMovimientoDetalle($idMov) {
			$detalle['Cantidad'] = $this->request->data['Inventario']['Disponibilidad'];
			$detalle['IdMovimientoInventario'] = $idMov;
			$detalle['IdArticulo'] = $this->request->data['Inventario']['IdArticulo'];

			return $detalle;
	}

	private function preSave() {
				//Seteo el codigo del articulo con el nombre de la foto.
				$codigoArt = $this->request->data['Articulo']['idFoto']['name'];
		        $codigoArt  = substr_replace( $codigoArt , "", -4 );
				//Valido que el codigo de articulo no exista en la base
				$codigoArt = $this->validaCodigoArticuloRepetido($codigoArt,null);
				//Le asigno el valor al codigo de Articulo
				$this->request->data['Articulo']['CodigoArticulo'] = $codigoArt ;
				//Remuevo caracteres especiales
				$this->removeSpecialCharactersFromImage();
	}

	private function validaCodigoArticuloRepetido($codigoArt,$idEdit) {
			$consultas =new ConsultasSelect();
			$codArtReturn = $codigoArt;

			$codigoRepetido = $consultas->existeCodigoArticulo($codigoArt,$idEdit);
			$cont = 1;
			while ($codigoRepetido) {
				//Si existe le cambio el nombre
				$codArtReturn = $codigoArt." (".$cont.")";
				$codigoRepetido = $consultas->existeCodigoArticulo($codArtReturn,$idEdit);
				$cont++;
			}

			return	$codArtReturn;
	}

	function ajaxData() {
		if ($this->Session->check("articulos")){
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;

			$output = $paginado->getDataArticulosSearch($this->Session->read("articulos"));
	        echo json_encode($output);
		} else {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataArticulos();
	        echo json_encode($output);
		}
	}

	function edit($id = null) {
		    $this->Articulo->id = $id;
		    if ($this->request->is('get')) {
		        $this->request->data = $this->Articulo->read();
				$this->setViewData("edit");
		    } else {
			  $fieldsToEdit=$this->getFieldsToEdit();
				if(!empty($this->request->data["Articulo"]["idFoto"])){
					//Remuevo caracteres especiales
					$this->removeSpecialCharactersFromImage();

				}
				//Obtengo el codigo de articulo
				$codigoArt = $this->request->data['Articulo']['CodigoArticulo'];
				//Valido que el codigo de articulo no exista en la base
				$codigoArt = $this->validaCodigoArticuloRepetido($codigoArt,$id);
				//Le asigno el valor al codigo de Articulo
				$this->request->data['Articulo']['CodigoArticulo'] = $codigoArt ;

		        if ($this->Articulo->save($this->request->data,array('fieldList' => $fieldsToEdit ))){
					  $this->render('/General/Success');
		        	}else{
						$this->render('/General/Error');
					}
	    }

	}
	function setViewData($currentStatus) {
		$consultas = new ConsultasSelect();
		//Si se esta editando,que me traiga las configuraciones en base a la categoria que eligio el articulo,si es alta o busqueda,que me traiga
		//las configuraciones en base a la primer categoria de la lista

		if ($currentStatus=="edit") {
				$firstKey = $this->request->data["Articulo"]["IdCategoria"];
			}else{
				$firstKey = key($consultas->getCategorias());
				$this->set('depositos',$consultas->getDepositos());
				$this->set('proyectos',$consultas->getProyectos());
			}

		$this->set('categorias',$consultas->getCategorias());
		$this->set('materiales',$consultas->getMaterialesByCategoriaTest($firstKey));
		$this->set('decorados',$consultas->getDecoradosByCategoriaTest($firstKey));

		$this->set('dimensiones',$consultas->getDimensionesByCategoriaTest($firstKey));
		$this->set('estilos',$consultas->getEstilosByCategoriaTest($firstKey));
		$this->set('objetos',$consultas->getObjetosByCategoriaTest($firstKey));
	}
	//Si el usuario esta editando un articulo,y el idFoto viene vacio,quiere decir que no la cambio,entonces,editamos todos los campos,menos
	//el de la foto,porque sino lo pone vacio.Si cambio la foto,hacer el update normal
	function getFieldsToEdit() {
		$fieldList= array();
		if(!empty($this->request->data["Articulo"]["idFoto"])){

			$fieldsToEdit= array('CodigoArticulo', 'Descripcion', 'IdCategoria', 'IdObjeto', 'IdEstilo', 'IdMaterial', 'IdDecorado', 'IdDimension','idFoto');
		}else{
			$fieldList= array('CodigoArticulo', 'Descripcion', 'IdCategoria', 'IdObjeto', 'IdEstilo', 'IdMaterial', 'IdDecorado', 'IdDimension');
		}
			return $fieldList;
	}

	function delete($id) {

	}
	function removeSpecialCharactersFromImage() {
		// Replaces all spaces with hyphens.

		$this->request->data['Articulo']['idFoto'] = str_replace(' ', '-', $this->request->data['Articulo']['idFoto']);
		// Removes special chars.
		$this->request->data['Articulo']['idFoto']= preg_replace(" /[&'#]/", "",$this->request->data['Articulo']['idFoto']);
	}
	function find() {
		$url = array('action'=>'index');
		if($this->request->is("post")) {
		      $filters = $this->request->data["ArticuloSearch"];
		      $this->passedArgs["CodigoArticulo"] = $filters["CodigoArticulo"];
				$this->passedArgs["IdMaterial"] = $filters["IdMaterial"];
				$this->passedArgs["IdEstilo"] = $filters["IdEstilo"];
				$this->passedArgs["IdCategoria"] = $filters["IdCategoria"];
				$this->passedArgs["IdObjeto"] = $filters["IdObjeto"];
				$this->passedArgs["IdDecorado"] = $filters["IdDecorado"];
				$this->passedArgs["IdDimension"] = $filters["IdDimension"];
				$this->passedArgs["IdDecorado"] = $filters["IdDecorado"];

			//echo $this->passedArgs["test"];
 			//$this->redirect(array('action' => 'index'));
			//$this->redirect(array_merge($url,$filters));
			$conditions = "";
					if(!empty($this->passedArgs["CodigoArticulo"])){
						$conditions= $conditions."CodigoArticulo LIKE '%".$this->passedArgs["CodigoArticulo"]."%' AND ";
					}
					if(!empty($this->passedArgs["IdMaterial"])){
						$conditions= $conditions."id_material LIKE '".$this->passedArgs["IdMaterial"]."' AND ";
					}
					if(!empty($this->passedArgs["IdEstilo"])){
						$conditions= $conditions."id_estilo LIKE '".$this->passedArgs["IdEstilo"]."' AND ";
					}
					if(!empty($this->passedArgs["IdCategoria"])){
						$conditions= $conditions."id_categoria LIKE '".$this->passedArgs["IdCategoria"]."' AND ";
					}
					if(!empty($this->passedArgs["IdObjeto"])){
						$conditions= $conditions."id_objeto LIKE '".$this->passedArgs["IdObjeto"]."' AND ";
					}
					if(!empty($this->passedArgs["IdDimension"])){
						$conditions= $conditions."id_dimension LIKE '".$this->passedArgs["IdDimension"]."' AND ";
					}
					if(!empty($this->passedArgs["IdDecorado"])){
						$conditions= $conditions."id_decorado LIKE '".$this->passedArgs["IdDecorado"]."' AND ";
					}
				//Borramos el ultimo And
		        $conditions = substr_replace( $conditions, "", -4 );
				//$_SESSION['prueba']="puti";
				$this->Session->write("articulos",$conditions);



				// $this->set("articulos",$results);
				//$this->redirect(array('action' => 'index'));
	 }else{
			$this->setViewData("find");
		}
	}
}
?>
