<?php

$host = "maak.host";
$db = "maak0103_clinic";
$username = "maak0103_root";
$password = "Gvg89rmaEG";

try {

	$conn = new PDO("mysql:host=$host;charset=utf8mb4;dbname=$db",$username,$password);
	
} catch (PDOException $e) {
	echo "Error : ". $e->getMessage();
}


?>