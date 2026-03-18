<?php
session_start();
if(@$_SESSION['user_type']==0 && @$_SESSION['email'])
{
include ("config.php");
    $start=0;
    $limit=3;

    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $start=($id-1)*$limit;
    }
    else{
        $id=1;
    }

    
        $email=$_SESSION['email'];
        $qry = "SELECT * FROM tbl_user Where user_email = '$email' AND user_type=0";
        $row1 = mysqli_query($con,$qry);
        $result1 = mysqli_fetch_assoc($row1);
        $user_id = $result1['user_id'];
    
    $query = "SELECT * FROM tbl_property Where buyer_id='$user_id' AND live_status=2";


    $query_l = " LIMIT ".$start.", ".$limit;

    $row = mysqli_query($con,$query.$query_l);

    $row1 = mysqli_query($con,$query);

    $count = mysqli_num_rows($row1);

    $total=ceil($count/$limit);

include("header.php"); 
?>


<!-- #page-title end -->


 <section id="add-property" class="my-properties properties-list" style="padding-top: 0px;padding-bottom: 0px;">
    <div  style="padding-top: 120px; padding-bottom: 70px;" class="main-hero-section-common">
              <!-- <div class="bg-section">
                <img src="assets/images/slider/slide-bg/new-hero-image.jpg" alt="Background" />
            </div> -->
            <div class="bg-section">
                <img src="assets/images/slider/slide-bg/dark_back.png" alt="Background" />
            </div>
        <div class="page-title bg-overlay bg-overlay-dark2" > 
        <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="edit--profile-area">
                    <ul class="edit--profile-links list-unstyled mb-0">
                        
                        <!-- <li><a href="social-profile.html">Social Profiles</a></li> -->
                        <li><a href="user-profile-user.php" class="active">Edit Profile</a></li>
                        <!-- <li><a href="favourite-properties.html">Favorite Properties</a></li> -->
                        <li><a href="properties-list.php">Property List</a></li>
                        <!-- <li><a href="change-password.php">change Password</a></li> -->
                    </ul>
                </div>
            </div>
            <!-- .col-md-4 -->
            <div class="col-xs-12 col-sm-8 col-md-8">
                <!-- .property-item #1 -->
                <?php
                 function moneyFormatIndia($num) {
                    $explrestunits = "" ;
                    if(strlen($num)>3) {
                        $lastthree = substr($num, strlen($num)-3, strlen($num));
                        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
                        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
                        $expunit = str_split($restunits, 2);
                        for($i=0; $i<sizeof($expunit); $i++) {
                            // creates each of the 2's group and adds a comma to the end
                            if($i==0) {
                                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                            } else {
                                $explrestunits .= $expunit[$i].",";
                            }
                        }
                        $thecash = $explrestunits.$lastthree;
                    } else {
                        $thecash = $num;
                    }
                    return $thecash; // writes the final format where $currency is the currency symbol.
                }
                ?>
                <?php 
               
                while ($result = mysqli_fetch_assoc($row)) {?>
                    <div class="property-item">
                        <div class="property--img">
                            <a href="property-single-gallery.php?id=<?php echo $result['property_id'];?>">
                                <?php $str=$result['property_image'];
                                    $temp = explode(',', $result['property_image']);
                                ?>
                                <img src="http://localhost:8081/PropSync365/img_upload/<?php echo $temp[0]; ?>" alt="property image" class="img-responsive">
                                <?php $q = $result['property_status'];
                                    if($q == 0){
                                        $status = "Rent";
                                    }
                                    else{
                                        $status = "Sale";
                                    }
                                ?>
                                <span class="property--status">For <?php echo $status;?></span>
                            </a>
                        </div>
                        <div class="property--content">
                            <div class="property--info">
                                <h5 class="property--title"><a href="property-single-gallery.php"><?php echo $result['property_type'];?> in <?php echo $result['property_city'];?>,<?php echo $result['property_state'];?> </a></h5>
                                <p class="property--location"><?php echo $result['property_address'];?></p>
                                <p class="property--price">Rs.<?php 
                                            echo moneyFormatIndia($result['property_price']);?></p>
                            </div>
                            <!-- .property-info end -->
                            <div class="property--features">
                                <ul class="mb-0">
                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/bad.png" alt=""></span><span class="feature-num"><?php echo $result['property_totalbeds'];?> beds</span></li>
                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/bad.png" alt=""></span><span class="feature-num"><?php echo $result['property_totalbaths'];?> baths</span></li>
                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/squre.png" alt=""></span><span class="feature-num"><?php echo $result['property_sqfeet'];?> sq</span></li>
                                </ul>
                            </div>
                            <!-- .property-features end -->
                        </div>
                    </div>
                    <!-- .property item end -->
                <?php }?>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-50">
                                <ul class="pagination">
                                    <?php

                                    if($id>1)
                                    {
                                        echo '<li><a href="?id='.($id-1).'" aria-label="prev"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>';
                                    }
                                    // echo $total;
                                    for($i=1;$i<=$total;$i++)
                                    {

                                        if($i==$id) 
                                        {
                                            echo '<li class="active"><a href="?id='.$i.'">'.$i.'</a></li>';
                                            
                                        }
                                        else
                                        {
                                            echo '<li><a href="?id='.$i.'">'.$i.'</a></li>';
                                            
                                        }
                                    }
                                    
                                        if($id!=$total)
                                        {
                                        
                                        echo '
                                        <li>
                                            <a href="?id='.($id+1).'" aria-label="Next">
                                            <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                                            </a>
                                        </li> ';

                                        }
                                    ?>
                                </ul>
                            </div>
                 <!-- .pagination end -->
             </div>
             <!-- .col-md-8 end -->
         </div>
         <!-- .row end -->
     </div>
     <!-- .container end -->
        </div>
    </div>
 </section>


 <!-- #my properties  end -->

        <!-- cta #1
            ============================================= -->
            <?php include("footer.php"); ?>

        </div>
             <?php } else header("location:index.php");?>
        <!-- <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-2.2.4.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/functions.js"></script>
    </body> -->
  <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="https://maps.google.com/maps/api/js?sensor=true&amp;key=AIzaSyCiRALrXFl5vovX0hAkccXXBFh7zP8AOW8"></script>
    <script src="assets/js/plugins/jquery.gmap.min.js"></script>
    <script>
        $('#googleMap').gMap({
            address: "121 King St,Melbourne, India",
            zoom: 12,
            maptype: 'ROADMAP',
            markers: [{
                address: "Melbourne, India",
                maptype: 'ROADMAP',
                icon: {
                    image: "assets/images/gmap/marker1.png",
                    iconsize: [52, 75],
                    iconanchor: [52, 75]
                }
            }]
        });

    </script>
    <script src="assets/js/map-custom.js"></script>
</body>


    <!-- Mirrored from demo.zytheme.com/lalan/my-properties.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jan 2020 12:57:32 GMT -->
    </html>
