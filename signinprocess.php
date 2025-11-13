<?php
session_start();
include "connection.php";

$uname = $_POST["u"];
$pword = $_POST["p"];
$rememberme = $_POST["rm"];

if (empty($uname)) {
    echo ("Please Enter Your Username");
} else if (strlen($uname) > 40) {
    echo ("Username must contain LOWER THAN 40 Characters");
} else if (empty($pword)) {
    echo ("Please Enter Your Password");
} else if (strlen($pword) < 5 || strlen($pword) > 15) {
    echo ("Password must contain at least 5 and maximum 15 characters");
}else{
    $result = Database::search("SELECT * FROM `user` WHERE `uname` = '".$uname."' AND `password` = '".$pword."'");
    $num = $result->num_rows;

    if($num == 1){
        $data = $result->fetch_assoc();
        $_SESSION["u"] = $data;
        echo("success");

        if($rememberme == "true"){
            setcookie("username", $uname,time()+(60*60*24*365));
            setcookie("password", $pword,time()+(60*60*24*365));
        }
    }else{
        echo ("Invalid Username or Password");
    }
}
