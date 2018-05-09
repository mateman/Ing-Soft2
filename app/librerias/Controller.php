<?php


class Controller {
    
    public function model($model) {
        
        require_once '../app/model' . $modelo . '.php';
        return new $modelo();
    }
    public function view($view,$datos=[]) {

        if(file_exists('../app/views/' . $view . '.php')) {
            
            require_once '../app/views/' . $view . '.php'; 
        
        } 
        else {
          
            die("la vista no existe!!");
       
        }
      
        
    }
}