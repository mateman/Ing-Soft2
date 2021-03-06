<?php
class Modeloauto
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;

    }

    public function getCantidadAutos($id)
    {
        $fecha_actual = date("Y-m-d H:i:s", time());
//Codigo viejo        $this->db->query("SELECT * FROM vehiculo WHERE usuario_id='$id' AND borrado_logico=0");
        $this->db->query( "SELECT * FROM vehiculo vh LEFT JOIN (SELECT COUNT(id) as enuso, auto_id FROM viaje WHERE conductor_id= $id AND horasalida > '$fecha_actual' AND borrado_logico='0' GROUP BY auto_id) p ON vh.id = p.auto_id  where vh.usuario_id = $id AND vh.borrado_logico='0'");
        return $this->db->registrorowCount();
    }

    public function getAutos($id)
    {
        $fecha_actual = date("Y-m-d H:i:s", time());
        // use ingenieriadev; SELECT * FROM vehiculo vh LEFT JOIN (SELECT COUNT(id) as enuso, auto_id FROM viaje WHERE conductor_id= '2' AND borrado_logico='0' GROUP BY auto_id) p ON vh.id = p.auto_id  where vh.usuario_id = '2'
        $this->db->query( "SELECT * FROM vehiculo vh LEFT JOIN (SELECT COUNT(id) as enuso, auto_id FROM viaje WHERE conductor_id= $id AND horasalida > '$fecha_actual' AND borrado_logico='0' GROUP BY auto_id) p ON vh.id = p.auto_id  where vh.usuario_id = $id AND vh.borrado_logico='0'");
        //$this->db->query("SELECT * FROM vehiculo WHERE usuario_id='$id' AND borrado_logico=0");
        return $this->db->registros();
    }

    public function getAuto($id)
    {
        $this->db->query("SELECT * FROM vehiculo WHERE id='$id'");
        return $this->db->registro();
    }

    public function autoUpdate($id, $patente, $marca, $asientosdisp, $modelo)
    {
        $this->db->query("

        UPDATE `vehiculo` SET patente='$patente', marca='$marca', asientosdisp='$asientosdisp',modelo='$modelo'
        WHERE id='$id' AND borrado_logico=0
        ");
        //return "SELECT * FROM usuario WHERE email = '$username'";
        return $this->db->execute();

    }


    public function autoEliminar($id)
    {
        $this->db->query("SELECT * FROM viaje WHERE auto_id='$id'");
        $autoL = $this->db->registrorowCount();
        if (0 == $autoL){
            $this->db->query(" DELETE FROM `vehiculo` WHERE id='$id'");}
        else {$this->db->query(" UPDATE `vehiculo` SET borrado_logico='1' WHERE id='$id'");}
        return $this->db->execute();

    }

    public function autoAgregar($patente, $marca, $asientosdisp, $user_id, $modelo_auto)
    {
        $this->db->query("

        INSERT INTO `vehiculo` (`patente`, `marca`, `asientosdisp`, `usuario_id`,`modelo`,`borrado_logico`) VALUES ('$patente', '$marca', '$asientosdisp', '$user_id','$modelo_auto',0);

        ");
        return $this->db->execute();

    }


    public function autoLibre($id){
        $fecha_actual = date("Y-m-d H:i:s", time());
        $this->db->query("SELECT * FROM viaje WHERE auto_id='$id' AND horasalida='$fecha_actual' AND borrado_logico=0");
        return $this->db->registrorowCount();
    }


}