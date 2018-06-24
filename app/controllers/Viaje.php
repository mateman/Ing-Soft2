<?php


class Viaje extends Controller
{

    public function __construct()
    {
        $this->session = new Session();
        $this->session->init();

        if ($this->session->getStatus() === 1 || empty($this->session->get('id')))
            exit('Acceso denegado');
    }


    public function agregarViaje()
    {
        $autoModelo = $this->model('Modeloauto');
        $user_id = $this->session->get('id');
        $cantAutos = $autoModelo->getCantidadAutos($user_id);

        if ($cantAutos == 0) {
            $datos = [
                'mensaje' => 'Usted no posee autos, no puede crearviaje'
            ];

            $this->view('userinterface/misviajes', $datos);
        } else {
            $autos = $autoModelo->getAutos($user_id);
            $datos = [
                'cantAutos' => $cantAutos,
                'autos' => $autos,

            ];


            $this->view('viaje/crearviajes', $datos);
        }

    }


    public function viajeCrear()
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires'); // hora Bs As
        $autoModelo = $this->model('Modeloauto');
        $user_id = $this->session->get('id');
        $autos = $autoModelo->getAutos($user_id);
        $cantAutos = $autoModelo->getCantidadAutos($user_id);
        $viajeModelo = $this->model('Modeloviajes');

