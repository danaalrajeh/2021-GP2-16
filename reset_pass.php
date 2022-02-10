<?php
 include 'connection.php';

$email = trim($_POST['email']);


$n=15;
function generatePassword($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}

$password = generatePassword($n);
$password1 = md5($password);

$query = "SELECT * FROM users WHERE email = ? ";
        $stmt = $conn->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        $count = $stmt->rowCount();

    if($count == 0){
        header('Location: ' . 'reset_password.php?message=error&email='.$email);
    }
else{
$sql = "update users SET password = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$password1,$email]);
    $to      = $email;
    $subject = 'reset ma3ak account passowrd';
    $message = 'the new password is :'. "\r\n" .$password;
    $headers = 'From: ma3ak2022@gmail.com'       . "\r\n" .
                 'Reset your Password' . "\r\n" .
                 'by ma3ak';
                 
    mail($to, $subject, $message, $headers);
   echo"goooood";
   header('Location: ' . 'reset_password.php?message=good&email='.$email);}
?>
