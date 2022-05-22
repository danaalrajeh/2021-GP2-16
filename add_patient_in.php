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
        $email = trim($_POST['email']);
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
                $sql1 = "SELECT * from patients where email LIKE ?";
                $stmt1 = $conn ->prepare($sql1);
                $stmt1->execute([$email1]);
                if($stmt1->rowCount()>0){
                $msg .= "error_email";
                    }
                    else{
                $sql = "INSERT INTO patients (`fname`,`birthday`,`cond`,`username`,`email`,`password`,`phone`,`relative_name`,`relative_phone`,`physician_id`) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$fname,$birth,$con,$username,$email,$password,$phone,$rn,$rp,$id]);
                $msg .="successful";}
            
                 }
     if ($msg == "error" || $msg == "error_email") {
        header("Location: add_patient.php?msg=".$msg);
        }
        elseif ($msg == "successful") {
              header("Location: patients_list.php?msg=".$msg);
           }   
    
    ?>