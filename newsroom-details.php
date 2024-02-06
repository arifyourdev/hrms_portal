<?php
require_once "admin/private/initialize.php";
 
   if(isset($_GET['id'])){
    $content_data =$_GET['id'];
    $news_detail = NewsroomDetail::find_by_id($content_data);

}
 
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
     <base href="<?php echo $base_url?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Newsroom Details | Madhubunbooks</title>
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
                                <span class="breadcrumb_item">Newsroom ></span>
                                <span class="breadcrumb_item"><?php echo $news_detail->newsroom_id ?> ></span>
                                <span class="breadcrumb_item active"><?php echo $news_detail->title ?></span>
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
            <div class="row">
             <div class="col-lg-3">
                   <div class="digital_browse">
                       <h4>Browse by Category</h4>
                       <ul>
                           <?php $newsroom = Newsroom::find_by_order();
                           foreach($newsroom as $newsroom_data){
                           if($newsroom_data == $news_cat){
                               $a = 'actives';
                           } else {
                               $a = '';
                           }
                           ?>
                           <li><a href="newsroom/<?php echo $newsroom_data->category?>" class="<?php echo $a?>"><?php echo $newsroom_data->category?></a></li>
                           <?php } ?>
                       </ul>
                    </div> 
                </div>
                 <div class="col-lg-9  pages-mb">
                    <img src="admin/<?php echo $news_detail->picture_path() ?>"> 
              </div>
                </div>
                  <div class="col-lg-9 col-12 offset-3">
                     <div class="row mt-4">
                         
                              <div class="madhu_newsroom_d">
                                 <div class="madhu_newsroom__">
                                      <h6><?php echo $news_detail->title?> (<?php echo $news_detail->date?>) </h6>
                                      <p class="mt-2"><?php echo $news_detail->details?></p>
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

</body>
 </html>