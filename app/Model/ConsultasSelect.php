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



}
?>