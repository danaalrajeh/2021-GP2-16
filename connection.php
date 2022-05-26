<?php

$host = "";
$db = "";
$username = "";
$password = "";

try {

	$conn = new PDO("mysql:host=$host;charset=utf8mb4;dbname=$db",$username,$password);
	
} catch (PDOException $e) {
	echo "Error : ". $e->getMessage();
}


?>
