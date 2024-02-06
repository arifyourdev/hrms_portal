<?php
require_once "admin/private/initialize.php";
$mail_data = EmailtemplateMaster::find_by_mailtemplate_id(101);
$a_mail_data = EmailtemplateMaster::find_by_mailtemplate_id(102);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
$msg = "";
if(isset($_POST['submit'])){
    $type = htmlentities($database->escape_string($_POST['user_type']));
    $user_email = htmlentities($database->escape_string($_POST['user_email']));
    $user_mobile = htmlentities($database->escape_string($_POST['user_mobile']));
    $user_firstname = htmlentities($database->escape_string($_POST['user_firstname']));
    $user_lastname = htmlentities($database->escape_string($_POST['user_lastname']));
    $user_password = htmlentities($database->escape_string($_POST['user_password']));
    $user_c_password = htmlentities($database->escape_string($_POST['user_c_password']));
    $profile_designation = htmlentities($database->escape_string($_POST['profile_designation']));
    $profile_department = htmlentities($database->escape_string($_POST['profile_department']));
    $profile_level = htmlentities($database->escape_string($_POST['profile_level']));
    $profile_school_name = htmlentities($database->escape_string($_POST['profile_school_name']));
    $profile_principal_name = htmlentities($database->escape_string($_POST['profile_principal_name']));
    $profile_country = htmlentities($database->escape_string($_POST['profile_country']));
    $profile_state = htmlentities($database->escape_string($_POST['profile_state']));
    $profile_city = htmlentities($database->escape_string($_POST['profile_city']));
    $profile_zip = htmlentities($database->escape_string($_POST['profile_zip']));
    $profile_school_email = htmlentities($database->escape_string($_POST['profile_school_email']));
    $profile_date = htmlentities($database->escape_string($_POST['profile_date']));
     
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LcCS6whAAAAAF0mqEqoOS1EezhOZnU3lPF2ZJsZ';
    $recaptcha_response = $_POST['recaptcha_response'];
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' .$recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
 
        $users_a = mysqli_query($database,"select * from books_user_master where `user_email` = '$user_email' or `user_mobile` = '$user_mobile'");
        if(mysqli_num_rows($users_a) > 0){
              $msg = "User Already Register";
        }else
        {
    
        if($user_password != $user_c_password){
    
            $msg = "Password Not Matched";
        }
        else{
            
            // if ($recaptcha->score >= 1) {
    
            // $args = $_POST['register'];
            $registers = new BookUserMaster();
            $registers->user_type = $type;
            $registers->user_email = $user_email;
            $registers->user_mobile = $user_mobile;
            $registers->user_firstname = $user_firstname;
            $registers->user_lastname = $user_lastname;
            $registers->user_password = $user_password;
            $registers->user_date = $time;
            $registers->user_status = 'N';
            $result = $registers->save('user_id');
    
            if($result==true)
            {
                $user_id = $registers->user_id;
    
                $user = BookUserMaster::find_by_custom_id('user_id',$user_id);
      
                $register = new BookUserProfile();
                $register->profile_designation = $profile_designation;
                $register->profile_department = $profile_department;
                $register->profile_level = $profile_level;
                $register->profile_school_name = $profile_school_name;
                $register->profile_user_id = $user_id;
                $register->profile_principal_name = $profile_principal_name;
                $register->profile_country = $profile_country;
                $register->profile_state = $profile_state;
                $register->profile_city = $profile_city;
                $register->profile_zip = $profile_zip;
                $register->profile_school_email = $profile_school_email;
                $register->profile_date = $profile_date;
        
                $result = $register->save('profile_id');
            
                $session->log_user($result);
                $_SESSION['user_id'] = $user_id;
                  
                header('Location:index');
            }
            else
            {
                echo "<script language='javascript'>alert('Something wrong');window.location.href='register'</script>";
            }
    
            }
        }
            $mail = new PHPMailer();
            $mail->Host = "mail.madhubunbooks.com";
            $swap_var = array(
                "~#DATE#~" => $time,
                "~#USERNAME#~" => $user_firstname .','. $user_lastname
            );
            $mail->addAddress($user_email);                             
            $mail->setFrom('marketing@madhubunbooks.com');
            $mail->FromName = 'Madhubun Books';
            $mail->Subject = $mail_data->mail_subject;

            $mail->isHTML(true);
        
            $body = strtr($mail_data->mail_message, $swap_var);          
                
            $mail->Body = $body;

            if($mail->send()){
            }else{
                  echo $mail->Errorinfo; 
            }

            // For Admin
            $admin_email = $_POST['admin_email'];
            $mails = new PHPMailer();
            $mails->Host = "mail.madhubunbooks.com";
            
            $swap_var2 = array(

                 "~#USER_DATA#~" =>  $user_firstname .''. $user_lastname .','. $user_mobile .','. $profile_designation .','. $profile_department .','. $profile_school_name .','. $profile_principal_name .','. $profile_country .','. $profile_state .','. $profile_city .','. $profile_zip .','. $profile_school_email
            );
            $mails->addAddress($admin_email);                             
            $mails->setFrom('marketing@madhubunbooks.com');
            $mails->FromName = 'Madhubun Books';
            $mails->Subject = $a_mail_data->mail_subject;
            $mails->isHTML(true);
    
            $body2 = strtr($a_mail_data->mail_message, $swap_var2);          
             
            $mails->Body = $body2;
    
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
    <title>Registration | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
     <?php include 'includes/head.php' ?>
     <script src="https://www.google.com/recaptcha/api.js?render=6LcCS6whAAAAAJdrAmink08bVVbqnL_NB69GWMmK"></script>
     <script>
      function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6LcCS6whAAAAAJdrAmink08bVVbqnL_NB69GWMmK', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.
              var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
          });
        });
      }
  </script>
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
    <!-- Start My Account Area -->
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Registration</h3>
                        <h3 class="text-center text-danger mt-4"><?php echo $msg; ?></h3>
                             <form method="post" action="" onsubmit="return validation()"> 
                                 <div class="account__form">
                                    
                                    <div class="row">
                                     <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Type <span>*</span></label>
                                                <select type="text" name="user_type" id="user_type" class="type-select">
                                                    <option value="">-Select-</option>
                                                    <option value="2">Student</option>
                                                    <option value="2">Parent</option>
                                                    <option value="1">Teacher</option>
                                                    <option value="2">Other</option>
                                                 </select>
                                                 <div class="form_err" id="user_type_err"></div>
                                        </div>
                                     </div>
                                      <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Email Address <span>*</span></label>
                                            <input type="email" name="user_email" id="user_email" placeholder="Enter Email">
                                            <div class="form_err" id="email_err"></div>
                                        </div>
                                     </div>
                                     <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                                      <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Mobile <span>*</span></label>
                                            <input type="text" name="user_mobile" id="user_mobile" placeholder="Enter Mobile Nub" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
                                            <div class="form_err" id="mobile_err"></div>
                                        </div>
                                     </div>
                                      <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>First Name <span>*</span></label>
                                            <input type="text" name="user_firstname" id="user_firstname" placeholder="Enter First Name">
                                            <div class="form_err" id="user_firstname_err"></div>
                                        </div>
                                     </div>
                                     <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Last Name <span>*</span></label>
                                            <input type="text" name="user_lastname" id="user_lastname" placeholder="Enter Last Name">
                                            <div class="form_err" id="user_lastname_err"></div>
                                        </div>
                                     </div>
                                     <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Designation <span>*</span></label>
                                            <input type="text" name="profile_designation" id="profile_designation" placeholder="Enter Designation">
                                            <div class="form_err" id="d_err"></div>
                                        </div>
                                     </div>
                                       <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Department <span>*</span></label>
                                            <input type="text" name="profile_department" id="profile_department" placeholder="Enter Department">
                                            <div class="form_err" id="pd_err"></div>
                                        </div>
                                     </div>
                                     <!-- <input type="hidden" name="recaptcha_response" id="recaptchaResponse"> -->
                                       <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Password <span>*</span></label>
                                            <input type="password" name="user_password" id="user_password" placeholder="Enter Password">
                                            <div class="form_err" id="up_err"></div>
                                        </div>
                                     </div>
                                     <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Confirm Password <span>*</span></label>
                                            <input type="password" name="user_c_password" id="user_c_password" placeholder="Enter Confirm Password">
                                            <div class="form_err" id="ucp_err"></div>
                                        </div>
                                     </div>
                                     <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Level <span></span></label>
                                            <select type="text" name="profile_level" class="type-select">
                                                <option value="type">-Select-</option>
                                                <?php $level_sql = BookLeval::find_by_order();
                                                foreach ($level_sql as $level_data){
                                                ?>
                                                 <option value="<?php echo $level_data->lavel_id?>"><?php echo $level_data->lavel_title?></option>
                                                 <?php } ?>
                                            </select>
 
                                        </div>
                                     </div>
                                     </div>
                                    
                                     <div class="row mt-3">
                                      <h6>SCHOOL INFORMATION</h6>
                                       <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>School Name <span>*</span></label>
                                            <input type="text" name="profile_school_name" id="profile_school_name" placeholder="Enter School Name" >
                                            <div class="form_err" id="psn_err"></div>
                                        </div>
                                     </div>
                                      <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Principal Name <span>*</span></label>
                                            <input type="text" name="profile_principal_name" id="profile_principal_name" placeholder="Enter Principal Name">
                                            <div class="form_err" id="ppn_err"></div>
                                        </div>
                                     </div>
                                      <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Country <span></span></label>
                                            <select type="text" name="profile_country" id="profile_country" class="type-select" required>
                                                <option value="type">-Select Country-</option>
                                                <?php 
                                                $country_sql = CountrycitystateMaster::find_by_order();
                                                foreach($country_sql as $country){
                                                ?>
                                                 <option value="<?php echo $country->zsc_id?>"><?php echo $country->zsc_name?></option>
                                                 <?php } ?>
                                            </select>
                                            <div class="form_err" id="pc_err"></div>
                                        </div>
                                     </div>
                                      <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>State <span>*</span></label>
                                            <input type="text" name="profile_state" id="profile_state" placeholder="Enter State">
                                            <div class="form_err" id="ps_err"></div>
                                        </div>
                                     </div>
                                     <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>City <span>*</span></label>
                                            <input type="text" name="profile_city" id="profile_city" placeholder="Enter City">
                                            <div class="form_err" id="profile_city_err"></div>
                                        </div>
                                     </div>
                                     <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>Pin/Zip <span>*</span></label>
                                            <input type="text" name="profile_zip" id="profile_zip" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Enter Pin/Zip">
                                            <div class="form_err" id="profile_zip_err"></div>
                                        </div>
                                     </div>
                                       <div class="col-lg-4 col-12">
                                        <div class="input__box">
                                            <label>School Email Id <span>*</span></label>
                                            <input type="email" name="profile_school_email" id="profile_school_email" placeholder="Enter School Email Id">
                                            <div class="form_err" id="profile_school_email_err"></div>
                                        </div>
                                     </div>
                                      
                                    </div>
                                     
                                    <input type="hidden" name="user_date" value="<?php echo $time ?>"> 
                                    <input type="hidden" name="profile_date" value="<?php echo $time ?>">
                                    <input type="hidden" name="admin_email" value="<?php echo $a_mail_data->mail_to_admin ?>">
                                     <div class="form__btns">
                                        <button type="submit" name="submit" class="custom-btn btn-5">Submit</button>
                                         <!--<a href="register" class="signup_b">Signup</a>-->
                                     </div>
                                
                                  </div>
                            </form>
                            <div class="login-nrt">
                         <p>Already Have An Account? <a href="login">Login Here</a></p>
                         </div>
                        </div>
                </div>
             </div>
           
        </div>
    </section>
    <!-- End My Account Area -->
    <!-- Footer Area -->
  <?php include 'includes/footer.php' ?>
    <!-- //Footer Area -->

