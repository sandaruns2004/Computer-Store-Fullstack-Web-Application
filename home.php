<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Store | Home</title>
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

        <!-- Search Box with Category -->
        <div class="row justify-content-center pt-4">
            <div class="col-10 col-md-8">
                <div class="input-group mb-3 searchpanel">
                    <input type="text" class="form-control" placeholder="Search for products..." id="searchbox" aria-label="Search" aria-describedby="button-addon2">
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
        <!-- Search Box with Category -->

        <!-- Carousel -->
        <div class="col-12 d-none d-lg-block pt-2">
            <div class="row">
                <div id="carouselExampleIndicators" class="col-12 carousel slide" data-bs-ride="true">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner carouselbody">
                        <div class="carousel-item active">
                            <img src="./resources/Leonardo_Phoenix_A_sleek_modern_gaming_laptop_with_a_metallic_0.jpg" class="d-block poster-img-1" />
                        </div>
                        <div class="carousel-item">
                            <img src="./resources/Leonardo_Phoenix_A_sleek_and_modern_gaming_PC_setup_sitting_at_3.jpg" class="d-block poster-img-1" />
                        </div>
                        <div class="carousel-item">
                            <img src="./resources/Leonardo_Phoenix_A_futuristic_illustration_of_a_sleek_silver_a_3.jpg" class="d-block poster-img-1" />
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Carousel -->

        <!-- Latest Products -->
        <div class="col-12 justify-content-center">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <p class="text-center txt2">Discover our latest products</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-deck">
                                <div class="row p-3">
                                    <?php
                                    $status = 1;

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `status_id` = '" . $status . "' ORDER BY `registered_date` DESC LIMIT 8 OFFSET 0");
                                    $product_num = $product_rs->num_rows;

                                    if ($product_num <= 0) {
                                        //no products
                                        echo '<div class="col-12 text-center"><h4>No products found.</h4></div>';
                                        return;
                                    } else {
                                        for ($i = 0; $i < $product_num; $i++) {
                                            $product_data = $product_rs->fetch_assoc();
                                    ?>
                                            <!-- Add products Cards here -->
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
                                                            <img src="<?php echo ($pimg_data["path"]); ?>" style="">
                                                        <?php
                                                        }
                                                        ?>

                                                        <div class="overlay">
                                                            <button class="btn btn-secondary" onclick="opensingleproduct(<?php echo ($product_data['id']); ?>,'<?php echo ($product_data['title']); ?>');" title="Quick View"><i class="fa-regular fa-eye"></i></button>
                                                            <?php
                                                            if (isset($_SESSION["u"])) {
                                                                //Include Session
                                                                //Watchlist Button
                                                                $w_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' AND `product_id` = '" . $product_data['id'] . "'");
                                                                if ($w_rs->num_rows > 0) {
                                                            ?>
                                                                    <button id="wishlistbtn<?php echo ($product_data['id']); ?>" class="btn btn-secondary" title="Remove from Wishlist" onclick="addtowishlist(<?php echo ($product_data['id']); ?>);">
                                                                        <i id="wishlisticon<?php echo ($product_data['id']); ?>" class="fa-solid fa-heart" style="color:red;"></i>
                                                                    </button>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <button id="wishlistbtn<?php echo ($product_data['id']); ?>" class="btn btn-secondary" title="Add to Wishlist" onclick="addtowishlist(<?php echo ($product_data['id']); ?>);">
                                                                        <i id="wishlisticon<?php echo ($product_data['id']); ?>" class="fa-regular fa-heart"></i>
                                                                    </button>
                                                                <?php
                                                                }
                                                                //Watchlist Button

                                                                //Cart Button
                                                                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "' AND `cart_product_id` = '" . $product_data['id'] . "'");
                                                                if ($cart_rs->num_rows > 0) {
                                                                ?>
                                                                    <button id="cart<?php echo ($product_data['id']); ?>" class="btn btn-secondary 
                                                                <?php
                                                                    if ($product_data["product_qty"] <= 0) {
                                                                ?>
                                                                 d-none 
                                                                <?php
                                                                    }
                                                                ?>" title="Update Cart Quantity" onclick="addtocart(<?php echo ($product_data['id']); ?>);">
                                                                        <i id="carticon<?php echo ($product_data['id']); ?>" class="fa-solid fa-cart-shopping" style="color:black;"></i>
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
                                                                ?>" title="Add to Cart" onclick="addtocart(<?php echo ($product_data['id']); ?>);">
                                                                        <i id="carticon<?php echo ($product_data['id']); ?>" class="fa-solid fa-cart-plus"></i>
                                                                    </button>
                                                                <?php
                                                                    //Cart Button
                                                                }
                                                                ?>
                                                            <?php
                                                            } else {
                                                                //Not Include Session
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Latest Products -->

        <!-- Display Brand Logos -->
        <div class="container py-3">
            <div class="col-12 d-none d-lg-block">
                <div class="row justify-content-center brandimages">
                    <div class="col-2 col-md-1 col-lg-1 me-4">
                        <a href="#"><img src="./resources/brand_logos/apple.svg" alt="Brand 1"></a>
                    </div>
                    <div class="col-2 col-md-1 col-lg-1 me-4">
                        <a href="#"><img src="./resources/brand_logos/asus.svg" alt="Brand 2"></a>
                    </div>
                    <div class="col-2 col-md-1 col-lg-1 me-4">
                        <a href="#"><img src="./resources/brand_logos/msi.svg" alt="Brand 3"></a>
                    </div>
                    <div class="col-2 col-md-1 col-lg-1 me-4">
                        <a href="#"><img src="./resources/brand_logos/samsung.svg" alt="Brand 4"></a>
                    </div>
                    <div class="col-2 col-md-1 col-lg-1 me-4">
                        <a href="#"><img src="./resources/brand_logos/intel.svg" alt="Brand 4"></a>
                    </div>
                    <div class="col-2 col-md-1 col-lg-1">
                        <a href="#"><img src="./resources/brand_logos/kingston.svg" alt="Brand 4"></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Display Brand Logos -->

    </div>
    <?php include "footer.php"; ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>