<?php
 require 'private/initialize.php';
 require_login();
 
 if(!isset($_GET['id'])) {
    redirect_to('add_magazine');
  }

$magazine_id = $_GET['id'];
$magazine = BookMagazine::find_by_custom_id('magazine_id',$magazine_id);
  if($magazine == false){
      redirect_to(url_for('add_magazine'));
    }
 if(is_post_request()) {

$name = htmlentities($database->escape_string($_POST['magazine']['magazine_title']));
$path = $magazine->picture_path();
$args = $_POST['magazine'];
$magazine->merge_attributes($args);
if(is_uploaded_file($_FILES['magazine_image']['tmp_name'])){
    $magazine->set_file($_FILES['magazine_image']);
    unlink($path);
    $magazine->magazine_title = $name;
    // $magazine->magazine_status = "Y";
    $result = $magazine->save_photo('magazine_id');
 }
  if(is_uploaded_file($_FILES['magazine_pdf']['tmp_name'])){
    $magazine->set_pdf($_FILES['magazine_pdf']);
    unlink($path);
    $magazine->magazine_title = $name;
    $result = $magazine->save_pdf('magazine_id');
 }
 else {
    $magazine->magazine_title = $name;
    // $magazine->magazine_status = "Y";
    $result = $magazine->save('magazine_id');

 }


if($result === true) {
	$session->message('The Magazine was Updated successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
redirect_to(url_for('magazine'));
}
else {
	// show errors 
	die(mysqli_error($database));

  }


}
else {
    // display the form
    $magazine = new BookMagazine;
  }

?>
<!doctype html>
<html class="no-js " lang="en">
 <head>
     <base href="<?php echo $base_url_admin?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>Update Magazine | Madhubunbooks</title>
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
                                <h6 class="card-title m-0">Update Magazine</h6>
                                <div class="dropdown morphing scale-left">
                                    <a href="magazine" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i>List</a>
                                 </div>
                            </div>
                          <div class="text-center">
                            <?php echo display_session_message(); ?>
                          </div>
                            <div class="card-body">
                                <form  method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <?php include "form/megazine_form.php" ?>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary" name="submit">Update Magazine</button>
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