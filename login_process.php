<?php
session_start();
   include ("connection.php");

   $user_email="";
   $user_password1="";


    if (isset($_GET['email'])) {
        $user_email = trim($_GET['email']);
        $user_password1 = trim($_GET['password']);
   }



   if (isset($_POST['email'])) {
        $user_email = trim($_POST['email']);
        $user_password1 = trim($_POST['pwd']);
   }
    
    $user_password = md5($user_password1);
    if (!empty($user_email) && !empty($user_password))
    {
       
        $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$user_email, $user_password ]);
        $user = $stmt->fetch();

        $count = $stmt->rowCount();
        
        if ($count == 1)
        {       
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['fname'];
            

                        header('Location:physician_home.php');
                   
        }

        else
        {
            
            header('Location: ' . 'login.php?message=' . 'error');
        }
    }
   
    else
    {
        
        header('Location: ' . 'login.php?message=' . 'empty');
    }

?>
