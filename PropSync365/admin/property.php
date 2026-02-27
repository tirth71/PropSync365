<?php
include('header.php');
include('../config.php');

/* load mail function */
require_once __DIR__ . '/../mail_property.php';


/* ---------------- DELETE PROPERTY ---------------- */
if (isset($_GET['did'])) {
    $id = $_GET['did'];
    mysqli_query($con, "DELETE FROM tbl_property WHERE property_id=$id");
    echo "<script>alert('Property Deleted');window.location='property.php';</script>";
}


/* ---------------- APPROVE PROPERTY ---------------- */
if (isset($_GET['approve'])) {
    $id = $_GET['approve'];

    /* get owner info */
    $q = mysqli_query($con, "
    SELECT tbl_property.property_name,tbl_user.user_name,tbl_user.user_email
    FROM tbl_property
    JOIN tbl_user ON tbl_property.user_id=tbl_user.user_id
    WHERE property_id=$id
    ");
    $data = mysqli_fetch_assoc($q);

    /* update status */
    mysqli_query($con, "UPDATE tbl_property SET approval_status=1 WHERE property_id=$id");

    /* email */
    $subject = "Your Property Approved - PropSync365";

    $message = "
    <h2>Hello {$data['user_name']},</h2>
    <p>Great News 🎉</p>
    <p>Your property <b>{$data['property_name']}</b> has been 
    <b style='color:green;'>APPROVED</b> by our admin team.</p>
    <p>Your listing is now LIVE on the website.</p>
    <br>
    Thank you for using <b>PropSync365</b>.
    <br><br>
    <b>PropSync365 Team</b>
    ";

    sendPropertyStatusMail($data['user_email'], $data['user_name'], $subject, $message);

    echo "<script>alert('Property Approved & Email Sent');window.location='property.php';</script>";
}


/* ---------------- REJECT PROPERTY ---------------- */
if (isset($_GET['reject'])) {
    $id = $_GET['reject'];

    $q = mysqli_query($con, "
    SELECT tbl_property.property_name,tbl_user.user_name,tbl_user.user_email
    FROM tbl_property
    JOIN tbl_user ON tbl_property.user_id=tbl_user.user_id
    WHERE property_id=$id
    ");
    $data = mysqli_fetch_assoc($q);

    mysqli_query($con, "UPDATE tbl_property SET approval_status=2 WHERE property_id=$id");

    $subject = "Property Rejected - PropSync365";

    $message = "
    <h2>Hello {$data['user_name']},</h2>
    <p>Your property <b>{$data['property_name']}</b> has been 
    <b style='color:red;'>REJECTED</b>.</p>
    <p>Reason: Invalid details.</p>
    <p>Please edit and submit again.</p>
    <br>
    <b>PropSync365 Support Team</b>
    ";

    sendPropertyStatusMail($data['user_email'], $data['user_name'], $subject, $message);

    echo "<script>alert('Property Rejected & Email Sent');window.location='property.php';</script>";
}


/* ---------------- FETCH ALL PROPERTIES ---------------- */
$propertyData = mysqli_query($con, "SELECT * FROM tbl_property ORDER BY property_id DESC");
?>


<div class="content-wrapper">

    <section class="content">
        <div class="card">
            <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Owner</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Rent/Sale</th>
                            <th>Property Document</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $no = 0;
                        while ($row = mysqli_fetch_assoc($propertyData)) {
                            $no++;
                        ?>

                            <tr>

                                <td><?php echo $no; ?></td>
                                <td><?php echo $row['property_name']; ?></td>

                                <?php
                                $u = mysqli_query($con, "SELECT user_name FROM tbl_user WHERE user_id='{$row['user_id']}'");
                                $user = mysqli_fetch_assoc($u);
                                ?>
                                <td><?php echo $user['user_name']; ?></td>

                                <td><?php echo $row['property_type']; ?></td>
                                <td>₹<?php echo number_format($row['property_price']); ?></td>

                                <td>
                                    <?php echo ($row['property_status'] == 0) ? "Rent" : "Sale"; ?>
                                </td>


                                <td>
                                    <?php
                                    if ($row['property_document'] != "") {
                                        echo "<a href='../property_docs/" . $row['property_document'] . "' target='_blank' class='btn btn-info btn-sm'>View Proof</a>";
                                    } else {
                                        echo "<span style='color:red;'>No Document</span>";
                                    }
                                    ?>
                                </td>


                                <!-- STATUS -->
                                <td>
                                    <?php
                                    if ($row['approval_status'] == 0)
                                        echo "<span style='color:orange;font-weight:bold;'>Pending</span>";
                                    elseif ($row['approval_status'] == 1)
                                        echo "<span style='color:green;font-weight:bold;'>Approved</span>";
                                    else
                                        echo "<span style='color:red;font-weight:bold;'>Rejected</span>";
                                    ?>
                                </td>



                                <!-- ACTION -->
                                <td>
                                    <?php if ($row['approval_status'] == 0) { ?>
                                        <a href="property.php?approve=<?php echo $row['property_id']; ?>" class="btn btn-success btn-sm">Approve</a>
                                        <a href="property.php?reject=<?php echo $row['property_id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                                    <?php } else {
                                        echo "-";
                                    } ?>
                                </td>

                                <!-- DELETE -->
                                <td>
                                    <a onclick="return confirm('Delete this property?');"
                                        href="property.php?did=<?php echo $row['property_id']; ?>"
                                        class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>
                </table>

            </div>
        </div>
    </section>
</div>

<?php include('footer.php'); ?>