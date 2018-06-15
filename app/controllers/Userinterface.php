<?php

// 366 lineas de codigo
// 244 lineas

class Userinterface extends Controller {

    public function __construct() {
        $this->session = new Session();
        $this->session->init();
        if($this->session->getStatus() === 1 || empty($this->session->get('id')))
          exit('Acceso denegado');
    }

    private function datosUsuario() {
        $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        return $usuarioModelo->getById($user_id);
    }

    /**
     *
     */

    public function index() {
        $usuario = $this->datosUsuario();
        $this->allViajes('Hola '.$usuario->nombreusuario.', Bienvenido!');
    }

    public function allViajes($mensaje) {
        $viajemodelo = $this->model('Modeloviajes');
        $cantViajes = $viajemodelo->getAllCantidadViajes();
        $viajes = $viajemodelo->getAllViajes();
        $datos = [
            'mensaje' => $mensaje,
            'cantViajes' => $cantViajes,
            'viajes' => $viajes
        ];

        $this->view('userinterface/index', $datos );
    }

    public function logout() {
        $this->session->close();
        $url = RUTA_URL;
        header('location:'.$url);
    }

    private function datoVista($usuario) {
       return $datos = [
            'nombreusuario' => $usuario->nombreusuario,
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido,
            'telefono' => $usuario->telefono,
            'provincia' => $usuario->provincia,
            'ciudad' => $usuario->ciudad,
            'email' => $usuario->email,
            'imagenurl' => $usuario->imagen_url,
            'id' => $usuario->id,
            'fechanac' =>$usuario->fechanac,
        ];
       

    }

    public function perfil() {
        $usuario = $this->datosUsuario();
        $datos = $this->datoVista($usuario);
        $this->view('userinterface/perfil', $datos);
    }

    public function modificarperfil() {
        $usuario = $this->datosUsuario();
        $datos = $this->datoVista($usuario);
        $this->view('userinterface/modificarperfil', $datos); 
    }
    
    public function actualizarperfil() {
       if (!(empty($_POST['email']))  and !(empty($_POST['provincia'])) and !(empty($_POST['apellido'])) and !(empty($_POST['telefono'])) and !(empty($_POST['nombre'])) and !(empty($_POST['ciudad']))) { 
        
            $usuarioModelo = $this->model('Usuario');   
            $usuario = $usuarioModelo->userUpdate( $_POST['email'], $_POST['provincia'],
                                                   $_POST['apellido'], $_POST['telefono'],
                                                   $_POST['nombre'], $_POST['ciudad'],
                                                   $this->session->get('id'));
            $usuario = $this->datosUsuario();
            $datos = $this->datoVista($usuario);
            $this->view('userinterface/perfil', $datos);
       } else {
            $usuario = $this->datosUsuario();
            $datos = $this->datoVista($usuario);
            $datos['mensaje'] = 'Deben completarse todos los datos';
            $this->view('userinterface/modificarperfil', $datos);
            die();
            }
        }

        public function actualizarContrasena() {

            return $this->view('userinterface/modificarcontrasena');

        }
        public function procesarContrasenas() {

            if (!(empty($_POST['contrasena']))  and !(empty($_POST['contrasena2'])))  { 
                $contrasena =  $_POST['contrasena'];
                $contrasena2 = $_POST['contrasena2'];
                $usuarioModelo = $this->model('Usuario');
                $user_id = $this->session->get('id');
                
                if($contrasena == $contrasena2) {
                    $usuario = $usuarioModelo->contrasenaUpdate($contrasena,$user_id);
                    $datos = [
                        'msj' => '<div class="alert alert-success" role="alert">
                        Password modificado correctamente
                      </div>'
                    ];
                    return $this->view('userinterface/modificarcontrasena', $datos);
                } else {
                $datos = [
                    'msj' => '<div class="alert alert-danger" role="alert">
                    Los passwords no son iguales
                  </div>'
                ];
                return $this->view('userinterface/modificarcontrasena', $datos);
                 }
            }
        }
        

   
   
   
   
        public function misautos (){
        $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        $cantAutos = $usuarioModelo->getCantidadAutos($user_id);
        $autos = $usuarioModelo->getAutos($user_id);

         $datos = [
         'cantAutos' => $cantAutos,
         'autos' => $autos
         ];

       $this->view('userinterface/misautos', $datos);  
    }

    public function misviajes () {
        $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        $viajemodelo = $this->model('Modeloviajes');
        $cantViajes = $viajemodelo->getCantidadViajes($user_id);
        $viajes = $viajemodelo->getViajes($user_id);
         $datos = [
             'cantViajes' => $cantViajes,
             'viajes' => $viajes
         ];

        $this->view('userinterface/misviajes', $datos);
    }  

