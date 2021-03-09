<?php

#Include database connection file
require_once '../app/database/Database.php';

class LoginController extends Controller{

	public function index(){
		$this->view("login");
	}

	public function store(){
		$database = new Database();

		$password = strip_tags($_REQUEST["password_textbox"]);
		$email = strip_tags($_REQUEST["email_textbox"]);

		if(empty($email)){
			$errorMsg = "Wprowadź adres email";
		} 
		else if(empty($password)){
			$errorMsg = "Wprowadź hasło";
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
			$query = "SELECT * FROM users WHERE email=:uemail";

			
			$row = $database->execute($query, [
				'uemail' => $email,
			]);

			if( !$row ){
				die("Nie ma takiego użytkownika");
			}
			else if( count($row) == 1 ){
				$loginMsg = "Logowanie poprawne...";
				$this->view("home", [ 
					'message' => $loginMsg
				]); #If password is correct, redirect to home
			}
			else{
				$errorMsg = "Wprowadzono niewłaściwe hasło lub adres email";
			}
		}
		
	}
}




