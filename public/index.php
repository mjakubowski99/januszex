<?php

try{
    require_once '../app/kernel/initialize.php';

    //Create instance of App

    $app = new App(); 
}
catch(Throwable $e){
    echo $e->getMessage();
}

