<?php 
include('header.php'); 
$user_query = $obj->myQuery("SELECT count(user_id) as id FROM `tbl_user`");
$user_count = $user_query->fetch_assoc();

$property_query = $obj->myQuery("SELECT count(property_id) as id FROM `tbl_property`where live_status in (1,3)");
$property_count = $property_query->fetch_assoc();

$transaction_query = $obj->myQuery("SELECT count(payment_id) as id FROM `tbl_payment`");
$transaction_count = $transaction_query->fetch_assoc();
$sold_query = $obj->myQuery("SELECT count(property_id) as id FROM `tbl_property`where live_status=2");
$sold_count = $sold_query->fetch_assoc();
$rent_query = $obj->myQuery("SELECT count(rent_id) as id FROM `tbl_rent`");
$rent_count = $rent_query->fetch_assoc();


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $user_count['id']; ?></h3>

              <p>User List</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $property_count['id']; ?></h3>

              <p>Property List</p>
            </div>
            <div class="icon">
              <i class="fa fa-home"></i>
            </div>
            <a href="property.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $transaction_count['id']; ?></h3>

              <p>Transaction Data</p>
            </div>
            <div class="icon">
              <i class="fa fa-credit-card"></i>
            </div>
            <a href="transaction.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $sold_count['id']; ?></h3>

              <p>Sold Property</p>
            </div>
            <div class="icon">
              <i class="fa  fa-shopping-bag"></i>
            </div>
            <a href="sold-property.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?php echo $rent_count['id']; ?></h3>

              <p>Rent Property</p>
            </div>
            <div class="icon">
              <i class="fa  fa-shopping-bag"></i>
            </div>
            <a href="rent-property.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('footer.php'); ?>