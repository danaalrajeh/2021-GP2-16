<?php
    include 'connection.php';
    session_start();
    $d_id = $_GET['d_id'];
    $p_id = $_GET['p_id'];
    $sql = "delete from diet where id = ?";
    $stmt = $conn ->prepare($sql);
    $stmt->execute([$d_id]);
    $msg = "delete dite";
    header("Location: manage_dite.php?id=".$p_id."&msg=".$msg);
    ?>