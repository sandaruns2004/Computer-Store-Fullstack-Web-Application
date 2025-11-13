<?php

session_start();
include "connection.php";
$oid = $_POST["oid"];
$uid = $_SESSION["u"]["id"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format('Y-m-d H:i:s');

$cart_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON cart.cart_product_id = product.id WHERE `cart_user_id` = '" . $uid . "'");
$cart_num = $cart_rs->num_rows;

for ($i = 0; $i < $cart_num; $i++) {
    $cart_data = $cart_rs->fetch_assoc();
    $price = $cart_data["price"];
    $qty = $cart_data["cart_qty"];
    $pid = $cart_data["id"];
    Database::iud("INSERT INTO `invoice` (`order_id`,`invoice_date`,`invoice_price`,`invoice_qty`,`user_id`,`product_id`) VALUES ('" . $oid . "','" . $date . "','" . $price . "','" . $qty . "','" . $uid . "','" . $pid . "')");
    $new_qty = $cart_data["product_qty"] - $qty;
    Database::iud("UPDATE `product` SET `product_qty` = '" . $new_qty . "' WHERE `id` = '" . $pid . "'");
}

Database::iud("DELETE FROM `cart` WHERE `cart_user_id` = '" . $uid . "'");

echo ("OK");

?>
