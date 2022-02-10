<?php 
 
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
require 'mail/mail/src/Exception.php'; 
require 'mail/mail/src/PHPMailer.php'; 
require 'mail/mail/src/SMTP.php'; 
 
$mail = new PHPMailer; 
 
include 'connection.php';

$email = trim($_POST['email']);


$n=15;

$password = "11111";
$sql = "update users SET password = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$password,$email]);

$mail->isSMTP();                      // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;               // Enable SMTP authentication 
$mail->Username = 'ma3ak2022@gmail.com';   // SMTP username 
$mail->Password = 'ma3ak2022ma3ak2022';   // SMTP password 
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                    // TCP port to connect to 
 
// Sender info 
$mail->setFrom('ma3ak2022@gmail.com', 'CodexWorld'); 
$mail->addReplyTo('ma3ak2022@gmail.com', 'CodexWorld'); 
 
// Add a recipient 
$mail->addAddress('ali.ali.set.prog@gmail.com'); 
 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'Email from Localhost by CodexWorld'; 
 
// Mail body content 
$bodyContent = '<h1>How to Send Email from Localhost using PHP by CodexWorld</h1>'; 
$bodyContent .= '<p>This HTML email is sent from the localhost server using PHP by <b>CodexWorld</b></p>'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    echo 'Message has been sent.'; 
} 
 
?>