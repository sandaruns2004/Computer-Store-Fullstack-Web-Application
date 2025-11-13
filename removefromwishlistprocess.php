<?php

include "connection.php";
$id = $_GET["id"];

Database::iud("DELETE FROM `watchlist` WHERE `w_id` = '" . $id . "'");

echo ("Removed");

?>
