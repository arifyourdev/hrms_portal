<?php require_once "../private/initialize.php";

if(is_post_request()){

    $id = $_POST['id'];
    $newsroom = Newsroom::delete_newsroom($id);
 }else{
    redirect_to($admin_base_url);
}
?>