<?php

session_start();
include "connection.php";

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

<h5 class="text-center txt2">Cart Summery <span class=" small">(<?php echo ($cart_summery_num); ?>) items</span> </h5>
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

<?php

?>