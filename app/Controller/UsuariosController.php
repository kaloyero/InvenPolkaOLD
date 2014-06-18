<?php
        App::import('Model','ConsultasPaginado');
        App::import('Model','ConsultasSelect');
        App::import('Model','ConsultasUsuario');
        App::import('Model','UsuarioProyecto');

class UsuariosController extends AppController {

    public $helpers = array ('Html','Form');
	var $components    = array('Cookie');

    function index() {
    }

   public function view($id = null) {
   }

        function ajaxData() {
			$paginado =new ConsultasPaginado();
			$this->autoRender = false;
			$privilegios = $this->Session->read("privilegios");
			$output = $paginado->getDataUsuarios($privilegios);
			echo json_encode($output);
        }


   public function add() {
        if ($this->request->is('post')) {
            //Guarda el usuario
			if ($this->Usuario->save($this->request->data)) {
				//En caso de ser un usuario de tipo Arte le asocia us proyecto
				if ($this->request->data['Usuario']['TipoRol'] == 3){
					$model = new UsuarioProyecto();
					$idUsuario = $this->Usuario->getInsertID();
					$model->save(array('id_usuario' => $idUsuario,'id_proyecto' =>$this->request->data['Usuario']['IdProyecto']));
				}
				//Envia notificacion de nuevo usuario
				$this->envioNotificacionNuevoUser($this->request->data['Usuario']['Nombre']." ".$this->request->data['Usuario']['Apellido'],$this->request->data['Usuario']['Email'],$this->request->data['Usuario']['username'],$this->request->data['Usuario']['password']);
                $this->render('/General/Success');
            }else{
                $this->render('/General/Error');
			}
        } else {
				$consultas =new ConsultasSelect();
				$this->set('rolesList' , $consultas->getRolesUsuarios());
				$this->set('proyectos',  $consultas->getProyectos());
		}
    }

	function edit($id = null) {
			$this->Usuario->id = $id;
			if ($this->request->is('get')) {
					$consultas =new ConsultasSelect();
					$consultasUs =new ConsultasUsuario();
					$this->set('rolesList' , $consultas->getRolesUsuarios());
					$this->set('proyectos',$consultas->getProyectos());
					//Obtengo el usuario
					$this->request->data = $this->Usuario->read();
					//Inicializo el proyecto para el usuario en cero
					$this->request->data['Usuario']['IdUsuarioProyecto'] = 0;
					//Si es un usuario de tipo arte obtengo el Proyecto relacionado
					if ($this->request->data['Usuario']['TipoRol'] == '3'){
						$usProy = $consultasUs->getUsuarioProyecto($id);
						if ( ! empty($usProy) ) {
							$this->request->data['Usuario']['IdUsuarioProyecto'] = $usProy['Id'];
							$this->request->data['Usuario']['IdProyecto'] = $usProy['Proyecto'];
						}
					}

			} else {
				if ($this->Usuario->save($this->request->data)) {
					//En caso de ser un usuario de tipo Arte le asocia us proyecto
					if ($this->request->data['Usuario']['TipoRol'] == '3'){
						$model = new UsuarioProyecto();
						$idUsPr = $this->request->data['Usuario']['IdUsuarioProyecto'];
						if ($idUsPr != 0){
							//Si ya tiene proyecto asignado solo actualiza
							$model->save(array('id' => $idUsPr ,'id_proyecto' =>$this->request->data['Usuario']['IdProyecto']));
						} else {
							//si no tiene proyecto asignado se lo asigna
							$model->save(array('id_usuario' => $this->request->data['Usuario']['id'],'id_proyecto' =>$this->request->data['Usuario']['IdProyecto']));

						}
					}
					$this->render('/General/Success');
				}else{
					$this->render('/General/Error');
				}
			}
	}

