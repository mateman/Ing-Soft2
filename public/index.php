<?php


/**
 * Este es el punto de entrada de la aplicación.
 * 
 *  Se cargan las librerias necesarias para trabajar 
 *  y se instancia la clase Core, la cual es la encargada
 *  de direccionar las peticiones que llegan desde la url.
 * 
 */

require_once '../app/bootstrap.php';


$iniciar = new Core;
