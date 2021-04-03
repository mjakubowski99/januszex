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
        
        $router->add('GET', 'login', 'LoginController', 'index');
        $router->add('POST', 'login', 'LoginController', 'store');

        $router->add('GET', 'register', 'RegisterController', 'index');
        $router->add('POST', 'register', 'RegisterController', 'store');

        //$router->add('GET', 'test/{test}', 'LoginController', 'test');
        $router->add('GET', 'registerVerify', 'RegisterVerifyController', 'index');
        $router->add('POST', 'registerVerify', 'RegisterVerifyController', 'store');

        $router->add('GET', 'resendVerification', 'ResendVerificationController', 'index');
        $router->add('POST', 'resendVerification', 'ResendVerificationController', 'store');

        $router->add('GET', 'resendTest', 'TestController', 'index');
        $router->add('GET', 'registerTest', 'TestController', 'index2');

        $router->add('GET', 'changePassword', 'ChangePasswordController', 'index');
        $router->add('POST', 'changePassword', 'ChangePasswordController', 'store');
        $router->add('GET', 'test', 'ChangePasswordController', 'test');
        $this->router = $router;
    }

    public function get(){
        return $this->router;
    }
}

