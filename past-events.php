<?php
require_once "admin/private/initialize.php";
$current_date = date("Y-m-d");
 
if(($_GET['sort_type']!='') && ($_GET['sort']==''))
{
    $name = $_GET['sort_type'];
    $past_event_sql = PastEvent::find_by_past_event_type($_GET['sort_type']);
}
elseif(($_GET['sort_type']!='') && ($_GET['sort']!=''))
{
    $name = $_GET['sort_type'];
    $sort_n = $_GET['sort'];
    $date = date_parse($sort_n);
    $month = $date['month'];
    $past_event_sql = PastEvent::find_by_pastevent_month($month,$name);
}
else
{
    $past_event_sql = PastEvent::find_by_order(); 
} 
?>

<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Past Events | Madhubunbooks</title>
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
                                <span class="breadcrumb_item active">Past Events</span>
                             </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     <div class="container-fluid mt-1">
        <div class="row">
                <div id="event-banner" class="owl-carousel">
                    <?php $event_banner = Allbanner::find_by_events_banner();
                    foreach($event_banner as $banner){
                    ?>
                     <div class="item">
                        <div class="madhubun-news-content">
                            <div class="madhubun-news-img">
                                 <div class="blog-banner">
                                     <img src="admin/<?php echo $banner->picture_path()?>" alt="">
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
                      <h5>Past Events</h5>
                     <div class="past_evnt_type">
                          <label for="">Select Event Type </label>
                           <select class="frm-selct" id="sort-by-type">  
                                  <option value="">-Select-</option>
                                 <option value="webinars"<?php if (isset($_GET['sort_type']) && $_GET['sort_type'] == 'webinars') { echo 'selected';} ?>>Webinars</option>
                                <option value="workshops" <?php if (isset($_GET['sort_type']) && $_GET['sort_type'] == 'workshops') { echo 'selected';} ?>>Workshops </option>
                          </select>
                     </div>
                     <div>
                          <select class="frm-selct" onchange="sort_by_month('<?php echo $name ?>')" id="sort_by_m">
                           <option value="">Select Month</option>
                               <option value="jan"<?php if (isset($_GET['sort']) && $_GET['sort'] == 'jan') { echo 'selected';} ?>>Jan 2022 </option>
                              <option value="feb" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'feb') { echo 'selected';} ?>>Feb 2022 </option>
                              <option value="march" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'march') { echo 'selected';} ?> >March 2022 </option>
                              <option value="april" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'april') { echo 'selected';} ?>>April 2022 </option>
                              <option value="may" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'may') { echo 'selected';} ?>>May 2022 </option>
                              <option value="june" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'june') { echo 'selected';} ?>>June 2022 </option>
                              <option value="july" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'july') { echo 'selected';} ?>>July 2022 </option>
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
                            <li class="label2"><a href="javascript:void(0)">Webinars</a></li>
                            <li class="label2"><a href="javascript:void(0)">Workshops</a> </li>
                            <li class="label2 active"><a href="https://madhubunbooks.com/past-events?sort_type=webinars">Past Events</a></li>
                            <li class="label2"><a href="request-epd">Request EPD</a></li>
                            <li class="label2"><a href="javascript:void(0)">Articles and Blogs</a></li>
                      </ul>
                    </div> 
                   </div>
                   
                    <div class="col-lg-9">
                        <div class="row">
                        <?php
                       
                         foreach($past_event_sql as $past_data){
                            if((strtotime($past_data->date))<(strtotime($current_date))) {
                        ?>
                            <div class="col-lg-6">
                            <div class="m_a_web all_webinars_s">
                              
                              <?php if($past_data->image == ""){?>
                               
                             <img src="https://fakeimg.pl/250x100/"> 
                             <?php } else { ?>
                                 <img src="admin/<?php echo $past_data->picture_path()?>"> 
                             <?php } ?>
                                 <div class="madhu_all_w">
                                     <div class="d-flexs">
                                          <div class="madhu_ml_all">
                                           <a href="webinars-detail/<?php echo $past_data->id?>"><h6><?php echo $past_data->title?></h6></a>
                                           <p><?php echo substr($past_data->details, 0 ,80)?>..</p>
                                          </div>
                                     </div>
                                     <div class="all_web_date">
                                     <p><?php echo $past_data->date ?></p>
                                     
                                   </div>
                                     <!-- <div class="m_webinar_border"></div> -->
                                 </div>
                             </div>
                            </div>
                            <?php } } ?>
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
    $('#sort-by-type').on('change', function() {

            var sort_type = $(this).val();
             
              
            if (sort_type !='') {

                window.location = 'past-events?sort_type='+sort_type;

            } else {
                window.location = 'past-events';
            }
        });

        function sort_by_month(name){
        var sort_by_m = jQuery('#sort_by_m').val();
        window.location.href="past-events?sort_type="+name+"&sort="+sort_by_m;
     }

        // $('#sort-by-month').on('change', function() {

        //     var sort_month = $(this).val();
        //     var get_sort_type = $('#get_sort_type').val();
            
        //     if (sort_month !='') {

        //         window.location = 'past-events?sort_type='+ get_sort_type + && + '?sort=' + sort_month;

        //     } else {
        //         window.location = 'past-events';
        //     }
        //     });


</script>
</body>
</html>