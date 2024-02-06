<?php
require_once "admin/private/initialize.php";

if (isset($_GET['board']) && isset($_GET['subject_filename'])) {
    $subject_filename = $_GET['subject_filename'];
    $subject_data1 = BookSubject::find_by_subject_filename($subject_filename);

    $board_name = $_GET['board'];
    $board_data = Board::find_by_seo_url($board_name);
    $board_id = $board_data->id;
    $select_board = 'single';

    $subject_sql_data = BookSeries::find_by_series_subject_board($subject_data1->subject_id, $board_id);
} elseif (isset($_GET['subject_filename'])) {
    $subject_filename = $_GET['subject_filename'];
    $subject_data1 = BookSubject::find_by_subject_filename($subject_filename);
    $board_name = '';
    $board_id = '0';
    $select_board = 'multiple';
    $subject_sql_data = BookSeries::find_by_series_subject($subject_data1->subject_id);
} else {
    redirect_to($base_url);
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <base href="<?php echo $base_url ?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Books List | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <?php include 'includes/head.php' ?>

</head>

<body>
    <style>
        .form-group input {
            padding: 0;
            height: initial;
            width: initial;
            margin-bottom: 0;
            display: none;
            cursor: pointer;
        }

        .form-group label {
            position: relative;
            cursor: pointer;
            color: #a32c4c;
            font-size: 13px;
            font-weight: 500;
        }

        .form-group label:before {
            content: '';
            -webkit-appearance: none;
            background-color: transparent;
            border: 2px solid #a32c4c;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
            padding: 7px;
            display: inline-block;
            position: relative;
            vertical-align: middle;
            cursor: pointer;
            margin-right: 13px;
            background: #fff;
            border-radius: 4px;
        }

        .form-group input:checked+label:after {
            content: '';
            display: block;
            position: absolute;
            top: 6px;
            left: 7px;
            width: 5px;
            height: 12px;
            border: solid #9f2b4a;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .shop__sidebar {
            overflow-y: scroll;
            height: 400px;
        }

        .actives {
            color: #b00111 !important;
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
        <input type="hidden" value="<?php echo $subject_data1->subject_id ?>" id="series_details">
        <input type="hidden" value="<?php echo $select_board ?>" id="board_type">
        <div class="ht__breadcrumb__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-centers">
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item">Books ></a>
                                <span class="breadcrumb_item active"><?php echo $subject_data1->subject_title ?> </span>
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
                    <div id="event-banner" class="owl-carousel">
                        <?php $books_banner = Allbanner::find_by_bookslist_banner();
                        foreach ($books_banner as $banner_data) {
                        ?>
                            <div class="item">
                                <div class="madhubun-news-content">
                                    <div class="madhubun-news-img">
                                        <div class="blog-banner">
                                            <img src="admin/<?php echo $banner_data->picture_path() ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                        <div class="digital_browse">
                            <h4>Browse by Subject</h4>
                            <ul style="list-style:none !important;">
                                <?php $subject_data = BookSubject::find_by_sort_order();
                                foreach ($subject_data as $subject) {
                                    if ($subject == $subject_data1) {
                                        $s = 'actives';
                                    } else {
                                        $s = '';
                                    }
                                ?>
                                    <li><a href="books-list/<?php echo $subject->subject_filename ?>" class="<?php echo $s ?>"><?php echo $subject->subject_title ?></a></li>
                                <?php } ?>
                            </ul>

                        </div>
                        <!-- <h3 class="widget__title_book">Board <img src="img/filter.svg" class="bk-img"></h3> -->
                        <div class="shop_sidebar d-none">
                            <aside class="widget__categories-books products--cat products_show">
                                <ul class="board-scrolls">
                                    <?php
                                    if ($board_name != '') {
                                    ?>
                                        <li>
                                            <div class="form-group frm-gg">
                                                <input type="checkbox" id="<?php echo $board_id ?>" class="common_checkbox series_board" value="<?php echo $board_id; ?>" checked disabled>
                                                <label for="<?php echo $board_id ?>"><?php echo $board_name ?></label>
                                            </div>
                                        </li>
                                        <?php
                                    } else {
                                        $boards = Board::find_by_order();
                                        foreach ($boards as $board) {
                                        ?>
                                            <li>
                                                <div class="form-group frm-gg">
                                                    <input type="checkbox" id="<?php echo $board->id ?>" class="common_checkbox series_board" value="<?php echo $board->id; ?>" name="myCheckbox1" checked>
                                                    <label for="<?php echo $board->id ?>"><?php echo $board->board_title ?></label>
                                                </div>
                                            </li>
                                    <?php }
                                    }
                                    ?>
                                </ul>
                            </aside>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-9 col-12 order-1 order-lg-2">

                        <div class="tab__container tab-content">
                            <div class="shop-grid tab-pane fade show active series__board" id="by_board" role="tabpanel">

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
        <!-- QUICKVIEW PRODUCT -->


    </div>
    <!-- //Main wrapper -->
    <style>
        #loading {
            text-align: center;
            background: url('loader.gif') no-repeat center;
            height: 150px;
        }
    </style>
    <?php include 'includes/foot.php' ?>
    <script>
        $(document).ready(function() {
            $('.series__board').on('click', function() {
                $('.series__board').not(this).prop('checked', false);
            });

            filter_data();

            function filter_data() {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'ajax/book-list';
                var series_board = get_filter('series_board');
                var series_id = $("#series_details").val();
                var board = $("#board_type").val();
                console.log(series_id)
                $.ajax({
                    type: "post",
                    url: "ajax/board_book_details",
                    data: {
                        series_id: series_id,
                        board: board,
                        series_board: series_board
                    },
                    success: function(data) {
                        $('#by_board').html(data);
                        if ($('.series__board')[0].checked = true) {
                            var value = $('input[name="myCheckbox1"]:checked').val();
                            var series_id = get_filter('series_id');
                            var series_board = $("#series_board").val();
                        }
                    }
                });
            }





            function get_filter(class_name) {

                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;

            }

            $('.common_checkbox').click(function() {
                filter_data();
            });


        });
    </script>

</body>

</html>