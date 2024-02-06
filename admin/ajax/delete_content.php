<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $content = DigitalContent::find_by_id($id);

   $path = $content->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
    $delete = DigitalContent::delete_content($id);
 } else {
   redirect_to($base_url);
}
?>