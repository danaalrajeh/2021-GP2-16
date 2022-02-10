<?php
ob_start();
    include 'connection.php';
    
        $msg = "";
        $type = 1;
        
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $mail = trim($_POST['email']);
        $pwd1 = trim($_POST['pwd']);
        $pwd = md5($pwd1);
            $sql = "SELECT * from users where email ='$mail'";
            $stmt = $conn ->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $msg .= "sorry";
                header('Location: create_accuont.php?msg='.$msg);
            }else{
                $sql = "INSERT INTO users (`fname`,`lname`,`email`,`password`) VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
                if($stmt->execute([$fname,$lname,$mail,$pwd]))
                {
                    header('Location: login_process.php?email='.$mail.'&password='.$pwd1);
                }
                
            }
        
            ob_flush();
    ?>