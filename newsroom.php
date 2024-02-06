<?php
require_once "admin/private/initialize.php";
$current_date = date("Y-m-d");
if (isset($_GET['newsroom'])) {

    $newsroom_y = $_GET['newsroom'];
     
}

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <base href="<?php echo $base_url ?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Newsroom | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <?php include 'includes/head.php' ?>
</head>

<body>
    <style>
        .actives {
            color: #b00111 !important;
        }

        .newsroom_img {
            width: 200px;
            height: 150px;
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
                                <span class="breadcrumb_item active"><?php echo $news_cat->category ?></span>
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
                    <div class="col-lg-3">
                        <div class="digital_browse">
                            <h4>Browse by Year</h4>
                            <ul>
                                <?php $newsroom_date_sql = NewsroomDetail::find_by_order2();
                                  rsort($newsroom_date_sql); 
                                  foreach ($newsroom_date_sql as $newsroom_d_data) {
                                  
                                 ?>
                                    <li><a href="newsroom?newsroom=<?php echo $newsroom_d_data->date ?>" class=""><?php echo $newsroom_d_data->date ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="row mt-2">
                             <?php
                                 $newsroom_detail = NewsroomDetail::find_by_news_year($newsroom_y);
                                 foreach ($newsroom_detail as $detail_data) { ?>
                                <div class="col-lg-6">
                                    <div class="madhu_newsroom_flex">
                                        <div class="newsroom_images">
                                            <a href="newsroom_details/<?php echo $detail_data->id ?>">
                                                <?php if ($detail_data->image == "") { ?>
                                                    <img src="https://fakeimg.pl/210x210/eaedf1/">
                                                <?php } else { ?>
                                                    <img src="admin/<?php echo $detail_data->picture_path() ?>">
                                                <?php } ?>
                                        </div>
                                        <div class="">
                                            <div class="madhu_newsroom__">
                                                <h6><?php echo $detail_data->title ?> (<?php echo $detail_data->date ?>)</h6>
                                                <p><?php echo substr($detail_data->details, 0, 200) ?></p>
                                                <a href="newsroom_details/<?php echo $detail_data->id ?>">Read More...</a>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                            <?php }
                             ?>

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