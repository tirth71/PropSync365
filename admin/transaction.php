<?php 
include('header.php'); 

$transactionData = $obj->myQuery("
SELECT p.*, u.user_name, pr.property_name
FROM tbl_payment p
LEFT JOIN tbl_user u ON p.user_id = u.user_id
LEFT JOIN tbl_property pr ON p.property_id = pr.property_id
");

if(isset($_GET['did']))
{
  $data['payment_id'] = $_GET['did'];
  $obj->myDelete('tbl_payment',$data);
  $obj->redirect('transaction.php');
}
?>

<!-- Content Wrapper -->
<div class="content-wrapper">

  <!-- Page Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Transaction List</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Transaction</li>
          </ol>
        </div>

      </div>
    </div>
  </div>

  <!-- Main Content -->
  <section class="content">

    <div class="card">

      <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">

          <thead>
            <tr>
              <th>No</th>
              <th>User Name</th>
              <th>Title</th>
              <th>Transaction Id</th>
              <th>Amount</th>
              <th>Transaction Date</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>

          <?php 
          $no = 0;

          while ($row = $transactionData->fetch_assoc()) 
          {
            $no++;
          ?>

            <tr>

              <td><?php echo $no; ?></td>

              <td>
                <?php 
                echo ($row['user_name'] != NULL) ? $row['user_name'] : "User Deleted"; 
                ?>
              </td>

              <td>
                <?php 
                echo ($row['property_name'] != NULL) ? $row['property_name'] : "Property Deleted"; 
                ?>
              </td>

              <td><?php echo $row["transaction_id"]; ?></td>

              <td><?php echo $row["amount"]; ?></td>

              <td><?php echo $row["created_at"]; ?></td>

              <td>
                <div class="btn-group btn-group-sm">

                  <a onclick="return confirm('Are you sure you want to delete transaction?');"
                     href="transaction.php?did=<?php echo $row['payment_id']; ?>"
                     class="btn btn-danger">
                     <i class="fas fa-trash"></i>
                  </a>

                </div>
              </td>

            </tr>

          <?php } ?>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

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

    "columnDefs": [
      { "orderable": false, "targets": [6] }
    ]

  });

});

</script>