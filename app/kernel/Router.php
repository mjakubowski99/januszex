<?php 

class Router{

    protected $routes = [];
    
    /*function adding route to routes array
     *
     */
    public function add($http_method, $url_name, $controller_name, $controller_method){

        $valid_methods = ['GET', 'POST', 'PUT', 'DELETE'];
        
        if( in_array($http_method, $valid_methods) ){
            array_push(
                $this->routes, [
                    'method' => $http_method,
                    'url' => $url_name,
                    'controller' => $controller_name,
                    'controller_method' => $controller_method,
                ]
            );
        }
        else{
            die("You passed invalid HTTP method!");
        }
    }


    /*function matching route with url
     *
     */

    public function routeMatch($url_array){
        if( $url_array == NULL ){
            echo "Welcome page";
            die();
        }
        else if( count($url_array) == 1 ){
            foreach( $this->routes as $route ){
                if( $route['url'] == $url_array[0] ){
                    if( $_SERVER['REQUEST_METHOD'] == $route['method'] )
                        return [ $route['controller'], $route['controller_method'] ];
                    else 
                        die("Error! We doesn't support this type of request for this route!");  
                }
            }
        }

    }
}