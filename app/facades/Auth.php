<?php

namespace app\facades;

use app\config\JwtManage;

class Auth{

    public static function isLogged(){
        $jwt = new JwtManage();
        return $jwt->tokenIsValid();
    }

    public static function email(){
        $jwt = new JwtManage();
        $email = $jwt->getEmailForToken();

        return $email;
    }
}