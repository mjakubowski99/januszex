<?php

#Include database connection file
require_once '../app/database/Database.php';
require_once '../app/validators/LoginValidator.php';
require_once '../app/resource/UserResource.php';
require_once '../app/config/JwtManage.php';

class LoginController extends Controller{

	public function index(){
		$jwt = new JwtManage();
		if( $jwt->tokenIsValid() ){
			echo json_encode([
				'message' => 'Zalogowany'
			]);
		}
		else{
			$this->view("login");
		}
	}

	public function store(){
		$jwt = new JwtManage();
		if( $jwt->tokenIsValid() ){
			echo json_encode([
				'message' => 'Zalogowany'
			]);
			die();
		}
		
		$database = new Database();
		$validator = new LoginValidator();

		$password = strip_tags($_POST["password"]);
		$email = strip_tags($_POST["email"]);

		//credentials validation
		$message = $validator->validate([
			'email' => $email, 
			'password' => $password,
		]);


		//If logowanie poprawne return User
		if( $message == "Logowanie poprawne" ){
			
			$token = $jwt->createToken($email);
			echo json_encode([
				'jwt_token' => $token
			]); 
		}
		else{
			echo json_encode([
				'message' => $message
			]);
		} 
		
	}
	
}




