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
	public $components = array('RequestHandler');

	public $findResult;
    function index() {

    }

   public function view($id = null) {

   }

    public function add() {
        if ($this->request->is('post')) {
				$this->removeSpecialCharactersFromImage();
            if ($this->Articulo->save($this->request->data)) {
               	$this->render('/General/Success');
        	}else{
				$this->render('/General/Error');
			}
        } else {
			$this->setViewData();
			}
    }

	function ajaxData() {
		if ($this->Session->check("articulos")){
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
			$output = $paginado->getDataArticulosSearch($this->Session->read("articulos"));
	        echo json_encode($output);
		} else {
			//Para que??
			$paginado =new ConsultasPaginado();
	        $this->autoRender = false;
//			$output = $paginado->getDataArticulos();
	        echo json_encode($output);
		}
	}

	function edit($id = null) {
		    $this->Articulo->id = $id;
		    if ($this->request->is('get')) {
				$this->setViewData();
		        $this->request->data = $this->Articulo->read();
		    } else {
			  $fieldsToEdit=$this->getFieldsToEdit();
				if(!empty($this->request->data["Articulo"]["idFoto"])){
					$this->removeSpecialCharactersFromImage();

				}
		        if ($this->Articulo->save($this->request->data,array('fieldList' => $fieldsToEdit ))){
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
		if(!empty($filters["CodigoArticulo"])){
			$this->passedArgs["CodigoArticulo"] = $filters["CodigoArticulo"];
		}
		if(!empty($filters["IdMaterial"])){
			$this->passedArgs["IdMaterial"] = $filters["IdMaterial"];
		}
		if(!empty($filters["IdEstilo"])){
			$this->passedArgs["IdEstilo"] = $filters["IdEstilo"];
		}
		if(!empty($filters["IdCategoria"])){
			$this->passedArgs["IdCategoria"] = $filters["IdCategoria"];
		}
		if(!empty($filters["IdObjeto"])){
			$this->passedArgs["IdObjeto"] = $filters["IdObjeto"];
		}
		if(!empty($filters["IdDecorado"])){
			$this->passedArgs["IdDecorado"] = $filters["IdDecorado"];
		}
		if(!empty($filters["IdDimension"])){
			$this->passedArgs["IdDimension"] = $filters["IdDimension"];
		}
		if(!empty($filters["IdDimension"])){
			$this->passedArgs["IdDecorado"] = $filters["IdDecorado"];
		}

			//echo $this->passedArgs["test"];
 			//$this->redirect(array('action' => 'index'));
			//$this->redirect(array_merge($url,$filters));
			$conditions = "";
			if(!empty($this->passedArgs["CodigoArticulo"])){
				$conditions= $conditions."CodigoArticulo LIKE '%".$this->passedArgs["CodigoArticulo"]."%' OR ";
				}else{
					if(!empty($this->passedArgs["IdMaterial"])){
						$conditions= $conditions."id_material LIKE '".$this->passedArgs["IdMaterial"]."' OR ";
					}
					if(!empty($this->passedArgs["IdEstilo"])){
						$conditions= $conditions."id_estilo LIKE '".$this->passedArgs["IdEstilo"]."' OR ";
					}
					if(!empty($this->passedArgs["IdCategoria"])){
						$conditions= $conditions."id_categoria LIKE '".$this->passedArgs["IdCategoria"]."' OR ";
					}
					if(!empty($this->passedArgs["IdObjeto"])){
						$conditions= $conditions."id_objeto LIKE '".$this->passedArgs["IdObjeto"]."' OR ";
					}
					if(!empty($this->passedArgs["IdDimension"])){
						$conditions= $conditions."id_dimension LIKE '".$this->passedArgs["IdDimension"]."' OR ";
					}
					if(!empty($this->passedArgs["IdDecorado"])){
						$conditions= $conditions."id_decorado LIKE '".$this->passedArgs["IdDecorado"]."' OR ";
					}
				}

		        $conditions = substr_replace( $conditions, "", -3 );
				//$_SESSION['prueba']="puti";
				echo "CON ".$conditions;
				$this->Session->write("articulos",$conditions);



				// $this->set("articulos",$results);
				//$this->redirect(array('action' => 'index'));
	 }else{
			$this->setViewData();
		}
	}
}
?>
