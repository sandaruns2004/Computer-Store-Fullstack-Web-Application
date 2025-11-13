<?php

include "connection.php";

$txt = $_POST["txt"];
$cat_id = $_POST["cat_id"];
$page_no;

if (isset($_POST["pageno"])) {
    if ("0" != $_POST["pageno"]) {
        $page_no = $_POST["pageno"];
    } else {
        $page_no = 1;
    }
} else {
    $page_no = 1;
}

?>

<div class="row p-3">
    <?php

    $q = "SELECT * FROM `product`";

    if ($txt != "" && $cat_id == 0) {
        //keyword already
        $q .= " WHERE `title` LIKE '%" . $txt . "%'";
    } else if ($txt == "" && $cat_id != 0) {
        //category already
        $q .= " WHERE `category_category_id` = '" . $cat_id . "'";
    } else if ($txt != "" && $cat_id != 0) {
        $q .= " WHERE `category_category_id` = '" . $cat_id . "' AND `title` LIKE '%" . $txt . "%'";
    }

    $p_rs = Database::search($q);
    $p_num = $p_rs->num_rows;

    $results_per_page = 4;
    $number_of_pages = ceil($p_num / $results_per_page);

    $previus_page_results = ($page_no - 1) * $results_per_page;

    $product_rs = Database::search($q . " LIMIT " . $results_per_page . " OFFSET " . $previus_page_results . "");
    $product_num = $product_rs->num_rows;

    if ($product_num <= 0) {
        //no products
        echo '<div class="my-3"><div class="col-12 text-center my-5 py-5"><h4>No products found.</h4></div></div>';
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
            <li class="page-item"><a class="page-link" onclick="searchmyproducts(<?php echo ($page_no - 1) ?>)" href="#" data-abc="true"><i class="fa fa-angle-left"></i></a></li>
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
                <li class="page-item active"><a class="page-link" href="#" onclick="searchmyproducts(<?php echo ($x); ?>);" data-abc="true"><?php echo ($x); ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" href="#" onclick="searchmyproducts(<?php echo ($x); ?>);" data-abc="true"><?php echo ($x); ?></a></li>
        <?php
            }
        }
        ?>
        <?php
        if ($page_no < $number_of_pages) {
        ?>
            <li class="page-item"><a class="page-link" onclick="searchmyproducts(<?php echo ($page_no + 1) ?>)" href="#" data-abc="true"><i class="fa fa-angle-right"></i></a></li>
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

<?php




?>