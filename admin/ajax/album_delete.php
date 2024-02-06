<?php require_once "../private/initialize.php";

if (is_post_request()) {

  $id = $_POST['id'];

   $news = BookAlbum::find_by_custom_id('album_id',$id);

   $path = $news->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
 $delete = BookAlbum::delete_album($id);
} else {
   redirect_to($admin_base_url);
}
?>