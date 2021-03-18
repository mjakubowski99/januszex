<?php 

require_once '../app/database/Database.php';
require_once '../app/resource/UserTokenResource.php';


class VerifyToken{

    private $database;
    private $resource;

    public function __construct(){
        $this->database = new Database();
        $this->resource = new UserTokenResource();
        $this->resource->setDatabase($this->database);
    }

    public function updateToken($email){
        $user_id = $this->resource->getUserIdForEmail($email);
        if( $user_id === null )
            return null;

        $token_id = $this->resource->getTokenIdForUserId( $user_id );

        if( $token_id !== null ){

            $token = bin2hex(random_bytes(58));
            $expire = ( new DateTimeImmutable() )->modify('+1 hours');

            $query = "UPDATE verify_tokens
                      SET token = :token, expire = :expire
                      WHERE id=:token_id";

            $values = [
                'token' => $token,
                'expire' => $expire->format('Y-m-d H:i:s'),
                'token_id' => $token_id
            ];

        
            $this->database->update($query, $values);
            return $token;
        }
        else
            return null;
    }

    public function createToken($email){

        $token = bin2hex(random_bytes(58));
        $expire = ( new DateTimeImmutable() )->modify('+1 hours');
        $user_id = $this->resource->getUserIdForEmail($email);

        if( $user_id === null )
            return null;

        $values = [
            'token' => $token,
            'user_id' => $user_id,
            'expire' => $expire->format('Y-m-d H:i:s')
        ];

        $this->database->insert("INSERT INTO verify_tokens (id, token, user_id, expire) 
								 VALUES (0, :token, :user_id, :expire)", $values);

        return $token;
    }

    public function tokenNotExpired($expire_time){
        $now = new DateTimeImmutable();
        $expire_time = strtotime($expire_time);

        return ( $expire_time > $now->getTimestamp() );
    }

    public function verifyUserForToken($token){
        $row = $this->resource->getTokenRow($token);
        if( $row === null )
            return false;

        $user_id = $row['user_id'];

        if( $user_id !== null && $this->tokenNotExpired( $row['expire'] )){    
            $query = "UPDATE users
                      SET verified = 1
                      WHERE id=:id";

            $values = [
                'id' => $user_id
            ];

            $this->database->update($query, $values);
            return true;
        }
        else
            return false;
    }
}