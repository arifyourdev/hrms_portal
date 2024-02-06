<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $blogbanner = Allbanner::find_by_id($id);

   $path = $blogbanner->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
    $delete = Allbanner::delete_allbanner($id);
 } else {
   redirect_to($base_url);
}
?>