<?php

require_once '../app/validators/RegisterValidator.php';
require_once '../app/database/Database.php';

class RegisterValidator{

    public function mailValid($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function lengthValid($string, $length){
        return strlen($string) > $length;
    }

    public function passwordsAreTheSame($pass, $confirm){
        return $pass === $confirm;
    }

    public function stringNumeric($str){
        return is_numeric($str);
    }

    public function postalCodeValid($postal_code){
        return preg_match('/^[0-9]{2}-?[0-9]{3}$/Du', $postal_code);
    }

    public function fieldsAreEmpty($data){
        foreach( $data as $key => $value ){
            if( empty($value) )
                return true;
        }
        return false;
    }

    public function userExists($email){
        $database = new Database();
		$query = "SELECT email FROM users WHERE email=:uemail";
		$values = [ 'uemail' => $email];
        $row = $database->execute($query, $values);
        if( !$row ){
            return false;
        }

		return ( count( $database->execute($query, $values) ) > 0 );
	}

    public function validate($data){
        if( $this->fieldsAreEmpty($data) ) return "Wypełnij wszystkie pola";
        if( !$this->mailValid($data['txt_email']) ) return "Podaj prawidłowy adres email";
        if( !$this->lengthValid($data['txt_password'], 8) ) return "Hasło jest za krótkie";
        if( !$this->passwordsAreTheSame($data['txt_password'], $data['txt_confirm']) ) return "Hasła się nie zgadzają";
        if( $this->lengthValid($data['txt_name'], 30) ) return "Imie jest za długie";
        if( $this->lengthValid($data['txt_surname'], 30) ) return "Nazwisko jest za długie";
        if( $this->lengthValid($data['txt_city'], 30) ) return "Nazwa miasta jest za długa";
        if( $this->lengthValid($data['txt_street'], 30) ) return "Nazwa ulicy jest za długa";
        if( !$this->stringNumeric($data['txt_home_number']) ) return "Podaj wartość numeryczną numeru domu";
        if( !$this->stringNumeric($data['txt_flat_number']) ) return "Podaj wartość numeryczną numeru mieszkania";
        if( $this->lengthValid($data['txt_postoffice_name'], 30) ) return "Nazwa poczty jest za długa";
        if( !$this->postalCodeValid($data['txt_postoffice_code']) ) return "Kod pocztowy jest nieprawidłowy, prawidłowy format to dd-ddd";
        if( $this->userExists( $data['txt_email'] ) ) return "Na podany adres e-mail zostało założone już konto. Spróbuj opcji odzyskiwania hasła";

        return true;
    }


}