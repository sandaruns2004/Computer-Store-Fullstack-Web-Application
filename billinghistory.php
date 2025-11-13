<?php
session_start();
if (isset($_SESSION["u"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Computer Store | Invoices</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <link rel="icon" href="./resources/logo.svg">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    </head>

    <body>
        <?php include "header.php"; ?>
        <div class="container-fluid homebackground">

            <!-- Title -->
            <div class="row">
                <div class="col-12 mt-4 mb-2">
                    <h3 class="text-center subtopic">Billing History</h3>
                </div>
            </div>
            <!-- Title -->

            <!-- Body Content -->
            <div class="container">
                <div class="row p-2">

                    <!-- BeeadCrumb -->
                    <div class="col-8">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Billing History</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- BeeadCrumb -->

                </div>

                <div class="row g-2 justify-content-center">
                    <!-- set from date information -->
                    <div class="col-4 mx-2">
                        <div class="mb-3 mt-2">
                            <input type="date" class="form-control" placeholder="From Date" id="fromDate" onchange="searchinvoices();">
                        </div>
                    </div>
                    <!-- set from date information -->
                    <!-- set to date information -->
                    <div class="col-4 mx-2">
                        <div class="mb-3 mt-2">
                            <input type="date" class="form-control" placeholder="To Date" id="toDate" onchange="searchinvoices();">
                        </div>
                    </div>
                    <!-- set to date information -->
                </div>

                <div class="row g-3 pt-2 pb-4" id="invoices_results">
                    <?php
                    $invoice_rs = Database::search("SELECT DISTINCT `order_id` FROM `invoice` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "'");
                    $invoice_num = $invoice_rs->num_rows;

                    if ($invoice_num == 0) {
                        echo "<h4 class='text-center mt-5'>No billing history found.</h4>";
                    } else {
                        for ($x = 0; $x < $invoice_num; $x++) {
                            $invoice_data = $invoice_rs->fetch_assoc();
                            $oid = $invoice_data["order_id"];
                    ?>
                            <div class="col-lg-3 col-md-4 col-6 mt-3">
                                <!-- set invoice details -->
                                <div class="card invoicescards h-100">

                                    <div class="card-header text-center">
                                        <h5 class="card-title mt-2 mb-3">Order ID <?php echo ($oid); ?></h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <?php

                                        $selected_invoice_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_id = product.id WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' AND `order_id` = '" . $oid . "'");
                                        $selected_invoice_num = $selected_invoice_rs->num_rows;

                                        ?>
                                        <p class="card-text fs-6">
                                            <?php
                                            $total = 0;
                                            $shipping = 0;

                                            for ($y = 0; $y < $selected_invoice_num; $y++) {
                                                $selected_invoice_data = $selected_invoice_rs->fetch_assoc();
                                            ?>
                                                <?php
                                                echo ($selected_invoice_data["title"]);
                                                $one_total = $selected_invoice_data["invoice_price"] * $selected_invoice_data["invoice_qty"];
                                                $total += $one_total;
                                                $one_shipping = $selected_invoice_data["delevery_fee"] * $selected_invoice_data["invoice_qty"];
                                                $shipping += $one_shipping;
                                                ?>
                                                <br>
                                            <?php
                                            }

                                            ?>

                                        </p>

                                    </div>

                                    <div class="card-footer text-center">
                                        <p class="card-text">Total: Rs. <b> <?php echo ($total + $shipping); ?> </b> .00</p>
                                        <div class="my-2">
                                            <a href="invoice.php?id=<?php echo ($oid); ?>" target="_blank" class="viewinvoicebtn">View Invoice</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- set invoice details -->
                            </div>
                            <?php
                            ?>
                    <?php
                        }
                    }
                    ?>

                </div>
            </div>
            <!-- Body Content -->

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