<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Store | Store</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="icon" href="./resources/logo.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <?php
    session_start();
    include "header.php";
    ?>
    <div class="container-fluid homebackground">
        <div class="col-12 justify-content-center">
            <div class="row p-1">
                <div class="col-lg-2 col-md-3">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <p class="text-center txt2">Filters</p>
                        </div>
                    </div>
                    <!-- Add sort panel here -->
                    <div class="row border border-1 filterbackground">
                        <div class="col-12 g-3">
                            <?php
                            if (isset($_GET["k"]) || isset($_GET["c"])) {
                                $k = $_GET["k"];
                                $c = $_GET["c"];
                            } else {
                                $k = "";
                                $c = 0;
                            }
                            $processor_js_rs = Database::search("SELECT * FROM `processor`");
                            $gpu_js_rs = Database::search("SELECT * FROM `gui`");
                            $brand_rs = Database::search("SELECT * FROM `brand`");
                            $processor_js_num = $processor_js_rs->num_rows;
                            $gpu_js_num = $gpu_js_rs->num_rows;
                            $brand_num = $brand_rs->num_rows;
                            ?>
                            <!-- Filter By Price -->
                            <div class="d-none">
                                <h1 id="processor_count"><?php echo ($processor_js_num); ?></h1>
                                <h1 id="gpu_count"><?php echo ($gpu_js_num); ?></h1>
                                <h1 id="brand_count"><?php echo ($brand_num); ?></h1>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center filtertopics">Filter By Price</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min" min="0" max="1000000" value="0">
                                        <input type="range" class="range-max" min="0" max="1000000" value="1000000">
                                    </div>
                                    <div class="pricelabel">
                                        <p class="text-center mt-2">
                                            Rs.<span class="minprice" id="minprice">0</span>
                                            - Rs. <span class="maxprice" id="maxprice">1000000</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="pricerangefilterbtn" onclick="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">Filter</button>
                                </div>
                            </div>
                            <hr>

                            <!-- Filter By Qty -->
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center filtertopics">Filter By Quantity</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="quantity" id="qty1" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                        <label class="form-check-label" for="qty1">less than 10</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="quantity" id="qty2" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                        <label class="form-check-label" for="qty2">10 - 20</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="quantity" id="qty3" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                        <label class="form-check-label" for="qty3">more than 20</label>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <!-- Stock Status -->
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center filtertopics">Stock Status</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="stockstatus" id="stockavailable" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                        <label class="form-check-label" for="stockavailable">Available</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="stockstatus" id="stockoutofstock" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                        <label class="form-check-label" for="stockoutofstock">Out of Stock</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- Filter By Condition -->

                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center filtertopics">Filter By Condition</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="condition" id="brandnew" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                        <label class="form-check-label" for="brandnew">Brand New</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="condition" id="used" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                        <label class="form-check-label" for="used">Used</label>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <?php
                            if (isset($_GET["c"])) {
                                if ($_GET["c"] == 1 || $_GET["c"] == 2) {
                            ?>
                                    <!-- Filter By Processor -->

                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-center filtertopics">Filter By Processor</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row filterprocessor g-3">
                                                <?php
                                                $processor_rs = Database::search("SELECT * FROM `processor`");
                                                for ($x = 0; $x < $processor_rs->num_rows; $x++) {
                                                    $processor_data = $processor_rs->fetch_assoc();
                                                ?>
                                                    <div class="col-12">
                                                        <input class="form-check-input" type="radio" name="processor" id="processor<?php echo ($processor_data["processor_id"]); ?>" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                                        <label class="form-check-label" for="processor<?php echo ($processor_data["processor_id"]); ?>"><?php echo ($processor_data["processor_name"]); ?></label>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <!-- Filter By GPU -->

                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-center filtertopics">Filter By GPU</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row filtergpu g-3">
                                                <?php
                                                $gpu_rs = Database::search("SELECT * FROM `gui`");
                                                for ($x = 0; $x < $gpu_rs->num_rows; $x++) {
                                                    $gpu_data = $gpu_rs->fetch_assoc();
                                                ?>
                                                    <div class="col-6">
                                                        <input class="form-check-input" type="radio" name="gui" id="gpu<?php echo ($gpu_data["graphic_card_id"]); ?>" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                                        <label class="form-check-label" for="gpu<?php echo ($gpu_data["graphic_card_id"]); ?>"><?php echo ($gpu_data["graphic_card_name"]); ?></label>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- Filter By RAM -->

                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-center filtertopics">Filter By RAM</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row filterram g-3">
                                                <div class="col-4">
                                                    <input class="form-check-input" type="radio" name="ram" id="ram1" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                                    <label class="form-check-label" for="ram1">2GB</label>
                                                </div>
                                                <div class="col-4">
                                                    <input class="form-check-input" type="radio" name="ram" id="ram2" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                                    <label class="form-check-label" for="ram2">4GB</label>
                                                </div>
                                                <div class="col-4">
                                                    <input class="form-check-input" type="radio" name="ram" id="ram3" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                                    <label class="form-check-label" for="ram3">6GB</label>
                                                </div>
                                                <div class="col-4">
                                                    <input class="form-check-input" type="radio" name="ram" id="ram4" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                                    <label class="form-check-label" for="ram4">8GB</label>
                                                </div>
                                                <div class="col-4">
                                                    <input class="form-check-input" type="radio" name="ram" id="ram5" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                                    <label class="form-check-label" for="ram5">16GB</label>
                                                </div>
                                                <div class="col-4">
                                                    <input class="form-check-input" type="radio" name="ram" id="ram6" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                                    <label class="form-check-label" for="ram6">32GB</label>
                                                </div>
                                                <div class="col-4">
                                                    <input class="form-check-input" type="radio" name="ram" id="ram7" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                                    <label class="form-check-label" for="ram7">64GB</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                            <?php
                                }
                            }
                            ?>



                            <!-- Filter By Brand -->
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center filtertopics">Filter By Brand</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="row filterbrand g-3">
                                        <?php
                                        $brand_rs = Database::search("SELECT * FROM `brand`");
                                        for ($x = 0; $x < $brand_rs->num_rows; $x++) {
                                            $brand_data = $brand_rs->fetch_assoc();
                                        ?>
                                            <div class="col-4">
                                                <input type="radio" name="brand" class="d-none" id="brand<?php echo ($brand_data["brand_id"]); ?>" onchange="sortproduct('<?php echo ($k); ?>','<?php echo ($c); ?>',0,0);">
                                                <label for="brand<?php echo ($brand_data["brand_id"]); ?>">
                                                    <img class="p-1" src="<?php echo ($brand_data["brand_logo_path"]); ?>" id="brandimg<?php echo ($brand_data["brand_id"]); ?>">
                                                </label>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
                if (isset($_GET["k"]) || isset($_GET["c"])) {
                    $selected_category_rs = Database::search("SELECT * FROM `category` WHERE `category_id` = '" . $_GET["c"] . "'");
                    $selected_category_data = $selected_category_rs->fetch_assoc();

                    $pageno;

                    if (isset($_GET["p"])) {
                        if ("0" != $_GET["p"]) {
                            $pageno = $_GET["p"];
                        } else {
                            $pageno = 1;
                        }
                    } else {
                        $pageno = 1;
                    }

                    $keyword = $_GET["k"];
                    $category_id = $_GET["c"];

                    $q = "SELECT * FROM `product`";

                    if ($keyword != "" && $category_id == 0) {
                        //keyword already
                        $q .= " WHERE `title` LIKE '%" . $keyword . "%'";
                    } else if ($keyword == "" && $category_id != 0) {
                        //category already
                        $q .= " WHERE `category_category_id` = '" . $category_id . "'";
                    } else if ($keyword != "" && $category_id != 0) {
                        $q .= " WHERE `category_category_id` = '" . $category_id . "' AND `title` LIKE '%" . $keyword . "%'";
                    }

                    $product_rs = Database::search($q);
                    $product_num = $product_rs->num_rows;

                    $results_per_page = 4;
                    $number_of_pages = ceil($product_num / $results_per_page);
                    $before_page_results = ($pageno - 1) * $results_per_page;

                    $selected_product_rs = Database::search($q . " LIMIT " . $results_per_page . " OFFSET " . $before_page_results . "");
                    $selected_product_num = $selected_product_rs->num_rows;
                ?>
                    <div class="col-12 col-md-9 col-lg-10 ">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <p class="text-center txt2">
                                    Search Results
                                    <?php
                                    if ($_GET["k"] != "") {
                                        echo (" Related to " . '"' . $_GET["k"] . '"');
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                        <!-- Search Box with Category -->
                        <div class="row justify-content-center pt-4">
                            <div class="col-12 col-md-10">
                                <div class="input-group mb-3 searchpanel">
                                    <input type="text" class="form-control" placeholder="Search for products" id="searchbox" aria-label="Search" aria-describedby="button-addon2">
                                    <select class="px-3" id="category">
                                        <option value="0">Categories...</option>
                                        <?php
                                        $category_rs = Database::search("SELECT * FROM `category`");
                                        $category_num = $category_rs->num_rows;
                                        for ($i = 0; $i < $category_num; $i++) {
                                            $category_data = $category_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo ($category_data["category_id"]); ?>"
                                                <?php
                                                if ($_GET["c"] == $category_data["category_id"]) {
                                                ?>
                                                selected
                                                <?php
                                                }
                                                ?>>
                                                <?php echo ($category_data["category_name"]); ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <button class="searchbtn px-3" onclick="basicsearch(0);">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-8">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                        <?php
                                        if ($_GET["k"] != "" && $_GET["c"] == 0) {
                                        ?>
                                            <li class="breadcrumb-item" aria-current="page"><a href="advancedsearchproducts.php">Store</a></li>
                                            <li class="breadcrumb-item active">Related to "<?php echo ($_GET["k"]); ?>"</li>
                                        <?php
                                        } else if ($_GET["k"] == "" && $_GET["c"] != 0) {
                                        ?>
                                            <li class="breadcrumb-item"><a href="advancedsearchproducts.php">Store</a></li>
                                            <li class="breadcrumb-item active"><?php echo ($selected_category_data["category_name"]); ?></li>
                                        <?php
                                        } elseif ($_GET["k"] != "" && $_GET["c"] != 0) {
                                        ?>
                                            <li class="breadcrumb-item"><a href="advancedsearchproducts.php">Store</a></li>
                                            <li class="breadcrumb-item active"><?php echo ($selected_category_data["category_name"]); ?></li>
                                        <?php
                                        }
                                        ?>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <!-- Add sort options here -->
                                    <div class="dropdown">
                                        <button class=" dropdown-toggle dropdownbtnsort"
                                            <?php
                                            if ($selected_product_num == 0) {
                                                echo "disabled";
                                            }
                                            ?>
                                            type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Sort By
                                        </button>
                                        <ul class="dropdown-menu sortdropdownul" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" onclick="sortproduct('<?php echo ($keyword); ?>',<?php echo ($category_id); ?>,1,0);">Price (Low to High)</a></li>
                                            <li><a class="dropdown-item" onclick="sortproduct('<?php echo ($keyword); ?>',<?php echo ($category_id); ?>,2,0);">Price (High to Low)</a></li>
                                            <li><a class="dropdown-item" onclick="sortproduct('<?php echo ($keyword); ?>',<?php echo ($category_id); ?>,3,0);">Popularity</a></li>
                                            <li><a class="dropdown-item" onclick="sortproduct('<?php echo ($keyword); ?>',<?php echo ($category_id); ?>,4,0);">Newest Arrivals</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Search Box with Category -->
                        <div class="card-deck" id="search_results">
                            <div class="row">
                                <?php

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
                                <ul class="pagination d-flex justify-content-center flex-wrap pagination-rounded-flat my-4">
                                    <?php
                                    if ($pageno > 1) {
                                    ?>
                                        <li class="page-item"><a class="page-link" href="
                                        <?php
                                        echo ("?k=" . $keyword . "&c=" . $category_id . "&p=" . ($pageno - 1));
                                        ?>" data-abc="true"><i class="fa fa-angle-left"></i></a></li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item disabled opacity-50" disabled><a class="page-link disabled" disabled href="#" data-abc="true"><i class="fa fa-angle-left"></i></a></li>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    for ($x = 1; $x < $number_of_pages + 1; $x++) {
                                        if ($pageno == $x) {
                                    ?>
                                            <li class="page-item active"><a class="page-link" href=" 
                                            <?php
                                            echo ("?k=" . $keyword . "&c=" . $category_id . "&p=" . ($x));
                                            ?>
                                            " data-abc="true"><?php echo ($x); ?></a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="page-item"><a class="page-link" href="
                                            <?php
                                            echo ("?k=" . $keyword . "&c=" . $category_id . "&p=" . ($x));
                                            ?>
                                            " data-abc="true"><?php echo ($x); ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    if ($pageno < $number_of_pages) {
                                    ?>
                                        <li class="page-item"><a class="page-link" href="
                                        <?php
                                        echo ("?k=" . $keyword . "&c=" . $category_id . "&p=" . ($pageno + 1));
                                        ?>
                                        " data-abc="true"><i class="fa fa-angle-right"></i></a></li>
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
                        </div>

                    </div>
                <?php
                } else {
                    $kword = "";
                    $cid = 0;
                    $pageno;
                    if (isset($_POST["p"])) {
                        if ("0" != $_POST["p"]) {
                            $pageno = $_POST["p"];
                        } else {
                            $pageno = 1;
                        }
                    } else {
                        $pageno = 1;
                    }
                    $q = "SELECT * FROM `product`";
                    $p_rs = Database::search($q);
                    $p_num = $p_rs->num_rows;

                    $results_per_page = 4;
                    $number_of_pages = ceil($p_num / $results_per_page);

                    $previus_page_results = ($pageno - 1) * $results_per_page;

                    $product_rs = Database::search($q . " LIMIT " . $results_per_page . " OFFSET " . $previus_page_results . "");

                    $product_num = $product_rs->num_rows;
                ?>
                    <div class="col-12 col-md-9 col-lg-10 ">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <p class="text-center txt2">Computer Store</p>
                            </div>
                        </div>
                        <!-- Search Box with Category -->
                        <div class="row justify-content-center pt-4">
                            <div class="col-12 col-md-10">
                                <div class="input-group mb-3 searchpanel">
                                    <input type="text" class="form-control" placeholder="Search for products" id="searchbox" aria-label="Search" aria-describedby="button-addon2">
                                    <select class="px-3" id="category">
                                        <option value="0">Categories...</option>
                                        <?php
                                        $category_rs = Database::search("SELECT * FROM `category`");
                                        $category_num = $category_rs->num_rows;
                                        for ($i = 0; $i < $category_num; $i++) {
                                            $category_data = $category_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo ($category_data["category_id"]); ?>">
                                                <?php echo ($category_data["category_name"]); ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <button class="searchbtn px-3" onclick="basicsearch(0);">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-8">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Store</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <!-- Add sort options here -->
                                    <div class="dropdown">
                                        <button class=" dropdown-toggle dropdownbtnsort"
                                            <?php
                                            if ($product_num == 0) {
                                                echo "disabled";
                                            }
                                            ?>
                                            type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Sort By
                                        </button>
                                        <ul class="dropdown-menu sortdropdownul" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" onclick="sortproduct('<?php echo ($kword); ?>','<?php echo ($cid); ?>',1,0);">Price (Low to High)</a></li>
                                            <li><a class="dropdown-item" onclick="sortproduct('<?php echo ($kword); ?>','<?php echo ($cid); ?>',2,0);">Price (High to Low)</a></li>
                                            <li><a class="dropdown-item" onclick="sortproduct('<?php echo ($kword); ?>','<?php echo ($cid); ?>',3,0);">Popularity</a></li>
                                            <li><a class="dropdown-item" onclick="sortproduct('<?php echo ($kword); ?>','<?php echo ($cid); ?>',4,0);">Newest Arrivals</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Search Box with Category -->
                        <div class="card-deck" id="search_results">
                            <div class="row">
                                <?php


                                if ($product_num == 0) {
                                    echo "<div class='col-12 text-center'>No products found.</div>";
                                } else {
                                    for ($x = 0; $x < $product_num; $x++) {
                                        $product_data = $product_rs->fetch_assoc();
                                ?>
                                        <!-- Add products here -->
                                        <div class="col-6 col-md-4 col-lg-3 py-3">
                                            <div class="card h-100">
                                                <div class="card-header cardtop">
                                                    <?php
                                                    $pimg_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $product_data["id"] . "'");
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
                                                        <button class="btn btn-secondary" onclick="opensingleproduct(<?php echo ($product_data['id']); ?>,'<?php echo ($product_data['title']); ?>');" title="Quick View"><i class="fa-regular fa-eye"></i></button>
                                                        <?php
                                                        if (isset($_SESSION["u"])) {
                                                            $w_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' AND `product_id` = '" . $product_data['id'] . "'");

                                                            if ($w_rs->num_rows > 0) {
                                                        ?>
                                                                <button id="wishlistbtn<?php echo ($product_data['id']); ?>" class="btn btn-secondary"
                                                                    title="Remove from Wishlist" onclick="addtowishlist(<?php echo ($product_data['id']); ?>);"><i id="wishlisticon<?php echo ($product_data['id']); ?>" class="fa-solid fa-heart" style="color:red;"></i>
                                                                </button>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <button id="wishlistbtn<?php echo ($product_data['id']); ?>" class="btn btn-secondary"
                                                                    title="Add to Wishlist" onclick="addtowishlist(<?php echo ($product_data['id']); ?>);"><i id="wishlisticon<?php echo ($product_data['id']); ?>" class="fa-regular fa-heart"></i>
                                                                </button>
                                                            <?php
                                                            }

                                                            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "' AND `cart_product_id` = '" . $product_data['id'] . "'");

                                                            if ($cart_rs->num_rows > 0) {
                                                                //already added
                                                            ?>
                                                                <button id="cart<?php echo ($product_data['id']); ?>" class="btn btn-secondary 
                                                                <?php
                                                                if ($product_data["product_qty"] <= 0) {
                                                                ?>
                                                                 d-none 
                                                                <?php
                                                                }
                                                                ?>
                                                                        "
                                                                    title="Update Cart Quantity" onclick="addtocart(<?php echo ($product_data['id']); ?>);"><i id="carticon<?php echo ($product_data['id']); ?>" class="fa-solid fa-cart-shopping" style="color:black;"></i>
                                                                </button>
                                                            <?php
                                                            } else {
                                                                //not added
                                                            ?>
                                                                <button id="cart<?php echo ($product_data['id']); ?>" class="btn btn-secondary 
                                                                <?php
                                                                if ($product_data["product_qty"] <= 0) {
                                                                ?> 
                                                                d-none 
                                                                <?php
                                                                }
                                                                ?>
                                                                        "
                                                                    title="Add to Cart" onclick="addtocart(<?php echo ($product_data['id']); ?>);"><i id="carticon<?php echo ($product_data['id']); ?>" class="fa-solid fa-cart-plus"></i>
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
                                                    <h5 class="card-title fw-bold"><?php echo ($product_data["title"]); ?></h5>
                                                    <?php
                                                    if ($product_data["product_qty"] > 0) {
                                                    ?>
                                                        <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                        <span class="card-text text-warning fw-bold"><?php echo ($product_data["product_qty"]); ?> Items Available</span><br />
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                                                        <span class="card-text text-danger fw-bold">No Items Available</span><br />
                                                    <?php
                                                    }
                                                    ?>
                                                    <span class="card-text text-dark fw-bold">Rs.<?php echo ($product_data["price"]); ?>.00</span>
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
                                    if ($pageno > 1) {
                                    ?>
                                        <li class="page-item"><a class="page-link" onclick="sortproduct('<?php echo ($kword); ?>','<?php echo ($cid); ?>',0,<?php echo ($pageno - 1) ?>)" href="#" data-abc="true"><i class="fa fa-angle-left"></i></a></li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item disabled opacity-50" disabled><a class="page-link disabled" disabled href="#" data-abc="true"><i class="fa fa-angle-left"></i></a></li>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    for ($x = 1; $x < $number_of_pages + 1; $x++) {
                                        if ($pageno == $x) {
                                    ?>
                                            <li class="page-item active"><a class="page-link" href="#" onclick="sortproduct('<?php echo ($kword); ?>','<?php echo ($cid); ?>',0,<?php echo ($x); ?>);" data-abc="true"><?php echo ($x); ?></a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="page-item"><a class="page-link" href="#" onclick="sortproduct('<?php echo ($kword); ?>','<?php echo ($cid); ?>',0,<?php echo ($x); ?>);" data-abc="true"><?php echo ($x); ?></a></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    if ($pageno < $number_of_pages) {
                                    ?>
                                        <li class="page-item"><a class="page-link" onclick="sortproduct('<?php echo ($kword); ?>','<?php echo ($cid); ?>',0,<?php echo ($pageno + 1) ?>)" href="#" data-abc="true"><i class="fa fa-angle-right"></i></a></li>
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
                        </div>
                    </div>



                <?php
                }
                ?>




            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./js/pricerange.js"></script>
</body>

</html>