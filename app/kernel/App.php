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
        $params = $router->routeMatch($this->url);
        $controller = $params[0];
        $method = $params[1];
        $args = $params[2];

        require_once '../app/controllers/'.$controller.'.php';

        //run suitable controller and his method
        $controller_class = new $controller();

        if( count($args) === 0 )
            call_user_func( array($controller_class, $method) );
        else
            call_user_func_array( array($controller_class, $method), array($args) );
    }

    public function parseUrl(){
        if( isset($_GET['url']) ){
            return explode( '/', filter_var( rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL ) );
        }
    }
}