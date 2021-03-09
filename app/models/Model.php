<?php

require_once '../app/database/Database.php';

class Model{

    protected $database;

    public function __construct(){
        $this->database = new Database();
    }
}