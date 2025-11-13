<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Store | UserProfile</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="icon" href="./resources/logo.svg">
</head>

<body class="userprofilebackground">
    <?php
    session_start();
    include "header.php";
    ?>
    <div class="container-fluid mt-4">
        <?php
        if (isset($_SESSION["u"])) {
            $username = $_SESSION["u"]["uname"];
            $userid = $_SESSION["u"]["id"];

            $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON gender.id = user.gender_id WHERE `uname` = '" . $username . "'");
            $image_rs = Database::search("SELECT * FROM `profile_images` WHERE `user_id` = '" . $userid . "'");


            $user_data = $user_rs->fetch_assoc();
            $image_data = $image_rs->fetch_assoc();
        ?>
            <div class="row g-2">
                <!-- Profile Image -->
                <div class="col-lg-4 col-md-6 col-12 ">
                    <div class="d-flex flex-column align-items-center text-center p-3 ">
                        <?php
                        if (empty($image_data)) {
                        ?>
                            <img src="./resources/new_user.svg" class="profileimage mt-5 " style="width: 150px;" id="profileimage" />
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo ($image_data["path"]); ?>" class="profileimage mt-5" style="width: 150px;" id="profileimage" />
                        <?php
                        }
                        ?>
                        <span class="fw-bold text-danger d-none">file format doesn't supported</span>
                        <span class="fw-bold mt-3"><?php echo ($user_data["fname"] . " " . $user_data["lname"]); ?></span>
                        <span class="fw-bold"><?php echo ($username); ?></span>
                        <span class="fw-bold text-black-50"><?php echo ($user_data["email"]); ?></span>
                        <input type="file" accept="image/jpeg, image/png, image/svg+xml" class="d-none" id="imagepicker" />
                        <label for="imagepicker" class="changeviewbtn mt-3" onclick="changeprofileimage();">Upload Profile Image</label>
                    </div>
                </div>
                <!-- Profile Image -->

                <!-- General Details -->
                <div class="col-lg-8 col-md-6 col-12 container pt-4">
                    <div class="row g-3 mx-3 borderform">
                        <div class="text-center">
                            <h3 class="text-center subtopic">General Details</h3>
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="uname" class="form-label">Username</label>
                            <input type="text" class="form-control userprofilebackgrounddisabled" id="uname" placeholder="Enter Your Username" disabled value="<?php echo ($username); ?>">
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control userprofilebackgrounddisabled" id="email" placeholder="Enter Your Email" disabled value="<?php echo ($user_data["email"]); ?>">
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" placeholder="Enter your First Name" value="<?php echo ($user_data["fname"]); ?>">
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" placeholder="Enter your Last Name" value="<?php echo ($user_data["lname"]); ?>">
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control userprofilebackgrounddisabled" id="password" placeholder="Enter your Password" disabled value="<?php echo ($user_data["password"]); ?>">
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="registereddate" class="form-label">Registered Date</label>
                            <input type="text" class="form-control userprofilebackgrounddisabled" id="registereddate" placeholder="Enter your Registered Date" disabled value="<?php echo ($user_data["registered_date"]); ?>">
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile" placeholder="Enter your Mobile Number" value="<?php echo ($user_data["mobile"]); ?>">
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" class="form-control userprofilebackgrounddisabled" id="gender" placeholder="Enter your Gender" disabled value="<?php echo ($user_data["name"]); ?>">
                        </div>
                    </div>
                </div>
                <!-- General Details -->

                <!-- Address Details -->
                <div class="col-lg-12 col-md-12 col-12 mt-2 mb-4 mt-5 container">
                    <div class="row g-3 mx-4 borderform">
                        <div class="text-center">
                            <h3 class="text-center subtopic">Address Details</h3>
                        </div>
                        <?php
                        $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `cities`  ON `user_has_address`.`cities_city_id` = `cities`.`city_id` 
                        INNER JOIN `districts` ON `cities`.`district_district_id` = `districts`.`district_id` 
                        INNER JOIN `provinces` ON `districts`.`province_province_id` = `provinces`.`province_id` WHERE `user_id` = '" . $userid . "'");
                        $address_data = $address_rs->fetch_assoc();
                        ?>
                        <div class="col-lg-12 col-12">
                            <label for="line1" class="form-label">Address Line 01</label>
                            <?php
                            if (empty($address_data["line1"])) {
                            ?>
                                <input type="text" class="form-control" id="line1" placeholder="Ex- Address No, First Lane">
                            <?php
                            } else {
                            ?>
                                <input type="text" class="form-control" id="line1" value="<?php echo ($address_data["line1"]) ?>">
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-lg-12 col-12">
                            <label for="line2" class="form-label">Address Line 02</label>
                            <?php
                            if (empty($address_data["line2"])) {
                            ?>
                                <input type="text" class="form-control" id="line2" placeholder="Ex- Second Lane, City">
                            <?php
                            } else {
                            ?>
                                <input type="text" class="form-control" id="line2" value="<?php echo ($address_data["line2"]) ?>">
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        $province_rs = Database::search("SELECT * FROM `provinces`");
                        $district_rs = Database::search("SELECT * FROM `districts`");
                        $city_rs = Database::search("SELECT * FROM `cities`");
                        ?>
                        <div class="col-lg-6 col-12">
                            <label for="province" class="form-label">Province</label>
                            <select name="province" id="province" onchange="selectdistrict();" class="form-select">
                                <option value="0">Select Province</option>
                                <?php
                                for ($i = 0; $i < $province_rs->num_rows; $i++) {
                                    $province_data = $province_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($province_data["province_id"]) ?>"
                                        <?php if (!empty($address_data["province_id"])) {
                                            if ($address_data["province_id"] == $province_data["province_id"]) {
                                        ?> selected <?php
                                                }
                                            } ?>>
                                        <?php echo ($province_data["province_name_en"]) ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="district" class="form-label">District</label>
                            <select name="district" id="district" onchange="selectcity();" class="form-select">
                                <option value="0">Select District</option>
                                <?php
                                for ($i = 0; $i < $district_rs->num_rows; $i++) {
                                    $district_data = $district_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($district_data["district_id"]) ?>"
                                        <?php if (!empty($address_data["district_id"])) {
                                            if ($address_data["district_id"] == $district_data["district_id"]) {
                                        ?>selected<?php
                                                }
                                            } ?>>
                                        <?php echo ($district_data["district_name_en"]) ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="city" class="form-label">City</label>
                            <select name="city" id="city" onchange="getpcode();" class="form-select">
                                <option value="0">Select City</option>
                                <?php
                                for ($i = 0; $i < $city_rs->num_rows; $i++) {
                                    $city_data = $city_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($city_data["city_id"]) ?>"
                                        <?php if (!empty($address_data["city_id"])) {
                                            if ($address_data["city_id"] == $city_data["city_id"]) {
                                        ?>selected<?php
                                                }
                                            } ?>>
                                        <?php echo ($city_data["city_name_en"]) ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="postalcode" class="form-label">Postal Code</label>
                            <?php
                            if (empty($address_data["postcode"])) {
                            ?>
                                <input type="text" class="form-control" id="postalcode" placeholder="Enter your Postal Code">
                            <?php
                            } else {
                            ?>
                                <input type="text" class="form-control" id="postalcode" placeholder="Enter your Postal Code" value="<?php echo ($address_data["postcode"]) ?>">
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-lg-6 col-12 d-grid">
                            <button class="updateuserprofilebtn" onclick="updateprofile();">Update User Profile</button>
                        </div>
                        <div class="col-lg-6 col-12 d-grid">
                            <button type="button" class="deleteuserprofile">Delete User Profile</button>
                        </div>
                    </div>
                </div>
                <!-- Address Details -->
            </div>
        <?php
        } else {
            //blank user
        ?>
            <div class="row my-5 py-5">
                <div class="col-12 text-center py-5 my-5">
                    <h2>No User Profile Found</h2>
                </div>
            </div>
    </div>
<?php
        }
?>
</div>
<?php include "footer.php"; ?>
</body>
</html>