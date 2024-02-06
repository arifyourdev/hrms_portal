 <?php
require_once "admin/private/initialize.php";

if(isset($_GET['blog_name'])){
     
    $blog_name = $_GET['blog_name'];
    $blog_data = Blog::find_by_seo_url($blog_name);
}


?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
   <base href="<?php echo $base_url?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Blog Details | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Favicons -->
    <?php include 'includes/head.php' ?>
 </head>
 <body>
 <style>
     .pages-mb img{
    width:100%;
   
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
      <div class="ht__breadcrumb__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-centers">
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index">Home ></a>
                                <span class="breadcrumb_item active">Artical & Blog</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Search Popup -->
    <!-- Start Shop Page -->
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg lg--book">
        <div class="container-fluid">
            <div class="row">
                  <div class="col-lg-9 col-12">
                      <div class="madhu_blog_d">
                          <h5><?php echo $blog_data->title?></h5>
                          <div class="madhu_blog_d2">
                              <p>By <?php echo $blog_data->name?></p>
                              <p><?php echo $blog_data->category?></p>
                          </div>
                          <div style="border-bottom: 2px solid #a32c4c;margin-top:5px;"></div>
                      </div>
                    <div class="row mt-2">
                        <div class="col-lg-12 pages-mb">
                               <img src="admin/<?php echo $blog_data->picture_path()?>" >
                        </div>
                    </div>
                    <div class="tab__container tab-content">
                       <div class="madhu_blog_para">
                           <?php echo $blog_data->detail?>
                         </div>   
                    </div>
                </div>
                  <div class="col-lg-3">
                      <h4 class="recent_blog">Recent Blogs</h4>
                     <div class="row">
                         <?php 
                         $value = Blog::find_by_recent_blog();
                         foreach($value as $recent_blog){
                         ?>
                         <div class="col-lg-12 text-center">
                              <div class="madhu_artical_blog_">
                                <a href="blog_details/<?php echo $recent_blog->seo_url?>">
                                    <?php if ($recent_blog->image == ""){ ?>
                                    <img src="https://fakeimg.pl/200x200/eaedf1/"></a>
                                    <?php } else {?>
                                    <img src=admin/<?php echo $recent_blog->picture_path()?> style="width:200px;height:200px!important;">
                                    <?php } ?>
                                <a href="blog_details/<?php echo $recent_blog->seo_url?>"><h5><?php echo $recent_blog->title?></h5></a>
                                <a href="blog_details/<?php echo $recent_blog->seo_url?>"><p><?php echo $recent_blog->category?></p></a>
                              </div>
                         </div>
                         <?php }?>
                          
                         
                     </div>
                  </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
    

    <!-- Footer Area -->
     <?php include 'includes/footer.php' ?>
    <!-- //Footer Area -->
    

</div>
<!-- //Main wrapper -->

  <?php include 'includes/foot.php' ?>

</body>
 </html>
 