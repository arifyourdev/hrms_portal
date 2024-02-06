<?php require_once "../private/initialize.php";

if(is_post_request()){

    $id = $_POST['id'];
    $level = BooksRrequest::approved_request($id);
 }else{
    redirect_to($admin_base_url);
}
?>