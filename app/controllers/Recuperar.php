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
        $asunto = "Este mensaje es de prueba";
        $cuerpo = ' 
<html> 
<head> 
   <title>Prueba de correo</title> 
</head> 
<body> 
<h1>Hola amigos!</h1> 
<p> 
<b>Para recuperar la contraseña debera dirigirse a:</b><br>
'.RUTA_URL.'/recuperar/cambiarPassword  
</p> 
</body> 
</html> 
';

//para el envío en formato HTML
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//dirección del remitente
        $headers .= "From: Un Aventon <mateman@jg.gba.gov.ar>\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente
        $headers .= "Reply-To: mateman@jg.gba.gov.ar\r\n";

//ruta del mensaje desde origen a destino
        $headers .= "Return-path: mateman@jg.gba.gov.ar\r\n";

        mail($destinatario,$asunto,$cuerpo,$headers);
        echo $destinatario.'<br></br>'.$headers.'<br></br>'.$asunto.'<br></br>'.$cuerpo;
    }

}