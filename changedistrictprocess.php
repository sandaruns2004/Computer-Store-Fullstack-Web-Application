<?php

include "connection.php";

$province = $_GET["p"];

$district_set = Database::search("SELECT * FROM `districts` WHERE `province_province_id` = '" . $province . "'");

for ($i = 0; $i < $district_set->num_rows; $i++) {
    $district_data = $district_set->fetch_assoc();
?>
    <option value="<?php echo ($district_data["district_id"]) ?>"><?php echo ($district_data["district_name_en"]) ?></option>
<?php
}



?>