        if (!(empty($_POST['origen'])) and !(empty($_POST['destino'])) and !(empty($_POST['fechayhorallegada'])) and !(empty($_POST['fechayhorasalida'])) and !(empty($_POST['costo'])) and !(empty($_POST['tipodeviaje'])) and !(empty($_POST['autodelviaje']))) {
            $fecha_actual = date("Y-m-d H:i:s", time());  //en la version anterior estaba comparando fechas con formatos diferentes, pase fecha actual de salida y de llegada al mismo formato
            $origen = $_POST['origen'];
            $destino = $_POST['destino'];
            $fechayhorallegada = $_POST['fechayhorallegada'];
            $phpdate = strtotime($fechayhorallegada);
            $fechayhorallegada = date('Y-m-d H:i:s', $phpdate);

            $fechayhorasalida = $_POST['fechayhorasalida'];
            $phpdate2 = strtotime($fechayhorasalida);
            $fechayhorasalida = date('Y-m-d H:i:s', $phpdate2);

            $costo = $_POST['costo'];
            $tipodeviaje = $_POST['tipodeviaje'];
            $autodelviaje = $_POST['autodelviaje'];
            $descripcion = $_POST['descripcion'];

            if (isset($_POST['repetir'])) {
                $repetir = $_POST['repetir'];
            } else {
                $repetir = 1;
            }

            if (($fecha_actual < $fechayhorallegada) AND ($fecha_actual < $fechayhorasalida) AND ($fechayhorasalida < $fechayhorallegada)) {
                $autoEnUso = $viajeModelo->autoEnUso($autodelviaje, $fechayhorasalida, $fechayhorallegada, 0);
                if ($autoEnUso > 0) {
                    $datos = [
                        'mensaje' => 'El auto seleccionado esta en uso para el horario del viaje.',
                        'origen' => $origen,
                        'destino' => $destino,
                        'fechayhorallegada' => $fechayhorallegada,
                        'fechayhorasalida' => $fechayhorasalida,
                        'costo' => $costo,
                        'tipodeviaje' => $tipodeviaje,
                        'autodelviaje' => $autodelviaje,
                        'descripcion' => $descripcion,
                        'autos' => $autos,
                        'cantAutos' => $cantAutos
                    ];

                    $this->view('viaje/crearviajes', $datos);
                    exit();
                }

                $crearviaje = $viajeModelo->viajeAgregar($descripcion, $origen, $destino, $fechayhorallegada, $fechayhorasalida, $costo, $tipodeviaje, $autodelviaje, $user_id, $repetir);
                $viajemodelo = $this->model('Modeloviajes');
                $cantViajes = $viajemodelo->getCantidadViajes($user_id);
                $viajes = $viajemodelo->getViajes($user_id);
                $datos = ['mensaje' => 'Viaje creado correctamente!',
                    'cantViajes' => $cantViajes,
                    'viajes' => $viajes
                ];
                $this->view('userinterface/misviajes', $datos);
            } else {
                $autos = $autoModelo->getAutos($user_id);
                $datos = [
                    'mensaje' => 'Debe poner fechas futuras!',
                    'origen' => $origen,
                    'destino' => $destino,
                    'fechayhorallegada' => $fechayhorallegada,
                    'fechayhorasalida' => $fechayhorasalida,
                    'costo' => $costo,
                    'tipodeviaje' => $tipodeviaje,
                    'autodelviaje' => $autodelviaje,
                    'descripcion' => $descripcion,
                    'autos' => $autos,
                    'cantAutos' => $cantAutos
                ];

                $this->view('viaje/crearviajes', $datos);
                exit();

            }
        } else {
            $autos = $autoModelo->getAutos($user_id);
            $datos = [
                'mensaje' => 'Debe completar todos los campos!',
                'cantAutos' => $cantAutos,
                'autos' => $autos,
            ];

            $this->view('viaje/crearviajes', $datos);
        }
    }


    /**
     * @param $id
     */
    public function modificarViaje($id)
    {
        $autoModelo = $this->model('Modeloauto');
        $user_id = $this->session->get('id');
        $autos = $autoModelo->getAutos($user_id);
        $cantAutos = $autoModelo->getCantidadAutos($user_id);
        $viajeModelo = $this->model('Modeloviajes');
        $viaje = $viajeModelo->getViaje($id);
        $datos = [
            'mensaje' => '',
            'origen' => $viaje->origen,
            'destino' => $viaje->destino,
            'fechayhorallegada' => date("d-m-Y H:i", strtotime($viaje->horallegada)),
            'fechayhorasalida' => date("d-m-Y H:i", strtotime($viaje->horasalida)),
            'costo' => $viaje->costo,
            'autodelviaje' => $viaje->auto_id,
            'descripcion' => $viaje->descripcion,
            'autos' => $autos,
            'cantAutos' => $cantAutos,
            'id' => $id
        ];

        $this->view('viaje/modificarviaje', $datos);

    }


        public function viajeModificar($id)
    {
          date_default_timezone_set('America/Argentina/Buenos_Aires'); // hora Bs As
        $autoModelo = $this->model('Modeloauto');
        $user_id = $this->session->get('id');
        $autos = $autoModelo->getAutos($user_id);
        $cantAutos = $autoModelo->getCantidadAutos($user_id);
        $viajeModelo = $this->model('Modeloviajes');

        if ($viajeModelo->viajeLibre($id) == 0) {
            if (!(empty($_POST['origen'])) and !(empty($_POST['destino'])) and !(empty($_POST['fechayhorallegada'])) and !(empty($_POST['fechayhorasalida'])) and !(empty($_POST['costo'])) and !(empty($_POST['autodelviaje']))) {
                $fecha_actual = date("Y-m-d H:i:s", time());
                $fechayhorallegada = date("Y-m-d H:i:s", strtotime($_POST['fechayhorallegada']));
                $fechayhorasalida = date("Y-m-d H:i:s", strtotime($_POST['fechayhorasalida']));
                $autodelviaje = $_POST['autodelviaje'];

                if (($fecha_actual < $fechayhorallegada) AND ($fecha_actual < $fechayhorasalida) AND ($fechayhorasalida < $fechayhorallegada)) {
                    $autoEnUso = $viajeModelo->autoEnUso($autodelviaje, $fechayhorasalida, $fechayhorallegada, $id);
                    if ($autoEnUso > 0) {
                        $datos = [
                            'mensaje' => 'El auto seleccionado esta en uso para el horario del viaje.',
                            'origen' => $_POST['origen'],
                            'destino' => $_POST['destino'],
                            'fechayhorallegada' => $_POST['fechayhorallegada'],
                            'fechayhorasalida' => $_POST['fechayhorasalida'],
                            'costo' => $_POST['costo'],
                            'autodelviaje' => $autodelviaje,
                            'descripcion' => $_POST['descripcion'],
                            'autos' => $autos,
                            'cantAutos' => $cantAutos,
                            'id' => $id
                        ];

                        $this->view('viaje/modificarviaje', $datos);
                        exit();
                    }

                    $modificarviaje = $viajeModelo->viajeModificar($_POST['descripcion'], $_POST['origen'], $_POST['destino'], $fechayhorallegada, $fechayhorasalida, $_POST['costo'], $autodelviaje, $user_id, $id);

                    $cantViajes = $viajeModelo->getCantidadViajes($user_id);
        $viajes = $viajeModelo->getViajes($user_id);
         $datos = [
             'cantViajes' => $cantViajes,
             'viajes' => $viajes,
             'mensaje' => 'Viaje modificado correctamente!'
         ];

                    $this->view('userinterface/misviajes', $datos);
                } else {
                    $autos = $autoModelo->getAutos($user_id);
                    $datos = [
                        'mensaje' => 'Debe poner fechas futuras!',
                        'origen' => $_POST['origen'],
                        'destino' => $_POST['destino'],
                        'fechayhorallegada' => $_POST['fechayhorallegada'],
                        'fechayhorasalida' => $_POST['fechayhorasalida'],
                        'costo' => $_POST['costo'],
                        'autodelviaje' => $autodelviaje,
                        'descripcion' => $_POST['descripcion'],
                        'autos' => $autos,
                        'cantAutos' => $cantAutos,
                        'id' => $id
                    ];

                    $this->view('viaje/modificarviaje', $datos);
                    exit();

                }
            } else {
                $autos = $autoModelo->getAutos($user_id);
                $datos = [
                    'mensaje' => 'Debe completar todos los campos!',
                    'cantAutos' => $cantAutos,
                    'autos' => $autos,
                ];

                $this->view('viaje/modificarviaje', $datos);
            }

        }
        else {
            $datos =[ 'mensaje' =>'No se puede modificar el viaje por encontrarse alguna una solicitud de un usuario'];
            $this->view('pages/error', $datos);
        }
    }


    /**
     * @param $id
     */
    public function viajeEliminar($id)
    {
        $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        $viajeModelo = $this->model('Modeloviajes');
        if ($viajeModelo->getCantidadPasajeroAceptados($id) != 0){
              $usuarioModelo->penalizar($user_id);
          }
        $viajeModelo->eliminarViaje($id);
        $cantViajes = $viajeModelo->getCantidadViajes($user_id);
        $viajes = $viajeModelo->getViajes($user_id);
        $datos = ['mensaje' => 'Viaje eliminado correctamente!',
            'cantViajes' => $cantViajes,
            'viajes' => $viajes
        ];
        $this->view('userinterface/misviajes', $datos);

    }

    public function muro($id)
    {
        $autoModelo = $this->model('Modeloauto');
        $user_id = $this->session->get('id');
        $viajeModelo = $this->model('Modeloviajes');
        $viaje = $viajeModelo->getViaje($id);
        $auto = $autoModelo->getAuto($viaje->auto_id);
        $usuario = $this->model('Usuario');
        $conductor = $usuario->getById($viaje->conductor_id);
       
        if ($viaje->conductor_id == $user_id){
            $usuarioModelo = $this->model('Usuario');
            $pasajeros = $viajeModelo->getPasajero($id);
            $cantPasajero = $viajeModelo;
            $datos = [  'mensaje' => 'Sos el Conductor de este viaje',
                        'conductor' => $conductor,
                        'rol'=> 'conductor',
                        'anotarse'=>'0', // Ver esto
                        'auto' => $auto, // Datos relacionados al auto 
                        'viaje' => $viaje, // Datos del viaje
                        'pasajeros'=> $pasajeros, // Ver esto
                        'path'=>'userinterface/allViajes/%20' // ver Esto
            ];

        }
        else {
            // ESTO ESPARA TODAS LAS PERSONAS
            $usuario = $this->model('Usuario');
            $conductor = $usuario->getById($viaje->conductor_id);
            if ($viajeModelo->estaEnPasajero($id,$user_id)) {
                $anotarse='0';
            }
            else{$anotarse = '1';};
            $datos = ['mensaje' => '',
                'anotarse'=>$anotarse,
                'rol'=> 'publico',
                'auto' => $auto,
                'viaje' => $viaje,
                'conductor'=> $conductor,
                'path'=>'userinterface/allViajes/%20'
        ];
        };
        $this->view('viaje/muro', $datos);
    }
}