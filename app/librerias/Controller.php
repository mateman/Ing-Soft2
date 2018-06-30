<?php


class Controller {
    
    public function model($model) {
        
        require_once RUTA_APP.'/models/' . $model . '.php';
        return new $model();
    }
    public function view($view,$datos=[]) {

        if(file_exists( RUTA_APP.'/views/' . $view . '.php')) {
            
            require_once RUTA_APP.'/views/' . $view . '.php';
        
        } 
        else {
          
            die("la vista no existe!!");
       
        }
      
        
    }
}