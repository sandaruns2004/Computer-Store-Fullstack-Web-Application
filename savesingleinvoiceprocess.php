<?php

session_start();
include "connection.php";
$oid = $_POST["oid"];
$uid = $_SESSION["u"]["id"];
$pid = $_POST["pid"];
$qty = $_POST["qty"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format('Y-m-d H:i:s');

$product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
$product_num = $product_rs->num_rows;

$product_data = $product_rs->fetch_assoc();
$price = $product_data["price"];
Database::iud("INSERT INTO `invoice` (`order_id`,`invoice_date`,`invoice_price`,`invoice_qty`,`user_id`,`product_id`) VALUES ('" . $oid . "','" . $date . "','" . $price . "','" . $qty . "','" . $uid . "','" . $pid . "')");
$new_qty = $product_data["product_qty"] - $qty;
Database::iud("UPDATE `product` SET `product_qty` = '" . $new_qty . "' WHERE `id` = '" . $pid . "'");

echo ("OK");

?>