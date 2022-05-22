<?php
    include 'connection.php';
    session_start();
    $id = $_GET['id'];
    $sql = "delete from patients where id = ?";
    $stmt = $conn ->prepare($sql);
    $stmt->execute([$id]);
    header("Location: patients_list.php");
    ?>