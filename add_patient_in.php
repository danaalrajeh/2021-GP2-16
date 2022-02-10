<?php
    include 'connection.php';
    session_start();
    $id = $_SESSION['id'];
        $msg = "";
        $type = 1;
        
        $fname = trim($_POST['fname']);
        $birth = trim($_POST['birth']);
        $con = trim($_POST['con']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $phone = trim($_POST['phone']);
        $password = md5($password);
        $rn = trim($_POST['rname']);
        $rp = trim($_POST['rphone']);
            $sql = "SELECT * from patients where username LIKE ?";
            $stmt = $conn ->prepare($sql);
            $stmt->execute([$username]);
            if($stmt->rowCount()>0){
                $msg .= "error";
            }else{
                $sql = "INSERT INTO patients (`fname`,`birthday`,`cond`,`username`,`password`,`phone`,`physician_id`) VALUES (?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$fname,$birth,$con,$username,$password,$phone,$id]);
                $msg .="successful";

                $query1 = "SELECT * FROM patients WHERE fname = ? ";
                $stmt11 = $conn->prepare($query1);
                $stmt11->execute([$fname]);
                $rname = $stmt11->fetch();
                $ssd = "--";
                $sql22 = "INSERT INTO alarm(`p_id`,`symptom`,`relative_name`,`phone`) VALUES (?,?,?,?)";
                $stmt22 = $conn->prepare($sql22);
                $stmt22->execute([$rname['id'],$ssd,$rn,$rp]);
            
                 }
     if ($msg == "error") {
        header("Location: add_patient.php?msg=".$msg);
        }
        elseif ($msg == "successful") {
              header("Location: patients_list.php?msg=".$msg);
           }   
    
    ?>