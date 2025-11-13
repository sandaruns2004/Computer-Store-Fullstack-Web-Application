<?php

session_start();
include "connection.php";

$cart_count_rs = Database::search("SELECT * FROM `cart` WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "'");
$cart_count_num = $cart_count_rs->num_rows;

if ($cart_count_num == 0) {
    echo ("No Products found.");
} else {
    $cart_selected_rs = Database::search("SELECT * FROM `cart` WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "' ORDER BY `cart_date` DESC LIMIT 3 OFFSET 0");

    $cart_selected_num = $cart_selected_rs->num_rows;

    for ($x = 0; $x < $cart_selected_num; $x++) {

        $cart_selected_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON cart.cart_product_id = product.id WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "' ORDER BY `cart_date` DESC LIMIT 3 OFFSET 0");

        for ($x = 0; $x < $cart_selected_rs->num_rows; $x++) {
            $cart_selected_data = $cart_selected_rs->fetch_assoc();
?>
            <div class="col-lg-6 col-md-6">
                <?php
                $cimg_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $cart_selected_data["id"] . "'");
                $cimg_num = $cimg_rs->num_rows;
                $cimg_data = $cimg_rs->fetch_assoc();

                if ($cimg_num == 0) {
                ?>
                    <img src="./resources/no_image.svg" alt="">
                <?php
                } else {
                ?>
                    <img src="<?php echo ($cimg_data["path"]); ?>" alt="">
                <?php
                }

                ?>
            </div>
            <div class="col-lg-6 col-md-6">
                <p class="card-text p-1"><?php echo ($cart_selected_data["title"]); ?></p>
            </div>
<?php
        }
    }
}


?>