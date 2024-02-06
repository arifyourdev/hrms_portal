<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $subcontent = SubDigitalContent::find_by_id($id);

   $path = $subcontent->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
    $delete = SubDigitalContent::delete_subcontent($id);
 } else {
   redirect_to($base_url);
}
?>