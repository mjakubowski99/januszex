<?php


namespace app\controllers;

use app\facades\Auth;
use app\validators\RegisterValidator;
use app\facades\Filters;
use app\config\Mail;
use app\traits\GeneratePasswordForUser;
use app\models\User;
use app\config\JwtManage;

class ResetPasswordController extends Controller
{
    use GeneratePasswordForUser;

    public function index(){
        //Auth::simulate('user@example.com');

        $jwt = new JwtManage('user');
        $jwt->tokenIsValid();

        $this->view('resetPassword');
    }

    public function store(){
        //Auth::simulate('user@example.com');

        if( Auth::isLogged() ){
            echo json_encode(['message'=>'You cannot be logged to change password']);
            die();
        }

        $validator = new RegisterValidator();
        Filters::stripTags($_POST);
        $email = $_POST['email'];

        if( $validator->userExists($email) ){
            $mailer = new Mail();
            $password = $this->generateRandomPassword();
            $message = 'Twoje nowe haslo to: '.$password.' mozesz je zmienic w panelu konta klienta';

            $password = password_hash($password, PASSWORD_DEFAULT);

            User::update( ['password' => $password], ['email' => $email] );
            $mailer->tryToSendMailTo($email, $message);
        }
        else
            echo json_encode(['message' => 'This user not exist']);
    }
}