<?php

require_once "ConnectionController.php";


if(isset($_REQUEST['btn_register'])){
	$email = strip_tags($_REQUEST['txt_email']);
	$password = strip_tags($_REQUEST['txt_password']);
	$name = strip_tags($_REQUEST['txt_name']);
	$surname = strip_tags($_REQUEST['txt_surname']);
	$city = strip_tags($_REQUEST['txt_city']);
	$street = strip_tags($_REQUEST['txt_street']);
	$home_number = strip_tags($_REQUEST['txt_home_number']);
	$flat_number = strip_tags($_REQUEST['txt_flat_number']);
	$postoffice_name = strip_tags($_REQUEST['txt_postoffice_name']);
	$postoffice_code = strip_tags($_REQUEST['txt_postoffice_code']);
	
	#Checking if key fields were filled
	if(empty($name) || empty($surname) || empty($email) || empty($password) || empty($city) || empty($street) ||
		empty($home_number) || empty($postoffice_name) || empty($postoffice_code)){
		$errorMsg[] = "Wypełnij wszystkie wymagane pola";
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ #Checking the correctness of the email
		$errorMsg[] = "Wprowadź poprawny adres e-mail";
	}
	else if(strlen($password) < 8){ #Checking the password length
		$errorMsg[] = "Hasło musi zawierać przynajmniej 8 znaków";
	}
	else{
		try{
			#Prepare and execution SQL statement to check if given email exists in database
			$select_stmt = $connection->prepare("SELECT email FROM users WHERE email=:uemail");
			$select_stmt->bindValue(':uemail', $email, PDO::PARAM_STR);
			$select_stmt->execute();
			$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
			
			if($select_stmt->fetch(PDO::FETCH_ASSOC)){ #If previous statement return someting given email exist in database
				if($row["email"] == $email){
				$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
				$errorMsg[] = "Na podany adres e-mail zostało założone już konto. Spróbuj opcji odzyskiwania hasła";
				}
			}
			else if(!isset($errorMsg)){ #If previous code didn't return any errors
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
					$insert_stmt = $connection->prepare("INSERT INTO users (id, name, surname, email, password, verified, addres_id) 
														VALUES (0, :uname, :usurname, :uemail, :upassword, 0, :uaddress_id)");
									
					#Execution of SQL statement						
					if($insert_stmt->execute(array( ':uname'=>$name,
													':usurname'=>$surname,
													':uemail'=>$email,
													'upassword'=>$hash_password,
													'uaddress_id'=>$address_id["id"]))){
						$registerMsg="Rejestracja powiodła się. Sprawdź podany adres e-mail w celu aktywacji konta";
					}
					else{
						$errorMsg[] = "Nieoczekiwany błąd. Przejdź do formularza zgłaszania błędów";
					}
				}
				else{
					$errorMsg[] = "Nieoczekiwany błąd. Przejdź do formularza zgłaszania błędów";
				}
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
?>