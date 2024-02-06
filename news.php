<?php
require_once "admin/private/initialize.php";
$news_sql = BookNews::find_by_order();
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
?>
 <!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>News| Madhuban</title>
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
            <div class="orderby__wrapper">
                 <select class="shot__byselect">
                    <option>Filter By Year</option>
                    <option>2020</option>
                    <option>2021</option>
                    <option>2022</option>
                  </select>
            </div>
             <div class="row">
                <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                     <div class="shop__sidebar">
                        <aside class="widget__categories products--cat">
                            <h3 class="widget__title">News</h3>
                            <ul>
                                 <li><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i> <a href="<?php $base_url ?>?page=news">News</a></li>
                                 <li><i class="fa fa-chevron-right" aria-hidden="true"></i> <a href="<?php $base_url ?>?page=event">Event</a></li>
                              </ul>
                        </aside>
  
                    </div>
                 </div>
                 
                <div class="col-lg-9 col-12 order-1 order-lg-2">
                     <!--start-->
            <?php
              foreach($news_sql as $news_data){
            ?>        
                    <div class="member-detail-box">
                     <div class="row">
                          <div class="col-lg-12">
                             <div class="m-d-date">
                                  <p>2019-Sep-14</p>
                              </div>
                           <p class="date_desc"><strong>Health Camp at Vikas Publishing in collaboration with YES BANK</strong><br>
                             हिंदी दिवस, 14 सितंबर 2019 ‘हिंदी हैं हम’(एन.एस.यू.आई. ऑडिटोरियम , नई दिल्ली)</p>
                         </div>
                          <div class="md-detail-rm">
                             <a href=""class="read_m_btn2">Read More</a>
                         </div>
                       </div>     
                     </div>
            <?php } ?>
                     <!--End-->
                    
                    
                      
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