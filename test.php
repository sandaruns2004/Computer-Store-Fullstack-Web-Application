<p class="card-text">
                                            <?php

                                            $selected_invoice_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_id = product.id WHERE `user_id` = '" . $_SESSION["u"]["id"] . "' AND `order_id` = '" . $oid . "'");
                                            $selected_invoice_num = $selected_invoice_rs->num_rows;

                                            for ($x = 0; $x < $selected_invoice_num; $x++) {
                                                $selected_invoice_data = $selected_invoice_rs->fetch_assoc();
                                            ?>
                                                <?php
                                                echo ($selected_invoice_data["title"])
                                                ?>
                                                <br>
                                            <?php
                                            }

                                            ?>
                                        </p>
                                        <p class="card-text">Total: Rs.1000.00</p>
                                        <div class="my-2">
                                            <a href="invoice.php?id=669372" class="viewinvoicebtn">View Invoice</a>
                                        </div>