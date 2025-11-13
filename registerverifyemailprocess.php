<?php
include "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$uname = $_POST["u"];
$email = $_POST["e"];
$pwd = $_POST["p"];
$cpwd = $_POST["cp"];
$mobile = $_POST["m"];
$gender = $_POST["g"];
$code = $_POST["code"];

$realcode = $_COOKIE["code"];

if (empty($code)) {
    echo ("Please enter the verification code");
} else if (strlen($code) != 6) {
    echo ("Verification code must contain 6 characters");
} else if ($code != $realcode) {
    echo ("Invalid verification code");
} else {
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format('Y-m-d H:i:s');

    Database::iud("INSERT INTO `user` (`fname`,`lname`,`uname`,`email`,`password`,`mobile`,`gender_id`,`status_id`,`registered_date`,`vcode`) 
        VALUES ('" . $fname . "','" . $lname . "','" . $uname . "','" . $email . "','" . $pwd . "','" . $mobile . "','" . $gender . "','1','" . $date . "','" . $code . "')");
    echo ("success");
}
