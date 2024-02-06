<?php 
require_once 'private/initialize.php';
$msg ="";
if(is_post_request()) {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
  
    // Validations
    if(is_blank($username)) {
      $errors[] = "Username cannot be blank.";
    }
    if(is_blank($password)) {
      $errors[] = "Password cannot be blank.";
    }
  
    // if there were no errors, try to login
    if(empty($errors)) {
      $admin = Admin::find_by_username($username);
      // test if admin found and password is correct
      if($admin != false && $admin->verify_password($password)) {
        // Mark admin as logged in
          $session->login($admin);
        
          redirect_to(url_for('index'));
      } else {
        // username not found or password does not match
        $errors[] = "Log in was unsuccessful.";
      }
  
    }
  
  }
?>
<!doctype html>
<html class="no-js " lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>Login</title>
    <link rel="icon" href="assets/images/logo.svg" type="image/x-icon"> <!-- Favicon-->
     <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/luno.style.min.css">
</head>

<body id="layout-1" data-luno="theme-blue">

    <!-- start: body area -->
    <div class="wrapper">
        
        <!-- start: page body -->
        <div class="page-body auth px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
            <div class="container-fluid">
                    
                <div class="row">
                    <div class="col-lg-6 mx-auto align-items-center">
                        <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
                            <!-- Form -->
                            <form class="row g-3" method="POST" action="">
                                  <div class="text-center">
                                        <h5 style="color: darkgreen;"><?php echo $msg ?></h5>
                                  </div>
                                <div class="col-12 text-center mb-5">
                                    <h1>Login</h1>
                                    <span class="text-muted">Please Enter Your Information!</span>
                                </div>
                                 <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control form-control-lg" name="username" placeholder="Enter User Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <div class="form-label">
                                            <span class="d-flex justify-content-between align-items-center">
                                                Password
                                                <a class="text-primary" href="">Forgot Password?</a>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg" name="password" placeholder="***************">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button class="btn btn-lg btn-block btn-dark lift text-uppercase" name="login" type="submit" title="">Login </button>
                                </div>
                             </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div> <!-- End Row -->

            </div>
        </div>

    </div>

  

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>

<!-- Jquery Page Js -->

</body>
 </html>