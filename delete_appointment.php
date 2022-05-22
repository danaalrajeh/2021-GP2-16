<?php
    include 'connection.php';
    session_start();
    $a_id = $_GET['a_id'];
    $p_id = $_GET['p_id'];
    $sql = "delete from appointment where id = ?";
    $stmt = $conn ->prepare($sql);
    $stmt->execute([$a_id]);
    $msg = "delete";
    header("Location: p_appointment.php?id=".$p_id."&msg=".$msg);
    ?>