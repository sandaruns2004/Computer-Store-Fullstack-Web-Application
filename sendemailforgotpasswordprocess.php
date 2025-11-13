<?php

include "connection.php";
include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

session_start();

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["m"];

$rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
$num = $rs->num_rows;

if (empty($email)) {
    echo ("Please Enter Your Email Address");
} else if (strlen($email) > 100) {
    echo ("Email Address must contain LOWER THAN 100 Characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Addredd");
} else if ($num == 1) {
    $datauser = $rs->fetch_assoc();
    $_SESSION["em"] = $datauser;
    $username = $_SESSION["em"]["uname"];
    $code = rand("100000", "999999");
    Database::iud("UPDATE `user` SET `vcode` = '" . $code . "' WHERE `email`='" . $email . "'");

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
    $mail->Subject = 'Online Computer Store Forgot Password Verification Code'; //Subject of the email
    $bodyContent = '<h4>Username : ' . $username . '</h4><br>
    <h4>Email : '.$email.'</h4><br><br><br>
    <h3 style="color:blue;">Your Verification Code is ' . $code . '</h3>'; //Content of the email
    $mail->Body    = $bodyContent;

    if (!$mail->send()) {
        echo ("Verification Sending Failed.");
    } else {
        echo ("success");
    }
} else {
    echo "Your Email Address Isn't Registerred.";
}
