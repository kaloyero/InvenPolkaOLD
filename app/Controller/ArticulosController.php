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
		//Array de variables para la vista $this->viewVars["articulos"];

				if ($this->Session->check("articulos")){
					$result=$this->Session->read("articulos");
					$this->set("articulos",$result);
					$result=$this->Session->delete("articulos");
				}else{
					$this->set("articulos",$this->Articulo->find('all'));
				}
    }

   public function view($id = null) {

   }

    public function add() {
        if ($this->request->is('post')) {

            if ($this->Articulo->save($this->request->data)) {
				echo "Guarda..?.";
                $this->Session->setFlash('Articulo Guardada con Exito.');
                $this->redirect(array('action' => 'index'));
            }	else{
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
		      $filters = $this->request->data["Articulo"];
		      $this->passedArgs["CodigoArticulo"] = $filters["CodigoArticulo"];
			//echo $this->passedArgs["test"];
 			//$this->redirect(array('action' => 'index'));
			//$this->redirect(array_merge($url,$filters));

			if(isset($this->passedArgs["CodigoArticulo"])){
				$conditions["Articulo.idFoto LIKE"] = "%".$this->passedArgs["CodigoArticulo"]."%";
				//paginate as normal
				$this->paginate = array(
				     'conditions' => $conditions,
				     'order' => array('Result.created ASC'),
				     'limit' => 10
				 );
				//$_SESSION['prueba']="puti";
				$this->Session->write("articulos",$this->paginate('Articulo'));

				// $this->set("articulos",$results);
				$this->redirect(array('action' => 'index'));
				}



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
