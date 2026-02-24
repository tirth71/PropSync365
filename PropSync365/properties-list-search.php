<?php

include ("config.php");
$start = 0;
$limit = 3;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $start = ($id - 1) * $limit;
} else {
    $id = 1;
}

$city = $_GET['select_location'];
$type = $_GET['select_type'];
$status1 = $_GET['select_status'];

if ($status1 == "Rent") {
    $status = 0;
} else {
    $status = 1;
}

$query = "SELECT * From tbl_property where property_type = '$type' AND property_status = '$status' AND property_city = '$city' AND `live_status` IN (1,3)";


$query_l = " LIMIT " . $start . ", " . $limit;

$row = mysqli_query($con, $query . $query_l);

$row1 = mysqli_query($con, $query);

$count = mysqli_num_rows($row1);

$total = ceil($count / $limit);

include ("header.php");
?>

<!-- #map end -->

<!-- properties-list
============================================= -->
<section id="properties-list" style="padding-top: 0px;
padding-bottom: 0px;">
    <div style="padding-top: 120px; padding-bottom: 70px;">
        <!-- <div class="bg-section">
            <img src="assets/images/slider/slide-bg/new-hero-image.jpg" alt="Background" />
        </div> -->
        <div class="bg-section">
                <img src="assets/images/slider/slide-bg/dark_back.png" alt="Background" />
            </div>
        <div class="page-title bg-overlay bg-overlay-dark2">
            <div class="container">
                <div class="result">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <!-- widget property type
=============================-->
                        <div class="widget widget-property">
                            <div class="widget--title">
                                <h5>Property Type</h5>
                            </div>
                            <div class="widget--content">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <?php
                                        $sql = "SELECT * FROM tbl_property WHERE property_type='Bungalow'";
                                        $res = mysqli_query($con, $sql);
                                        $b_count = mysqli_num_rows($res);
                                        ?>
                                        <a href="properties-list.php?name=<?php echo "Bungalow"; ?>">Bungalow
                                            <span>(<?php echo ($b_count); ?>)</span></a>
                                    </li>
                                    <li>
                                        <?php
                                        $sql = "SELECT * FROM tbl_property WHERE property_type='Row-house'";
                                        $res = mysqli_query($con, $sql);
                                        $r_count = mysqli_num_rows($res);
                                        ?>
                                        <a href="properties-list.php?name=<?php echo "Row-house"; ?>">Row-house
                                            <span>(<?php echo ($r_count); ?>)</span></a>
                                    </li>
                                    <li>
                                        <?php
                                        $sql = "SELECT * FROM tbl_property WHERE property_type='Flat'";
                                        $res = mysqli_query($con, $sql);
                                        $f_count = mysqli_num_rows($res);
                                        ?>
                                        <a href="properties-list.php?name=<?php echo "Flat"; ?>">Flat
                                            <span>(<?php echo ($f_count); ?>)</span></a>
                                    </li>
                                    <li>
                                        <?php
                                        $sql = "SELECT * FROM tbl_property WHERE property_type='Farm-house'";
                                        $res = mysqli_query($con, $sql);
                                        $l_count = mysqli_num_rows($res);
                                        ?>
                                        <a href="properties-list.php?name=<?php echo "Farm-house"; ?>">Farm-house
                                            <span>(<?php echo ($l_count); ?>)</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- . widget property type end -->

                        <!-- widget property status
=============================-->
                        <div class="widget widget-property">
                            <div class="widget--title">
                                <h5>Property Status</h5>
                            </div>
                            <div class="widget--content">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <?php
                                        $sql = "SELECT * FROM tbl_property WHERE property_status=0";
                                        $res = mysqli_query($con, $sql);
                                        $r_count = mysqli_num_rows($res);
                                        ?>
                                        <a href="properties-list.php?status=<?php echo "0"; ?>">For Rent
                                            <span>(<?php echo ($r_count); ?>)</span></a>
                                    </li>
                                    <li><?php

                                    $sql = "SELECT * FROM tbl_property WHERE property_status=1";
                                    $res = mysqli_query($con, $sql);
                                    $s_count = mysqli_num_rows($res);
                                    ?>
                                        <a href="properties-list.php?status=<?php echo "1"; ?>">For Sale
                                            <span>(<?php echo ($s_count); ?>)</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- . widget property status end -->


                        <!-- widget property city
