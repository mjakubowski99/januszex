<?php

namespace app\validators;

class RegisterValidator extends Validator{

    public function mailValid($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function homeOrFlatNumberValid($word){ 
        $last = $word[ strlen($word) - 1];
        if( ctype_alpha($last) )
            $word = substr($word, 0, -1);
        
        return ctype_digit($word);
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
        return preg_match('/^([0-9]{2})(-[0-9]{3})?$/i', $postal_code);
    }

    public function fieldsAreEmpty($data){
        foreach( $data as $key => $value ){
            if( $key !== 'flat_number' && empty($value) )
                return true;
        }
        return false;
    }

    public function userExists($email){
		$query = "SELECT email FROM users WHERE email=:uemail";
		$values = [ 'uemail' => $email];
        $row = $this->database->execute($query, $values);
        if( !$row ){
            return false;
        }

		return ( count( $this->database->execute($query, $values) ) > 0 );
	}

    public function validate($data){
        if( $this->fieldsAreEmpty($data) ) return "Wypelnij wszystkie pola";
        if( !$this->mailValid($data['email']) ) return "Podaj prawidłowy adres email";
        if( !$this->lengthValid($data['password'], 8) ) return "Haslo jest za krotkie";
        if( !$this->passwordsAreTheSame($data['password'], $data['confirm']) ) return "Hasla się nie zgadzaja";
        if( $this->lengthValid($data['email'], 50) ) return "Adres email jest za dlugi";
        if( $this->lengthValid($data['name'], 30) ) return "Imie jest za dlugie";
        if( $this->lengthValid($data['surname'], 30) ) return "Nazwisko jest za dlugie";
        if( $this->lengthValid($data['city'], 30) ) return "Nazwa miasta jest za dluga";
        if( $this->lengthValid($data['street'], 30) ) return "Nazwa ulicy jest za dluga";
        if( $this->lengthValid($data['home_number'], 5) )  return "Numer domu jest za dlugi";
        if( $this->lengthValid($data['flat_number'], 5) ) return "Numer mieszkania jest za dlugi";
        if( $this->lengthValid($data['postoffice_name'], 30) ) return "Nazwa poczty jest za dluga";
        if( !$this->postalCodeValid($data['postoffice_code']) ) return "Kod pocztowy jest nieprawidlowy, prawidlowy format to dd-ddd";
        if( $this->userExists( $data['email'] ) ) return "Na podany adres e-mail zostało zalozone już konto. Sprobuj opcji odzyskiwania hasła";
        if( !$this->homeOrFlatNumberValid($data['home_number'])) return "Podales numer domu w zlym formacie";
        if( !empty($data['flat_number']) && !$this->homeOrFlatNumberValid($data['flat_number'])) return "Podales numer mieszkania w zlym formacie";
        if( !ctype_alpha($data['name'])) return "Nie mozesz podawac innych znakow niz litery w imieniu";
        if( !ctype_alpha($data['surname']) ) return "Nie mozesz podawac innych znakow niz litery w nazwisku";
        if( !ctype_alpha($data['city'])) return "Nie mozesz podawac innych znakow niz litery w nazwie miasta";

        return true;
    }


}
