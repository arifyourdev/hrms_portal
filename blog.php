<?php
require_once "admin/private/initialize.php";

$current_page = $_GET['page'] ?? 1;
$per_page = 2;
$total_count = Blog::count_all();
$pagination = new Pagination($current_page, $per_page, $total_count);
$blog = Blog::find_by_page($per_page, $pagination);
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <base href="<?php echo $base_url ?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Artical & Blog|Madhubunbooks</title>
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
                                <a class="breadcrumb_item" href="index">Home &gt;</a>
                                <span class="breadcrumb_item active">Artical & Blog</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-1">
            <div class="row">
                <div id="blog-banner" class="owl-carousel">
                    <?php $blogbanner = Allbanner::find_by_blog_banner();
                    foreach ($blogbanner as $banner) {
                    ?>
                        <div class="item">
                            <div class="madhubun-news-content">
                                <div class="madhubun-news-img">
                                    <div class="blog-banner">
                                        <img src="admin/<?php echo $banner->picture_path() ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- End Search Popup -->
        <!-- Start Gallery Area -->
        <section class="digital_section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="digital_browse">
                            <h4>EPD</h4>
                            <ul>
                                <li class="label2"><a href="all-webinars">Webinars</a></li>
                                <li class="label2"><a href="all-workshops">Workshops</a> </li>
                                <li class="label2"><a href="past-events">Past events</a></li>
                                <li class="label2"><a href="request-epd">Request EPD</a></li>
                                <li class="label2 active"><a href="blog">Articles and Blogs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <?php
                            foreach ($blog as $data) { ?>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="madhu_artical_blog_">
                                        <a href="blog_details/<?php echo $data->seo_url ?>">
                                            <?php
                                            if ($data->image == "") { ?>

                                                <img src="https://fakeimg.pl/255x255/">

                                            <?php } else { ?>

                                                <img src="admin/<?php echo $data->picture_path(); ?>" alt="">

                                            <?php } ?>
                                            <a href="blog_details/<?php echo $data->seo_url ?>">
                                                <h5><?php echo $data->title ?></h5>
                                            </a>
                                            <a href="blog_details/<?php echo $data->seo_url ?>">
                                                <p><?php echo $data->category ?></p>
                                            </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <ul class="wn__pagination mt-3">
                    <?php $url = 'blog';
                    echo $pagination->page_links($url);
                    ?>
                </ul>
            </div>
    </div>
    </section>
    <!-- End Gallery Area -->

    <!-- Footer Area -->
    <?php include 'includes/footer.php' ?>
    <!-- //Footer Area -->

    </div>
    <!-- //Main wrapper -->
    <!-- JS Files -->
    <?php include 'includes/foot.php' ?>
</body>

</html>