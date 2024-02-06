<?php
require_once "admin/private/initialize.php";
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Feedback | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include 'includes/head.php' ?>
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
         
        <!-- Start About Area -->
        <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                    <div class="wn__sidebar">
                         <!-- Start Single Widget -->
                        <aside class="widget category_widget">
                            <h3 class="widget-titles">Feedback</h3>
                            <ul class="contact-us-ul">
                                <li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="contact-us">Reach Us</a></li>
                                <li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="feedback">Feedback</a></li>
                                <li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="workshop-teacher-training">Workshop/Teacher Training</a></li>
                              </ul>
                        </aside>
                        <!-- End Single Widget -->
                         
                    </div>
                </div>
                <div class="col-lg-9 col-12 order-1 order-lg-2">
                     <div class="blog-page">
                        <p>We at Madhubun Educational Books attempt in attaining perfection. Our Feedback Form enables you to connect with us and assist us in what we aim to achieve. 
                              Share your ideas so that we can do our utmost to create books with better thoughts.</p>
                        <div class="publish-form mt-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Full Name: <span>*</span></label>
                                        <input type="text" class="form-cont" name="name" placeholder="Enter Full Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Email: <span>*</span></label>
                                        <input type="text" class="form-cont" name="email" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Mobile: <span>*</span></label>
                                        <input type="text" class="form-cont" name="mobile" placeholder="Enter Mobile">
                                    </div>
                                </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Message: <span>*</span></label>
                                        <textarea type="text" class="form-cont" name="message" placeholder="Enter Message"></textarea>
                                    </div>
                                </div>
                                 
                                <div class="publish-submit">
                                    <button type="submit" name="submit" class="custom-btn btn-5">Submit</button>
                                </div>
                            </div>
                        </div>
                     </div>
                    
                </div>
            </div>
        </div>
    </div>
        <!-- End About Area -->

        <!-- Footer Area -->
        <?php include 'includes/footer.php' ?>
        <!-- //Footer Area -->

    </div>
    <!-- //Main wrapper -->
    <!-- JS Files -->
    <?php include 'includes/foot.php' ?>
</body>

</html>