<?php


namespace app\resource;


class AddressResource extends Resource
{
    public function getAddressForUser($email){
        $query = "SELECT city, street, home_number, flat_number, postoffice_name, postoffice_code FROM address WHERE 
                  id = (SELECT address_id FROM users WHERE email=:email)
                 ";
        $values = [ 'email' => $email ];

        $row = $this->database->execute($query, $values);
        if( !$row )
            return null;
        return $row;
    }

    public function getAddressIdForUser($email){
        $query = "SELECT id FROM address WHERE 
                  id = (SELECT address_id FROM users WHERE email=:email)
                 ";
        $values = [ 'email' => $email ];

        $row = $this->database->execute($query, $values);
        if( !$row )
            return null;
        return $row;
    }
}