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
}