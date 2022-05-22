<?php
include 'connection.php';
session_start();
$id = $_SESSION['id'];
$msg = "";
$type = 1;

$med_name = trim($_POST['med_name']);
$descrip = trim($_POST['descrip']);
$sql = "SELECT * from medication where med_name LIKE ?";
$stmt = $conn ->prepare($sql);
$stmt->execute([$med_name]);
if($stmt->rowCount()>0){
    $msg .= "error";
}else{
    $sql = "INSERT INTO medication (`med_name`,`descrip`) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$med_name,$descrip]);
    $msg .="successful";
}

if ($msg == "error") {
    header("Location: add_medicine.php?msg=".$msg);
}
elseif ($msg == "successful") {
    header("Location: medicine_list.php?msg=".$msg);
}

?>