<?php

session_start();
include "connection.php";

$id = $_POST["id"];
$qty = $_POST["qty"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $_POST["id"] . "'");
$product_num = $product_rs->num_rows;

$totalprice = 0;
$totalshipping = 0;

$product_data = $product_rs->fetch_assoc();
$totalprice = $qty * $product_data["price"];
$totalshipping = $product_data["delevery_fee"] * $qty;
$address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `cities` ON user_has_address.cities_city_id = cities.city_id WHERE `user_id` = '" . $_SESSION["u"]["id"] . "'");

$totalamount = $totalprice + $totalshipping;

if ($address_rs->num_rows != 0) {
    $address_data = $address_rs->fetch_assoc();
    $address = $address_data["line1"] . ", " . $address_data["line2"];

    $array;

    $email = $_SESSION["u"]["email"];
    $item = $product_data["title"];
    $order_id = rand(100000, 999999);
    $fname = $_SESSION["u"]["fname"];
    $lname = $_SESSION["u"]["lname"];
    $mobile = $_SESSION["u"]["mobile"];
    $uaddress = $address;
    $city = $address_data["city_name_en"];
    $merchant_id = 1228034;
    $merchant_secret = "MTk4NjYyNTQ0NjEzNDExNTkxNjMyOTU4OTMyOTg0MjUzNDYzMDc1MA==";
    $currency = "LKR";
    $hash = strtoupper(
        md5(
            $merchant_id .
                $order_id .
                number_format($totalamount, 2, '.', '') .
                $currency .
                strtoupper(md5($merchant_secret))
        )
    );
    $array["id"] = $order_id;
    $array["item"] = $item;
    $array["amount"] = $totalamount;
    $array["fname"] = $fname;
    $array["lname"] = $lname;
    $array["mobile"] = $mobile;
    $array["address"] = $uaddress;
    $array["city"] = $city;
    $array["mail"] = $email;
    $array["mid"] = $merchant_id;
    $array["msecret"] = $merchant_secret;
    $array["currency"] = $currency;
    $array["hash"] = $hash;

    echo (json_encode($array));
} else {
    echo ("No Address Found");
}
