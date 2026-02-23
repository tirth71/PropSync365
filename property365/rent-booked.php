<?php
session_start();

include ("config.php");
include("header.php");
if(@$_SESSION['user_type']==1 && @$_SESSION['email'])
{
// if(isset($_GET['id']))
//     {
//         $id=$_GET['id'];
//         $start=($id-1)*$limit;
//     }
//     else{
//         $id=1;
//     }
  
     //  $email=$_SESSION['email'];
     //  $qry = "SELECT * FROM tbl_user Where user_email = '$email' AND user_type=0"; 
     //  $row1 = mysqli_query($con,$qry);
     //  $result1 = mysqli_fetch_assoc($row1);
     //  $u_id = $result1['user_id'];

     // $qry = "SELECT * FROM tbl_user where user_type=0"; 
     //  $row1 = mysqli_query($con,$qry);
     //  $result1 = mysqli_fetch_assoc($row1);
     //  // $u_name = $result1['user_name'];
     //  // $u_id = $result1['user_id'];

     $qry = "SELECT user_id,buyer_id FROM tbl_property AND live_status=3";
    $row1 = mysqli_query($con,$qry);
      $result1 = mysqli_fetch_assoc($row1);
      $pid = $result1['buyer_id'];
      
    
      // $u_name = $result1['user_name'];
      // $u_id = $result1['user_id'];
      // echo $u_name;


?>
  <?php

  // $qry = "SELECT * FROM property_name Where property_id= '$pid' AND live_status=3";
  //   $row1 = mysqli_query($con,$qry);
  //     $result1 = mysqli_fetch_assoc($row1);
  //     $pid = $result1['property_id'];
      


      // $qry = "SELECT * FROM tbl_user Where user_type=0 AND user_id='$pid'";
      // $row1 = mysqli_query($con,$qry);
      // $result1 = mysqli_fetch_assoc($row1);
      // $pid1 = $result1['User_id'];

      
?>

  <!-- Main content -->
<section class="content" style="padding-top: 1px;padding-bottom: 10px;">
  <div  style="padding-top: 100px;">
      <!-- <div class="bg-section">
        <img src="assets/images/page-titles/3.jpg" alt="Background" />
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
                        <th>Type</th>
                        <!-- <th>Live Status</th> -->
                        <th>Starting Date</th>
                        <th>Ending Date</th>
                        <th>property Price</th>
                        <th>Deposite</th>
                        <th>Total</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                             
                            
                                  $cnt=1;
                                  $qry = "SELECT * FROM tbl_rent where user_id='$pid'"; 
                                  $row1 = mysqli_query($con,$qry);
                             while ($res = mysqli_fetch_assoc($row1)) 
                                {
                                  
                                  // $res = mysqli_fetch_assoc($row1);  
                                   $pid3 = $res['property_id'];
                                    echo $pid;
                                  $q = "SELECT * FROM tbl_payment where property_id = '$pid3'  ";
                                  $row = mysqli_query($con,$q);

                                  while ($result = @mysqli_fetch_assoc($row)) 
                                    
                                 
                                { ?>
                                  <?php echo $result["property_id"]; ?>
                                  <?php echo $pid3; ?> 
                                   

                              

                                <?php
                                      $sql="SELECT * FROM tbl_rent where property_id='$pid3'";
                                      $res=mysqli_query($con,$sql);
                                   while ($r = @mysqli_fetch_assoc($res)) { ?>
                                  <tr>
                                    
                                    <td><?php echo $cnt; ?> </td>
                                  <td><?php echo $r["user_name"]; ?></td>
                                
                                <?php } ?>
                                <!-- <td><?php echo $result["payment_id"]; ?></td> -->
                                <!-- <td><?php echo $result["first_name"]; ?></td> -->
                               <!-- <?php
                              
                              $s="SELECT * FROM tbl_rent WHERE where property_id='$pid'";
                                $res=mysqli_query($con,$s);
                               while ($rest = @mysqli_fetch_assoc($res)) {?>
                                  
                                  <td><?php echo $rest["User_name"];?></td>
                              <?php } ?> -->
                                                                                                       
                              <?php
                              
                                // $sql="SELECT * FROM tbl_property WHERE live_status=3 and property_id='{$result['user_id']}' ";
                               $sql="SELECT * FROM tbl_property WHERE  live_status=3  AND property_id = '$pid3' ";
                                
                                $res=mysqli_query($con,$sql);
                               while ($result1 = @mysqli_fetch_assoc($res)) {
                                  $property_id=$result1['property_id'];?>
                                  <td><?php echo $result1["property_name"];?></td>
                                  <td><?php echo $result1["property_type"]; ?></td>
                                  
                                    <?php
                                      $sql="SELECT * FROM tbl_rent ";
                                      $res=mysqli_query($con,$sql);
                                   while ($res = @mysqli_fetch_assoc($res)) {?>
                                  <td><?php echo $res["starting_date"]; ?></td>
                                 
                                  <td><?php echo $res["ending_date"]; ?></td>
                                  <?php }?>

                                  <td><?php echo $result1["property_price"]; ?></td>
                                  <td><?php echo $result1["deposite"]; ?></td>
                                  <?php }?>
                                  <td><?php echo $result["amount"]; ?></td>
                                 </tr>  
                                <?php $cnt++; ?>
                            <?php } ?> 
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