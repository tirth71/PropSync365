<?php
  include('config.php');
  session_start();

    $property_id=$_GET['id'];
      
      // echo $user_name;

  if (isset($_SESSION['email'])) {
    
    if (isset($_POST['check'])) 
    { 
      //date_default_timezone_set('Asia/Kolkata');
      
$starting_date = DateTime::createFromFormat('d-m-Y', $_POST['startDate'])->format('Y-m-d');
$ending_date   = DateTime::createFromFormat('d-m-Y', $_POST['endDate'])->format('Y-m-d');
      
$start = new DateTime($starting_date);
$end   = new DateTime($ending_date);
$days  = $start->diff($end)->days;

if($days < 30){
    echo "<script>alert('Minimum rent period is 1 month (30 days)');window.history.back();</script>";
    exit();
}
      
     $query = "SELECT * FROM tbl_rent 
WHERE property_id='$property_id'
AND (
    ('$starting_date' <= ending_date)
    AND
    ('$ending_date' >= starting_date)
)";
$res=mysqli_query($con,$query);
    
    $result_cnt = mysqli_num_rows($res);
      

      if($result_cnt>0)
      {
        echo "<script>alert('sorry, in this time periode this property already booked..!!');window.location.href = 'check-availability.php?id=$property_id';</script>";
      }
      else
      {
        echo "<script>window.location.href = 'rent-property.php?id=$property_id&sdate=$starting_date&edate=$ending_date';</script>";    
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
                                <h4 class="form--title">Booking Details:</h4>
                            </div><br>
                            <h6 style="color:red; padding:20px">     Select Minimum 30 Days</h6>
                            <?php 
                             if (isset($error)) {
                                ?>
                                <b><p style="color: red;"><?php echo $error; ?></p></b>
                                <?php
                              } 
                            ?>
                            <!-- .col-md-6 end -->

                           <div class="col-xs-6 col-sm-6 col-md-4">
                                <div class="form-group">
                                  <label1><i class="fa fa-calendar "></i> Start Date</label1>
                                  <div>
                                    <input name="startDate" type="text" id="startDate" placeholder="Select time" required="required" class="form-control" data-input/>
                                  </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4">
                                <div class="form-group">
                                  <label1><i class="fa fa-calendar "></i> End Date</label1>
                                  <div>
                                    <input name="endDate" type="text" id="endDate" placeholder="End Time" required="required" class="form-control"  />
                                  </div>
                                </div>
                            </div>
                           
                    <!-- .form-box end -->
                            <div class="col-md-4" style="padding-left: 15px;">
                            <input type="submit"class="btn btn--primary btn--block" id="check" name="check" value="Check availability" style="margin-top: 23px;" />
                            </div>
                          </div>
                        </div>
                  </form>
                </div>
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
    <script src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/jquery.mask.js"></script>
    
    <script src="assets/js/dropzone.html"></script>
    <script src="assets/js/functions.js"></script>
    <script src="https://maps.google.com/maps/api/js?sensor=true&amp;key=AIzaSyCiRALrXFl5vovX0hAkccXXBFh7zP8AOW8"></script>
    <script src="assets/js/plugins/jquery.gmap.min.js"></script>
    <script src="assets/js/jquery.mask.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script> -->
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
   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
   <!--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
     <!--  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script> -->
    <!-- <script>
      $("#startDate").datepicker({
        enableTime: false,
        minDate: 0,
        dateFormat: "dd-mm-yy"
      });
      $("#endDate").datepicker({
        enableTime: false,
        minDate: 0,
        dateFormat: "dd-mm-yy"
      });

  $(document).ready(function() {
    $('input[name="exp_month"]').mask('00');
    $('input[name="exp_year"]').mask('0000');
    $('input[name="cvv"]').mask('000');
    $('input[name="card_number"]').mask('0000-0000-0000-0000');
  });
  
</script>
     -->


     <script>
$(function(){

    $("#startDate").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        onSelect: function(selectedDate){

            var start = $(this).datepicker('getDate');

            // add 30 days automatically
            start.setDate(start.getDate() + 30);

            $("#endDate").datepicker("option", "minDate", start);
            $("#endDate").datepicker("setDate", start);
        }
    });

    $("#endDate").datepicker({
        dateFormat: "dd-mm-yy"
    });

});
</script>