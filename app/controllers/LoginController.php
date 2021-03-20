<?php

namespace app\controllers;
#Include database connection file

use app\validators\LoginValidator;
use app\database\Database;
use app\resource\UserResource;
use app\config\JwtManage;

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
		
		$validator = new LoginValidator();
		$database = new Database();

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

	public function test($data){
		var_dump($data);
	}
	
}




