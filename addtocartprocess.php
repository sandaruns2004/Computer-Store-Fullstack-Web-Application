<?php

include "connection.php";
session_start();

$pid = $_GET["id"];
$uid = $_SESSION["u"]["id"];

$cart_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON cart.cart_product_id = product.id WHERE `cart_user_id` = '" . $uid . "' AND `cart_product_id` = '" . $pid . "'");

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format('Y-m-d H:i:s');

if ($cart_rs->num_rows > 0) {
    $cart_data = $cart_rs->fetch_assoc();
    $qty = $cart_data["cart_qty"];
    $qty++;
    if ($qty > $cart_data["product_qty"]) {
        $qty = $cart_data["product_qty"];
    }
    Database::iud("UPDATE `cart` SET `cart_qty` = '" . $qty . "' WHERE `cart_user_id` = '" . $uid . "' AND `cart_product_id` = '" . $pid . "'");
    echo ("Updated");
} else {
    $qty = 1;
    Database::iud("INSERT INTO `cart` (`cart_date`,`cart_qty`,`cart_user_id`, `cart_product_id`) VALUES ('" . $date . "','" . $qty . "','" . $uid . "', '" . $pid . "')");
    echo ("Added");
}
