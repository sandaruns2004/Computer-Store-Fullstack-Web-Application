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
    <footer class="footer-body pt-4 pb-4">
        <div class="col-12">
            <div class="row text-center">
                <div class="col-md-4 col-lg-4 mx-auto mt-2">
                    <div>
                        <h3 class="text-center footertopic">About Us</h3>
                        <div class="mt-3">
                            <p>We are the most famous computer dealers in Sri Lanka and provide 24 hours of service for customers.</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <ul class="list-unstyled list-inline socialicons">
                            <li class="list-inline-item">
                                <a href="#" class="form-floating text-white">
                                    <i class="bi bi-facebook" style="font-size: 22px;"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="form-floating text-white">
                                    <i class="bi bi-twitter" style="font-size: 22px;"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="form-floating text-white">
                                    <i class="bi bi-whatsapp" style="font-size: 22px;"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="form-floating text-white">
                                    <i class="bi bi-linkedin" style="font-size: 22px;"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="form-floating text-white">
                                    <i class="bi bi-youtube" style="font-size: 22px;"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 mx-auto mt-2">
                    <h3 class="text-center footertopic">Products</h3>
                    <div class="mt-3">
                        <ul class=" list-unstyled list-group-item">
                            <li class=" list-group-item">
                                <div class="row justify-content-center g-2" id="cartitemsheader">
                                    <?php
                                    if (isset($_SESSION["u"])) {
                                        $product_footer_rs = Database::search("SELECT * FROM `product` ORDER BY `registered_date` DESC LIMIT 3 OFFSET 0");
                                        $product_footer_num = $product_footer_rs->num_rows;

                                        for ($x = 0; $x < $product_footer_rs->num_rows; $x++) {
                                            $product_footer_data = $product_footer_rs->fetch_assoc();
                                    ?>
                                            <div class="col-lg-3 col-md-3" onclick="opensingleproduct(<?php echo ($product_footer_data['id']); ?>,'<?php echo ($product_footer_data['title']); ?>');" style="cursor:pointer;">
                                                <?php
                                                $pfimg_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $product_footer_data["id"] . "'");
                                                $pfimg_num = $pfimg_rs->num_rows;
                                                $pfimg_data = $pfimg_rs->fetch_assoc();

                                                if ($pfimg_num == 0) {
                                                ?>
                                                    <img src="./resources/no_image.svg" alt="" width="70px" height="auto">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="<?php echo ($pfimg_data["path"]); ?>" alt="" width="70px" height="auto">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-lg-8 col-md-8" onclick="opensingleproduct(<?php echo ($product_footer_data['id']); ?>,'<?php echo ($product_footer_data['title']); ?>');" style="cursor:pointer;">
                                                <p class="card-text"><?php echo ($product_footer_data["title"]); ?></p>
                                            </div>
                                            <hr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="text-center p-3"><?php echo ("Please login to view the products."); ?></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 mx-auto mt-2">
                    <h3 class="text-center footertopic">Contact Us</h3>
                    <div class="mt-3">
                        <ul class="list-unstyled">
                            <li class="list-group-item"><i class="bi bi-house-fill"></i> 218/40 2<sup>nd</sup>  Street, Sri Lanka</li>
                            <li class="list-group-item pt-2"><i class="bi bi-phone"></i> +94 11 217 0084</li>
                            <li class="list-group-item pt-2"><i class="bi bi-envelope"></i> ecomputerstore@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <hr class="mb-4" />
            </div>
        </div>
    </footer>
</body>
</html>