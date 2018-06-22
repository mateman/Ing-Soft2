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
        $this->db->query("SELECT * FROM vehiculo WHERE usuario_id='$id' AND borrado_logico=0");
        return $this->db->registrorowCount();
    }

    public function getAutos($id)
    {
        $this->db->query("SELECT * FROM vehiculo WHERE usuario_id='$id' AND borrado_logico=0");
        return $this->db->registros();
    }

    public function getAuto($id)
    {
        $this->db->query("SELECT * FROM vehiculo WHERE id='$id' AND borrado_logico=0");
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
        $autoL $this->db->registrorowCount();
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
        $this->db->query("SELECT * FROM viaje WHERE auto_id='$id' AND borrado_logico=0");
        return $this->db->registrorowCount();
    }


}