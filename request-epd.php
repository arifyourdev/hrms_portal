<?php
require_once "admin/private/initialize.php";
$msg = "";
// $mail_t = EmailtemplateMaster::find_by_mailtemplate_id(101);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
 
if (isset($_POST['submit'])) {

    $name = htmlentities(trim($_POST['name']));
    $email = htmlentities(trim($_POST['email']));
    $contact = htmlentities(trim($_POST['contact']));
    $school = htmlentities(trim($_POST['school']));
    $city = htmlentities(trim($_POST['city']));
    $state = htmlentities(trim($_POST['state']));
    $message = htmlentities(trim($_POST['message']));

    $mail = new PHPMailer();
    $mail->Host = "mail.madhubunbooks.com";
    $mail->addAddress($email);
    $mail->setFrom('marketing@madhubunbooks.com');
    $mail->FromName ='Madhubun Books';
    $mail->Subject = 'Thanks for your interest in Madhubun Educational Books';

    $mail->isHTML(true);

    $mail->Body = 'Thanks for filling the "Madhubun Educational Books" form.
    Your information will be forwarded to the concerned person in Madhubun Educational Books and they will follow-up with you shortly.';

    if ($mail->send()) {

        $users_a = mysqli_query($database, "select * from epd_request where `email` = '$email'");
        if (mysqli_num_rows($users_a) > 0) {

            echo "<script language='javascript'>alert('Email already Register');window.location.href='request-epd'</script>";
        } else {
            $query = mysqli_query($database, "INSERT INTO `epd_request`(`name`, `email`, `contact`, `school`, `city`, `state`, `message`) VALUES ('$name','$email','$contact','$school','$city','$state','$message')");

            $_SESSION['status_pop'] = "Request Submitted";
            $_SESSION['status_pop_code'] = "success";
            header('Refresh:3;url=request-epd');
        }
    } else {

        echo $mail->Errorinfo;
    }
}

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Request EPD | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include 'includes/head.php' ?>
</head>
<style>
    .active a {
        color: #a32c4c !important;
        font-weight: 500 !important;
    }

    .form_err {
        color: red;
        font-size: 12px;
        font-weight: 500;
    }
</style>

