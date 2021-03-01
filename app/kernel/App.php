<?php

require_once '../routes/Routes.php';

class App{

    public function __construct(){

        //Parse url to array in which are strings splitted by slashes
        $this->url = $this->parseUrl();
        
        //Get defined routes
        $route = new Routes();
        $router = $route->get();

        //Match client url with defined urls
        $controller = $router->routeMatch($this->url);
        require_once '../app/controllers/'.$controller[0].'.php';

        //run suitable controller and his method
        $controller_class = new $controller[0]();
        call_user_func( array($controller_class, $controller[1]) );
    }

    public function parseUrl(){
        if( isset($_GET['url']) ){
            return explode( '/', filter_var( rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL ) );
        }
    }
}