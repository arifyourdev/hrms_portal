<?php
require_once "admin/private/initialize.php";

    if(isset($_GET['album_category'])){
    $newsroom_cat= $_GET['album_category'];
    $album_all_cat =BookAlbumCateg::find_by_category($newsroom_cat);
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
     <base href="<?php echo $base_url?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Album | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Favicons -->
    <?php include 'includes/head.php' ?>
 </head>
 <body>
  <style>
      .actives{
    color:#b00111 !important;
}
.newsroom_img {
    width:200px;
    height:150px;
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
                                <span class="breadcrumb_item">At Madhubun Educational Books&gt;</span>
                                <span class="breadcrumb_item " style="text:grey"><?php echo $album_all_cat->album_category ?></span>
                             </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Search Popup -->
    <!-- Start Shop Page -->
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg lg--book">
        <div class="container">
             <div class="col-lg-12 pages-mb">
                    <img src="img/book_banner-min.png"> 
              </div>
             <div class="row">
                 
                  <div class="col-lg-12 col-12">
                     <div class="row mt-2">
                        <div class="madhu_newsroom_h6">
                            <h6><?php echo $album_all_cat->album_category ?></h6>
                        </div>
                            <?php 
                           $album_fetch = BookAlbum::find_by_order();
                           foreach($album_fetch as $album_category){?>
                   <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="madhu_artical_blog_">
                          <div class="madhu_newsroom__ mt-3">
                             <img src="admin/<?php echo $album_category->picture_path(); ?>" style="margin-top:10px" alt="">
                            <p><?php echo $album_category->album_detail?></p> 
                            <a href="at-madhubun-educatinal-books-detail/<?php echo $album_category->album_id?>"><h6><?php echo $album_category->album_title?></h6></a>
                         </div>
                        </div>
                   </div>
                        <?php } ?>
                        
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