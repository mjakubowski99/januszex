<?php

trait ProductRoutesTrait{

    public function productRoutes(Router & $router){
        $router->add(
            'GET', 'products', 'ProductController', 'getProductsList'
        );

        $router->add(
            'POST', 'products', 'ProductController', 'postProductsList'
        );

        $router->add(
            'GET', 'products/{id}', 'ProductController', 'show'
        );
    }
}
