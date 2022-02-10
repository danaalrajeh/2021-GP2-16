<?php
    include 'connection.php';
    session_start();
        $msg = "";
        $type = 1;
        
        $time = trim($_POST['time']);
        $date = trim($_POST['date']);
        $p_id = trim($_POST['p_id']);
                $sql = "INSERT INTO appointment(`p_id`,`a_date`,`a_time`) VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$p_id,$date,$time]);
                $msg .="successful";
     

    
        header("Location: p_appointment.php?id=".$p_id."&msg=".$msg);

    
    ?>