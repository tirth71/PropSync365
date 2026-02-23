<?php
  include('config.php');
  session_start();

    $property_id=$_GET['id'];
    $qry = "SELECT * FROM tbl_property Where property_id='$property_id'";
      $row1 = mysqli_query($con,$qry);
      $result1 = mysqli_fetch_assoc($row1);
      $amount = $result1['deposite'];
      

  if (isset($_SESSION['email'])) {
    if (isset($_POST['paynow'])) 
    { 
      
      $email=$_SESSION['email'];
      $qry = "SELECT * FROM tbl_user Where user_email = '$email' AND user_type=0";
      $row1 = mysqli_query($con,$qry);
      $result1 = mysqli_fetch_assoc($row1);
      $user_id = $result1['user_id'];
    
      
      $transaction_id=uniqid(); 
      $first_name = ucfirst(trim($_POST['first_name']));
      $last_name = ucfirst(trim($_POST['last_name']));
      $created_at = date("Y-m-d H:i:s");
      
    
      $u_id=$user_id;
      $sql="INSERT INTO tbl_payment( `transaction_id`, `first_name`, `last_name`, `amount`, `user_id`, `property_id`, `created_at`) VALUES ('$transaction_id','$first_name','$last_name','$amount','$u_id','$property_id','$created_at')";
    
      $res=mysqli_query($con,$sql);
      $result_cnt=mysqli_affected_rows($con);
      $sql1 = "UPDATE tbl_property SET live_status=2 , buyer_id='$user_id' where property_id = '$property_id'";
      
      $res1=mysqli_query($con,$sql1);

      if($result_cnt>0){
        echo "<script>alert('your payment successful..!! your transaction id is:$transaction_id');window.location.href = 'index.php';</script>";
        
      }
      else{
           echo "<script>alert('your payment not updated..!!');window.location.href = 'buy-property.php?id=$property_id';</script>";
      }
    }
  }
  else
  {
    header('Location:login.php');
  }
    
include('header.php');
 ?>

        
        <!-- #page-title end -->


<section id="add-property" class="add-property" style="padding-top: 0px;padding-bottom: 0px;">
    <div  style="padding-top: 120px; padding-bottom: 70px;">
              <!-- <div class="bg-section">
                <img src="assets/images/slider/slide-bg/new-hero-image.jpg" alt="Background" />
              </div> -->
              <div class="bg-section">
                <img src="assets/images/slider/slide-bg/dark_back.png" alt="Background" />
            </div>
            <div class="container">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-md-12">
                  <form class="mb-0" method="post">
                    <div class="page-title bg-overlay bg-overlay-dark2" >
                      <div class="form-box1" >
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <h4 class="form--title">Payment Details:</h4>
                            </div>
                            <?php 
                             if (isset($error)) {
                                ?>
                                <b><p style="color: red;"><?php echo $error; ?></p></b>
                                <?php
                              } 
                            ?>
                            <!-- .col-md-6 end -->

                           <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                  <label1><i class="fa fa-user"></i> First Name</label1>
                                  <div>
                                    <input name="first_name" type="text" id="first_name" placeholder="First Name" required="required" class="form-control" />
                                  </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                  <label1><i class="fa fa-user"></i> Last Name</label1>
                                  <div>
                                    <input name="last_name" type="text" id="last_name" placeholder="Last Name" required="required" class="form-control"  />
                                  </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                              <label1 for="amount">Amount</label1>
                              <div>
                                <input type="text" id="amount" name="amount" value="Rs. <?php echo $amount; ?>" readonly class="form-control">
                              </div>
                            </div>
                    <!-- .form-box end -->
                            <div style="padding-left: 15px;">
                            <button type="button" data-property_price="<?php echo $result1["deposite"]; ?>" class="btn btn-primary buynow" style="margin-top: 30px;"> Pay Now </button>

                                                            
                              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                              <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

                              <script>
                                $(document).ready(function () {
                                  $(".buynow").click(function () {
                                    var price = $(this).attr('data-property_price');

                                    var options = {
                                      key: "rzp_test_xxhEgawJNwXoLj",
                                      amount: price * 100, // amount in paise
                                      name: "PORPERTY365",
                                      description: "Test transaction",
                                   
                                      theme: {
                                        color: "#3399cc"
                                      },
                                      handler: function (response) {
                                        // Pass Razorpay response to PHP via AJAX
                                        $.ajax({
                                          url: "razorpay_success1.php",
                                          type: "POST",
                                          data: {
                                            razorpay_payment_id: response.razorpay_payment_id,
                                            first_name: $("#first_name").val(),
                                            last_name: $("#last_name").val(),
                                            property_id: "<?php echo $property_id; ?>",
                                            amount: "<?php echo $amount; ?>"
                                          },
                                          success: function (data) {
                                            alert("Payment Successful!");
                                            window.location.href = "make_pdf.php?id=<?php echo $property_id; ?>";
                                          },
                                          error: function () {
                                            alert("Payment processed but data not saved. Please contact support.");
                                          }
                                        });
                                      }
                                    };

                                    var rzp = new Razorpay(options);
                                    rzp.open();
                                  });
                                });
                              </script>
                          
                          </div>
                          </div>
                        </div>
                      </div>
                  </form>
                </div>
                </div>
              </div>
                <!-- .row end -->
            </div>
    </div>
</section>
      
        <!-- #social-profile  end -->

        
    <?php include("footer.php"); ?>
    </div>
    <!-- #wrapper end -->

    <!-- Footer Scripts
============================================= -->
   <!--  <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script src="assets/js/jquery.mask.js"></script>
    <script src="assets/js/dropzone.html"></script>
    <script src="assets/js/functions.js"></script>
    <script src="https://maps.google.com/maps/api/js?sensor=true&amp;key=AIzaSyCiRALrXFl5vovX0hAkccXXBFh7zP8AOW8"></script>
    <script src="assets/js/plugins/jquery.gmap.min.js"></script>
    <script>
        $('#googleMap').gMap({
            address: "121 King St,Melbourne, Australia",
            zoom: 12,
            maptype: 'ROADMAP',
            markers: [{
                address: "Melbourne, Australia",
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
    <script>
  $(document).ready(function() {
    $('input[name="exp_month"]').mask('00');
    $('input[name="exp_year"]').mask('0000');
    $('input[name="cvv"]').mask('000');
    $('input[name="card_number"]').mask('0000-0000-0000-0000');
  });
  
</script>
    
