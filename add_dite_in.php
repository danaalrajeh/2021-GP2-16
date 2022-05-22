<?php
    include 'connection.php';
    session_start();
        $dt = trim($_POST['dt']);
        $rf = trim($_POST['rf']);
        $pf = trim($_POST['pf']);
        $id = trim($_POST['p_id']);
                $sql = "INSERT INTO diet (`p_id`,`diet_type`,`recommended_food`,`prohibited_food`) VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id,$dt,$rf,$pf]);
                $msg = "dite added";
    
        header("Location: manage_dite.php?id=".$id."&msg=".$msg);

    
    ?>