<?php

trait UserRoutesTrait{

    public function userRoutes(Router & $router){
        $router->add(
            'GET', 'resendTest', 'TestController', 'index'
        );
        $router->add(
            'GET', 'registerTest', 'TestController', 'index2'
        );

        $router->add(
            'GET', 'changePassword', 'ChangePasswordController', 'index'
        );
        $router->add(
            'POST', 'changePassword', 'ChangePasswordController', 'store'
        );

        $router->add(
            'GET', 'resetPassword', 'ResetPasswordController', 'index'
        );
        $router->add(
            'POST', 'resetPassword', 'ResetPasswordController', 'store'
        );

        $router->add(
            'GET', 'userOrders', 'OrderController', 'index'
        );

        $router->add(
            'GET', 'userAddress', 'AddressController', 'index'
        );

        $router->add(
            'GET', 'changeAddress', 'AddressController', 'test'
        );
        $router->add(
            'POST', 'changeAddress', 'AddressController', 'store'
        );
    }
}