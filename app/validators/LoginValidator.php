<?php

namespace app\validators;

class LoginValidator extends Validator{

    public function findUserByEmail($email){
		$query = "SELECT email, password FROM users WHERE email=:uemail";
		$values = [ 'uemail' => $email ];

		return $this->database->execute($query, $values);
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