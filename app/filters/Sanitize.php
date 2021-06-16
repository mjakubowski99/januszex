<?php

namespace app\filters;

class Sanitize{
    
    public function sanitize($data){
        foreach( $data as $key => $value ){
            $data[$key] = strip_tags($value);
        }

        return $data;
    }
}