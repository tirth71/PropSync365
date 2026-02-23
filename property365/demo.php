<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login | Property365</title>
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

    .login-box {
      display: flex;
      width: 900px;
      height: 550px;
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
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .logo {
      font-size: 32px;
      font-weight: bold;
      color: #6665ee;
    }

    .logo span {
      color: #000;
    }

    .left-box p {
      margin: 20px 0;
      color: #555;
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

    .text-center a {
      color: #6665ee;
      text-decoration: none;
    }

    .right-box {
      position: relative;
      background: url('abc.jpg') no-repeat center center/cover;
    }

    .right-box .overlay {
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
    }

    .right-box h1 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    .right-box p {
      font-size: 16px;
      line-height: 1.5;
    }

    /* Error alert */
    .alert {
      background-color: #ffdddd;
      color: #d8000c;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 15px;
    }
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <div class="left-box">
        <h2>Welcome to</h2>
        <h1 class="logo">Property<span>365</span></h1>
        <p>Login with your email and password</p>

        <form action="login-user.php" method="POST" autocomplete="">
          <?php if(count($errors) > 0): ?>
          <div class="alert">
            <?php foreach($errors as $showerror): ?>
              <p><?php echo $showerror; ?></p>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

          <input class="input" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
          <input class="input" type="password" name="password" placeholder="Password" required>

          <select class="input" name="role" required>
            <option disabled selected>Select User or Owner</option>
            <option value="1">Owner</option>
            <option value="0">User</option>
          </select>

          <!-- Centered forgot password link -->
          <div class="text-center" style="margin-bottom: 10px;">
            <a href="forgot-password.php">Forgot password?</a>
          </div>

          <button type="submit" name="login">Login</button>

          <!-- Centered sign up link -->
          <p class="signup-text">Don’t have an account? <a href="signup-user.php">Sign Up Now</a></p>
        </form>
      </div>

      <div class="right-box">
        <div class="overlay">
          <h1>Property365</h1>
          <p>Your trusted platform for buying, selling, and renting properties—made easy and secure.</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
