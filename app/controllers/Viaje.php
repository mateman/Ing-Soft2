<?php


class Viaje extends Controller {

    public function __construct() {
        $this->session = new Session();
        $this->session->init();
        
        if($this->session->getStatus() === 1 || empty($this->session->get('id')))
          exit('Acceso denegado');
    }


 

public function agregarViaje (){
      $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        $cantAutos = $usuarioModelo -> getCantidadAutos($user_id);
        
        if ($cantAutos == 0){
            $datos = [
           'mensaje' => 'Usted no posee autos, no puede crearviaje'
        ];

            $this->view('userinterface/misviajes', $datos); 
        }
       else{
          $autos = $usuarioModelo->getAutos($user_id);
       $datos = [
         'cantAutos' => $cantAutos,
         'autos' => $autos,
       
         ];


       $this->view('viaje/crearviajes', $datos); 
}

}


public function viajeCrear(){
      $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        $autos = $usuarioModelo->getAutos($user_id);
        $cantAutos = $usuarioModelo -> getCantidadAutos($user_id);
      $viajeModelo = $this->model('Modeloviajes');
        
        if(!(empty($_POST['origen'])) and !(empty($_POST['destino'])) and !(empty($_POST['fechayhorallegada'])) and !(empty($_POST['fechayhorasalida'])) and !(empty($_POST['costo'])) and !(empty($_POST['tipodeviaje'])) and !(empty($_POST['autodelviaje']))){
         
         
           $origen = $_POST['origen'];
           $destino = $_POST['destino'];
           $fechayhorallegada = $_POST['fechayhorallegada'];
           $fechayhorasalida = $_POST['fechayhorasalida'];
           $costo = $_POST['costo'];
           $tipodeviaje = $_POST['tipodeviaje'];
           $autodelviaje = $_POST['autodelviaje'];
           $descripcion = $_POST['descripcion'];
           if (isset($_POST['repetir'])){
             $repetir = $_POST['repetir'];
           }
           else{
            $repetir = 1;
           }


$viajeModelo = $this->model('Modeloviajes');            
 $autoEnUso = $viajeModelo -> autoEnUso($autodelviaje, $fechayhorasalida, $fechayhorallegada);
 if ($autoEnUso > 0){
              $datos = [
           'mensaje' => 'El auto seleccionado esta en uso para el horario del viaje.',
           'origen' => $origen,
           'destino' => $destino,
           'fechayhorallegada' => $fechayhorallegada,
           'fechayhorasalida' => $fechayhorasalida,
           'costo' => $costo,
           'tipodeviaje' => $tipodeviaje,
           'autodelviaje' => $autodelviaje,
           'descripcion' => $descripcion,
           'autos' => $autos,
           'cantAutos' => $cantAutos
        ];

        $this->view('viaje/crearviajes', $datos);
        exit();
 }

      $crearviaje = $viajeModelo->viajeAgregar($descripcion, $origen, $destino, $fechayhorallegada, $fechayhorasalida, $costo, $tipodeviaje, $autodelviaje, $user_id, $repetir);



            $datos = [
           'mensaje' => 'Viaje creado correctamente!'
        ];

            $this->view('userinterface/misviajes', $datos); 
        }
       else{
         $autos = $usuarioModelo->getAutos($user_id);
       $datos = [
         'mensaje' => 'Debe completar todos los campos!',
        'cantAutos' => $cantAutos,
         'autos' => $autos,
       
         ];


       $this->view('viaje/crearviajes', $datos); 
}
}
}
