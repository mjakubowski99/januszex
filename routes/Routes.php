<?php 

require_once '../app/kernel/Router.php';

class Routes{

    protected $router;

    /* Here we add routes
    * Params of add method: $http_method, $url_name, 
    *                       $controller_name, $controller_method
    * Example add('GET', 'profile', 'ProfileController', 'index')
    */
    
    public function __construct(){
        $router = new Router();

        $router->add('GET', 'home', 'HomeController', 'index');
        $router->add('POST', 'store', 'HomeController', 'store');

        $this->router = $router;
    }

    public function get(){
        return $this->router;
    }
}

