<?php
include("config.php");
include("header.php");

    if(isset($_POST['submit'])){
        if(isset($_SESSION['email'])){
        $email=$_SESSION['email'];
        $qry = "SELECT * FROM tbl_user Where user_email = '$email' AND user_type=1 OR user_type=0";
        $row1 = mysqli_query($con,$qry);
        $result1 = mysqli_fetch_assoc($row1);
        $u_id = $result1['user_id'];
        }
        $id = $_GET['id'];
        $name = $_REQUEST['review_name'];
        $email = $_REQUEST['review_email'];
        $review = $_REQUEST['review_comment'];
        $date = date('Y-m-d');
        
        $u_id=$u_id;
        $sql = "INSERT INTO tbl_review (property_id, name, email,review,r_date,user_id)
        VALUES ('$id', '$name', '$email','$review','$date','$u_id')";
        $result=mysqli_query($con,$sql);

        $result_cnt=mysqli_affected_rows($con);
        
        if($result_cnt>0){
            echo "<script>alert('Your Review is Submitted..!!');window.location.href = 'property-single-gallery.php?id=$id';</script>";
        }else{
            echo "<script>alert('Your Review is not Submitted..!!');window.location.href = 'property-single-gallery.php?id=$id';</script>";
        }
    }

?>

<!-- #page-title end -->

        <!-- property single gallery
            ============================================= -->
<section id="property-single-gallery" class="property-single-gallery"style="padding-top: 0px;padding-bottom: 0px;">
    <div  style="padding-top: 120px; padding-bottom: 70px;">
        <!-- <div class="bg-section">
            <img src="assets/images/slider/slide-bg/new-hero-image.jpg" alt="Background" />
        </div> -->
        <div class="bg-section">
                <img src="assets/images/slider/slide-bg/dark_back.png" alt="Background" />
            </div>
        <div class="page-title bg-overlay bg-overlay-dark2" > 
        <div class="container">
                <div class="row">
                <?php 
                   $id = $_GET['id'];

// only approved property allowed
$q = "SELECT * FROM tbl_property 
      WHERE property_id = $id 
      AND approval_status = 1 
      AND live_status IN (1,3)";

$row = mysqli_query($con,$q);

