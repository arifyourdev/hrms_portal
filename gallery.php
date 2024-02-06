<?php
require_once "admin/private/initialize.php";
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Gallery |Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <?php include 'includes/head.php' ?>
</head>

<body>
  
<!-- Main wrapper -->
<div class="wrapper" id="wrapper">
    <!-- Header -->
    <?php include 'includes/header.php'?>
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
    <!-- Start Gallery Area -->
    <section class="wn__team__area pt--40 pb--75 bg--white mt-4">
        <div class="container">
            <div class="row">
                <!-- Start Single Team -->
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="wn__team text-center gallery_brdr">
                        <div class="thumb">
                            <img src="img/album-thumb-32.jpg" alt="Team images">
                        </div>
                        <div class="contents">
                            <h6><a href="">ALICE KIM</a> </h6>
                            <p><a href=""> Co-Founder</a></p>
                         </div>
                    </div>
                </div>
                <!-- End Single Team -->
                <!-- Start Single Team -->
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="wn__team text-center gallery_brdr">
                        <div class="thumb">
                            <img src="img/album-thumb-31.jpeg" alt="Team images">
                        </div>
                        <div class="contents">
                            <h6><a href="">ALICE KIM</a> </h6>
                            <p><a href=""> Co-Founder</a></p>
                             
                        </div>
                    </div>
                </div>
                <!-- End Single Team -->
                <!-- Start Single Team -->
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="wn__team text-center gallery_brdr">
                        <div class="thumb">
                            <img src="img/album-thumb-28.jpg" alt="Team images">
                        </div>
                        <div class="contents">
                              <h6><a href="">ALICE KIM</a> </h6>
                              <p><a href="">Women`S Day Celebration At Noida Office</a></p>
                             
                        </div>
                    </div>
                </div>
                <!-- End Single Team -->
                <!-- Start Single Team -->
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="wn__team text-center gallery_brdr">
                        <div class="thumb">
                            <img src="img/album-thumb-28.jpg" alt="Team images">
                        </div>
                        <div class="contents">
                              <h6><a href="">ALICE KIM</a> </h6>
                              <p><a href="">Women`S Day Celebration At Noida Office</a></p>
                             
                        </div>
                    </div>
                </div>
                <!-- End Single Team -->
                
            </div>
        </div>
    </section>
    <!-- End Gallery Area -->
     
    <!-- Footer Area -->
    <?php include 'includes/footer.php' ?>
    <!-- //Footer Area -->

</div>
<!-- //Main wrapper -->
 <!-- JS Files -->
<?php include 'includes/foot.php' ?>
</body>
</html>