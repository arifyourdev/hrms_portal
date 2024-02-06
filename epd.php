<?php
require_once "admin/private/initialize.php";
if(isset($_GET['pages'])){
    $pages = $_GET['pages'];
}
if(isset($_GET['sort'])){
   $name = $_GET['sort'];
   $date = date_parse($name);
   $month = $date['month'];
   $webinars = PastEvent::find_by_month($month,'WEBINARS');
  }
  else
  {
   $webinars = PastEvent::find_by_web_events();
 }
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EPD | Madhubun Books</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include 'includes/head.php' ?>
</head>

<body>
    <style>
        .active a {
            color: #a32c4c !important;
            font-weight: 500 !important;
        }
    </style>
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
        <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
            <div class="container">
                <div>
                    <img src="img/book_banner-min.png">
                </div>
                <div class="row mt-3">
                    <div class="about-cnt">
                        <h4>Educator Professional Development</h4>
                    </div>
                    <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">

                        <div class="shop__sidebar">
                            <aside class="widget__categories products--cat tabs-nav">

                                <ul>
                                    <li class="label2 active"><a href="all-webinars">Webinars</a></li>
                                    <li class="label2"><a href="Workshops">Workshops</a> </li>
                                    <li class="label2"><a href="">Past events</a></li>
                                    <li class="label2"><a href="request-epd">Request EPD</a></li>
                                    <li class="label2"><a href="blog">Articles and Blogs</a></li>
                                 </ul>
                            </aside>

                        </div>
                    </div>
                     <div class="col-lg-9 col-12 order-1 order-lg-2">

                    </div>
                </div>
            </div>
        </div>
        <!-- Start About Area -->
        <div class="page-about about_area bg--white section-padding--lg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-sm-12 col-12">

                    </div>
                </div>
            </div>

        </div>
        <!-- End About Area -->

        <style>
            .tabs-content div:not(:first-child) {
                display: none;
            }
        </style>

        <!-- Footer Area -->
        <?php include 'includes/footer.php' ?>
        <!-- //Footer Area -->

    </div>
    <!-- //Main wrapper -->
    <!-- JS Files -->
    <?php include 'includes/foot.php' ?>
    <script>
    $('#sort-by').on('change', function() {

            var sort = $(this).val();
              
            if (sort !='') {

                window.location = 'all-webinars?sort=' + sort;

            } else {
                window.location = 'all-webinars' ;
            }
        });
</script>
</body>

</html>