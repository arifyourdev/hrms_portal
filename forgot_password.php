<?php 
require_once "admin/private/initialize.php";
$msg = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

   
   if(isset($_POST['submit_link'])){
       
    $user_email=$_POST['user_email'];

    $sql="SELECT * FROM `books_user_master` WHERE `user_email`='$user_email'";

    $query=mysqli_query($database,$sql);
    
    if($row=mysqli_num_rows($query) == 1 )
    {
     $token = bin2hex(random_bytes(16));
     date_default_timezone_set("Asia/Kolkata");
     $date=date("Y-m-d");
     $query ="UPDATE `books_user_master` SET `user_email_vcode`='$token',`user_verification_time`='$date' WHERE `user_email`='$user_email'";
     if(mysqli_query($database,$query)){
         
        $mail = new PHPMailer();
        $mail->Host = "mail.madhubun.in";
        $mail->addAddress($user_email);                             
        $mail->setFrom('marketing@madhubun.in');
        $mail->FromName = 'Regard';
        $mail->Subject = 'Forget Password';
        $mail->isHTML(true);
       $mail->Body = '<html"> 
        <head> 
               <title>Forget Password Link</title> 
        </head> 
     <body> 
         <h2>Forget Password Link Here!</h2> 
        <table cellspacing="0" style="background: #f1f1f1; width: 50%; padding:3px;padding: 3px;
        padding-left: 103px;
        padding-bottom: 45px;padding-top: 43px;"> 
             <tr style="font-size: 16px;"> 
                <th style="fonmt-size:17px;">Link:</th><td> <a style="color: red;
                font-weight: 700;
                font-size: 14px;
                 text-decoration: none;
                margin-right: 5px;
                border-left: 1px solid;
                border-right: 1px solid;
                border-radius: 10px;
                padding: 1px 6px;
                padding-left: 9px;"href="'.$base_url.'/change_password?user_email='.$user_email.'&user_email_vcode='.$token.'">Click here </a> to  Reset  your password. </td>
                
            </tr> 
          </table>
        <br>
       Regards<br>
      Madhubunbooks Support Team<br>
     </body> 
    </html>'; 
        
         $mail->send();
         
         
       echo "<script>alert('Email Send to Your Mail');window.location.href='forgot_password'</script>";
     }
     else
     {
      echo "<script>alert('Something Went Wrong')</script>";
     }
   }
   else
   {
   echo "<script>alert('This email is not exist in database')</script>";
 }
}

             
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Forget Password | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
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
     <!-- Start My Account Area -->
    <section class="my_account_area pt--80 pb--55 bg--white mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 mx-auto">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Forgot Password</h3>
                        <form method="post" action="">
                            <div class="text-center">
                                <h5><?php echo $msg; ?></h5c>
                            </div>
                            <div class="account__form">
                                <div class="input__box">
                                    <label>Enter Registered Email <span>*</span></label>
                                    <input type="text" name="user_email" placeholder="Enter Email">
                                </div>
                                 <div class="form__btns11 mt-4 text-center">
                                      <button type="submit" name="submit_link" class="custom-btn btn-5 forget-pss" >Submit</button>
                                 </div>
                                 
                            </div>
                        </form>
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

</body>
 </html>