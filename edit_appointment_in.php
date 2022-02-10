<?php
    include 'connection.php';
    session_start();
    

        $a_id = $_POST['a_id'];
        $p_id = $_POST['p_id'];
        $date = trim($_POST['date']);
        $time = trim($_POST['time']);

            $sql = "update appointment SET a_date = ?,a_time = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$date,$time,$a_id]);
            $msg = "edit";

      header("Location: p_appointment.php?msg=".$msg."&id=".$p_id);

    ?>