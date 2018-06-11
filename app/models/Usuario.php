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
     public function login($nombreusuario, $password) {
        $this->db->query("SELECT * FROM usuario WHERE nombreusuario = '$nombreusuario' and contrasena = '$password'");
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
                                `imagen_url`
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
                                'avatar.png');";
          
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
        WHERE id='$id'");
        //return "SELECT * FROM usuario WHERE email = '$username'";
        return $this->db->execute();

    }
    public function getCantidadAutos($id) {
         $this->db->query("SELECT * FROM vehiculo WHERE usuario_id='$id'");
         return $this->db->registrorowCount();
     }

       public function getAutos($id) {
         $this->db->query("SELECT * FROM vehiculo WHERE usuario_id='$id'");
         return $this->db->registros();
     }

        public function getAuto($id) {
         $this->db->query("SELECT * FROM vehiculo WHERE id='$id'");
         return $this->db->registro();
     }

         public function autoUpdate($id, $patente, $marca, $asientosdisp,$modelo) {
        $this->db->query("

        UPDATE `vehiculo` SET patente='$patente', marca='$marca', asientosdisp='$asientosdisp',modelo='$modelo'
        WHERE id='$id'
        
        
        
        ");
        //return "SELECT * FROM usuario WHERE email = '$username'";
        return $this->db->execute();

    }

      public function autoEliminar($id) {
        $this->db->query("

        DELETE FROM `vehiculo` WHERE id='$id'
        
        
        
        ");
        //return "SELECT * FROM usuario WHERE email = '$username'";
        return $this->db->execute();

    }

    public function autoAgregar($patente, $marca, $asientosdisp, $user_id, $modelo_auto) {
        $this->db->query("

        INSERT INTO `vehiculo` (`patente`, `marca`, `asientosdisp`, `usuario_id`,`modelo`) VALUES ('$patente', '$marca', '$asientosdisp', '$user_id','$modelo_auto');

        
        
        
        ");
      return $this->db->execute();

    }
    public function subirFoto($id, $name_image) {
        $sql = "
        UPDATE `usuario` SET 
        `imagen_url` = '$name_image' 
        WHERE `usuario`.`id` = '$id';";
        $this->db->query($sql);
        //echo $sql;
       return $this->db->execute();
    }

    public function contrasenaUpdate($contrasena,$id) {
        $this->db->query("

        UPDATE `usuario` SET contrasena='$contrasena'
        WHERE id='$id';");
        
        return $this->db->execute();

    }
 }