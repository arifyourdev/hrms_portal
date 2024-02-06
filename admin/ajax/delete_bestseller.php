<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $bestseller = Bestseller::find_by_id($id);

   $path = $bestseller->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
    $delete = Bestseller::delete_bestseller($id);
 } else {
   redirect_to($base_url);
}
?>