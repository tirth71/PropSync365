<!DOCTYPE html>
<html>

<!DOCTYPE php>
<php dir="ltr" lang="en-US">

<?php
include("config.php");

include("header.php");?>
<!--=================================== -->


<!-- properties-carousel
============================================= -->
 
<section id="properties-carousel" class="properties-carousel" style="padding-top: 0px;padding-bottom: 00px;">
    <div  style="padding-top: 120px; padding-bottom: 50px;">
              <!-- <div class="bg-section">
                <img src="assets/images/slider/slide-bg/new-hero-image.jpg" alt="Background" />
            </div> -->
            <div class="bg-section">
                <img src="assets/images/slider/slide-bg/dark_back.png" alt="Background" />
            </div>
        <div class="page-title bg-overlay bg-overlay-dark2" > 
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="heading heading-2 text-center mb-70">
                        <h2 class="heading--title"  style="color: white;">Sold Out Properties</h2>
                        <!-- <p class="heading--desc">Duis aute irure dolor in reprehed in volupted velit esse dolore</p> -->
                    </div>
                    <!-- .heading-title end -->
                </div>
                <!-- .col-md-12 end -->
            </div>
            <!-- .row end -->
            <div class="row" style="padding-bottom: 20px;">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="carousel carousel-dots" data-slide="3" data-slide-rs="2" data-autoplay="true" data-nav="false" data-dots="true" data-space="25" data-loop="true" data-speed="800">
                                <?php
                                $q = "SELECT * FROM tbl_property WHERE `live_status`=2" ;
                                $row = mysqli_query($con,$q);
                                while ($result = mysqli_fetch_assoc($row)) {?>
                                    <!-- .property-item #1 -->
                                    <div class="property-item">
                                        <div class="property--img">
                                            <a href="property-single-gallery.php?id=<?php echo $result['property_id'];?>">
                                                <?php $str=$result['property_image'];
                                                $temp = explode(',', $result['property_image']);
                                                ?>
                                                <img src="http://localhost:8081/property365/img_upload/<?php echo $temp[0]; ?>" alt="property image" class="img-responsive">
                                                <?php $q = $result['property_status'];
                                                if($q == 0){
                                                    $status = "Rent";
                                                }
                                                else{
                                                    $status = "Sale";
                                                }
                                                ?>
                                                <?php $q = $result['live_status'];
                                                if($q == 2){
                                                    $soldstatus = "Sold Out";
                                                }
                                                ?>
                                                <span class="property--status">For <?php echo $status;?></span>
                                                <span class="property--soldstatus"> <?php echo $soldstatus;?></span>
                                            </a>
                                        </div>
                                        <div class="property--content">
                                            <div class="property--info">
                                                <h5 class="property--title"><a href="property-single-gallery.php?id=<?php echo $result['property_id'];?>"><?php echo $result['property_type'];?> in <?php echo $result['property_city'];?>,<?php echo $result['property_state'];?></a></h5>
                                                <p class="property--location"><?php echo $result['property_address'];?></p>
                                                <p class="property--price">Rs.<?php 
                                            echo moneyFormatIndia($result['property_price']);?></p>
                                            </div>
                                            <!-- .property-info end -->
                                            <div class="property--features">
                                                <ul class="list-unstyled mb-1">
                                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/bad.png" alt=""></span><span class="feature-num"><?php echo $result['property_totalbeds'];?> beds</span></li>
                                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/bath.png" alt=""></span><span class="feature-num"><?php echo $result['property_totalbaths'];?> baths</span></li>
                                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/squre.png" alt=""></span><span class="feature-num"><?php echo $result['property_sqfeet'];?> sq</span></li>
                                                    <!-- <li class="pull-right"><a href="buy-property.php?id=<?php echo $result['property_id'];?>" ><input type="button" name="buy" value="Buy" style="background-color: #64ddbb;color: #ffffff;border: 2px solid transparent;"></a></li> -->
                                                   
                                                </ul>
                                                <div class="buy-view-card-btn">
                                                <?php if($result['property_status'] == 1){ ?>
                                                    <li class="m-0"><a href="buy-property.php?id=<?php echo $result['property_id'];?>" ><input type="button" name="buy" value="Buy" style="color: #ffffff;border: 2px solid transparent;"></a></li>
                                                    <?php }else{ ?>
                                                    <li class="m-0"><a href="check-availability.php?id=<?php echo $result['property_id'];?>" ><input type="button" name="rent" value="Rent" style="color: #ffffff;border: 2px solid transparent;"></a></li>
                                                    <?php } ?>
                                                    <li class="view-btn">
                                                            <a href="property-single-gallery.php?id=<?php echo $result['property_id']; ?>">view</a>
                                                        </li>  
                                                </div>
                                            </div>
                                            <!-- .property-features end -->
                                        </div>
                                    </div>
                                    <!-- .property item end -->
                                <?php } 
                                ?>

                            </div>
                            <!-- .carousel end -->
                        </div>
                        <!-- .col-md-12 -->
                    </div>
            <!-- .row -->
        </div>
        </div>
<!-- .container -->
    </div>
</section>
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

<!-- #properties-carousel  end  -->

<?php include("footer.php");?>

<!-- Footer Scripts
============================================= -->
<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/functions.js"></script>
</body>

</php>
</html>
