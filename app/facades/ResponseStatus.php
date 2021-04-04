<?php


namespace app\facades;

class ResponseStatus
{
    public static function code($code){
        http_response_code($code);
        if( $code >= 400 ) {
            die();
        }
    }
}