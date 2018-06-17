<?php 

 class ModeloBuscador {
     private $db;
     public function __construct() {
         $this->db = new Database;

     }

        public function getViajes($salidadesde, $salidahasta, $llegadadesde, $llegadahasta, $origen, $destino) {
         $this->db->query("SELECT * FROM viaje WHERE (horasalida BETWEEN $salidadesde AND $salidahasta) AND (horallegada BETWEEN $llegadadesde AND $llegadahasta) AND origen LIKE $origen AND destino LIKE $destino");
         return $this->db->registros();
     }
 }