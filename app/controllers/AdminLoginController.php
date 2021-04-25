<?php


namespace app\controllers;


use app\config\JwtManage;
use app\database\Database;
use app\facades\AdminAuth;
use app\validators\AdminLoginValidator;

class AdminLoginController extends Controller
{
    public function index(){
        //AdminAuth::simulate('user10@example.com');

        $jwt = new JwtManage('admin');
        if( $jwt->tokenIsValid() ){
            echo json_encode([
                'message' => 'Zalogowany'
            ]);
        }
        else{
            $this->view("adminLogin");
        }
    }

    public function store(){
        if( AdminAuth::isLogged() ){
            echo \json_encode([ 'message' => 'Jestes juz zalogowany']);
            die();
        }

        $validator = new AdminLoginValidator();
        $jwt = new JwtManage('admin');

        $password = strip_tags($_POST["password"]);
        $name = strip_tags($_POST["name"]);
        $secret = strip_tags($_POST["secret"] );


        //credentials validation
        $message = $validator->validate([
            'name' => $name,
            'password' => $password,
            'secret' => $secret,
        ]);


        //If logowanie poprawne return User
        if( $message ){
            $token = $jwt->createToken($name);

            //$this->view('logged', [ 'jwt_token' => $token ]);
            echo json_encode([
                'jwt_token' => $token
            ]);
        }
        else{
            echo json_encode([
                'message' => 'Logowanie niepoprawne'
            ]);
        }

    }
}