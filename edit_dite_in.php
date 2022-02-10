<?php
    include 'connection.php';
    session_start();
    

        $id = $_POST['id'];
        $p_id = $_POST['p_id'];
    
        $dt = trim($_POST['dt']);
        $rf = trim($_POST['rf']);
        $pf = trim($_POST['pf']);

            $sql = "update diet SET diet_type = ?,recommended_food = ?, prohibited_food = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$dt,$rf,$pf,$id]);
            $msg="dite edit";

      header("Location: manage_dite.php?id=".$p_id."&msg=".$msg);

    ?>