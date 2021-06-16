<?php

trait AdminRoutesTrait{

    public function adminRoutes(Router & $router){
        $router->add(
            'GET', 'admin/customers', 'AdminController', 'getAccountList'
        );
        $router->add(
            'POST', 'admin/customers', 'AdminController', 'postAccountList'
        );

        $router->add(
            'GET', 'admin/errors', 'AdminController', 'getErrorList'
        );
        $router->add(
            'POST', 'admin/errors', 'AdminController', 'postErrorList'
        );

        $router->add(
            'GET', 'admin/orderdetails', 'AdminController', 'getOrderDetails'
        );
        $router->add(
            'POST', 'admin/orderdetails', 'AdminController', 'postOrderDetails'
        );

        $router->add(
            'GET', 'admin/orders', 'AdminController', 'getOrdersList'
        );
        $router->add(
            'POST', 'admin/orders', 'AdminController', 'postOrdersList'
        );

        $router->add(
            'GET', 'admin/products', 'AdminController', 'getProductOperation'
        );
        $router->add(
            'POST', 'admin/products', 'AdminController', 'postProductOperation'
        );

        //$router->add('POST', 'admin/deleteCustomer', 'AdminController', 'postDeleteCustomer');
        $router->add(
            'GET', 'admin/login', 'AdminLoginController', 'index'
        );
        $router->add(
            'POST', 'admin/login', 'AdminLoginController', 'store'
        );
    }
}