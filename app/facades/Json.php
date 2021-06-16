<?php


namespace app\facades;


class Json
{
    public static function receive(){
        $json = null;
        if( isset( getallheaders()['Content-Type'] )
            && getallheaders()['Content-Type'] === 'application/json'
        ){
            $json = json_decode( file_get_contents('php://input') );
        }

        return $json;
    }

    public static function response(array $message){
        header("Content-Type: application/json");
        echo json_encode($message);
    }
}