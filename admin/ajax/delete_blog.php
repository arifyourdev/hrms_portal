<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $blog = Blog::find_by_id($id);

   $path = $blog->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
    $delete = Blog::delete_blog($id);
 } else {
   redirect_to($base_url);
}
?>