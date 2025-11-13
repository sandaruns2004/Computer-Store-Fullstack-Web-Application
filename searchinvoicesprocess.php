<?php

session_start();
include "connection.php";

if (isset($_POST["from"]) && isset($_POST["to"])) {
    $from = $_POST["from"];
    $to = $_POST["to"];

    $q = "SELECT DISTINCT `order_id`,`invoice_date` FROM `invoice` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "'";

    $invoice_rs = Database::search($q);
    $invoice_num = $invoice_rs->num_rows;

    if ($invoice_num == 0) {
        echo "<h4 class='text-center mt-5'>No billing history found.</h4>";
    } else {
        for ($x = 0; $x < $invoice_num; $x++) {
            $invoice_data = $invoice_rs->fetch_assoc();
            $oid = $invoice_data["order_id"];
            $invoice_date = $invoice_data["invoice_date"];

            $date = explode(" ", $invoice_data["invoice_date"]);
            $d = $date[0];

            $z = 0;

            if (empty($from) && !empty($to)) {
                if ($d <= $to) {
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
            } else if (!empty($from) && empty($to)) {
                if ($d >= $from) {
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
            } else if (!empty($from) && !empty($to)) {
                if ($d >= $from && $d <= $to) {
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
        }
    }
}
