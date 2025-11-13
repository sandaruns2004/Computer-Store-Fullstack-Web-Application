<?php

session_start();
include "connection.php";

$uid = $_SESSION["u"]["id"];
$pid = $_POST["id"];
$star = $_POST["star"];
$msg = $_POST["msg"];

$feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `feedback_user_id` = '" . $uid . "' AND `feedback_product_id` = '" . $pid . "'");
$feedback_num = $feedback_rs->num_rows;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format('Y-m-d H:i:s');

if ($feedback_num == 0) {
    Database::iud("INSERT INTO `feedback` (`feedback_star`,`feedback_date`,`feedback_msg`,`feedback_user_id`,`feedback_product_id`) VALUES ('" . $star . "','" . $date . "','" . $msg . "','" . $uid . "','" . $pid . "')");
    echo ("Feedback submitted successfully");
}else{
    echo ("You have already given feedback for this product");
}
