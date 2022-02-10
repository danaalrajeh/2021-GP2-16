<?php
    include 'connection.php';
    session_start();
        $msg = "";
        $type = 1;
        
        $m_name = trim($_POST['m_name']);
        $des = trim($_POST['des']);
        $dose = trim($_POST['dose']);
        $time = trim($_POST['time']);
        $precautions = trim($_POST['precautions']);
        $id = trim($_POST['id']);
                $sql = "INSERT INTO prescription (`p_id`,`medication`,`descrption`,`dose`,`time`,`precautions`) VALUES (?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id,$m_name,$des,$dose,$time,$precautions]);
                $msg .="successful";
     

    
        header("Location:medications.php?id=".$id."&msg=".$msg);

    
    ?>