<?php 

namespace app\config;

use Firebase\JWT\JWT;
use app\config\DotEnv;
use DateTimeImmutable;
use app\database\Database;

require_once(__DIR__.'/../../vendor/autoload.php');

class JwtManage{

    private $matches;

    private $role;

    public function __construct($role){
        ( new DotEnv(__DIR__.'/../../.env') )->load();
        $this->role = $role;
    }

    private function getSecret(){
        if( $this->role === 'admin' )
            return getenv("JWT_ADMIN_SECRET");
        if( $this->role === 'user' )
            return getenv("JWT_SECRET");
    }

    public function createToken($email){
        $secret = $this->getSecret();
        $issuedAt = new DateTimeImmutable();
        $expire = $issuedAt->modify('+2 hours')->getTimestamp();
        $serverName = getenv("SERVER_DOMAIN");
        
        $data = [
            'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
            'iss'  => $serverName,       // Issuer
            'nbf'  => $issuedAt->getTimestamp(),         // Not before
            'exp'  => $expire,           // Expire
            'role' => $this->role,
            'email' => $email,  
        ];

        return JWT::encode(
            $data,
            $secret,
            'HS512'
        );
    }

    public function getEmailForToken(){
        if( !$this->tokenExistInHeader() )
            return null;;
        if( !$this->ableToExtractToken() )
            return null;

        $jwt = $this->matches[1];
        $secret = $this->getSecret();
        $token = JWT::decode($jwt, $secret, ['HS512']);

        if( $this->tokenHasValidSignatureAndNotExpired($token) )
           return $token->email;
        else
           return null;
    }

    public function tokenOnBlacklist($token){
        $database = new Database();
        $query = "SELECT id FROM jwt_blacklist WHERE token=:token";
        $values = ['token' => $token];

        $row = $database->execute($query, $values);
        if( !$row )
            return false;
        return true;
    }

    public function tokenIsValid(){
        if( !$this->tokenExistInHeader() )
            return false;
        if( !$this->ableToExtractToken() )
            return false;
        
        $jwt = $this->matches[1];
        //if( $this->tokenOnBlacklist($jwt) )
        //    return false;

        $secret = $this->getSecret();
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