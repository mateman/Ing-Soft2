<?php


class Current extends Controller {

    public function __construct() {
        $this->usuarioModelo = $this->model('Usuario');
        $this->session =  new Session();
    }

    public function index() {
        
        $this->view('pages/index' );
    
    }
    public function login() {

       if (isset($_POST) and !(empty($_POST))) {
            if (!(is_null($_POST['email'])) and !(is_null($_POST['password']))) {
                $email =  $_POST['email'];
                $contrasena =  $_POST['password'];
                $usuario =$this->usuarioModelo->login($email,$contrasena);
               
                if ($usuario) {
                    $this->session->init();
                    $this->session->add('id', $usuario->id);
                    
                    $url = RUTA_URL.'/userinterface';
                    echo $url;
                    header('location:'.$url);
                    
                } else {
                    echo "no existis";
                }

            }
       
        } else {
           echo 123213;
       }
    }
   
        
}
 
