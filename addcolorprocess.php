<?php

include "connection.php";
$color_name = $_POST["cn"];
$color_code = $_POST["cc"];

$color_rs = Database::search("SELECT * FROM `color` WHERE `color_name` LIKE '%" . $color_name . "%' OR `color_code` = '" . $color_code . "'");

if (empty($color_name)) {
    echo ("Please Enter Color Name");
} else {

    if ($color_rs->num_rows <= 0) {

        Database::iud("INSERT INTO `color` (`color_name`, `color_code`) VALUES ('" . $color_name . "','" . $color_code . "')");

        echo ("Color Added Successfully");
    } else if ($color_rs->num_rows > 0) {

        echo ("The Color is already in the List");
    }
}
