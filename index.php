<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Store | SignIn</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="icon" href="./resources/logo.svg">
</head>

<body class="body">
    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">
            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center txt1">Welcome to Computer Store</p>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- content -->
            <div class="col-12 p-3">

                <div class="row indexuserprofilebackground">

                    <!-- signup -->
                    <div class="col-lg-6 offset-lg-3 col-12 d-none" id="signupbox">
                        <div class="row g-2 mb-3">
                            <div class="col-12">
                                <p class="text-center txt2">Create User Account</p>
                            </div>

                            <div class="col-12 d-none g-1" id="msgdiv1">
                                <div class="alert alert-danger" role="alert" id="msg1"></div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" placeholder="Ex- Sandaru">
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" placeholder="Ex- Samarasekara">
                            </div>

                            <div class="col-12">
                                <label for="uname" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="uname" placeholder="Ex- sandaruns2004">
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Ex- sandaruns2004@gmail.com">
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="pwd" class="form-label">Password</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter Your Password">
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="cpwd" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="cpwd" placeholder="Confirm Your Password">
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="mobile" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile" placeholder="Ex- 0767588712">
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender">
                                    <?php
                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $num = $rs->num_rows;

                                    for ($i = 0; $i < $num; $i++) {
                                        $data = $rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $data["id"] ?>"><?php echo $data["name"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="changeviewbtn" onclick="signup()">Continue Registration</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="changeviewbtn" onclick="changeform()">Already User of Book Store</button>
                            </div>
                        </div>
                    </div>
                    <!-- signup -->

                    <!-- signin -->
                    <div class="col-lg-6 offset-lg-3 col-12" id="signinbox">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="text-center txt2">Sign In</p>
                            </div>

                            <div class="col-12 d-none" id="msgdiv2">
                                <div class="alert alert-danger" role="alert" id="msg2"></div>
                            </div>

                            <?php
                            $username = "";
                            $password = "";

                            if (isset($_COOKIE["username"])) {
                                $username = $_COOKIE["username"];
                                $password = $_COOKIE["password"];
                            }

                            ?>

                            <div class="col-12">
                                <label for="uname2" class="form-label">Username</label>
                                <input type="text" value="<?php echo ($username) ?>" class="form-control" id="uname2">
                            </div>

                            <div class="col-12">
                                <label for="password2" class="form-label">Password</label>
                                <input type="password" value="<?php echo ($password) ?>" class="form-control" id="password2">
                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberme">
                                    <label for="rememberme" class="form-check-label fw-bold">Remember Me</label>
                                </div>
                            </div>

                            <div class="col-6 text-end">
                                <a href="#" class="link-primary fw-bold" onclick="forgotpassword()">Fogot Password</a>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="changeviewbtn" onclick="signin()">Sign In</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="changeviewbtn" onclick="changeform()">Register for Computer Store</button>
                            </div>
                        </div>
                    </div>
                    <!-- signin -->

                    <!-- modalregister -->

                    <div class="modal" tabindex="-1" id="fpregister">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header modalheader">
                                    <h5 class="modal-title">Verify Email</h5>
                                    <button type="button" class="btn-close modalclosebtn" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body modalbody">
                                    <div class="row g-3">
                                        <div>
                                            <div class="col-12 d-none" id="msgdiv4">
                                                <div class="alert alert-danger" role="alert" id="msg4"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Verification Code</label>
                                            <input type="text" class="form-control" id="verifycode">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer modalfooter">
                                    <button type="button" class="modalfooterbtn" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="modalfooterbtn" onclick="register()">Register</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modalregister -->

                    <!-- modalreset -->

                    <div class="modal" tabindex="-1" id="fpmodal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header modalheader">
                                    <h5 class="modal-title">Forgot Password</h5>
                                    <button type="button" class="btn-close modalclosebtn" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body modalbody">
                                    <div class="row g-3">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Enter Your Email Address" id="mailforpassword">
                                            <button class="modalgroupbtn" type="button" id="sendoptbtn" onclick="sendmailforgotpassword()">Send Email</button>
                                        </div>
                                        <div>
                                            <div class="col-12 d-none" id="msgdiv3">
                                                <div class="alert alert-danger" role="alert" id="msg3"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">New Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" id="np">
                                                <button class="modalgroupbtn" type="button" id="npb" onclick="showpassword1();">Show</button>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">Re-type Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" id="rp">
                                                <button class="modalgroupbtn" type="button" id="rpb" onclick="showpassword2();">Show</button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Verification Code</label>
                                            <input type="text" class="form-control" id="code">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer modalfooter">
                                    <button type="button" class="modalfooterbtn" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="modalfooterbtn" onclick="resetpassword()">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modalreset -->
                </div>
                <!-- content -->
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
    <script src="./js/bootstrap.js"></script>
</body>

</html>