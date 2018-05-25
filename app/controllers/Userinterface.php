<?php


class Userinterface extends Controller {

    public function __construct() {
        $this->session = new Session();
        $this->session->init();
        
        if($this->session->getStatus() === 1 || empty($this->session->get('id')))
          exit('Acceso denegado');
    }

    public function index() {
        $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        $usuario = $usuarioModelo->getById($user_id);

        $datos = [
            'nombreusuario' => $usuario->nombreusuario
        ];
        
        $this->view('userinterface/index', $datos );
    
    }
    public function logout() {
        $this->session->close();
        $url = RUTA_URL;
       header('location:'.$url);
    
    
    }
  public function perfil() {
        $this->view('userinterface/perfil');
    
    }
}
 
