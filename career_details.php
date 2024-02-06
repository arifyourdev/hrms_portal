<?php
require_once "admin/private/initialize.php";

if(isset($_GET['id'])){
     
    $jobs_id = $_GET['id'];
    $jobs = CurrentOpening::find_by_id($jobs_id);
}
 
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <base href="<?php echo $base_url?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Career Details | Madhuban</title>
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
    font-size:16px !Important;
    font-weight: 400 !important;
}
.description{
    margin-top:15px;
    margin-bottom:20px;
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
       
        <!-- Start About Area -->
        <div class="page-about about_area bg--white section-padding--lg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-10 col-sm-12 col-12">
                        <div class="content">
                            <h2 class="pages-title" style="margin-left:-3px!important"><?php echo $jobs->job_title?></h2><hr>
                          <div class="row">     
                             <div class="col-md-4 col-lg-4 jobs-icon">
                                  <p><i class="fa fa-briefcase" aria-hidden="true"></i><span>Experience:</span>
                                  <?php echo $jobs->experience?></p> 
                             </div>
                              <div class="col-md-4 col-lg-4 jobs-icon">
                                   <p><i class="fa fa-inr" aria-hidden="true"></i><span>Salary:</span>
                                    <?php echo $jobs->salary?></p>
                             </div>
                              <div class="col-md-4 col-lg-4 jobs-icon">
                                   <p><i class="fa fa-map-marker" aria-hidden="true"></i><span>Location:</span> 
                                   <?php echo $jobs->location?></p> 
                             </div>
                              <div class="col-md-4 col-lg-4 jobs-icon">
                                  <p><i class="fa fa-cogs" aria-hidden="true"></i><span>Skill Set:</span>
                                   <?php echo $jobs->skills?></p> 
                             </div>
                              <div class="col-md-4 col-lg-4 jobs-icon">
                                   <p><i class="fa fa-calendar" aria-hidden="true"></i><span>Job Post Date:</span>
                                   <?php echo $jobs->date?></p> 
                             </div>
                          </div>     
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 description">
                 <h3 class="pages-title" style="margin-left:-3px!important"> Job Description</h3>
                 <div class="more-desc">
                    <p><?php echo $jobs->description?></p>
                    <div class="product__details">
                           <p><a href="postresume/<?php echo $jobs->id?>" class="btn view-button"> Apply Now </a> to be part of our active database.</p>
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