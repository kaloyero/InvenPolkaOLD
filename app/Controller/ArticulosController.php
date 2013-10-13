<?php
    App::import('Model','Materiale');
	App::import('Model','Categoria');
	App::import('Model','Dimensione');
	App::import('Model','Decorado');
	App::import('Model','Estilo');
	App::import('Model','Objeto');
	

class ArticulosController extends AppController {
    public $helpers = array ('Html','Form');

    function index() {
        $this->set('articulos', $this->Articulo->find('all'));
    }	

   public function view($id = null) {

   }	
   
    public function add() {
        if ($this->request->is('post')) {
			echo "Guarda...";
            if ($this->Articulo->save($this->request->data)) {
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
}
?>
