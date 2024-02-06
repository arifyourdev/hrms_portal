<?php 
require_once "admin/private/initialize.php";
$about = BookCms::find_by_about();

$legacy = BookCms::find_by_legacy();

$leadership = BookCms::find_by_leadership();

$vision =Bookcms::find_by_vision();

$author = BookCms::find_by_author();
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>About | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <?php include 'includes/head.php' ?>
</head>

<body>
  <style>
      .active a{
          color:#a32c4c !important;
          font-weight: 500 !important;
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
   <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
        <div class="container">
            <div>
                <img src="img/50years-madhubun.png">
            </div>
            <div class="row mt-3">
                <div class="about-cnt">
                    <h4>About Us</h4>
                </div>
                <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                   
                     <div class="shop__sidebar">
                        <aside class="widget__categories products--cat tabs-nav">
                            
                            <ul>
                              <li class="label2 active" ><a href="#who-we-are">Who we are</a></li>
                               <li class="label2"><a href="" style="pointer-events: none">Our Legacy</a> </li>
                               <li class="label2"><a href="" style="pointer-events: none">Our Leadership Team</a></li>
                               <li class="label2"><a href="#vision-and-mission">Our Mission</a></li>
                               <li class="label2"><a href=""style="pointer-events: none">Meet our Authors</a></li>
                            </ul>
                        </aside>
  
                    </div>
                </div>
                <div class="col-lg-9 col-12 order-1 order-lg-2">
                    <div class="content tabs-content">
                        <!--<h2 class="pages-title">About Us</h2>-->
                     <div class="about-lft "  id="who-we-are">
                          <h3>Who we are</h3>
	                    <blockquote>
	                       <?php echo $about->cms_detail?> 
                          </div>
	                 <div id="our-legacy">
                      <h3>Our Legacy</h3>
                       <?php echo $legacy->cms_detail ?>
                       </div>
                     <div id="our-leadership-team">
                      <h3>Our Leadership Team</h3>
                       <?php echo $leadership->cms_detail?>
                       </div>
                    <div id="vision-and-mission">
                      <h3>Our Mission</h3>
                      <?php echo $vision->cms_detail?>
                    </div>
                    <div id="meet-our-authors">
                      <h3>Meet our Authors</h3>
                      <?php echo $author->cms_detail?>
                    </div>
                </div>
                    
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
            $(function() {
          $('.tabs-nav a').click(function(e) {
        
            // Check for active
            $('.tabs-nav li').removeClass('active');
            $(this).parent().addClass('active');
            // Display active tab
            let currentTab = $(this).attr('href');
            
            $('.tabs-content div').hide();
            $(currentTab).show();
           window.location.hash = e.target.hash;
            return false;
          });
        });
        </script>
 <script>
 $(document).ready(function()
 {
       var hash = location.hash.replace();  // ^ means starting, meaning only match the first hash
        get_data(hash);
    $(document).on("click",".about_label a",function(){
        var id =$(this).attr("href");
        
        var hash = id.replace('about', '');
        get_data(hash);
    });
    
    function get_data(hash)
    {
        if (hash) {
   if($('.tabs-nav li a[href="' + hash + '"]').length>0)
   {    
        $('.tabs-nav li').removeClass('active');  
       $('a[href="' + hash + '"]').parent().addClass('active');
       $('.tabs-content div').hide();
       $(hash).show();
    
   }
   else
   {
      $('.tabs-content div').hide();
   }
    
}
    }
 
  
 });

// Change hash for page-reload
$('.tabs-nav li a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
})
</script>
</body>
</html>