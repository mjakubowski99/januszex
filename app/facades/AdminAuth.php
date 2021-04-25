<?php


namespace app\facades;


use app\config\JwtManage;

class AdminAuth{

    public static function isLogged(): bool{
        $jwt = new JwtManage('admin');
        return $jwt->tokenIsValid();
    }

    public static function email(){
        $jwt = new JwtManage('admin');

        return $jwt->getEmailForToken();
    }

    public static function simulate($email){
        $jwt = new JwtManage('admin');
        $_SERVER['HTTP_AUTHORIZATION'] = "Bearer ".$jwt->createToken($email);
    }

    public static function unsimulate(){
        $_SERVER['HTTP_AUTHORIZATION'] = "";
    }
}