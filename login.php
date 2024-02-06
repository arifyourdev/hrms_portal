<?php
require_once "admin/private/initialize.php";
$msg ="";
if(isset($_POST['login'])) 
{
    $user_type = htmlentities($database->escape_string($_POST['user_type']));
    $email_mobile = htmlentities($database->escape_string($_POST['email_mobile']));
    $password = htmlentities($database->escape_string($_POST['password']));
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LcCS6whAAAAAF0mqEqoOS1EezhOZnU3lPF2ZJsZ';
    $recaptcha_response = $_POST['recaptcha_response'];
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' .$recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

     if(is_blank($email_mobile)) {
        $errors[] = "Email cannot be blank.";
    }

    if(is_blank($password)) {
        $errors[] = "Password cannot be blank.";
    }
 
        $login = BookUserMaster::find_by_both($email_mobile);
    
        if($login->user_type == $user_type)
        {
            if($login->user_password == $password) 
            {
                $session->log_user($login);
                $_SESSION['user_login_type'] = $user_type;
                 header('location:index');
            } 
            elseif($login == false) 
            {
                $msg= 'Email OR Phone Number not matched';
            } 
            else 
            {
               $msg= 'Password not match';
            }
        }
        else
        {
            $msg= 'Selected Type is not correct';
        }

    


}
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
     <?php include 'includes/head.php' ?>
     <script src="https://www.google.com/recaptcha/api.js?render=6LcCS6whAAAAAJdrAmink08bVVbqnL_NB69GWMmK"></script>
     <script>
      function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6LcCS6whAAAAAJdrAmink08bVVbqnL_NB69GWMmK', {action: 'login'}).then(function(token) {
              // Add your logic to submit to your backend server here.
              var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
          });
        });
      }
  </script>
</head>

<body>
 <!-- Main wrapper -->
<div class="wrapper" id="wrapper">
    <!-- Header -->
   <?php include 'includes/header.php' ?>
    <!-- //Header -->
    <!-- Start Search Popup -->
    <div class="box-search-content search_active block-bg close__top">
        <form id="search_mini_form" class="minisearch" action="#">
            <div class="field__search">
                <input type="text" placeholder="Search entire store here...">
                <div class="action">
                    <a href="#"><i class="zmdi zmdi-search"></i></a>
                </div>
            </div>
        </form>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>
    <!-- End Search Popup -->
    <!-- Start My Account Area -->
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 mx-auto mt-5">
                    <div class="my__account__wrapper">
                        <div class="text-center text-danger">
                            <h4><?php echo $msg ?> </h4>
                         </div>
                         <h3 class="account__title">Login</h3>
                         <form method="post" action="">
                            <div class="account__form">
                                <div class="input__box">
                                    <label>Type <span>*</span></label>
                                    <select type="text" name="user_type" class="type-select" class="input-control" required>
                                        <option value="">-Select-</option>
                                        <option value="2">Student</option>
                                        <option value="2">Parent</option>
                                        <option value="1">Teacher</option>
                                        <option value="2">Other</option>
                                     </select>
                                </div>
                                <div class="input__box">
                                    <label>Email <span>*</span></label>
                                    <input type="text" class="input-control" name="email_mobile" placeholder="mail@gmail.com" required>
                                </div>
                                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                                <div class="input__box">
                                    <label>Password<span>*</span></label>
                                    <input type="password" class="input-control" name="password" Placeholder="Min 8 Character">
                                </div>
                                <div class="login-r">
                                    <div class="login-chek">
                                        <input type="checkbox" class="checkboxx">
                                        <p>Remember Me</p>
                                    </div>
                                    <a href="forgot_password" class="login-fp">Forget Password?</a>
                                </div>
                                <div class="form__btns mt-3">
                                    <button type="submit" name="login" class="custom-btn btn-5 login-submit">Login</button>
                                 </div>
                                 <div class="login-nrt mt-3">
                                   <p>Not registered yet?<a class="" href="register"> Create a Account</a></p>
                                 </div>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
        </div>
    </section>
    <!-- End My Account Area -->
    <!-- Footer Area -->
  <?php include 'includes/footer.php' ?>
    <!-- //Footer Area -->

</div>
<!-- //Main wrapper -->

 <?php include 'includes/foot.php' ?>

</body>
 </html>