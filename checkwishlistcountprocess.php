<?php

session_start();
include "connection.php";

$w_count_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "'");
$w_count_num = $w_count_rs->num_rows;

if ($w_count_num == 0) {
    echo ("No Products found.");
} else {
    $w_selected_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' ORDER BY `date` DESC LIMIT 3 OFFSET 0");

    for ($x = 0; $x < $w_selected_rs->num_rows; $x++) {
?>
        <!-- Design for show watchlist items in header -->
        <?php
        $w_selected_rs = Database::search("SELECT * FROM `watchlist`INNER JOIN `product` ON watchlist.product_id = product.id WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' ORDER BY `date` DESC LIMIT 3 OFFSET 0");


        for ($x = 0; $x < $w_selected_rs->num_rows; $x++) {
            $w_selected_data = $w_selected_rs->fetch_assoc();
        ?>
            <div class="col-lg-6 col-md-6">
                <?php
                $wimg_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $w_selected_data["id"] . "'");
                $wimg_num = $wimg_rs->num_rows;
                $wimg_data = $wimg_rs->fetch_assoc();

                if ($wimg_num == 0) {
                ?>
                    <img src="./resources/no_image.svg" alt="">
                <?php
                } else {
                ?>
                    <img src="<?php echo ($wimg_data["path"]); ?>" alt="">
                <?php
                }

                ?>
            </div>
            <div class="col-lg-6 col-md-6">
                <p class="card-text p-1"><?php echo ($w_selected_data["title"]); ?></p>
            </div>

        <?php

        }
        ?>
<?php
    }
}
