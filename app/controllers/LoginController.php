<?php

#Include database connection file
require_once '../app/database/Database.php';
require_once '../app/validators/LoginValidator.php';
require_once '../app/resource/UserResource.php';

class LoginController extends Controller{

	public function index(){
		$this->view("login");
	}

	public function store(){
		
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
			$resource = new UserResource();
			echo $resource->createHelloMessageForEmail('Witaj', $email);
		}
		else{
			echo json_encode([
				'message' => $message
			]);
		} 
		
	}
	
}




