<?php

namespace app\validators;

use app\database\Database;

class VerifyTokenValidator{

    public function lengthValid($token){
        return strlen($token) <= 100;
    }

    public function validate($token){
        return $this->lengthValid($token);
    }

}