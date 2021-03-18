<?php

#Include database connection file
require_once '../app/validators/RegisterValidator.php';
require_once '../app/config/DatabaseConnector.php';
require_once '../app/config/Mail.php';
require_once '../app/config/VerifyToken.php';

class RegisterController extends Controller{

	public function index(){
		$this->view('register');
	}

	public function store(){

		$validator = new RegisterValidator();

		//Sanitization and validation register data
		$message = $validator->validate($_POST);

		if( $message !== true ){
			echo json_encode([
				'error_message' => $message
			]);
			die();
		}

		try{

			$db_conn = new DatabaseConnector();
			$connection = $db_conn->getConnection();

			$email = strip_tags($_POST['email']);
			$password = strip_tags($_POST['password']);
			$name = strip_tags($_POST['name']);
			$surname = strip_tags($_POST['surname']);
			$city = strip_tags($_POST['city']);
			$street = strip_tags($_POST['street']);
			$home_number = strip_tags($_POST['home_number']);
			$flat_number = strip_tags($_POST['flat_number']);
			$postoffice_name = strip_tags($_POST['postoffice_name']);
			$postoffice_code = strip_tags($_POST['postoffice_code']);
				
			$hash_password = password_hash($password, PASSWORD_DEFAULT); #Create hash on given password
				
				#Prepare SQL statement to insert data about the address to database
				$insert_stmt = $connection->prepare("INSERT INTO address (id, city, street, home_number, flat_number, postoffice_name, postoffice_code)
													VALUES (0, :ucity, :ustreet, :uhome_number, :uflat_number, :upostoffice_name, :upostoffice_code)");
													
				#Execution of SQL statement
				if($insert_stmt->execute(array(':ucity'=>$city,		
											  ':ustreet'=>$street,
											  ':uhome_number'=>$home_number,
											  ':uflat_number'=>$flat_number,
											  ':upostoffice_name'=>$postoffice_name,
											  ':upostoffice_code'=>$postoffice_code))){						  
				
					#Prepare and execution SQL statement to insert data into address table in database
					$select_address_id = $connection->prepare("SELECT id FROM address WHERE city=:ucity AND street = :ustreet AND home_number=:uhome_number AND flat_number=:uflat_number 
														   AND postoffice_name=:upostoffice_name AND postoffice_code=:upostoffice_code");
					$select_address_id->execute(array(':ucity'=>$city,
													  ':ustreet'=>$street,
													  ':uhome_number'=>$home_number,
													  ':uflat_number'=>$flat_number,
													  ':upostoffice_name'=>$postoffice_name,
													  ':upostoffice_code'=>$postoffice_code));
						
					#Save address_id to variable
					$address_id = $select_address_id->fetch(PDO::FETCH_ASSOC);
				
					#Prepare SQL statement to insert data to users table
					$insert_stmt = $connection->prepare("INSERT INTO users (id, name, surname, email, password, verified, address_id) 
														VALUES (0, :uname, :usurname, :uemail, :upassword, 0, :uaddress_id)");
									
					#Execution of SQL statement						
					if($insert_stmt->execute(array( ':uname'=>$name,
													':usurname'=>$surname,
													':uemail'=>$email,
													'upassword'=>$hash_password,
													'uaddress_id'=>$address_id["id"]))){

						$verify = new VerifyToken();
						$token = $verify->createToken($email);
						$mail = new Mail();
						$mail->tryToSendMailTo($email, $token);

						//here we send mail 
						echo json_encode([ 
							'message' => "Rejestracja powiodla sie. Sprawdz podany adres e-mail w celu aktywacji konta" 
						]);
					}
					else{
						echo json_encode([ 
							'message' => "Nieoczekiwany błąd. Przejdź do formularza zgłaszania błędów"
						]);
					}
				}
				else{
					echo json_encode([
						'message' => "Nieoczekiwany błąd. Przejdź do formularza zgłaszania błędów"
					]);
				}
				
		}
		catch(PDOException $e){
			echo json_encode([
				'message' => "Błąd połaczenia"
			]);
		}


	}

}


