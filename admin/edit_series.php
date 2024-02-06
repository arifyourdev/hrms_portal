<?php require_once 'private/initialize.php';
require_login();

if(!isset($_GET['id'])) {
    redirect_to('add_series');
}

$series_id = $_GET['id'];
$series = BookSeries::find_by_custom_id('series_id',$series_id);
if($series == false){
  redirect_to(url_for('add_series'));
}  

if(is_post_request()) {
$series_class = $_POST['series_class'];

$name = htmlentities($database->escape_string($_POST['series']['series_title']));

if($_POST['series']['series_as_resource'])
{
    $status = '1';
}
else
{
    $status = '0';
    
}
if($_POST['series']['series_as_new'])
{
    $status2 = '1';
}
else
{
    $status2 = '0';
 }
 if($_POST['series']['series_as_new'])
{
    $status2 = '1';
}
else
{
    $status2 = '0';
 }
 if($_POST['series']['book_as_ebook'])
{
    $status3 = '1';
}
else
{
    $status3 = '0';
 }
$path = $series->picture_path();
$args = $_POST['series'];
$series->merge_attributes($args);
if(is_uploaded_file($_FILES['series_image']['tmp_name'])){
    $series->set_file($_FILES['series_image']);
    unlink($path);
    $series->series_title = $name;
    $series->series_as_resource = $status;
    $series->series_as_new = $status2;
    $series->book_as_ebook = $status3;
    $result = $series->save_photo('series_id');
 }
 if(is_uploaded_file($_FILES['series_brochure']['tmp_name'])){
    $series->set_brochure($_FILES['series_brochure']);
    unlink($path);
    $series->series_title = $name;
    $series->series_as_resource = $status;
    $series->series_as_new = $status2;
    $series->book_as_ebook = $status3;
    $result = $series->save_brochure('series_id');
 }
 
 if(is_uploaded_file($_FILES['sample_pdf']['tmp_name'])){
    $series->set_pdf($_FILES['sample_pdf']);
    unlink($path);
    $series->series_title = $name;
    $series->series_as_resource = $status;
    $result = $series->save_pdf('series_id');
 }
 
 else {
    $series->series_title = $name;
    // $banner->banners_status = "Y";
    $series->series_as_resource = $status;
    $result = $series->save('series_id');

 }


if($result === true) 
{
    $delete_series_class = BookSeriesClass::delete_class($series->series_id);
    foreach($series_class as $key => $class_data)
    {
        $request = new BookSeriesClass();
        $request->sc_series_id = $series->series_id;
        $request->sc_class_id = $class_data;
        $request->sc_status= 'Y';
        $result = $request->save('sc_id');
    }
    
	$session->message('The Series was Updated successfully.');
    redirect_to(url_for('series_list'));
}
else {
	// show errors 
	die(mysqli_error($database));

  }


}
else {
    // display the form
    $series = new BookSeries;
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
    <title>Update Series | Madhubunbooks</title>
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
                                <h6 class="card-title m-0">Update Series</h6>
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
                                        <?php include "form/series_form.php" ?>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary" name="submit">Update Series</button>
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
           CKEDITOR.replace('series[series_detail]');
     </script>
      <script>
           CKEDITOR.replace('series[series_author]');
     </script>
     <script>
           CKEDITOR.replace('series[series_about_author]');
     </script>
      <script>
           CKEDITOR.replace('series[series_about_series]');
     </script>
     <script>
           CKEDITOR.replace('series[series_salient_feature]');
     </script>
     <script>
           CKEDITOR.replace('series[series_supporting_material]');
     </script>
       <script>
           CKEDITOR.replace('series[series_ebook_detail]');
     </script>
    <!-- Plugin Js -->

    <!-- Jquery Page Js -->

</body>

</html>