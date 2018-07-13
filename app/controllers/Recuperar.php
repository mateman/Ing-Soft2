<?php
/**
 * Created by PhpStorm.
 * User: mateman
 * Date: 11/07/18
 * Time: 18:04
 */

class Recuperar extends Controller
{
    public function index() {
        $num = 1;
        $datos = [
            'title' => 'Recuperar Contraseña',
            'num' => $num
        ];
        $this->view('recuperar/index', $datos);

    }
    public function procesar()
    {

        if (isset($_POST) and !(empty($_POST))) {
            $email = $_POST['email'];
            $nombreusuario = $_POST['nombreusuario'];
        }

        $usuarioModelo = $this->model('Usuario');
        $usuario = $usuarioModelo->userNameExist($nombreusuario);

        if (!$usuario) {
            $datos = [
                'err' => 'usuario no registrado',
                'nombreusuario' => $nombreusuario,
                'email' => $email,
            ];
            $this->view('recuperar/index', $datos);
            die();
        }
        if ($usuario->email != $email) {
            $datos = [
                'err' => 'e-mail no registrado'.$usuario->email,
                'nombreusuario' => $nombreusuario,
                'email' => $email,
            ];
            $this->view('recuperar/index', $datos);
            die();
        }


        $token = $usuario->contrasena;
        $destinatario = $usuario->email;
        $asunto = "Recuperar contraseña para Un Aventon";
        $cuerpo = ' 
<html> 
<head> 
   <title>Recuperar contraseña para Un Aventon</title> 
</head> 
<body> 
<h1>Hola amigo!</h1> 
<p> 
<b>Para recuperar la contraseña debera dirigirse a:</b><br>
'.RUTA_URL.'/recuperar/cambiarPassword/'.$destinatario.'/'.$usuario->nombreusuario.'/'.$token.'  
</p> 
</body> 
</html> 
';

        mail($destinatario,$asunto,$cuerpo);
        $datos[ 'mensaje'=>'Se le ha enviado un correo a '.$destinatario.' indicandole donde ingresar para cambiar la Contraseña'
        ]
            $this->view('recuperar/respuesta', $datos);
    }

    public function cambiarPassword($destinatario,$nombreusuario,$token)
    {
        $usuarioModelo = $this->model('Usuario');
        $usuario = $usuarioModelo->userNameExist($nombreusuario);

        if (!$usuario) {
            $datos = [
                'mensaje' => 'usuario: '.$nombreusuario.'  no registrado'
            ];
            $this->view('recuperar/respuesta', $datos);
            die();
        }
        if ($usuario->email != $destinatario) {
            $datos = [
                'mensaje' => 'e-mail '.$usuario->email.' no registrado'
            ];
            $this->view('recuperar/respuesta', $datos);
            die();
        }
        if ($usuario->email == $destinatario and $usuario->email == $destinatario and $usuario->contrasena == $token)
        {
            $datos[ 'mensaje' => '',
                    'usuario' => $nombreusuario
            ]
            $this->view('recuperar/cambiarPassword', $datos);
            die();
        }
        $datos = [
                'mensaje' => 'No se pudo procesar esta página'
        ];
        $this->view('recuperar/respuesta', $datos);


    }
public function procesarContrasenas() {

            if (!(empty($_POST['contrasena']))  and !(empty($_POST['contrasena2'])))  { 
                $contrasena =  $_POST['contrasena'];
                $contrasena2 = $_POST['contrasena2'];
                $usuarioModelo = $this->model('Usuario');
                $user_id = $this->session->get('id');
                $usuario = $usuarioModelo->getById($user_id)->nombreusuario;
                if($contrasena == $contrasena2) {
                    $pass = sha1($usuario.$contrasena);
                    $cambio = $usuarioModelo->contrasenaUpdate($pass,$user_id);
                    $datos = [
                        'msj' => '<div class="alert alert-success" role="alert">
                        Password modificado correctamente
                      </div>'
                    ];
                    return $this->view('recuperar/cambiarPassword', $datos);
                } else {
                $datos = [
                    'msj' => '<div class="alert alert-danger" role="alert">
                    Los passwords no son iguales
                  </div>'
                ];
                return $this->view('recuperar/cambiarPassword', $datos);
                 }
            }
        }
  



}