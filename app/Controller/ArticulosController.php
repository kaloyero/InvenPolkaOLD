<?php
//TODO session_start(); le habia puesto esto para que ande las sesiones,pero tras mucho tiempo de busqueda,le agregue algo al core.php y no hay necesidad de usar esto


    App::import('Model','Materiale');
	App::import('Model','Categoria');
	App::import('Model','Dimensione');
	App::import('Model','Decorado');
	App::import('Model','Estilo');
	App::import('Model','Objeto');


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
					//$this->set("articulos",$this->Articulo->find('all'));
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
					echo "NOFUN";
					$this->setViewData();
				}
        } else {
			$this->setViewData();
			}
    }

	function edit($id = null) {
		    $this->Articulo->id = $id;
		    if ($this->request->is('get')) {
				$this->setViewData();
		        $this->request->data = $this->Articulo->read();
		    } else {
		        if ($this->Articulo->save($this->request->data)) {
		            $this->Session->setFlash('Your post has been updated.');
		            $this->redirect(array('action' => 'index'));
		        }else{
						$this->setViewData();
				}
		    }
	}
	function setViewData() {
		$this->set('materiales',$this->getMateriales());
		$this->set('categorias',$this->getCategorias());
		$this->set('decorados',$this->getDecorados());
		$this->set('dimensiones',$this->getDimensiones());
		$this->set('estilos',$this->getEstilos());
		$this->set('objetos',$this->getObjetos());
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

			if(isset($this->passedArgs["CodigoArticulo"])){
				$conditions["Articulo.CodigoArticulo LIKE"] = "%".$this->passedArgs["CodigoArticulo"]."%";
				}else{
					if(isset($this->passedArgs["IdMaterial"])){
						$conditions["Articulo.IdMaterial LIKE"] = "%".$this->passedArgs["IdMaterial"]."%";
					}
					if(isset($this->passedArgs["IdEstilo"])){
						$conditions["Articulo.IdEstilo LIKE"] = "%".$this->passedArgs["IdEstilo"]."%";
					}
					if(isset($this->passedArgs["IdCategoria"])){
						$conditions["Articulo.IdCategoria LIKE"] = "%".$this->passedArgs["IdCategoria"]."%";
					}
					if(isset($this->passedArgs["IdObjeto"])){
						$conditions["Articulo.IdObjeto LIKE"] = "%".$this->passedArgs["IdObjeto"]."%";
					}
					if(isset($this->passedArgs["IdDimension"])){
						$conditions["Articulo.IdDimension LIKE"] = "%".$this->passedArgs["IdDimension"]."%";
					}
					if(isset($this->passedArgs["IdDecorado"])){
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
	function getMateriales() {
		$material=new Materiale();
		$materiales=$material->find('list',array('fields'=>array('Materiale.id','Materiale.Nombre')));
		return $materiales;
	}
	function getEstilos() {
		$estilo=new Estilo();
		$estilos=$estilo->find('list',array('fields'=>array('Estilo.id','Estilo.Nombre')));
		return $estilos;
	}
	function getDecorados() {
		$decorado=new Decorado();
		$decorados=$decorado->find('list',array('fields'=>array('Decorado.id','Decorado.Nombre')));
		return $decorados;
	}
	function getObjetos() {
		$objeto=new Objeto();
		$objetos=$objeto->find('list',array('fields'=>array('Objeto.id','Objeto.Nombre')));
		return $objetos;
	}
	function getDimensiones() {
		$dimension=new Dimensione();
		$dimensiones=$dimension->find('list',array('fields'=>array('Dimensione.id','Dimensione.Nombre')));
		return 	$dimensiones;
	}
	function getCategorias() {
		$categoria=new Categoria();
		$categorias=$categoria->find('list',array('fields'=>array('Categoria.id','Categoria.Nombre')));
		return $categorias;
	}
}
?>
