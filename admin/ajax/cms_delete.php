<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $cms = BookCms::find_by_custom_id('cms_id',$id);

   $path = $cms->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
    $delete = BookCms::delete_cms($id);
 } else {
   redirect_to($admin_base_url);
}
?>