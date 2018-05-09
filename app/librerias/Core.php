<?php

/**
 * Archivo encargado de gestionar las rutas de la aplicación.
 * Este archivo no debería ser modificado.
 * El constructor instancia cuatro mètodos que realizan la tarea
 * de ir deconstruyendo la url. para luego instanciar el controlador 
 * requerido, con el respectivo método y parámetros.
 * 
 * Ejemplo : Petición get migranapp.com/usuario/update/2
 * 
 * getUrl:        Convierte en array la url tomando como separador "/"
 *                array(3) {
 *                [0]=>string(6) "usuario"
 *                [1]=>string(5) "update"
 *                [2]=>string(6) "2"}
 *                asignando  el resultado en la propiedad url
 * 
 * getController: Se quedarà con el dato que se encuentra en 
 *                array[0] el cual corresponde al controlador
 *                y lo asignará a la propiedad current_controller.
 *                Por último se crea una instancia del controlador
 *                correpondiente
 *                
 * getMethod:     Se quedarà con el dato que se encuentra en 
 *                array[1] el cual corresponde al método del controlador
 *                y lo asignará a la propiedad current_method
 * 
 * getParameters: Se quedará con el/los datos que se encuentren en 
 *                array[2] , array[3], etc los cuales corresponden 
 *                a los parametros a pasar al método y los asignará
 *                a la propiedad parametros
 * 
 * Por último se llamará al método que corresponda y en caso de existir
 * se enviarán los parametros requeridos.
 */

class Core {
   
    protected $current_controller = 'current';
    protected $current_method = 'index';
    protected $parameters = [];
    protected $url = [];
    
    public function __construct() {
        
        $this->getUrl();
        $this->getController();
        $this->getMethod();
        $this->getParameters();
        call_user_func_array([  $this->current_controller, $this->current_method], 
                                $this->parameters);
    }

    public function getUrl() {
        
        $url = [$this->current_controller];
        if( isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
        } 
        $this->url = $url;
    }

    public function getController() {
        
        $route = '../app/controllers/'.ucwords($this->url[0]).'.php';
        if(file_exists($route)) {
             $this->current_controller = ucwords($this->url[0]);
             unset($this->url[0]);
        }
        $file = '../app/controllers/'. $this->current_controller . '.php';
        require_once $file;
        $this->current_controller = new $this->current_controller;
    }

    public function getMethod() {
        
        if (isset($this->url[1])) {
            if(method_exists($this->current_controller,$this->url[1])){
                $this->current_method = $this->url[1];
                unset($this->url[1]);
            }
        }
    }

    public function getParameters() {
        
        $this->parameters= $this->url ? array_values($this->url) : [];
    }



}