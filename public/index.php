<?php

try{
    require_once '../app/kernel/initialize.php';

    header("Access-Control-Allow-Origin: *");

    //Create instance of App

    $app = new App(); 
}
catch(Throwable $e){
    echo json_encode([
        'message' => $e->getMessage()
    ]);
}

