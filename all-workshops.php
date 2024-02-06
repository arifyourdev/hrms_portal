 <?php
require_once "admin/private/initialize.php";

if(isset($_GET['sort'])){
   $name = $_GET['sort'];
   $date = date_parse($name);
   $month = $date['month'];
   $workshop = PastEvent::find_by_month($month,'WORKSHOPS');
  }
  else
  {
   $workshop = PastEvent::find_by_work_events();
 }
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Workshops|Madhubanbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <?php include 'includes/head.php' ?>
</head>
<style>
    .active a {
        color: #a32c4c !important;
        font-weight: 500 !important;
    }
</style>
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
                                <a class="breadcrumb_item" href="index">Home &gt;</a>
                                <span class="breadcrumb_item">Educator Professional Development &gt;</span>
                                <span class="breadcrumb_item active">All Workshops</span>
                             </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-1">
        <div class="row">
                <div id="webinar-banner" class="owl-carousel">
                    <?php $banner_sql = Allbanner::find_by_webinar_banner();
                    foreach($banner_sql as $banner_data){
                    ?>
                     <div class="item">
                        <div class="madhubun-news-content">
                            <div class="madhubun-news-img">
                                 <div class="blog-banner">
                                     <img src="admin/<?php echo $banner_data->picture_path()?>" alt="">
                                   </div>
                             </div>
                         </div>
                    </div>
                    <?php } ?>
                     
                 </div>
             </div>
         </div>  
         <section>
             <div class="container mt-3">
                 <div class="all_webinar_br">
                     <h5>All Workshops</h5>
                     <div>
                         <select class="frm-selct" id="sort-by"> <i class="fa-solid fa-calendar"></i>
                           <option value="">Select Month</option>
                              <option value="jan"<?php if (isset($_GET['sort']) && $_GET['sort'] == 'jan') { echo 'selected';} ?>>Jan 2022 </option>
                              <option value="feb" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'feb') { echo 'selected';} ?>>Feb 2022 </option>
                              <option value="march" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'march') { echo 'selected';} ?> >March 2022 </option>
                              <option value="april" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'april') { echo 'selected';} ?>>April 2022 </option>
                              <option value="may" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'may') { echo 'selected';} ?>>May 2022 </option>
                              <option value="june" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'june') { echo 'selected';} ?>>June 2022 </option>
                              <option value="uly" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'july') { echo 'selected';} ?>>July 2022 </option>
                              <option value="august" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'august') { echo 'selected';} ?>>August 2022 </option>
                              <option value="sep" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'sep') { echo 'selected';} ?>>Sep 2022 </option>
                              <option value="oct" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'oct') { echo 'selected';} ?>>Oct 2022 </option>
                              <option value="nov" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'nov') { echo 'selected';} ?>>Nov 2022 </option>
                              <option value="dec" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'dec') { echo 'selected';} ?>>Dec 2022 </option>
                         </select>
                     </div>
                 </div>
                 <div class="row">
                 <div class="col-lg-3">
                        <div class="digital_browse">
                            <h4>EPD</h4>
                            <ul>
                                <li class="label2"><a href="all-webinars">Webinars</a></li>
                                <li class="label2 active"><a href="all-workshops">Workshops</a> </li>
                                <li class="label2"><a href="past-events">Past events</a></li>
                                <li class="label2"><a href="request-epd">Request EPD</a></li>
                                <li class="label2"><a href="blog">Articles and Blogs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                        <?php  
                            foreach($workshop as $workshop_data){
                            ?>
                     <div class="col-lg-6">
                       
                         <div class="m_a_web all_webinars_s">
                             <?php if($workshop_data->image == ""){?>
                            <img src="https://fakeimg.pl/250x100/">
                            <?php } else { ?>
                            <img src="admin/<?php echo $workshop_data->picture_path()?>">
                            <?php } ?>
                             <div class="madhu_all_w">
                                <div class="d-flexs">
                                     <div class="madhu_ml_all">
                                      <h6><a href="webinars-detail/<?php echo $workshop_data->id?>"><?php echo $workshop_data->title?></a></h6>
                                      <p><?php echo substr($workshop_data->details, 0 ,80)?> <a href="webinars-detail/<?php echo $workshop_data->id?>" class="text-danger">Read More..</a></p>
                                     </div>
                                 </div>
                                 <div class="all_web_date">
                                    <p><?php echo $workshop_data->date ?></p>
                                    <a href="" class="d-none">Register now</a>
                                  </div>
                                   <!-- <div class="m_webinar_border"></div> -->
                          </div>
                        </div>
                      </div> 
                      <?php } ?>
                         </div>
                    </div>
                  </div>
             </div>
         </section>
      <div class="home-news-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="home-n-back text-center">
                        <div class="reuest-margin">
                          <a href="request-epd" class="epd_btn__">Request EPD</a>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
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

                window.location = 'all-workshops?sort=' + sort;

            } else {
                window.location = 'all-workshops' ;
            }
        });
</script>
</body>
</html>