	function cambioClave() {
			$consultasUs = new ConsultasUsuario();
			if ($this->request->is('get')) {
				$this->set('errorClave','');
			} else {
				$usuario = $this->Session->read("usuario");
				//Valida el usuario y contrase;a ingresado son validos
				$usValid = $consultasUs->validateUserPass($usuario['username'],$this->request->data['Usuario']['passwordViejo']);
				if ($usValid) {
					//valida q la clave nueva sea igual a la clave de confirmacion
					if ($this->request->data['Usuario']['password'] == $this->request->data['Usuario']['passwordConfirm']){
						//cambia el password
						$consultasUs->changePass($usuario['id'],$this->request->data['Usuario']['password']);
						//Envia notificacion de cambio de clave usuario
						$this->envioNotificacionCambioClaveUser("Administrador","ber.losada@gmail.com",$usuario['username'],$this->request->data['Usuario']['password']);
						$this->render('/General/Success');
					} else {
						$this->set('errorClave','La clave nueva debe ser igual a la clave de confirmación');
					}
				} else {
					$this->set('errorClave','Verifique su clave actual.');
				}
			}
	}

	function login() {

			$consultas = new ConsultasSelect();
			$consultasUs = new ConsultasUsuario();

			if (!empty($this->request->data['invitado'])) {
				$user = "Invitado";
				$pass = "123";
			} else {
				$user = $this->request->data['username'];
				$pass = $this->request->data['password'];
			}

			//Valida el usuario y contrase;a ingresado
			$usValid = $consultasUs->validateUserPass($user,$pass);

			if ($usValid) {
				//Toma las estadisticas
				$result = $consultas->getEstadisticaInventario();
        		$this->set('porcentaje', $result);
				//Categorias
				$this->set('categorias',$consultas->getCategorias());
				//Setea los datos del usuario en la session
				$usuario = $consultasUs->getUsuario($user,$pass);
				$this->Session->write("usuario",$usuario);
				//Setea en la session los provilegios del usuario
				$privilegios = $consultasUs->accionesByRol($usuario['Rol']);
				$this->Session->write("privilegios",$privilegios);

				$this->render('/Layouts/menuSinLibs');

			} else {
				$this->set('mensaje' , "El Usuario o la Contraseña que ha ingresado son incorrectos.");
			}
	}

	function logOut() {
		//Destruye privilegios y usuario de la session
		$this->Session->delete("privilegios");
		$this->Session->delete("usuario");
		//Redirecciona a la pagina de login
		$this->render('/Layouts/defaultsin');
		//$this->redirect('../');
	}

	function delete($id) {

		$model=new Usuario();
		$model=new UsuarioProyecto();
		$this->Usuario->delete($id);
		$this->render('/General/Success');

	}

	function envioNotificacionNuevoUser($nombre,$mail,$user,$pass) {
		@$nombre = addslashes($nombre);
		@$email = addslashes($mail);
		@$asunto = addslashes("Usuario Creado");
		@$mensaje = addslashes("Estimado ".$nombre.", \n Se le ha asignado un usuario para acceder a la aplicacion de Inventarios.\n\n Usuario:".$user." \n Clave: ".$pass." \n\n <B>Se recomienda cambiar la clave de acceso luego del primer ingreso.</b> \n ");

		//Preparamos el mensaje de contacto
		$cabeceras = "From: info@admin.com\n"; //La persona que envia el correo
		$asuntoMsj = "$asunto";
		$email_to = "$email";
		$contenido = "$mensaje\n";

		@mail($email_to, $asuntoMsj ,$contenido ,$cabeceras );

	}

	function envioNotificacionCambioClaveUser($nombre,$mail,$user,$pass) {
		@$nombre = addslashes($nombre);
		@$email = addslashes($mail);
		@$asunto = addslashes("Cambio de clave");
		@$mensaje = addslashes("Estimado ".$nombre.", \n El usuario:".$user." \n ha cambiado su clave: ".$pass." ");

		//Preparamos el mensaje de contacto
		$cabeceras = "From: info@admin.com\n"; //La persona que envia el correo
		$asuntoMsj = "$asunto";
		$email_to = "$email";
		$contenido = "$mensaje\n";

		@mail($email_to, $asuntoMsj ,$contenido ,$cabeceras );

	}
}
?>