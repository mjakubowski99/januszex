<?php

namespace app\database;
use PDO;

class Database{

    public function execute($query, $values = []){

        $db_conn = new \app\config\DatabaseConnector();
        $connection = $db_conn->getConnection();

        try{
            $stmt = $connection->prepare($query);
            foreach($values as $key => $value){
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            echo json_encode([
                'message' =>  $e->getMessage()
            ]);
            die();
		}
    }

    public function insert($query, $values = []){

        $db_conn = new \app\config\DatabaseConnector();
        $connection = $db_conn->getConnection();

        try{
            $stmt = $connection->prepare($query);
            foreach($values as $key => $value){
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }
            $stmt->execute();
        }
        catch(PDOException $e){
            echo json_encode([
                'message' =>  $e->getMessage()
            ]);
            die();
		}
    }

    public function update($query, $values){
        $this->insert($query, $values);
    }

}

