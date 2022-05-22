<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
$patient_name = $_POST['patient_name'];
$doc_name = $_POST['doc_name'];
$doc_email = $_POST['doc_email'];
$condition = $_POST['condition'];

    $to      = $doc_email;
    $subject = 'Urgent Symptoms';
    $message = 'The patient ' . $patient_name . ' has the following symptoms ' . $condition . "\r\n";
    $headers = 'From: ma3ak2022@gmail.com'       . "\r\n" .
        'Urgent Case' . "\r\n" .
        'by maak';

    mail($to, $subject, $message, $headers);
}
?>
