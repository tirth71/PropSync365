<?php
include('config.php');

// Get parameters from URL
$id = $_GET['id'];
$type = isset($_GET['type']) ? ucfirst($_GET['type']) : 'Unknown';
$payment_id = rand(1000,9999);

$q = "SELECT p.*, 
             u.user_name AS owner_name, 
             u.user_email AS owner_email, 
             u.user_mobile AS owner_phone 
      FROM tbl_property p
      LEFT JOIN tbl_user u ON p.user_id = u.user_id 
      WHERE p.property_id = $id AND u.user_type = 1";

$row = mysqli_query($con, $q);
$result = mysqli_fetch_assoc($row);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - Property <?php echo $type; ?></title>
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 20px;
        }

        .invoice-box {
            background: white;
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0,0,0,.15);
            color: #555;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        table td {
            padding: 8px;
            vertical-align: top;
        }

        table tr.heading td {
            background: #eee;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }

        .property-img {
            max-width: 200px;
            border-radius: 5px;
        }

        .section-title {
            margin-top: 20px;
            font-weight: bold;
            background: #f5f5f5;
            padding: 6px 10px;
            border: 1px solid #ddd;
        }

        .text-right {
            text-align: right;
        }

    </style>
</head>
<body>
<div class="invoice-box" id="invoice">
    <div class="title">Property  Invoice</div>

    <table>
        <tr>
            <td>
                <strong>Invoice Date:</strong> <?php echo date("Y-m-d H:i:s"); ?><br>
                <strong>Payment ID:</strong> <?php echo $payment_id; ?><br>
                <!-- <strong>Transaction Type:</strong> <?php echo $type; ?> -->
            </td>
            <td class="text-right">
                <strong>Invoice #</strong> <?php echo 'INV' . str_pad($result['property_id'], 5, '0', STR_PAD_LEFT); ?><br>
                <strong>Amount Paid:</strong> ₹<?php echo number_format($result['deposite']); ?>
            </td>
        </tr>
    </table>

    <div class="section-title">Property Details</div>
    <table>
        <tr>
            <td>
                <strong>Name:</strong> <?php echo $result['property_name']; ?><br>
                <strong>Type:</strong> <?php echo $result['property_type']; ?><br>
                <strong>Address:</strong> <?php echo $result['property_address']; ?>, <?php echo $result['property_city']; ?>, <?php echo $result['property_state']; ?><br>
                <strong>Area:</strong> <?php echo $result['property_sqfeet']; ?> sq.ft<br>
                <strong>Status:</strong> <?php echo ($result['property_status'] == 1) ? 'Sell' : 'Rent'; ?>
            </td>
            <td class="text-right">
                <img src="http://localhost/property365/img_upload/<?php echo $result['property_image']; ?>" class="property-img">
            </td>
        </tr>
    </table>

    <div class="section-title">Owner Details</div>
    <table>
        <tr>
            <td>
                <strong>Name:</strong> <?php echo $result['owner_name'] ?? 'N/A'; ?><br>
                <strong>Email:</strong> <?php echo $result['owner_email'] ?? 'N/A'; ?><br>
                <strong>Phone:</strong> <?php echo $result['owner_phone'] ?? 'N/A'; ?>
            </td>
        </tr>
    </table>

    <div class="section-title">Payment Summary</div>
    <table>
        <tr>
            <td><strong>Amount:</strong></td>
            <td>₹<?php echo number_format($result['property_price']); ?></td>
        </tr>
        <!-- <tr>
            <td><strong>Transaction Type:</strong></td>
            <td><?php echo $type; ?></td>
        </tr> -->
        <tr>
            <td><strong>Payment ID:</strong></td>
            <td><?php echo $payment_id; ?></td>
        </tr>
        <tr>
            <td><strong>Transaction Date:</strong></td>
            <td><?php echo date("Y-m-d H:i:s"); ?></td>
        </tr>
    </table>
</div>

<script>
    // Auto-download PDF after load
    window.onload = function () {
        const element = document.getElementById('invoice');
        html2pdf().from(element).save('Invoice_<?php echo $type; ?>_<?php echo $result["property_id"]; ?>.pdf');
    };
</script>
</body>
</html>
