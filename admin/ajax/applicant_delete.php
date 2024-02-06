<?php require_once "../private/initialize.php";

if(is_post_request()){

    $id = $_POST['id'];
    $appl = BookApplication::delete_applicant($id);
 }else{
    redirect_to($admin_base_url);
}
?>