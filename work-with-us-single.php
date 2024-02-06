<?php
require_once "admin/private/initialize.php";

if(isset($_GET['id'])){
    $value = $_GET['id']; 
}else{
    $value ='';
}
$mail_data = EmailtemplateMaster::find_by_mailtemplate_id(110);
$c_mail_data = EmailtemplateMaster::find_by_mailtemplate_id(111);
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if(isset($_POST['submit'])){

    $applicant_type = htmlentities($database->escape_string($_POST['applicant_type']));
    $applicant_department = htmlentities($database->escape_string($_POST['applicant_department']));
    $applicant_exp = htmlentities($database->escape_string($_POST['applicant_exp']));
    $applicant_qualification = htmlentities($database->escape_string($_POST['applicant_qualification']));
    $applicant_specialization = htmlentities($database->escape_string($_POST['applicant_specialization']));
    $applicant_name = htmlentities($database->escape_string($_POST['applicant_name']));
    $applicant_email = htmlentities($database->escape_string($_POST['applicant_email']));
    $applicant_mobile = htmlentities($database->escape_string($_POST['applicant_mobile']));
    $applicant_detail = htmlentities($database->escape_string($_POST['applicant_detail']));
    $image = $_FILES['applicant_file']['name'];
    $tmp_image = $_FILES['applicant_file']['tmp_name'];
    $folder = "images/application/" .$image;
    move_uploaded_file($tmp_image,$folder);
    
    $mail = new PHPMailer();
    $mail->Host = "mail.madhubunbooks.com";
    $swap_var = array(
        "~#DATE#~" => $time,
        "~#USERNAME#~" => $applicant_name
    );
    $mail->addAddress($applicant_email);                             
    $mail->setFrom('marketing@madhubunbooks.com');
    $mail->FromName = 'Madhubun Books';
    $mail->Subject = 'Career with Madhubun Educational Books';

    $mail->isHTML(true);
   
    $body = strtr($mail_data->mail_message, $swap_var);          
         
    $mail->Body = $body;

    if($mail->send()){

        $sql = mysqli_query($database, "INSERT INTO `books_application`(`applicant_name`,`applicant_email`,`applicant_mobile`,`applicant_detail`, `applicant_type`,`applicant_exp`, `applicant_department`, `applicant_qualification`, `applicant_specialization`,`applicant_file`) VALUES ('$applicant_name','$applicant_email','$applicant_mobile','$applicant_detail','$applicant_type','$applicant_exp','$applicant_department','$applicant_qualification','$applicant_specialization','$image')");
 
        if($sql){
            
                $_SESSION['status_pop'] = "Application Submitted";
                $_SESSION['status_pop_code'] = "success";
                header('Refresh:3');
                 
            }else {
                $_SESSION['status_pop'] = "Email already Register";
                $_SESSION['status_pop_code'] = "error";
            }
    }
    else
    {
        echo $mail->Errorinfo;  
    }
    
        
        $admin_email = $_POST['admin_email'];
        $mails = new PHPMailer();
        $mails->Host = "mail.madhubunbooks.com";
        
        $swap_var2 = array(
            "~#JOBTITLE#~" => $applicant_type,
            "~#APPLICANT_DATA#~" => $applicant_name .','. $applicant_mobile .','. $applicant_detail
        );
        $mails->addAddress($admin_email);                             
        $mails->setFrom('marketing@madhubunbooks.com');
        $mails->FromName = 'Madhubun Books';
        $mails->Subject = 'career with Madhubun Educational Books.';
        $mails->isHTML(true);

        $body = strtr($c_mail_data->mail_message, $swap_var2);          
         
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
    <base href="<?php echo $base_url; ?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Work with us | Madhuban</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include 'includes/head.php' ?>
</head>
<style>
    .form_err{
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
        <div class="ht__breadcrumb__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-centers">
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index">Home ></a>
                                <span class="breadcrumb_item">work with us ></span>
                                 <!--<span class="breadcrumb_item active">Editorial</span>-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Search Popup -->
       
        <!-- Start About Area -->
        <div class="mt-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class='d-flex' style='justify-content: space-between'>
                        <div class="work-single-content">
                            <h2 style="margin-left:-3px!important">Join Us! Apply Now</h2>
                             <p>Please complete the form below to apply for <b>Work With Us</b></p>  
                        </div>
                        <div>
                            <a href="career" class="view-buttons">Current Opening</a>
                        </div>
                        </div>
                        <div class="publish-form">
                            <form action="" method="post" enctype="multipart/form-data" onsubmit="return wws_validation()">
                            <div class="row">
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Job Type: </label>
                                        <select class="form-cont form-con" name="applicant_type" id="job_type">
                                            <option value="">-Type-</option>
                                            <option value="1">Full Time</option>
                                            <option value="2">Part Time</option>
                                            <option value="3">Contractual</option>
                                            <option value="4">Retainer</option>
                                        </select>
                                        <div class="form_err" id="job_type_err"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Department: <span>*</span></label>
                                        <select class="form-cont form-con" name="applicant_department" id="department">
                                            <option value="">-Select-</option>
                                            <option value="1" <?php if($value == 'editorial'){ echo "selected" ;} ?> >Editorial</option>
                                            <option value="2" <?php if($value == 'marketing'){ echo "selected" ;} ?>>Marketing</option>
                                            <option value="3" <?php if($value == 'production'){ echo "selected" ;} ?>>Production</option>
                                            <option value="5" <?php if($value == 'sales'){ echo "selected"; } ?>>Sales</option>
                                            <option value="4" <?php if($value == 'others'){ echo "selected"; } ?>>Other Department</option>
                                        </select>
                                        <div class="form_err" id="department_err"></div>
                                    </div>
                                </div>
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Experience: </label>
                                        <select class="form-cont form-con" name="applicant_exp" id="applicant_exp">
                                            <option value="">-Experience-</option>
                                            <option value="0-1">0-1 Year</option>
                                            <option value="1-2">1-2 Year</option>
                                            <option value="2-3">2-3 Year</option>
                                            <option value="3-4">3-4 Year</option>
                                            <option value="4-5">4-5 Year</option>
                                            <option value="4-5">5-6 Year</option>
                                            <option value="4-5">6-7 Year</option>
                                            <option value="4-5">7-8 Year</option>
                                            <option value="4-5">8-9 Year</option>
                                            <option value="10">Above 10 Year</option>
                                        </select>
                                        <div class="form_err" id="applicant_exp_err"></div>
                                    </div>
                                </div>
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Qualification: </label>
                                        <select class="form-cont form-con" name="applicant_qualification" id="applicant_qualification">
                                            <option value="">-Qualification-</option>
                                            <option value="10">10th</option>
                                            <option value="12">12th</option>
                                            <option value="13">Graduation</option>
                                            <option value="14">Post Graduation</option>
                                            <option value="15">Diploma</option>
                                            <option value="16">Others</option>
                                        </select>
                                        <div class="form_err" id="applicant_qualification_err"></div>
                                    </div>
                                </div>
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Specification: <span>*</span></label>
                                        <textarea type="text" class="form-cont" name="applicant_specialization"  id="applicant_specialization" placeholder="Enter Specification"></textarea>
                                        <div class="form_err" id="applicant_specialization_err"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Name: <span>*</span></label>
                                        <input type="text" class="form-cont" name="applicant_name" id="applicant_name" placeholder="Enter Name">
                                        <div class="form_err" id="applicant_name_err"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Email: <span>*</span></label>
                                        <input type="email" class="form-cont" name="applicant_email" id="applicant_email" placeholder="Enter Email">
                                        <div class="form_err" id="applicant_email_err"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Mobile: <span>*</span></label>
                                        <input type="text" class="form-cont" name="applicant_mobile" id="applicant_mobile" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" maxlength="10" placeholder="Enter Mobile">
                                        <div class="form_err" id="applicant_mobile_err"></div>
                                        
                                    </div>
                                </div>
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Describe Yourself: <span>*</span></label>
                                        <textarea type="text" class="form-cont" name="applicant_detail" id="applicant_detail"></textarea>
                                        <div class="form_err" id="applicant_detail_err"></div>
                                    </div>
                                </div>
                                 
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Upload Resume: <span>*</span></label>
                                        <input type="file" class="form-cont" name="applicant_file" id="applicant_file">
                                        <div class="form_err" id="applicant_file_err"></div>
                                    </div>
                                </div>
                                 <input type="hidden" name="admin_email" value="<?php echo $c_mail_data->mail_to_admin ?>">
                                <div class="publish-submit text-end">
                                    <button type="submit" name="submit" class="custom-btn btn-5" style="width: 172px !important;">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    

                </div>
            </div>
            
              <div class="border02" style="margin-top:20px;margin-bottom:20px"> </div>
         <section class="pd-w">
            <div class="container mt-2">
                 <div class="work-single-content">
                    <h2 style="margin-left:-3px!important">Select your expertise?</h2>
                  </div>
                <div class="row">
                     <div class="col-lg-12">
                      <div class="work-with-us-m">
                         <div id="work-with-us-slider" class="owl-carousel">
                            <div class="item">
                                <div class="madhubun-work-content">
                                    <div class="madhubun-work-img">
                                        <div class="work-w-us-img">
                                           <a href="work-with-us-single"> <img src="img/editorial.svg" alt=""></a>
                                        </div>
                                        <div class="work-title">
                                           <a href="work-with-us-single"> <h6>Editorial</h6></a>
                                         </div>
                                    </div>
                                 </div>
                            </div>
                            <div class="item">
                                <div class="madhubun-work-content">
                                    <div class="madhubun-work-img">
                                        <div class="work-w-us-img">
                                           <a href="work-with-us-single"> <img src="img/marketing.svg" alt=""></a>
                                        </div>
                                        <div class="work-title">
                                          <a href="work-with-us-single">  <h6>Marketing</h6></a>
                                         </div>
                                    </div>
                                 </div>
                            </div>
                            <div class="item">
                                <div class="madhubun-work-content">
                                    <div class="madhubun-work-img">
                                        <div class="work-w-us-img">
                                          <a href="work-with-us-single">  <img src="img/production1.svg" alt=""></a>
                                        </div>
                                        <div class="work-title">
                                           <a href="work-with-us-single"> <h6>Production</h6></a>
                                         </div>
                                    </div>
                                 </div>
                            </div>
                            <div class="item">
                                <div class="madhubun-work-content">
                                    <div class="madhubun-work-img">
                                        <div class="work-w-us-img">
                                          <a href="work-with-us-single">  <img src="img/sales.svg" alt=""></a>
                                        </div>
                                        <div class="work-title">
                                           <a href="work-with-us-single"> <h6>Sales</h6></a>
                                         </div>
                                    </div>
                                 </div>
                            </div>
                            <div class="item">
                                <div class="madhubun-work-content">
                                    <div class="madhubun-work-img">
                                        <div class="work-w-us-img">
                                           <a href="work-with-us-single"> <img src="img/other-department.svg" alt=""> </a>
                                        </div>
                                        <div class="work-title">
                                           <a href="work-with-us-single"> <h6>Other Department</h6></a>
                                         </div>
                                    </div>
                                 </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    </div>
                     
                </div>
            </div>
        </section>
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
    <script src="js/validation.js"></script> 
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