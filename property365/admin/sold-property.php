<?php 

  include('header.php'); 
  $propertyData = $obj->myQuery("SELECT * FROM `tbl_property` where live_status=2 ");
  

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
              <th>Live Status</th>
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
                    
                    
                    <th>
                      <div class="btn-group btn-group-sm">
                        
                        <a onclick="return confirm('Are you sure you want to delete Property?');" href="sold-property.php?did=<?php echo $row['property_id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(document).ready(function() {
    $(".nav-sidebar a").removeClass("active");
    $("#soldproperty").addClass('active');

    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "columnDefs": [{ 
          "targets": [4,5],
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
              swal("", "Update Status Succsessfully.", "success");
              window.location.href = 'sold-property.php';
            }
          });
        }
    

</script>