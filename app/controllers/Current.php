<?php


class Current extends Controller {

    public function __construct() {
        $this->usuarioModelo = $this->model('Usuario');
        $this->session =  new Session();
    }

    public function index() {
        $datos=[];
        
        $this->view('pages/index', $datos );
    
    }
    public function login() {

       if (isset($_POST) and !(empty($_POST))) {
            if (!(is_null($_POST['nombreusuario'])) and !(is_null($_POST['password']))) {
                $nombreusuario =  $_POST['nombreusuario'];
                $contrasena =  $_POST['password'];
                $pass = sha1($nombreusuario.$contrasena);
                $usuario =$this->usuarioModelo->login($nombreusuario,$pass);
               
                if ($usuario) {
                    $this->session->init();
                    $this->session->add('id', $usuario->id);
                    
                    $url = RUTA_URL.'/userinterface';
                    echo $url;
                    header('location:'.$url);

                } else {
                    $datos=['datos_err' => "los datos son incorrectos"];
        
                    $this->view('pages/index', $datos );
                }

            }
       
        } else {
           echo 123213;
       }
    }
   
        
}
 
