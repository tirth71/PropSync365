<?php
include('config.php');

$id = $_GET['id'];
$type = isset($_GET['type']) ? ucfirst($_GET['type']) : 'Property';
$payment_id = rand(100000,999999);

/* ---------------- FETCH PROPERTY + OWNER ---------------- */
$q = "SELECT p.*, 
             u.user_name AS owner_name, 
             u.user_email AS owner_email, 
             u.user_mobile AS owner_phone 
      FROM tbl_property p
      LEFT JOIN tbl_user u ON p.user_id = u.user_id 
      WHERE p.property_id = $id";

$row = mysqli_query($con, $q);
$result = mysqli_fetch_assoc($row);

/* ---------------- PROPERTY IMAGE ---------------- */
/* ----------- PROPERTY IMAGE FIX ----------- */

// split images
$imgs = explode(',', $result['property_image']);

// remove spaces
$main_img = trim($imgs[0]);

// default image if empty
if($main_img == "" || !file_exists("img_upload/".$main_img)){
    $main_img = "noimage.png";
}
/* ---------------- BASE64 LOGO ---------------- */
$logo_path = "assets/images/logo.png";
$logo_base64 = "";
if(file_exists($logo_path)){
    $logo_type = pathinfo($logo_path, PATHINFO_EXTENSION);
    $logo_data = file_get_contents($logo_path);
    $logo_base64 = 'data:image/' . $logo_type . ';base64,' . base64_encode($logo_data);
}

/* ---------------- BASE64 PROPERTY IMAGE ---------------- */
/* ----------- BASE64 PROPERTY IMAGE ----------- */

$property_base64 = "";

$img_path = __DIR__ . "/img_upload/" . $main_img;

if(file_exists($img_path)){

    $image_info = getimagesize($img_path);
    $mime = $image_info['mime'];

    $img_data = file_get_contents($img_path);

    $property_base64 = 'data:' . $mime . ';base64,' . base64_encode($img_data);
}
/* ---------------- AMOUNT CALCULATION ---------------- */
// 0 = Rent  |  1 = Sale
if($result['property_status'] == 0){
    // Rent property → Rent + Deposit
    $amount_paid = $result['property_price'] + $result['deposite'];
}else{
    // Sale property → Only token/deposit
    $amount_paid = $result['deposite'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PropSync365 Invoice</title>

<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

<style>
body{
    background:#eceff3;
    font-family:'Segoe UI', Arial, sans-serif;
}

.invoice-box{
    max-width:900px;
    margin:auto;
    background:#fff;
    padding:35px;
    border-radius:8px;
    box-shadow:0 0 15px rgba(0,0,0,0.15);
}

.invoice-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:3px solid #6c63ff;
    padding-bottom:15px;
    margin-bottom:25px;
}

.company-details{
    display:flex;
    align-items:center;
    gap:12px;
}

.logo{
    width:85px;
}

.company-name{
    font-size:26px;
    font-weight:700;
    color:#6c63ff;
}

.invoice-title{
    font-size:24px;
    font-weight:bold;
}

.section-title{
    font-weight:bold;
    background:#f3f4f8;
    padding:8px 12px;
    border-left:4px solid #6c63ff;
    margin-top:25px;
    margin-bottom:10px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#6c63ff;
    color:white;
    padding:10px;
    text-align:left;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
}

.property-img{
    width:180px;
    border:1px solid #ccc;
    border-radius:6px;
}

.total-box{
    margin-top:20px;
    width:320px;
    float:right;
    border:1px solid #ddd;
}

.total-box td{
    padding:12px;
}

.grand-total{
    font-size:20px;
    font-weight:bold;
    color:#6c63ff;
}

.footer-note{
    margin-top:70px;
    font-size:13px;
    color:#777;
    border-top:1px dashed #ccc;
    padding-top:15px;
}
</style>
</head>

<body>

<div class="invoice-box" id="invoice">

    <!-- HEADER -->
    <div class="invoice-header">

        <div class="company-details">
            <img src="<?php echo $logo_base64; ?>" class="logo">

            <div>
                <div class="company-name">PropSync365</div>
                <div>Real Estate Management System</div>
                <div>Email: support@propsync365.com</div>
                <div>Phone: +91 98765 43210</div>
            </div>
        </div>

        <div style="text-align:right;">
            <div class="invoice-title">INVOICE</div>
            <strong>Invoice #:</strong> <?php echo 'INV'.str_pad($result['property_id'],5,'0',STR_PAD_LEFT); ?><br>
            <strong>Date:</strong> <?php echo date("d M Y"); ?><br>
            <strong>Payment ID:</strong> <?php echo $payment_id; ?>
        </div>

    </div>

    <!-- PROPERTY INFO -->
    <div class="section-title">Property Information</div>

    <table>
        <tr>
            <td width="65%">
                <b>Name:</b> <?php echo $result['property_name']; ?><br>
                <b>Type:</b> <?php echo $result['property_type']; ?><br>
                <b>Address:</b> <?php echo $result['property_address']; ?><br>
                <?php echo $result['property_city']; ?>, <?php echo $result['property_state']; ?><br>
                <b>Area:</b> <?php echo $result['property_sqfeet']; ?> sq.ft<br>
                <b>Status:</b> <?php echo ($result['property_status']==1)?'Sale':'Rent'; ?>
            </td>

            <td align="right">
                <?php if($property_base64!=""){ ?>
                    <img src="<?php echo $property_base64; ?>" class="property-img">
                <?php } ?>
            </td>
        </tr>
    </table>

    <!-- OWNER -->
    <div class="section-title">Owner Details</div>

    <table>
        <tr>
            <td>
                <b>Name:</b> <?php echo $result['owner_name']; ?><br>
                <b>Email:</b> <?php echo $result['owner_email']; ?><br>
                <b>Mobile:</b> <?php echo $result['owner_phone']; ?>
            </td>
        </tr>
    </table>

    <!-- PAYMENT -->
    <div class="section-title">Payment Details</div>

    <table>
        <tr>
            <th>Description</th>
            <th width="180">Amount (₹)</th>
        </tr>

        <tr>
            <td>Monthly Rent / Property Price</td>
            <td>₹<?php echo number_format($result['property_price']); ?></td>
        </tr>

        <tr>
            <td>Security Deposit</td>
            <td>₹<?php echo number_format($result['deposite']); ?></td>
        </tr>
    </table>

    <table class="total-box">
        <tr>
            <td><b>Total Amount Paid</b></td>
            <td class="grand-total">₹<?php echo number_format($amount_paid); ?></td>
        </tr>
    </table>

    <div style="clear:both;"></div>

    <div class="footer-note">
        This is a computer-generated invoice and does not require a signature.<br>
        Thank you for choosing <b>PropSync365</b>.<br>
        For support contact: support@propsync365.com
    </div>

</div>

<script>
window.onload = function () {
    const element = document.getElementById('invoice');
    html2pdf().from(element).save('PropSync365_Invoice_<?php echo $result["property_id"]; ?>.pdf');
};
</script>

</body>
</html>