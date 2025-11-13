<?php
session_start();
if (isset($_SESSION["u"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Computer Store | Admin Panel</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <link rel="icon" href="./resources/logo.svg">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
        <?php
        include "connection.php";
        ?>
        <div class="container-fluid addproductbody">
            <div class="container">
                <div class="row">
                    <div class="mt-4 mb-4">
                        <h3 class="text-center subtopic">Admin Panel</h3>
                    </div>

                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active tabtxt" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard-tab-pane" type="button" role="tab" aria-controls="dashboard-tab-pane" aria-selected="true">Dashboard</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link txt2 tabtxt" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false">Add New Product</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link txt2 tabtxt" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">My Products</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link txt2 tabtxt" id="manageusers-tab" data-bs-toggle="tab" data-bs-target="#manageusers-tab-pane" type="button" role="tab" aria-controls="manageusers-tab-pane" aria-selected="false">Manage Users</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="dashboard-tab-pane" role="tabpanel" aria-labelledby="dashboard-tab" tabindex="0">
                            <div class="row justify-content-center my-4">
                                <!-- Show Number of Users with icon -->
                                <div class="col-lg-3 col-md-6 col-6 text-center my-2">

                                    <div class="card cardtop border border-0" style="background-color:transparent;">
                                        <div class="card-body carddashboard">
                                            <div class="col-12">
                                                <i class="fa-solid fa-users fa-beat-fade dashboardusers" data-bs-toggle="tooltip" data-bs-html="true" data-bs-custom-class="custom-tooltip" data-bs-title="Users"></i>
                                            </div>
                                            <div class="col-12 mt-2 fs-5 fw-bold">
                                                <?php
                                                $userdash_rs = Database::search("SELECT * FROM `user`");
                                                echo $userdash_rs->num_rows;
                                                ?>
                                                Users
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Show Number of Users with icon -->
                                <!-- Show Total Earnings with icon -->
                                <div class="col-lg-3 col-md-6 col-6 text-center my-2">

                                    <div class="card cardtop border border-0" style="background-color:transparent;">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <i class="fa-solid fa-wallet fa-beat-fade totalearnings" data-bs-toggle="tooltip" data-bs-html="true" data-bs-custom-class="custom-tooltip" data-bs-title="Total Earnings"></i>
                                            </div>
                                            <div class="col-12 mt-2 fs-5 fw-bold">
                                                <?php
                                                $total_rs = Database::search("SELECT SUM(`invoice_price`) AS `total` FROM `invoice`");
                                                $total_data = $total_rs->fetch_assoc();
                                                ?>
                                                Rs.<?php echo ($total_data["total"]); ?>.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Show Total Earnings with icon -->
                                <!-- Show Daily Earnings with icon -->
                                <div class="col-lg-3 col-md-6 col-6 text-center my-2">

                                    <div class="card cardtop border border-0" style="background-color:transparent;">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <i class="fa-solid fa-money-check-dollar fa-beat-fade totalearnings" data-bs-toggle="tooltip" data-bs-html="true" data-bs-custom-class="custom-tooltip" data-bs-title="Daily Income"></i>
                                            </div>
                                            <div class="col-12 mt-2 fs-5 fw-bold">
                                                <?php
                                                $total_today_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_id = product.id");

                                                $d = new DateTime();
                                                $tz = new DateTimeZone("Asia/Colombo");
                                                $d->setTimezone($tz);
                                                $date = $d->format('Y-m-d H:i:s');

                                                $dtoday = explode(" ", $date);

                                                $total = 0;
                                                $shipping = 0;

                                                for ($i = 0; $i < $total_today_rs->num_rows; $i++) {
                                                    $total_today_data = $total_today_rs->fetch_assoc();
                                                    $dateinvoice = explode(" ", $total_today_data["invoice_date"]);
                                                    $dt = $dateinvoice[0];
                                                    $tm = $dateinvoice[1];

                                                    if ($dtoday[0] == $dt) {
                                                        $one_total = $total_today_data["invoice_price"] * $total_today_data["invoice_qty"];
                                                        $total += $one_total;
                                                        $one_shipping = $total_today_data["delevery_fee"] * $total_today_data["invoice_qty"];
                                                        $shipping += $one_shipping;
                                                    }
                                                }

                                                ?>
                                                Rs.<?php echo ($total + $shipping); ?>.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Show Daily Earnings with icon -->
                                <!-- Show Total Sales with icon -->
                                <div class="col-lg-3 col-md-6 col-6 text-center my-2">

                                    <div class="card cardtop border border-0" style="background-color:transparent;">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <i class="fa-solid fa-chart-simple fa-beat-fade totalsellings" data-bs-toggle="tooltip" data-bs-html="true" data-bs-custom-class="custom-tooltip" data-bs-title="Total Sellings"></i>
                                            </div>
                                            <div class="col-12 mt-2 fs-5 fw-bold">
                                                <?php
                                                $sellings_rs = Database::search("SELECT DISTINCT `order_id` FROM `invoice`");
                                                $sellings_num = $sellings_rs->num_rows;
                                                ?>
                                                <?php echo ($sellings_num); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Show Total Sales with icon -->
                            </div>
                            <div class="row my-2">
                                <div class="border border-2">
                                    <!-- Show Total Active Time -->
                                    <div class="col-12 text-center mt-2 fs-4 txt2">
                                        <label class="form-label fw-bold ">Total Active Time</label>
                                    </div>
                                    <div class="col-12 mt-2 fs-5 text-danger fw-bold">
                                        <p class="text-center">00 Years 01 Months 11 Days 05 Hours 30 minutes 20 Seconds</p>
                                    </div>
                                    <!-- Show Total Active Time -->
                                </div>
                            </div>
                            <div class="row my-4 justify-content-center text-center">
                                <!-- Top Customers -->
                                <div class="col-lg-4 col-8 mt-4">
                                    <label class="form-label fs-4 mb-3 fw-bold">Top Customers</label>
                                    <div class="ms-lg-4">
                                        <div class="ms-5 ps-lg-5">
                                            <img src="./resources/new_user.svg" class="img-thumbnail rounded-circle ms-5 dashboardimg" width="70px">
                                        </div>
                                    </div>
                                    <label class="form-label fs-5">John Doe</label>
                                    <div class="ms-lg-4">
                                        <div class="ms-5 ps-lg-5">
                                            <img src="./resources/new_user.svg" class="img-thumbnail rounded-circle ms-5 dashboardimg" width="70px">
                                        </div>
                                    </div>
                                    <label class="form-label fs-5">John Doe</label>
                                </div>
                                <!-- Top Customers -->
                                <!-- Top Products -->
                                <div class="col-lg-4 col-8 mt-4">
                                    <label class="form-label fs-4 mb-3 fw-bold">Top Products</label>
                                    <div class="ms-lg-4">
                                        <div class="ms-5 ps-lg-5">
                                            <img src="./resources/product_images/Asus Creator Q530VJ2735346759.jpeg" class="img-thumbnail rounded-circle ms-5 dashboardimg" width="70px">
                                        </div>
                                    </div>
                                    <label class="form-label fs-5">John Doe</label>
                                    <div class="ms-lg-4">
                                        <div class="ms-5 ps-lg-5">
                                            <img src="./resources/product_images/Asus Creator Q530VJ2735346759.jpeg" class="img-thumbnail rounded-circle ms-5 dashboardimg" width="70px">
                                        </div>
                                    </div>
                                    <label class="form-label fs-5">John Doe</label>
                                </div>
                                <!-- Top Products -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 addproduct mb-4">
                                        <div class="row mt-4">
                                            <div class="col-12 col-lg-6 offset-lg-3 text-center">
                                                <label class="form-label fw-bold ">Select Product Category</label>
                                            </div>
                                            <div class="col-12 col-lg-6 offset-lg-3">
                                                <select class="form-select text-center" id="category" onchange="displayextraproductdetails();">
                                                    <option value="0">Select Product Category</option>
                                                    <?php
                                                    $category_rs = Database::search("SELECT * FROM `category`");

                                                    for ($i = 0; $i < $category_rs->num_rows; $i++) {
                                                        $category_data = $category_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo ($category_data["category_id"]); ?>"><?php echo ($category_data["category_name"]); ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-4 d-none" id="computerspecification">
                                            <div class="col-12 col-lg-4">
                                                <div class="row ">
                                                    <div class="col-12 col-lg-4 text-center">
                                                        <label class="form-label fw-bold ">Processor</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <select class="form-select text-center" id="processor">
                                                            <option value="1">Select Processor</option>
                                                            <?php
                                                            $processor_rs = Database::search("SELECT * FROM `processor` INNER JOIN `brand` ON processor.brand_brand_id = brand.brand_id");

                                                            for ($i = 0; $i < $processor_rs->num_rows; $i++) {
                                                                $processor_data = $processor_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo ($processor_data["processor_id"]); ?>">
                                                                    <?php echo ($processor_data["processor_name"]); ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="row">
                                                    <div class="col-12 col-lg-4 text-center">
                                                        <label class="form-label fw-bold ">Graphic Card</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <select class="form-select text-center" id="gpu">
                                                            <option value="1">Select GPU</option>
                                                            <?php
                                                            $gpu_rs = Database::search("SELECT * FROM `gui` INNER JOIN `brand` ON gui.brand_brand_id = brand.brand_id");

                                                            for ($i = 0; $i < $gpu_rs->num_rows; $i++) {
                                                                $gui_data = $gpu_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo ($gui_data["graphic_card_id"]); ?>">
                                                                    <?php echo ($gui_data["graphic_card_name"]); ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="row">
                                                    <div class="col-12 col-lg-4 text-center">
                                                        <label class="form-label fw-bold ">RAM</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <select class="form-select text-center" id="ram">
                                                            <option value="1">2 GB</option>
                                                            <option value="2">4 GB</option>
                                                            <option value="3">6 GB</option>
                                                            <option value="4">8 GB</option>
                                                            <option value="5">16 GB</option>
                                                            <option value="6">32 GB</option>
                                                            <option value="7">64 GB</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-lg-6 col-12 mt-3">
                                                <div class="row ">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fw-bold ">Title</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control text-center" id="title" placeholder="Enter Product Title">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12 mt-3">
                                                <div class="row ">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fw-bold ">Brand</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <select class="form-select text-center" id="brand">
                                                            <option value="0">Select Brand</option>
                                                            <?php
                                                            $brand_rs = Database::search("SELECT * FROM `brand`");

                                                            for ($i = 0; $i < $brand_rs->num_rows; $i++) {
                                                                $brand_data = $brand_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo ($brand_data["brand_id"]); ?>">
                                                                    <?php echo ($brand_data["brand_name"]); ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-12 mt-3">
                                                <div class="row ">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fw-bold ">Price</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control text-center" id="price" placeholder="Enter Product Price">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-12 mt-3">
                                                <div class="row ">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fw-bold ">Delevery Fee</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control text-center" id="deleveryfee" placeholder="Enter Product Delevery Cost">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-12 mt-3">
                                                <div class="row ">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fw-bold ">Qty</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group mb-2 mt-2">
                                                            <input type="number" class="form-control text-center" value="0" min="0" id="qty">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-12 mt-3">
                                                <div class="row ">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fw-bold ">Condition</label>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <center>
                                                            <div class="form-check form-check-inline mx-5">
                                                                <input class="form-check-input" type="radio" name="c" id="b" checked />
                                                                <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="c" id="u" />
                                                                <label class="form-check-label fw-bold" for="u">Used</label>
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-12 mt-3">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fw-bold ">Color</label>
                                                    </div>
                                                    <div class="col-8 mt-2">
                                                        <?php $x; ?>
                                                        <select class="form-select text-center" id="color" onchange="showcolor();">
                                                            <option value="0">Select Color</option>
                                                            <?php
                                                            $color_rs = Database::search("SELECT * FROM `color`");

                                                            for ($i = 0; $i < $color_rs->num_rows; $i++) {
                                                                $color_data = $color_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo ($color_data["color_code"]); ?>">
                                                                    <?php echo ($color_data["color_name"]); ?>
                                                                </option>
                                                                <?php $x = $color_data["color_id"]; ?>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-2 mt-2 ms-0">
                                                        <label class="colorlabel" onclick="addcolors();">Click here to add new Colors.</label>
                                                    </div>
                                                    <div class="col-2 mt-2">
                                                        <input type="color" id="mycolor" class="form-control form-control-color" disabled>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-12 mt-3">
                                                <div class="row ">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fw-bold ">Description</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control text-center" id="description" rows="5" placeholder="Enter Product Description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12 col-lg-12 mt-3">
                                                <div class="row ">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fw-bold ">Product Images</label>
                                                    </div>
                                                    <div class="offset-lg-2 col-12 col-lg-8 my-1">
                                                        <div class="row">
                                                            <div class="col-3 rounded">
                                                                <img src="./resources/blankproductimage.svg" style="width: 250px;" id="i0">
                                                            </div>
                                                            <div class="col-3 rounded">
                                                                <img src="./resources/blankproductimage.svg" style="width: 250px;" id="i1">
                                                            </div>
                                                            <div class="col-3 rounded">
                                                                <img src="./resources/blankproductimage.svg" style="width: 250px;" id="i2">
                                                            </div>
                                                            <div class="col-3 rounded">
                                                                <img src="./resources/blankproductimage.svg" style="width: 250px;" id="i3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                                        <input type="file" class="d-none" multiple id="imageuploader" accept="image/jpeg, image/png, image/svg+xml, image/jpg">
                                                        <label for="imageuploader" class="col-12 uploadproductimagesbtn text-center" onclick="addproductimages();">Upload Images</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4 mb-4">
                                            <div class="col-12 col-lg-12 mt-3">
                                                <div class="row ">
                                                    <div class="col-12 text-center">
                                                        <button class="addnewproductbtn" onclick="addproduct();">Add Product</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            <div class="row justify-content-center pt-4">
                                <div class="col-10 col-md-8">
                                    <div class="input-group mb-3 searchpanel">
                                        <input type="text" class="form-control" placeholder="Search for products..." id="searchbox" aria-label="Search" aria-describedby="button-addon2">
                                        <select class="px-3" id="categoryupdate">
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
                                        <button class="searchbtn px-3" onclick="searchmyproducts(0);">Search</button>
                                    </div>
                                </div>
                                <div class="col-12 justify-content-center">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-deck" id="search_results">
                                                <div class="row p-3">
                                                    <?php
                                                    $page_no;
                                                    if (isset($_POST["page"])) {
                                                        if ("0" != $_POST["page"]) {
                                                            $page_no = $_POST["page"];
                                                        } else {
                                                            $page_no = 1;
                                                        }
                                                    } else {
                                                        $page_no = 1;
                                                    }
                                                    $q = "SELECT * FROM `product`";
                                                    $p_rs = Database::search($q);
                                                    $p_num = $p_rs->num_rows;

                                                    $results_per_page = 4;
                                                    $number_of_pages = ceil($p_num / $results_per_page);

                                                    $previus_page_results = ($page_no - 1) * $results_per_page;

                                                    $product_rs = Database::search($q . " LIMIT " . $results_per_page . " OFFSET " . $previus_page_results . "");
                                                    $product_num = $product_rs->num_rows;

                                                    if ($product_num <= 0) {
                                                        //no products
                                                        echo '<div class="col-12 text-center"><h4>No products found.</h4></div>';
                                                        return;
                                                    } else {
                                                        for ($i = 0; $i < $product_num; $i++) {
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
                                                                            <img src="<?php echo ($pimg_data["path"]); ?>" style="">
                                                                        <?php
                                                                        }

                                                                        ?>

                                                                        <div class="overlay">
                                                                            <button class="btn btn-secondary" onclick="updateproductmodal(<?php echo ($product_data['id']); ?>);" title="Update Product"><i class="fa-regular fa-pen-to-square"></i></button>
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

                                                            <!-- Update Product Modal -->
                                                            <div class="modal fade" id="updatemodal<?php echo ($product_data['id']); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo ($product_data['title']); ?></h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php

                                                                            $updateproduct_rs = Database::search("SELECT * FROM `product` INNER JOIN `category` ON product.category_category_id = category.category_id INNER JOIN `brand` ON product.brand_brand_id = brand.brand_id INNER JOIN `condition` ON product.condition_condition_id = condition.condition_id INNER JOIN `color` ON product.color_color_code = color.color_code WHERE `id` = '" . $product_data['id'] . "'");
                                                                            $updateproduct_num = $updateproduct_rs->num_rows;
                                                                            $updateproduct_data = $updateproduct_rs->fetch_assoc();

                                                                            ?>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <label>Category : <?php echo ($updateproduct_data['category_name']); ?></label>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <label>Brand : <?php echo ($updateproduct_data['brand_name']); ?></label>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <label>Price : Rs.<?php echo ($updateproduct_data['price']); ?>.00</label>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <label>Delevery Fee : Rs.<?php echo ($updateproduct_data['delevery_fee']); ?>.00</label>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <label>Condition : <?php echo ($updateproduct_data['condition_name']); ?></label>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <label>Color : <?php echo ($updateproduct_data['color_name']); ?></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-6">
                                                                                    <label class="form-label" for="title<?php echo ($product_data['id']); ?>">Title</label>
                                                                                    <input type="text" class="form-control" id="title<?php echo ($product_data['id']); ?>" value="<?php echo ($updateproduct_data['title']); ?>">
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <label class="form-label" for="quantity<?php echo ($product_data['id']); ?>">Quantity</label>
                                                                                    <input type="number" class="form-control" id="qty<?php echo ($product_data['id']); ?>" value="<?php echo ($updateproduct_data['product_qty']); ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-12 text-center">
                                                                                    <label class="form-label" for="description<?php echo ($product_data['id']); ?>">Description</label>
                                                                                    <textarea class="form-control" id="description<?php echo ($product_data['id']); ?>" rows="3"><?php echo ($updateproduct_data['description']); ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-12 text-center">
                                                                                    <label class="form-label">Product Images</label>
                                                                                </div>
                                                                                <?php
                                                                                $product_image_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $product_data['id'] . "'");
                                                                                $product_image_num = $product_image_rs->num_rows;

                                                                                $img = array();

                                                                                $img[0] = "./resources/blankproductimage.svg";
                                                                                $img[1] = "./resources/blankproductimage.svg";
                                                                                $img[2] = "./resources/blankproductimage.svg";
                                                                                $img[3] = "./resources/blankproductimage.svg";

                                                                                for ($x = 0; $x < $product_image_num; $x++) {
                                                                                    $product_image_data = $product_image_rs->fetch_assoc();
                                                                                    $img[$x] = $product_image_data['path'];
                                                                                }

                                                                                ?>
                                                                                <div class="offset-lg-2 col-12 col-lg-8 my-1">
                                                                                    <div class="row">
                                                                                        <div class="col-3 rounded">
                                                                                            <img src="<?php echo ($img[0]); ?>" style="width: 250px;" id="i0<?php echo ($product_data['id']); ?>">
                                                                                        </div>
                                                                                        <div class="col-3 rounded">
                                                                                            <img src="<?php echo ($img[1]); ?>" style="width: 250px;" id="i1<?php echo ($product_data['id']); ?>">
                                                                                        </div>
                                                                                        <div class="col-3 rounded">
                                                                                            <img src="<?php echo ($img[2]); ?>" style="width: 250px;" id="i2<?php echo ($product_data['id']); ?>">
                                                                                        </div>
                                                                                        <div class="col-3 rounded">
                                                                                            <img src="<?php echo ($img[3]); ?>" style="width: 250px;" id="i3<?php echo ($product_data['id']); ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class=" justify-content-center d-grid mt-3">
                                                                                    <input type="file" class="d-none" multiple id="imageupdate<?php echo ($product_data['id']); ?>" accept="image/jpeg, image/png, image/svg+xml, image/jpg">
                                                                                    <label for="imageupdate<?php echo ($product_data['id']); ?>" class="col-12 uploadproductimagesbtn text-center" onclick="updateimages(<?php echo ($product_data['id']); ?>);">Update Images</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button type="button" class="btn btn-primary" onclick="updateproduct(<?php echo ($product_data['id']); ?>);">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Update Product Modal -->
                                                    <?php
                                                        }
                                                    }

                                                    ?>

                                                </div>
                                                <!-- Pagination -->
                                                <nav>
                                                    <ul class="pagination d-flex justify-content-center flex-wrap pagination-rounded-flat pagination-success">
                                                        <?php
                                                        if ($page_no > 1) {
                                                        ?>
                                                            <li class="page-item"><a class="page-link" onclick="changemyproductspages(<?php echo ($page_no - 1) ?>)" href="#" data-abc="true"><i class="fa fa-angle-left"></i></a></li>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <li class="page-item disabled opacity-50" disabled><a class="page-link disabled" disabled href="#" data-abc="true"><i class="fa fa-angle-left"></i></a></li>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        for ($x = 1; $x < $number_of_pages + 1; $x++) {
                                                            if ($page_no == $x) {
                                                        ?>
                                                                <li class="page-item active"><a class="page-link" href="#" onclick="changemyproductspages(<?php echo ($x); ?>);" data-abc="true"><?php echo ($x); ?></a></li>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <li class="page-item"><a class="page-link" href="#" onclick="changemyproductspages(<?php echo ($x); ?>);" data-abc="true"><?php echo ($x); ?></a></li>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($page_no < $number_of_pages) {
                                                        ?>
                                                            <li class="page-item"><a class="page-link" onclick="changemyproductspages(<?php echo ($page_no + 1) ?>)" href="#" data-abc="true"><i class="fa fa-angle-right"></i></a></li>
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
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="manageusers-tab-pane" role="tabpanel" aria-labelledby="manageusers-tab" tabindex="0">
                            <!-- Search Box with Category -->
                            <div class="row justify-content-center mt-4 mb-2">
                                <div class="col-8 col-md-6">
                                    <div class="input-group mb-3 searchpanel">
                                        <input type="text" class="form-control" placeholder="Search for Email" id="email_input" aria-label="Search" aria-describedby="button-addon2" onkeyup="searchusers();">
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-12 manageuserspage">
                                    <table class="table tables">
                                        <thead>
                                            <tr>
                                                <th scope="col-2">ID</th>
                                                <th scope="col-3">Name</th>
                                                <th scope="col-3">Email</th>
                                                <th scope="col-2">Status</th>
                                                <th scope="col-2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="users_data">
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `status` ON user.status_id = status.id_status");
                                            $user_num = $user_rs->num_rows;

                                            for ($x = 0; $x < $user_num; $x++) {
                                                $user_data = $user_rs->fetch_assoc();
                                            ?>
                                                <tr>
                                                    <td data-label="#"><?php echo ($user_data["id"]); ?></td>
                                                    <td data-label="Name"><?php echo ($user_data["fname"] . " " . $user_data["lname"]); ?></td>
                                                    <td data-label="Email"><?php echo ($user_data["email"]); ?></td>
                                                    <td data-label="Status" id="statustype<?php echo ($user_data["id"]); ?>"><?php echo ($user_data["type"]); ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btnmanageusers btn-sm mx-1" onclick="changeuserstatus(<?php echo ($user_data['id']); ?>);">Change Status</a>
                                                        <a href="#" class="btn btn-primary seemsgbtnmanageusers btn-sm mx-1" onclick="seemessages(<?php echo ($user_data['id']); ?>);">See Messages</a>
                                                    </td>
                                                </tr>

                                                <!-- seemessages -->
                                                <div class="modal" tabindex="-1" id="seemessages<?php echo ($user_data['id']); ?>">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header modalheader">
                                                                <h5 class="modal-title"><?php echo ($user_data['fname'] . " " . $user_data["lname"]); ?></h5>
                                                                <button type="button" class="btn-close modalclosebtn" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body modalbody">
                                                                <div class="row">
                                                                    <!-- Show recieved messages -->
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <?php
                                                                            $contact_us_rs = Database::search("SELECT * FROM `contact_us` WHERE `user_id` = '" . $user_data['id'] . "'");
                                                                            $contact_us_num = $contact_us_rs->num_rows;

                                                                            if ($contact_us_num == 0) {
                                                                            ?>
                                                                                <div class="col-12">
                                                                                    <p class="card-text fs-4" style="color:black;">No Messages Yet.</p>
                                                                                </div>
                                                                                <?php
                                                                            } else {
                                                                                for ($y = 0; $y < $contact_us_num; $y++) {
                                                                                    $contact_us_data = $contact_us_rs->fetch_assoc();
                                                                                ?>
                                                                                    <div class="col-12 mb-2">
                                                                                        <div class="card">
                                                                                            <div class="card-body">
                                                                                                <p class="card-text fs-4"><?php echo ($contact_us_data["contact_us_msg"]); ?></p>
                                                                                                <p class="text-muted text-end">Sent on: <?php echo ($contact_us_data["contact_us_date"]); ?></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                            <?php
                                                                                }
                                                                            }

                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Show recieved messages -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- seemessages -->
                                            <?php
                                            }

                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- colorpickermodel -->
                    <div class="modal" tabindex="-1" id="colorchange">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header modalheader">
                                    <h5 class="modal-title">Add or Change Colors</h5>
                                    <button type="button" class="btn-close modalclosebtn" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body modalbody">
                                    <div class="row g-3">
                                        <div>
                                            <div class="col-12 d-none" id="msgdiv1">
                                                <div class="alert alert-danger" role="alert" id="msg1"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label colorchangelabel">Enter Color Name & Select Color</label>

                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" id="colorname">

                                        </div>

                                        <div class="col-6">
                                            <input type="color" class="form-control form-control-color" id="colorcode">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer modalfooter">
                                    <button type="button" class="modalfooterbtn" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="modalfooterbtn" onclick="addcolor();">Add Color</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- colorpickermodel -->

                </div>
            </div>
        </div>
        <script src="./js/bootstrap.js"></script>
        <script src="./js/script.js"></script>
        <script src="./js/bootstrap.bundle.js"></script>
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: index.php");
}

?>