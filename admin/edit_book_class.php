<?php
 require 'private/initialize.php';
 if(!isset($_GET['id'])) {
    redirect_to('add_book_class');
  }

$class_id = $_GET['id'];
$b_class = BookClass::find_by_custom_id('class_id',$class_id);
  if($b_class == false){
      redirect_to(url_for('add_book_class'));
    }  
 if (is_post_request()) {
     
    $name = htmlentities($database->escape_string($_POST['b_class']['class_title']));
    $args = $_POST['b_class'];
    $b_class->merge_attributes($args);
    $b_class->class_title = $name;
    // $level->lavel_status = "Y";
    $result = $b_class->save('class_id');
    
    if($result === true) {
	$session->message('The Book Class Updated successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
       redirect_to(url_for('book_class'));
 }
 else {
	// show errors 
	$session->message(join("<br>", $b_class->errors));

  }
     
} else {
    // display the form
    $b_class = new BookClass;
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
    <title>Update level | Madhubunbooks</title>
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
                                <h6 class="card-title m-0">Update Form</h6>
                                <div class="dropdown morphing scale-left">
                                    <a href="book_class" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i>List</a>
                                 </div>
                            </div>
                          <div class="text-center">
                            <?php echo display_session_message(); ?>
                          </div>
                            <div class="card-body">
                                <form  method="post" action="edit_book_class/<?php echo $class_id ?>">
                                    <div class="row g-3">
                                        <?php include "form/book_class_form.php" ?>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary" name="submit">Update Class</button>
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