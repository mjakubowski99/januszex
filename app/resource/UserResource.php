<?php

namespace app\resource;

use app\database\Database;

class UserResource{

    protected $database;

    public function __construct(){
        $this->database = new Database();
    }

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
}