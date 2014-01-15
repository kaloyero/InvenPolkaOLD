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
		$acciones = $model->query("SELECT * FROM `".$tabla."` WHERE Inactivo like 'F' and id in (select id_accion from `rol_acciones` where `id_rol` = '".$idRol."' AND `Inactivo` like 'F')");
		
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
		$usuarios = $model->query("SELECT * FROM `".$tabla."` WHERE LOWER(`username`)=LOWER('".$user."') AND password like '".$pass."' AND Inactivo = 'F'");
		
		$us=array();
		foreach ($usuarios as $usuario){
			$us['id']=$usuario['usuarios']['id'];
			$us['Nombre']=$usuario['usuarios']['Nombre'];
			$us['Apellido']=$usuario['usuarios']['Apellido'];
			$us['Legajo']=$usuario['usuarios']['Legajo'];
			$us['Descripcion']=$usuario['usuarios']['Descripcion'];
			$us['username']=$usuario['usuarios']['username'];
			$us['FechaFin']=$usuario['usuarios']['FechaFin'];
			$us['Email']=$usuario['usuarios']['Email'];
			$us['Rol']=$usuario['usuarios']['TipoRol'];
		}
		
		//Si el usuario es de tipo arte (id =3) seteo el Proyecto asociado
		$us['Proyecto'] = 0;
		if ($us['Rol'] == 3){
			$proyectos = $model->query("SELECT * FROM `usuario_proyectos` WHERE `id_usuario` = ".$us['id'].";");
			foreach ($proyectos as $proy){
				$us['Proyecto'] = $proy['usuario_proyectos']['id_proyecto'];
			}
		}
		
		return $us;
	}

	//Actualizo la contrase;a
	public function changePass($id,$pass){
		$model = new Categoria();
		$tabla = "usuarios";

		//Usuario
		$model->query("UPDATE `".$tabla."` SET `password` = ".$pass." WHERE id = ".$id." ;");
		
	}


////////////////////////////// {FIN} ACCIONES //////////////////////////////

}
?>