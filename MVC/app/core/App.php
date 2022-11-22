<?php

class App{

    private $controller = "Home";
    private $method = "index";

    function split_url(){ // split the url and get as an array
    
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/",trim($URL,'/'));
        return $URL;
    
    }

    public function loadController(){
        $URL = $this->split_url();

        $fileName = "../app/controllers/".ucfirst($URL[0]).".php";
    
        if(file_exists($fileName)){
            require $fileName;
            $this->controller =ucfirst($URL[0]); 
            unset($URL[0]);

        }else {
            $fileName = "../app/controllers/_404.php";
            require $fileName;
            $this->controller = "_404"; 
        }

        $controller = new $this->controller;// create the object of the find controller

        // select a method
        
        if(!empty($URL[1])){

            if(method_exists($controller,$URL[1])){
                $this->method = $URL[1];
                unset($URL[1]);
            }

        }

        show($URL);
        call_user_func_array([$controller,$this->method],[$URL]);
    }

}
