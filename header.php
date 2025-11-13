<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand txt1" href="home.php">Computer Store</a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto headerlinks">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="advancedsearchproducts.php">Store</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="userprofile.php">My Profile</a>
                        </li>
                        
                        <?php
                        if (isset($_SESSION["u"])) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="billinghistory.php">Billing History</a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="contactus();">Contac Us</a>
                            </li>
                        <?php
                        } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Billing History</a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Contac Us</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <ul class="navbar-nav ms-auto headerlinks">
                        <?php
                        include "connection.php";
                        // When Session is Available
                        if (isset($_SESSION["u"])) {
                            $userdata = $_SESSION["u"];
                        ?>
                            <li class="nav-item">
                                <span class="nav-link usernamecolor"><?php echo ($_SESSION["u"]["uname"]) ?></span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="signout();">Sign Out</a>
                            </li>
                        <?php
                        } else {
                            // When Session is Not Available
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Register</a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        // When Session is Available
                        if (isset($_SESSION["u"])) {
                        ?>
                            <!-- Watchlist -->
                            <li class="nav-item dropdown">
                                <?php
                                $w_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "'");

                                if ($w_rs->num_rows > 0) {
                                    // Products In Watchlist
                                ?>
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-heart-fill" id="watchlistheadericon"></i> Watchlist
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end headerdropdownli" aria-labelledby="navbarDropdown">
                                        <li>
                                            <div class="row justify-content-center g-2" id="watchlistitemsheader">
                                                <?php
                                                $w_selected_rs = Database::search("SELECT * FROM `watchlist`INNER JOIN `product` ON watchlist.product_id = product.id WHERE `user_id` = '" . $userdata["id"] . "' ORDER BY `date` DESC LIMIT 3 OFFSET 0");

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
                                            </div>
                                        </li>
                                        <hr>
                                        <li><a class="dropdown-item" href='watchlist.php'>Go to Watchlist</a></li>
                                    </ul>
                                <?php
                                } else {
                                    //No Products In Watchlist
                                ?>
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-heart" id="watchlistheadericon"></i> Watchlist
                                    </a>
                                    <?php
                                    ?>
                                    <ul class="dropdown-menu dropdown-menu-end headerdropdownli" aria-labelledby="navbarDropdown">
                                        <li>
                                            <div class="row justify-content-center" id="watchlistitemsheader">
                                                <?php
                                                echo "No Products found.";
                                                ?>
                                            </div>
                                        </li>
                                        <hr>
                                        <li><a class="dropdown-item" href='watchlist.php'>Go to Watchlist</a></li>
                                    </ul>
                                <?php
                                }
                                ?>
                            </li>
                            <!-- Watchlist -->

                            <!-- cart -->
                            <li class="nav-item dropdown">
                                <?php
                                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "'");

                                if ($cart_rs->num_rows > 0) {
                                    //Products In Cart
                                ?>
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-cart-fill" id="cartheadericon"></i> Cart
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end headerdropdownli" aria-labelledby="navbarDropdown">
                                        <li>
                                            <div class="row justify-content-center g-2" id="cartitemsheader">
                                                <?php
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
                                                ?>
                                            </div>
                                        </li>
                                        <hr>
                                        <li><a class="dropdown-item" href='cart.php'>Go to Cart</a></li>
                                    </ul>
                            </li>
                        <?php
                                } else {
                                    //No Products In Cart
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-cart" id="cartheadericon"></i> Cart
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end headerdropdownli" aria-labelledby="navbarDropdown">
                                    <li>
                                        <div class="row justify-content-center" id="cartitemsheader">
                                            <?php
                                            echo "No Products found.";
                                            ?>
                                        </div>
                                    </li>
                                    <hr>
                                    <li><a class="dropdown-item" href='cart.php'>Go to Cart</a></li>
                                </ul>
                            </li>
                            <!-- cart -->
                        <?php
                                }
                        ?>
                        </li>
                    <?php
                        } else {
                    ?>
                        <!-- Watchlist disabled-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle disabled" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-heart" id="watchlistheadericon"></i> Watchlist
                            </a>
                        </li>

                        <!-- cart disabled-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle disabled" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-cart"></i> Cart
                            </a>
                        </li>
                    <?php
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contact us Modal -->
        <div class="container contactusModal">
            <div class="modal fade" id="contactusModal" tabindex="-1" aria-labelledby="contactusModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header modalheader">
                            <h5 class="modal-title" id="contactusModalLabel">Contact Us</h5>
                            <button type="button" class="btn-close modalclosebtn" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modalbody">
                            <div class="row g-3">
                                <div class="mb-3 col-12">
                                    <label for="namecontactus" class="form-label">Name</label>
                                    <input type="text" class="form-control contactusModaldisabled" disabled value="<?php echo($_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]) ?>" id="namecontactus" required disabled>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="emailcontactus" class="form-label">Email</label>
                                    <input type="email" class="form-control contactusModaldisabled" value="<?php echo($_SESSION["u"]["email"]) ?>" id="emailcontactus" required disabled>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="messagecontactus" class="form-label">Message</label>
                                    <textarea class="form-control" id="messagecontactus" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modalfooter">
                            <button type="button" class="modalfooterbtn" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="modalfooterbtn" onclick="sendmsg(<?php echo($_SESSION['u']['id']) ?>);">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact us Modal -->
    </header>
    <script src="./js/script.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>
</body>
</html>