<?php
    include 'connection.php';
    session_start();
    

        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        $query = "SELECT * FROM users WHERE id = ? ";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        if ($fname == "" ) {
            $fname = $user['fname'] ;
        }
        if ($lname == "") {
            $lname = $user['lname'] ;
        }
        if ($email == "") {
            $email = $user['email'] ;
        }
        if ($password == "") {
            $password = $user['password'] ;
        }
        $user_password = md5($password);

            $sql = "update users SET fname = ?,lname = ?,email = ?,password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fname,$lname,$email,$password,$id]);

      header("Location: profile.php");

    ?>