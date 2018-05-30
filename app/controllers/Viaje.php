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

public function viajeAgregar (){
      $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        $cantAutos = $usuarioModelo -> getCantidadAutos($user_id);
        
        if ($cantAutos == 0){
            $datos = [
           'mensaje' => 'Usted no posee autos, no puede crear viaje'
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
        $cantAutos = $usuarioModelo -> getCantidadAutos($user_id);
        
        if(!(empty($_POST['origen'])) and !(empty($_POST['destino'])) and !(empty($_POST['fechayhorallegada'])) and !(empty($_POST['fechayhorasalida'])) and !(empty($_POST['costo'])) and !(empty($_POST['tipodeviaje'])) and !(empty($_POST['autodelviaje']))){
         
           $viajeModelo = $this->model('Modeloviajes');  
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