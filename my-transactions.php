<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(@$_SESSION['user_type']==0 && @$_SESSION['email'])
{
  error_reporting(E_ALL);
ini_set('display_errors', 1);
include ("config.php");
include("header.php");
  if(isset($_SESSION['email'])){
      $email=$_SESSION['email'];
      $qry = "SELECT * FROM tbl_user Where user_email = '$email' AND user_type=0";


      $row1 = mysqli_query($con,$qry);
      $result1 = mysqli_fetch_assoc($row1);
      $u_id = $result1['user_id'];
  }?>
  <?php

  // $qry = "SELECT * FROM property_name Where property_id = '$pid'";
  //   $row1 = mysqli_query($con,$qry);
  //     $result1 = mysqli_fetch_assoc($row1);
  //     $pid = $result1['property_id'];

      
?>

  <!-- Main content -->
<section class="content" style="padding-top: 0px;padding-bottom: 0px;">
  <div  style="padding-top: 130px; padding-bottom: 70px;  " class="main-hero-section-common">
      <!-- <div class="bg-section">
        <img src="assets/images/slider/slide-bg/new-hero-image.jpg" alt="Background" />
      </div> -->
      <div class="bg-section">
                <img src="assets/images/slider/slide-bg/dark_back.png" alt="Background" />
            </div>
      <div class="page-title bg-overlay bg-overlay-dark2" > 
            <div class="container">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>User name</th>
                        <th>Title</th>
                        <th>Transaction Id</th>
                       
                     
                        <th>Amount</th>
                        <th>Transaction Date</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                             
                            
                                  $q = "SELECT * FROM tbl_payment where user_id=$u_id ";
                                  $row = mysqli_query($con,$q);

                                  while ($result = @mysqli_fetch_assoc($row)) 
                                 
                                { ?>
               

                              <tr>
                              <th> <?php echo $result["payment_id"]; ?></th>
                              <td><?php echo $result["first_name"]; ?></td>
                          
                                                  
                                                  
                              <?php
                              
                                $sql="SELECT * FROM tbl_property WHERE  `live_status` IN (1,2,3)  AND property_id='{$result['property_id']}' ";
                                $res=mysqli_query($con,$sql);
                               while ($result1 = mysqli_fetch_assoc($res)) {?>
                            <td><?php echo $result1["property_name"];?></td>
                            <?php }?>
                            
                              <td><?php echo $result["transaction_id"]; ?></td>
                             
                              
                              <td><?php echo $result["amount"]; ?></td>
                              <td><?php echo $result["created_at"]; ?></td>
                             </tr>  
                           
                           <?php
                          }
                            ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
      </div>
  </div>
</section>
  <!-- /.content -->
</div>

<!-- /.content-wrapper -->

<?php include('footer.php'); ?>
 <?php } else header("location:index.php");?>
<!-- <script>
  $(document).ready(function() {
    $(".nav-sidebar a").removeClass("active");
    $("#transaction").addClass('active');
  });

  $(function () {
    
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "columnDefs": [{ 
          "targets": [3,6,7,8,11],
          "orderable": false
        }]
    });
  });
</script> -->
  <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-2.2.4.min.js"></script>
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