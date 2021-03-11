<?php

require_once '../app/database/Database.php';

class LoginValidator{

    public function findUserByEmail($email){
        $database = new Database();
		$query = "SELECT email, password FROM Users WHERE email=:uemail";
		$values = [ 'uemail' => $email];
        $row = $database->execute($query, $values);

		return $row;
    }
    
    public function checkPasswordValid($password, $hash){
        return password_verify($password, $hash);
    }

    public function validate($data){
        if( empty( $data['email'] ) )
            return "Wypełnij pole email";
        if( empty( $data['password'] ) )
            return "Wypełnij pole hasło";

        $row =  $this->findUserByEmail( $data['email'] );
        
        if(!$row )
            return "Niepoprawna nazwa uzytkownika lub hasło";
        if( $this->checkPasswordValid($data['password'], $row['password']) )
            return "Logowanie poprawne";
        else
            return "Niepoprawna nazwa uzytkownika lub haslo";
    }


}