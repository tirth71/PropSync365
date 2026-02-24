 <?php
 include('header.php');
 
 $msg="";

 if (isset($_SESSION['user_id'])) {
 	header("Location:index.php");
 }

 if (isset($_POST['send'])) 
 {
 	$email=trim($_POST['email_id']);


 	$result=$obj->myQuery("SELECT * FROM `tbl_user` WHERE email_id='{$email}' ");
 	
 	if ($result->num_rows ==1)
 	{
 	 	$token = uniqid();
 	 	$uData = $result->fetch_assoc();
		$id = $uData['user_id'];

		$data['forgot_pass_token']= $token;
		$data['updated_at']= date('Y-m-d h:i:s');
		$where['user_id'] = $id;
		$result=$obj->myUpdate('tbl_user', $data, $where);
		
		// Go to google accout manage > security > Less secure app access > on
		// To configure XAMPP for send mail 
		// change below with php.ini file
			// SMTP=smtp.gmail.com
			// smtp_port=587
			// sendmail_from = email-id
			// sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"
		// change below with C:\xampp\sendmail and open sendmail.ini file
			// smtp_server=smtp.gmail.com
			// smtp_port=587
			// error_logfile=error.log
			// debug_logfile=debug.log
			// auth_username=email-id
			// auth_password=password
			// force_sender=email-id


		// Send email to user with the token in a link they can click on
	    $password = $uData['password'];
	    $to = $email;
	    $subject = "Reset your password";
	    $txt = "\r\n" ."Your password is : ".$password;
	    $headers = "From: password@studentstutorial.com" . "\r\n" .
               		"CC: somebodyelse@example.com";
               
        mail($to,$subject,$txt,$headers);
        $msg="Success..! Please check your inbox.";
 	} 
 	else
 	{
 		$msg="Please Enter Valid email-id.";
 	}	
 }
 ?>

<!-- Titlebar
	================================================== -->
	<div id="titlebar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Forgot Password</h2>
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
					</nav>
				</div>
			</div>
		</div>
	</div>


<!-- Contact
	================================================== -->

	<!-- Container -->
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<!--Tab -->
				<div class="my-account style-1 margin-top-5 margin-bottom-40">
					<ul class="tabs-nav" style="text-align: center;">
						<p>One step ahead to recover password</p>
						
					</ul>
					<div class="tabs-container alt">
					<!-- Login -->
						<div class="tab-content" id="tab1">
							<form method="post" class="login">
								<p class="form-row form-row-wide">
									<label for="email">Email Id:
										<i class="im im-icon-Email"></i>
										<input type="email" class="input-text" name="email_id" id="email_id" value="<?php echo @$_POST['email']; ?>" required="" placeholder="Enter valid email-id" />
									</label>
									
								</p>
								<span class="error"><?php echo $error = (isset($msg)) ? $msg : "" ; ?></span>
								<p class="form-row">
									<input type="submit" class="button border margin-top-10" name="send" value="Send" />
									
								</p>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Container / End -->
<br><br>

<?php
include('footer.php');
?>
