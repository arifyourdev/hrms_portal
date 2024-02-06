<?php
 require 'private/initialize.php';
 require_login();
 
 if(!isset($_GET['id'])) {
    redirect_to('add_jobs');
  }

$jobs_id = $_GET['id'];
$jobs = BookJob::find_by_custom_id('jobs_id',$jobs_id);
  if($jobs == false){
      redirect_to(url_for('add_jobs'));
    }  
 if (is_post_request()) {
     
    $name = htmlentities($database->escape_string($_POST['jobs']['jobs_title']));
    $args = $_POST['jobs'];
    $jobs->merge_attributes($args);
    $jobs->jobs_title = $name;
    // $jobs->jobs_status = "Y";
    $result = $jobs->save('jobs_id');
    
    if($result === true) {
	$session->message('The Jobs created successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
       redirect_to(url_for('jobs'));
 }
 else {
	// show errors 
	$session->message(join("<br>", $jobs->errors));

  }
     
} else {
    // display the form
    $jobs = new BookJob;
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
    <title>Update Jobs | Madhubunbooks</title>
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
                                <h6 class="card-title m-0">Update Jobs</h6>
                                 <div class="dropdown morphing scale-left">
                                    <a href="jobs" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i>List</a>
                                 </div>
                            </div>
                          <div class="text-center text-success">
                            <?php echo display_session_message(); ?>
                          </div>
                            <div class="card-body">
                                <form  method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <?php include "form/jobs_form.php" ?>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary" name="submit">Update Jobs</button>
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
           CKEDITOR.replace('jobs[jobs_detail]');
     </script>

    <!-- Jquery Page Js -->

</body>

</html>