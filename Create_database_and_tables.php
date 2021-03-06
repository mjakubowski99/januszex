<?php 
# The script that creates the User table in the database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db_name = "januszex";
	$table_name1 = "Address";
	$table_name2 = "Users";
	
# Create connection and database if not exists, or use if exists

	$pdo = new PDO("mysql:host=localhost", $username, $password);
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$pdo->query("CREATE DATABASE IF NOT EXISTS $db_name");
	$pdo->query("use $db_name");
	
# Create Users table if not exists
	try{
		$sql_statement1= "CREATE table IF NOT EXISTS $table_name1(
			ID BIGINT NOT NULL AUTO_INCREMENT,
			city varchar(50) NOT NULL,
			street varchar(50) NOT NULL,
			home_number int NOT NULL,
			flat_number int,
			postoffice_name varchar(50) NOT NULL,
			postoffice_code varchar(6) NOT NULL,
			PRIMARY KEY (ID)
			);";
		$pdo->exec($sql_statement1);
		
		$sql_statement2 = "CREATE table IF NOT EXISTS $table_name2(
			ID BIGINT NOT NULL AUTO_INCREMENT,
			name varchar(50) NOT NULL,
			surname varchar(50) NOT NULL,
			email varchar(50) NOT NULL,
			password varchar(255) NOT NULL,
			verified boolean NOT NULL,
			address_id bigint NOT NULL,
			PRIMARY KEY (ID)
			);";
		$pdo->exec($sql_statement2);
	} catch(PDOException $e){
		echo $e->getMessage();
	}
?> 
