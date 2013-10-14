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
            }
        } else {
			$material=new Materiale();
			$materiales=$material->find('list',array('fields'=>array('Materiale.IdMaterial','Materiale.Nombre')));
			$this->set('materiales',$materiales);
			$categoria=new Categoria();
			$categorias=$categoria->find('list',array('fields'=>array('Categoria.IdCategoria','Categoria.Nombre')));
			$this->set('categorias',$categorias);
			$decorado=new Decorado();
			$decorados=$decorado->find('list',array('fields'=>array('Decorado.IdDecorado','Decorado.Nombre')));
			$this->set('decorados',$decorados);
			$dimension=new Dimensione();
			$dimensiones=$dimension->find('list',array('fields'=>array('Dimensione.IdDimension','Dimensione.Nombre')));
			$this->set('dimensiones',$dimensiones);
			$estilo=new Estilo();
			$estilos=$estilo->find('list',array('fields'=>array('Estilo.idEstilo','Estilo.Nombre')));
			$this->set('estilos',$estilos);
			$objeto=new Objeto();
			$objetos=$objeto->find('list',array('fields'=>array('Objeto.IdObjeto','Objeto.Nombre')));
			$this->set('objetos',$objetos);
		}
    }

	function edit($id = null) {

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
}
?>
