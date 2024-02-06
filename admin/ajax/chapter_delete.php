<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $news = BookChapterLog::find_by_custom_id('clog_id',$id);
   
    $delete = BookChapterLog::delete_chapter($id);
} else {
   redirect_to($admin_base_url);
}
?>