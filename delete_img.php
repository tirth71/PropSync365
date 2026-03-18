<?php 
include('config.php');

$img_id = $_GET['img_id'];
$p_id = $_GET['pid'];
 //echo $img_id;

$img_id = substr($img_id,8);
//echo "<pre>";
//echo $img_id;
$qry ="SELECT property_image FROM `tbl_property` WHERE property_id = '$p_id' ";
$row=mysqli_query($con,$qry);
$img_str = mysqli_fetch_assoc($row);

 //print_r($img_str);

$temp = explode(',', $img_str['property_image']);
//print_r($temp[0]);
$temp = array_filter($temp);

// print_r($temp);
$index = array_search($img_id, $temp);


// print_r ($index);

unset($temp[$index]);
// var_dump($temp);
$temp = array_values($temp);

print_r($temp);

$temp = implode(',', $temp);

$filedel="http://localhost/PropSync365/img_upload/".$img_id;

if(file_exists($filedel)){
	// echo "file exits";
	unlink($filedel);
}

$images = $temp;
$sql = "UPDATE tbl_property SET property_image='$images' where property_id = '$p_id'";
   
    $res=mysqli_query($con,$sql);
    
    
header('location:edit-property.php?id='.$p_id);
?>