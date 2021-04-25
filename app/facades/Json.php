<?php


namespace app\facades;


class Json
{
    public static function response($message){
        header("Content-Type: application/json");
        echo json_encode($message);
    }
}