<body>

    <!-- Main wrapper -->
    <div class="wrapper" id="wrapper">
        <!-- Header -->

        <?php include 'includes/header.php' ?>
        <!-- //Header -->
        <!-- Start Search Popup -->
        <div class="box-search-content search_active block-bg close__top">
            <form id="search_mini_form" class="minisearch" action="#">
                <div class="field__search">
                    <input type="text" placeholder="Search entire store here...">
                    <div class="action">
                        <a href="#"><i class="zmdi zmdi-search"></i></a>
                    </div>
                </div>
            </form>
            <div class="close__wrap">
                <span>close</span>
            </div>
        </div>
        <!-- End Search Popup -->
        <div class="ht__breadcrumb__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-centers">
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index">Home &gt;</a>
                                <a class="breadcrumb_item" href="index">Educational Professional Development &gt;</a>
                                <span class="breadcrumb_item active">Request EPD</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcum -->

        <div class="container-fluid mt-1">
            <div class="row">
                <div id="event-banner" class="owl-carousel">
                    <?php $event_banner = Allbanner::find_by_events_banner();
                    foreach ($event_banner as $banner) {
                    ?>
                        <div class="item">
                            <div class="madhubun-news-content">
                                <div class="madhubun-news-img">
                                    <div class="blog-banner">
                                        <img src="admin/<?php echo $banner->picture_path() ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- End Banner -->
        <!-- Start About Area -->
        <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="digital_browse">
                            <h4>EPD</h4>
                            <ul>
                                <li class="label2"><a href="javascript:void(0)">Webinars</a></li>
                                <li class="label2"><a href="javascript:void(0)">Workshops</a> </li>
                                <li class="label2"><a href="https://madhubunbooks.com/past-events?sort_type=webinars">Past events</a></li>
                                <li class="label2 active"><a href="request-epd">Request EPD</a></li>
                                <li class="label2"><a href="javascript:void(0)">Articles and Blogs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12 order-1 order-lg-2">
                        <div class="blog-page">
                            <div class="section__title">
                                <h2>Educator Professional Development</h2>
                            </div>
                            <p>Thank you for your interest in a Workshop/Teacher Training Request Programme on Madhubun.</p>
                            <p>To schedule a Workshop/Teacher Training, please provide all the information requested below, we will get in touch with you soon.</p>
                            <div class="publish-form mt-3">
                                <h5 class="wrk_t">Request EPD</h5>
                                <div class="text-center">
                                    <h3 class="text-success"><?php echo $msg; ?></h3>
                                </div>
                                <form method="post" action="" onsubmit="return validation()">
                                    <div class="row mt-4">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Name: <span>*</span></label>
                                                <input type="text" class="form-cont" name="name" id="name_" placeholder="Enter Name">
                                                <div class="form_err" id="name_err"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Email: <span>*</span></label>
                                                <input type="email" class="form-cont" name="email" id="email" placeholder="Enter Email">
                                                <div class="form_err" id="email_err"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Contact: <span>*</span></label>
                                                <input type="contact" class="form-cont" name="contact" id="contact" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" maxlength="10" placeholder="Enter Contact">
                                                <div class="form_err" id="contact_err"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">School Name: <span>*</span></label>
                                                <input type="text" class="form-cont" name="school" id="school" placeholder="Enter School Name">
                                                <div class="form_err" id="school_err"></div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">City: <span>*</span></label>
                                                <input type="text" class="form-cont" name="city" id="city" placeholder="Enter City">
                                                <div class="form_err" id="city_err"></div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">State: <span>*</span></label>
                                                <input type="text" class="form-cont" name="state" id="state" placeholder="Enter State">
                                                <div class="form_err" id="state_err"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Message(Optional): <span></span></label>
                                                <textarea type="text" class="form-cont" name="message" placeholder="Enter Message"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="date" value="<?php echo $time ?>">
                                        <div class="publish-submit text-center">
                                            <button type="submit" name="submit" class="custom-btn btn-5 request_epd">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Footer Area -->
    <?php include 'includes/footer.php' ?>
    <!-- //Footer Area -->

    </div>
    <!-- //Main wrapper -->
    <!-- JS Files -->
    <?php include 'includes/foot.php' ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function validation() {
            var name = document.getElementById("name_").value;
            var email = document.getElementById("email").value;
            var contact = document.getElementById("contact").value;
            var school = document.getElementById("school").value;
            var city = document.getElementById("city").value;
            var state = document.getElementById("state").value;

            if (name == '') {
                document.getElementById('name_err').innerHTML = "Please enter your name*";
                return false;
            } else {
                document.getElementById('name_err').innerHTML = "";
            }

            if (email == '') {
                document.getElementById('email_err').innerHTML = "Please enter your email*";
                return false;
            } else {
                document.getElementById('email_err').innerHTML = "";
            }
            if (contact == '') {
                document.getElementById('contact_err').innerHTML = "Please enter your mobile number*";
                return false;
            } else {
                document.getElementById('contact_err').innerHTML = "";
            }
            if(contact.length != 10){
                  document.getElementById('contact_err').innerHTML="Mobile number must Be 10 digits*";
                  return false;
                  }else{
                    document.getElementById('contact_err').innerHTML="";
                 } 
            if (school == '') {
                document.getElementById('school_err').innerHTML = "Please enter your school name*";
                return false;
            } else {
                document.getElementById('school_err').innerHTML = "";
            }
            if (city == '') {
                document.getElementById('city_err').innerHTML = "Please enter your city name*";
                return false;
            } else {
                document.getElementById('city_err').innerHTML = "";
            }
            if (state == '') {
                document.getElementById('state_err').innerHTML = "Please enter your state name*";
                return false;
            } else {
                document.getElementById('state_err').innerHTML = "";
            }
        }
    </script>
    <?php
    if (isset($_SESSION['status_pop'])) {
    ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status_pop']; ?>",
                icon: "<?php echo $_SESSION['status_pop_code']; ?>",
                button: "Ok",
            });
            <?php
            unset($_SESSION['status_pop']);
        }
            ?>
        </script>
</body>

</html>