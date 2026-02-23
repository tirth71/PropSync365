<?php 

  include('header.php'); 

  $userData = $obj->myQuery("SELECT * FROM `tbl_user` ");

  if(isset($_GET['did']))
  {
    $data['user_id']=$_GET['did'];
    $obj->myDelete('tbl_user',$data);
    $obj->redirect('user.php');
  }

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">User List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">User</li>
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
              <th>User Name</th>
              <th>Type</th>
              <th>Email</th>
              <th>Mobile No</th>
              
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no=0;
              while ($row = $userData->fetch_assoc()) {
                $no++;
                ?>
                  <tr>
                    <th><?php echo $no; ?></th>
                    <td><?php echo $row["user_name"]; ?></td>
                    <?php if($row["user_type"] == 0){
                      $type = "User";
                    }else{
                      $type = "Owner";
                    } ?>
                    <td><?php echo $type; ?></td>
                    <td><?php echo $row["user_email"]; ?></td>
                    <td><?php echo $row["user_mobile"]; ?></td>
                    
                    <th>
                      <div class="btn-group btn-group-sm">
                        <!-- <a href="user_edit.php?eid=<?php // echo $row['user_id']; ?>"class="btn btn-info"><i class="fas fa-edit"></i></a> -->
                        <a onclick="return confirm('Are you sure you want to delete User?');" href="user.php?did=<?php echo $row['user_id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
    $("#users").addClass('active');
  });

   $("#example1").DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "columnDefs": [{ 
        "targets": [4],
        "orderable": false
      }]
  });
</script>