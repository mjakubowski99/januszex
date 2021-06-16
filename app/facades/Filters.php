<?php


namespace app\facades;


class Filters
{
    public static function stripTags( & $data ){
        foreach( $data as $key => $value ){
            $data[$key] = strip_tags($value);
        }
    }
}