<?php require_once 'private/initialize.php';
// require_login();


if(!isset($_GET['id'])) {
    redirect_to('add_testimonial');
  }

$testimonial_id = $_GET['id'];
 $testimonial = BookTestimonial::find_by_custom_id('testimonial_id',$testimonial_id);
  if($testimonial == false){
      redirect_to(url_for('add_testimonial'));
    }  

if(is_post_request()) {

$name = htmlentities($database->escape_string($_POST['testimonial']['testimonial_added_by']));
$path = $testimonial->picture_path();
$args = $_POST['testimonial'];
$testimonial->merge_attributes($args);
if(is_uploaded_file($_FILES['testimonial_image']['tmp_name'])){
    $testimonial->set_file($_FILES['testimonial_image']);
    unlink($path);
    $testimonial->testimonial_added_by = $name;
    // $testimonial->testimonial_status = "Y";
    $result = $testimonial->save_photo('testimonial_id');
 }
 else {
    $testimonial->testimonial_added_by = $name;
    // $testimonial->testimonial_status = "Y";
    $result = $testimonial->save('testimonial_id');

 }



if($result === true) {
	$session->message('The Testimonial was Updated successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
redirect_to(url_for('testimonial'));
}
else {
	// show errors 
	die(mysqli_error($database));

  }


}
else {
    // display the form
    $testimonial = new BookTestimonial;
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
    <title>Update Testimonial | Madhubunbooks</title>
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
                                <h6 class="card-title m-0">Update Testimonial</h6>
                                   <div class="dropdown morphing scale-left">
                                    <a href="testimonial" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i>Testimonial List</a>
                                 </div>
                            </div>
                          <div class="text-center text-success">
                            <?php echo display_session_message(); ?>
                          </div>
                            <div class="card-body">
                                <form  method="post" enctype="multipart/form-data"  action="edit_testimonial/<?php echo $testimonial_id ?>">
                                    <div class="row g-3">
                                        <?php include "form/testimonial_form.php" ?>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary" name="submit">Update Testimonial</button>
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
           CKEDITOR.replace('testimonial[testimonial_detail]');
     </script>

    <!-- Jquery Page Js -->

</body>

</html>