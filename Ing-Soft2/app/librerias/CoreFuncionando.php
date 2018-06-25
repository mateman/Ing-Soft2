<?php

class Core {
   
    protected $currentController = 'current';
    protected $currentMethod = 'index';
    protected $parametros = [];
    

    public function __construct() {
        $url = $this->getUrl();
        $route = '../app/controllers/'.ucwords($url[0]).'.php';
       if(file_exists($route)) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
    
        $file = '../app/controllers/'. $this->currentController . '.php';
        require_once $file;
       $this->currentController = new $this->currentController;
       if (isset($url[1])) {
            
            if(method_exists($this->currentController,$url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

       $this->parametros= $url ? array_values($url) : [];
       call_user_func_array([$this->currentController, $this->currentMethod], $this->parametros);
    }
    public function getUrl() {
        $url = [$this->currentController];
        if( isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            
        } 
        return $url;
    }
}