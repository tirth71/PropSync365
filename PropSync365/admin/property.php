<?php 

  include('header.php'); 

  $propertyData = $obj->myQuery("SELECT * FROM `tbl_property` where live_status=0 || live_status=1 || live_status=3");
  

  if(isset($_GET['did']))
  {
    $data['property_id']=$_GET['did'];
    $obj->myDelete('tbl_property',$data);
    $obj->redirect('property.php');
  }

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Property List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Property</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <!-- <div class="card-header">
        <a href="property_add.php" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add Property</a>
      </div> -->
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Owner</th>
              <th>Type</th>
              <th>Price</th>
              <th>Status</th>
              <th>Live Status</th>
              <th>Aproved/Pending</th>
              
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no=0;
              while ($row = $propertyData->fetch_assoc()) {
                $no++;
                ?>
                  <tr>
                    <th><?php echo $no; ?></th>
                    <td><?php echo $row["property_name"]; ?></td>
                    <?php
                      $getUser=$obj->myQuery("SELECT * FROM tbl_user WHERE user_id = '{$row["user_id"]}'");
                      
                      $result = $getUser->fetch_assoc();
                    ?>
                    <td><?php echo $result["user_name"]; ?></td>

                    <td><?php echo $row["property_type"]; ?></td>
                    <td><?php echo $row["property_price"]; ?></td>
                    <?php 
                    $status = $row["property_status"];
                    if($status == 0){
                        $sataus1 = "Rent";
                    }else{
                        $sataus1 = "Sale";
                    } ?>
                    <td><?php echo $sataus1; ?></td>
                    <?php if($row['live_status'] == '0') 
                          {
                            $status= "<i class='fa fa-toggle-off' onClick='active_deactive(".$row['property_id'].",1)' style='font-size:40px;'></i>";
                          } else if($row['live_status'] == '3')
                          {
                            $status= "<i class='fa fa-toggle-on'  onClick='active_deactive(".$row['property_id'].",4)' style='font-size:40px;color:green;'></i>";
                          } else if($row['live_status'] == '4')
                          {
                            $status= "<i class='fa fa-toggle-off' onClick='active_deactive(".$row['property_id'].",3)' style='font-size:40px;'></i>";
                            // $Status= "you not deactivate bcz this booked ";
                          } else { 
                            $status= "<i class='fa fa-toggle-on'  onClick='active_deactive(".$row['property_id'].",0)' style='font-size:40px;color:green;'></i>";}
                   ?>
                    
                    <td id="status_change<?php echo $row['property_id'];?>"><?php echo $status; ?></td>
                    <?php
                      $live_status = $row["live_status"];
                      if($live_status == 0){
                        $state = "pending";
                      }else if($live_status == 1){
                        $state = "Approved";
                      }else if($live_status == 3){
                        $state = "Book For Rent"; 
                      }else{
                        $state = "Sold";
                      }
                     ?>
                    <td id="state_change<?php echo $row['property_id'];?>"><?php echo $state; ?></td>
                    <th>
                      <div class="btn-group btn-group-sm">
                        
                        <a onclick="return confirm('Are you sure you want to delete Property?');" href="property.php?did=<?php echo $row['property_id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </th>
                  </tr>
                <?php
              }
             ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('footer.php'); ?>
<script src="dist/js/sweetalert.js"></script>
<script>
  $(document).ready(function() {
    $(".nav-sidebar a").removeClass("active");
    $("#property").addClass('active');

    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "columnDefs": [{ 
          "targets": [3,7],
          "orderable": false
        }]
    });
  });
  function active_deactive(id,val)
    {
        
        $.ajax({
          
          url:"ajax-data.php",
          type:"POST",
          data : {id : id, val : val},

          success:function(data) {
            
              //alert('Status updated.');
              //window.location.href = 'property.php';
              //$("#example1").DataTable().ajax.reload();
              if(val == 0)
              {
                var chn_ststus = "<i class='fa fa-toggle-off'  onClick='active_deactive("+id+",1)' style='font-size:40px;'></i>";
                var chn_state = "Pending";
                $('#status_change'+id).html(chn_ststus);
                $('#state_change'+id).html(chn_state);

              }
              else
              {
                var chn_ststus = "<i class='fa fa-toggle-on' onClick='active_deactive("+id+",0)' style='font-size:40px;color:green;'></i>";
                var chn_state = "Approved";
                $('#status_change'+id).html(chn_ststus);
                $('#state_change'+id).html(chn_state);
              }
              swal("","update Status successfully.","success");
              //window.location.href = 'property.php';

              if(val == 4)
              {
                var chn_ststus = "<i class='fa fa-toggle-off'  onClick='active_deactive("+id+",3)' style='font-size:40px;'></i>";
                var chn_state = "Pending";
                $('#status_change'+id).html(chn_ststus);
                $('#state_change'+id).html(chn_state);

              }
              else if(val == 3)
              {
                var chn_ststus = "<i class='fa fa-toggle-on' onClick='active_deactive("+id+",4)' style='font-size:40px;color:green;'></i>";
                var chn_state = "Book For Rent";
                $('#status_change'+id).html(chn_ststus);
                $('#state_change'+id).html(chn_state);
              }
              swal("","update Status successfully.","success");
              //window.location.href = 'property.php';
            }
          });
        }


</script>