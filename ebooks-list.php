<?php
require_once "admin/private/initialize.php";

if (isset($_GET['board']) && isset($_GET['subject_filename'])) {
    $subject_filename = $_GET['subject_filename'];
    $subject_data1 = BookSubject::find_by_subject_filename($subject_filename);

    $board_name = $_GET['board'];
    $board_data = Board::find_by_seo_url($board_name);
    $board_id = $board_data->id;
    $select_board = 'single';

    $ebook_series = BookMaster::find_by_ebook_subject_board($subject_data1->subject_id, $board_id);
} elseif (isset($_GET['subject_filename'])) {
    $subject_filename = $_GET['subject_filename'];
    $subject_data1 = BookSubject::find_by_subject_filename($subject_filename);
    $board_name = '';
    $board_id = '0';
    $select_board = 'multiple';
    $ebook_series = BookMaster::find_by_ebook_subject($subject_data1->subject_id);
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
    <title>E-Books List | Madhubunbooks</title>
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
        <input type="hidden" value="<?php echo $subject_data1->subject_id ?>" id="book_details">
        <input type="hidden" value="<?php echo $select_board ?>" id="board_type">
        <div class="ht__breadcrumb__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-centers">
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index">E-books ></a>
                                <span class="breadcrumb_item active"><?php echo $subject_data1->subject_title ?></span>

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
                    <div class="col-lg-3 col-12  md-mt-40 sm-mt-40">
                        <div class="digital_browse">
                            <h4>Browse by Subject</h4>
                            <ul>
                                <?php
                                $check_ebook_subject = BookMaster::find_unique_subject_by_ebook();
                                foreach ($check_ebook_subject as $e_book_subject) {
                                    $subject = BookSubject::find_by_custom_id('subject_id', $e_book_subject->book_subject);
                                    if ($subject == $subject_data1) {
                                        $s = 'actives';
                                    } else {
                                        $s = '';
                                    }

                                ?>
                                    <li><a href="ebooks-list/<?php echo $subject->subject_filename ?>" class="<?php echo $s ?>"><?php echo $subject->subject_title ?></a></li>
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
                                                <input type="checkbox" id="<?php echo $board_id ?>" class="common_checkbox book_board" value="<?php echo $board_id; ?>" checked disabled>
                                                <label for="<?php echo $board_id ?>"><?php echo $board_name ?></label>
                                            </div>
                                        </li>
                                        <?php } else {
                                        $boards = Board::find_by_order();
                                        foreach ($boards as $board) {
                                        ?>
                                            <li>
                                                <div class="form-group frm-gg">
                                                    <input type="checkbox" id="<?php echo $board->id ?>" class="common_checkbox book_board" value="<?php echo $board->id; ?>" name="myCheckbox1" checked>
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
                    <div class="col-lg-9 col-12 order-1 order-lg-2">

                        <div class="tab__container tab-content">
                            <div class="shop-grid tab-pane fade show active book__board" id="book_board" role="tabpanel">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Shop Page -->


        <!-- Footer Area -->
        <?php include 'includes/footer.php' ?>

    </div>
    <!-- //Main wrapper -->

    <?php include 'includes/foot.php' ?>

    <script>
        $(document).ready(function() {
            $('.book__board').on('click', function() {
                $('.book__board').not(this).prop('checked', false);
            });

            filter_data();

            function filter_data() {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'ajax/ebook-list';
                var book_board = get_filter('book_board');
                var book_id = $("#book_details").val();
                var board = $("#board_type").val();
                console.log(book_id)
                $.ajax({
                    type: "post",
                    url: "ajax/board_ebook_details",
                    data: {
                        book_id: book_id,
                        board: board,
                        book_board: book_board
                    },
                    success: function(data) {
                        $('#book_board').html(data);
                        if ($('.book_board')[0].checked = true) {
                            var value = $('input[name="myCheckbox1"]:checked').val();
                            var book_id = get_filter('book_id');
                            var book_board = $("#book_board").val();
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