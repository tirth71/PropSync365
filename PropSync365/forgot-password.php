<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Forgot Password | Property365</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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

    .form-box {
      display: flex;
      width: 900px;
      height: 500px;
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
      background: rgba(102, 101, 238, 0.85);
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;
      padding: 40px;
      text-align: center;
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
      margin-bottom: 10px;
      text-align: center;
    }

    .right-box p {
      text-align: center;
      margin-bottom: 20px;
      color: #555;
    }

    .alert {
      background-color: #ffdddd;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 14px;
      color: #a94442;
      text-align: center;
    }

    .form-group {
      margin-bottom: 15px;
    }

    input[type="email"] {
      width: 100%;
      padding: 12px 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
      outline: none;
    }

    input[type="submit"] {
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

    input[type="submit"]:hover {
      background: linear-gradient(to right, #5c5beb, #3f3cd0);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-box">

      <!-- Left Side Image and Text -->
      <div class="left-box">
        <div class="overlay">
          <h1>Forgot Password?</h1>
          <p>Don't worry! Just enter your email and we'll send you a code to reset your password.</p>
        </div>
      </div>

      <!-- Right Side Form -->
      <div class="right-box">
        <h2>Forgot Password</h2>
       

        <form action="forgot-password.php" method="POST" autocomplete="">
          <?php if(count($errors) > 0): ?>
            <div class="alert">
              <?php foreach($errors as $error){ echo $error; } ?>
            </div>
          <?php endif; ?>

          <div class="form-group">
            <input type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
          </div>
          <div class="form-group">
            <input type="submit" name="check-email" value="Continue">
          </div>
        </form>
      </div>

    </div>
  </div>
</body>
</html>

<!-- <?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="bg_image">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
</html> -->