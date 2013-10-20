<?php
	App::import('Model','Proyecto');
	App::import('Model','Estudio');	
	App::import('Model','Articulo');	

class Ubicacione {

	private function getProyectos() {
		$proyecto=new Proyecto();
		$proyectos=$proyecto->find('list',array('fields'=>array('Proyecto.id','Proyecto.Nombre')));
		return $proyectos;
	}

	private function getEstudios() {
		$estudio=new Estudio();
		$estudios=$estudio->find('list',array('fields'=>array('Estudio.id','Estudio.Nombre')));
		return $estudios;
	}

	private function getArticulos() {
		$articulo=new Articulo();
		$articulos=$articulo->find('list',array('fields'=>array('Articulo.id','Articulo.Codigoarticulo','Articulo.Descripcion')));
		return $articulos;
	}

}
?>