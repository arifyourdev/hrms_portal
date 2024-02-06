<?php require_once "../private/initialize.php";

if(is_post_request()){

    $id = $_POST['id'];
    $board = Board::delete_board($id);
 }else{
    redirect_to($admin_base_url);
}
?>