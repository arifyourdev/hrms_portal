<?php
 require 'private/initialize.php';
 require_login();
 
 
 if (is_post_request()) {
     
    $name = htmlentities($database->escape_string($_POST['subject']['subject_title']));
    $args = $_POST['subject'];
    $subject = new BookSubject ($args);
    $subject->subject_title = $name;
    // $level->lavel_status = "Y";
    $result = $subject->save('subject_id');
    
    if($result === true) {
            $subjectid = $subject->subject_id;
        	$company = preg_replace('/[^A-Za-z0-9\-]/', '-', $name);
			$rand = mt_rand(11111, 99999);
			$url = $company . '-' . $rand;
			$update_sub_url = BookSubject::update_seo_url($url, $subjectid);
		   $subject_id = $product->subject_id;
		     
	$session->message('The Subject created successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
	redirect_to('subject');
 }
 else {
	// show errors 
	$session->message(join("<br>", $subject->errors));

  }
     
} else {
    // display the form
    $subject = new BookSubject;
}

?>
<!doctype html>
<html class="no-js " lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>Add Subject | Madhubunbooks</title>
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
                                <h6 class="card-title m-0">Add Subject</h6>
                                <!--<div class="dropdown morphing scale-left">-->
                                <!--    <a href="#" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i>List</a>-->
                                <!-- </div>-->
                            </div>
                          <div class="text-center">
                            <?php echo display_session_message(); ?>
                          </div>
                            <div class="card-body">
                                <form  method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <?php include "form/subject_form.php" ?>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary" name="submit">Add Subject</button>
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

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->

    <!-- Jquery Page Js -->

</body>

</html>