<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $news = BookNews::find_by_custom_id('news_id',$id);

   $path = $news->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
    $delete = BookNews::delete_news($id);
} else {
   redirect_to($admin_base_url);
}
?>