=============================--> <!-- widget featured property
========================-->

                        <!-- . widget featured property end -->
                    </div>
                    <!-- .col-md-4 end -->
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <div class="result mb-2">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <!--  <div class="properties-filter clearfix">
                               <div class="select--box pull-left">
                                        <label>Sort by:</label>
                                        <i class="fa fa-angle-up"></i>
                                        <i class="fa fa-angle-down"></i>
                                        <select>
                                <option selected="" value="Default">Default Sorting</option>
                                <option value="Larger">Newest Items</option>
                                <option value="Larger">oldest Items</option>
                                <option value="Larger">Hot Items</option>
                                <option value="Small">Highest Price</option>
                                <option value="Medium">Lowest Price</option>
                            </select>
                                    </div> -->
                                <!-- .select-box -->
                                <div class="view--type pull-right">
                                    <a id="switch-list" href="#" class="active"><i class="fa fa-th-list"></i></a>
                                    <a id="switch-grid" href="#" class=""><i class="fa fa-th-large grid-card-btn"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="properties properties-list">
                            <!-- .col-md-12 end -->
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <?php
                                function moneyFormatIndia($num)
                                {
                                    $explrestunits = "";
                                    if (strlen($num) > 3) {
                                        $lastthree = substr($num, strlen($num) - 3, strlen($num));
                                        $restunits = substr($num, 0, strlen($num) - 3); // extracts the last three digits
                                        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
                                        $expunit = str_split($restunits, 2);
                                        for ($i = 0; $i < sizeof($expunit); $i++) {
                                            // creates each of the 2's group and adds a comma to the end
                                            if ($i == 0) {
                                                $explrestunits .= (int) $expunit[$i] . ","; // if is first value , convert into integer
                                            } else {
                                                $explrestunits .= $expunit[$i] . ",";
                                            }
                                        }
                                        $thecash = $explrestunits . $lastthree;
                                    } else {
                                        $thecash = $num;
                                    }
                                    return $thecash; // writes the final format where $currency is the currency symbol.
                                }
                                ?>
                                <?php

                                while ($result = mysqli_fetch_assoc($row)) { ?>
                                    <!-- .property-item #1 -->
                                    <div class="property-item">
                                        <div class="property--img">
                                            <a href="property-single-gallery.php?id=<?php echo $result['property_id']; ?>">
                                                <?php $str = $result['property_image'];
                                                $temp = explode(',', $result['property_image']);
                                                ?>
                                                <img src="http://localhost/PropSync365/img_upload/<?php echo $temp[0]; ?>" alt="property image"
                                                    class="img-responsive" style="max-width: 102%;">
                                            </a>
                                            <?php $q = $result['property_status'];
                                            if ($q == 0) {
                                                $status = "Rent";
                                            } else {
                                                $status = "Sale";
                                            }
                                            ?>
                                            <span class="property--status">For <?php echo $status; ?></span>
                                        </div>
                                        <div class="property--content">
                                            <div class="property--info">
                                                <h5 class="property--title"><a
                                                        href="property-single-gallery.html"><?php echo $result['property_type']; ?>
                                                        in
                                                        <?php echo $result['property_city']; ?>,<?php echo $result['property_state']; ?>
                                                    </a></h5>
                                                <p class="property--location"> <img src="assets/images/favicon/location-address.png" alt=""> <span styl="color: black;"><?php echo $result['property_address']; ?> </span> </p>
                                                <p class="property--price">Rs. <?php
                                                echo moneyFormatIndia($result['property_price']); ?></p>
                                            </div>
                                            <!-- .property-info end -->
                                            <div class="property--features">
                                                <ul class="list-unstyled mb-1">
                                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/bad.png" alt=""></span><span
                                                            class="feature-num"><?php echo $result['property_totalbeds']; ?> bes</span>
                                                    </li>
                                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/bath.png" alt=""></span><span
                                                            class="feature-num"><?php echo $result['property_totalbaths']; ?> baths</span>
                                                    </li>
                                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/squre.png" alt=""></span><span
                                                            class="feature-num"><?php echo $result['property_sqfeet']; ?> sq
                                                            </span></li>
                                                 
                                                </ul>
                                                <div  class="buy-view-card-btn">
                                                <?php if ($result['property_status'] == 1) { ?>
                                                        <li class="m-0"><a
                                                                href="buy-property.php?id=<?php echo $result['property_id']; ?>"><input
                                                                    type="button" name="buy" value="Buy"
                                                                    style="color: #ffffff;border: 2px solid transparent;"></a>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li class="m-0"><a
                                                                href="check-availability.php?id=<?php echo $result['property_id']; ?>"><input
                                                                    type="button" name="rent" value="Rent"
                                                                    style="color: #ffffff;border: 2px solid transparent;"></a>
                                                        </li>
                                                    <?php } ?>
                                                    <li class="view-btn">
                                                            <a href="property-single-gallery.php?id=<?php echo $result['property_id']; ?>">view</a>
                                                        </li>
                                                </div>
                                            </div>
                                            <!-- .property-features end -->
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </div>
                            <!-- .property item end -->
                        </div>

                        <?php
// Build the base URL with existing parameters
$base_url = strtok($_SERVER["REQUEST_URI"], '?');
$base_url .= isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] . '&' : '?';
?>

<div class="col-xs-12 col-sm-12 col-md-12 text-center mt-50">
    <ul class="pagination">
        <?php
        if ($id > 1) {
            echo '<li><a href="' . $base_url . 'id=' . ($id - 1) . '" aria-label="prev"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>';
        }
        for ($i = 1; $i <= $total; $i++) {
            if ($i == $id) {
                echo '<li class="active"><a href="' . $base_url . 'id=' . $i . '">' . $i . '</a></li>';
            } else {
                echo '<li><a href="' . $base_url . 'id=' . $i . '">' . $i . '</a></li>';
            }
        }
        if ($id != $total) {
            echo '<li><a href="' . $base_url . 'id=' . ($id + 1) . '" aria-label="Next"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a></li>';
        }
        ?>
    </ul>
</div>
                        <!-- .col-md-12 end -->
                    </div>
                    <!-- .result -->
                </div>
                <!-- .col-md-8 end -->
            </div>
            <!-- .result -->
        </div>
        <!-- .container -->
    </div>
    </div>
</section>
<!-- #properties-list  end  -->

<!-- cta #1
============================================= -->

<!-- #cta1 end -->

<!-- Footer #1
============================================= -->
<?php include ("footer.php"); ?>
</div>
<!-- #wrapper end -->

<!-- Footer Scripts
============================================= -->
<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/functions.js"></script>
<script src="https://maps.google.com/maps/api/js?sensor=true&amp;key=AIzaSyCiRALrXFl5vovX0hAkccXXBFh7zP8AOW8"></script>
<script src="assets/js/plugins/jquery.gmap.min.js"></script>
<script src="assets/js/map-addresses.js"></script>
<script src="assets/js/map-custom.js"></script>
</body>

</html>