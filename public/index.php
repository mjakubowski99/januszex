<?php

try{
    require_once '../app/kernel/initialize.php';
    require_once '../autoloader.php';

    require_once '../vendor/autoload.php';
    require_once '../app/config/PayuConfig.php';

    if( isset( getallheaders()['Content-Type'] )
        && getallheaders()['Content-Type'] === 'application/json'
    ){
        $json = json_decode( file_get_contents('php://input') );
    }

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    //Create instance of App

    $app = new App(); 
}
catch(Throwable $e){
    echo json_encode([
        'message' => $e->getMessage()
    ]);
}

