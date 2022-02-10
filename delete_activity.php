<?php
    include 'connection.php';
    session_start();
    $a_id = $_GET['a_id'];
    $p_id = $_GET['p_id'];
    $sql = "delete from physical_activity where id = ?";
    $stmt = $conn ->prepare($sql);
    $stmt->execute([$a_id]);
    $msg="delete activity";
    header("Location: physical_activity.php?id=".$p_id."&msg=".$msg);
    ?>