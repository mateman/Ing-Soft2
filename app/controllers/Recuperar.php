<?php
/**
 * Created by PhpStorm.
 * User: mateman
 * Date: 11/07/18
 * Time: 18:04
 */
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/SMTP.php');
require('PHPMailer/src/Exception.php');

header("Content-Type: text/html;charset=utf-8");

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
       public function procesarPHPMailer()
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
Hola amigo!


Para recuperar la contraseña debera dirigirse a:
'.RUTA_URL.'/recuperar/cambiarPassword/'.$destinatario.'/'.$usuario->nombreusuario.'/'.$token;


$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth= true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->IsHTML(true);
$mail->Username = 'unaventonpass@gmail.com';
$mail->Password = 'TwoPines1234';
$mail->SetFrom('no-reply@unaventon.com');
$mail->Subject = 'Recuperar contraseña';
$mail->Body = $cuerpo;
$mail->AddAddress($email);
$mail->CharSet = 'UTF-8';

if(!$mail->Send()) {
        $mensaje = 'Ha ocurrido un error, su mail no ha podido ser enviado: '. $mail->ErrorInfo;
     } else {
        $mensaje = 'Se le ha enviado un correo a '.$destinatario.' indicandole donde ingresar para cambiar la Contraseña';
     }


  
        $datos = [ 'mensaje'=> $mensaje
        ];
            $this->view('recuperar/respuesta', $datos);




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
Hola amigo!


Para recuperar la contraseña debera dirigirse a:
'.RUTA_URL.'/recuperar/cambiarPassword/'.$destinatario.'/'.$usuario->nombreusuario.'/'.$token;

        mail($destinatario,$asunto,$cuerpo);
        $datos = [ 'mensaje'=>'Se le ha enviado un correo a '.$destinatario.' indicandole donde ingresar para cambiar la Contraseña'
        ];
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
        if ( $usuario->email == $destinatario and $usuario->contrasena == $token)
        {
            $datos = [ 'mensaje' => '',
                    'usuario' => $nombreusuario,
                    'email' => $destinatario,
                    'token' => $token
            ];
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
                $usuario =  $_POST['usuario'];
                $usuarioModelo = $this->model('Usuario');
                $user = $usuarioModelo->userNameExist($usuario);
                if($contrasena == $contrasena2 and strlen($contrasena)>7 and  $user->contrasena == $_POST['token'] and $user->email == $_POST['email'] ) {
                    $pass = sha1($usuario.$contrasena);
                    $user_id = $user->id;
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
                    Los passwords no son iguales o no superan la longitud de 8 caracteres
                  </div>'
                ];
                return $this->view('recuperar/cambiarPassword', $datos);
                 }
            }
        }
  



}