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
        $this->db->query("SELECT * FROM vehiculo WHERE usuario_id='$id'");
        return $this->db->registrorowCount();
    }

    public function getAutos($id)
    {
        $this->db->query("SELECT * FROM vehiculo WHERE usuario_id='$id'");
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
        WHERE id='$id'
        
        
        
        ");
        //return "SELECT * FROM usuario WHERE email = '$username'";
        return $this->db->execute();

    }


    public function autoEliminar($id)
    {
        $this->db->query("

        DELETE FROM `vehiculo` WHERE id='$id'
        
        
        
        ");
        //return "SELECT * FROM usuario WHERE email = '$username'";
        return $this->db->execute();

    }

    public function autoAgregar($patente, $marca, $asientosdisp, $user_id, $modelo_auto)
    {
        $this->db->query("

        INSERT INTO `vehiculo` (`patente`, `marca`, `asientosdisp`, `usuario_id`,`modelo`) VALUES ('$patente', '$marca', '$asientosdisp', '$user_id','$modelo_auto');

        
        
        
        ");
        return $this->db->execute();

    }


    public function autoLibre($id){
        $this->db->query("SELECT * FROM viaje WHERE auto_id='$id'");
        return $this->db->registrorowCount();
    }


}