<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $news = BookMagazine::find_by_custom_id('magazine_id',$id);

   $path = $news->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
   $path = $news->pdf_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
  $delete = BookMagazine::delete_magazine($id);
} else {
   redirect_to($admin_base_url);
}
?>