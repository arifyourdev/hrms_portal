<?php


function require_login() {
    global $session;
    if(!$session->is_logged_in()){
    redirect_to(url_for('login'));
}
else {
    // Do nothing, let the rest of the page proceed
}
}


function user_login() {
  global $session;
  if (isset($_SESSION['user_id']) || isset($_COOKIE['uk_sdadsa'])) {

    return true;
  } else {
    // Do nothing, let the rest of the page proceed
    redirect_to('login');
  }
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}


function display_session_message() {
    global $session;
    $msg = $session->message();
  if(isset($msg) && $msg != '') {
      $session->clear_message();
    return h($msg);
  }
}
?>
