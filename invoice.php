<?php
session_start();
if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Computer Store | Invoice</title>
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

                <div class="container py-2">
                    <div class="row">
                        <div class="col-12 mt-4 mb-2">
                            <h3 class="text-center subtopic">Invoice</h3>
                        </div>
                    </div>
                    <div class="container-fluid" style="background-color:#f3eeee" id="document">
                        <div class="row pt-2 d-lg-flex d-none">
                            <!-- add logo on right side -->
                            <div class="col-lg-1 offset-lg-8">
                                <img src="./resources/logo.svg" width="100px" />
                            </div>
                            <div class="col-3 text-start mt-5 txt1 text-dark">
                                <p style="font-size: 18px;">Online Computer Solutions</p>
                            </div>
                            <!-- add logo on right side -->
                        </div>
                        <div class="row pt-2 d-lg-none d-flex">
                            <!-- add logo on right side -->
                            <div class="col-12 d-flex justify-content-center">
                                <img src="./resources/logo.svg" width="100px" />
                            </div>
                            <div class="col-12 txt1 text-center text-dark">
                                <p style="font-size: 18px;">Online Computer Solutions</p>
                            </div>
                            <!-- add logo on right side -->
                        </div>
                        <div class="row my-3">
                            <div class="col-12 text-center">
                                <h3>INVOICE</h3>
                            </div>
                        </div>
                        <?php
                        $invoice_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_id = product.id WHERE `order_id` = '" . $_GET["id"] . "'");
                        $invoice_data = $invoice_rs->fetch_assoc();
                        $user_rs = Database::search("SELECT * FROM `user` WHERE `id` = '" . $invoice_data["user_id"] . "'");
                        $user_data = $user_rs->fetch_assoc();
                        $user_address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `cities` ON user_has_address.cities_city_id = cities.city_id WHERE `user_id` = '" . $invoice_data["user_id"] . "'");
                        $user_address_data = $user_address_rs->fetch_assoc();
                        ?>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-3 offset-lg-2">
                                        <h5>Order ID : <?php echo ($_GET["id"]); ?></h5>
                                        <p>Date: <?php echo ($invoice_data["invoice_date"]); ?></p>
                                    </div>
                                    <div class="col-lg-4 offset-lg-2">
                                        <h5>To:</h5>
                                        <p><?php echo ($user_data["fname"] . " " . $user_data["lname"]); ?> <br> <?php echo ($user_address_data["line1"] . " ," . $user_address_data["line2"]); ?> <br> <?php echo ($user_address_data["city_name_en"]); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3 pb-2 justify-content-center">
                            <div class="col-10">
                                <table class="table tableinvoice">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $shipping = 0;
                                        $price = 0;
                                        $invoice_product_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_id = product.id WHERE `order_id` = '" . $_GET["id"] . "'");
                                        for ($x = 0; $x < $invoice_product_rs->num_rows; $x++) {
                                            $invoice_product_data = $invoice_product_rs->fetch_assoc();

                                            $oneshipping = $invoice_product_data["delevery_fee"] * $invoice_product_data["invoice_qty"];
                                            $shipping += $oneshipping;

                                            $oneprice = $invoice_product_data["price"] * $invoice_product_data["invoice_qty"];
                                            $price += $oneprice;
                                        ?>
                                            <tr>
                                                <td><?php echo ($invoice_product_data["title"]); ?></td>
                                                <td><?php echo ($invoice_product_data["invoice_qty"]); ?></td>
                                                <td>Rs. <?php echo ($invoice_product_data["price"]); ?>.00</td>
                                                <td>Rs. <?php echo ($invoice_product_data["price"] * $invoice_product_data["invoice_qty"]); ?>.00</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot class="my-5">
                                        <tr class="subtotal">
                                            <td colspan="3" class="text-right">Subtotal</td>
                                            <td>Rs.<?php echo ($price); ?>.00</td>
                                        </tr>
                                        <tr class="shipping">
                                            <td colspan="3" class="text-right">Shipping</td>
                                            <td>Rs.<?php echo ($shipping); ?>.00</td>
                                        </tr>
                                        <tr class="total">
                                            <td colspan="3" class="text-right">Total</td>
                                            <td>Rs.<?php echo ($price + $shipping); ?>.00</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-12 text-center">
                                <p>Thank you for your purchase!</p>
                                <!-- return items note -->
                                <p>Return items: Please return the items within 7 days of receiving the invoice. <br> If you don't return items within this timeframe, we will have to charge you a 5% restocking fee.</p>
                                <!-- return items note -->
                                <p>Please contact us at <a href="mailto:info@onlinecomputersolutions.com">info@onlinecomputersolutions.com</a> if you have any questions or concerns.</p>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- export to print or pdf file -->
                <div class="row">
                    <div class="col-11 text-end mb-3">
                        <a href="#" class=" exporttopdf">Export to PDF</a>
                        <a href="#" class=" printinvoice" onclick="printinvoice();">Print</a>
                    </div>
                </div>
                <!-- export to print or pdf file -->
            </div>

            <?php include "footer.php"; ?>
        </body>

        </html>
<?php
    } else {
        header("Location: home.php");
    }
} else {
    header("Location: index.php");
}
?>