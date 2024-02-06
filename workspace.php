<?php
require_once "admin/private/initialize.php";
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Employee Workspace | Madhubunbooks</title>
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
                                <span class="breadcrumb_item active">Employee Workspace</span>
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
                            <h3 class="pages-titles">Employee Workspace</h3>
                         </div>
                       <div class="mx-auto">
                            <div class="row mt-5">
                                 <div class="col-lg-4">
                                    <div class="workspace-text-page">
                                        <a href="https://schand.codemantra.com/login" target="_blank"><img src="img/ew1.png"></a>
                                         <h6 style=" left: 50px; position: relative; bottom: 110px; font-weight: 600;">Code Mantra</h6>
                                    </div>
                                </div>
                                 <div class="col-lg-4">
                                    <div class="workspace-text-page">
                                             <a href="https://outlook.office365.com" target="_blank"><img src="img/ew2.png"></a>
                                            <h6 style=" left: 79px; position: relative; bottom: 75px; font-weight: 600;">Office 365</h6>
                                    </div>
                                </div>
                                 <div class="col-lg-4">
                                    <div class="workspace-text-page">
                                        <a href="https://scot.schandgroup.com" target="_blank"><img src="img/ew3.png"></a>
                                        <h6 style=" left: 100px; position: relative; bottom: 40px; font-weight: 600;">SCOT</h6>

                                     </div>
                                </div>
                                  <div class="col-lg-4">
                                    <div class="workspace-text-page">
                                        <a href="https://madhubun.vmesh.in" target="_blank"><img src="img/ew4.png"></a>
                                        <h6 style=" left: 115px; position: relative; bottom: 84px; font-weight: 600;">CRM</h6>
                                     </div>
                                </div>
                                  <div class="col-lg-4">
                                    <div class="workspace-text-page">
                                        <a href="https://portal.zinghr.com/2015/pages/authentication/zing.aspx?ccode=vphpl2" target="_blank"><img src="img/ew5.png"></a>
                                          <h6 style=" left: 115px; position: relative; bottom: 84px; font-weight: 600;">Zing HR</h6>
                                     </div>
                                </div>
                                   <div class="col-lg-4">
                                    <div class="workspace-text-page">
                                        <a href="https://events.madhubunbooks.com/" target="_blank"><img src="img/logo.svg" style="margin: 67px;width: 169px"></a>
                                         <h6 style=" left: 110px; position: relative; bottom: 60px; font-weight: 600;">Events</h6>
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