<?php

include "connection.php";
$id = $_GET["id"];

Database::iud("DELETE FROM `cart` WHERE `cart_id` = '" . $id . "'");

echo ("Deleted");

?>
