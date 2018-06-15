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
        $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        $cantAutos = $usuarioModelo->getCantidadAutos($user_id);

        if ($cantAutos == 0) {
            $datos = [
                'mensaje' => 'Usted no posee autos, no puede crearviaje'
            ];

            $this->view('userinterface/misviajes', $datos);
        } else {
            $autos = $usuarioModelo->getAutos($user_id);
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
        $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        $autos = $usuarioModelo->getAutos($user_id);
        $cantAutos = $usuarioModelo->getCantidadAutos($user_id);
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

                $datos = ['mensaje' => 'Viaje creado correctamente!'];

                $this->view('userinterface/misviajes', $datos);
            } else {
                $autos = $usuarioModelo->getAutos($user_id);
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
            $autos = $usuarioModelo->getAutos($user_id);
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
        $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        $autos = $usuarioModelo->getAutos($user_id);
        $cantAutos = $usuarioModelo->getCantidadAutos($user_id);
        $viajeModelo = $this->model('Modeloviajes');
        $viaje = $viajeModelo->getViaje($id);
        $origen = $viaje->origen;
        $destino = $viaje->destino;
        $horallegada = $viaje->horallegada;
        $horasalida = $viaje->horasalida;
        $costo = $viaje->costo;
        $auto_id = $viaje->auto_id;
        $descripcion = $viaje->descripcion;
        $datos = [
            'mensaje' => '',
            'origen' => $origen,
            'destino' => $destino,
            'fechayhorallegada' => $horallegada,
            'fechayhorasalida' => $horasalida,
            'costo' => $costo,
            'autodelviaje' => $auto_id,
            'descripcion' => $descripcion,
            'autos' => $autos,
            'cantAutos' => $cantAutos,
            'id' => $id
        ];

        $this->view('viaje/modificarviaje', $datos);

    }


        public function viajeModificar($id)
    {
        $usuarioModelo = $this->model('Usuario');
        $user_id = $this->session->get('id');
        $autos = $usuarioModelo->getAutos($user_id);
        $cantAutos = $usuarioModelo->getCantidadAutos($user_id);
        $viajeModelo = $this->model('Modeloviajes');

        if ($viajeModelo->viajeLibre($id) > 0) {
            if (!(empty($_POST['origen'])) and !(empty($_POST['destino'])) and !(empty($_POST['fechayhorallegada'])) and !(empty($_POST['fechayhorasalida'])) and !(empty($_POST['costo'])) and !(empty($_POST['autodelviaje']))) {
                $fecha_actual = strtotime(date("d-m-Y H:i", time()));
                $origen = $_POST['origen'];
                $destino = $_POST['destino'];
                $fechayhorallegada = $_POST['fechayhorallegada'];
                $fechayhorasalida = $_POST['fechayhorasalida'];
                $costo = $_POST['costo'];
                $autodelviaje = $_POST['autodelviaje'];
                $descripcion = $_POST['descripcion'];

                if (($fecha_actual < $fechayhorallegada) AND ($fecha_actual < $fechayhorasalida) AND ($fechayhorasalida < $fechayhorallegada)) {
                    $autoEnUso = $viajeModelo->autoEnUso($autodelviaje, $fechayhorasalida, $fechayhorallegada);
                    if ($autoEnUso > 0) {
                        $datos = [
                            'mensaje' => 'El auto seleccionado esta en uso para el horario del viaje.',
                            'origen' => $origen,
                            'destino' => $destino,
                            'fechayhorallegada' => $fechayhorallegada,
                            'fechayhorasalida' => $fechayhorasalida,
                            'costo' => $costo,
                            'autodelviaje' => $autodelviaje,
                            'descripcion' => $descripcion,
                            'autos' => $autos,
                            'cantAutos' => $cantAutos,
                            'id' => $id
                        ];

                        $this->view('viaje/modificarviaje', $datos);
                        exit();
                    }

                    $modificarviaje = $viajeModelo->viajeModificar($descripcion, $origen, $destino, $fechayhorallegada, $fechayhorasalida, $costo, $autodelviaje, $user_id, $id);

                    $datos = ['mensaje' => 'Viaje modificado correctamente!'];

                    $this->view('userinterface/misviajes', $datos);
                } else {
                    $autos = $usuarioModelo->getAutos($user_id);
                    $datos = [
                        'mensaje' => 'Debe poner fechas futuras!',
                        'origen' => $origen,
                        'destino' => $destino,
                        'fechayhorallegada' => $fechayhorallegada,
                        'fechayhorasalida' => $fechayhorasalida,
                        'costo' => $costo,
                        'autodelviaje' => $autodelviaje,
                        'descripcion' => $descripcion,
                        'autos' => $autos,
                        'cantAutos' => $cantAutos,
                        'id' => $id
                    ];

                    $this->view('viaje/modificarviaje', $datos);
                    exit();

                }
            } else {
                $autos = $usuarioModelo->getAutos($user_id);
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


    public function viajeEliminar($id)
    {
        $user_id = $this->session->get('id');
        $viajeModelo = $this->model('Modeloviajes');

        if (0 != $viajeModelo->viajeLibre($id)){
          if ($viajeModelo->getCantidadPasajero(id) == 0){
              
          }

        }
        $viajeModelo->eliminarViaje($id);
    }


}