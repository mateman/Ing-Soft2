<?php 

 class Usuario {
     private $db;
     public function __construct() {
         $this->db = new Database;

     }
     public function getUsuarios() {
         $this->db->query("SELECT * FROM usuario WHERE borrado_logico='0'");
         return $this->db->registros();
     }

     public function login($nombreusuario, $password) {
        $this->db->query("SELECT * FROM usuario WHERE nombreusuario = '$nombreusuario' and contrasena = '$password' AND borrado_logico='0'");
        return $this->db->registro();
     }

     public function getById($id) {
        $this->db->query("SELECT * FROM usuario WHERE id = '$id' AND borrado_logico='0'");
        return $this->db->registro();
    }
    public function mailExist($email) {
        $this->db->query("SELECT * FROM usuario WHERE email = '$email' AND borrado_logico='0'");
        //return "SELECT * FROM usuario WHERE email = '$email'";
        return $this->db->registro();

    }
    public function userNameExist($username) {
        $this->db->query("SELECT * FROM usuario WHERE nombreusuario = '$username' AND borrado_logico='0'");
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
        $q = "

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
                                `tienevehiculo`,
                                `imagen_url`,
                                `borrado_logico`
                                ) VALUES 
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
                                 '0',
                                'avatar.png',
                                '0');";
          
        $this->db->query($q);
    
        
        
       return $this->db->execute();

    }

    public function userUpdate(
        $email,
        $provincia,
        $apellido,
        $telefono,
        $nombre,
        $ciudad,
        $id) {
        $this->db->query("
        UPDATE `usuario` SET nombre='$nombre', email='$email', provincia='$provincia', 
        apellido='$apellido', telefono='$telefono', ciudad='$ciudad' 
        WHERE id='$id' AND borrado_logico='0'");
        //return "SELECT * FROM usuario WHERE email = '$username'";
        return $this->db->execute();

    }


    public function subirFoto($id, $name_image) {
        $sql = "
        UPDATE `usuario` SET 
        `imagen_url` = '$name_image' 
        WHERE `usuario`.`id` = '$id' AND borrado_logico='0';";
        $this->db->query($sql);
        //echo $sql;
       return $this->db->execute();
    }

    public function contrasenaUpdate($contrasena,$id) {
        $this->db->query("

        UPDATE `usuario` SET contrasena='$contrasena'
        WHERE id='$id' AND borrado_logico='0';");
        
        return $this->db->execute();

    }

    public function sumarPuntos($id,$puntos){
        $this->db->query("UPDATE tabla SET puntos = puntos +$puntos  WHERE id='$id' AND borrado_logico='0';");
        return $this->db->execute();
    }

    public function restarPuntos($id,$puntos){
        $this->db->query( "UPDATE tabla SET puntos = puntos -$puntos  WHERE id='$id'AND borrado_logico='0';");
        return $this->db->execute();
    }


 }
