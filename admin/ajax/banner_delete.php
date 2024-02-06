<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $banner = Banner::find_by_custom_id('banners_id',$id);

   $path = $banner->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
    $delete = Banner::delete_banner($id);
 } else {
   redirect_to($base_url);
}
?>