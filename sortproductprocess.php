<?php

session_start();
include "connection.php";

$keywordsort = $_POST["keyword"];
$typesort = $_POST["type"];
$minprice = $_POST["minprice"];
$maxprice = $_POST["maxprice"];
$qty1 = $_POST["qty1"];
$qty2 = $_POST["qty2"];
$qty3 = $_POST["qty3"];
$available = $_POST["available"];
$outofstock = $_POST["outofstock"];
$brandnew = $_POST["brandnew"];
$used = $_POST["used"];
if ($typesort == "2" || $typesort == "1") {
    $processor = $_POST["processor"];
    $gpu = $_POST["gpu"];
    $ram = $_POST["ram"];
}
$brand = $_POST["brand"];
$sortsort = $_POST["sort"];
$page_no = $_POST["page"];

$page_no;
if (isset($_POST["page"])) {
    if ("0" != $_POST["page"]) {
        $page_no = $_POST["page"];
    } else {
        $page_no = 1;
    }
} else {
    $page_no = 1;
}

$q = "SELECT * FROM `product` LEFT JOIN `product_details` ON product.product_details_product_details_id = product_details.product_details_id WHERE `price` BETWEEN '" . $minprice . "' AND '" . $maxprice . "'";

if ($keywordsort != "") {
    $q .= " AND `title` LIKE '%" . $keywordsort . "%'";
}

if ($typesort != 0) {
    $q .= " AND `category_category_id` = '" . $typesort . "'";
}

if ($qty1 == 1 && $qty2 == 0 && $qty3 == 0) {
    $q .= " AND `product_qty` <= 10 AND `product_qty` > 0";
}

if ($qty1 == 0 && $qty2 == 1 && $qty3 == 0) {
    $q .= " AND `product_qty` BETWEEN 10 AND 20";
}

if ($qty1 == 0 && $qty2 == 0 && $qty3 == 1) {
    $q .= " AND `product_qty` >= 20";
}

if ($qty1 == 1 && $qty2 == 1 && $qty3 == 0) {
    $q .= " AND `product_qty` < 20 AND `product_qty` > 0";
}

if ($qty1 == 0 && $qty2 == 1 && $qty3 == 1) {
    $q .= " AND `product_qty` > 10";
}

if ($qty1 == 1 && $qty2 == 0 && $qty3 == 1) {
    $q .= " AND `product_qty` <= 10 AND `product_qty` >= 20 AND `product_qty` > 0";
}

if ($available == 1) {
    $q .= " AND `product_qty` > 0";
}

if ($outofstock == 1) {
    $q .= " AND `product_qty` = 0";
}

if ($brandnew == 1) {
    $q .= " AND `condition_condition_id` = 1";
}

if ($used == 1) {
    $q .= " AND `condition_condition_id` = 2";
}

if ($brand != 0) {
    $q .= " AND `brand_brand_id` = $brand";
}

if ($typesort == "2" || $typesort == "1") {

    if ($processor != 0) {
        $q .= " AND `processor_processor_id` = $processor";
    }

    if ($gpu != 0) {
        $q .= " AND `gui_graphic_card_id` = $gpu";
    }

    if ($ram != 0) {
        $q .= " AND `ram_size` = $ram";
    }
}

if ($sortsort == 1) {
    $q .= " ORDER BY `price`";
}

if ($sortsort == 2) {
    $q .= " ORDER BY `price` DESC";
}

if ($sortsort == 4) {
    $q .= " ORDER BY `registered_date` DESC";
}

