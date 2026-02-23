
<?php 

include('header.php'); 

if (isset($_POST['change_pass'])) 
{
  $msg="";
  $old_password=trim($_POST['old_pass']);
  $new_password=trim($_POST['new_pass']);
  $confirm_password=trim($_POST['confirm_pass']);


  $result = $obj->myQuery("SELECT password FROM `tbl_admin` WHERE admin_id='".$_SESSION['admin_id']."' AND password='{$old_password}' ");

  if ($result->num_rows == 1)
  {
    if ($new_password == $confirm_password) 
    {
      if(!preg_match("/^[a-zA-Z0-9]{4,20}$/",$new_password))
      {
        $error = "Required minimum 4 to maximum 20 characters and does not allow any special character as password.";
      } 
      else 
      {
        $updateData = $obj->myQuery("UPDATE `tbl_admin` SET password='{$new_password}' WHERE admin_id='".$_SESSION['admin_id']."' AND password='{$old_password}' ");

        $success = "Admin password changed successfully.";
      }
    } 
    else 
    {
      $error = "The new password and confirm password does not match.";
    }
  } 
  else
  {
    $error = "Old password does not match.";
  } 
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Change Password</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Change Password</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="col-md-5">
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
        <center>
          <?php if (isset($success)) {
            ?>
            <span class="error"><p style="color: #32CD32;"><?php echo $success; ?></p></span>
            <?php
          } elseif (isset($error)) {
            ?>
            <span class="error"><p style="color: red;"><?php echo $error; ?></p></span>
            <?php
          } 
          ?>
        </center>
        <form method="post">
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="old_pass" placeholder="Current Password" required="">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="new_pass" placeholder="New Password" required="">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="confirm_pass" placeholder="Confirm Password" required="">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="change_pass" class="btn btn-primary btn-block">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</div> 
<?php include('footer.php'); ?>