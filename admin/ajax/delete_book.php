<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $news = BookMaster::find_by_custom_id('book_id',$id);

   $path = $news->picture_path();
   $file_path = "../$path";
   unlink($file_path);

   $path = $news->picture_pdf();
   $file_path = "../$path";
   unlink($file_path);
   
   $path = $news->picture_w_pdf();
   $file_path = "../$path";
   unlink($file_path);
   
   $path = $news->picture_w_pdf2();
   $file_path = "../$path";
   unlink($file_path);
    $path = $news->picture_w_pdf3();
  $file_path = "../$path";
   unlink($file_path);
   
    $delete = BookMaster::delete_book($id);
} else {
   redirect_to($admin_base_url);
}
?>