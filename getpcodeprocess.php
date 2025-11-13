<?php

include "connection.php";

$city = $_GET["c"];

$pcode_rs = Database::search("SELECT * FROM `cities` WHERE `city_id` = '". $city ."'");

$pcode_data = $pcode_rs->fetch_assoc();

echo ($pcode_data["postcode"]);



?>