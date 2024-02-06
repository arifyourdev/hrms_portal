<?php
require_once "admin/private/initialize.php";
if(isset($_POST['marketing'])){
    echo $marketing = $_POST['marketing']; exit();
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Work With Us | Madhuban</title>
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
    <div class="ht__breadcrumb__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-centers">
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index">Home ></a>
                                <span class="breadcrumb_item active">Work with us</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Search Popup -->
     <!-- Start About Area -->
    <div class="page-work-with-us">
        <div class="container">
             <div class="row ">
                 <div class="col-lg-12 col-sm-12 col-12">
                    <div class="content career-tt">
                        <div class="text-center">
                            <h3 class="pages-titles">Work With Us</h3>
                             <p>What is your expertise ?</p>
                        </div>
                       <div class="about-lft full-right-pages">
                            <div class="row mt-5">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-3">
                                    <div class="work-text-page">
                                        <a href="work-with-us-single/editorial">
                                         <img src="img/editorial.svg">
                                         <h6>Editorial</h6>
                                         </a>
                                    </div>
                                </div>
                                 <div class="col-lg-3">
                                    <div class="work-text-page">
                                        <a href="work-with-us-single/marketing">
                                            <img src="img/marketing.svg"> 
                                             <h6>Marketing</h6></a>
                                    </div>
                                </div>
                                 <div class="col-lg-3">
                                    <div class="work-text-page">
                                    <a href="work-with-us-single/sales">
                                         <img src="img/sales.svg"> 
                                         <h6 style="margin-left:22px;">Sales</h6> </a>
                                    </div>
                                </div>
                                 <div class="col-lg-1"></div>
                                <div class="row text-center">
                                 <div class="col-lg-3"></div>
                                 <div class="col-lg-3">
                                    <div class="work-text-page">
                                    <a href="work-with-us-single/production">  
                                        <img src="img/production1.svg"> 
                                         <h6>Production</h6></a>
                                    </div>
                                </div>
                                 <div class="col-lg-3">
                                    <div class="work-text-page">
                                        <a href="work-with-us-single/others">
                                            <img src="img/other-department.svg"> 
                                         <h6>Other's</h6></a>
                                    </div>
                                </div>
                                  <div class="col-lg-3"></div>
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