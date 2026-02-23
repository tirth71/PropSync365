    !<?php
    session_start();
    if(@$_SESSION['email']) {
        include("config.php");
        if(isset($_POST['submit'])) {
            if(isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $qry = "SELECT * FROM tbl_user WHERE user_email = '$email'";
                $row1 = mysqli_query($con, $qry);
                if($row1) {
                    $result1 = mysqli_fetch_assoc($row1);
                    if($result1) {
                        $u_id = $result1['user_id'];
                        $old = $result1['user_password'];
                    } else {
                        echo "<script>alert('User not found.'); window.location.href = 'index.php';</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('Error fetching user data.'); window.location.href = 'index.php';</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Session data not found.'); window.location.href = 'index.php';</script>";
                exit;
            }

            $pass = $_REQUEST['old_password'];
            $pass1 = $_REQUEST['password'];
            $new_pass = $_REQUEST['confirm_password'];

            // // Debugging: Print fetched and entered passwords
            echo "Fetched password: $old<br>";
            echo "Entered password: $pass<br>";

            // Verify passwords
            if($pass == $old) {
                // Passwords match, continue with password change logic
                if($pass1 == $new_pass) {
                    
                    $sql = "UPDATE tbl_user SET user_password = '$new_pass' WHERE user_id = '$u_id'";
                    $res = mysqli_query($con, $sql);
                    if($res) {
                        echo "<script>alert('Your password has been changed successfully.'); window.location.href = 'index.php';</script>";
                        exit;
                    } else {
                        echo "<script>alert('Failed to update password.'); window.location.href = 'change-password.php';</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('Your password and confirm password do not match.'); window.location.href = 'change-password.php';</script>";
                    exit;
                }
            } else {
                // Debugging: Print message if passwords do not match
                echo "<script>alert('Password comparison failed.'); window.location.href = 'change-password.php';</script>";
                exit;
            }
        }
        include("header.php");
    ?>

    <!-- #page-title end -->

    <!-- #user-profile ============================================= -->
    <section id="user-profile" class="user-profile" style="padding-top: 0px; padding-bottom: 0px;">
        <div style="padding-top: 120px; padding-bottom: 70px;">
            <div class="bg-section">
                <img src="assets/images/slider/slide-bg/new-hero-image.jpg" alt="Background" />
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="edit--profile-area">
                            <ul class="edit--profile-links list-unstyled mb-0">
                                <?php if(@$_SESSION['user_type'] == 1 && @$_SESSION['email']) {?>
                                <li><a href="user-profile-owner.php">Edit Profile</a></li>
                                <li><a href="my-properties.php">My Properties</a></li>
                                <li><a href="add-property.php">Add Property</a></li>
                                <li><a href="change-password.php" class="active">Change Password</a></li>
                                <?php }?>
                                <?php if(@$_SESSION['user_type'] == 0 && @$_SESSION['email']) {?>
                                <li><a href="user-profile-user.php">Edit Profile</a></li>
                                <li><a href="properties-list.php">Properties list</a></li>
                                <li><a href="my-properties-user.php">Purchased Properties</a></li>
                                <li><a href="change-password.php" class="active">Change Password</a></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <!-- .col-md-4 -->
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <form class="mb-0" method="post">

                            <!-- .form-box end -->
                            <div class="page-title bg-overlay bg-overlay-dark2">

                                <div class="form-box1">
                                    <h4 class="form--title">Change Password</h4>
                                    <div class="form-group">
                                        <label1 for="password">Current password</label1>
                                        <input type="password" class="form-control" name="old_password" id="old_password">
                                    </div>
                                    <div class="form-group">
                                        <label1 for="password">New password</label1>
                                        <input type="password" class="form-control" name="password" id="password" required="">
                                    </div>
                                    <!-- .form-group end -->
                                    <div class="form-group">
                                        <label1 for="confirm-password">Confirm new password</label1>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required="">
                                    </div>
                                    <!-- .form-group end -->
                                    <div class="action-row">
                                        <button type="submit" class="btn-save">SAVE CHANGES</button>

                                        <a href="forgot-password.php" class="forgot-link">Forgot password?</a>
                                    </div>
                                </div>
                                <!-- .form-box end -->

                            </form>
                        </div>
                        <!-- .col-md-8 end -->
                    </div>
                    <!-- .row end -->
                </div>
            </div>
    </section>
    <!-- #user-profile  end -->

    <!-- Footer #1 ============================================= -->
    <?php include("footer.php"); ?>
    </div>
    <!-- #wrapper end -->
    <?php } else header("location:index.php");?>

    <!-- Footer Scripts ============================================= -->
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/functions.js"></script>
    </body>

    </html>
