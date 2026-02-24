<?php 
// background: #e94646;
include("config.php");
 if (isset($_REQUEST['submit'])) 
    {  
        $name=$_REQUEST['contact_name'];
        $email=$_REQUEST['contact_email'];
        $phone=$_REQUEST['phone_number'];
        $message=$_REQUEST['message'];
        $date = date('Y-m-d H:i:s');

        $sql="select * from tbl_contact where contact_email='$email'";
        $result=mysqli_query($con,$sql) or die('query error');
        $cnt_row = mysqli_num_rows($result);

        if($cnt_row==false){
           $sql="INSERT INTO tbl_contact (contact_name,contact_email,contact_phone,contact_message,contact_date) VALUES ('$name','$email','$phone','$message','$date')";
            $result=mysqli_query($con,$sql);
       
            $result_cnt=mysqli_affected_rows($con);
            
            if($result_cnt>0){
                echo "<script>alert('Thank you For Contact Us..!!');window.location.href = 'page-contact.php';</script>";
            } 
        }else{
                echo "<script>alert('Your Email Already Registered..!!');window.location.href = 'page-contact.php';</script>";
        }
    }
    include("header.php");   
?>
<style>
       
    .contact2 {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 30px 8%;
    gap: 40px;
}

/* Make contact info box larger (60%) and form box smaller (40%) */
.contact-info2 {
    flex: 1 1 60%;
    /* background-color: rgba(255, 255, 255, 0.05); */
    background-color: white;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
    width: 540px;
}

.contact-form2 {
    flex: 1 1 35%;
    /* background-color: rgba(255, 255, 255, 0.05);*/
    background-color: white;
    padding: 30px 25px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
}

/* Contact Heading */
.contact2 .heading {
    width: 100%;
    text-align: center;
    /* margin-bottom:10px; */
}

.contact2 .heading h1 {
    font-size: 42px;
    font-weight: bold;
    color: #ffffff;
}

/* Contact Info Section */
.contact-info2 .info2 {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 30px;
}

.contact-info2 .icon img {
    width: 32px;
    /* filter: invert(1); */
}

.contact-info2 h3 {
    color: #8a6dff;
    margin: 0 0 5px;
    font-size: 18px;
    font-weight: 600;
}

.contact-info2 p {
    margin: 0;
    line-height: 1.6;
    font-size: 15px;
    color:black;
    /* color: #e0e0e0; */
}

/* Form Styles */
.contact-form2 h2 {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 25px;
    color:black;

}

.contact-form2 form {
    display: flex;
    flex-direction: column;
}

.contact-form2 label {
    font-size: 14px;
    /* color: #ccc; */
    color:black;

    margin-bottom: 5px;
}

.contact-form2 input,
.contact-form2 textarea {
    background: transparent;
    border: none;
    border-bottom: 2px solid #ccc;
    margin-bottom: 20px;
    padding: 10px;
    font-size: 15px;
    color:black;

    /* color: #fff; */
    outline: none;
    transition: border-color 0.3s ease;
}

.contact-form2 input:focus,
.contact-form2 textarea:focus {
    border-color: #8a6dff;
}

.contact-form2 textarea {
    resize: none;
    height: 100px;
}

.contact-form2 button {
    background-color: #8a6dff;
    color: #fff;
    padding: 12px;
    font-weight: bold;
    font-size: 15px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.contact-form2 button:hover {
    background-color: #5848dd;
}

/* Responsive adjustments */
@media screen and (max-width: 768px) {
    .contact2 {
        flex-direction: column;
        padding: 40px 5%;
    }

    .contact-info2,
    .contact-form2 {
        flex: 1 1 100%;
    }
}
.heading p{
    color:white;
}
    </style>
      
        <!-- #page-title end -->

        <!-- Contact #1
============================================= -->
            <div class="bg-section">
                    <img src="assets/images/slider/slide-bg/dark_back.png" alt="Background" />
                </div>
                <section id="contact" class="contact2" >
            <div class="heading">
                <h5>Contact Us</h5>
                <p>"365 days of property solutions — welcome to the future of real estate."</p>
            </div>
            <div style="padding-bottom:70px;">
            <div class="contact-info2">
            <div class="info2">
                <div class="icon"><img src="https://img.icons8.com/ios-filled/50/marker.png"/></div>
                <div>
                    <h3 id="h3">Address</h3>
                    <p>B-13, Property365<br>Silver Hub, Adajan,<br>Surat</p>
                </div>
            </div>
            <div class="info2">
                <div class="icon"><img src="https://img.icons8.com/ios-filled/50/phone.png"/></div>
                <div>
                    <h3 id="h3">Phone</h3>
                    <p>+91 96645-45456</p>
                </div>
            </div>
            <div class="info2">
                <div class="icon"><img src="https://img.icons8.com/ios-filled/50/email.png"/></div>
                <div>
                    <h3 id="h3">Email</h3>
                    <p>property365offical@gmail.com</p>
                </div>
            </div>
        </div>
            </div> 
        
        
            <div class="contact-form2">
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
        <!-- #contact2  end -->

        <!-- cta #1
============================================= -->
       
        <!-- #cta1 end -->


        <!-- Footer #1
============================================= -->
        <?php include("footer.php"); ?>
    </div>
    <!-- #wrapper end -->

    <!-- Footer Scripts
============================================= -->
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="https://maps.google.com/maps/api/js?sensor=true&amp;key=AIzaSyCiRALrXFl5vovX0hAkccXXBFh7zP8AOW8"></script>
    <script src="assets/js/plugins/jquery.gmap.min.js"></script>
    <script>
        $('#googleMap').gMap({
            address: "121 King St,Melbourne, India",
            zoom: 12,
            maptype: 'ROADMAP',
            markers: [{
                address: "Melbourne, India",
                maptype: 'ROADMAP',
                icon: {
                    image: "assets/images/gmap/marker1.png",
                    iconsize: [52, 75],
                    iconanchor: [52, 75]
                }
            }]
        });

    </script>
    <script src="assets/js/map-custom.js"></script>
</body>

