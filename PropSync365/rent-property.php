<?php
  include('config.php');
  session_start();

    $property_id=$_GET['id'];
    $starting_date=$_GET['sdate'];
    $starting_date1 = date("d-m-Y",strtotime($starting_date));
    $ending_date=$_GET['edate'];
    $ending_date1 = date("d-m-Y",strtotime($ending_date));
    

     // $starting_date =rtrim(str_replace(' ', '-', $_POST['starting_date']),'-') ;
     //  $ending_date = rtrim(str_replace(' ', '-', $_POST['ending_date']),'-');
    
    function dateDiffInDay($starting_date1, $ending_date1)
    {
      $diff = strtotime($ending_date1) - strtotime($starting_date1);
      return abs(round($diff/86400));
    }
    $interval = dateDiffInDay($starting_date1, $ending_date1);
    

    $qry = "SELECT * FROM tbl_property Where property_id='$property_id'";
      $row1 = mysqli_query($con,$qry);
      $result1 = mysqli_fetch_assoc($row1);
      $rent = $result1['property_price'];
      $deposite = $result1['deposite'];
      $amount = $deposite + $rent;
      
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
      $sql = "INSERT INTO tbl_payment(`transaction_id`, `first_name`, `last_name`, `amount`, `user_id`, `property_id`, `created_at`) 
        VALUES ('$transaction_id','$first_name','$last_name','$amount','$u_id','$property_id','$created_at')";

$res = mysqli_query($con, $sql);
$result_cnt = mysqli_affected_rows($con);

if ($res && $result_cnt > 0) {
    // Update property live_status and buyer_id
    $sql1 = "UPDATE tbl_property SET live_status = 3, buyer_id = '$user_id' WHERE property_id = '$property_id'";
    $res1 = mysqli_query($con, $sql1);

    if (!$res1) {
        echo "<script>alert('Payment inserted but live status update failed: " . mysqli_error($con) . "');</script>";
    }

    // Insert into tbl_rent
    $sql2 = "INSERT INTO tbl_rent(starting_date, ending_date, property_id, user_name, user_id) 
             VALUES ('$starting_date','$ending_date','$property_id','$first_name','$u_id')";
    $res2 = mysqli_query($con, $sql2);

    if (!$res2) {
        echo "<script>alert('Payment recorded but rent info not inserted: " . mysqli_error($con) . "');</script>";
    }

    echo "<script>alert('Your payment was successful! Transaction ID: $transaction_id');window.location.href = 'index.php';</script>";

} else {
    echo "<script>alert('Your payment was not recorded. Please try again.');window.location.href = 'buy-property.php?id=$property_id';</script>";
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
              <div class="col-xs-12 col-sm-12 col-md-12" style="display:flex; justify-content:center;">
                <div class="col-md-9">
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
                            
                            
                            
                            <div class="col-md-4">
                              <label1 for="amount">Rent</label1>
                              <div>
                                <input type="text" id="rent" name="rent" value="Rs. <?php echo $rent; ?>" readonly class="form-control">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <label1 for="amount">Deposite</label1>
                              <div>
                                <input type="text" id="deposite" name="deposite" value="Rs. <?php echo $deposite; ?>" readonly class="form-control">
                              </div>
                            </div>
                            <?php  ?>
                            <div class="col-md-4">
                              <label1 for="amount">Total</label1>
                              <div>
                                <input type="text" id="amount" name="amount" value="Rs. <?php echo $amount; ?>" readonly class="form-control">
                              </div>
                        </div>
                      </div>
                    <!-- .form-box end -->
                            <div>
                            <button type="button" id="rzp-button" class="btn btn--primary " style="margin-top: 30px;">Book Now</button>

                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    $(document).ready(function () {
        $('#rzp-button').click(function (e) {
            e.preventDefault();

            const firstName = $('#first_name').val();
            const lastName = $('#last_name').val();

            if (!firstName || !lastName) {
                alert("Please enter both first and last names.");
                return;
            }

            const options = {
                "key": "rzp_test_xxhEgawJNwXoLj", // Replace with your key
                "amount": <?php echo $amount * 100; ?>,
                "currency": "INR",
                "name": "PropSync365",
                "description": "Rent Payment",
                "handler": function (response) {
                    $.post("razorpay_success.php", {
                        razorpay_payment_id: response.razorpay_payment_id,
                        first_name: firstName,
                        last_name: lastName,
                        property_id: "<?php echo $property_id; ?>",
                        starting_date: "<?php echo $starting_date; ?>",
                        ending_date: "<?php echo $ending_date; ?>",
                        amount: "<?php echo $amount; ?>"
                    }, function (data) {
                        if (data === "success") {
                            alert("Payment successful!");
                            window.location.href = "make_pdf.php?id=<?php echo $property_id; ?>";
                        } else {
                            alert("Payment successful, but data save failed: " + data);
                        }
                    });
                }
            };

            const rzp = new Razorpay(options);
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
                <!-- .row end -->
          </div>
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
    <!-- <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    
    <script> -->
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
    
