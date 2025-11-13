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

if (empty($fname)) {
    echo ("Please Enter Your First Name");
} else if (strlen($fname) > 40) {
    echo ("First Name must contain LOWER THAN 40 Characters");
} else if (empty($lname)) {
    echo ("Please Enter Your Last Name");
} else if (strlen($lname) > 40) {
    echo ("Last Name must contain LOWER THAN 40 Characters");
} else if (empty($uname)) {
    echo ("Please Enter Your Username");
} else if (strlen($uname) > 40) {
    echo ("Username must contain LOWER THAN 40 Characters");
} else if (empty($email)) {
    echo ("Please Enter Your Email Address");
} else if (strlen($email) > 100) {
    echo ("Email Address must contain LOWER THAN 100 Characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Addredd");
} else if (empty($pwd)) {
    echo ("Please Enter your Password.");
} else if (strlen($pwd) < 5 || strlen($pwd) > 15) {
    echo ("Password must contain BETWEEN 5 and 15 Characters.");
} else if (empty($cpwd)) {
    echo ("Please Enter your Password again.");
} else if (strlen($cpwd) < 5 || strlen($cpwd) > 15) {
    echo ("Password must contain BETWEEN 5 and 20 Characters.");
} else if ($pwd != $cpwd) {
    echo ("Passwords do not match.");
} else if (empty($mobile)) {
    echo ("Please Enter your Mobile Number.");
} else if (strlen($mobile) != 10) {
    echo ("Mobile Number must contain 10 Characters.");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/", $mobile)) {
    echo ("Invalid Mobile Number.");
} else{
    $result = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' OR `mobile` = '".$pwd."' OR `uname` = '".$uname."'");
    $num = $result->num_rows;

    if($num >0){
        echo ("Email or Mobile Number or Username already taken.");
    }else{
        echo ("Registration Successful.");
    }
}
