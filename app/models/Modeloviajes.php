<?php 

 class Modeloviajes {
     private $db;
     public function __construct() {
         $this->db = new Database;

     }

    public function viajeAgregar($descripcion, $origen, $destino, $fechayhorallegada, $fechayhorasalida, $costo, $tipodeviaje, $autodelviaje, $conductor_id, $repetir)
     {

         $sql = "INSERT INTO `viaje` (`descripcion`, `costo`, `origen`, `destino`, `tipo_viaje`, `horasalida`, `horallegada`, `auto_id`, `conductor_id`,`borrado_logico`) VALUES ('$descripcion', '$costo', '$origen', '$destino', '$tipodeviaje', '$fechayhorasalida', '$fechayhorallegada', '$autodelviaje', '$conductor_id','0');";
         $last_id = $this->db->exec_id($sql);
         switch ($tipodeviaje) {
             case 2:
                 for ($i = $repetir; $i > 1; $i--) {
                     $phpdate = strtotime($fechayhorasalida);
                     $phpdate2 = strtotime("+1 week", $phpdate);
                     $fechayhorasalida = date('Y-m-d H:i:s', $phpdate2);
                     $phpdate = strtotime($fechayhorallegada);
                     $phpdate2 = strtotime("+1 week", $phpdate);
                     $fechayhorallegada = date('Y-m-d H:i:s', $phpdate2);
                     $sql = "INSERT INTO `viaje` (`descripcion`, `costo`, `origen`, `destino`, `tipo_viaje`, `horasalida`, `horallegada`, `auto_id`, `conductor_id`,`borrado_logico`) VALUES ('$descripcion', '$costo', '$origen', '$destino', '$tipodeviaje', '$fechayhorasalida', '$fechayhorallegada', '$autodelviaje', '$conductor_id','0');";
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
                     $sql = "INSERT INTO `viaje` (`descripcion`, `costo`, `origen`, `destino`, `tipo_viaje`, `horasalida`, `horallegada`, `auto_id`, `conductor_id`,`borrado_logico`) VALUES ('$descripcion', '$costo', '$origen', '$destino', '$tipodeviaje', '$fechayhorasalida', '$fechayhorallegada', '$autodelviaje', '$conductor_id', '0');";
                     // use exec() because no results are returned
                     $last_id = $this->db->exec_id($sql);
                 }
                 break;


         }
     }


     public function viajeModificar($descripcion, $origen, $destino, $fechayhorallegada, $fechayhorasalida, $costo, $autodelviaje, $user_id, $id){

         $this->db->query("
        UPDATE `viaje` SET `descripcion`='$descripcion', `costo`='$costo', `origen`='$origen', `destino`='$destino', `horasalida`='$fechayhorasalida', `horallegada`='$fechayhorallegada', `auto_id`='$autodelviaje', `conductor_id`='$user_id'
        WHERE id='$id' AND borrado_logico='0'
        ");
         return $this->db->execute();
     }

     public function eliminarViaje($id) {

         $this->db->query("SELECT * FROM pasajero WHERE viaje_id='$id'");
         $verPasajero = $this->db->registrorowCount();
         if (0 == $verPasajero){
               $this->db->query(" DELETE FROM `viaje` WHERE id='$id'");}
         else {$this->db->query(" UPDATE `viaje` SET borrado_logico='1' WHERE id='$id'");}
         return $this->db->execute();
     }


     public function viajeLibre($id){

         $this->db->query("SELECT * FROM pasajero WHERE viaje_id='$id' AND borrado_logico='0'");
         return $this->db->registrorowCount();
     }

     public function getCantidadViajes($id) {

         $this->db->query("SELECT * FROM viaje WHERE conductor_id='$id' AND borrado_logico='0'");
         return $this->db->registrorowCount();
     }

     public function getViajes($id) {

         $this->db->query( "SELECT * FROM (SELECT * FROM viaje v LEFT JOIN (SELECT COUNT(id) as aceptados, viaje_id FROM pasajero WHERE estado ='1' AND borrado_logico='0' GROUP BY viaje_id) p ON v.id = p.viaje_id) vp LEFT JOIN (SELECT COUNT(id) as postulados, viaje_id FROM pasajero WHERE estado = '0' AND borrado_logico = '0' GROUP BY viaje_id) pv ON vp.id = pv.viaje_id WHERE conductor_id= '$id' AND borrado_logico = 0 ORDER BY horasalida, horallegada DESC ;");
         // $this->db->query("SELECT * FROM viaje WHERE conductor_id='$id' AND borrado_logico='0' ORDER BY horasalida, horallegada DESC");
         return $this->db->registros();
     }

     public function getCantidadPasajeroAceptados($id) {

         $this->db->query("SELECT p.* FROM pasajero p INNER JOIN usuario u on p.usuario_id = u.id WHERE p.viaje_id='$id' AND p.estado=1 AND p.borrado_logico='0'  AND u.borrado_logico='0'");
         return $this->db->registrorowCount();
     }

     public function esPasajero($id){

         $this->db->query("SELECT * FROM pasajero WHERE usuario_id='$id' AND borrado_logico='0'");
         return ($this->db->registrorowCount() != 0);
     }

     public function esConductor($id){

         $this->db->query("SELECT * FROM viaje WHERE conductor_id='$id'");
         return ($this->db->registrorowCount() != 0);
     }

     public function getPasajero($id) { // idviaje

         $this->db->query("SELECT * FROM pasajero p INNER JOIN usuario u on p.usuario_id = u.id WHERE viaje_id='$id' AND p.borrado_logico='0' AND u.borrado_logico='0'");
         return $this->db->registros();
     }

     public function getPasajeroEnPasajero($id) { // idviaje

         $this->db->query("SELECT * FROM pasajero WHERE usuario_id='$id' AND borrado_logico='0'");
         return $this->db->registros();
     }

     public function getPasajeroAprobado($id) {

         $this->db->query("SELECT * FROM pasajero p INNER JOIN usuario u on p.usuario_id = u.id WHERE viaje_id='$id' AND p.borrado_logico='0' AND estado = 1 ");//AND u.borrado_logico='0'");
         return $this->db->registros();
     }

     public function getPostulante($id) {

         $this->db->query("SELECT * FROM pasajero p INNER JOIN usuario u on p.usuario_id = u.id WHERE viaje_id='$id' AND p.borrado_logico='0' AND estado = 0 ");//AND u.borrado_logico='0'" );
         return $this->db->registros();
     }

     public function getPasajeroRechazado($id) {

         $this->db->query("SELECT * FROM pasajero p INNER JOIN usuario u on p.usuario_id = u.id WHERE viaje_id='$id' AND p.borrado_logico='0' AND estado = 2 AND u.borrado_logico='0'");
         return $this->db->registros();
     }

     public function getEstadoPasajero($id_viaje,$id_user){

         $this->db->query("SELECT estado FROM pasajero WHERE viaje_id='$id_viaje' AND usuario_id='$id_user' AND borrado_logico='0'");
         return $this->db->registro();
     }

     public function estaEnPasajero($id_viaje,$id_user){

         $this->db->query("SELECT * FROM pasajero WHERE viaje_id='$id_viaje' AND usuario_id='$id_user' AND borrado_logico='0'");
         return ($this->db->registrorowCount() != 0);
     }

     public function anotarPasajero($id_viaje,$id_user){

         $viaje = $this->getViaje($id_viaje);
         if (!(($this->estaEnPasajero($id_viaje, $id_user)) OR ($viaje->conductor_id == $id_user)) AND ($viaje->borrado_logico == '0')) {
             $this->db->query("INSERT INTO `pasajero` (`usuario_id`, `viaje_id`,`estado`, `calificacion_pasajero`,`calificacion_conductor`, `borrado_logico`) VALUES ('$id_user', '$id_viaje','0', '0', '0','0');");
             //$this->db->query("INSERT INTO `pasajero` (`usuario_id`, `viaje_id`,`estado`, `calificacion_pasajero`,`calificacion_conductor`, `comentario_conductor`, `borrado_logico`) VALUES ('$id_user', '$id_viaje','0', '0', '0','','0');");
            return $this->db->execute();
         }
     }

     public function aceptarPasajero($id_viaje,$id_user){

         $viaje = $this->getViaje($id_viaje);
         if ($this->estaEnPasajero($id_viaje, $id_user) AND ($viaje->conductor_id != $id_user) AND ($viaje->borrado_logico =='0') )
         {

             $this->db->query("UPDATE `pasajero` SET estado='1' WHERE usuario_id='$id_user' AND viaje_id='$id_viaje'");
             return $this->db->execute();
         }
     }

     public function rechazarPasajero($id_viaje,$id_user){

         $viaje = $this->getViaje($id_viaje);
         if ($this->estaEnPasajero($id_viaje, $id_user) AND ($viaje->conductor_id != $id_user) AND ($viaje->borrado_logico =='0') )
         {

             $this->db->query("UPDATE `pasajero` SET estado='2' WHERE usuario_id='$id_user' AND viaje_id='$id_viaje'");
             return $this->db->execute();
         }
     }

     public function eliminarPasajero($id_viaje,$id_user){

         $pasajero = $this->db->query("SELECT estado FROM pasajero WHERE viaje_id='$id_viaje' AND usuario_id='$id_user' AND borrado_logico='0'");

         if ( $this->estaEnPasajero($id_viaje,$id_user) AND ( $pasajero->estado == '0'))
             {
             $this->db->query(" DELETE FROM `pasajero` WHERE viaje_id='$id_viaje' AND usuario_id='$id_user'");
             }
             else {$this->db->query(" UPDATE `pasajero` SET borrado_logico='1' WHERE viaje_id='$id_viaje' AND usuario_id='$id_user'");};
         return $this->db->execute();
     }

     public function getAllViajes() {

         $this->db->query("SELECT * FROM viaje WHERE borrado_logico='0' ORDER BY horasalida, horallegada DESC");
         return $this->db->registros();
     }

     public function getAllCantidadViajes(){

         $this->db->query("SELECT * FROM viaje WHERE borrado_logico='0'");
         return $this->db->registrorowCount();
     }

     public function getAllCantidadViajesFechaActual(){

         $this->db->query("SELECT * FROM viaje WHERE borrado_logico='0' AND horasalida > NOW() ORDER BY horasalida");
         return $this->db->registrorowCount();
     }

     public function getAllViajesFechaActual() {

         $this->db->query("SELECT * FROM viaje WHERE borrado_logico='0' AND horasalida > NOW() ORDER BY horasalida, horallegada DESC");
         return $this->db->registros();
     }


     public function getViaje($idViaje){

         $this->db->query("SELECT * FROM viaje WHERE id='$idViaje' AND borrado_logico='0'");
         return $this->db->registro();

    }

 //select v.*,p.flagcalificacion_pasajero,p.flagcalificacion_conductor,p.estado,p.calificacion_pasajero,p.calificacion_conductor,p.comentario_pasajero,p.comentario_conductor from ingenieriadev.viaje v left join ingenieriadev.pasajero p on v.id=p.viaje_id where v.id='296' and p.usuario_id='2' ;
     public function getViajePasajero($idViaje,$idpasajero){

         if ($this->estaEnPasajero($idViaje,$idpasajero)){
             $this->db->query("SELECT v.*,p.flagcalificacion_pasajero,p.flagcalificacion_conductor,p.estado,p.calificacion_pasajero,p.calificacion_conductor,p.comentario_pasajero,p.comentario_conductor FROM viaje v LEFT JOIN pasajero p ON v.id=p.viaje_id where v.id=$idViaje AND p.usuario_id=$idpasajero AND v.borrado_logico='0' AND p.borrado_logico='0'");
         }
         else{
             $this->db->query("SELECT * FROM viaje WHERE id='$idViaje' AND borrado_logico='0'");
         };
         return $this->db->registro();

     }


     public function conductorEnUso($id_conductor, $fechayhorasalida, $fechayhorallegada, $id_viaje) {
/*
 * WHERE $fecha_inicio BETWEEN [campo_fecha_inicio] AND [campo_fecha_fin]
 *   OR $fecha_fin BETWEEN [campo_fecha_inicio] AND [campo_fecha_fin]
 *   OR campo_fecha_inicio BETWEEN $fecha_inicio AND $fecha_fin           
*/         
         $this->db->query("
         SELECT * 
         FROM viaje 
         WHERE conductor_id='$id_conductor' AND id<>'$id_viaje' 
                  AND (('$fechayhorasalida'  BETWEEN horasalida and horallegada) 
                       OR ('$fechayhorallegada'  BETWEEN horasalida and horallegada) 
                       OR (horasalida  BETWEEN '$fechayhorasalida'  and '$fechayhorallegada')) 
                  AND borrado_logico='0'");
         return $this->db->registrorowCount();
     }

    public function autoEnUso($id_auto, $fechayhorasalida, $fechayhorallegada, $id_viaje) {

         $this->db->query("SELECT * FROM viaje WHERE auto_id='$id_auto' AND id<>'$id_viaje' 
                            AND (('$fechayhorasalida'  BETWEEN horasalida AND horallegada) 
                                OR ('$fechayhorallegada'  BETWEEN horasalida AND horallegada) 
                                OR (horasalida  BETWEEN '$fechayhorasalida' AND '$fechayhorallegada')) 
                            AND borrado_logico='0'");
         return $this->db->registrorowCount();
     }

     public function ViajesComoPasajero($id) {

         $sql = "     select * from viaje
         INNER JOIN pasajero WHERE pasajero.viaje_id= viaje.id
         AND pasajero.usuario_id = '$id' AND pasajero.borrado_logico='0' AND viaje.borrado_logico='0' ORDER BY viaje.horasalida, viaje.horallegada DESC";
         $this->db->query($sql);
         return $this->db->registros();
       //return $sql;
    }

    public function traerPasajero($id_viaje, $id_usuario) {

        $sql = " select * from pasajero where viaje_id = '$id_viaje' and usuario_id ='$id_usuario' AND borrado_logico='0'" ;
        $this->db->query($sql);
        return $this->db->registro();

    }

    public function tienePasajeros($id_viaje) {

        $sql = " select * from pasajero where viaje_id = '$id_viaje' and estado = 1 AND borrado_logico='0'" ;
        $this->db->query($sql);
        if ($this->db->registrorowCount() > 0){
            return 1;}
            else{
                return 0;
            }
    }

    public function getConsultas($id_viaje, $estado) {

        $sql = " select c.id, c.id_viaje, c.pregunta, c.id_usuario, c.respuesta, c.estado, u.nombreusuario from consultas c INNER JOIN usuario u ON (c.id_usuario=u.id) where id_viaje = '$id_viaje' and estado = '$estado'" ;
        $this->db->query($sql);
        return $this->db->registros();
    }
     public function getConsulta($id_consulta) {

         $sql = " select * from consultas where id = '$id_consulta'" ;
         $this->db->query($sql);
         return $this->db->registro();
     }


     public function hacerPregunta($idUsuario, $idViaje, $pregunta) {

        $sql = " INSERT INTO consultas (id_viaje, id_usuario, pregunta, estado) VALUES ('$idViaje', '$idUsuario', '$pregunta', 0) " ;
        $this->db->query($sql);
        return $this->db->execute();
    }

    public function responderPregunta($idPregunta, $respuesta) {

        $sql = " UPDATE consultas SET respuesta='$respuesta', estado = 1 WHERE id = '$idPregunta'" ;
        $this->db->query($sql);
        return $this->db->execute();
    }

    public function eliminarPregunta($idPregunta) {

        $sql = " DELETE FROM consultas  WHERE id = '$idPregunta'" ;
        $this->db->query($sql);
        return $this->db->execute();
    }

     public function ConsultaSqlArmada($sql) {
         $this->db->query($sql);
         return $this->db->registros();

     }


 }



 
