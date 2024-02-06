<?php require_once "../private/initialize.php";

if(is_post_request()){

    $id = $_POST['id'];
    $news = WebinarsRegister::delete_w($id);
 }else{
    redirect_to($admin_base_url);
}
?>