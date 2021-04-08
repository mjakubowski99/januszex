<?php

namespace app\controllers;

use app\facades\Auth;
use app\facades\ResponseStatus;
use app\facades\Filters;
use app\validators\ChangePasswordValidator;
use app\models\User;
use app\facades\Simulate;

class ChangePasswordController extends Controller{

    public function index(){
        //Auth::simulate('user@example.com');

        if( Auth::isLogged() ){
            $this->view('changePassword');
        }
        else{
            ResponseStatus::code(401);
            echo json_encode([ 'message' => 'Zaloguj sie']);
        }
    }

    public function store(){
        //Auth::simulate('user@example.com');

        if( !Auth::isLogged() )
            ResponseStatus::code(401, 'My message');

        Filters::stripTags($_POST);
        $validator = new ChangePasswordValidator();

        if( $validator->validate($_POST) ){
            $email = Auth::email();
            $password = password_hash( $_POST['new-password'], PASSWORD_DEFAULT);

            User::update( ['password' => $password], ['email' => $email] );
            echo json_encode(['message' => 'Successful change']);
        }
        else
            echo json_encode( $validator->getMessage() );
    }

    public function test(){

    }

}