if(mysqli_num_rows($row) == 0){
    echo "<script>
    alert('This property is not available or not verified by admin.');
    window.location='properties-list.php';
    </script>";
    exit;
}

                    while ($result = mysqli_fetch_assoc($row)) 
                    { ?>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="property-single-gallery-info">

                                <div class="property--info clearfix">
                                    <div class="pull-left">
                                        <h5 class="property--title"><?php echo $result['property_type'];?> in <?php echo $result['property_city'];?>,<?php echo $result['property_state'];?></h5>
                                        <p class="property--price" style="font-size: 25px;"><i class="fa fa-map-marker"></i> <?php echo $result['property_address'];?></p>
                                    </div>
                                    <div class="pull-right">
                                        <?php $q = $result['property_status'];
                                        if($q == 0){
                                            $status = "Rent";
                                        }
                                        else{
                                            $status = "Sale";
                                        }
                                        ?>
                                        <span class="property--status">For <?php echo $status;?></span>
                                        <p class="property--price">Rs.<?php 
                                            echo moneyFormatIndia($result['property_price']);?> /Per Month</p>
                                    </div>
                                </div>
                                <!-- .property-info end -->
                                <div class="property--meta clearfix">
                                    <div class="pull-left">
                                    <?php $q = $result['live_status'];
                                    if($q == 2){ ?>
                                        <ul class="list-unstyled list-inline mb-0">
                                            <li class="pull-left" style="font-size: 30px;">
                                                <a class="edit--btn edit-btn-single-gallary-view"><i class="fa fa-shopping-basket"></i> Sold Out</a>
                                            </li>
                                        </ul>
                                    <?php } else if(@$_SESSION['user_type'] == 1){ ?>
                                        <ul class="list-unstyled list-inline mb-0">
                                            <li class="pull-left" style="font-size: 30px;">
                                                <a href="edit-property.php?id=<?php echo $result['property_id'];?>" class="edit--btn edit-btn-single-gallary-view"><i class="fa fa-edit"></i> Edit</a>
                                            </li>
                                        </ul>
                                    <?php } else if($result['property_status'] == 1){ ?>
                                        <ul class="list-unstyled list-inline mb-0">
                                            <li class="pull-left" style="font-size: 30px;">
                                                <a href="javascript:void(0);" class="edit--btn buynow" data-property_price="<?php echo $result['property_price']; ?>">
                                                    <i class="fa fa-shopping-cart"></i> Buy
                                                </a>
                                            </li>
                                        </ul>
                                    <?php } else{ ?>
                                        <ul class="list-unstyled list-inline mb-0">
                                            <li class="pull-left" style="font-size: 30px;">
                                                <a href="check-availability.php?id=<?php echo $result['property_id'];?>" class="edit--btn">
                                                    <i class="fa fa-shopping-cart"></i> Rent
                                                </a>
                                            </li>
                                        </ul>
                                    <?php } ?>

                                    <!-- Razorpay Payment Integration -->
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

                                    <script>
                                    $(".buynow").click(function() {
                                        var price = $(this).attr('data-property_price');

                                        var options = {
                                            key: "rzp_test_xxhEgawJNwXoLj", // Replace with your Razorpay Test/Live Key
                                            amount: price * 100, // Convert to paise
                                            name: "Kishan Savaliya",
                                            description: "Property Purchase",
                                            image: "https://cdn.razorpay.com/logos/GhRQcyean79PqE_medium.png",
                                            theme: {
                                                "color": "#3399cc"
                                            },
                                            callback_url: "make_pdf.php?id=<?php echo $result['property_id'];?>"
                                        };

                                        var rzp = new Razorpay(options);
                                        rzp.open();
                                    });
                                    </script>

                                    </div>

                                </div>
                                <!-- .property-info end -->
                            </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <div class="property-single-carousel inner-box">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="heading">
                                            <h2 class="heading--title">Gallery</h2>
                                        </div>
                                    </div>
                                    <!-- .col-md-12 end -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="property-single-carousel-content">
                                        <?php 

                                                $temp = explode(',', $result['property_image']);
                                                $temp = array_filter($temp);
                                                foreach($temp as $image)
                                                {
                                                  $images[]="http://localhost:8081/PropSync365/img_upload/".trim( str_replace( array('[',']') ,"" ,$image ) );
                                                  
                                                } 
                                                $cntimg = count($images);        
                                                if($cntimg == 1)
                                                {
                                                    ?>
                                                         <div class="carousel carousel-thumbs slider-navs" data-slide="1" data-slide-res="1" data-autoplay="true" data-thumbs="true" data-nav="true" data-dots="false" data-space="30" data-loop="false" data-speed="800" data-slider-id="1">
                                                            <?php
                                                                $img = "";
                                                              foreach($images as $image)
                                                            {
                                                                if(is_file($image)){
                                                                    $img = "<img src='{$image}' style='height: 100%; width: 100%; object-fit:cover;'>";
                                                                }
                                                                ?>
                                                                  <div class="item" style="height: 450px;"><?php echo "<img src='{$image}' style='height: 100%; width: 100%; object-fit:cover;'>"; ?></div>
                                                                <?php
                                                            }
                                                            ?>
                                                         </div>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="carousel carousel-thumbs slider-navs" data-slide="1" data-slide-res="1" data-autoplay="true" data-thumbs="true" data-nav="true" data-dots="false" data-space="30" data-loop="true" data-speed="800" data-slider-id="1">
                                                    <?php 

                                                                $img = "";

                                                            foreach($images as $image)
                                                            {
                                                                if(is_file($image)){
                                                                    $img = "<img src='{$image}' style='height: 100%; width: 100%; object-fit:cover;'>";
                                                                }
                                                                ?>
                                                                  <div class="item" style="height: 450px;"><?php echo "<img src='{$image}' style='height: 100%; width: 100%; object-fit:cover;'>"; ?></div>
                                                                <?php
                                                            }
                                                        
                                                       
                                                    ?> 

                                                    
                                                </div>
                                                    <?php
                                                }
                                            ?>
                                       
                                        <!-- .carousel end -->
                                        <div class="owl-thumbs thumbs-bg" data-slider-id="1">
                                            <?php 
                                                foreach($images as $image)
                                                {
                                                    $img = "";
                                                    if(is_file($image)){
                                                        $img =  '<img src="'.$image.'" height="100px" width="100px" style="object-fit:cover;">';
                                                    }
                                                    ?>
                                                      <button class="owl-thumb-item"><?php echo $img; ?></button>
                                                    <?php
                                                }
                                                $images="";
                                            ?> 
                                                  <!--   <button class="owl-thumb-item">
                                                        <img src="<?php echo $img; ?>" alt="Property Image thumb" style="height: 100px;">
                                                        
                                                    </button>
                                                -->
                                            <!-- <button class="owl-thumb-item">
                                                <img src="uploads/<?php echo $result2['property_image'];?>" alt="Property Image thumb" height="100px" width="125px">
                                            </button> -->
                                            
                                        </div>
                                    </div>
                                    <!-- .col-md-12 end -->
                                </div>
                                </div>
                                <!-- .row end -->
                            </div>
                            <!-- .property-single-desc end -->
                            <div class="property-single-desc inner-box">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="heading">
                                            <h2 class="heading--title">Description</h2>
                                        </div>
                                    </div>
                                    <!-- feature-panel #1 -->
                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                        <div class="feature-panel">
                                            <div class="feature--img">
                                                <img src="assets/images/property-single/features/1.png" alt="icon">
                                            </div>
                                            <div class="feature--content">
                                                <h5 style="color: #aaaaaa;">Area:</h5>
                                                <p><?php echo $result['property_sqfeet'];?> sq ft</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- feature-panel end -->
                                    <!-- feature-panel #2 -->
                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                        <div class="feature-panel">
                                            <div class="feature--img">
                                                <img src="assets/images/property-single/features/2.png" alt="icon">
                                            </div>
                                            <div class="feature--content">
                                                <h5 style="color: #aaaaaa;">Beds:</h5>
                                                <p><?php echo $result['property_totalbeds'];?> Bedrooms</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- feature-panel end -->
                                    <!-- feature-panel #3 -->
                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                        <div class="feature-panel">
                                            <div class="feature--img">
                                                <img src="assets/images/property-single/features/3.png" alt="icon">
                                            </div>
                                            <div class="feature--content">
                                                <h5 style="color: #aaaaaa;">Baths:</h5>
                                                <p><?php echo $result['property_totalbaths'];?> Bathrooms</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- feature-panel end -->

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="property--details">
                                            <?php echo $result['property_description'];?>
                                        </div>
                                        <!-- .property-details end -->
                                    </div>
                                    <!-- .col-md-12 end -->
                                </div>
                                <!-- .row end -->
                            </div>
                            <!-- .property-single-desc end -->

                            <div class="property-single-location inner-box">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="heading">
                                            <h2 class="heading--title">Location</h2>
                                        </div>
                                    </div>
                                    <!-- .col-md-12 end -->
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <ul class="list-unstyled mb-20">
                                            <li><span>Address:</span><?php echo $result['property_address'];?></li><br>
                                            <li><span>City:</span><?php echo $result['property_city'];?></li><br>
                                            <li><span>State:</span><?php echo $result['property_state'];?></li><br>
                                            <li><span>Country:</span>India</li><br>

                                        </ul>
                                    </div>
                                    <!-- .col-md-12 end -->
                                </div>
                                <!-- .row end -->
                            </div>
                            <!-- .property-single-location end -->


                            <div class="property-single-reviews inner-box">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="heading">
                                            <h2 class="heading--title">Reviews</h2>
                                        </div>
                                    </div>
                                    <!-- .col-md-12 end -->
                                    <?php 
                                    $id = $_GET['id'];
                                    $q = "SELECT * FROM tbl_review where property_id = $id ";
                                    $row = mysqli_query($con,$q);
                                    while ($result = mysqli_fetch_assoc($row)) 
                                    { ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <ul class="property-review">
                                                <li class="review-comment">
                                                    <div class="avatar">R</div>
                                                    <div class="comment">
                                                        <h6><?php echo $result['name'];?></h6>
                                                        <div class="date"><?php echo $result['r_date'];?></div>

                                                        <p><?php echo $result['review'];?></p>
                                                    </div>
                                                </li>
                                                <!-- comment end -->
                                            </ul>
                                            <!-- .comments-list end -->
                                        </div>
                                        <!-- .col-md-12 end -->
                                    <?php } ?>
                                </div>
                                <!-- .row end -->
                            </div>
                            <!-- .property-single-reviews end -->
                            <?php if(isset($_SESSION['email'])){ ?>
                            <div class="property-single-leave-review inner-box">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="heading">
                                            <h2 class="heading--title">Give a Review</h2>
                                        </div>
                                    </div>
                                    <!-- .col-md-12 end -->
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <form id="post-comment" method="post" class="mb-0">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                    <div class="form-group">
                                                        <label for="review-name">Your Name*</label>
                                                        <input type="text" class="form-control" name="review_name" id="review_name" required>
                                                    </div>
                                                </div>
                                                <!-- .col-md-4 end -->
                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                    <div class="form-group">
                                                        <label for="review-email">Your Email*</label>
                                                        <input type="email" class="form-control" value="<?php echo $_SESSION['email'] ?>" name="review_email" id="review_email" readonly required>
                                                    </div>
                                                </div>
                                                <!-- .col-md-4 end -->
                                                <!-- .col-md-4 end -->
                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                </div>
                                                <!-- .col-md-4 end -->

                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="review_comment">Review*</label>
                                                        <textarea class="form-control" id="review_comment" name="review_comment" rows="2" required></textarea>
                                                    </div>
                                                </div>
                                                <!-- .col-md-12 -->
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <button type="submit" name="submit" class="btn btn--primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- .col-md-12 end -->
                                </div>
                                <!-- .row end -->
                            </div>
                            <!-- .property-single-leave-review end -->
                        <?php } ?>
                        </div>
                        <!-- .col-md-8 -->
                        <div class="col-xs-12 col-sm-12 col-md-4">



                        </div>
                        <!-- .col-md-4 -->
                    
                </div>
                <!-- .row -->
                <?php } ?>
        </div>
        </div>
                <!-- .container -->
    </div>
</section>



            <!-- #property-single end -->


        <!-- properties-carousel
            ============================================= -->
 
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


            <?php include("footer.php"); ?>
        </div>
        <!-- #wrapper end -->
    </body>
    </html>
    <!-- Footer Scripts
        ============================================= -->
        <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-2.2.4.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/functions.js"></script>
        