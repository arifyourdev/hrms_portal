<?php require_once "../private/initialize.php";

if(is_post_request()){

    $id = $_POST['id'];
    $epd = BookSubscription::delete_address($id);
 }else{
    redirect_to($admin_base_url);
}
?>