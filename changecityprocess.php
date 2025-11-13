<?php

include "connection.php";

$district = $_GET["d"];

$city_set = Database::search("SELECT * FROM `cities` WHERE `district_district_id` = '". $district ."'");

for ($i = 0; $i < $city_set->num_rows; $i++) {
    $city_data = $city_set->fetch_assoc();
?>
    <option value="<?php echo ($city_data["city_id"]) ?>"><?php echo ($city_data["city_name_en"]) ?></option>
<?php
}



?>