<?php
    include 'connection.php';
    session_start();
    

        $id = $_POST['m_id'];
        $p_id = $_POST['p_id'];
        $m_name = trim($_POST['m_name']);
        $des = trim($_POST['des']);
        $dose = trim($_POST['dose']);
        $time = trim($_POST['time']);
        $precautions = trim($_POST['precautions']);
            $sql = "update prescription SET medication = ?,descrption = ?,dose = ?,time = ?,precautions = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$m_name,$des,$dose,$time,$precautions,$id]);
            $msg = "edit medications";

      header("Location: medications.php?msg=".$msg."&id=".$p_id);

    ?>