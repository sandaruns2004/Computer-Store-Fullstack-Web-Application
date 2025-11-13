<?php
session_start();
include "connection.php";

$id = $_POST["id"];
$name = $_POST["name"];
$email = $_POST["email"];
$msg = $_POST["msg"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format('Y-m-d H:i:s');

if (empty($msg)) {
    echo "Please enter your message";
} else if (strlen($msg) > 200) {
    echo "Message must contain less than 200 characters";
} else {
    Database::search("INSERT INTO `contact_us` (`contact_us_msg`, `user_id`,`contact_us_date`) VALUES ('" . $msg . "','" . $id . "','" . $date . "')");
    echo "Your message has been sent successfully";
}
