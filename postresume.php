<?php
require_once "admin/private/initialize.php";



if(isset($_GET['id'])){
    $jobs_id=$_GET['id'];
    $current= CurrentOpening::find_by_id($jobs_id);
}
include('Phpmailer/class.phpmailer.php');
include('Phpmailer/class.smtp.php'); 

   if(isset($_POST['submit'])) {
       
      $args = $_POST['jobs'];
      $name = htmlentities(trim($_POST['jobs']['applicant_name']));
      $email = htmlentities(trim($_POST['jobs']['applicant_email']));
      $contact = htmlentities(trim($_POST['jobs']['applicant_mobile']));
      $message = htmlentities(trim($_POST['jobs']['applicant_detail']));
      $type = htmlentities(trim($_POST['jobs']['applicant_type']));
       
       
    $mail = new PHPMailer();
 
// if we want to send via SMTP

      $mail->Host = "mail.madhubun.in";

        // $mail->isSMTP();

        // $mail->SMTPAuth = true;

        //  $mail->Username = "service@gmail.com";

        //  $mail->Password = "";

        $mail->SMTPSecure = "None";

        $mail->Port = false;
 
        $mail->addAddress('careers@vikaspublishing.com');
 
        $mail->setFrom($email);

        $mail->FromName = $name;

        $mail->Subject = 'Contact on '.$contact;

        $mail->isHTML(true);

        $mail->Body = $message;

         
          if($mail->send()){
              
                  
                    $request = new BookApplication ($args);
                    if(is_uploaded_file($_FILES['applicant_file']['tmp_name'])){
                            $request->set_file($_FILES['applicant_file']);
                            $request->applicant_name = $name;
                            $request->applicant_status = "Y";
                            $result = $request->save_photo('applicant_id');
                         }
                         $result = $request->save('applicant_id');
                         $session->message('Your Enquiry was sent successfully.');
        
                        redirect_to('postresume');
     

  }
             
            
         
 else {

            echo $mail->Errorinfo; 
 
 }

 
    }
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <base href="<?php echo $base_url?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Post Your Resume | Madhuban</title>
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
        
        <!-- Start About Area -->
        <div class="page-about about_area bg--white section-padding--lg">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="content">
                            <h2 class="pages-title">APPLY NOW</h2>
                            <div class="publish-form apply-now">
                              <form method="post" enctype= "multipart/form-data">   
                                <div class="row">
                                    <h6 class="post-resume">Post Your Resume</h6>
                                    <div class="text-center">
                                     <h3 class="text-success"><?php echo display_session_message(); ?></h3>
                                     </div>
                                     <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Job Title: </label>
                                            <input type="text" class="form-cont" name="jobs[applicant_job_id]" value="<?php echo $current->job_title?>" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Job type: </label>
                                            <select class="form-cont form-con" name="jobs[applicant_type]">
                                                <option value="">-type-</option>
                                                <option value="11">Freelance</option>
                                    			<option value="12">Full-Time</option>
                                    			<option value="13">On short-term contract</option>
                                    			<option value="14">On 3 months short-term contract</option>
                                    			<option value="15">On 6 months short-term contract</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Department: </label>
                                            <select class="form-cont form-con" name="jobs[applicant_department]">
                                                <option value="">-Department-</option>
                                    		    <option value="21">Accounts</option>
                                    			<option value="22">Customer Services</option>
                                    			<option value="23">Editorial</option>
                                    			<option value="24">Human Resource</option>
                                    			<option value="25">IT</option>
                                    			<option value="26">Operations</option>
                                    			<option value="27">Production</option>
                                    			<option value="28">Sales &amp; Marketing</option>
                                    			<option value="29">Support Services</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Experience: </label>
                                            <select class="form-cont form-con" name="jobs[applicant_exp]">
                                                    <option selected="selected" value="0">Fresher</option>
                                        		 	<option value="1">1 Year</option>
                                        			<option value="2">2 Years</option>
                                        			<option value="3">3 Years</option>
                                        			<option value="4">4 Years</option>
                                        			<option value="5">5 Years</option>
                                        			<option value="6">6 Years</option>
                                        			<option value="7">7 Years</option>
                                        			<option value="8">8 Years</option>
                                        			<option value="9">9 Years</option>
                                        			<option value="10">10 Years</option>
                                        			<option value="11">11 Years</option>
                                        			<option value="12">12 Years</option>
                                        			<option value="13">13 Years</option>
                                        			<option value="14">14 Years</option>
                                        			<option value="15">15 Years</option>
                                        			<option value="99">15+ Years</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Qualification: </label>
                                            <select class="form-cont form-con" name="jobs[applicant_qualification]">
                                                <option value="">-Qualification-</option>
                                    		    <option value="31">Graduation</option>
                                    			<option value="32">Post Graduation</option>
                                    			<option value="33">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Specialization: </label>
                                            <textarea type="text" class="form-cont" name="jobs[applicant_specialization]"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Name: </label>
                                            <input type="text" class="form-cont" name="jobs[applicant_name]" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Email: </label>
                                            <input type="text" class="form-cont" name="jobs[applicant_email]" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Mobile: </label>
                                            <input type="text" class="form-cont" name="jobs[applicant_mobile]" placeholder="Enter Mobile">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Describe Yourself: </label>
                                            <textarea type="text" class="form-cont" name="jobs[applicant_detail]"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Upload Resume: </label>
                                            <input type="file" class="form-cont" name="applicant_file" placeholder="Enter Image">
                                        </div>
                                    </div>
                                    <input type="hidden" name="jobs[applicant_date_time]" value="<?php echo $time ?>">
                                    <input type="hidden" name="jobs[applicant_status]">
                                    <div class="col-lg-6 mt-4">
                                     <div class="publish-submit" style="    margin-top: 7px;">
                                        <button type="submit" name="submit" class="custom-btn btn-5">Submit</button>
                                     </div>
                                    </div>

                                   
                                </div>
                             </form> 
                            </div>
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
</body>

</html>