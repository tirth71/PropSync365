<?php
header("Location: admin/index.php");
exit();

<!DOCTYPE html>
<html>

<head>
    <style>
        #chatbot-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #6665ee;
            color: white;
            padding: 15px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            z-index: 9999;
        }

        #chatbot-box {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 380px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            overflow: hidden;
        }

        .chat-header {
            background: #6665ee;
            color: white;
            padding: 12px;
            font-weight: bold;
        }

        #chat-content {
            height: 350px;
            overflow-y: auto;
            padding: 12px;
            font-size: 14px;
        }

        .chat-input {
            display: flex;
            border-top: 1px solid #ddd;
        }

        .chat-input input {
            flex: 1;
            border: none;
            padding: 10px;
            outline: none;
        }

        .chat-input button {
            background: #6665ee;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
    </style>


</head>

<body>
    <!-- 
<div id="loader">
        <div class="loader"></div>
    </div> -->
    <!-- <div id="loader">
    PROPERTY<span id="counter">1</span>
</div> -->


    <?php
    include("config.php");

    $err = "";
    if (isset($_GET['submit'])) {
        // Retrieve form data
        $location = $_GET['select_location'];
        $type = $_GET['select_type'];
        $status = $_GET['select_status'];

        // Check if all fields are selected
        if (!empty($location) && !empty($type) && !empty($status)) {
            // Construct the SQL query
            $query = "SELECT * FROM tbl_property WHERE property_city = '$location' AND property_type = '$type' AND property_status = '$status'";

            // Execute the query
            $result = mysqli_query($con, $query);

            // Check if any properties match the search criteria
            if (mysqli_num_rows($result) > 0) {
                // Display the properties
                while ($row = mysqli_fetch_assoc($result)) {
                    // Display property details
                    echo "Property ID: " . $row['property_id'] . "<br>";
                    echo "Property Type: " . $row['property_type'] . "<br>";
                    echo "Property City: " . $row['property_city'] . "<br>";
                    // Add more details as needed
                    echo "<hr>";
                }
            } else {
                // No properties found
                echo "No properties found matching the search criteria.";
            }
        } else {
            // Error message if all fields are not selected
            $err = "Please select all fields";
        }
    }
    include("header.php"); ?>
    <section id="heroSearch" class="hero-search mtop-100 pt-0 pb-0 hero-seaction-main">
        <div class="container">
            <h4>Find your Perfect place with PropSync<span style="color:#6665ee">365</span> </h4>
            <p>"Discover premium properties in top locations with expert guidance every step of the way."</p>
        </div>
        <div>

        </div>

        </div>
    </section>

    <section class="search-property-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="slider--content">
                        <div class="text-center">
                            <h1 class="find-property-heding">Find Your Favorite Property</h1>
                        </div>
                        <form class="mb-0" method="GET" action="properties-list-search.php">
                            <div class="form-box search-properties">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="select_location" id="select_location" class="form-control" placeholder="Enter location">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <div class="select--box">
                                                <i class="fa fa-angle-down"></i>
                                                <select name="select_type" id="select_type">
                                                    <option value="">Select Type</option>
                                                    <option>Bungalow</option>
                                                    <option>Flat</option>
                                                    <option>Row-house</option>
                                                    <option>Farm</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <div class="select--box">
                                                <i class="fa fa-angle-down"></i>
                                                <select name="select_status" id="select_status">
                                                    <option value="">Select Status</option>
                                                    <option>Rent</option>
                                                    <option>Sale</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <input type="submit" value="Search" name="submit" class="btn btn--primary btn--block search-btn-property">
                                    </div>
                                    <label>
                                        <?php echo @$err; ?>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-it-work-section">
        <div class="container">
            <div class="new-headings">
                <h4>How it works</h4>
                <p>Follow these 3 steps to book your place</p>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="work-card">
                        <img src="assets/images/favicon/location.png" alt="">
                        <h5>01.Search for Location</h5>
                        <p>Get paid by your listeners, every month, predictably. No CPMs, and no scheduling required.
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="work-card">
                        <img src="assets/images/favicon/home.png" alt="">
                        <h5>02.Select Property Type</h5>
                        <p>Get paid by your listeners, every month, predictably. No CPMs, and no scheduling required.
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="work-card">
                        <img src="assets/images/favicon/meet.png" alt="">
                        <h5>03.Book your Property</h5>
                        <p>Get paid by your listeners, every month, predictably. No CPMs, and no scheduling required.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="counters-section">
        <div class="container">
            <div class="new-headings country-heading">
                <h4>We are Available in many Well-Known Countries</h4>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="counry-card position-relative">
                        <span>INDIA</span>
                        <img src="assets/images/favicon/india.png" alt="india">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counry-card position-relative">
                        <span>USA</span>
                        <img src="assets/images/favicon/usa.png" alt="india">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counry-card position-relative">
                        <span>UNITED KINGDOM</span>
                        <img src="assets/images/favicon/uk.png" alt="india">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counry-card position-relative">
                        <span>CANADA</span>
                        <img src="assets/images/favicon/canada.png" alt="india">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counry-card position-relative">
                        <span>AUSTRALIA </span>
                        <img src="assets/images/favicon/aus.png" alt="india">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counry-card position-relative">
                        <span>GERMANY</span>
                        <img src="assets/images/favicon/ger.png" alt="india">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counry-card position-relative">
                        <span>SWITZERLAND</span>
                        <img src="assets/images/favicon/swi.png" alt="india">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counry-card position-relative">
                        <span>FRANCE</span>
                        <img src="assets/images/favicon/france.png" alt="india">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (@$_SESSION['email'] == "" || @$_SESSION['user_type'] == 0) {
        // if($result['property_status'] == 1){
    ?>
        <section id="properties-carousel" class="properties-carousel  property-carosal-home">
            <div class="page-title bg-overlay">

                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="heading heading-2 text-center">
                                <h2 class="heading--title" style="color: black;">Latest Properties</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 20px; padding-top: 0px;">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="carousel carousel-dots" data-slide="3" data-slide-rs="2" data-nav="false" data-dots="true" data-space="25" data-loop="true" data-speed="800">
                                <?php
                                $q = "SELECT * FROM tbl_property WHERE `live_status`IN (1,3)";
                                $row = mysqli_query($con, $q);
                                while ($result = mysqli_fetch_assoc($row)) { ?>
                                    <div class="property-item index-property-slider">
                                        <div class="property--img">
                                            <a href="property-single-gallery.php?id=<?php echo $result['property_id']; ?>">
                                                <?php $str = $result['property_image'];
                                                $temp = explode(',', $result['property_image']);
                                                ?>
                                                <img src="http://localhost:8081/PropSync365/img_upload/<?php echo $temp[0]; ?>" alt="property image" class="img-responsive" height="240" width="363">
                                                <?php $q = $result['property_status'];
                                                if ($q == 0) {
                                                    $status = "Rent";
                                                ?>
                                                    <span class="property--status1">For
                                                        <?php echo $status; ?>
                                                    </span>
                                                <?php } else {
                                                    $status = "Sale";
                                                ?>
                                                    <span class="property--status">For
                                                        <?php echo $status; ?>
                                                    </span>
                                                <?php }
                                                ?>
                                            </a>
                                        </div>
                                        <div class="property--content">
                                            <div class="property--info">
                                                <h5 class="property--title"><a href="property-single-gallery.php?id=<?php echo $result['property_id']; ?>">
                                                        <?php echo $result['property_type']; ?>
                                                        in
                                                        <?php echo $result['property_city']; ?>,
                                                        <?php echo $result['property_state']; ?>
                                                    </a>
                                                </h5>
                                                <p class="property--location"> <img src="assets/images/favicon/location-address.png" alt=""> <span>
                                                        <?php echo $result['property_address']; ?>
                                                    </span> </p>
                                                <?php if ($q == 0) { ?>
                                                    <p class="property--price">
                                                        Rs.
                                                        <?php
                                                        echo moneyFormatIndia($result['property_price']); ?>
                                                        <p1 style="color: #f33408; "> Deposite.
                                                            <?php
                                                            echo moneyFormatIndia($result['deposite']); ?>
                                                    </p>

                                                    </p>
                                                <?php } else { ?>
                                                    <p class="property--price">Rs.
                                                        <?php
                                                        echo moneyFormatIndia($result['property_price']); ?>
                                                    </p>
                                                <?php } ?>
                                            </div>
                                            <div class="property--features item-features">
                                                <ul class="list-unstyled">
                                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/bad.png" alt=""></span><span class="feature-num">
                                                            <?php echo $result['property_totalbeds']; ?> beds
                                                        </span>
                                                    </li>
                                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/bath.png" alt=""></span><span class="feature-num">
                                                            <?php echo $result['property_totalbaths']; ?> baths
                                                        </span>
                                                    </li>
                                                    <li class="m-0"><span class="feature"><img src="assets/images/favicon/squre.png" alt=""></span><span class="feature-num">
                                                            <?php echo $result['property_sqfeet']; ?> sq
                                                        </span></li>
                                                </ul>

                                                <div class="buy-view-card-btn">

                                                    <?php
                                                    // if(@$_SESSION['email']=="" || @$_SESSION['user_type']== 0){
                                                    if ($result['property_status'] == 1) { ?>
                                                        <li class="m-0"><a href="buy-property.php?id=<?php echo $result['property_id']; ?>"><input type="button" name="buy" value="Buy" style="color: #ffffff;border: 2px solid transparent;"></a>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li class="m-0"><a href="check-availability.php?id=<?php echo $result['property_id']; ?>"><input type="button" name="rent" value="Rent" style="color: #ffffff;border: 2px solid transparent;"></a>
                                                        </li>


                                                    <?php } ?>
                                                    <li class="view-btn">
                                                        <a href="property-single-gallery.php?id=<?php echo $result['property_id']; ?>">view</a>
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

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
    <!-- #properties-carousel  end  -->

    <?php include("footer.php"); ?>

    <div id="chatbot-icon" onclick="toggleChat()">
        💬
    </div>

    <div id="chatbot-box">
        <div class="chat-header">
            PropSync365 Assistant
            <span onclick="toggleChat()" style="float:right;cursor:pointer;">✖</span>
        </div>

        <div id="chat-content">
            <p><b>Bot:</b> Hi 👋 Welcome to PropSync365! How can I help you?</p>
        </div>

        <div class="chat-input">
            <input type="text" id="user-input" placeholder="Ask about rent, buy, location..." onkeypress="handleKey(event)">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <!-- ================= CHATBOT SCRIPT ================= -->

    <script>
        function toggleChat() {
            var box = document.getElementById("chatbot-box");
            box.style.display = box.style.display === "block" ? "none" : "block";
        }

        function handleKey(e) {
            if (e.key === "Enter") {
                sendMessage();
            }
        }

        function sendMessage() {
            let input = document.getElementById("user-input");
            let message = input.value.trim();

            if (message === "") return;

            let chat = document.getElementById("chat-content");

            chat.innerHTML += "<p><b>You:</b> " + message + "</p>";

            let response = getBotResponse(message.toLowerCase());

            setTimeout(() => {
                chat.innerHTML += "<p><b>Bot:</b> " + response + "</p>";
                chat.scrollTop = chat.scrollHeight;
            }, 500);

            input.value = "";
        }

        function getBotResponse(msg) {

            if (msg.includes("rent")) {
                return "You can search rental properties using the search filter above. Select status as 'Rent'.";
            }

            if (msg.includes("buy") || msg.includes("sale")) {
                return "To buy property, click on the Buy button in Latest Properties section.";
            }

            if (msg.includes("location") || msg.includes("city")) {
                return "Please enter your preferred city in the location search box.";
            }

            if (msg.includes("price") || msg.includes("cost")) {
                return "Property prices vary based on city and type. Please use search filters to check pricing.";
            }

            if (msg.includes("contact")) {
                return "You can contact us via the Contact page available in the header menu.";
            }

            if (msg.includes("hello") || msg.includes("hi")) {
                return "Hello 😊 How can I help you with properties today?";
            }

            return "Sorry, I didn't understand that. You can ask about Rent, Buy, Location, Price, or Contact.";
        }
    </script>

    <!-- Footer Scripts
============================================= -->
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/functions.js"></script>
    <script>

    </script>

    </script>

</body>

</php>

</html>