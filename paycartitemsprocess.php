<?php

session_start();
include "connection.php";

$cart_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON cart.cart_product_id = product.id WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "'");
$cart_num = $cart_rs->num_rows;

$totalprice = 0;
$totalshipping = 0;

if ($cart_num != 0) {
    for ($x = 0; $x < $cart_num; $x++) {
        $cart_data = $cart_rs->fetch_assoc();
        $oneprice = $cart_data["cart_qty"] * $cart_data["price"];
        $totalprice += $oneprice;
        $oneshipping = $cart_data["delevery_fee"] * $cart_data["cart_qty"];
        $totalshipping += $oneshipping;
    }
    $totalamount = $totalprice + $totalshipping;
    $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `cities` ON user_has_address.cities_city_id = cities.city_id WHERE `user_id` = '" . $_SESSION["u"]["id"] . "'");
    
    if($address_rs->num_rows != 0){
        $address_data = $address_rs->fetch_assoc();
    $address = $address_data["line1"] . ", " . $address_data["line2"];

    $array;

    $email = $_SESSION["u"]["email"];
    $item = uniqid();
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
    }else{
        echo ("No Address Found");
    }

} else {
    echo ("Empty Cart");
}
