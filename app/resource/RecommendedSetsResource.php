<?php 

use app\database\Database;

class RecommendedSetsResource{

    public function __construct(){
        $this->database = new Database();
    }

    public function getRandomRecommendedSets(){
        
    }

}