?>
<div class="row">
    <?php
    $selectedp_rs = Database::search($q);
    $selectedp_num = $selectedp_rs->num_rows;

    $results_per_page = 4;
    $number_of_pages = ceil($selectedp_num / $results_per_page);

    $previus_page_results = ($page_no - 1) * $results_per_page;

    $selected_product_rs = Database::search($q . " LIMIT " . $results_per_page . " OFFSET " . $previus_page_results . "");

    $selected_product_num = $selected_product_rs->num_rows;

    if ($selected_product_num == 0) {
        echo "<p class='text-center'>No products found.</p>";
    } else {
        for ($x = 0; $x < $selected_product_num; $x++) {
            $selected_product_data = $selected_product_rs->fetch_assoc();
    ?>
            <!-- Add products here -->
            <div class="col-6 col-md-4 col-lg-3 py-3">
                <div class="card h-100">
                    <div class="card-header cardtop">
                        <?php
                        $pimg_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $selected_product_data["id"] . "'");
                        $pimg_num = $pimg_rs->num_rows;
                        $pimg_data = $pimg_rs->fetch_assoc();

                        if ($pimg_num == 0) {
                        ?>
                            <img src="./resources/no_image.svg" alt="">
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo ($pimg_data["path"]); ?>" alt="">
                        <?php
                        }

                        ?>

                        <div class="overlay">
                            <button class="btn btn-secondary" onclick="opensingleproduct(<?php echo ($selected_product_data['id']); ?>,'<?php echo ($selected_product_data['title']); ?>');" title="Quick View"><i class="fa-regular fa-eye"></i></button>
                            <?php
                            if (isset($_SESSION["u"])) {
                                $w_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' AND `product_id` = '" . $selected_product_data['id'] . "'");

                                if ($w_rs->num_rows > 0) {
                            ?>
                                    <button id="wishlistbtn<?php echo ($selected_product_data['id']); ?>" class="btn btn-secondary"
                                        title="Remove from Wishlist" onclick="addtowishlist(<?php echo ($selected_product_data['id']); ?>);"><i id="wishlisticon<?php echo ($selected_product_data['id']); ?>" class="fa-solid fa-heart" style="color:red;"></i>
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <button id="wishlistbtn<?php echo ($selected_product_data['id']); ?>" class="btn btn-secondary"
                                        title="Add to Wishlist" onclick="addtowishlist(<?php echo ($selected_product_data['id']); ?>);"><i id="wishlisticon<?php echo ($selected_product_data['id']); ?>" class="fa-regular fa-heart"></i>
                                    </button>
                                <?php
                                }

                                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "' AND `cart_product_id` = '" . $selected_product_data['id'] . "'");

                                if ($cart_rs->num_rows > 0) {
                                    //already added
                                ?>
                                    <button id="cart<?php echo ($selected_product_data['id']); ?>" class="btn btn-secondary 
                                                                <?php
                                                                if ($selected_product_data["product_qty"] <= 0) {
                                                                ?>
                                                                 d-none 
                                                                <?php
                                                                }
                                                                ?>
                                                                        "
                                        title="Update Cart Quantity" onclick="addtocart(<?php echo ($selected_product_data['id']); ?>);"><i id="carticon<?php echo ($selected_product_data['id']); ?>" class="fa-solid fa-cart-shopping" style="color:black;"></i>
                                    </button>
                                <?php
                                } else {
                                    //not added
                                ?>
                                    <button id="cart<?php echo ($selected_product_data['id']); ?>" class="btn btn-secondary 
                                                                <?php
                                                                if ($selected_product_data["product_qty"] <= 0) {
                                                                ?> 
                                                                d-none 
                                                                <?php
                                                                }
                                                                ?>
                                                                        "
                                        title="Add to Cart" onclick="addtocart(<?php echo ($selected_product_data['id']); ?>);"><i id="carticon<?php echo ($selected_product_data['id']); ?>" class="fa-solid fa-cart-plus"></i>
                                    </button>
                                <?php
                                }

                                ?>

                            <?php
                            } else {
                            ?>
                                <button class="btn btn-secondary disabled" style="color:#434040;"
                                    title="Add to Wishlist"><i class="fa-regular fa-heart"></i>
                                </button>
                                <button class="btn btn-secondary disabled" style="color:#434040;"
                                    title="Add to Cart"><i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            <?php
                            }

                            ?>


                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold"><?php echo ($selected_product_data["title"]); ?></h5>
                        <?php
                        if ($selected_product_data["product_qty"] > 0) {
                        ?>
                            <span class="card-text text-warning fw-bold">In Stock</span><br />
                            <span class="card-text text-warning fw-bold"><?php echo ($selected_product_data["product_qty"]); ?> Items Available</span><br />
                        <?php
                        } else {
                        ?>
                            <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                            <span class="card-text text-danger fw-bold">No Items Available</span><br />
                        <?php
                        }
                        ?>
                        <span class="card-text text-dark fw-bold">Rs.<?php echo ($selected_product_data["price"]); ?>.00</span>
                    </div>
                </div>
            </div>
            <!-- Add products here -->
    <?php
        }
    }

    ?>

</div>
<!-- Pagination -->
<nav>
    <ul class="pagination d-flex justify-content-center flex-wrap pagination-rounded-flat pagination-success">
        <?php
        if ($page_no > 1) {
        ?>
            <li class="page-item"><a class="page-link" onclick="sortproduct('<?php echo ($keywordsort); ?>','<?php echo ($typesort); ?>',<?php echo ($sortsort); ?>,<?php echo ($page_no - 1) ?>)" href="#" data-abc="true"><i class="fa fa-angle-left"></i></a></li>
        <?php
        } else {
        ?>
            <li class="page-item disabled opacity-50" disabled><a class="page-link disabled" disabled href="#" data-abc="true"><i class="fa fa-angle-left"></i></a></li>
        <?php
        }
        ?>
        <?php
        for ($x = 1; $x < $number_of_pages + 1; $x++) {
            if ($page_no == $x) {
        ?>
                <li class="page-item active"><a class="page-link" href="#" onclick="sortproduct('<?php echo ($keywordsort); ?>','<?php echo ($typesort); ?>','<?php echo ($sortsort); ?>',<?php echo ($x); ?>);" data-abc="true"><?php echo ($x); ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" href="#" onclick="sortproduct('<?php echo ($keywordsort); ?>','<?php echo ($typesort); ?>','<?php echo ($sortsort); ?>',<?php echo ($x); ?>);" data-abc="true"><?php echo ($x); ?></a></li>
        <?php
            }
        }
        ?>
        <?php
        if ($page_no < $number_of_pages) {
        ?>
            <li class="page-item"><a class="page-link" onclick="sortproduct('<?php echo ($keywordsort); ?>','<?php echo ($typesort); ?>','<?php echo ($sortsort); ?>',<?php echo ($page_no + 1) ?>)" href="#" data-abc="true"><i class="fa fa-angle-right"></i></a></li>
        <?php
        } else {
        ?>
            <li class="page-item disabled opacity-50" disabled><a class="page-link disabled" disabled href="#" data-abc="true"><i class="fa fa-angle-right"></i></a></li>
        <?php
        }
        ?>
    </ul>
</nav>
<!-- Pagination -->
<?php

?>