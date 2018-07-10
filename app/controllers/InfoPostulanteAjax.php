<?php

// 366 lineas de codigo
// 244 lineas

class InfoPostulanteAjax extends Controller {
    public function __construct() {
        $this->session = new Session();
        $this->session->init();
        if($this->session->getStatus() === 1 || empty($this->session->get('id')))
          exit('Acceso denegado');
    }
    
    public function index(){
        echo 1221;
    }

    public function infoPostulado($idPostulado)
    {
        
        $usuarioModelo = $this->model('Usuario');
        $usuario = $usuarioModelo->getById($idPostulado);
       //$datos = $this->datoVista($usuario);
       // $calificacion_pasajero = $usuarioModelo->verPuntosPasajero($idPostulado);
        //$datos['calificacion'] = $calificacion_pasajero->suma;

       
        
        echo $usuario->nombre;
    }
 
}
