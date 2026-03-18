<?php
session_start();
if(@$_SESSION['user_type']==1 && @$_SESSION['email'])
{
include ("config.php");
if(isset($_POST['submit']))
{
    if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $qry = "SELECT * FROM tbl_user Where user_email = '$email' AND user_type=1";


    $row1 = mysqli_query($con,$qry);
    $result1 = mysqli_fetch_assoc($row1);
    $u_id = $result1['user_id'];
    }
       $name=$_REQUEST['name'];
       $email = $_REQUEST['email_address'];
       $phone = $_REQUEST['phone'];
       $id=$u_id;


  $sql = "UPDATE tbl_user SET user_name='$name',user_email='$email',user_mobile='$phone' where user_id = '$id'";
// echo $sql;
// exit();
  $res=mysqli_query($con,$sql);

  $result_cnt=mysqli_affected_rows($con);

  
  if($result_cnt>0){
    echo "<script>alert('your Profile updated..!!');window.location.href = 'index.php';</script>";
    }
    else{
       echo "<script>alert('your profile not updated..!!');window.location.href = 'user-profile-owner.php';</script>";
    }
}
include("header.php");
?>

        
        <!-- #page-title end -->

        <!-- #user-profile
============================================= -->
      <section id="add-property" class="user-profile" style="padding-top: 0px;padding-bottom: 0px;">
            <div  style="padding-top: 120px; padding-bottom: 70px;">
            <div class="bg-section">
                <img src="assets/images/slider/slide-bg/dark_back.png  " alt="Background" />
            </div>
            <!--  <div class="page-title bg-overlay bg-overlay-dark2" >  -->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      
                        <div class="edit--profile-area">
                            <ul class="edit--profile-links list-unstyled mb-0">
                                <li><a href="user-profile-owner.php" class="active">Edit Profile</a></li>
                                <!-- <li><a href="social-profile.html">Social Profiles</a></li> -->
                                <li><a href="my-properties.php">My Properties</a></li>
                                <!-- <li><a href="favourite-properties.html">Favorite Properties</a></li> -->
                                <li><a href="add-property.php">Add Property</a></li>
                                <li><a href="change-password.php">change Password</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- .col-md-4 -->
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <form class="mb-0" method="post">
                            <div >
                                
                            </div>
                            <div class="page-title bg-overlay bg-overlay-dark2" >
                            <div class="form-box1">

                                <?php if(@$_SESSION['user_type']==1 && @$_SESSION['email']){
                                    $type=@$_SESSION['user_type'];
                                    $email = $_SESSION['email'];
                                    $q = "SELECT * FROM tbl_user where user_type = '$type' AND user_email='$email'";
                                    $row = mysqli_query($con,$q);
                                    while ($result = mysqli_fetch_assoc($row)) {?>
                                <h4 class="form--title">Personal Details</h4>
                                <div class="form-group">
                                    <label1 for="first-name">Name</label1>
                                    <input type="text" class="form-control" value="<?php echo @$result['user_name'];?>" name="name" id="name">
                                </div>
                                <!-- .form-group end -->
                                <div class="form-group">
                                    <label1 for="email-address">Email Address</label1>
                                    <input type="email" class="form-control" value="<?php echo @$result['user_email'];?>" name="email_address" id="email_address">
                                </div>
                                <!-- .form-group end -->
                                <div class="form-group">
                                    <label1 for="phone-number">Phone</label1>
                                    <input type="text" class="form-control" value="<?php echo @$result['user_mobile'];?>" name="phone" id="phone">
                                </div>
                                <!-- .form-group end -->
                                 <?php } }?>
                            
                            
                            <input type="submit" value="Save Edits" name="submit" class="btn btn--primary"></div>
                        </form>
                    </div>
                    <!-- .col-md-8 end -->
                </div>
                <!-- .row end -->
            </div>
        </div>
        </section>
        <!-- #user-profile  end -->

        <!-- cta #1
============================================= -->
        <!--  -->
        <!-- #cta1 end -->


        <!-- Footer #1
============================================= -->
        <?php include("footer.php"); ?>\
        <?php } else header("location:index.php");?>
    </div>
    <!-- #wrapper end -->

    <!-- Footer Scripts
============================================= -->
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/functions.js"></script>

