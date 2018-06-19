<?php


class BuscadorAjax extends Controller {
    
    public function ajax() {
        $buscadorModelo = $this->model('ModeloBuscador');
        $salida="";
        $datos =$buscadorModelo->getAllviajes();
        if (isset($_POST['consulta'])) { 
            $datos =$buscadorModelo->getViajes($_POST['consulta']);
          
        }
        if($datos) {
            foreach ($datos as $d) {
                $salida.="<p>" . $d->destino  . "<a href=". RUTA_URL."/viaje/modificarViaje/".$d->id.">" . "hola" . "</a>" . "</p>";
             }
        } else {
            $salida .= "No hay datos :(";
        }

       
        echo $salida;

        
     }
       
}
