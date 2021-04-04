<?php


namespace app\resource;
use app\database\Database;


class Resource
{
    protected $database;

    public function __construct(){
        $this->database = new Database();
    }

}