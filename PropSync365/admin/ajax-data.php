<?php 
	
	require("conection.php");
  	$obj=new Config();

	$id = $_POST['id'];
	$val = $_POST['val'];

	$change_status_query = $obj->myQuery("UPDATE `tbl_property` SET `live_status` = '$val' WHERE `tbl_property`.`property_id` = '$id' ");

	//echo  "status changed";
	echo "UPDATE `tbl_ property` SET live_status = '$val' WHERE property_id = '$id' ";
	;

 ?>