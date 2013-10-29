<?php
//TODO session_start(); le habia puesto esto para que ande las sesiones,pero tras mucho tiempo de busqueda,le agregue algo al core.php y no hay necesidad de usar esto


    App::import('Model','Materiale');
	App::import('Model','Categoria');
	App::import('Model','Dimensione');
	App::import('Model','Decorado');
	App::import('Model','Estilo');
	App::import('Model','Objeto');
	App::import('Model','ConsultasSelect');
	App::import('Model','ConsultasPaginado');


class ArticulosController extends AppController {
    public $helpers = array ('Html','Form');
	public $findResult;
    function index() {
  //if ($this->request->is('ajax')){
		//Array de variables para la vista $this->viewVars["articulos"];
		//Si la session tiene cargada la variable articulos,viene de un redireccionamiento,si no,se pidio el listado completo
				if ($this->Session->check("articulos")){
					$this->paginate = array(
					     'conditions' => $this->Session->read("articulos"),
					     'order' => array('Result.created ASC'),
					     'limit' => 5
					 );
					$this->set("articulos",$this->paginate('Articulo'));
					$this->Session->delete("articulos");
				}else{
					//paginate as normal
					$this->paginate = array(
						'order' => array('Result.created ASC'),
						 'limit' => 10
					 );
					$this->set("articulos",	$this->paginate('Articulo'));
				}
    }

   public function view($id = null) {

   }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Articulo->save($this->request->data)) {
                $this->Session->setFlash('Articulo Guardada con Exito.');
                $this->redirect(array('action' => 'index'));
            }	else{
					$this->setViewData();
				}
        } else {
			$this->setViewData();
			}
    }
	
	function ajaxData() {
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataArticulos();
	        echo json_encode($output);
	}

	function edit($id = null) {
		    $this->Articulo->id = $id;
		    if ($this->request->is('get')) {
				$this->setViewData();
		        $this->request->data = $this->Articulo->read();
		    } else {
		        if ($this->Articulo->save($this->request->data,array('fieldList' =>$this->getFieldsToEdit() ))){
					 $this->Session->setFlash('Your post has been updated.');
					 $this->redirect(array('action' => 'index'));
				}else{
						$this->setViewData();
					}
	    }

	}
	function setViewData() {
		$consultas = new ConsultasSelect();
		$this->set('materiales',$consultas->getMateriales());
		$this->set('categorias',$consultas->getCategorias());
		$this->set('decorados',$consultas->getDecorados());
		$this->set('dimensiones',$consultas->getDimensiones());
		$this->set('estilos',$consultas->getEstilos());
		$this->set('objetos',$consultas->getObjetos());
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
			if(!empty($this->passedArgs["CodigoArticulo"])){
				$conditions["Articulo.CodigoArticulo LIKE"] = "%".$this->passedArgs["CodigoArticulo"]."%";
				}else{
					if(!empty($this->passedArgs["IdMaterial"])){
						$conditions["Articulo.IdMaterial LIKE"] = "%".$this->passedArgs["IdMaterial"]."%";
					}
					if(!empty($this->passedArgs["IdEstilo"])){
						echo"SI";
						$conditions["Articulo.IdEstilo LIKE"] = "%".$this->passedArgs["IdEstilo"]."%";
					}
					if(!empty($this->passedArgs["IdCategoria"])){
						$conditions["Articulo.IdCategoria LIKE"] = "%".$this->passedArgs["IdCategoria"]."%";
					}
					if(!empty($this->passedArgs["IdObjeto"])){
						$conditions["Articulo.IdObjeto LIKE"] = "%".$this->passedArgs["IdObjeto"]."%";
					}
					if(!empty($this->passedArgs["IdDimension"])){
						$conditions["Articulo.IdDimension LIKE"] = "%".$this->passedArgs["IdDimension"]."%";
					}
					if(!empty($this->passedArgs["IdDecorado"])){
						$conditions["Articulo.IdDecorado LIKE"] = "%".$this->passedArgs["IdDecorado"]."%";
					}
				}


				//$_SESSION['prueba']="puti";
				$this->Session->write("articulos",$conditions);

				// $this->set("articulos",$results);
				$this->redirect(array('action' => 'index'));
	 }else{
			$this->setViewData();
		}
	}
}
?>
