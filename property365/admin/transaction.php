<?php 

  include('header.php'); 

  $transactionData = $obj->myQuery("SELECT * FROM `tbl_payment` ");

  if(isset($_GET['did']))
  {
    $data['payment_id']=$_GET['did'];
    $obj->myDelete('tbl_payment',$data);
    $obj->redirect('transaction.php');
  }

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Transaction List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Transaction</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
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
              <!-- <th>First Name</th> -->
              
              <th>Amount</th>
              <th>Transaction Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no=0;
              while ($row = $transactionData->fetch_assoc()) {
                $no++;
                // Get User info
                  $getUser = $obj->myQuery("SELECT * FROM `tbl_user` WHERE user_id='{$row['user_id']}' ");
                  $userRow = $getUser->fetch_assoc();
                  // Get farm info
                  $getFarm = $obj->myQuery("SELECT property_name FROM `tbl_property` WHERE property_id='{$row['property_id']}' ");
                  $farmRow = $getFarm->fetch_assoc();
                ?>
                  <tr>
                    <th><?php echo $no; ?></th>
                    <td><?php echo $userRow["user_name"]; ?></td>
                    <td><?php echo $farmRow["property_name"]; ?></td>
                    <td><?php echo $row["transaction_id"]; ?></td>
                    <!-- <td><?php echo $row["first_name"]; ?></td> -->
                   <td><?php echo $row["amount"]; ?></td>
                    <td><?php echo $row["created_at"]; ?></td>
                    <th>
                      <div class="btn-group btn-group-sm">
                        <!-- <a href="user_edit.php?eid=<?php // echo $row['user_id']; ?>"class="btn btn-info"><i class="fas fa-edit"></i></a> -->
                        <a onclick="return confirm('Are you sure you want to delete transaction?');" href="transaction.php?did=<?php echo $row['payment_id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
<script>
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
</script>