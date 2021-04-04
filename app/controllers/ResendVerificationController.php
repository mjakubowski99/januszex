<?php

namespace app\controllers;

use app\config\Mail;
use app\config\VerifyToken;
use app\filters\VerifyTokenSanitize;
use app\facades\Auth;
use app\facades\ResponseStatus;

class ResendVerificationController extends Controller{

    public function __construct(){
        $this->sanitizator = new VerifyTokenSanitize();
        $this->verify = new VerifyToken();
    }

    public function index(){
		if( Auth::isLogged())
        	$this->view('resendVerification');
		else
			echo \json_encode(['message' => 'Zaloguj sie']);
    }

    public function store(){
		$email = Auth::email();

		if( $email === null )
			ResponseStatus::code(404 );

		if( !$this->verify->userVerified($email) ){
			$token = $this->verify->createToken($email);
			$mail = new Mail();
			$mail->tryToSendMailTo($email, $token);
            echo \json_encode(['message' => 'Kod zostal wyslany']);
		}
		else{
			echo \json_encode(['message' => 'Uzytkownik zweryfikowany lub inny blad']);
		}
	}

}