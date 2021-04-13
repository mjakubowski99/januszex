<?php

namespace app\controllers;

use app\database\Database;

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

}
