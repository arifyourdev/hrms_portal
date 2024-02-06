<?php
require_once "admin/private/initialize.php";
$mail_data = EmailtemplateMaster::find_by_mailtemplate_id(107); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
 
   if(isset($_POST['submit'])) {
       
      $pwu_name = htmlentities(trim($_POST['pwu']['pwu_name']));
      $pwu_email = htmlentities(trim($_POST['pwu']['pwu_email']));
      $pwu_mobile = htmlentities(trim($_POST['pwu']['pwu_mobile']));
      $pwu_country = htmlentities(trim($_POST['pwu']['pwu_country']));
      $pwu_state = htmlentities(trim($_POST['pwu']['pwu_state']));
      $pwu_city = htmlentities(trim($_POST['pwu']['pwu_city']));
      $pwu_synopsis_text = htmlentities(trim($_POST['pwu']['pwu_synopsis_text']));
      $pwu_address = htmlentities(trim($_POST['pwu']['pwu_address']));
      $pwu_status = htmlentities(trim($_POST['pwu']['pwu_status']));
  
        $mail = new PHPMailer();

        $mail->Host = "mail.madhubunbooks.com";
        $mail->addAddress($pwu_email);                             
        $mail->setFrom('marketing@madhubunbooks.com');
        $mail->FromName = 'Madhubun Books';
        $mail->Subject = 'Publish with us';
        $mail->isHTML(true);
        $mail->Body = 'Thanks for filling the Publish With Us form Your information will be forwarded to the concerned person in Madhubun Educational Books and they will follow-up with you shortly.';
        
         if($mail->send()){

            $args = $_POST['pwu'];
            $pwu = new BookPwu($args);
            // if(is_uploaded_file($_FILES['pwu_synopsis_file']['tmp_name'])){
            //       $pwu->set_file($_FILES['pwu_synopsis_file']);
            //       $result = $pwu->save_photo('pwu_id');
            //  }else{
               $result = $pwu->save('pwu_id');
            //   }

            if($result) 
            {
                $_SESSION['status_pop'] = "Request Submitted";
                $_SESSION['status_pop_code'] = "success";
                header("Refresh:3;");
                 
            } else {
                $_SESSION['status_pop'] = "Something Wrong";
                $_SESSION['status_pop_code'] = "error";
            }
          } else {

            echo "error";
  }

        $admin_email = $_POST['admin_email'];
        $mails = new PHPMailer();
        $mails->Host = "mail.madhubunbook.com";
        $swap_var = array(

            "{PWU_DATA}" =>  $pwu_name .','. $pwu_mobile .','. $pwu_country .','. $pwu_state .','. $pwu_city .','. $pwu_synopsis_text .','. $pwu_address
        );
        $mails->addAddress($admin_email);                             
        $mails->setFrom('marketing@madhubunbooks.com');
        $mails->FromName = 'Madhubun Books';
        $mails->Subject = $mail_data->mail_subject;
        $mails->isHTML(true);

        $body = strtr($mail_data->mail_message, $swap_var);          
                
        $mails->Body = $body;

        if($mails->send()){
            
        } else{
            echo $mail->Errorinfo; 
        }

}
    

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Publish with us | Madhuban</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include 'includes/head.php' ?>
</head>

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
        <style>
       .form_err{
        color: red;
        font-size: 12px;
        font-weight: 500;
    }
     </style> 
        <!-- Start About Area -->
        <div class="page-about about_area bg--white section-padding--lg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-10 col-sm-12 col-12">
                        <div class="content">
                            <h2 class="pages-title" style="margin-left:-3px!important">PUBLISH WITH US</h2>
                            <div class="about-lft full-right-page mt-4">
                                <h4 style="font-weight:500;color: #a32c4c;">Let us Connect and Create!</h4>
                                Madhubun Educational Books invites proposals from Principals, Teachers, Academicians, Subject Matter Experts and people who have a flair for creative writing and expressions to:
                            </div>
                            <div class="about-lft full-right-page">
                                <div class="publisher-text">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    <p>author a text book</p>
                                </div>
                                <div class="publisher-text">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    <p>review new text books and educational products</p>
                                </div>
                                <div class="publisher-text">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    <p>submit an idea for a new productPublish With Us</p>
                                </div>
                                <p class="publish_filled">Fill either our Publish With Us form</p>
                            </div>
                            <div class="or">
                                <h6>OR</h6>
                            </div>
                            <p style="font-weight: 500;">
                                <strong>Forward your details to</strong>
                                <a href=""> publishwithus@madhubunbooks.com</a> Your information will be channelised to the concerned individual at Madhubun Educational Books who will connect with you.
                            </p>
                            <div class="text-center">
                                <h3 class="text-success"><?php echo display_session_message();?></h3>
                            </div>
                        </div>
                        <div class="publish-form">
                             <form  method="post" enctype="multipart/form-data" onsubmit="return validation()">
                            <div class="row mt-4">
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                         <label for="name">Name: <span>*</span></label>
                                         <input type="text" class="form-cont" name="pwu[pwu_name]" id="pwu_name" placeholder="Enter Name">
                                         <div class="form_err" id="pwu_name_err"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Email: <span>*</span></label>
                                        <input type="email" class="form-cont" name="pwu[pwu_email]" id="pwu_email" placeholder="Enter Email">
                                        <div class="form_err" id="pwu_email_err"></div>
                                    </div>
                                </div>
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Mobile: <span>*</span></label>
                                        <input type="contact" class="form-cont" name="pwu[pwu_mobile]"id="pwu_mobile" placeholder="Enter Contact" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" maxlength="10">
                                        <div class="form_err" id="pwu_mobile_err"></div>
                                    </div>
                                </div>
                               <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Country: </label>
                                        <select class="form-cont form-con" name="pwu[pwu_country]" id="pwu_country">
                                            <option value="">-SELECT-</option>
                                            <?php  $all_country = CountrycitystateMaster::find_by_order();
                                            foreach($all_country as $country){
                                            ?>
                                            <option value="<?php echo $country->zsc_id?>"><?php echo $country->zsc_name?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="form_err" id="pwu_country_err"></div>
                                </div>
                                </div>

                                   <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">City: <span>*</span></label>
                                        <input type="text" class="form-cont" name="pwu[pwu_city]" id="pwu_city" placeholder="Enter City">
                                        <div class="form_err" id="pwu_city_err"></div>
                                    </div>
                                </div>  
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">State: <span>*</span></label>
                                        <input type="text" class="form-cont" name="pwu[pwu_state]" id="pwu_state" placeholder="Enter State">
                                        <div class="form_err" id="pwu_state_err"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Address: <span>*</span></label>
                                        <input type="text" class="form-cont" name="pwu[pwu_address]" id="pwu_address" placeholder="Enter Address">
                                        <div class="form_err" id="pwu_address_err"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Upload Synopsis: <span>*</span></label>
                                        <input type="file" class="form-cont" name="pwu_synopsis_file">
                                    </div>
                                </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Write Synopsis: <span>*</span></label>
                                        <textarea type="text" class="form-cont" name="pwu[pwu_synopsis_text]" id="pwu_synopsis_text" placeholder="Enter Synopsis Text"></textarea>
                                        <div class="form_err" id="pwu_synopsis_text_err"></div>
                                    </div>
                                </div>
                                 <input type="hidden" name="pwu[pwu_date_time]" value="<?php echo $time ?>">
                                 <input type="hidden" name="admin_email" value="<?php echo $mail_data->mail_to_admin ?>">
                                 <input type="hidden" name="pwu[pwu_sta">
                                   <div class="publish-submit text-center">
                                    <button type="submit" name="submit" class="custom-btn btn-5 request_epd">SUBMIT</button>
                              </div>
                                 </div>
                                </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- End About Area -->

        <!-- Footer Area -->
        <?php include 'includes/footer.php' ?>
        <!-- //Footer Area -->

    </div>
    <!-- //Main wrapper -->
    <!-- JS Files -->
    <?php include 'includes/foot.php' ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function validation(){
            var pwu_name = document.getElementById("pwu_name").value;
            var pwu_email = document.getElementById("pwu_email").value;
            var pwu_mobile = document.getElementById("pwu_mobile").value;
            var pwu_country = document.getElementById("pwu_country").value;
            var pwu_city = document.getElementById("pwu_city").value;
            var pwu_state = document.getElementById("pwu_state").value;
            var pwu_address = document.getElementById("pwu_address").value;
            var pwu_synopsis_text = document.getElementById("pwu_synopsis_text").value;
 
             if(pwu_name == ''){
                    document.getElementById('pwu_name_err').innerHTML= "Please enter your name**";
                    return false;
                }else{
                document.getElementById('pwu_name_err').innerHTML= "";  
                }
                if(pwu_email == ''){
                    document.getElementById('pwu_email_err').innerHTML= "Please enter your email**";
                    return false;
                }else{
                document.getElementById('pwu_email_err').innerHTML= "";  
                }
                if(pwu_mobile == ''){
                    document.getElementById('pwu_mobile_err').innerHTML= "Please Enter your mobile number**";
                    return false;
                }else{
                document.getElementById('pwu_mobile_err').innerHTML= "";  
                }
                if(pwu_mobile.length != 10){
                  document.getElementById('pwu_mobile_err').innerHTML="Mobile number must Be 10 digits*";
                  return false;
                  }else{
                    document.getElementById('pwu_mobile_err').innerHTML="";
                 } 
                 if(pwu_country == ""){
                  document.getElementById('pwu_country_err').innerHTML="Please select your Country";
                  return false;
                  }else{
                    document.getElementById('pwu_country_err').innerHTML="";
                 } 
                 if(pwu_city == ""){
                  document.getElementById('pwu_city_err').innerHTML="Please enter your city";
                  return false;
                  }else{
                    document.getElementById('pwu_city_err').innerHTML="";
                 } 
                 if(pwu_state == ""){
                  document.getElementById('pwu_state_err').innerHTML="Please enter your state";
                  return false;
                  }else{
                    document.getElementById('pwu_state_err').innerHTML="";
                 } 
                 if(pwu_address == ""){
                  document.getElementById('pwu_address_err').innerHTML="Please enter your address";
                  return false;
                  }else{
                    document.getElementById('pwu_address_err').innerHTML="";
                 } 
                 if(pwu_synopsis_text == ""){
                  document.getElementById('pwu_synopsis_text_err').innerHTML="Please write Synopsis";
                  return false;
                  }else{
                    document.getElementById('pwu_synopsis_text_err').innerHTML="";
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