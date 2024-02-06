<?php
require_once "admin/private/initialize.php";
?>
 <!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>News Details | Madhubunbooks</title>
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
                            <h3 class="widget__title">News</h3>
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
                             <div class="md-3-t">
                                <h4>हिन्दी दिवस समारोह</h4>  
                                <div class="md-author2">
                                    <p>Posted By: 2019-Sep-14</p>
                                </div>
                                <div>
                                    <p>अपने इसी प्रयास को जन-जन तक पहुंचाने के उद्देश्य से हिंदी दिवस को एक महापर्व के रूप में मनाने को प्रतिबद्
                                    ध यह संस्थान प्रत्येक वर्ष हिंदी शिक्षण में विशिष्ट योगदान देने वाले कुछ शिक्षकों को 
                                    सम्मानित करता है| इस वर्ष भारतवर्ष के लगभग 120 शिक्षक/शिक्षिकाओं को प्रशस्ति पत्र तथ
                                    ा स्मृति चिन्ह द्वारा सम्मानित किया गया| इतना ही नहीं भावी पीढ़ी हिंदी के प्रति अपनी र
                                    ुचि को बनाए रखे इस उद्देश्य से वर्ष 2018-19 की 10वीं की बोर्ड पर >
                                </div>
                             </div>
                         </div>
                         <div class="md-detail-rm">
                               <h4 class="read_m_btn3"> जय हिंद, जय हिंदी!</h4
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