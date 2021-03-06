<?php

#Making connection to database
$servername = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "januszex";

try{
	$connection = new PDO("mysql:host={$servername};dbname={$db_name}",$db_user,$db_password);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(PDOEXCEPTION $e){
	$e->getMessage();
}

?>