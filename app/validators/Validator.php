<?php


namespace app\validators;

use app\database\Database;


class Validator
{
    protected $message;
    protected $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function getMessage(){
        return $this->message;
    }

    public function lengthValid($string, $length): bool{
        return strlen($string) > $length;
    }

    public function fieldsAreEmpty($data): bool{
        foreach( $data as $key => $value ){
            if( $key !== 'flat_number' && empty($value) )
                return true;
        }
        return false;
    }

}