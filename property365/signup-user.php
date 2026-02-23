<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Signup | Property365</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6fc;
    }

    .container {
      width: 100vw;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .signup-box {
      display: flex;
      flex-direction: row;
      width: 900px;
      height: 600px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
      background: #fff;
    }

    .left-box, .right-box {
      width: 50%;
      padding: 40px;
    }

    .left-box {
      position: relative;
      background: url('abc.jpg') no-repeat center center/cover;
    }

    .left-box .overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(161, 161, 250, 0.85);
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;
      padding: 40px;
      text-align: center;
      color: white;
    }

    .left-box h1 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    .left-box p {
      font-size: 16px;
      line-height: 1.5;
    }

    .right-box {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .right-box h2 {
      margin-bottom: 20px;
    }

    form input,
    form select {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
      outline: none;
    }

    form button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: linear-gradient(to right, #6665ee, #4a49da);
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    form button:hover {
      background: linear-gradient(to right, #5c5beb, #3f3cd0);
    }

    .signup-text {
      margin-top: 10px;
      text-align: center;
    }

    .signup-text a {
      color: #6665ee;
      text-decoration: none;
      font-weight: bold;
    }

    .alert {
      background-color: #ffdddd;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 14px;
      height: 40px;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }

    input:hover, select:hover {
      border-color: #6665ee;
    }
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="signup-box">

      <!-- Left side: Image and overlay content -->
      <div class="left-box">
        <div class="overlay">
          <h1>Join Property365</h1>
          <p>Explore properties, connect with owners, and find your perfect space with ease and trust.</p>
        </div>
      </div>

      <!-- Right side: Signup form -->
      <div class="right-box">
        <h2>Create an Account</h2>

        <form action="signup-user.php" method="POST" autocomplete="">
          <?php if(count($errors) > 0): ?>
          <div class="alert">
            <?php foreach($errors as $showerror): ?>
              <span><?php echo $showerror; ?> </span>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

          <input type="text" name="name" placeholder="User Name" required value="<?php echo $name ?>">
          <input type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
          <input type="password" name="password" placeholder="Password" required>
          <input type="password" name="cpassword" placeholder="Confirm Password" required>
          <input type="text" name="address" placeholder="Address" required>
          <input type="text" name="mobile" id="mobile" placeholder="Mobile Number" required>
          <span id="mobile-error" style="color: red; font-size: 14px;"></span>

          <script>
            document.getElementById("mobile").addEventListener("input", function () {
              const val = this.value, msg = document.getElementById("mobile-error");
              msg.textContent = (/^[6-9]\d{9}$/).test(val) ? "" : "Enter valid mobile number !!";
            });
          </script>
          <select name="role" required>
            <option disabled selected>Select User or Owner</option>
            <option value="1">Owner</option>
            <option value="0">User</option>
          </select>

          <button type="submit" name="signup">Signup</button>

          <p class="signup-text">Already a member? <a href="login-user.php">Login here</a></p>
        </form>
      </div>
      
    </div>
  </div>
</body>
</html>












<!-- 
<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="bg_image">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-md-4  form">
                <form action="signup-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Signup Form</h2>
                    <p class="text-center">It's quick and easy.</p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="User Name" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="address" placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="mobile" placeholder="Mobile number" required>
                    </div>
                    
                    <div class="form-group">
                        <div style="width: 100%">
                            <select class="form-select" aria-label="Default select example" name="role">
                                <option selected>select User OR Owner</option>
                                <option value="1">Owner</option>
                                <option value="0">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Signup">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="login-user.php">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>  -->