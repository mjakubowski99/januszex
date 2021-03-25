<?php

namespace app\controllers;

use app\database\Database;
use app\config\Mail;
use app\config\VerifyToken;
use app\validators\VerifyTokenValidator;
use app\filters\VerifyTokenSanitize;
use app\facades\Auth;

class RegisterVerifyController extends Controller{

	private $validator;

	public function __construct(){
		$this->validator = new VerifyTokenValidator();
		$this->sanitizator = new VerifyTokenSanitize();
		$this->tokenVerifier = new VerifyToken();  
	}

	public function index(){
		if( !Auth::isLogged() ){
			echo \json_encode([ 'message' => 'Zaloguj sie']);
			die();
		}

		$this->view('registerVerify');
	}

	public function store(){
		if( !Auth::isLogged() ){
			echo \json_encode([ 'message' => 'Zaloguj sie']);
			die();
		}

		$token = $this->sanitizator->sanitize( $_POST['token'] ); //sanitize input data
		if( !$this->validator->validate($token) ){                //token data validation 
			echo \json_encode([ 'message' => 'Error']);
			die();
		}
		                   
		if( $this->tokenVerifier->verifyUserForToken($token) )    //token verification
			echo \json_encode(['message' => 'Successful']);
		else
			echo \json_encode([ 'message' => 'Token jest nieprawidlowy lub wygasl']);
	}
	
}
