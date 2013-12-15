<?php
        App::import('Model','ConsultasPaginado');        
        App::import('Model','ConsultasSelect');
        App::import('Model','ConsultasUsuario');		

class UsuariosController extends AppController {

    public $helpers = array ('Html','Form');

    function index() {
    }

   public function view($id = null) {
   }

        function ajaxData() {
			$paginado =new ConsultasPaginado();
			$this->autoRender = false;
			$output = $paginado->getDataUsuarios();
			echo json_encode($output);
        }


   public function add() {
        if ($this->request->is('post')) {
            if ($this->Usuario->save($this->request->data)) {
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
			if ($this->request->is('post')) {
				if ($this->Inventario->save($this->request->data)) {
					$this->render('/General/Success');
				}else{
					$this->render('/General/Error');
				}
			} else {
				$consultas =new ConsultasSelect();
				$this->set('rolesList' , $consultas->getRolesUsuarios());                
				$this->request->data = $this->Usuario->read();
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
			
				$this->render('/Layouts/menu2');
			} else {
				$this->set('mensaje' , "El Usuario o la Contraseña ingresada son incorrectos.");                			
			}
	}


	function delete($id) {

	}

}
?>