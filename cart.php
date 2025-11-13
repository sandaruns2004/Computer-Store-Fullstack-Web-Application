<?php
session_start();
if (isset($_SESSION["u"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Computer Store | Cart</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <link rel="icon" href="./resources/logo.svg">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    </head>

    <body>
        <?php
        include "header.php";
        ?>
        <div class="container-fluid homebackground">
            <div class="row">
                <div class="col-12 mt-4 mb-2">
                    <h3 class="text-center subtopic">Cart</h3>
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="row p-2">
                    <div class="col-8">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $cart_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON cart.cart_product_id = product.id WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "'");
                    $cart_num = $cart_rs->num_rows;
                    if ($cart_rs->num_rows == 0) {
                    ?>
                        <!-- Empty Design -->
                        <div class="col-12 mt-3">
                            <div class="justify-content-center align-items-center">
                                <div class="empty-design">
                                    <i class="fas fa-shopping-cart fa-7x iconforemptyview"></i>
                                    <h4 class="text-center my-4">No products in your Cart.</h4>
                                    <a class="text-center shopnowbtn" href="advancedsearchproducts.php">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Empty Design -->
                    <?php
                    } else {
                    ?>
                        <!-- Products Available In Cart -->
                        <div class="col-lg-8 col-md-12 d-md-block d-lg-block">
                            <div class="row p-3">
                                <div class="col-12">
                                    <table class="table tables carttable">
                                        <thead>
                                            <tr class="text-center carttablehead">
                                                <th scope="col-1">#</th>
                                                <th scope="col-4">Product</th>
                                                <th scope="col-2">Price</th>
                                                <th scope="col-3">Quantity</th>
                                                <th scope="col-3">Subtotal</th>
                                                <th scope="col-1">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody class="carttablebody">
                                            <?php
                                            $fulltotal = 0;
                                            $fullshipping = 0;
                                            for ($x = 0; $x < $cart_num; $x++) {
                                                $cart_data = $cart_rs->fetch_assoc();
                                            ?>
                                                <!-- Add product records here -->
                                                <tr>
                                                    <td class="cartid p-3" data-label="#">
                                                        <div class="row small">
                                                            <span> <?php echo ($x + 1); ?></span>
                                                        </div>
                                                    </td>
                                                    <td class="p-3" data-label="Product">
                                                        <div class="row">
                                                            <!-- add product image and name here -->
                                                            <div class="col-lg-6 col-12 d-none d-lg-block">
                                                                <?php
                                                                $pimg_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $cart_data["cart_product_id"] . "'");
                                                                $pimg_num = $pimg_rs->num_rows;
                                                                $pimg_data = $pimg_rs->fetch_assoc();

                                                                if ($pimg_num == 0) {
                                                                ?>
                                                                    <img src="./resources/no_image.svg" class=" img-fluid">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo ($pimg_data["path"]); ?>" class=" img-fluid">
                                                                <?php
                                                                }

                                                                ?>
                                                            </div>
                                                            <div class="col-lg-6 col-12 small">
                                                                <span>
                                                                    <?php echo ($cart_data["title"]); ?>
                                                                </span>
                                                                <br>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="cartprice p-3" data-label="Price">
                                                        <div class="row small">
                                                            <span class="pricespan">Rs.<?php echo ($cart_data["price"]); ?>.00</span>
                                                        </div>
                                                    </td>
                                                    <td data-label="Quantity" class="p-3">
                                                        <!-- add ajustable qty input with 2 buttons for cart here -->
                                                        <div class="row">
                                                            <div class="input-group set_quantity input-group-sm">
                                                                <button class="btn btn-outline-secondary" type="button" onclick="qty_dec(<?php echo ($cart_data['product_qty']); ?>,<?php echo ($x); ?>,<?php echo ($cart_data['price']); ?>,<?php echo ($cart_data['id']); ?>);"><i class="fas fa-minus"></i></button>
                                                                <input type="number" id="qty_input<?php echo ($x); ?>" class="form-control" value="<?php echo ($cart_data["cart_qty"]); ?>" onchange="checkqty(<?php echo ($cart_data['product_qty']); ?>,<?php echo ($x); ?>,<?php echo ($cart_data['price']); ?>,<?php echo ($cart_data['id']); ?>);">
                                                                <button class="btn btn-outline-secondary" type="button" onclick="qty_inc(<?php echo ($cart_data['product_qty']); ?>,<?php echo ($x); ?>,<?php echo ($cart_data['price']); ?>,<?php echo ($cart_data['id']); ?>);"> <i class="fas fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                        <!-- add ajustable qty input with 2 buttons for cart here -->
                                                    </td>
                                                    <td data-label="Subtotal" class="p-3">
                                                        <div class="row cartnetprice small">
                                                            <span id="netprice<?php echo ($x); ?>">Rs.<?php echo ($cart_data["price"] * $cart_data["cart_qty"]); ?>.00</span>
                                                            <input type="text" class="d-none" id="nettotalinput<?php echo ($x); ?>" value="<?php echo ($cart_data["price"] * $cart_data["cart_qty"]); ?>">
                                                        </div>
                                                    </td>
                                                    <td data-label="Remove" class="p-3">
                                                        <div class="row cartremove">
                                                            <span><button class="removecartbtn" title="Remove from Cart" onclick="removefromcart(<?php echo ($cart_data['cart_id']); ?>);"><i class="fa-solid fa-trash" aria-hidden="true"></i></button></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- Add product records here -->
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Products Available In Cart -->

                        <?php
                        $cart_summery_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON cart.cart_product_id = product.id WHERE `cart_user_id` = '" . $_SESSION["u"]["id"] . "'");
                        $cart_summery_num = $cart_summery_rs->num_rows;

                        $totalprice = 0;
                        $totalshipping = 0;

                        for ($x = 0; $x < $cart_summery_num; $x++) {
                            $cart_summery_data = $cart_summery_rs->fetch_assoc();
                            $oneprice = $cart_summery_data["cart_qty"] * $cart_summery_data["price"];
                            $totalprice += $oneprice;
                            $oneshipping = $cart_summery_data["delevery_fee"] * $cart_summery_data["cart_qty"];
                            $totalshipping += $oneshipping;
                        }
                        $totalamount = $totalprice + $totalshipping;
                        ?>
                        <div class="col-12 col-lg-4 col-md-12">
                            <!-- Cart Summery -->
                            <div class="row p-3 ms-2">
                                <div class="col-12" id="cart_summery">
                                    <h5 class="text-center txt2">Cart Summery <span class=" small">(<?php echo ($cart_num); ?>) items</span> </h5>
                                    <hr>
                                    <div class="row pt-2">
                                        <div class="col-6">
                                            <span>Subtotal:</span>
                                        </div>
                                        <div class="col-6 text-right">
                                            <span>Rs.<?php echo ($totalprice); ?>.00</span>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-6">
                                            <span>Shipping:</span>
                                        </div>
                                        <div class="col-6 text-right">
                                            <span>Rs.<?php echo ($totalshipping); ?>.00</span>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-6">
                                            <span>Total:</span>
                                        </div>
                                        <div class="col-6 text-right">
                                            <span>Rs.<?php echo ($totalamount); ?>.00</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- add billing information popup -->
                                <div class="col-12">
                                    <!-- display billing details -->
                                    <div class="row p-3 summerylist">
                                        <div class="col-12">
                                            <h5 class="text-center txt2">Billing Information</h5>
                                            <hr>
                                        </div>
                                        <?php

                                        $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `user` ON user_has_address.user_id = user.id INNER JOIN `cities` ON user_has_address.cities_city_id = cities.city_id WHERE `user_id` = '" . $_SESSION["u"]["id"] . "'");
                                        $address_num = $address_rs->num_rows;

                                        if ($address_num == 0) {
                                        ?>
                                            <div class="col-12 border border-1 py-2">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        No Address Found
                                                    </div>
                                                    <a class="btn btn-link" href="userprofile.php">
                                                        Update Your Address Details
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                            $address_data = $address_rs->fetch_assoc();
                                        ?>
                                            <div class="col-12 border border-1 py-2">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <label><?php echo ($address_data["fname"] . " " . $address_data["lname"]); ?></label>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <label><?php echo ($address_data["email"]); ?></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <label><?php echo ($address_data["mobile"]); ?></label>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <label><?php echo ($address_data["line1"] . " " . $address_data["line2"]); ?></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <label><?php echo ($address_data["postcode"]); ?></label>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <label><?php echo ($address_data["city_name_en"]); ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <!-- display billing details -->
                                </div>
                            </div>
                            <!-- add billing information popup -->
                            <div class="row mb-3">
                                <div class="col-12 text-center">
                                    <button class="checkoutbtn" onclick="paycartitems();">Proceed to Checkout</button>
                                </div>
                            </div>
                            <!-- Cart Summery -->
                        </div>
                        <!-- Cart Summery -->


                    <?php

                    }

                    ?>
                </div>
            </div>
        </div>

        <?php include "footer.php"; ?>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: index.php");
    exit();  // to prevent further execution of the script after redirection
}
?>