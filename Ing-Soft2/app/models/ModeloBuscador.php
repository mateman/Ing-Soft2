<?php 

 class ModeloBuscador {
     private $db;
     public function __construct() {
         $this->db = new Database;

    }
    public function getAllViajes() {
        $this->db->query("SELECT * FROM viaje");
        return $this->db->registros();
    }
    public function getViajes($data) {
        $q = "SELECT * FROM viaje WHERE origen LIKE '%$data%' or destino LIKE '%$data%' or descripcion LIKE '%$data%' ";
        $this->db->query($q);
        return $this->db->registros();
  
    }
    public function ConsultaSqlArmada($sql) {
        $this->db->query($sql);
        return $this->db->registros();

    }

    /*
    public function getViajes($salidadesde, $salidahasta, $llegadadesde, $llegadahasta, $origen, $destino) {
         $this->db->query("SELECT * FROM viaje WHERE (horasalida BETWEEN $salidadesde AND $salidahasta) AND (horallegada BETWEEN $llegadadesde AND $llegadahasta) AND origen LIKE $origen AND destino LIKE $destino");
         return $this->db->registros();
     }
     */
 }