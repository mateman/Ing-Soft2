<?php 

 class Modeloviajes {
     private $db;
     public function __construct() {
         $this->db = new Database;

     }

    public function viajeAgregar($descripcion, $origen, $destino, $fechayhorallegada, $fechayhorasalida, $costo, $tipodeviaje, $autodelviaje, $conductor_id, $repetir)
     {

         $sql = "INSERT INTO `viaje` (`descripcion`, `costo`, `origen`, `destino`, `tipo_viaje`, `horasalida`, `horallegada`, `auto_id`, `conductor_id`) VALUES ('$descripcion', '$costo', '$origen', '$destino', '$tipodeviaje', '$fechayhorasalida', '$fechayhorallegada', '$autodelviaje', '$conductor_id');";
         $last_id = $this->db->exec_id($sql);
         

         switch ($tipodeviaje) {

             case 2:
                 for ($i = $repetir; $i > 1; $i--) {
                     # code...

                     $phpdate = strtotime($fechayhorasalida);
                     $phpdate2 = strtotime("+1 week", $phpdate);
                     $fechayhorasalida = date('Y-m-d H:i:s', $phpdate2);

                     $phpdate = strtotime($fechayhorallegada);
                     $phpdate2 = strtotime("+1 week", $phpdate);
                     $fechayhorallegada = date('Y-m-d H:i:s', $phpdate2);

                    $sql = "INSERT INTO `viaje` (`descripcion`, `costo`, `origen`, `destino`, `tipo_viaje`, `horasalida`, `horallegada`, `auto_id`, `conductor_id`) VALUES ('$descripcion', '$costo', '$origen', '$destino', '$tipodeviaje', '$fechayhorasalida', '$fechayhorallegada', '$autodelviaje', '$conductor_id');";
                     // use exec() because no results are returned
                     $last_id = $this->db->exec_id($sql);
                   
                 }
                 break;

             case 3:
                 for ($i = $repetir; $i > 1; $i--) {
                     $phpdate = strtotime($fechayhorasalida);
                     $phpdate2 = strtotime("+1 day", $phpdate);
                     $fechayhorasalida = date('Y-m-d H:i:s', $phpdate2);

                     $phpdate = strtotime($fechayhorallegada);
                     $phpdate2 = strtotime("+1 day", $phpdate);
                     $fechayhorallegada = date('Y-m-d H:i:s', $phpdate2);

                      $sql = "INSERT INTO `viaje` (`descripcion`, `costo`, `origen`, `destino`, `tipo_viaje`, `horasalida`, `horallegada`, `auto_id`, `conductor_id`) VALUES ('$descripcion', '$costo', '$origen', '$destino', '$tipodeviaje', '$fechayhorasalida', '$fechayhorallegada', '$autodelviaje', '$conductor_id');";
                     // use exec() because no results are returned
                     $last_id = $this->db->exec_id($sql);
                 }
                 break;


         }
     }


     /*   Codigo Viejo
         public function viajeAgregar($descripcion, $origen, $destino, $fechayhorallegada, $fechayhorasalida, $costo, $tipodeviaje, $autodelviaje, $conductor_id, $repetir){

     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "ingenieriadev";

     try {
         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
         // set the PDO error mode to exception
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "INSERT INTO `viaje` (`descripcion`, `costo`, `origen`, `destino`, `tipo_viaje`, `horasalida`, `horallegada`, `auto_id`) VALUES ('$descripcion', '$costo', '$origen', '$destino', '$tipodeviaje', '$fechayhorasalida', '$fechayhorallegada', '$autodelviaje');";
         // use exec() because no results are returned
         $conn->exec($sql);
         $last_id = $conn->lastInsertId();
         $sql2="INSERT INTO `conductor` (`usuario_id`, `viaje_id`) VALUES ('$conductor_id', '$last_id');";
          $conn->exec($sql2);

          switch ($tipodeviaje) {

              case 2:
               for ($i=$repetir; $i > 1 ; $i--) {
                   # code...
                  $phpdate = strtotime( $fechayhorasalida );
                  $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
                  $phpdate2 = strtotime("+1 week", $phpdate);
                  $fechayhorasalida = date( 'Y-m-d H:i:s', $phpdate2 );

                  $phpdate = strtotime( $fechayhorallegada );
                  $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
                  $phpdate2 = strtotime("+1 week", $phpdate);
                  $fechayhorallegada = date( 'Y-m-d H:i:s', $phpdate2 );

                  $sql = "INSERT INTO `viaje` (`descripcion`, `costo`, `origen`, `destino`, `tipo_viaje`, `horasalida`, `horallegada`, `auto_id`) VALUES ('$descripcion', '$costo', '$origen', '$destino', '$tipodeviaje', '$fechayhorasalida', '$fechayhorallegada', '$autodelviaje');";
         // use exec() because no results are returned
                  $conn->exec($sql);
                  $last_id = $conn->lastInsertId();
                  $sql2="INSERT INTO `conductor` (`usuario_id`, `viaje_id`) VALUES ('$conductor_id', '$last_id');";
                  $conn->exec($sql2);
               }
               break;

              case 3:
              for ($i=$repetir; $i > 1 ; $i--) {
                  $phpdate = strtotime( $fechayhorasalida );
                  $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
                  $phpdate2 = strtotime("+1 day", $phpdate);
                  $fechayhorasalida = date( 'Y-m-d H:i:s', $phpdate2 );

                  $phpdate = strtotime( $fechayhorallegada );
                  $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
                  $phpdate2 = strtotime("+1 day", $phpdate);
                  $fechayhorallegada = date( 'Y-m-d H:i:s', $phpdate2 );

                  $sql = "INSERT INTO `viaje` (`descripcion`, `costo`, `origen`, `destino`, `tipo_viaje`, `horasalida`, `horallegada`, `auto_id`) VALUES ('$descripcion', '$costo', '$origen', '$destino', '$tipodeviaje', '$fechayhorasalida', '$fechayhorallegada', '$autodelviaje');";
         // use exec() because no results are returned
                  $conn->exec($sql);
                  $last_id = $conn->lastInsertId();
                  $sql2="INSERT INTO `conductor` (`usuario_id`, `viaje_id`) VALUES ('$conductor_id', '$last_id');";
                  $conn->exec($sql2);
               }
               break;
          }
         }
     catch(PDOException $e)
         {
         echo $sql . "<br>" . $e->getMessage();
         }

      $conn = null;

      }

      */

     public function viajeModificar($descripcion, $origen, $destino, $fechayhorallegada, $fechayhorasalida, $costo, $autodelviaje, $user_id, $id)
     {
         $this->db->query("
        UPDATE `viaje` SET `descripcion`='$descripcion', `costo`='$costo', `origen`='$origen', `destino`='$destino', `horasalida`='$fechayhorasalida', `horallegada`='$fechayhorallegada', `auto_id`='$autodelviaje', `conductor_id`='$user_id'
        WHERE id='$id'
        ");
         return $this->db->execute();
     }

     public function viajeEliminar($id) {
         if (0 == $this->viajeLibre($id)){
               $this->db->query(" DELETE FROM `viaje` WHERE id='$id'");}
         else {$this->db->query(" UPDATE `viaje` SET borrado_logico=1 WHERE id='$id'");}
         return $this->db->execute();
     }


     public function viajeLibre($id){
         $this->db->query("SELECT * FROM pasajero WHERE viaje_id='$id'");
         return $this->db->registrorowCount();
     }

     public function getCantidadViajes($id) {
         $this->db->query("SELECT * FROM viaje WHERE conductor_id='$id'");
         return $this->db->registrorowCount();
     }

     public function getViajes($id) {
         $this->db->query("SELECT * FROM viaje WHERE conductor_id='$id'");
         return $this->db->registros();
     }

     public function getCantidadPasajeroAceptados($id) {
         $this->db->query("SELECT * FROM pasajero WHERE viaje_id='$id' AND estado=3");
         return $this->db->registrorowCount();
     }

     public function getPasajero($id) {
         $this->db->query("SELECT * FROM pasajero WHERE viaje_id='$id'");
         return $this->db->registros();
     }

     public function estaEnPasajero($id_viaje,$id_user){
         $this->db->query("SELECT * FROM pasajero WHERE viaje_id='$id_viaje' AND usuario_id='$id_user'");
         return ($this->db->registrorowCount() != 0);
     }

     public function anotarPasajero($id_viaje,$id_user){
         $this->db->query("

        INSERT INTO `pasajero` (`usuario_id`, `viaje_id`, `puntaje`) VALUES ('$id_user', '$id_viaje', '0');
        
        ");
         //return "SELECT * FROM usuario WHERE email = '$username'";
         return $this->db->execute();

     }

     public function getAllViajes() {
         $this->db->query("SELECT * FROM viaje ");
         return $this->db->registros();
     }

     public function getAllCantidadViajes()
     {
         $this->db->query("SELECT * FROM viaje ");
         return $this->db->registrorowCount();
     }

         public function getViaje($idViaje){
         $this->db->query("SELECT * FROM viaje WHERE id='$idViaje'");
         return $this->db->registro();

    }


    public function autoEnUso($id_auto, $fechayhorallegada, $fechayhorasalida, $id_viaje) {
         $this->db->query("SELECT * FROM viaje v WHERE auto_id='$id_auto' AND id<>'$id_viaje' AND (('$fechayhorasalida'  BETWEEN horasalida and horallegada) OR ('$fechayhorallegada'  BETWEEN horasalida and horallegada))");
         return $this->db->registrorowCount();
     }


 }
