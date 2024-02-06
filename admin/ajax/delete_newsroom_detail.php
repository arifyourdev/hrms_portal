<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $detail = NewsroomDetail::find_by_id($id);

   $path = $detail->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
    $delete = NewsroomDetail::delete_news_details($id);
 } else {
   redirect_to($base_url);
}
?>