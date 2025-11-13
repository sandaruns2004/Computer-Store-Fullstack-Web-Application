<?php
session_start();
if (isset($_SESSION["u"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Computer Store | Watchlist</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <link rel="icon" href="./resources/logo.svg">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    </head>

    <body>
        <?php include "header.php"; ?>
        <div class="container-fluid homebackground">
            <?php
            if (isset($_GET["wk"])) {
                $keyword = $_GET["wk"];
            ?>

                <!-- Title -->
                <div class="row">
                    <div class="col-12 mt-4 mb-2">
                        <h3 class="text-center subtopic">Watchlist</h3>
                    </div>
                </div>
                <!-- Title -->

                <!-- Search Box -->
                <div class="row justify-content-center">
                    <div class="col-10 col-md-6">
                        <div class="input-group mb-3 searchpanel">
                            <input type="text" class="form-control" value="<?php echo ($keyword); ?>" id="watchlist_search" aria-label="Search" aria-describedby="button-addon2">
                            <button class="searchbtn px-3" onclick="watchlistsearch();">Search</button>
                        </div>
                    </div>
                </div>
                <!-- Search Box -->
                <hr>
                <!-- Body Content -->
                <div class="container">
                    <div class="row p-2">

                        <!-- BeeadCrumb -->
                        <div class="col-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item" aria-current="page"><a href="watchlist.php">Watchlist</a></li>
                                    <li class="breadcrumb-item active">Related to "<?php echo ($keyword); ?>"</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- BeeadCrumb -->

                        <?php
                        $w_rs = Database::search("SELECT * FROM `watchlist` INNER JOIN `product` ON watchlist.product_id = product.id  WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' AND `title` LIKE '%" . $keyword . "%' ORDER BY `date` DESC");
                        $w_num = $w_rs->num_rows;
                        ?>

                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <!-- Sort Options -->
                                <div class="dropdown">
                                    <button class=" dropdown-toggle dropdownbtnsort"
                                        <?php
                                        if ($w_num == 0) {
                                        ?>
                                        disabled
                                        <?php
                                        }
                                        ?> id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sort By
                                    </button>
                                    <ul class="dropdown-menu sortdropdownul" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" onclick="sortwatchlist(1,'<?php echo ($keyword); ?>');">Price (Low to High)</a></li>
                                        <li><a class="dropdown-item" onclick="sortwatchlist(2,'<?php echo ($keyword); ?>');">Price (High to Low)</a></li>
                                        <li><a class="dropdown-item" onclick="sortwatchlist(3,'<?php echo ($keyword); ?>');">Popularity</a></li>
                                        <li><a class="dropdown-item" onclick="sortwatchlist(4,'<?php echo ($keyword); ?>');">Newest Arrivals</a></li>
                                    </ul>
                                </div>
                                <!-- Sort Options -->
                            </div>
                        </div>

                        <?php


                        if ($w_num == 0) {
                        ?>
                            <!-- Empty Design -->
                            <div class="col-12 mt-3">
                                <div class="justify-content-center align-items-center">
                                    <div class="empty-design">
                                        <i class="fas fa-shopping-bag fa-5x iconforemptyview"></i>
                                        <h4 class="text-center my-4">No Products Related to <?php echo ($keyword); ?></h4>
                                        <a class="text-center shopnowbtn" href="advancedsearchproducts.php">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Empty Design -->
                        <?php
                        } else {
                        ?>
                            <!-- Products in Watchlist -->
                            <div class="col-12">
                                <div class="row" id="watchlist_results">
                                    <?php

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
                                                        ?>
                                                            <button id="cart<?php echo ($product_id); ?>" class="btn btn-secondary 
                                                        <?php
                                                            if ($w_data["product_qty"] <= 0) {
                                                        ?>
                                                         d-none 
                                                        <?php
                                                            }
                                                        ?>
                                                                " title="Update Cart Quantity" onclick="addtocart(<?php echo ($product_id); ?>);">
                                                                <i id="carticon<?php echo ($product_id); ?>" class="fa-solid fa-cart-shopping" style="color:black;"></i>
                                                            </button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button id="cart<?php echo ($product_id); ?>" class="btn btn-secondary 
                                                        <?php
                                                            if ($w_data["product_qty"] <= 0) {
                                                        ?> 
                                                        d-none 
                                                        <?php
                                                            }
                                                        ?>" title="Add to Cart" onclick="addtocart(<?php echo ($product_id); ?>);"><i id="carticon<?php echo ($product_id); ?>" class="fa-solid fa-cart-plus"></i>
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
                                </div>
                            </div>
                            <!-- Products in Watchlist -->
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <!-- Body Content -->
            <?php
            } else {
                $keyword = " ";
            ?>
                <!-- Title -->
                <div class="row">
                    <div class="col-12 mt-4 mb-2">
                        <h3 class="text-center subtopic">Watchlist</h3>
                    </div>
                </div>
                <!-- Title -->

                <!-- Search Box -->
                <div class="row justify-content-center">
                    <div class="col-10 col-md-6">
                        <div class="input-group mb-3 searchpanel">
                            <input type="text" class="form-control" placeholder="Search for products..." id="watchlist_search" aria-label="Search" aria-describedby="button-addon2">
                            <button class="searchbtn px-3" onclick="watchlistsearch();">Search</button>
                        </div>
                    </div>
                </div>
                <!-- Search Box -->
                <hr>
                <!-- Body Content -->
                <div class="container">
                    <div class="row p-2">
                        <div class="col-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                </ol>
                            </nav>
                        </div>
                        <?php
                        $w_rs = Database::search("SELECT * FROM `watchlist` INNER JOIN `product` ON watchlist.product_id = product.id  WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' ORDER BY `date` DESC");
                        $w_num = $w_rs->num_rows;
                        ?>

                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <!-- Sort Options -->
                                <div class="dropdown">
                                    <button class=" dropdown-toggle dropdownbtnsort"
                                        <?php if ($w_num == 0) {
                                        ?>
                                        disabled
                                        <?php
                                        }
                                        ?> id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sort By
                                    </button>
                                    <ul class="dropdown-menu sortdropdownul" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" onclick="sortwatchlist(1,'<?php echo ($keyword); ?>');">Price (Low to High)</a></li>
                                        <li><a class="dropdown-item" onclick="sortwatchlist(2,'<?php echo ($keyword); ?>');">Price (High to Low)</a></li>
                                        <li><a class="dropdown-item" onclick="sortwatchlist(3,'<?php echo ($keyword); ?>');">Popularity</a></li>
                                        <li><a class="dropdown-item" onclick="sortwatchlist(4,'<?php echo ($keyword); ?>');">Newest Arrivals</a></li>
                                    </ul>
                                </div>
                                <!-- Sort Options -->
                            </div>
                        </div>
                        <?php
                        if ($w_num == 0) {
                        ?>
                            <!-- Empty Design -->
                            <div class="col-12 mt-3">
                                <div class="justify-content-center align-items-center">
                                    <div class="empty-design">
                                        <i class="fas fa-shopping-bag fa-5x iconforemptyview"></i>
                                        <h4 class="text-center my-4">No products in your watchlist.</h4>
                                        <a class="text-center shopnowbtn" href="advancedsearchproducts.php">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Empty Design -->
                        <?php
                        } else {
                        ?>
                            <!-- Products in Watchlist -->
                            <div class="col-12">
                                <div class="row" id="watchlist_results">
                                    <?php
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
                                                        ?>" title="Update Cart Quantity" onclick="addtocart(<?php echo ($product_id); ?>);">
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
                                                        ?> " title="Add to Cart" onclick="addtocart(<?php echo ($product_id); ?>);"><i id="carticon<?php echo ($product_id); ?>" class="fa-solid fa-cart-plus"></i>
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
                                </div>
                            </div>
                            <!-- Products in Watchlist -->
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <!-- Body Content -->
            <?php
            }
            ?>
        </div>

        <?php include "footer.php"; ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: index.php");
}
?>