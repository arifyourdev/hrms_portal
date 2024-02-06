<?php
 require 'private/initialize.php';
 require_login();
 
 if(!isset($_GET['id'])) {
    redirect_to('edit_etm');
  }

$mail_id = $_GET['id'];
$mail = EmailtemplateMaster::find_by_custom_id('mail_id',$mail_id);
  if($mail == false){
      redirect_to(url_for('edit_etm'));
    }  
 if (is_post_request()) {

   
      
    $args = $_POST['mail'];
    $mail->merge_attributes($args);
    $mail->mail_message = $_POST['mail_message'];  
    // $mail->message = $_POST['message'];  
     // $level->lavel_status = "Y";
    $result = $mail->save('mail_id');
     if($result === true) {
	$session->message('Update Successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
       redirect_to(url_for('mailtemplate'));
 }
 else {
	// show errors 
	$session->message(join("<br>", $mail->errors));

  }
     
} else {
    // display the form
    $mail = new EmailtemplateMaster;
}

?>
<!doctype html>
<html class="no-js " lang="en">
      <base href="<?php echo $base_url_admin ?>">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>Update mailtemplate | Madhubunbooks</title>
    <link rel="icon" href="assets/images/logo.svg" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/luno.style.min.css">
</head>

<body class="layout-1" data-luno="theme-black">

    <!-- start: sidebar -->
    <?php include "include/side-bar.php" ?>
    <!-- start: body area -->
    <div class="wrapper">

        <!-- start: page header -->
        <?php include "include/top-header.php" ?>

        <!-- Body: Body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Update Mailtemplate</h6>
                                <div class="dropdown morphing scale-left">
                                    <a href="mailtemplate" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i>List</a>
                                 </div>
                            </div>
                          <div class="text-center">
                            <?php echo display_session_message(); ?>
                          </div>
                            <div class="card-body">
                                <form  method="post" action="edit_etm?id=<?php echo $mail_id ?>">
                                    <div class="row g-3">
                                        <?php include "form/mailtemplate_form.php" ?>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary" name="submit">Update Mailtemplate</button>
                                            <button type="button" class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div> <!-- Row end  -->

            </div>
        </div>

        <!-- start: page footer -->
        <?php include "include/footer.php" ?>

    </div>

    <script src="assets/bundles/libscripts.bundle.js"></script>

    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
      
     <script>
           CKEDITOR.replace('mail_message');
     </script>
      <script>
           CKEDITOR.replace('message');
     </script>

</body>

</html>