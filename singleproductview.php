<?php

if (isset($_GET["id"]) || isset($_GET["t"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Computer Store | <?php echo ($_GET["t"]); ?></title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <link rel="icon" href="./resources/logo.svg">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    </head>

    <body>
        <?php
        session_start();
        include "header.php";
        $product_rs = Database::search("SELECT * FROM `product` 
        INNER JOIN `category` ON product.category_category_id = category.category_id 
        LEFT JOIN `product_details` ON product.product_details_product_details_id = product_details.product_details_id 
        INNER JOIN `brand` ON product.brand_brand_id = brand.brand_id 
        INNER JOIN `condition` ON product.condition_condition_id = condition.condition_id 
        WHERE `id` = '" . $_GET["id"] . "'");
        $product_num = $product_rs->num_rows;
        $product_data = $product_rs->fetch_assoc();
        ?>

        <div class="container-fluid homebackground">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="row p-3 mt-3">
                        <!-- Main Image -->
                        <div class="col-12 mainimage">
                            <?php
                            $pimg_main_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $_GET["id"] . "'");
                            $pimg_main_num = $pimg_main_rs->num_rows;
                            if ($pimg_main_num == 0) {
                            ?>
                                <img src="./resources/no_image.svg" class="img-fluid border border-1">

                            <?php
                            } else {
                                $pimg_main_data = $pimg_main_rs->fetch_assoc();
                            ?>
                                <img src="<?php echo ($pimg_main_data['path']); ?>" class="img-fluid border border-2" id="mainimg">
                            <?php
                            }
                            ?>
                        </div>
                        <!-- Main Image -->
                        <!-- Other 4 Images -->
                        <div class="col-12 mt-3">
                            <div class="row justify-content-center">
                                <?php
                                $pimg_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $_GET["id"] . "'");
                                $pimg_num = $pimg_rs->num_rows;
                                $img = array();

                                if ($pimg_num == 0) {
                                ?>
                                    <div class="col-3">
                                        <img src="./resources/no_image.svg" class="img-fluid border border-1">
                                    </div>
                                    <div class="col-3">
                                        <img src="./resources/no_image.svg" class="img-fluid border border-1">
                                    </div>
                                    <div class="col-3">
                                        <img src="./resources/no_image.svg" class="img-fluid border border-1">
                                    </div>
                                    <div class="col-3">
                                        <img src="./resources/no_image.svg" class="img-fluid border border-1">
                                    </div>
                                    <?php
                                } else {
                                    for ($x = 0; $x < $pimg_num; $x++) {
                                        $pimg_data = $pimg_rs->fetch_assoc();
                                        $img[$x] = $pimg_data["path"];
                                    ?>
                                        <div class="col-3" onclick="loadproductimages(<?php echo ($x); ?>);">
                                            <img src="<?php echo ($img[$x]); ?>" class="img-fluid border border-1" id="img<?php echo ($x); ?>">
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- Other 4 Images -->
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="row p-3 mt-3">
                        <!-- Product Title -->
                        <div class="col-12 subtopic mt-2">
                            <h2 class="text-center">
                                <?php echo ($_GET["t"]); ?>
                            </h2>
                        </div>
                        <!-- Product Title -->
                        <div class="col-6 ms-2 pt-4 mt-1">
                            <div class="row txt3 mt-1 g-1">
                                <div class="col-12">
                                    <span>Category : <?php echo ($product_data["category_name"]); ?></span>
                                </div>
                                <div class="col-12">
                                    <span>Brand : <?php echo ($product_data["brand_name"]); ?></span>
                                </div>
                                <div class="col-12">
                                    <span>Condition : <?php echo ($product_data["condition_name"]); ?></span>
                                </div>
                                <div class="col-12">
                                    <span>Color : <input type="color" class="colorshower" disabled value="<?php echo ($product_data["color_color_code"]); ?>"></span>
                                </div>
                                <?php
                                if ($product_data["category_id"] == 1 || $product_data["category_id"] == 2) {
                                    $product_details_rs = Database::search("SELECT * FROM `product_details` 
                                    INNER JOIN `processor` ON product_details.processor_processor_id = processor.processor_id 
                                    INNER JOIN `gui` ON product_details.gui_graphic_card_id = gui.graphic_card_id 
                                    WHERE `product_details_id` = '" . $product_data["product_details_id"] . "'");

                                    $product_details_data = $product_details_rs->fetch_assoc();
                                ?>
                                    <div class="col-12 mt-4">
                                        <span>Processor : <?php echo ($product_details_data["processor_name"]); ?></span>
                                    </div>
                                    <div class="col-12">
                                        <span>GUI : <?php echo ($product_details_data["graphic_card_name"]); ?></span>
                                    </div>
                                    <div class="col-12">
                                        <span>RAM Size : <?php echo ($product_details_data["ram_size"]); ?>GB</span>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-4 ms-4 mt-4">
                            <div class="row mt-3 g-2">
                                <div class="col-12 brandimage">
                                    <img src="<?php echo ($product_data["brand_logo_path"]); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row p-3 mt-3">
                        <div class="col-12 ms-2">
                            <div class="row txt3 g-2">
                                <div class="col-12">
                                    <span>Price : Rs.<?php echo ($product_data["price"]); ?>.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ms-2 mt-3">
                            <div class="row txt3">
                                <div class="col-lg-3 col-4 mt-1">
                                    <span>Qty : </span>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <div class="input-group set_quantity input-group-sm">
                                        <?php
                                        if ($product_data["product_qty"] == 0) {
                                        ?>
                                            <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                            <input type="number" class="form-control" disabled value="0" id="qty_box">
                                            <button class="btn btn-outline-secondary" type="button"> <i class="fas fa-plus"></i></button>
                                        <?php
                                        } else {
                                        ?>
                                            <button class="btn btn-outline-secondary" type="button" onclick="dec_qty(<?php echo ($product_data['price']); ?>);"><i class="fas fa-minus"></i></button>
                                            <input type="number" class="form-control" value="1" onchange="qtycheck(<?php echo ($product_data['product_qty']); ?>,<?php echo ($product_data['price']); ?>);" id="qty_box">
                                            <button class="btn btn-outline-secondary" type="button" onclick="inc_qty(<?php echo ($product_data['product_qty']); ?>,<?php echo ($product_data['price']); ?>);"> <i class="fas fa-plus"></i></button>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1 g-2">
                                <div class="col-12 txt3">
                                    <span id="netprice">Net Price : Rs.<?php echo ($product_data["price"]); ?>.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row p-3 mt-lg-4 mt-0 text-center">
                        <div class="col-lg-4 col-12 mt-lg-0 mt-3">
                            <button class="btn btnbuynow"
                                <?php
                                if ($product_data["product_qty"] != 0 && isset($_SESSION["u"])) {
                                    //No Code
                                } else {
                                ?>
                                disabled
                                <?php
                                }
                                ?> onclick="paysingleproduct(<?php echo ($_GET['id']); ?>);">Buy Now</button>
                        </div>
                        <div class="col-lg-4 col-12 mt-lg-0 mt-3">
                            <?php
                            if ($product_data["product_qty"] != 0 && isset($_SESSION["u"])) {
                                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "' AND `cart_product_id` = '" . $_GET['id'] . "'");
                                if ($cart_rs->num_rows > 0) {
                            ?>
                                    <button class="btn btnaddtocart" onclick="addtocartfromsingleview(<?php echo ($_GET['id']); ?>);">Update Cart <i class="fa-solid fa-cart-shopping"></i> </button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btnaddtocart" onclick="addtocartfromsingleview(<?php echo ($_GET['id']); ?>);">Add to Cart <i class="fa-solid fa-cart-plus"></i> </button>
                                <?php
                                }
                            } else {
                                ?>
                                <button class="btn btnaddtocart" disabled>Add to Cart <i class="fa-solid fa-cart-shopping"></i> </button>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-lg-4 col-12 mt-lg-0 mt-3">
                            <?php
                            if (isset($_SESSION["u"])) {
                                $w_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' AND `product_id` = '" . $_GET["id"] . "'");
                                if ($w_rs->num_rows == 0) {
                            ?>
                                    <button class="btnwatchlist" id="wishlistbtn<?php echo ($_GET['id']); ?>" onclick="addtowishlistfromsingleview(<?php echo ($_GET['id']); ?>);">Add To Watchlist
                                        <i class="fa-solid fa-heart" id="wishlisticon<?php echo ($_GET['id']); ?>" style="color:red;"></i>
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <button class="btnwatchlist" id="wishlistbtn<?php echo ($_GET['id']); ?>" onclick="addtowishlistfromsingleview(<?php echo ($_GET['id']); ?>);">Remove Watchlist
                                        <i class="fa-regular fa-heart" id="wishlisticon<?php echo ($_GET['id']); ?>" style="color:red;"></i>
                                    </button>
                                <?php
                                }
                            } else {
                                ?>
                                <button class="btnwatchlist btn" disabled>Add To Watchlist
                                    <i class="fa-regular fa-heart" style="color:red;"></i>
                                </button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 container-fluid">
                <div class="col-12">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Related Products</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="feedback-tab" data-bs-toggle="tab" data-bs-target="#feedback-tab-pane" type="button" role="tab" aria-controls="feedback-tab-pane" aria-selected="false">Feedbacks</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="row my-3 justify-content-center">
                                <div class="col-10">
                                    <textarea class="form-control" id="description" rows="5" disabled><?php echo ($product_data["description"]); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            <div class="row my-3 justify-content-center">
                                <?php
                                $category_product_rs = Database::search("SELECT * FROM `product` WHERE `category_category_id` = '" . $product_data["category_category_id"] . "' OR `brand_brand_id` = '" . $product_data["brand_brand_id"] . "' ORDER BY `registered_date` LIMIT 4 OFFSET 0");
                                $category_product_num = $category_product_rs->num_rows;

                                for ($x = 0; $x < $category_product_num; $x++) {
                                    $category_product_data = $category_product_rs->fetch_assoc();
                                ?>
                                    <!-- Add products here -->
                                    <div class="col-6 col-md-4 col-lg-3 py-3">
                                        <div class="card">
                                            <div class="card-header cardtop">
                                                <?php
                                                $pcimg_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $category_product_data["id"] . "'");
                                                $pcimg_num = $pcimg_rs->num_rows;
                                                $pcimg_data = $pcimg_rs->fetch_assoc();

                                                if ($pcimg_num == 0) {
                                                ?>
                                                    <img src="./resources/slideimg.svg" alt="">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="<?php echo ($pcimg_data["path"]); ?>">
                                                <?php
                                                }

                                                ?>

                                                <div class="overlay">
                                                    <button class="btn btn-secondary" onclick="opensingleproduct(<?php echo ($category_product_data['id']); ?>,'<?php echo ($category_product_data['title']); ?>');" title="Quick View"><i class="fa-regular fa-eye"></i></button>
                                                    <?php
                                                    if (isset($_SESSION["u"])) {
                                                        $w_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' AND `product_id` = '" . $product_data['id'] . "'");

                                                        if ($w_rs->num_rows > 0) {
                                                    ?>
                                                            <button id="wishlistbtn<?php echo ($category_product_data['id']); ?>" class="btn btn-secondary"
                                                                title="Remove from Wishlist" onclick="addtowishlist(<?php echo ($category_product_data['id']); ?>);"><i id="wishlisticon<?php echo ($category_product_data['id']); ?>" class="fa-solid fa-heart" style="color:red;"></i>
                                                            </button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button id="wishlistbtn<?php echo ($category_product_data['id']); ?>" class="btn btn-secondary"
                                                                title="Add to Wishlist" onclick="addtowishlist(<?php echo ($category_product_data['id']); ?>);"><i id="wishlisticon<?php echo ($category_product_data['id']); ?>" class="fa-regular fa-heart"></i>
                                                            </button>
                                                        <?php
                                                        }

                                                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "' AND `cart_product_id` = '" . $category_product_data['id'] . "'");

                                                        if ($cart_rs->num_rows > 0) {
                                                            //already added
                                                        ?>
                                                            <button id="cart<?php echo ($category_product_data['id']); ?>" class="btn btn-secondary 
                                                                <?php
                                                                if ($category_product_data["product_qty"] <= 0) {
                                                                ?>
                                                                 d-none 
                                                                <?php
                                                                }
                                                                ?>
                                                                        "
                                                                title="Update Cart Quantity" onclick="addtocart(<?php echo ($category_product_data['id']); ?>);"><i id="carticon<?php echo ($category_product_data['id']); ?>" class="fa-solid fa-cart-shopping" style="color:black;"></i>
                                                            </button>
                                                        <?php
                                                        } else {
                                                            //not added
                                                        ?>
                                                            <button id="cart<?php echo ($category_product_data['id']); ?>" class="btn btn-secondary 
                                                                <?php
                                                                if ($product_data["product_qty"] <= 0) {
                                                                ?> 
                                                                d-none 
                                                                <?php
                                                                }
                                                                ?>
                                                                        "
                                                                title="Add to Cart" onclick="addtocart(<?php echo ($category_product_data['id']); ?>);"><i id="carticon<?php echo ($category_product_data['id']); ?>" class="fa-solid fa-cart-plus"></i>
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
                                                <h5 class="card-title fw-bold"><?php echo ($category_product_data["title"]); ?></h5>
                                                <?php
                                                if ($category_product_data["product_qty"] > 0) {
                                                ?>
                                                    <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                    <span class="card-text text-warning fw-bold"><?php echo ($category_product_data["product_qty"]); ?> Items Available</span><br />
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                                                    <span class="card-text text-danger fw-bold">No Items Available</span><br />
                                                <?php
                                                }
                                                ?>
                                                <span class="card-text text-dark fw-bold">Rs.<?php echo ($category_product_data["price"]); ?>.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add products here -->
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="feedback-tab-pane" role="tabpanel" aria-labelledby="feedback-tab" tabindex="0">
                            <div class="row my-3 justify-content-start">
                                <?php
                                $feedback_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `user` ON feedback.feedback_user_id = user.id WHERE `feedback_product_id` = '" . $_GET["id"] . "'");
                                $feedback_num = $feedback_rs->num_rows;

                                if ($feedback_num != 0) {
                                    for ($x = 0; $x < $feedback_num; $x++) {
                                        $feedback_data = $feedback_rs->fetch_assoc();
                                ?>
                                        <!-- Add Users Review -->
                                        <div class="col-lg-2 col-md-4 col-4 my-2">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title">User Review</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text"><?php echo ($feedback_data["fname"] . " " . $feedback_data["lname"]); ?></p>
                                                    <p class="card-text">Rating:
                                                        &nbsp;&nbsp;&nbsp;
                                                        <?php
                                                        $star = $feedback_data["feedback_star"];
                                                        if ($star == 0) {
                                                        ?>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                        <?php
                                                        } else if ($star == 1) {
                                                        ?>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                        <?php
                                                        } else if ($star == 2) {
                                                        ?>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                        <?php
                                                        } else if ($star == 3) {
                                                        ?>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                        <?php
                                                        } else if ($star == 4) {
                                                        ?>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                        <?php
                                                        } else if ($star == 5) {
                                                        ?>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        <?php
                                                        }
                                                        ?>

                                                    </p>
                                                    <p class="card-text"><?php echo ($feedback_data["feedback_msg"]); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add Users Review -->
                                <?php
                                    }
                                } else {
                                    //No Feedback found
                                    echo '<h4 class="text-center text-muted">No Feedback found for this product yet.</h4>';
                                }
                                ?>
                            </div>
                            <div class="row mt-2 mb-4 justify-content-center">
                                <!-- Upload Your Review -->
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Upload Your Review</h5>
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <div class="form-group">
                                                    <label for="rating">Rating</label>
                                                    <span class="badge stars">
                                                        &nbsp;&nbsp;&nbsp;
                                                        <i class="bi bi-star text-warning fs-5" onclick="fillfeedbackstars(1);" id="star1"></i>
                                                        <i class="bi bi-star text-warning fs-5" onclick="fillfeedbackstars(2);" id="star2"></i>
                                                        <i class="bi bi-star text-warning fs-5" onclick="fillfeedbackstars(3);" id="star3"></i>
                                                        <i class="bi bi-star text-warning fs-5" onclick="fillfeedbackstars(4);" id="star4"></i>
                                                        <i class="bi bi-star text-warning fs-5" onclick="fillfeedbackstars(5);" id="star5"></i>
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="review">Review</label>
                                                    <textarea class="form-control" id="review" rows="3"></textarea>
                                                </div>
                                                <!-- add submit btn -->
                                                <div class="form-group my-2 row justify-content-center">
                                                    <?php
                                                    if (isset($_SESSION["u"])) {
                                                        $feedbacksummery_rs = Database::search("SELECT * FROM `feedback` WHERE `feedback_user_id` = '" . $_SESSION["u"]["id"] . "' AND `feedback_product_id` = '" . $_GET["id"] . "'");
                                                        $feedbacksummery_num = $feedbacksummery_rs->num_rows;
                                                        if ($feedbacksummery_num == 0) {
                                                    ?>
                                                            <button class="col-6 feedbacksubmitbtn" onclick="addfeedback(<?php echo ($_GET["id"]); ?>);">Submit</button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button class="btn col-6 feedbacksubmitbtn" disabled onclick="addfeedback(<?php echo ($_GET["id"]); ?>);">Already Added Feedback</button>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo '<h4 class="text-center text-muted">Please Login to Write a Review</h4>';
                                                    }
                                                    ?>
                                                </div>
                                                <!-- add submit btn -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Upload Your Review -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php include "footer.php"; ?>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: home.php");
}

?>