<?php

namespace app\models;

use app\database\Database;

class Model{

    protected $database;

    public function __construct(){
        $this->database = new Database();
    }
}