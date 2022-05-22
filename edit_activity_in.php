<?php
    include 'connection.php';
    session_start();
    

        $id = $_POST['p_id'];
        $act = trim($_POST['act']);
        $type = trim($_POST['atype']);
        $duration = trim($_POST['aduration']);

        $sql = "select * from physical_activity where p_id = ?";
        $stmt = $conn ->prepare($sql);
        $stmt->execute([$id]);
        $m = $stmt->fetch();
        if ($stmt->rowCount() > 0) {
            $sql1 = "update physical_activity SET activity_type = ?,duration = ?,description = ? WHERE p_id = ?";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->execute([$type,$duration,$act,$id]);
            $msg="edit activity";
      header("Location: physical_activity.php?id=".$id."&msg=".$msg);
        }

    else{
            $sql1 = "INSERT INTO physical_activity (`p_id`,`activity_type`,`duration`,`description`) VALUES (?,?,?,?)";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->execute([$id,$type,$duration,$act]);
            $msg="add activity";
            header("Location: physical_activity.php?id=".$id."&msg=".$msg);
    }

    ?>