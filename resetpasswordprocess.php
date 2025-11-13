<?php
include "connection.php";

$np = $_POST["np"];
$rp = $_POST["rp"];
$code = $_POST["c"];
$email = $_POST["m"];

if (empty($np)) {
    echo ("Please enter your New Password");
} else if (strlen($np) < 5 || strlen($np) > 20) {
    echo ("Password must contain between 5 and 20 characters");
} else if (empty($rp)) {
    echo ("Please enter your Password again");
} else if (strlen($rp) < 5 || strlen($rp) > 20) {
    echo ("Retyped Password must contain between 5 and 20 characters");
} else if ($np != $rp) {
    echo ("The passwords do not match");
} else {
    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `vcode` = '" . $code . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {
        Database::iud("UPDATE `user` SET `password` = '" . $np . "' WHERE `email`='" . $email . "' AND `vcode` = '" . $code . "'");
        echo ("success");
    } else {
        echo ("Invalid Verification Code");
    }
}
