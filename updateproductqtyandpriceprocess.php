<?php

session_start();
include "connection.php";

$pid = $_POST["id"];
$qty = $_POST["qty"];
$price = $_POST["price"];

$cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_product_id` = '" . $pid . "' AND `cart_user_id` = '" . $_SESSION["u"]["id"] . "'");
$cart_num = $cart_rs->num_rows;

if ($cart_num == 1) {
    $cart_data = $cart_rs->fetch_assoc();
    Database::iud("UPDATE `cart` SET `cart_qty` = '" . $qty . "' WHERE `cart_product_id` = '" . $pid . "' AND `cart_user_id` = '" . $_SESSION["u"]["id"] . "'");
    echo ("Cart updated successfully.");
} else {
    echo ("Something went wrong.");
}