    public function modificarAuto ($id) {

        $usuarioModelo = $this->model('Usuario');
        $auto = $usuarioModelo->getAuto($id);
        $modeloViaje = $this->model('Modeloviajes');
        if ($modeloViaje->autolibre($id) == 0) {
            $datos = [
                'id' => $auto->id,
                'patente' => $auto->patente,
                'marca' => $auto->marca,
                'modelo' => $auto->modelo,
                'asientosdisp' => $auto->asientosdisp,

            ];
            $this->view('userinterface/modificarAuto', $datos);
        }
        else {
            $datos =[ 'mensaje' =>'No se puede modificar el auto por encontrarse asociado a uno o mas viajes'];
            $this->view('pages/error', $datos);
        }

    }

    public function actualizarauto ($id) {
        $usuarioModelo = $this->model('Usuario');
        if (!(empty($_POST['patente'])) and !(empty($_POST['marca'])) and !(empty($_POST['asientosdisp'])) ){
            $patente =  $_POST['patente'];
            $marca =  $_POST['marca'];
            $asientosdisp =  $_POST['asientosdisp'];
            $modelo = $_POST['modelo'];
            $actualizar = $usuarioModelo -> autoUpdate ($id, $patente, $marca, $asientosdisp, $modelo);
            $usuarioModelo = $this->model('Usuario');
            $auto = $usuarioModelo->getAuto($id);
            $usuarioModelo = $this->model('Usuario');
            $user_id = $this->session->get('id');
            $cantAutos = $usuarioModelo->getCantidadAutos($user_id);
            $autos = $usuarioModelo->getAutos($user_id);
            $datos =[
                'mensaje' => 'La modificacion ha sido exitosa!',
                'id' => $auto->id,
                'patente' => $auto->patente,
                'marca' => $auto->marca,
                'asientosdisp' => $auto->asientosdisp,
                'cantAutos' => $cantAutos,
                'autos' => $autos
                ];
        $this->view('userinterface/misautos', $datos);  

        } else{
            $usuarioModelo = $this->model('Usuario');
                    $auto = $usuarioModelo->getAuto($id);

                    $datos =[
                        'mensaje' => 'Todos los campos deben estar completos!',
                        'id' => $auto->id,
                    'patente' => $auto->patente,
                    'marca' => $auto->marca,
                    'asientosdisp' => $auto->asientosdisp
                    ];
            $this->view('userinterface/modificarAuto', $datos);  

        }
    }
    
    public function eliminarauto ($id){
        $usuarioModelo = $this->model('Usuario');
        $modeloViaje = $this->model('Modeloviajes');
        if ($modeloViaje->autolibre($id) == 0) {
                $eliminar = $usuarioModelo->autoEliminar($id);
                $usuarioModelo = $this->model('Usuario');
                $user_id = $this->session->get('id');
                $cantAutos = $usuarioModelo->getCantidadAutos($user_id);
                $autos = $usuarioModelo->getAutos($user_id);
                $datos = [
                     'cantAutos' => $cantAutos,
                     'autos' => $autos,
                     'mensaje' => 'El auto ha sido eliminado exitosamente'
                ];
                $this->view('userinterface/misautos', $datos);
        }
        else {
            $datos = ['mensaje' => 'No se puede eliminar el auto por encontrarse asociado a uno o mas viajes'];
            $this->view('pages/error', $datos);}
    }
    
    public function agregarauto (){
       $this->view('userinterface/agregarauto'); 
    }

    public function autoagregar () {
        $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        if (!(empty($_POST['patente'])) and !(empty($_POST['marca'])) and !(empty($_POST['asientosdisp']))) {
            $usuarioModelo->autoAgregar($_POST['patente'],$_POST['marca'], $_POST['asientosdisp'], $user_id,$_POST['modelo']);
            $cantAutos = $usuarioModelo->getCantidadAutos($user_id);
            $autos = $usuarioModelo->getAutos($user_id);
            $datos = [
                'cantAutos' => $cantAutos,
                'autos' => $autos,
                'mensaje' => 'El auto ha sido agregado exitosamente'
                ];
            $this->view('userinterface/misautos', $datos); 
        } else {
            $datos = [
                        'mensaje' => 'Todos los campos deben estar completos'
                ];

            $this->view('userinterface/agregarauto', $datos); 
        }
    }
    public function updateImage() {
        // datos de la imagen
        $user_id = $this->session->get('id');
        $image_name = $user_id;
        //Para evitar tener muchos archivos de un usuario lo guardamos siempre con su nombre de id al archivo 
        //$image_name =  $user_id . $_FILES['imagen']['name'] ;
        $image_type = $_FILES['imagen']['type'];
        $image_size = $_FILES['imagen']['size'];
        $image_dir = RUTA_APP.'/../public/img/users/';
        move_uploaded_file($_FILES['imagen']['tmp_name'], $image_dir.$image_name);
        $usuarioModelo = $this->model('Usuario');
        $usuario = $usuarioModelo->subirFoto($user_id, $image_name);
        $url = RUTA_URL.'/userinterface/perfil';
        header("Location:$url ");

    }
 
}
