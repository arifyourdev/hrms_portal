<?php
require_once "../admin/private/initialize.php";
$user_id = $_SESSION['user_id'];
if(is_post_request())
{
$check_book_fav = Bookfavourite::find_by_user_book($user_id,$_POST['book_id']);
if($check_book_fav)
{
    $delete_fav = Bookfavourite::delete_fav($user_id,$book_id);
}
else
{
    $book_id = htmlentities($database->escape_string($_POST['book_id']));
    
    if(is_post_request()) {
        $add_fav = new Bookfavourite();
        $add_fav->fav_book_id = $book_id;
        $add_fav->fav_user_id = $user_id;
        $add_fav->fav_date = $fav_date;
        $result = $add_fav->save('fav_id');
    }
    if($result === true) {
	$session->message('The Book Was Added Successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
	redirect_to('favourite_books');
}
else {
	// show errors 
	$session->message(join("<br>", $add_fav->errors));

  }
    
}
}



?> 