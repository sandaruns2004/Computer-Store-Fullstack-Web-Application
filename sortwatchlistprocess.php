<?php

session_start();
include "connection.php";

$type = $_POST["t"];
$keyword = $_POST["wk"];

$q = "SELECT * FROM `watchlist` INNER JOIN `product` ON watchlist.product_id = product.id";

if ($keyword == " ") {
    $q .= " WHERE `user_id` = '" . $_SESSION["u"]["id"] . "'";
    if ($type == 1) {
        $q .= " ORDER BY `price`";
    } else if ($type == 2) {
        $q .= " ORDER BY `price` DESC";
    } else if ($type == 3) {
        $q .= "";
    } else if ($type == 4) {
        $q .= " ORDER BY `date` DESC";
    }
} else {
    $q .= " WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' AND `title` LIKE '%" . $keyword . "%'";
    if ($type == 1) {
        $q .= " ORDER BY `price`";
    } else if ($type == 2) {
        $q .= " ORDER BY `price` DESC";
    } else if ($type == 3) {
        $q .= "";
    } else if ($type == 4) {
        $q .= " ORDER BY `date` DESC";
    }
}

$w_rs = Database::search($q);
$w_num = $w_rs->num_rows;

for ($x = 0; $x < $w_num; $x++) {
    $w_data = $w_rs->fetch_assoc();
    $product_id = $w_data["product_id"];
?>
    <!-- Product Card -->
    <div class="col-6 col-md-4 col-lg-3 py-2">
        <div class="card">
            <div class="card-header cardtop">
                <?php
                $wimg_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $product_id . "'");
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
                <div class="overlay">
                    <button class="btn btn-secondary" onclick="opensingleproduct(<?php echo ($product_id); ?>,'<?php echo ($w_data['title']); ?>');" title="Quick View"><i class="fa-regular fa-eye"></i></button>
                    <?php
                    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "' AND `cart_product_id` = '" . $product_id . "'");

                    if ($cart_rs->num_rows > 0) {
                        //already added
                    ?>
                        <button id="cart<?php echo ($product_id); ?>" class="btn btn-secondary 
                                                        <?php
                                                        if ($w_data["product_qty"] <= 0) {
                                                        ?>
                                                         d-none 
                                                        <?php
                                                        }
                                                        ?> " title="Update Cart Quantity" onclick="addtocart(<?php echo ($product_id); ?>);">
                            <i id="carticon<?php echo ($product_id); ?>" class="fa-solid fa-cart-shopping" style="color:black;"></i>
                        </button>
                    <?php
                    } else {
                        //not added
                    ?>
                        <button id="cart<?php echo ($product_id); ?>" class="btn btn-secondary 
                                                        <?php
                                                        if ($w_data["product_qty"] <= 0) {
                                                        ?> 
                                                        d-none 
                                                        <?php
                                                        }
                                                        ?>" title="Add to Cart" onclick="addtocart(<?php echo ($product_id); ?>);">
                            <i id="carticon<?php echo ($product_id); ?>" class="fa-solid fa-cart-plus"></i>
                        </button>
                    <?php
                    }
                    ?>
                </div>
                <div class="close">
                    <button class="btn btn-secondary" title="Remove from Watchlist" onclick="removefromwishlist(<?php echo ($w_data['w_id']); ?>);"> <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body text-center">
                <h5 class="card-title fw-bold"><?php echo ($w_data["title"]); ?></h5>
                <?php
                if ($w_data["product_qty"] > 0) {
                ?>
                    <span class="card-text text-warning fw-bold">In Stock</span><br />
                    <span class="card-text text-warning fw-bold"><?php echo ($w_data["product_qty"]); ?> Items Available</span><br />
                <?php
                } else {
                ?>
                    <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                    <span class="card-text text-danger fw-bold">No Items Available</span><br />
                <?php
                }
                ?>
                <span class="card-text text-dark fw-bold">Rs.<?php echo ($w_data["price"]); ?>.00</span>
            </div>
        </div>
    </div>
    <!-- Product Card -->
<?php
}
?>