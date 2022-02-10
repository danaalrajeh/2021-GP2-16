<?php
    include 'connection.php';
    session_start();
        $msg = "";
        $type = 1;
        $name = "";
        $phone = 0;
        
        $p_id = trim($_POST['p_id']);
        $symptom = trim($_POST['symptom']);
        $query = "SELECT * FROM alarm WHERE p_id = ? AND symptom = ?";
        $stmt1 = $conn->prepare($query);
        $stmt1->execute([$p_id,"--"]);
        $sy = $stmt1->fetch();

        
        if ($stmt1->rowCount()>0) {

            $sql1 = "update alarm set symptom = ? where p_id = ?";
            $stmt = $conn->prepare($sql1);
            $stmt->execute([$symptom,$p_id]);

            $msg .="add";
        }
        else{
            $query1 = "SELECT * FROM alarm WHERE p_id = ? ";
            $stmt11 = $conn->prepare($query1);
            $stmt11->execute([$p_id]);
            $sy1 = $stmt11->fetch();

            $sql = "INSERT INTO alarm(`p_id`,`symptom`,`relative_name`,`phone`) VALUES (?,?,?,?)";
                $stmt4 = $conn->prepare($sql);
                $stmt4->execute([$p_id,$symptom,$sy1,$phone]);
                $msg .="add";
        }
        

    
        header("Location: alarming.php?id=".$p_id."&msg=".$msg);

    
    ?>