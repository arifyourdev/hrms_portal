<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $event = PastEvent::find_by_id($id);

   $path = $event->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
    $delete = PastEvent::delete_event($id);
 } else {
   redirect_to($base_url);
}
?>