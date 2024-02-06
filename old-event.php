<?php
require_once "admin/private/initialize.php";
?>
 <!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Event | Madhuban</title>
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
                     <div class="shop__sidebar">
                        <aside class="widget__categories products--cat">
                            <h3 class="widget__title">Event</h3>
                            <ul>
                                 <li><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i> <a href="news">News</a></li>
                                 <li><i class="fa fa-chevron-right" aria-hidden="true"></i> <a href="event">Event</a></li>
                             </ul>
                        </aside>
  
                    </div>
                 </div>
                 
                <div class="col-lg-9 col-12 order-1 order-lg-2 md-botm">
                     <!--start-->
                    <div class="member-detail-box">
                     <div class="row">
                          <div class="col-lg-4">
                             <div class="m-d-img">
                                 <img src="img/news-40.jpg">
                             </div>
                         </div>
                         <div class="col-lg-8">
                             <div class="md-3-t event-t">
                                <h4>हिन्दी दिवस समारोह</h4>  
                                <div class="md-author2">
                                    <p>Posted By: 2019-Sep-14</p>
                                </div>
                                <div>
                                    <p>मधुबन एजूकेशनल बुक्स द्वारा हिंदी शिक्षण प्रक्रिया में नवीनता के विभिन्न ...</p>
                                    <div class="md-detail-rm">
                                       <a href="news-details"class="read_m_btn2">Read More</a>
                                    </div>
                                </div>
                                    
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