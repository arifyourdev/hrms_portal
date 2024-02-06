<?php
require_once "admin/private/initialize.php";
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Career | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <?php include 'includes/head.php' ?>
</head>

<body>
 <style>
 .jobs-icon {
     margin-top: 10px;
     font-size: 15px;
    color: #6c757d;
    line-height: 30px;
    margin-bottom: 25px;

 }
.jobs-icon span{
    font-weight:600;
    letter-spacing: 1px;
    margin-left: 5px;
}
.jobs-icon p{
    font-size:15px;
}
.jobs{
   font-size: 19px;
    color: #000000;
    padding: 15px 23px;
    margin:15px;
    box-shadow: 0px 2px 12px 2px #a5a2a280;
}
.madhu_artical_blog_ h2{
    font-size: 26px;
}
 </style>
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
    <div class="page-about about_area bg--white section-padding--lg career-whitespac">

    
    <!--<div class="container">-->
    <!--    <div class="search-header">-->
    <!--        <div class="publish-form">-->
    <!--           <form  method="post" enctype="multipart/form-data">-->
    <!--              <div class="row mt-4">-->
    <!--                    <div class="col-lg-2">-->
    <!--                                <div class="form-group">-->
    <!--                                     <input type="text" class="form-cont" name="pwu[pwu_name]" id="name" placeholder="Jobs Title">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                    <div class="col-lg-2">-->
    <!--                                <div class="form-group">-->
    <!--                                    <input type="text" class="form-cont" name="pwu[pwu_email]" id="email" placeholder="Enter Location">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                    <div class="col-lg-2">-->
    <!--                                <div class="form-group">-->
    <!--                                    <select class="form-cont form-con" name="pwu[pwu_country]">-->
    <!--                                        <option value="">-Experience-</option>-->
    <!--                                        <option value=""> </option>-->
    <!--                                    </select>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                    <div class="col-lg-2">-->
    <!--                                <div class="form-group">-->
    <!--                                    <select class="form-cont form-con" name="pwu[pwu_country]">-->
    <!--                                        <option value="">-Min-CTC-</option>-->
    <!--                                        <option value=""> </option>-->
    <!--                                    </select>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                    <div class="col-lg-2">-->
    <!--                        <div class="form-group">-->
    <!--                            <select class="form-cont form-con" name="pwu[pwu_country]">-->
    <!--                                            <option value="">-Max-CTC-</option>-->
    <!--                                            <option value=""> </option>-->
    <!--                                        </select>-->
    <!--                        </div>-->
    <!--                    </div>  -->
    <!--                    <div class="publish-submit text-center col-md-2">-->
    <!--                          <button type="submit" name="submit" class="custom-btn btn-5 request_epd"><i class="fa fa-search" aria-hidden="true"></i></button>-->
    <!--                       </div>-->
    <!--              </div>-->
    <!--           </form>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
        
     <section class="digital_section">
        <div class="container">
            <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12">
                         <div class="content career-tt">
                            <!-- <h2 class="pages-title">Recent Jobs</h2> -->
        	             </div>
                     </div>
                     <?php $jobs_sql = CurrentOpening::find_by_order();
                     foreach($jobs_sql as $jobs){
                     ?>
                       <div class="col-lg-4 col-md-4 col-sm-6">
                           <div class="jobs">
                             <div class="madhu_artical_blog_">
                              <h2><?php echo $jobs->job_title?></h2>
                             </div>
                             <div class="jobs-icon">
                                <p><i class="fa fa-briefcase" aria-hidden="true"></i> <span> Experience: </span> 
                                <?php echo $jobs->experience?></p> 
                         
                                <p><i class="fa fa-inr" aria-hidden="true"></i> <span> Salary: </span>
                                <?php echo $jobs->salary?></p>
                         
                                <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span> Location: </span> 
                                 <?php echo $jobs->location?></p>
                             </div>
                             <div class="product__contents mb-1">
                                <h4><a href="career-details/<?php echo $jobs->id ?>" class="btn view-button"> View More</a></h4>
                            </div>
                            </div>
                       </div>
                       <?php } ?>
            </div>
        </div>
    </section>
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