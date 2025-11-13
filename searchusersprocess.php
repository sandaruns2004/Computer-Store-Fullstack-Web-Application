<?php

$txt = $_POST["txt"];
include "connection.php";

if (isset($txt)) {
    $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `status` ON user.status_id = status.id_status WHERE `email` LIKE '%" . $txt . "%'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 0) {
        echo "No users found.";
    } else {
        for ($x = 0; $x < $user_num; $x++) {
            $user_data = $user_rs->fetch_assoc();
?>
            <tr>
                <td data-label="#"><?php echo ($user_data["id"]); ?></td>
                <td data-label="Name"><?php echo ($user_data["fname"] . " " . $user_data["lname"]); ?></td>
                <td data-label="Email"><?php echo ($user_data["email"]); ?></td>
                <td data-label="Status" id="statustype<?php echo ($user_data["id"]); ?>"><?php echo ($user_data["type"]); ?></td>
                <td><a href="#" class="btn btn-primary editbtnmanageusers btn-sm mx-1" onclick="changeuserstatus(<?php echo ($user_data['id']); ?>);">Change Status</a></td>
            </tr>
<?php
        }
    }
} else {
    echo "No search keyword provided.";
}
