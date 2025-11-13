<?php

session_start();
include "connection.php";

$id = $_SESSION["u"]["id"];

$fname = $_POST["f"];
$lname = $_POST["l"];
$mobile = $_POST["m"];
$line1 = $_POST["l1"];
$line2 = $_POST["l2"];
$city = $_POST["c"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `id` = '" . $id . "'");

if ($user_rs->num_rows == 1) {
    Database::iud("UPDATE `user` SET `fname` = '" . $fname . "', `lname` = '" . $lname . "', `mobile` = '" . $mobile . "' WHERE `id` = '" . $id . "'");

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_id` = '" . $id . "'");

    if ($address_rs->num_rows == 1) {
        Database::iud("UPDATE `user_has_address` SET  `cities_city_id` = '" . $city . "', `line1` = '" . $line1 . "', `line2` = '" . $line2 . "' WHERE `user_id` = '" . $id . "'");
    } else {
        Database::iud("INSERT INTO `user_has_address` (`user_id`, `cities_city_id`, `line1`, `line2`) VALUES ('" . $id . "', '" . $city . "', '" . $line1 . "', '" . $line2 . "')");
    }

    if (sizeof($_FILES) == 1) {
        $image = $_FILES["i"];
        $image_extention = $image["type"];

        $allowed_image_extentions = array("image/jpeg", "image/png", "image/svg+xml", "image/jpg");

        if (in_array($image_extention, $allowed_image_extentions)) {
            $new_extention;

            if ($image_extention == "image/jpeg") {
                $new_extention = ".jpeg";
            } else if ($image_extention == "image/png") {
                $new_extention = ".png";
            } else if ($image_extention == "image/svg+xml") {
                $new_extention = ".svg";
            } else if ($image_extention == "image/jpg") {
                $new_extention = ".jpg";
            }

            $file_name = "resources//profile_images//" . $fname . "_" . uniqid() . $new_extention;
            move_uploaded_file($image["tmp_name"], $file_name);

            $image_rs = Database::search("SELECT * FROM `profile_images` WHERE `user_id` = '" . $id . "'");

            if ($image_rs->num_rows == 1) {
                Database::iud("UPDATE `profile_images` SET `path` = '" . $file_name . "' WHERE `user_id` = '" . $id . "'");
                echo ("Updated");
            } else {
                Database::iud("INSERT INTO `profile_images` (`path`,`user_id`) VALUES ('" . $file_name . "','" . $id . "')");
                echo ("Saved");
            }
        } else {
            echo ("Invalid Image Type.");
        }
    }
} else {
    echo ("Invalid User");
}
