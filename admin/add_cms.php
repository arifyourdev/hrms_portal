<?php
 require 'private/initialize.php';
 require_login();
 
$page="add_banner"; 

if(is_post_request()) {

$name = htmlentities($database->escape_string($_POST['cms']['cms_title']));


$args = $_POST['cms'];
$cms = new BookCms($args);
if(is_uploaded_file($_FILES['cms_image']['tmp_name'])){
    $cms->set_file($_FILES['cms_image']);
    $cms->cms_title = $name;
     $result = $cms->save_photo('cms_id');
 }
 else {
    $cms->cms_title = $name;
     $result = $cms->save('cms_id');

 }


if($result === true) {
	$session->message('The Cms was created successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
	redirect_to('cms');
}
else {
	// show errors 
	$session->message(join("<br>", $cms->errors));

  }


}
else {
    // display the form
    $cms = new BookCms;
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
    <title>Add CMS | Madhubunbooks</title>
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
                                <h6 class="card-title m-0">Add CMS</h6>
                                 
                            </div>
                          <div class="text-center text-success">
                            <?php echo display_session_message(); ?>
                          </div>
                            <div class="card-body">
                                <form  method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <?php include "form/cms_form.php" ?>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary" name="submit">Add CMS</button>
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
    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
     <script>
           CKEDITOR.replace('cms[cms_detail]');
     </script>

    <!-- Jquery Page Js -->

</body>

</html>