<?php


class Buscador extends Controller {

        public function buscador (){
  

       $this->view('buscador/buscador');  
    }
     public function busqueda (){

     $buscadorModelo = $this->model('ModeloBuscador');

  if (!(empty($_POST['origen'])) and !(empty($_POST['destino'])) and !(empty($_POST['salidadesde'])) and !(empty($_POST['salidahasta'])) and !(empty($_POST['llegadadesde'])) and !(empty($_POST['llegadahasta']))) {

     $busqueda = $buscadorModelo->userUpdate( $_POST['email'], $_POST['provincia'],
                                                   $_POST['apellido'], $_POST['telefono'],
                                                   $_POST['nombre'], $_POST['ciudad'],
                                                   $this->session->get('id'));

      echo "hola mundo";  
    }
    }