</div>
<!-- //Main wrapper -->

 <?php include 'includes/foot.php' ?>
 <script>
             function validation(){
                  var user_type = document.getElementById("user_type").value;
                  var user_email = document.getElementById("user_email").value;
                  var user_mobile = document.getElementById("user_mobile").value;
                  var user_firstname = document.getElementById("user_firstname").value;
                  var user_lastname = document.getElementById("user_lastname").value;
                  var profile_designation = document.getElementById("profile_designation").value;
                  var profile_department =  document.getElementById("profile_department").value;
                  var user_password = document.getElementById("user_password").value;
                  var user_c_password = document.getElementById("user_c_password").value;
                  var profile_school_name = document.getElementById("profile_school_name").value;
                  var profile_principal_name = document.getElementById("profile_principal_name").value;
                  var profile_country = document.getElementById("profile_country").value;
                  var profile_state = document.getElementById("profile_state").value;
                  var profile_city = document.getElementById("profile_city").value;
                  var profile_zip = document.getElementById("profile_zip").value;
                  var profile_school_email= document.getElementById("profile_school_email").value;

                  if(user_type == ''){
                     document.getElementById('user_type_err').innerHTML= "Please Select User Type";
                     return false;
                 }else{
                    document.getElementById('user_type_err').innerHTML= "";  
                 }
                 if(user_email == ''){
                     document.getElementById('email_err').innerHTML= "Please enter valid email";
                     return false;
                 }else{
                    document.getElementById('email_err').innerHTML= "";  
                 }
                 if(user_mobile == ''){
                     document.getElementById('mobile_err').innerHTML= "Please Enter Mobile Number";
                     return false;
                 }else{
                    document.getElementById('mobile_err').innerHTML= ""; 
                 }
                 if(user_mobile.length != 10){
                  document.getElementById('mobile_err').innerHTML="Mobile number must Be 10 digits!";
                  return false;
                  }else{
                    document.getElementById('mobile_err').innerHTML="";
                 } 
                 if(user_firstname == ''){
                     document.getElementById('user_firstname_err').innerHTML= "Please Enter First Name";
                     return false;
                 }else{
                    document.getElementById('user_firstname_err').innerHTML= ""; 
                 } 
                 if(user_lastname == ''){
                     document.getElementById('user_lastname_err').innerHTML= "Please Enter First Name";
                     return false;
                 }else{
                    document.getElementById('user_lastname_err').innerHTML= ""; 
                 }  
                 if(profile_designation == ''){
                     document.getElementById('d_err').innerHTML= "Please Enter Designation";
                     return false;
                 }else{
                    document.getElementById('d_err').innerHTML= ""; 
                 }  
                 if(profile_department == ''){
                     document.getElementById('pd_err').innerHTML= "Please Enter Department";
                     return false;
                 }else{
                    document.getElementById('pd_err').innerHTML= ""; 
                 }
                 if(user_password == ''){
                     document.getElementById('up_err').innerHTML= "Please Enter Password";
                     return false;
                 }else{
                    document.getElementById('up_err').innerHTML= ""; 
                 } 
                 if(user_c_password == ''){
                     document.getElementById('ucp_err').innerHTML= "Please Enter Confirm Password";
                     return false;
                 }else{
                    document.getElementById('ucp_err').innerHTML= ""; 
                 }  
                 if(profile_school_name == ''){
                     document.getElementById('psn_err').innerHTML= "Please Enter School Name";
                     return false;
                 }else{
                    document.getElementById('psn_err').innerHTML= ""; 
                 } 
                 if(profile_principal_name == ''){
                     document.getElementById('ppn_err').innerHTML= "Please Enter School Name";
                     return false;
                 }else{
                    document.getElementById('ppn_err').innerHTML= ""; 
                 }  
                 if(profile_country == ''){
                     document.getElementById('pc_err').innerHTML= "Please Select Country";
                     return false;
                 }else{
                    document.getElementById('pc_err').innerHTML= ""; 
                 }  
                 if(profile_state == ''){
                     document.getElementById('ps_err').innerHTML= "Please Enter State";
                     return false;
                 }else{
                    document.getElementById('ps_err').innerHTML= ""; 
                 }  
                 if(profile_city == ''){
                     document.getElementById('profile_city_err').innerHTML= "Please Enter Profile City";
                     return false;
                 }else{
                    document.getElementById('profile_city_err').innerHTML= ""; 
                 }  
                 if(profile_zip == ''){
                     document.getElementById('profile_zip_err').innerHTML= "Please Enter Zipcode";
                     return false;
                 }else{
                    document.getElementById('profile_zip_err').innerHTML= ""; 
                 }  
                 if(profile_school_email == ''){
                     document.getElementById('profile_school_email_err').innerHTML= "Please Enter Profile Email";
                     return false;
                 }else{
                    document.getElementById('profile_school_email_err').innerHTML= ""; 
                 }  
                 
                    
             }
         </script>

</body>
 </html>