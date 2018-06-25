<?php


class Ajax extends Controller {

    public function __construct() {
        $this->session = new Session();
        $this->session->init();
        
        if($this->session->getStatus() === 1 || empty($this->session->get('id')))
          exit('Acceso denegado');
    }

    public function index() {
        $mail = $_POST['mail'];
        $usuarioModelo = $this->model('Usuario');

        $user_id = $this->session->get('id');
        $usuario = $usuarioModelo->getById($user_id);
        $current_mail = $usuario->email;
        $exist = $usuarioModelo->mailExist($mail);

        if( $mail == $current_mail ) {
        
           
        } elseif( $exist) {
            echo '<div  class="alert alert-success" role="alert"> Este mail ya se encuentra registrado</div>';
        } else {
           
        }

    }

    public function user() {
        $user_name = $_POST['nombreusuario'];
        $usuarioModelo = $this->model('Usuario');

        $user_id = $this->session->get('id');
        $usuario = $usuarioModelo->getById($user_id);
        $current_user_name = $usuario->nombreusuario;
        $exist = $usuarioModelo-> userNameExist($user_name);

        if( $user_name == $current_user_name ) {
            
        } elseif( $exist) {
            echo '<div  class="alert alert-success" role="alert"> Este UserName ya se encuentra registrado</div>';
        } else {
           
        }

    }
        
}
 
