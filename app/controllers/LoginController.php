<?php

#Include database connection file
require_once 'ConnectionController.php';

#Get and validate data from form
if(isset($_REQUEST['login_button'])){
	$password = strip_tags($_REQUEST["password_textbox"]);
	$email = strip_tags($_REQUEST["email_textbox"]);
	
	#Operation if username or password is empty
	if(empty($email)){
		$errorMsg[] = "Wprowadź adres email";
	} 
	else if(empty($password)){
		$errorMsg[] = "Wprowadź hasło";
	} 
	else {
		try {
			#Prepare and execution SQL statement to get all user data about given email 
			$select_stmt = $connection->prepare("SELECT * FROM users WHERE email=:uemail");
			$select_stmt->execute(array('uemail'=>$email));
			$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
			
			#Check if given email exists in database
			if($select_stmt->rowCount() > 0){
				if($email == $row["email"]){
					if(password_verify($password, $row["password"])){ #Compare given password with password in database
						$loginMsg = "Logowanie poprawne...";
						header("refresh:2, home.php");	#If password is correct, redirect to home.php 
					}
					else{
						$errorMsg[]="Wprowadzono niewłaściwe hasło lub adres email";
					}
				
				}
				else{
					$errorMsg[]="Wprowadzono niewłaściwe hasło lub adres email";
				}
			}
			else{
				$errorMsg[]="Wprowadzono niewłaściwe hasło lub adres email";
			}
			
		}
		catch(PDOException $e){
			$e->getMessage();
		}
	}
}
?>



