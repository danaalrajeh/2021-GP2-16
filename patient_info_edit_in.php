<?php
    include 'connection.php';
    session_start();
    

        $id = $_POST['id'];
        $fname = trim($_POST['fname']);
        $birth = trim($_POST['birth']);
        $con = trim($_POST['con']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $phone = trim($_POST['phone']);
        $password = md5($password);
        $r_name = trim($_POST['r_name']);
        $r_num = trim($_POST['r_num']);



          $sql11 = "select * from alarm where p_id = ?";
          $stmt11 = $conn ->prepare($sql11);
          $stmt11->execute([$id]);
          $ss = $stmt11->fetchAll();
          $num = 0 ;
          $c = 0;
          foreach($ss as $s){
            if ($c == 0) {
             $num = $s['id'];
            }
            $c = $c + 1;
          }




            $sql = "update patients SET fname = ?,birthday = ?,cond = ? ,username = ?,password = ? ,phone = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fname,$birth,$con,$username,$password,$phone,$id]);

            $sql = "update alarm SET relative_name = ? ,phone = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$r_name,$r_num,$num]);


            $msg = "edit";

        header("Location: patient_info.php?id=".$id."&msg=".$msg);

    ?>