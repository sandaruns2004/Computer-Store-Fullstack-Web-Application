<?php

include "connection.php";

$title = $_POST["t"];
$qty = $_POST["q"];
$desc = $_POST["d"];
$id = $_POST["id"];

Database::iud("UPDATE `product` SET `title` = '" . $title . "',`product_qty` = '" . $qty . "',`description` = '" . $desc . "' WHERE `id` = '" . $id . "'");
echo ("Updated");

$length = sizeof($_FILES);

if ($length <= 4 && $length > 0) {

    $allowed_img_extensions = array("image/jpeg", "image/png", "image/svg+xml", "image/jpg");

    $img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $id . "'");
    $img_num = $img_rs->num_rows;

    for ($a = 0; $a < $img_num; $a++) {
        $img_data = $img_rs->fetch_assoc();
        unlink($img_data["path"]);
        Database::iud("DELETE FROM `product_image` WHERE `product_id` = '" . $id . "'");
        echo ("Image deleted successfully.");
    }

    for ($x = 0; $x < $length; $x++) {
        if (isset($_FILES["images" . $x])) {
            $image_file = $_FILES["images" . $x];
            $file_extension = $image_file["type"];

            if (in_array($file_extension, $allowed_img_extensions)) {

                $new_image_extension;

                if ($file_extension == "image/jpeg") {
                    $new_image_extension = ".jpeg";
                } else if ($file_extension == "image/png") {
                    $new_image_extension = ".png";
                } else if ($file_extension == "image/svg+xml") {
                    $new_image_extension = ".svg";
                } else if ($file_extension == "image/jpg") {
                    $new_image_extension = ".jpg";
                }

                $file_name = "resources//product_images//" . $title . $x . rand() . $new_image_extension;
                move_uploaded_file($image_file["tmp_name"], $file_name);

                Database::iud("INSERT INTO `product_images` (`path`,`product_id`) VALUES ('" . $file_name . "','" . $id . "')");
                echo ("success");
            } else {
                echo ("Invalid Image Type.");
            }
        }
    }
} else {
    echo ("Invalid Image Count.");
}
