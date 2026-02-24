<?php 
include("config.php");
// include("header.php");   

if (isset($_REQUEST['submit'])) {  
    $name = $_REQUEST['contact_name'];
    $email = $_REQUEST['contact_email'];
    $phone = $_REQUEST['phone_number'];
    $message = $_REQUEST['message'];
    $date = date('Y-m-d H:i:s');

    $sql = "SELECT * FROM tbl_contact WHERE contact_email='$email'";
    $result = mysqli_query($con, $sql) or die('query error');
    $cnt_row = mysqli_num_rows($result);

    if ($cnt_row == false) {
        $sql = "INSERT INTO tbl_contact (contact_name, contact_email, contact_phone, contact_message, contact_date) 
                VALUES ('$name', '$email', '$phone', '$message', '$date')";
        $result = mysqli_query($con, $sql);
        $result_cnt = mysqli_affected_rows($con);

        if ($result_cnt > 0) {
            echo "<script>alert('Thank you For Contacting Us!'); window.location.href = 'contact.php';</script>";
        } 
    } else {
        echo "<script>alert('Your Email is Already Registered!'); window.location.href = 'contact.php';</script>";
    }
    

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Contact Us</title>
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #1f2b37;
            color: #fff;
        }

        .contact {
            display: flex;
            flex-wrap: wrap;
            padding: 60px 10%;
            justify-content: space-between;
            align-items: flex-start;
            gap: 30px;
        }

        .contact-info,
        .contact-form {
            flex: 1 1 45%;
            background: rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 10px;
        }

        .contact-info h2,
        .contact-form h2 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        .contact .heading {
            text-align: center;
            width: 100%;
            margin-bottom: 30px;
        }

        .contact .heading h1 {
            font-size: 40px;
        }

        .contact-info p {
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .info {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .info .icon {
            width: 40px;
            margin-right: 15px;
        }

        .info img {
            width: 100%;
            filter: invert(100%);
        }

        .info h3 {
            color: #6c60fe;
            margin-bottom: 5px;
        }

        .contact-form form {
            display: flex;
            flex-direction: column;
        }

        .contact-form input,
        .contact-form textarea {
            background: transparent;
            border: none;
            border-bottom: 2px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
            color: #fff;
            font-size: 16px;
        }

        .contact-form textarea {
            resize: none;
            height: 100px;
        }

        .contact-form button {
            width: 150px;
            padding: 10px;
            background: #6c60fe;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .contact-form button:hover {
            background: #5c51d6;
        }

        @media (max-width: 768px) {
            .contact {
                flex-direction: column;
                padding: 30px 5%;
            }
        }
    </style>
</head>

<body>
    <section class="contact">
        <div class="heading">
            <h1>Contact Us</h1>
        </div>

        <div class="contact-info">
            <div class="info">
                <div class="icon"><img src="https://img.icons8.com/ios-filled/50/marker.png"/></div>
                <div>
                    <h3>Address</h3>
                    <p>B-13, PropSync365<br>Silver Hub, Adajan,<br>Surat</p>
                </div>
            </div>
            <div class="info">
                <div class="icon"><img src="https://img.icons8.com/ios-filled/50/phone.png"/></div>
                <div>
                    <h3>Phone</h3>
                    <p>+91 96645-45456</p>
                </div>
            </div>
            <div class="info">
                <div class="icon"><img src="https://img.icons8.com/ios-filled/50/email.png"/></div>
                <div>
                    <h3>Email</h3>
                    <p>propsync365@gmail.com</p>
                </div>
            </div>
        </div>

        <div class="contact-form">
            <h2>Send Message</h2>
            <form method="post">
                <label for="contact_name">Your Name*</label>
                <input type="text" name="contact_name" id="contact_name" required>

                <label for="contact_email">Email Address*</label>
                <input type="email" name="contact_email" id="contact_email" required>

                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" placeholder="(optional)">

                <label for="message">Message*</label>
                <textarea name="message" id="message" required></textarea>

                <button type="submit" name="submit">Send</button>
            </form>
        </div>
    </section>
</body>
</html>
<?php include("footer.php"); ?>
