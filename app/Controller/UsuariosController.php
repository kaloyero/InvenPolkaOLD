<?php
        App::import('Model','ConsultasPaginado');
        App::import('Model','ConsultasSelect');
        App::import('Model','ConsultasUsuario');

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
            if ($this->Usuario->save($this->request->data)) {
				$this->envioNotificacionNuevoUser($this->request->data['Usuario']['Nombre']." ".$this->request->data['Usuario']['Apellido'],$this->request->data['Usuario']['Email'],$this->request->data['Usuario']['username'],$this->request->data['Usuario']['password']);
                $this->render('/General/Success');
            }else{
                $this->render('/General/Error');
			}
        } else {
				$consultas =new ConsultasSelect();
				$this->set('rolesList' , $consultas->getRolesUsuarios());
		}
    }

	function edit($id = null) {
			$this->Usuario->id = $id;
			if ($this->request->is('get')) {
					$consultas =new ConsultasSelect();
					$this->set('rolesList' , $consultas->getRolesUsuarios());
					$this->request->data = $this->Usuario->read();
			} else {
				if ($this->Usuario->save($this->request->data)) {
					$this->render('/General/Success');
				}else{
					$this->render('/General/Error');
				}
			}
	}

	function resetPassword($id = null) {

	}

	function login() {

			$consultas = new ConsultasSelect();
			$consultasUs = new ConsultasUsuario();

			$user = $this->request->data['username'];
			$pass = $this->request->data['password'];
			//Valida el usuario y contrase;a ingresado
			$usValid = $consultasUs->validateUserPass($user,$pass);

			if ($usValid) {
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
			$this->render('/Layouts/default');
	}

	function delete($id) {

	}

	function envioNotificacionNuevoUser($nombre,$mail,$user,$pass) {
		@$nombre = addslashes($nombre);
		@$email = addslashes($mail);
		@$asunto = addslashes("Usuario Creado");
		@$mensaje = addslashes("Estimado ".$nombre.", \n Se le ha asignado un usuario para acceder a la aplicacion de Inventarios.\n\n Usuario:".$user." \n Clave: ".$pass." ");

		//Preparamos el mensaje de contacto
		$cabeceras = "From: info@admin.com\n"; //La persona que envia el correo
		$asuntoMsj = "$asunto";
		$email_to = "$email";
		$contenido = "$mensaje\n";

		@mail($email_to, $asuntoMsj ,$contenido ,$cabeceras );


	}


}
?>