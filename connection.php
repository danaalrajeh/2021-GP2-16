<?php

$host = "localhost";
$db = "clinic";
$username = "root";
$password = "";

try {

	$conn = new PDO("mysql:host=$host;dbname=$db",$username,$password);
	
} catch (PDOException $e) {
	echo "Error : ". $e->getMessage();
}


?>