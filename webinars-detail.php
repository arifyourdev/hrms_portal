<?php
require_once "admin/private/initialize.php";
if(isset($_GET['id'])){
    $webinars = $_GET['id'];
    $webinars_data = PastEvent::find_by_id($webinars);
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
     <base href="<?php echo $base_url?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>All Webinars|Madhuban</title>
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
                                <a class="breadcrumb_item" href="index">Home &gt;</a>
                                <span class="breadcrumb_item">Events &gt;</span>
                                 <span class="breadcrumb_item active">All Webinars</span>
                             </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     <div class="container webinar_mt">
        <div class"row">
            
                <div class="madhu_all_webi">
                    <?php if($webinars_data->image == ""){?>
                    <img src="https://fakeimg.pl/1176x250/">
                    <?php } else { ?>
                    <img src="admin/<?php echo $webinars_data->picture_path()?>">
                    <?php }?>
                     <div class="madhu_web_cont">
                        <h6><?php echo $webinars_data->title?></h6>
                        <p><?php echo $webinars_data->date?></p>
                    </div>
                     <?php echo $webinars_data->details?>
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
</body>
</html>