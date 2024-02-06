<?php require_once "../private/initialize.php";

if(is_post_request()){

    $id = $_POST['id'];
    $test = BookTestimonial::delete_testimonial($id);
 }else{
    redirect_to($admin_base_url);
}
?>