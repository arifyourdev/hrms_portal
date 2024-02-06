<?php require_once "../private/initialize.php";

if (is_post_request()) {

    $id = $_POST['id'];

   $contact = Contact::find_by_id($id);

   $path = $contact->picture_path();
   
   $file_path = "../$path";
   unlink($file_path);
   
    $delete = Contact::delete_contact($id);
 } else {
   redirect_to($base_url);
}
?>