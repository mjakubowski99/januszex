<?php

class UserTokenResource{

    private $database;

    public function setDatabase($database){
        $this->database = $database;
    }

    public function getTokenRow($token){
        $query = 'SELECT user_id, expire FROM verify_tokens WHERE token=:token';
        $values = [ 'token' => $token ];

        $row = $this->database->execute($query, $values);
        if( !$row )
            return null;
        return $row;
    }

    public function getUserForToken($token){
        $subquery = 'SELECT user_id FROM verify_tokens WHERE token=:token';
        $query = "SELECT id FROM users WHERE ( {$subquery} )"; 
        
        
        $values = [ 'token' => $token ];
        $row = $this->database->execute($query, $values);
        if( !$row )
            return null;
        return $row;
    }

    public function getTokenIdForUserId($user_id){
        $query = "SELECT id FROM verify_tokens WHERE user_id=:user_id";   
        $values = [ 'user_id' => $user_id ];

        $row = $this->database->execute($query, $values);

        if( !$row )
            return null;
        return $row['id'];
    }

    public function getUserIdForEmail($email){
        $query = "SELECT id FROM users WHERE email=:uemail";
        $values = [ 'uemail' => $email ] ;
        $row = $this->database->execute($query, $values);

        if( !$row )
            return null;
        return $row['id'];
    }
}