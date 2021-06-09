<?php

namespace app\resource;

use app\database\Database;

class UserResource extends Resource{

    public function createHelloMessageForEmail($message, $email){
        $data = [
            'message' => $message,
            'email' => $email,
        ];

        return json_encode($data);
    }

    public function getPasswordRow($email, $password){
        $query = "SELECT password FROM users WHERE email=:email";
        $values = ['email' => $email];


        $row = $this->database->execute($query,$values);
        if( !$row )
            return null;
        if( password_verify($password, $row['password']) )
            return $row;
        else
            return null;
    }

    public function getUserByEmail($email){
        $query = "SELECT id, address_id FROM users WHERE email=:email";
        $values = ['email' => $email];


        $row = $this->database->execute($query,$values);
        if( !$row )
            return null;
        return $row;
    }
}