<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

  <style>
    .error {
      color: red !important;
    }
  </style>

</head>
<?php
session_start();
if (@$_SESSION['user_type'] == 1 && @$_SESSION['email']) {

?>
  <?php

  include("config.php");
  function test_input($data)
  {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  //  $nameErr=$typeErr=$addressErr=$squarefeetErr=$priceErr=$descriptionErr=$stateErr=$cityErr=$depositeErr=$status=" ";
  // $name=$type=$address=$squarefeet=$price=$description=$state=$city=$status=$deposite=" ";
  if (isset($_POST['submit'])) {

    $email = $_SESSION['email'];
    $u = " SELECT * FROM tbl_user where user_email='$email'AND user_type=1 ";
    $res = mysqli_query($con, $u);
    $row =  mysqli_fetch_assoc($res);
    $user_id = $row['user_id'];

    $u_id = $user_id;

    if (empty($_POST['name'])) {
      $nameErr = "name is required";
    } else if (!preg_match("/^[a-zA-Z- ,0-9]*$/", $_POST["name"])) {
      $nameErr = "enter valide name";
    } else {
      $name = test_input($_POST["name"]);
    }
    if (empty($_POST['type'])) {
      $typeErr = "please any one select";
    } else {
      $type = test_input($_POST["type"]);
    }

    if (empty($_POST['address'])) {
      $addressErr = "address is required";
    }
    // else if(!preg_match("/^[a-zA-Z0-9_.-,:\"\']*$/",$_POST["address"]))
    // {
    //   $addressErr="enter valide address";
    // }
    else {
      $comment = test_input($_POST["address"]);
    }

    if (empty($_POST['squarefeet'])) {
      $squarefeetErr = "squarefeet is required";
    } else if (!preg_match("/^[0-9]*$/", $_POST["squarefeet"])) {
      $squarefeetErr = "enter valide squarefeet";
    } else {
      $squarefeet = test_input($_POST["squarefeet"]);
    }

    if (empty($_POST['price'])) {
      $priceErr = "price is required";
    } else if (!preg_match("/^[0-9,]*$/", $_POST["price"])) {
      $priceErr = "enter valide price";
    } else {
      $price = test_input($_POST["price"]);
    }

    if (empty($_POST['description'])) {
      $descriptionErr = "description is required";
    }
    // else if(!preg_match("/^[a-zA-Z0-9_.-, :\"\']*$/",$_POST["description"]))
    // {
    //   $descriptionErr="enter proper description";
    // }
    else {
      $description = test_input($_POST["description"]);
    }
    if (empty($_POST['city'])) {
      $cityErr = "city is required";
    } else {
      $city = test_input($_POST["city"]);
    }

    if (isset($_POST['status'])) {
      $status = test_input($_POST["status"]);
    } else {
      $statusErr = "please any one select";
    }
    if (!preg_match("/^[0-9]*$/", $_POST["deposite"])) {
      $depositeErr = "enter valide deposite";
    } else {
      $deposite = test_input($_POST["deposite"]);
    }
    /* ================= PROPERTY DOCUMENT VALIDATION ================= */

    $doc_name = "";

    if (isset($_FILES['property_doc']) && $_FILES['property_doc']['name'] != "") {
      $allowed_ext = array('pdf', 'jpg', 'jpeg', 'png');

      $file_name = $_FILES['property_doc']['name'];
      $file_tmp  = $_FILES['property_doc']['tmp_name'];
      $file_size = $_FILES['property_doc']['size'];

      $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

      // check extension
      if (!in_array($ext, $allowed_ext)) {
        echo "<script>alert('Only PDF, JPG, JPEG, PNG files allowed for property proof');</script>";
        exit;
      }

      // max 5MB
      if ($file_size > 5 * 1024 * 1024) {
        echo "<script>alert('Document size must be less than 5MB');</script>";
        exit;
      }

      // rename file (important security)
      $doc_name = "DOC_" . time() . "." . $ext;

      move_uploaded_file($file_tmp, "property_docs/" . $doc_name);
    } else {
      echo "<script>alert('Property ownership proof is required');</script>";
      exit;
    }

    if (empty($nameErr) && empty($typeErr) && empty($addressErr) && empty($squarefeetErr) && empty($priceErr) && empty($descriptionErr) && empty($statusErr) && empty($cityErr) && empty($depositeErr)) {

      $property_name = $_REQUEST['name'];
      $type = $_REQUEST['type'];
      $address = $_REQUEST['address'];
      $squarefeet = $_REQUEST['squarefeet'];
      $price = str_replace(",", "", $_POST['price']);
      // $price=$_REQUEST['price'];
      $description = $_REQUEST['description'];
      $totalbeds = $_REQUEST['totalbeds'];
      $totalbaths = $_REQUEST['totalbaths'];
      $state = $_REQUEST['state'];
      $city = $_REQUEST['city'];
      $status = $_REQUEST['status'];
      $deposite = $_REQUEST['deposite'];

      $serverPath = $_SERVER["DOCUMENT_ROOT"] . "/PropSync365";
      if (!empty($_FILES['path']['name'])) {
        $totalFiles = count($_FILES['path']['name']);

        $fileErrorChk = 0;

        if ($totalFiles < 7) {

          for ($i = 0; $i < $totalFiles; $i++) {
            if (is_uploaded_file($_FILES["path"]['tmp_name'][$i])) {
              $ext = pathinfo($_FILES['path']['name'][$i], PATHINFO_EXTENSION);
              if ($ext == 'jpg' || $ext == "png" || $ext == "jpeg" || $ext == "jfif") {
                $size = $_FILES['path']['size'][$i];
                $size = $size / 1024 / 1024;

                if ($size <= 5) {
                  if ($_FILES['path']['error'][$i] == 0) {
                    $fileErrorChk = 1;
                  } else {
                    $fileErrorChk = 0;
                    $ImageErr = "Somthing Wrong...";
                  }
                } else {
                  $fileErrorChk = 0;
                  $ImageErr = "File Size Is Not...";
                }
              } else {
                $fileErrorChk = 0;
                $ImageErr = "Not Valid Type...";
              }
            } else {
              $fileErrorChk = 0;
              $ImageErr = "File Is Not Selected...";
            }
          }
        } else {
          $fileErrorChk = 0;
          $ImageErr = "Can not upload more then 6 file.";
        }
        $fileName = "";
        if ($fileErrorChk == 1) {
          $filestr = "";
          for ($i = 0; $i < $totalFiles; $i++) {
            $fileName = "";
            $fileName .= date('Y-m-d-h-i-s') . "-{$i}.{$ext}";
            $uploadPath = $serverPath . "/img_upload/" . $fileName;

            move_uploaded_file($_FILES['path']['tmp_name'][$i], $uploadPath);

            $filestr .= "$fileName,";
          }
          $filestr = trim($filestr, ",");
        }

        $images = $filestr;
      }


      $live_status = 0;          // property not active yet
      $approval_status = 0;      // waiting for admin verification

      $sql = "INSERT INTO tbl_property
(property_name,property_type,property_address,property_sqfeet,property_price,property_image,property_document,property_description,property_totalbeds,property_totalbaths,property_state,property_city,property_status,user_id,live_status,deposite,approval_status)
VALUES
('$property_name','$type','$address','$squarefeet','$price','$images','$doc_name','$description','$totalbeds','$totalbaths','$state','$city','$status','$u_id','$live_status','$deposite','$approval_status')";
      $res = mysqli_query($con, $sql);
      $result_cnt = mysqli_affected_rows($con);
      if ($result_cnt > 0) {
        echo "<script>
alert('Property submitted successfully. It will be visible after admin verification.');
window.location='my-properties.php';
</script>";
      } else {

        echo "<script>alert('your property not added..!!');</script>";
      }
    }
  }

  include("header.php");
  ?>


  <!--=========================================== -->

  <!-- #page-title end -->

  <!-- #Add Property
============================================= -->
  <section id="add-property" class="add-property" style="padding-top: 120px;
padding-bottom: 100px;">

    <div class="bg-section">
      <img src="assets/images/slider/slide-bg/dark_back.png  " alt="Background" />
    </div>
    <div class="container">
      <div class="row" style="justify-content: center; display: flex;">

        <div class="col-xs-12 col-sm-12 col-md-12">
          <form class="mb-0" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype='multipart/form-data'>
            <div class="form-box1">
              <div class="page-title bg-overlay bg-overlay-dark2">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <h4 class="form--title">Property Description</h4>
                  </div>
                  <!-- .col-md-12 end -->
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-name">Property Name</label1>
                      <input type="text" class="form-control" name="name" id="property-name">
                      <span class="error"><?php echo @$nameErr; ?></span>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-6">
                    <div class="form-group">
                      <label1 for="select-type">Type</label1>
                      <div class="select--box">
                        <i class="fa fa-angle-down"></i>
                        <select id="select-type" name="type">
                          <option>Bungalow</option>
                          <option>Row-house</option>
                          <option>Flat</option>
                          <option>Farm-house</option>
                        </select>
                        <span class="error"><?php echo @$typeErr; ?></span>

                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <label1 for="property-Address">Property Address</label1>
                      <input type="text" class="form-control" name="address" id="property-Address">
                      <span class="error"><?php echo @$addressErr; ?></span>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-Squarefeet">Property Square-feet</label1>
                      <input type="text" class="form-control" name="squarefeet" id="property-Squarefeet" placeholder="Sq-feet">
                      <span class="error"><?php echo @$squarefeetErr; ?></span>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-Squarefeet">Property Price</label1>
                      <input type="text" class="form-control" name="price" id="property-price" max="15" placeholder="RS">
                      <span class="error"><?php echo @$priceErr; ?></span>

                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <label1 for="property-Image">Property Image</label1></br>
                      <div class="upload--img-area">
                        <input type="file" name="path[]" id="path" class="form-control" multiple>
                        <!-- <span class="error"><?php echo $ImageErr; ?></span> -->
                      </div>
                      <small style="color:black;">
                        Upload valid Property Images (PDF/JPG/PNG, Max 5MB)
                      </small>
                    </div>
                  </div>

                  <!-- PROPERTY DOCUMENT UPLOAD -->
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <label1>Property Ownership Proof (Light Bill / Property Tax / Sale Deed)</label1>
                      <div class="upload--img-area">
                        <input type="file" name="property_doc" class="form-control"
                          accept=".pdf,.jpg,.jpeg,.png" required>
                      </div>
                      <small style="color:black;">
                        Upload valid ownership proof. (PDF/JPG/PNG, Max 5MB)
                      </small>
                    </div>
                  </div>


                  <!-- .col-md-12 end -->
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <label1 for="property-description">Property Description</label1>
                      <textarea class="form-control" name="description" id="property-description" rows="2"></textarea>
                      <span class="error"><?php echo @$descriptionErr; ?></span>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-totalbeds">Property total bedroom</label1>
                      <input type="number" class="form-control" name="totalbeds" id="property-totalbeds">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-totalbaths">Property total baths</label1>
                      <input type="number" class="form-control" name="totalbaths" id="property-totalbaths">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-state">Property state</label1>
                      <input type="text" class="form-control" name="state" id="property-state" value="Gujarat" readonly>

                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-state">Property City</label1>
                      <div class="select--box">
                        <i class="fa fa-angle-down"></i>
                        <select name="city" id="city">

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
                        <span class="error"><?php echo @$cityErr; ?></span>
                      </div>
                    </div>
                  </div>
                  <!-- .col-md-4 end -->
                  <div class="col-xs-12 col-sm-4 col-md-6">
                    <div class="form-group">
                      <label1 for="select-status">Property status</label1>
                      <div class="select--box">
                        <i class="fa fa-angle-down"></i>
                        <select id="select-status" name="status">
                          <option value="0">rent</option>
                          <option value="1">sale</option>
                        </select><span class="error"><?php echo @$statusErr; ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label1 for="property-deposite">Property Deposite</label1>
                      <input type="text" class="form-control" name="deposite" id="property-deposite">
                      <span class="error"><?php echo @$depositeErr; ?></span>
                    </div>

                  </div>
                  <div class="col-xs-12">
                    <input type="submit" value="submit" name="submit" class="btn btn--primary">
                  </div>


                </div>
          </form>
        </div>
        <!-- .col-md-12 end -->
      </div>
      <!-- .row end -->
    </div>
  </section>


  <?php include("footer.php"); ?>
  </div>
  <!-- #wrapper end -->
<?php } else header("location:index.php"); ?>
<!-- Footer Scripts
============================================= -->

<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/plugins.js"></script>

<script src="assets/js/functions.js"></script>
</body>

</html>