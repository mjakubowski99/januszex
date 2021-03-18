<?php 

use Firebase\JWT\JWT;

require_once('../vendor/autoload.php');
require_once '../app/config/DotEnv.php';

class JwtManage{

    private $matches;

    public function __construct(){
        ( new DotEnv('../.env') )->load();
    }

    public function createToken($email){
        $secret = getenv("JWT_SECRET");
        $issuedAt = new DateTimeImmutable();
        $expire = $issuedAt->modify('+2 hours')->getTimestamp();
        $serverName = getenv("SERVER_DOMAIN");
        
        $data = [
            'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
            'iss'  => $serverName,       // Issuer
            'nbf'  => $issuedAt->getTimestamp(),         // Not before
            'exp'  => $expire,           // Expire
            'email' => $email,  
        ];

        return JWT::encode(
            $data,
            $secret,
            'HS512'
        );
    }

    public function tokenIsValid(){
        if( !$this->tokenExistInHeader() )
            return false;
        if( !$this->ableToExtractToken() )
            return false;
        
        $jwt = $this->matches[1];
        $secret = getenv("JWT_SECRET");
        $token = JWT::decode($jwt, $secret, ['HS512']); //some token was extracted

        return $this->tokenHasValidSignatureAndNotExpired($token);
    }



    public function tokenExistInHeader(){
        if( !isset($_SERVER['HTTP_AUTHORIZATION']) )
            return false;

        if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $this->matches)) {
            return false;
        } 
        return true;
    }

    public function ableToExtractToken(){
        if ( !$this->matches[1] ) {
            // No token was able to be extracted from the authorization header
            return false;
        }
        return true;
    }

    public function tokenHasValidSignatureAndNotExpired($token){
        $now = new DateTimeImmutable();
        $serverName = getenv("SERVER_DOMAIN");

        return ( $token->iss === $serverName &&
            $token->nbf <= $now->getTimestamp() &&
            $token->exp >= $now->getTimestamp() 
        );
    }

}