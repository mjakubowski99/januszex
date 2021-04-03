<?php

namespace app\facades;

use app\config\JwtManage;

class Auth{

    public static function isLogged(): bool{
        $jwt = new JwtManage();
        return $jwt->tokenIsValid();
    }

    public static function email(): string{
        $jwt = new JwtManage();

        return $jwt->getEmailForToken();
    }

    public static function simulate($email){
        $jwt = new JwtManage();
        $_SERVER['HTTP_AUTHORIZATION'] = "Bearer ".$jwt->createToken($email);
    }
}