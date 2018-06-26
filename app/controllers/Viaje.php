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
                $conductorEnUso = $viajeModelo->conductorEnUso($user_id, $fechayhorasalida, $fechayhorallegada, 0);
                if ($conductorEnUso > 0) {
                    $datos = [
                        'mensaje' => 'Ya posee un viaje en este rango de fecha y hora.',
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

                $viajeModelo->viajeAgregar($descripcion, $origen, $destino, $fechayhorallegada, $fechayhorasalida, $costo, $tipodeviaje, $autodelviaje, $user_id, $repetir);
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
                    $conductorEnUso = $viajeModelo->conductorEnUso($user_id, $fechayhorasalida, $fechayhorallegada, $id);
                    if ($conductorEnUso > 0) {
                        $datos = [
                            'mensaje' => 'Ya posee un viaje en este rango de fecha y hora.',
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
        $mensaje = 'Viaje eliminado correctamente!';
        if ($viajeModelo->getCantidadPasajeroAceptados($id) != 0){
              //$usuarioModelo->restarPuntos($user_id,'1'); ESTE ME MUESTRA ERROR
              $mensaje = 'Viaje eliminado correctamente! El viaje tenia pasajeros anotados, se le descontara un punto';
          }
        $viajeModelo->eliminarViaje($id);
        $cantViajes = $viajeModelo->getCantidadViajes($user_id);
        $viajes = $viajeModelo->getViajes($user_id);
        $datos = ['mensaje' => $mensaje,
            'cantViajes' => $cantViajes,
            'viajes' => $viajes
        ];
        $this->view('userinterface/misviajes', $datos);

    }

    public function muro($id,$volver)
    {
        //Modelos con los cuales se va a trabajar
        $autoModelo = $this->model('Modeloauto');
        $viajeModelo = $this->model('Modeloviajes');
        $usuarioModelo = $this->model('Usuario');
        
        // id del usuario que estalogueado
        $user_id = $this->session->get('id');
        // id del viaje
        $viaje = $viajeModelo->getViaje($id);
        // auto aplicado al viaje
        $auto = $autoModelo->getAuto($viaje->auto_id);
        // conductor del viaje
        $conductor = $usuarioModelo->getById($viaje->conductor_id);
        // pasajeros postulada y no aceptada
        $postulantes = $viajeModelo->getPostulante($id);
        // pasajeros aceptados
        $pasajerosAprobados = $viajeModelo->getPasajeroAprobado($id);
        
        $datos = [  'mensaje'            => '',
                    'conductor'          => $conductor,
                    'auto'               => $auto, // Datos relacionados al auto 
                    'viaje'              => $viaje, // Datos del viaje
                    'postulantes'        => $postulantes, // Ver esto
                    'pasajerosAprobados' => $pasajerosAprobados,
                    'rol'=>     '', // conductor aceptado postulado publico rechazado
                    'estado'=>'', // 3 para conductor, 2 para rechazado, 1 para anotado, 0 para anotarse
                    'path'=>$volver // ver Esto
                    //cond 3
                    //acept 2
                    //
        ];
       
        if ($viaje->conductor_id == $user_id){
           $datos['rol'] = 'conductor';
           $datos['estado'] = '3';
           $datos['mensaje'] = 'Sos el creador de este viaje';

        }
        elseif ($viajeModelo->estaEnPasajero($id,$user_id)) {
            $pasajero = $viajeModelo->traerPasajero($id, $user_id);
            $estado = $pasajero->estado;
            if($estado == 1) {
                $datos['rol'] = 'pasajero';
                $datos['estado'] = '2';
                $datos['mensaje'] = 'Ya te han aceptado para este viaje';
            } else {
                $datos['rol'] = 'postulado';
                $datos['estado'] = '1';
                $datos['mensaje'] = 'Esperando Confirmacion del creador';
            }
           

            
           
        }
        else {
            $datos['rol'] = 'publico';
            $datos['estado'] = '0';
            $datos['mensaje'] = 'Puedes postularte a este viaje!!!';
        }


        $this->view('viaje/muro', $datos);
    }


    public function cancelarPostulante($idPostulante, $idViaje)
    { $viajeModelo = $this->model('Modeloviajes');
        $cancelar = $viajeModelo->rechazarPasajero($idViaje, $idPostulante);
        echo'<script language="javascript">window.location="'.RUTA_URL.'/viaje/muro/'.$idViaje.'"</script>;';
        /*header('Location:'.echo RUTA_URL;.'/viaje/muro/'.echo ($idViaje);); LA IDEA DE ESTO ES QUE ME REDIRIJA AL MURO PERO HAY ALGO QUE ME DA ERROR*/
        exit;
    }



    public function aceptarPostulante($idPostulante, $idViaje)
    { $viajeModelo = $this->model('Modeloviajes');
        $aceptar = $viajeModelo->aceptarPasajero($idViaje, $idPostulante);
        echo'<script language="javascript">window.location="'.RUTA_URL.'/viaje/muro/'.$idViaje.'"</script>;';
        /*header('Location:'.echo RUTA_URL;.'/viaje/muro/'.echo ($idViaje););*/
        exit;
    }


}

