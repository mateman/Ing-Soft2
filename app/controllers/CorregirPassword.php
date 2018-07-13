<?php
/**
 * Created by PhpStorm.
 * User: mateman
 * Date: 11/07/18
 * Time: 16:31
 */

class CorregirPassword extends Controller
{
    public function __construct() {
    $modelUsuario =$this->model('Usuario');
    $usuarios = $modelUsuario->getUsuarios();
    foreach ($usuarios as $usuario){
        $pass = sha1($usuario->nombreusuario.$usuario->contrasena);
        echo $usuario->nombreusuario.'  '.$usuario->contrasena.'    '.$pass.'<br>';
        $cambio =$modelUsuario->contrasenaUpdate($pass,($usuario->id));
    };

}

}