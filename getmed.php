<?php
include ("connection.php");
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $med_name = $_GET['med_name'];
    $stmt = $conn->prepare("SELECT descrip FROM medication WHERE med_name = '$med_name'");
    $stmt->execute();
    $desc = $stmt->fetch();
    echo $desc['descrip'];
}
