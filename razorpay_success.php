<?php
include("config.php");
session_start();

if (isset($_POST['razorpay_payment_id'])) {
    $payment_id = $_POST['razorpay_payment_id'];
    $first_name = ucfirst(trim($_POST['first_name']));
    $last_name = ucfirst(trim($_POST['last_name']));
    $property_id = $_POST['property_id'];
    $amount = $_POST['amount'];
    $starting_date = date("Y-m-d", strtotime($_POST['starting_date']));
    $ending_date = date("Y-m-d", strtotime($_POST['ending_date']));

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $qry = "SELECT * FROM tbl_user WHERE user_email = '$email' AND user_type = 0";
        $res = mysqli_query($con, $qry);
        $user = mysqli_fetch_assoc($res);
        $user_id = $user['user_id'];

        $created_at = date("Y-m-d H:i:s");

        // Insert payment details
        $sql = "INSERT INTO tbl_payment (transaction_id, first_name, last_name, amount, user_id, property_id, created_at)
                VALUES ('$payment_id', '$first_name', '$last_name', '$amount', '$user_id', '$property_id', '$created_at')";
        mysqli_query($con, $sql);

        // Update property status to 'rented' (3)
        $sql2 = "UPDATE tbl_property SET live_status = 3, buyer_id = '$user_id' WHERE property_id = '$property_id'";
        mysqli_query($con, $sql2);

        // Insert rent details
        $sql3 = "INSERT INTO tbl_rent (starting_date, ending_date, property_id, user_name, user_id)
                 VALUES ('$starting_date', '$ending_date', '$property_id', '$first_name', '$user_id')";
        mysqli_query($con, $sql3);

        echo "success";
    } else {
        echo "session_expired";
    }
} else {
    echo "no_payment_id";
}
?>
