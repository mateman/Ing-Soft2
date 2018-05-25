<?php 

 class Usuario {
     private $db;
     public function __construct() {
         $this->db = new Database;

     }
     public function getUsuarios() {
         $this->db->query("SELECT * FROM usuario");
         return $this->db->registros();
     }
     public function login($email,$password) {
        $this->db->query("SELECT * FROM usuario WHERE email = '$email' and contrasena = '$password'");
        return $this->db->registro();
     }
     public function getById($id) {
        $this->db->query("SELECT * FROM usuario WHERE id = '$id'");
        return $this->db->registro();
    }
    public function mailExist($email) {
        $this->db->query("SELECT * FROM usuario WHERE email = '$email'");
        //return "SELECT * FROM usuario WHERE email = '$email'";
        return $this->db->registro();

    }
    public function userNameExist($username) {
        $this->db->query("SELECT * FROM usuario WHERE nombreusuario = '$username'");
        //return "SELECT * FROM usuario WHERE email = '$username'";
        return $this->db->registro();

    }
    public function userCreate(
        $email,
        $contrasena, 
        $provincia,
        $fechanac,
        $apellido,
        $telefono,
        $nombre ,
        $nombreusuario,
        $ciudad
        ) {
        $this->db->query("

        INSERT INTO `usuario` (`contrasena`, 
                                `provincia`, 
                                `fechanac`, 
                                `apellido`, 
                                `telefono`, 
                                `nombre`, 
                                `nombreusuario`, 
                                `ciudad`, 
                                `email`, 
                                `id`, 
                                `tienevehiculo`) VALUES 
                                ('$contrasena', 
                                '$provincia', 
                                '$fechanac', 
                                '$apellido', 
                                '$telefono', 
                                '$nombre', 
                                '$nombreusuario', 
                                '$ciudad', 
                                '$email',
                                 NULL, 
                                 '0');
        
        
        
        ");
        //return "SELECT * FROM usuario WHERE email = '$username'";
        return $this->db->execute();

    }
 }