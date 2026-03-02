<?php 

include('header.php'); 

/* show only rented properties */
$propertyData = $obj->myQuery("SELECT * FROM tbl_property WHERE live_status=3");

?>

<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Rented Property List</h1>
        </div>
      </div>
    </div>
  </div>

<section class="content">
<div class="card">
<div class="card-body">

<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
  <th>No</th>
  <th>Property</th>
  <th>Current Tenant</th>
  <th>Owner</th>
  <th>Type</th>
  <th>Status</th>
  <th>Start Date</th>
  <th>End Date</th>
  <th>Price</th>
  <th>Deposit</th>
  <th>Total Times Rented</th>
</tr>
</thead>

<tbody>

<?php 
$no=0;

while ($row = $propertyData->fetch_assoc()) {
$no++;
?>

<tr>

<td><?php echo $no; ?></td>

<td><?php echo $row["property_name"]; ?></td>


<!-- ========== CURRENT TENANT (LATEST RENT) ========== -->
<?php
$tenantQuery = $obj->myQuery("
SELECT u.user_name
FROM tbl_rent r
JOIN tbl_user u ON r.user_id = u.user_id
WHERE r.property_id = '{$row["property_id"]}'
ORDER BY r.rent_id DESC
LIMIT 1
");

if($tenantQuery->num_rows > 0){
    $tenant = $tenantQuery->fetch_assoc();
    echo "<td>".$tenant["user_name"]."</td>";
}else{
    echo "<td>No Tenant</td>";
}
?>


<!-- ========== OWNER ========== -->
<?php
$getOwner=$obj->myQuery("SELECT user_name FROM tbl_user WHERE user_id='{$row["user_id"]}'");
$owner=$getOwner->fetch_assoc();
?>
<td><?php echo $owner["user_name"]; ?></td>


<!-- ========== TYPE ========== -->
<td><?php echo $row["property_type"]; ?></td>


<!-- ========== RENT / SALE ========== -->
<td>
<?php echo ($row["property_status"]==0)?"Rent":"Sale"; ?>
</td>


<!-- ========== LATEST RENT DATES ========== -->
<?php
$getdate = $obj->myQuery("
SELECT * 
FROM tbl_rent 
WHERE property_id = '{$row["property_id"]}'
ORDER BY rent_id DESC
LIMIT 1
");

if($getdate->num_rows > 0){
    $rental = $getdate->fetch_assoc();

    $start_date = date('d-m-Y', strtotime($rental["starting_date"]));
    $end_date   = date('d-m-Y', strtotime($rental["ending_date"]));
}else{
    $start_date = "N/A";
    $end_date   = "N/A";
}
?>

<td><?php echo $start_date; ?></td>
<td><?php echo $end_date; ?></td>


<!-- PRICE -->
<td>₹<?php echo number_format($row["property_price"]); ?></td>

<!-- DEPOSIT -->
<td>₹<?php echo number_format($row["deposite"]); ?></td>


<!-- ========== RENT COUNT (VERY IMPORTANT FEATURE) ========== -->
<?php
$countRent = $obj->myQuery("
SELECT COUNT(*) as total 
FROM tbl_rent 
WHERE property_id = '{$row["property_id"]}'
");
$c = $countRent->fetch_assoc();
?>
<td><b><?php echo $c['total']; ?></b></td>

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
  $("#rentproperty").addClass('active');

  $("#example1").DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false
  });

});
</script>