<?php

include "connection.php";
session_start();

$pid = $_GET["id"];
$uid = $_SESSION["u"]["id"];

$w_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id` = '" . $uid . "' AND `product_id` = '" . $pid . "'");

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format('Y-m-d H:i:s');

if ($w_rs->num_rows > 0) {
    Database::iud("DELETE FROM `watchlist` WHERE `user_id` = '" . $uid . "' AND `product_id` = '" . $pid . "'");
    echo ("Removed");
} else {
    Database::iud("INSERT INTO `watchlist` (`date`,`user_id`, `product_id`) VALUES ('" . $date . "','" . $uid . "', '" . $pid . "')");
    echo ("Added");
}
