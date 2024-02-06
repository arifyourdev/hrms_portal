<?php require_once 'private/initialize.php';
// require_login();


if(!isset($_GET['id'])) {
    redirect_to('add_blog');
  }

$blog_id = $_GET['id'];
$blog = Blog::find_by_id($blog_id);
  if($blog == false){
      redirect_to(url_for('add_blog'));
    }  

if(is_post_request()) {

$name = htmlentities($database->escape_string($_POST['blog']['title']));
$path = $blog->picture_path();
$args = $_POST['blog'];
$blog->merge_attributes($args);
if(is_uploaded_file($_FILES['image']['tmp_name'])){
    $blog->set_file($_FILES['image']);
    unlink($path);
    $blog->title = $name;
    // $blog->status = "Y";
    $result = $blog->save_photo('id');
 }
 else {
    $blog->title = $name;
    // $blog->status = "Y";
    $result = $blog->save('id');

 }


if($result === true) {
	$session->message('The Blog was Updated successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
redirect_to(url_for('blog'));
}
else {
	// show errors 
	die(mysqli_error($database));

  }


}
else {
    // display the form
    $blog = new Blog;
  }
?>
<!doctype html>
<html class="no-js " lang="en">
    <base href="<?php echo $base_url_admin; ?>">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>Edit Blog | Madhubunbooks</title>
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
                                <h6 class="card-title m-0">Edit Blog</h6>
                                <div class="dropdown morphing scale-left">
                                    <a href="blog" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i>Blog List</a>
                                 </div>
                            </div>
                          <div class="text-center">
                            <?php echo display_session_message(); ?>
                          </div>
                            <div class="card-body">
                                <form  method="post" enctype="multipart/form-data" action="edit_blog/<?php echo $blog_id ?>">
                                    <div class="row g-3">
                                        <?php include "form/blog_form.php" ?>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary" name="submit">Update Blog</button>
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
      <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
     <script>
           CKEDITOR.replace('blog[detail]');
     </script>
    <!-- Plugin Js -->

    <!-- Jquery Page Js -->



</body>

</html>