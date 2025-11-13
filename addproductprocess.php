<?php

session_start();
include "connection.php";

$id = $_SESSION["u"]["id"];
$category = $_POST["c"];
$processor = $_POST["p"];
$gpu = $_POST["g"];
$ram = $_POST["r"];
$title = $_POST["t"];
$brand = $_POST["b"];
$price = $_POST["pr"];
$deleveryfee = $_POST["df"];
$qty = $_POST["q"];
$condition = $_POST["co"];
$color = $_POST["cl"];
$description = $_POST["d"];

$length = sizeof($_FILES);

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;

if ($category == 1 || $category == 2) {
    //laptop or desktop

    if ($processor == 0 || $gpu == 0 || $ram == 0) {
        echo ("Please Select Laptop or Desktop Specifications.");
    } else if (empty($title)) {
        echo ("Please Enter Product Title.");
    } else if (strlen($title) > 100) {
        echo ("Product Title must contain LOWER THAN 100 Characters.");
    } else if ($brand == 0) {
        echo ("Please Select Brand.");
    } else if (empty($price)) {
        echo ("Please Enter Product Price.");
    } else if (!is_numeric($price)) {
        echo ("Product Price must be a Number.");
    } else if (empty($deleveryfee)) {
        echo ("Please Enter Product Delivery Cost.");
    } else if (!is_numeric($deleveryfee)) {
        echo ("Product Delevery Cost must be a Number.");
    } else if (empty($qty)) {
        echo ("Please Enter Product Quantity.");
    } else if ($color == 0) {
        echo ("Please Select Product Color.");
    } else if (empty($description)) {
        echo ("Please Enter Product Description.");
    } else {
        $product_details_id;
        $product_details_rs = Database::search("SELECT * FROM `product_details` WHERE `processor_processor_id` = '" . $processor . "' && `gui_graphic_card_id` = '" . $gpu . "' && `ram_size` = '" . $ram . "'");

        if ($product_details_rs->num_rows == 1) {
            $product_details_data = $product_details_rs->fetch_assoc();
            $product_details_id = $product_details_data["product_details_id"];
        } else {
            Database::iud("INSERT INTO `product_details` (`gui_graphic_card_id`,`processor_processor_id`,`ram_size`) VALUES ('" . $gpu . "','" . $processor . "','" . $ram . "')");
            $product_details_id = Database::$connection->insert_id;
        }

        Database::iud("INSERT INTO `product` (`title`,`price`,`delevery_fee`,`description`,`status_id`,`category_category_id`,`product_details_product_details_id`,`brand_brand_id`,`registered_date`,`color_color_code`,`product_qty`,`user_product_id`,`condition_condition_id`) 
        VALUES ('" . $title . "','" . $price . "','" . $deleveryfee . "','" . $description . "','" . $status . "','" . $category . "','" . $product_details_id . "','" . $brand . "','" . $date . "','" . $color . "','" . $qty . "','" . $id . "','" . $category . "')");

        $product_id = Database::$connection->insert_id;

        if ($length <= 4 && $length > 0) {

            $allowed_img_extensions = array("image/jpeg", "image/png", "image/svg+xml", "image/jpg");

            for ($x = 0; $x < $length; $x++) {
                if (isset($_FILES["i" . $x])) {
                    $image_file = $_FILES["i" . $x];
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

                        Database::iud("INSERT INTO `product_images` (`path`,`product_id`) VALUES ('" . $file_name . "','" . $product_id . "')");
                        echo ("success");
                    } else {
                        echo ("Invalid Image Type.");
                    }
                }
            }
        } else {
            echo ("Invalid Image Count.");
        }
    }
} else if ($category != 0 && $category != 1 && $category != 2) {
    //other devices

    if (empty($title)) {
        echo ("Please Enter Product Title.");
    } else if (strlen($title) > 100) {
        echo ("Product Title must contain LOWER THAN 100 Characters.");
    } else if ($brand == 0) {
        echo ("Please Select Brand.");
    } else if (empty($price)) {
        echo ("Please Enter Product Price.");
    } else if (!is_numeric($price)) {
        echo ("Product Price must be a Number.");
    } else if (empty($deleveryfee)) {
        echo ("Please Enter Product Delivery Cost.");
    } else if (!is_numeric($deleveryfee)) {
        echo ("Product Delevery Cost must be a Number.");
    } else if (empty($qty)) {
        echo ("Please Enter Product Quantity.");
    } else if ($color == 0) {
        echo ("Please Select Product Color.");
    } else if (empty($description)) {
        echo ("Please Enter Product Description.");
    } else {

        Database::iud("INSERT INTO `product` (`title`,`price`,`delevery_fee`,`description`,`status_id`,`category_category_id`,`brand_brand_id`,`registered_date`,`color_color_code`,`user_product_id`,`condition_condition_id`) 
        VALUES ('" . $title . "','" . $price . "','" . $deleveryfee . "','" . $description . "','" . $status . "','" . $category . "','" . $brand . "','" . $date . "','" . $color . "','" . $id . "','" . $category . "')");

        $product_id = Database::$connection->insert_id;

        if ($length <= 4 && $length > 0) {

            $allowed_img_extensions = array("image/jpeg", "image/png", "image/svg+xml", "image/jpg");

            for ($x = 0; $x < $length; $x++) {
                if (isset($_FILES["i" . $x])) {
                    $image_file = $_FILES["i" . $x];
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

                        Database::iud("INSERT INTO `product_images` (`path`,`product_id`) VALUES ('" . $file_name . "','" . $product_id . "')");
                        echo ("success");
                    } else {
                        echo ("Invalid Image Type.");
                    }
                }
            }
        } else {
            echo ("Invalid Image Count.");
        }
    }
} else if ($category == 0) {
    echo ("Please Select Category.");
}
