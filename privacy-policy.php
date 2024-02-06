<?php 
require_once "admin/private/initialize.php";
 
$policy = BookCms::find_by_privacy();
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Privacy & Policy | Madhubunbooks</title>
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
    
    <!-- Start About Area -->
    <div class="page-about about_area bg--white section-padding--lg">
        <div class="container">
             <div class="row align-items-center">
                 <div class="col-lg-12 col-sm-12 col-12">
                    <div class="content">
                        <h2 class="pages-title"style="margin-left: 0 !important;"> Privacy & Cookie Policy</h2>
                         <?php echo $policy->cms_detail ?>
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