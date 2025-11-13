<?php

include "connection.php";
include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["e"];

$code = rand("100000","999999");
setcookie("code",$code,time()+(60*60*24*365));

//EMAIL CODE
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'sandaruns2004@gmail.com'; //sender's email
$mail->Password = 'iqafqaraffgkdrbb'; //app password
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('sandaruns2004@gmail.com', 'Reset Password'); //sender's email,sender's name
$mail->addReplyTo('sandaruns2004@gmail.com', 'Reset Password'); //sender's email,sender's name
$mail->addAddress($email); //reciever's email
$mail->isHTML(true);
$mail->Subject = 'Online Computer Store Email Verification Code'; //Subject of the email
$bodyContent = '<h3 style="color:blue;">Your Verification Code is ' . $code . '</h3>'; //Content of the email
$mail->Body    = $bodyContent;

if (!$mail->send()) {
    echo ("Verification Sending Failed.");
} else {
    echo ("success");
}

?>
