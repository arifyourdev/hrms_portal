<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $series = BookSeries::find_by_custom_id('series_id',$id);

   $path = $series->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
  $path = $series->picture_pdf();
   
  $file_path = "../$path";
  unlink($file_path);
  
  $path = $series->picture_b_pdf();
   
  $file_path = "../$path";
  unlink($file_path);
   
  $delete = BookSeries::delete_series($id);
} else {
   redirect_to($admin_base_url);
}
?>