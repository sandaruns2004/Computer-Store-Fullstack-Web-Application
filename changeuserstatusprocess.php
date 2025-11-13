<?php

include "connection.php";

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $one_user_rs = Database::search("SELECT * FROM `user` WHERE `id` = '" . $id . "'");
    $one_user_data = $one_user_rs->fetch_assoc();

    if($one_user_data["status_id"] == 1){
        Database::iud("UPDATE `user` SET `status_id` = '2' WHERE `id` = '" . $id . "'");
        echo "User Deactivated Successfully.";
    }else if($one_user_data["status_id"] == 2){
        Database::iud("UPDATE `user` SET `status_id` = '1' WHERE `id` = '" . $id . "'");
        echo "User Reactivated Successfully.";
    }

} else {
    echo "Something Went Wrong.";
}
