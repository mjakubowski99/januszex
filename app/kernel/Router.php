<?php 

class Router{

    protected $routes = [];
    protected $params = [];
    
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
            echo json_encode([
                'message' => "Developer passed invalid HTTP method!"
            ]);
            die();
        }
    }

    public function splitRoutePattern($route){
        return explode('/', rtrim($route, '/'));
    }

    public function checkIfValueIsParam($r){
        $size = strlen($r);

        if( $size < 3 )   //string size must be at least 3 for example {a} is valid param, {} this is not param
            return false;
        if( $r[0] === '{' && $r[ $size -1 ] === '}' )  //check if first and last value to match pattern 
            return true;

        return false;
    }

    public function addParam($value){
        array_push(
            $this->params, 
            $value
        );
    }

    public function matchRoutesLoop( &$route, &$url){
        if( count($route) !== count($url) )
            return false;

        $i=0;
        while( $i < count($route) ){
            $is_param = $this->checkIfValueIsParam($route[$i]);
    
            if( $is_param ){
                $this->addParam( $url[$i] );
                $i++;
            }
            else if( strlen($url[$i]) !== 0 && $route[$i] === $url[$i] )
                $i++;
            else 
                return false;
        }

        return true;
    }


    /*function matching route with url
     *
     */

    public function routeMatch($url_array){
        if( $url_array == NULL ){
            echo json_encode([
                'message' => 'Welcome page'
            ]);
            die();
        }
        else{
            foreach( $this->routes as $route ){
                $routeParts = $this->splitRoutePattern($route['url']);
                if( $this->matchRoutesLoop($routeParts, $url_array) ){
                    if( $_SERVER['REQUEST_METHOD'] == $route['method'] )
                        return [ $route['controller'], $route['controller_method'], $this->params ];
                }
            }
            
            echo json_encode([
                'message' => "Error! We doesn't support this type of request for this route!"
            ]);
        }

    }
}