<?php
    include 'connection.php';
    session_start();
    $m_id = $_GET['m_id'];
    $p_id = $_GET['p_id'];
    $sql = "delete from prescription  where id = ?";
    $stmt = $conn ->prepare($sql);
    $stmt->execute([$m_id]);
    header("Location: medications.php?id=".$p_id);
    ?>