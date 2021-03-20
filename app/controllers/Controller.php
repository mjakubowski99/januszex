<?php 

namespace app\controllers;

class Controller{ 
    
    public function view($view, $data = []){
        require_once '../views/'.$view.'.php';
    }

    public function model($model){
        $model = '\\app\\models\\'.$model;
        return new $model();
    }

    public function database(){
        
    }
}