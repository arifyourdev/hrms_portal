<?php
 require 'private/initialize.php';
 if(!isset($_GET['id'])) {
    redirect_to('add_board');
  }

$board_id = $_GET['id'];
$board = Board::find_by_id($board_id);
  if($board == false){
      redirect_to(url_for('add_board'));
    }  
 if (is_post_request()) {
     
    $name = htmlentities($database->escape_string($_POST['board']['board_title']));
    $args = $_POST['board'];
    $board->merge_attributes($args);
    $board->board_title = $name;
    // $level->lavel_status = "Y";
    $result = $board->save('id');
    
    if($result === true) {
	$session->message('The Book Board Updated successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
       redirect_to(url_for('board-list'));
 }
 else {
	// show errors 
	$session->message(join("<br>", $board->errors));

  }
     
} else {
    // display the form
    $board = new Board;
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
    <title>Update Books Board | Madhubunbooks</title>
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
                                <h6 class="card-title m-0">Update Books Board</h6>
                                <div class="dropdown morphing scale-left">
                                    <a href="board-list" data-bs-toggle="tooltip" title="Board List"><i class="icon-size-fullscreen"></i>Board List</a>
                                 </div>
                            </div>
                          <div class="text-center">
                            <?php echo display_session_message(); ?>
                          </div>
                            <div class="card-body">
                                <form  method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <?php include "form/board_form.php" ?>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary" name="submit">Update Board</button>
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