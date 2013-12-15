<?php
	App::import('Model','Categoria');


class ConsultasUsuario extends AppModel {
	public $name = 'ConsultasUsuario';

/********************************************************************************\
****************************** {INICIO} ACCIONES ********************************
\********************************************************************************/

	//Obtengo las acciones por rol que puede realizar el usuario
	public function accionesByRol($idRol){
		$model = new Categoria();
		$tabla = "acciones";
		//Acciones
		$acciones = $model->query("SELECT * FROM `".$tabla."` WHERE id in (select id_accion from `rol_acciones` where `id_rol` = '".$idRol."')");
		
		$privilegios =array();
		foreach($acciones as $accion){
			$tag = $accion[$tabla]['tag'];
			$privilegio['id'] 			= $accion[$tabla]['id'];
			$privilegio['tag'] 			= $tag;
			$privilegio['tipo'] 			= $accion[$tabla]['tipo'];
			$privilegio['nombre'] 		= $accion[$tabla]['nombre'];
			$privilegio['ayuda'] 			= $accion[$tabla]['ayuda'];
			$privilegio['descripcion'] 	= $accion[$tabla]['descripcion'];
			$privilegio['inactivo'] 		= $accion[$tabla]['inactivo'];
			
			$privilegios[$tag] = $privilegio;

		}
		
		return $privilegios;
	}

	//Obtengo las acciones por rol que puede realizar el usuario
	public function getAcciones(){
		$model = new Categoria();
		$tabla = "acciones";
		//Acciones
		$acciones = $model->query("SELECT * FROM `".$tabla."` ");
		
		$privilegios =array();
		foreach($acciones as $accion){
			$tag = $accion[$tabla]['tag'];
			$privilegio['id'] 			= $accion[$tabla]['id'];
			$privilegio['tag'] 			= $tag;
			$privilegio['tipo'] 			= $accion[$tabla]['tipo'];
			$privilegio['nombre'] 		= $accion[$tabla]['nombre'];
			$privilegio['ayuda'] 			= $accion[$tabla]['ayuda'];
			$privilegio['descripcion'] 	= $accion[$tabla]['descripcion'];
			$privilegio['inactivo'] 		= $accion[$tabla]['inactivo'];
			
			$privilegios[$tag] = $privilegio;
		}
		
		return $privilegios;
	}

////////////////////////////// {FIN} ACCIONES //////////////////////////////

/********************************************************************************\
****************************** {INICIO} USUARIO ********************************
\********************************************************************************/

	//Valido la contrase;a y el usuario
	public function validateUserPass($user,$pass){
		$res =false;

		$usuario = $this->getUsuario($user,$pass);

		if (! empty($usuario)){
			$res =true;
		}

		return $res;
	}

	//Valido la contrase;a y el usuario
	public function getUsuario($user,$pass){
		$model = new Categoria();
		$tabla = "usuarios";

		//Usuario
		$us = $model->query("SELECT * FROM `".$tabla."` WHERE LOWER(`username`)=LOWER('".$user."') AND password like '".$pass."' AND Inactivo = 'F'");
		
		return $us;
	}


////////////////////////////// {FIN} ACCIONES //////////////////////////////

}
?>