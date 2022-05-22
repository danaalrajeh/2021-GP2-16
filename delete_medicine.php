<?php
    include 'connection.php';
    session_start();
    $m_id = $_GET['id'];
    $sql = "delete from medication  where id = ?";
    $stmt = $conn ->prepare($sql);
    $stmt->execute([$m_id]);
    header("Location: medicine_list.php");
    ?>