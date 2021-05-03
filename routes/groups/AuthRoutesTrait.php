<?php

trait AuthRoutesTrait{

    public function authRoutes(Router & $router){
        $router->add(
            'GET', 'login', 'LoginController', 'index'
        );
        $router->add(
            'POST', 'login', 'LoginController', 'store'
        );

        $router->add(
            'GET', 'register', 'RegisterController', 'index'
        );
        $router->add(
            'POST', 'register', 'RegisterController', 'store'
        );

        //$router->add('GET', 'test/{test}', 'LoginController', 'test');
        $router->add(
            'GET', 'registerVerify', 'RegisterVerifyController', 'index'
        );
        $router->add(
            'POST', 'registerVerify', 'RegisterVerifyController', 'store'
        );
    }
}
