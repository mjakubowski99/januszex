<?php


namespace app\validators;


class AddressValidator extends Validator
{
    function homeOrFlatNumberValid($word): string{
        $last = $word[ strlen($word) - 1];
        if( ctype_alpha($last) )
            $word = substr($word, 0, -1);

        return ctype_digit($word);
    }

    public function postalCodeValid($postal_code){
        return preg_match('/^([0-9]{2})(-[0-9]{3})?$/i', $postal_code);
    }

    public function validate($data){
        if( $this->fieldsAreEmpty($data) ) return "Wypelnij wszystkie pola";
        if( $this->lengthValid($data['city'], 30) ) return "Nazwa miasta jest za dluga";
        if( $this->lengthValid($data['street'], 30) ) return "Nazwa ulicy jest za dluga";
        if( $this->lengthValid($data['home_number'], 5) )  return "Numer domu jest za dlugi";
        if( $this->lengthValid($data['flat_number'], 5) ) return "Numer mieszkania jest za dlugi";
        if( $this->lengthValid($data['postoffice_name'], 30) ) return "Nazwa poczty jest za dluga";
        if( !$this->postalCodeValid($data['postoffice_code']) ) return "Kod pocztowy jest nieprawidlowy, prawidlowy format to dd-ddd";
        if( !$this->homeOrFlatNumberValid($data['home_number'])) return "Podales numer domu w zlym formacie";
        if( !empty($data['flat_number']) && !$this->homeOrFlatNumberValid($data['flat_number'])) return "Podales numer mieszkania w zlym formacie";
        if( !ctype_alpha($data['city'])) return "Nie mozesz podawac innych znakow niz litery w nazwie miasta";

        return true;
    }
}