<?php
    
/**
 * Se cargan archivos necesarios para la configuración de la aplicación
 * En caso de querer implementar alguna libreria, debería colocar el archivo
 * en la carpeta libreria y se cargara automaticamente en la aplicación.
 * 
 * El archivo config.php es el encargado de definir constantes de la aplicación y 
 * de configuración de la base de datos.
 */
    
require_once 'config/config.php';

spl_autoload_register(function($nombre_clase) {
    require_once 'librerias/' . $nombre_clase . '.php';
});