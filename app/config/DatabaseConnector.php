<?php

require_once '../app/config/DotEnv.php';

class DatabaseConnector{

	public $connection;

	public function __construct(){
		( new DotEnv('../.env') )->load(); //loading dotenv variables
		//You can do getenv("ENV_NAME") to get variable from file .env

		#Making connection to database
		$servername = getenv("DB_SERVER");
		$db_port = getenv("DB_PORT");
		$db_user = getenv("DB_USERNAME");
		$db_password = getenv("DB_PASSWORD");
		$db_name = getenv("DB_NAME");

		try{
			$this->connection = new PDO("mysql:host={$servername}:{$db_port};dbname={$db_name}",$db_user,$db_password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch(PDOEXCEPTION $e){
			echo json_encode([
				'message' => $e->getMessage()
			]);

			die();
		}
	}

	public function getConnection(){
		return $this->connection;
	}

}



