<?php

namespace app\controllers;

use app\database\Database;
use app\facades\Auth;
use app\facades\ResponseStatus;
use app\facades\Json;
use app\models\Product;



class ProductController extends Controller{
    public function getProductsList(){
        $this->view("productList");
    }

    public function postProductsList(){
        $database = new Database();
        $sql = "SELECT * FROM products";
        $result = $database->executeMany($sql);

        echo json_encode($result);
    }

    public function show($data){
        if( !Auth::isLogged() ){
            ResponseStatus::code(404);
        }
        $id = $data[0]; //get first parameter from route, you can do var_dump( $data ) to see list parameters

        Json::response( Product::get($id) );
    }

}
