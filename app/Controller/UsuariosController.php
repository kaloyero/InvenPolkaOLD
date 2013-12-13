<?php
        App::import('Model','ConsultasPaginado');        
        App::import('Model','ConsultasSelect');

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
                if ($this->request->is('get')) {
                        $this->request->data = $this->Usuario->read();
                } else {
                        if ($this->Inventario->save($this->request->data)) {
                $this->render('/General/Success');
                }else{
                                $this->render('/General/Error');
                        }
                }
        }

        function delete($id) {

        }

}
?>