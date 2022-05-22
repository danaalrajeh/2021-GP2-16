<?php
    include 'connection.php';
    session_start();
    

        $id = $_POST['id'];
        $fname = trim($_POST['fname']);
        $birth = trim($_POST['birth']);
        $con = trim($_POST['con']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $phone = trim($_POST['phone']);
        $password = md5($password);
        $r_name = trim($_POST['r_name']);
        $r_num = trim($_POST['r_num']);

        $msg="";

          $sql1 = "SELECT * from patients where email LIKE ? and id <> ?";
                $stmt1 = $conn ->prepare($sql1);
                $stmt1->execute([$email,$id]);
                if($stmt1->rowCount()>0){
                  $msg = "email_error";
                header("Location: patient_info_edit.php?id=".$id."&msg=".$msg);
                    }

                    else{

            $sql = "update patients SET fname = ?,birthday = ?,cond = ? ,username = ?,email = ?,password = ? ,phone = ?,relative_name = ?,relative_phone = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fname,$birth,$con,$username,$email,$password,$phone,$r_name,$r_num,$id]);
            $msg = "edit";

        header("Location: patient_info.php?id=".$id."&msg=".$msg);}

    ?>