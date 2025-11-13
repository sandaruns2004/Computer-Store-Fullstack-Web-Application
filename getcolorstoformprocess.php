<?php

include "connection.php";

?>

<option value="0">Select Color</option>
<?php
$color_rs = Database::search("SELECT * FROM `color`");

for ($i = 0; $i < $color_rs->num_rows; $i++) {
    $color_data = $color_rs->fetch_assoc();
?>
    <option value="<?php echo ($color_data["color_code"]); ?>">
        <?php echo ($color_data["color_name"]); ?>
    </option>
<?php
}
?>

<?php

?>