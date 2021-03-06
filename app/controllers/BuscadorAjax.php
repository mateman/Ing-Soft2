<?php


class BuscadorAjax extends Controller {
    
    public function ajax() {
        $buscadorModelo = $this->model('Modeloviajes');

        if (isset($_POST['v']) and !(empty($_POST['v']))) {

            $sql = "SELECT * FROM viaje ";
            $concat = array(); 

            if(!(empty($_POST['v']['origen']))) {
                $origen = $_POST['v']['origen'];
                $sentencia = "origen LIKE '%$origen%' ";
                $concat['origen'] = $sentencia;

                
            }

               if(!(empty($_POST['v']['costo']))) {
                $costo = $_POST['v']['costo'];
                switch ($costo) {
                    case '1':
                        $sentencia = "costo < 101 ";# code...
                        break;

                    case '2':
                        $sentencia = "costo BETWEEN 101 AND 500 ";# code...
                        break;

                    case '3':
                        $sentencia = "costo BETWEEN 501 AND 1000 ";# code...
                        break;

                     case '4':
                        $sentencia = "costo > 1000 ";# code...
                        break;
                    
                }
           
                $concat['costo'] = $sentencia;

                
            }
            if(!(empty($_POST['v']['destino']))) {
                $destino = $_POST['v']['destino'];
                $sentencia = "destino LIKE '%$destino%' ";
                $concat['destino'] = $sentencia;
            }
            if(!(empty($_POST['v']['salidaresultadodesde'])) and !(empty($_POST['v']['salidaresultadohasta']))) {
                $salidaresultadodesde = $_POST['v']['salidaresultadodesde'];
                $salidaresultadohasta = $_POST['v']['salidaresultadohasta'];

                $sentencia = "horasalida BETWEEN '$salidaresultadodesde' and '$salidaresultadohasta' ";
                $concat['salida'] = $sentencia;
            }
            if(!(empty($_POST['v']['llegadaresultadodesde'])) and !(empty($_POST['v']['llegadaresultadohasta']))) {
                $llegadaresultadodesde = $_POST['v']['llegadaresultadodesde'];
                $llegadaresultadohasta = $_POST['v']['llegadaresultadohasta'];

                $sentencia = "horallegada BETWEEN '$llegadaresultadodesde' and '$llegadaresultadohasta' ";
                $concat['llegada'] = $sentencia;
            }
            $i=1;
            foreach ( $concat as $valor) {
                if ($i == 1) {
                    $sql .= " WHERE ";
                } else {
                    $sql .= " AND ";
                }
                $sql .= $valor;
                $i++;
            }
            $sql .= " and borrado_logico='0' and  horasalida > NOW() ORDER BY horasalida, horallegada DESC ";
          

            $datos = $buscadorModelo->ConsultaSqlArmada($sql);
            

            
         }
         $salida = '<table class="table table-dark table-striped">
         <thead>
         <tr>
             <th>Origen</th>
             <th>Hora de salida</th>
             <th>Destino</th>
             <th>Hora de llegada</th>
             <th>Descricpion</th>
             <th>Costo</th>
             <th> detalle </th>
     
         </tr>
         </thead>
         <tbody>';
        if (!isset($datos)) {
            $salida .= "Debe ingresar un criterio de búsqueda!";
        }
        else{
        if($datos) {
            
            foreach ($datos as $d) {
                
               
                $salida .= "<tr>";
                $salida .= "<td>" . $d->origen . "</td>";
                $salida .= "<td>" . $d->horasalida . "</td>";
                $salida .= "<td>" .  $d->destino . "</td>";
                $salida .= "<td>" . $d->horallegada . "</td>";
                $salida .= "<td>" . $d->descripcion . "</td>";
                $salida .= "<td>" . $d->costo . "</td>";
                $salida .= '<td><a href="' . RUTA_URL . '/viaje/muro/' . ($d->id).'/unAventon"> <img src=" '. RUTA_URL . '/public/img/icons8-car.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="36" height="36"></a>';                $salida .= "</tr>";
            
            
            }
            $salida .= "</tbody>";
            $salida .= "</table>";
        }
         else {

            $salida .= "No hay datos :(";
        
        }
    }

       
        echo $salida;

     }
       
}

