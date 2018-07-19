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

    public function verPuntosPasajero ($id_User){
        $this->db->query("SELECT SUM(calificacion_pasajero) AS suma
                              FROM pasajero 
                              WHERE usuario_id = '$id_User'
                        ");
        return $this->db->registro();
    }

  // ver select tabla1.nombre, sum(tabla2.valor) from tabla1, tabla2 where id_tabla1 = id_tabla2 group by tabla1.nombre, tabla2.valor
     public function verPuntosConductor ($id_User){
         $res1 = $this->db->query("SELECT  SUM(b.calificacion_conductor) AS suma 
                              FROM viaje a LEFT JOIN pasajero b ON a.id = b.viaje_id
                              WHERE a.conductor_id = '$id_User'
                        ");
         return ($this->db->registro());
     }

    
    public function calificarPasajero($viaje_id,$punto,$usuario_id,$comentario){
        $this->db->query("UPDATE pasajero SET calificacion_pasajero='$punto', comentario_pasajero='$comentario', flagcalificacion_pasajero= b'1' WHERE viaje_id='$viaje_id' AND usuario_id=$usuario_id AND estado='1' AND borrado_logico='0';");
        return $this->db->execute();
    }

    public function calificarConductor($viaje_id,$punto,$usuario_id,$comentario){
        $this->db->query("UPDATE pasajero SET calificacion_conductor='$punto', comentario_conductor='$comentario', flagcalificacion_conductor= b'1'  WHERE viaje_id='$viaje_id' AND usuario_id='$usuario_id' AND estado='1' AND borrado_logico='0';");
        return $this->db->execute();
    }

    public function getAntecedentesPasajero($idUsuario) {
        $this->db->query("SELECT p.*, u.nombreusuario  FROM pasajero p INNER JOIN viaje v on p.viaje_id = v.id  INNER JOIN usuario u on v.conductor_id = u.id WHERE p.borrado_logico='0' and p.usuario_id='$idUsuario' and p.flagcalificacion_pasajero= b'1' and v.borrado_logico='0'");
        return $this->db->registros();
    }

    public function getAntecedentesConductor($idUsuario) {
         $this->db->query("SELECT p.*, u.nombreusuario  FROM pasajero p INNER JOIN viaje v on p.viaje_id = v.id  INNER JOIN usuario u on p.usuario_id = u.id WHERE p.borrado_logico='0' and v.conductor_id='$idUsuario' and p.flagcalificacion_conductor= b'1' and v.borrado_logico='0'");
         return $this->db->registros();
    }


 }
