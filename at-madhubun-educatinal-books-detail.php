<?php
require_once "admin/private/initialize.php";

if(isset($_GET['album_id'])){
    
    $album_cat= $_GET['album_id'];
    
    $album_detail =BookAlbum::find_by_id($album_cat);
   
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 </head>
 <body>
  <style>
      .actives{
    color:#b00111 !important;
}
.newsroom_img {
    width:150px;
    height:100px;
}
.w3-modal-content {
    width: 649px;
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
                                 <span class="breadcrumb_item">At Madhubun Educational Books &gt;</span>
                                 <span class="breadcrumb_item"><?php echo $album_detail->a_category_name($album_detail->album_category)?> ></span>
                                 <span class="breadcrumb_item active"><?php echo $album_detail->album_title?></span>
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
                      <div class="row">
                           <h6> <?php echo $album_detail->album_title?></h6>
                          <?php   
                          $album_gallery =BookAlbumCross::find_by_album_gallery($album_detail->album_id);
                          foreach($album_gallery as $album_image) { ?>
                          <div class="mx-auto col-lg-4 text-center mt-4">
                              <img src="admin/<?php echo $album_image->picture_path() ?>"style="width:100%;cursor:pointer" onclick="onClick(this)" class="w3-hover-opacity">
                              <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
                                <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
                                 <div class="w3-modal-content w3-animate-zoom">
                                  <img id="img01" style="width:100%">
                                 </div>
                              </div>
                          </div>
                          <?php } ?>
                         </div>
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
<script>
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
}
</script>
</body>
 </html>