<?php
session_start();
require "connection.php";
require 'vendor/autoload.php'; // Load PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


$email = "";
$name = "";
$errors = array();

function sendMail($email, $subject, $message) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'propsync365@gmail.com'; // Your email
        // $mail->Password = 'axho wypo mbio iplc'; // App Password wqdp lldr xelt issf
        $mail->Password = 'icht wtta jqcx wlto'; // App Password wqdp lldr xelt issf

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('propsync365@gmail.com', 'Propsync365');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// If user clicks signup
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $role = mysqli_real_escape_string($con, $_POST['role']);



    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    }

    $email_check = "SELECT * FROM tbl_user WHERE user_email = '$email'";
    $res = mysqli_query($con, $email_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email already exists!";
    }

    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data ="INSERT INTO tbl_user (user_name,user_email,user_mobile,user_password,user_address,user_type,status,resettoken)
                 VALUES ('$name','$email','$mobile','$encpass','$address','$role','$status','$code')";

        // $insert_data = "INSERT INTO usertable (name, email, password, code, status)
        //                 VALUES ('$name', '$email', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($con, $insert_data);

        if ($data_check) {
            $subject = "Email Verification Code";
           $message = "
            <div style='font-family: Arial, sans-serif; padding:20px; background-color:#f4f4f4;'>
                <div style='max-width:600px; background:#ffffff; padding:25px; border-radius:8px;'>
                    
                    <h2 style='color:#333;'>Email Verification</h2>
                    
                    <p>Dear <strong>$name</strong>,</p>
                    
                    <p>Thank you for registering with <strong>Propsync365</strong>.</p>
                    
                    <p>Please use the following One-Time Password (OTP) to complete your registration:</p>
                    
                    <div style='text-align:center; margin:20px 0;'>
                        <span style='font-size:28px; font-weight:bold; color:#4CAF50;'>$code</span>
                    </div>
                    
                    <p>This OTP is valid for <strong>10 minutes</strong>.</p>
                    
                    <p style='color:#d9534f; font-size:14px;'>
                        For security reasons, do not share this code with anyone.
                    </p>
                    
                    <hr>
                    
                    <p style='font-size:12px; color:#777;'>
                        If you did not request this registration, please ignore this email.
                    </p>
                    
                    <p>
                        Best Regards,<br>
                        <strong>Propsync365 Team</strong>
                    </p>
                    
                </div>
            </div>
            ";
            if (sendMail($email, $subject, $message)) {
                $info = "Verification code sent to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Failed while inserting data!";
        }
    }
}

// If user submits OTP
if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM tbl_user WHERE resettoken = $otp_code";
    $code_res = mysqli_query($con, $check_code);

    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['resettoken'];
        $email = $fetch_data['user_email'];
        // $role = $fetch_data['role'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE tbl_user SET resettoken = $code, status = '$status' WHERE resettoken = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);

        if ($update_res) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = $fetch_data['user_type'];
            header('location: index.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "Incorrect code!";
    }
}

// If user clicks login
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $role = $_POST['role'];
    $check_email = "SELECT * FROM tbl_user WHERE user_email = '$email'";
    $res = mysqli_query($con, $check_email);

    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['user_password'];
        $sql = "SELECT * FROM tbl_user WHERE user_email = '$email' and user_type='$role'";
        $result = mysqli_query($con, $sql) or die("error in sql");
        if(mysqli_num_rows($result))
        {
            if (password_verify($password, $fetch_pass))
            {
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if ($status == 'verified') {
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['user_type'] = $role;
                    header('location: index.php');
                } else {
                    $info = "Verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }
            else
            {
                $errors['email'] = "Incorrect email or password!";
            }
               
        } 
        else
        {
            $errors['email'] = "Incorrect type!";
        }
    } else {
        $errors['email'] = "You're not registered!";
    }
}

// Forgot password process
if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM tbl_user WHERE user_email='$email'";
    $run_sql = mysqli_query($con, $check_email);

    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE tbl_user SET resettoken = $code WHERE user_email = '$email'";
        $run_query = mysqli_query($con, $insert_code);

        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "
                <div style='font-family: Arial, Helvetica, sans-serif; background-color:#f2f5f9; padding:25px;'>

                    <div style='max-width:600px; margin:auto; background:#ffffff; padding:30px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08);'>

                        <h2 style='color:#2b2e4a; margin-bottom:10px;'>Password Reset Request</h2>

                        <p>Dear <strong>$name</strong>,</p>

                        <p>We received a request to reset the password for your <strong>PropSync365</strong> account.</p>

                        <p>Please use the following One-Time Password (OTP) to reset your password:</p>

                        <div style='text-align:center; margin:25px 0;'>
                            <span style='display:inline-block; background:#6c63ff; color:#ffffff; padding:14px 28px; font-size:30px; font-weight:bold; border-radius:8px; letter-spacing:4px;'>
                                $code
                            </span>
                        </div>

                        <p>This OTP will expire in <strong>10 minutes</strong>.</p>

                        <p style='color:#d9534f; font-size:14px;'>
                            ⚠ For security reasons, never share this code with anyone.
                        </p>

                        <hr style='margin:25px 0;'>

                        <p style='font-size:13px; color:#777;'>
                            If you did not request a password reset, please ignore this email. Your account will remain secure.
                        </p>

                        <p>
                            Regards,<br>
                            <strong>PropSync365 Support Team</strong>
                        </p>

                    </div>

                </div>
                ";

            // Replace mail() with sendMail()
            if (sendMail($email, $subject, $message)) {
                $info = "Password reset OTP sent to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email does not exist!";
    }
}


// Reset OTP verification
if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM tbl_user WHERE resettoken = $otp_code";
    $code_res = mysqli_query($con, $check_code);

    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['user_email'];
        $_SESSION['email'] = $email;
        // $info = "Create a new password.";
        // $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "Incorrect code!";
    }
}

// Change password
if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password does not match!";
    } else {
        $code = 0;
        $email = $_SESSION['email'];
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE tbl_user SET resettoken = $code, user_password = '$encpass' WHERE user_email = '$email'";
        $run_query = mysqli_query($con, $update_pass);

        if ($run_query) {
            $info = "Password changed. Log in with your new password.";
            $_SESSION['info'] = $info;
            header('Location: login-user.php');
        } else {
            $errors['db-error'] = "Failed to change password!";
        }
    }
}

if(isset($_POST['login-now'])){
    header('Location: login-user.php');
}
?>


<!-- composer require phpmailer/phpmailer -->