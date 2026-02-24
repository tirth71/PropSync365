<?php include('config.php');
if(isset($_GET['id']))
  {	
  	$p_id=$_GET['id'];
    $qry ="SELECT property_image FROM `tbl_property` WHERE property_id = '$p_id' ";
	$row=mysqli_query($con,$qry);
	$result = mysqli_fetch_assoc($row);
    
    $temp = explode(',', $result['property_image']);
     
    $temp = array_filter($temp);
    
    foreach($temp as $image){
        $images="http://localhost/PropSync365/img_upload/".$image;
        if(file_exists($images)){
			// echo "file exits";
			unlink($images);
		}
    }
  	$sql = "DELETE FROM tbl_property WHERE  property_id = '$p_id'";
   
    $res=mysqli_query($con,$sql);
    
	header('location:my-properties.php');
    
  }
 ?>