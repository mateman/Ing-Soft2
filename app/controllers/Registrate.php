<?php


class Registrate extends Controller {

    public function index() {
        $num = 1;
        $datos = [
            'title' => 'Bienvenido al mvc',
            'num' => $num
        ];
        $this->view('registrate/index', $datos);
      
    }
    public function test() {
        $usuarioModelo = $this->model('Usuario');
        $usuarioModelo->createUser();
    }
    public function procesar() {
       
        /**
         * ________________________________
         * 
         * ACA SE PROCESA EL FORMULARIO !!!
         * ________________________________
         * 
         */
        if (isset($_POST) and !(empty($_POST))) { 
            $email =  $_POST['email'];
            $contrasena =  $_POST['contrasena'];
            $contrasena2 =  $_POST['contrasena2'];
            $provincia = $_POST['provincia'];
            $fechanac = $_POST['fechanac'];
            $apellido = $_POST['apellido'];
            $telefono = $_POST['telefono'];
            $nombre = $_POST['nombre'];
            $nombreusuario = $_POST['nombreusuario'];
            $ciudad = $_POST['ciudad'];
           

        
        }
        
        $usuarioModelo = $this->model('Usuario');
        $usuario = $usuarioModelo->mailExist($email);
        if($usuario) {
            $datos = [
                'err' => 'mail registrado'
            ];
            $this->view('registrate/index', $datos);
            die();
        }
        $usuario = $usuarioModelo->userNameExist($nombreusuario);
       
        if($usuario) {
            $datos = [
                'err' => 'usuario  registrado'
            ];
            $this->view('registrate/index', $datos);
            die();
        }
       
        if($contrasena != $contrasena2) {
            $datos = [
                'err' => 'contrasenas no son iguales'
            ];
            $this->view('registrate/index', $datos);
            die();
        }

        $usuario = $usuarioModelo->userCreate(
            $email,
            $contrasena, 
            $provincia,
            $fechanac,
            $apellido,
            $telefono,
            $nombre ,
            $nombreusuario,
            $ciudad
         
    
    
    
        );

        $this->view('pages/index');

        die();
        
        
        
        

        
      
    }
 

}