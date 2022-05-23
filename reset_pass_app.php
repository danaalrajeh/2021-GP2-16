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

$query = "SELECT * FROM patients WHERE email = ? ";
$stmt = $conn->prepare($query);
$stmt->execute([$email]);
$user = $stmt->fetch();

$count = $stmt->rowCount();

if($count == 0){
    $json = array("data" => "هناك خطا في الايميل",);
    $json_done = json_encode($json,JSON_UNESCAPED_UNICODE);
    header('Content-Type: application/json; charset=utf-8');
    echo $json_done;
}
else{
    $sql = "update patients SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$password1,$email]);
    $to      = $email;
    $subject = 'Maak account new passowrd';
    $message = 'The new password is :'. "\r\n" .$password;
    $headers = 'From: ma3ak2022@gmail.com'       . "\r\n" .
        'Reset your Password' . "\r\n" .
        'by maak';

    mail($to, $subject, $message, $headers);
    $json = array("data" => "تم ارسال رسالة علي الايميل",);
    $json_done = json_encode($json,JSON_UNESCAPED_UNICODE);
    header('Content-Type: application/json; charset=utf-8');
    echo $json_done;
    }
?>
