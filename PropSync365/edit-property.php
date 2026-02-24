<?php  
  session_start();
  if(@$_SESSION['user_type']==1 && @$_SESSION['email'])
  {
    include ("config.php");
    if(isset($_POST['submit'])){

      if(isset($_SESSION['email'])){
        $email=$_SESSION['email'];
        $qry = "SELECT * FROM tbl_user Where user_email = '$email' AND user_type=1";
        $row1 = mysqli_query($con,$qry);
        $result1 = mysqli_fetch_assoc($row1);
        $u_id = $result1['user_id'];
      }
      $id=$_REQUEST['pid'];
      $u_id=$u_id;
      $property_name=$_REQUEST['name'];
      $type=$_REQUEST['type'];
      $address=$_REQUEST['address'];
      $squarefeet=$_REQUEST['squarefeet'];
      $price=str_replace(",","",$_REQUEST['price']);
      $description=$_POST['description'];
      $totalbeds=$_REQUEST['totalbeds'];
      $totalbaths=$_REQUEST['totalbaths'];
      $state=$_REQUEST['state'];
      $city=$_REQUEST['city'];
      $status=$_REQUEST['status'];
      // $deposit=$_REQUEST['deposit'];
      $serverPath=$_SERVER["DOCUMENT_ROOT"]."/PropSync365";
      if (!empty(array_filter($_FILES['path']['name'])))
        { 
          $totalFiles=count($_FILES['path']['name']);
          // echo $totalFiles=count($_FILES['path']['name']);
          $fileErrorChk=0;
          for ($i=0; $i < $totalFiles; $i++) 
          { 
              if(is_uploaded_file($_FILES["path"]['tmp_name'][$i]))
              {
                $ext = pathinfo($_FILES['path']['name'][$i],PATHINFO_EXTENSION);
                if($ext=='jpg'||$ext=="png"||$ext=="jpeg")
                {
                  $size=$_FILES['path']['size'][$i];
                  $size=$size/1024/1024;
        
                  if($size<=4)
                  {
                    if($_FILES['path']['error'][$i]==0)
                    {
                      $fileErrorChk=1;
                    }
                    else
                    {
                      $fileErrorChk=0;
                      $ImageErr="Somthing Wrong...";
                      
                    }
                  }
                  else
                  {
                    $fileErrorChk=0;
                    $ImageErr="File Size Is Not...";
                    
                  }
                }
                else
                {
                  $fileErrorChk=0;
                  $ImageErr="Not Valid Type...";
                  
                }
              }
              else
              {
                $fileErrorChk=0;
                $ImageErr="File Is Not Selected...";
                
              } 
          }
          $fileName="";
          if($fileErrorChk==1)
          {
            $filestr="";
            for ($i=0; $i < $totalFiles; $i++) 
            { 
              $fileName="";
              $fileName.=date('Y-m-d-h-i-s')."-{$i}.{$ext}";
              $uploadPath=$serverPath."http://localhost/PropSync365/img_upload/".$fileName;

              move_uploaded_file($_FILES['path']['tmp_name'][$i],$uploadPath);

              $filestr.="$fileName,";
            }
            $filestr=trim($filestr,",");
            
            $qry ="SELECT property_image FROM `tbl_property` WHERE property_id = '$id' ";
            $row=mysqli_query($con,$qry);
            $result = mysqli_fetch_assoc($row);
            
            $i_name = $result['property_image'];
            $filestr.=",$i_name";
            $filestr=trim($filestr,",");
            //echo $filestr;
          }

          $images=$filestr;
        }
        else
        {
         $qry ="SELECT property_image FROM `tbl_property` WHERE property_id = '$id' ";
            $row=mysqli_query($con,$qry);
            $img_str = mysqli_fetch_assoc($row);
          $i_name = $img_str['property_image'];
          $images=$i_name;
        }
      
        $sql = ("UPDATE tbl_property SET property_name='$property_name',property_type='$type',property_address='$address',property_sqfeet='$squarefeet',property_price='$price',property_image='$images',property_description='$description',property_totalbeds='$totalbeds',property_totalbaths='$totalbaths',property_state='$state',property_city='$city',property_status='$status',user_id='$u_id' where property_id = '$id'")or die("$sql_error();");
           
     
      $res=mysqli_query($con,$sql);
      
       $result_cnt=mysqli_affected_rows($con);
       
        
        if($result_cnt>0){
          echo "<script>alert('your Property updated..!!'); window.location.href = 'my-properties.php';</script>";
        }
        else{
           echo "<script>alert('your Property not updated..!!'); window.location.href = 'my-properties.php';</script>";
           echo "$description";
        }

            
        }

   
    
  
      
  include("header.php");
      
 ?>



<!--=========================================== -->

<!-- #page-title end -->

<!-- #Add Property
============================================= -->
<section id="add-property" class="add-property" style="padding-top: 100px;
    padding-bottom: 100px;">

  <!-- <div class="bg-section">
    <img src="assets/images/slider/slide-bg/new-hero-image.jpg" alt="Background" />
  </div> -->
  <div class="bg-section">
    <img src="assets/images/slider/slide-bg/dark_back.png" alt="Background" />
  </div>
  <div class="container">
    <div class="row">
      <div style="padding-top: 30px;">
        <div class="col-md-3">
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
          <?php
                            if(isset($_GET['id'])){ 
                            $id = $_GET['id'];
                            $q = "SELECT * FROM tbl_property where property_id = '$id'";
                            $row = mysqli_query($con,$q);
                            while ($result = mysqli_fetch_assoc($row)) {?>

          <form class="mb-0" method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]);?>"
            enctype='multipart/form-data'>
            <div class="page-title bg-overlay bg-overlay-dark2">
              <div class="form-box1">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <h4 class="form--title">Property Description</h4>
                  </div>
                  <!-- .col-md-12 end -->
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <input type="hidden" name="pid" id="pid" value="<?php echo $_GET['id'];?>">
                      <label1 for="property-name">Property Name</label1>
                      <input type="text" class="form-control" name="name" id="property-name"
                        value="<?php echo @$result['property_name'];?>" required>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-6">
                    <div class="form-group">
                      <label1 for="select-type">Type</label1>
                      <div class="select--box">
                        <i class="fa fa-angle-down"></i>
                        <?php $type = @$result['property_type'];?>
                        <select id="select-type" name="type" selected="">
                          <option <?php if ($type=="Bungalow" ) echo 'selected' ; ?>>Bungalow</option>
                          <option <?php if ($type=="Row-house" ) echo 'selected' ; ?>>Row-house</option>
                          <option <?php if ($type=="Flat" ) echo 'selected' ; ?>>Flat</option>
                          <option <?php if ($type=="Farm-house" ) echo 'selected' ; ?>>Farm-house</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <label1 for="property-Address">Property Address</label1>
                      <input type="text" class="form-control" name="address" id="property-Address"
                        value="<?php echo @$result['property_address'];?>" required>

                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-Squarefeet">Property Square-feet</label1>
                      <input type="text" class="form-control" name="squarefeet" id="property-Squarefeet"
                        value="<?php echo @$result['property_sqfeet'];?>" required>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-Squarefeet">Property Price</label1>
                      <input type="text" class="form-control" name="price" id="property-price" max="15" placeholder="RS"
                        value="<?php echo @$result['property_price'];?>" required>
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <label1 for="property-Image">Property Image</label1></br>
                      <div class="upload--img-area">
                        <input type="file" name="path[]" id="path" multiple>
                      </div>
                    </div>
                  </div>
                  <?php 
                                           $temp = explode(',', $result['property_image']);
                                           // print_r($temp[0]);
                                          $temp = array_filter($temp);
                                          foreach($temp as $image){
                                              $images[]="http://localhost/PropSync365/img_upload//".trim( str_replace( array('[',']') ,"" ,$image ) );
                                          }  
                                          if(@$images)
                                          {
                                          foreach($images as $image){
                                            if(is_file($image)){
                                                $img=  "<img src='{$image}' style='height:85px !important; width:85px !important;' class='img-fluid mb-2'/>";
                                              }

                                              ?>

                  <div class="col-md-2 imgDelete" style="text-align: right;margin-bottom: 30px;">

                    <?php echo "<img src='{$image}' style='height:85px !important; width:85px !important;' class='img-fluid mb-2'/>"; ?>
                    <span style="position: absolute; right: 15px; top: 5px; "><a
                        href="delete_img.php?img_id=<?php echo $image; ?>&pid=<?php echo $_GET['id']; ?>"
                        class="imgDelete"
                        style="border-radius: 50%;padding-right: 4px;padding-left: 4px; background: #f8f9fa;color: red;font-size: 15px;"><i
                          class="fa fa-times"></i></a></span>
                  </div>

                  <?php
                                          }
                                            }
                                          ?>

                  <!-- .col-md-12 end -->
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <label1 for="property-description">Property Description</label1>
                      <textarea class="form-control" name="description" id="property-description" rows="2" value=""
                        required><?php echo @$result['property_description'];?></textarea>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-totalbeds">Property total bedroom</label1>
                      <input type="number" class="form-control" name="totalbeds" id="property-totalbeds"
                        value="<?php echo @$result['property_totalbeds'];?>" required>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-totalbaths">Property total baths</label1>
                      <input type="number" class="form-control" name="totalbaths" id="property-totalbaths"
                        value="<?php echo @$result['property_totalbaths'];?>" required>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-state">Property state</label1>
                      <input type="text" class="form-control" name="state" id="property-state"
                        value="<?php echo @$result['property_state'];?>" readonly style="background-color:  #aaaaaa;">

                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-city">Property city</label1>
                      <!-- <input type="text" class="form-control" name="city" id="property-city" value="<?php echo @$result['property_city'];?>" required> -->

                      <i class="fa fa-angle-down"></i>
                      <select name="city" id="property-city">
                        <option value="<?php echo @$result['property_city'];?>">
                          <?php echo @$result['property_city']; ?>
                        </option>
                        <option value="Surat">Surat</option>
                        <option value="Ahemdabad">Ahemdabad</option>
                        <option value="Vadodara">Vadodara</option>
                        <option value="Rajkot">Rajkot</option>
                        <option value="Bhavnagar">Bhavnagar</option>
                        <option value="Anand">Anand</option>
                        <option value="Navsari">Navsari</option>
                        <option value="Morbi">Morbi</option>
                        <option value="Bharuch">Bharuch</option>
                        <option value="Amreli">Amreli</option>
                      </select>

                    </div>

                  </div>
                  <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label1 for="property-deposit">Deposit</label1>
                                                <input type="text" class="form-control" name="deposit" id="deposit" value="<?php echo @$result['deposit'];?>">
                                                 
                                            </div>
                                        </div> -->
                  <!-- .col-md-4 end -->
                  <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                      <label1 for="select-status">Property status</label1>
                      <div class="select--box">
                        <i class="fa fa-angle-down"></i>
                        <?php $status = @$result['property_status'];?>
                        <select id="select-status" name="status">
                          <option <?php if ($status==0 ) echo 'selected' ; ?> value="0">rent</option>
                          <option <?php if ($status==1 ) echo 'selected' ; ?> value="1">sale</option>
                        </select><span class="error">
                          <?php echo @$statusErr;?>
                        </span>
                      </div>
                    </div>

                    <input type="submit" value="submit" name="submit" class="btn btn--primary">
                  </div>
                </div>
              </div>
          </form>
          <?php } } ?>
        </div>

        <!-- .col-md-12 end -->
      </div>
    </div>
    <!-- .row end -->
  </div>
</section>

<!-- #social-profile  end -->

<!-- cta #1
============================================= -->
<!--  -->
<!-- #cta1 end -->
<!-- Footer #1

    ============================================= -->
<?php include("footer.php"); ?>
</div>
<?php } else header("location:index.php");?>
<!-- #wrapper end -->

<!-- Footer Scripts
============================================= -->

<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/plugins.js"></script>

<script src="assets/js/functions.js"></script>


</body>

</html>