<?php 

require_once '../app/kernel/Router.php';

require_once 'groups/AuthRoutesTrait.php';
require_once 'groups/UserRoutesTrait.php';
require_once 'groups/AdminRoutesTrait.php';
require_once 'groups/ProductRoutesTrait.php';

class Routes{

    use AuthRoutesTrait, UserRoutesTrait, AdminRoutesTrait, ProductRoutesTrait;

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

        $this->authRoutes($router);
        $this->userRoutes($router);
        $this->adminRoutes($router);
        $this->productRoutes($router);

        $router->add('GET', 'init/order', 'PaymentController', 'index');
        $router->add('POST', 'payu/create/order', 'PaymentController', 'create');
        $router->add('POST', 'order/notify', 'PaymentController', 'notify');
        $router->add('GET', 'order/retrieve', 'OrderController', 'retrieve');
        $router->add('GET', 'last_order/retrieve', 'OrderController', 'lastOrder');
        $router->add('POST', 'account/orderdetails', 'OrderController', 'showDetails');

        $this->router = $router;
    }

    public function get(){
        return $this->router;
    }
}

