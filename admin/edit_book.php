<?php require_once 'private/initialize.php';
// require_login();


if(!isset($_GET['id'])) {
    redirect_to('add_book');
  }

$book_id = $_GET['id'];
$book = BookMaster::find_by_custom_id('book_id',$book_id);
  if($book == false){
      redirect_to(url_for('add_book'));
    }  

if(is_post_request()) {

$name = htmlentities($database->escape_string($_POST['books']['book_title']));
if(isset($_POST['books']['book_as_ebook']))
{
    $status = '1';
}
else
{
    $status = '0';
}
if(isset($_POST['books']['book_as_resource']))
{
    $r_status = '1';
}
else
{
    $r_status = '0';
}
if(isset($_POST['books']['book_as_new']))
{
    $status3 = '1';
}
else
{
    $status3 = '0';
}
if(isset($_POST['books']['book_new_release']))
{
    $status4 = '1';
}
else
{
    $status4 = '0';
}

$path = $book->picture_path();
$args = $_POST['books'];
$book->merge_attributes($args);
if(is_uploaded_file($_FILES['book_image']['tmp_name'])){
    $book->set_file($_FILES['book_image']);
    unlink($path);
    $book->book_title = $name;
    $book->book_as_ebook = $status;
    $book->book_as_resource = $r_status;
    $book->book_as_new = $status3;
    $book->book_new_release = $status4;
    $result = $book->save_photo('book_id');
 }
 else {
    $book->book_title = $name;
    $book->book_as_ebook = $status;
    $book->book_as_resource = $r_status;
    $book->book_as_new = $status3;
    $book->book_new_release = $status4;
    $result = $book->save('book_id');

 }


if($result === true) {
	$session->message('The Book was Updated successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
redirect_to(url_for('book_list'));
}
else {
	// show errors 
	die(mysqli_error($database));

  }


}
else {
    // display the form
    $book = new BookMaster;
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
    <title>update Book | Madhubunbooks</title>
    <link rel="icon" href="assets/images/logo.svg" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/luno.style.min.css">
</head>
<style>
    .checkboxx{
    width: 20px;
    height: 20px;
    margin: 0px 10px;
    position: relative;
    top: 4px;
    }
</style>
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
                                <h6 class="card-title m-0">Update Book</h6>
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
                                        <?php include "form/book_form.php" ?>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary" name="submit">Update Book</button>
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
           CKEDITOR.replace('books[book_detail]');
     </script>
      <script>
           CKEDITOR.replace('books[book_supporting_material]');
     </script>
     <script>
    // Check
document.getElementById("checkbox").checked = true;

// Uncheck
document.getElementById("checkbox").checked = false;
</script>
 <script>
           CKEDITOR.replace('books[salient_features]');
     </script>
    <!-- Plugin Js -->

    <!-- Jquery Page Js -->

</body>

</html>