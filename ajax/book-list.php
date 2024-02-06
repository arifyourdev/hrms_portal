<?php
require_once "../admin/private/initialize.php";

$user_id = $_SESSION['user_id'];
$user_master = BookUserMaster::find_by_custom_id('user_id', $user_id);

if (isset($_POST["action"])) {
    if (!isset($_POST['book_id'])) {
        $series_id = $_POST['book_series'];
        $s_data = BookSeries::find_by_series_id($_POST['book_series']);
    } elseif (isset($_POST['book_id'])) {
        $series_id = $_POST['book_id'];
        $s_data = BookSeries::find_by_series_id($_POST['book_id']);
    }
?>
    <style>
        .tabs {
            display: none;
        }

        .active {
            display: block;
        }
    </style>
    <style>
        .tab-link:hover,
        li.current {
            background: #ffe5ec;
            color: #cd1a1a;
        }

        .tab-container {
            background: #881f38;
            border-radius: .5rem .5rem 0 0;
        }

        ul.tabs {
            list-style: none;
            font-size: 2.75vmin;
            line-height: 1.6;
            display: flex;
        }

        ul.tabs li {
            width: 25%;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 15px;
            border: 2px solid #881f38;
            cursor: pointer;
        }

        ul.tabs,
        .tab-link {
            transition: all 0.5s ease-in-out;
        }

        .tab-link:hover {
            color: #ab2348 !important;
        }

        /* .current {
	color: #881f38 !important;
} */

        /* ==== CONTENT ==== */
        .tab-content {
            display: none;
            padding: 1vmin 5vmin 5vmin 5vmin;
            transition-property: transform, opacity;
            transition-duration: 0.4s;
            transition-timing-function: ease-out;
        }

        .tab-content.current {
            display: inherit;
            background: #dee2e6c2;
            border-radius: 0 0 0.5rem 0.5rem;
            margin-top: 29px;
            animation: fade 0.3s ease-in-out both;
        }

        @keyframes fade {
            0% {
                opacity: 0;
                transform: translateY(2rem);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .book-tab-content h2 {
            font-size: 20px;
            margin-top: 10px;
            margin-bottom: 11px;
        }

        .book-tab-content p {
            color: #000;
        }

        .owl-carousel .owl-dots.disabled,
        .owl-carousel .owl-nav.disabled {
            display: block;
        }

        .actives {
            color: #b00111 !important;
        }

        .btc_c ul li {
            color: #000 !important;
        }
    </style>
    <div class="tab__container ">
        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
            <div class="row">
                <!-- Start -->
                <div class="product product__style--3 col-lg-5 col-md-6 col-sm-6 col-12">
                    <div class="product__style--details">
                        <div class="product__thumb">
                            <img src="admin/<?php echo $s_data->picture_path(); ?>">
                        </div>
                    </div>
                </div>
                <!-- End -->
                <!-- Start -->
                <div class="product product__style--3 prostye col-lg-7 col-md-6 col-sm-6 col-12">
                    <h4 class="madhu-bal-text"> <?php echo $s_data->series_title; ?> </h4>
                    <div class="product__style--detailss">
                        <div class="product__author_book">
                            <p><?php echo $s_data->series_author ?></p>
                        </div>
                        <div class="product__author_des mt-2">
                            <p><?php echo $s_data->series_detail ?></p>
                        </div>
                        <div class="product__author mt-5">
                            <a href="" data-bs-toggle="modal" data-bs-target="#speciman-modal" class="view-buttons">Request a specimen Copy</a>

                            <?php if ($s_data->sample_pdf !== '') { ?>
                                <a href="admin/images/sample_pdf/<?php echo $s_data->sample_pdf ?>" class="view-buttons" target="blank">Download an E-Sample</a>
                            <?php } ?>

                            <a data-bs-toggle="modal" data-bs-target="#Review-modal" class="view-buttons">Submit Review</a>

                        </div>
                    </div>
                </div>
                <!-- End -->
            </div>
        </div>
    </div>
    <section class="mt--40">
        <div class="container">
            <main>
                <div class="tab-container">
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="overview">About the Authors</li>
                        <li class="tab-link" data-tab="features">About the Series</li>
                        <li class="tab-link" data-tab="screenshots">Salient Features</li>
                        <li class="tab-link" data-tab="faq">Supporting Material</li>
                    </ul>
                </div>

                <div id="overview" class="tab-content current">
                    <div class="book-tab-content btc_c">
                        <h2>About Author</h2>
                        <p><?php echo $s_data->series_about_author ?></p>
                    </div>
                </div>
<style>
    .author-scrollss{
      width: 137px;
                height: 269px;
                overflow-y: scroll;
    }
</style>
                <div id="features" class="tab-content">
                    <div class="book-tab-content btc_c">
                        <h2>About the Series</h2>
                        <div class="row" style="background:#fff;padding:10px;">
                            <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                                <div class="shop_sidebar">
                                    <aside class="widget__categories-books products--cat">
                                        <ul class="author-scrollss">
                                            <?php
                                            $series_class = BookSeriesClass::find_by_series_class($series_id);

                                            foreach ($series_class as $class_series) {
                                                $class_data = BookClass::find_by_id($class_series->sc_class_id);
                                            ?>
                                                <li>
                                                    <div class="form-group frm-gg class_checkbox">
                                                        <input type="checkbox" id="<?php echo $class_data->class_id ?>" class="common_checkbox class_id" value="<?php echo $class_data->class_id; ?>" name="myCheckbox1">
                                                        <label for="<?php echo $class_data->class_id  ?>"><?php echo $class_data->class_title ?></label>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </aside>
                                </div>
                            </div>
                            <div class="col-lg-9 col-12 order-1 order-lg-2 d-block" id="class_detail">

                            </div>
                        </div>
                    </div>
                </div>
         <style>
.btc_c ul {
    list-style: disc !important;
}
         </style>
                <div id="screenshots" class="tab-content">
                    <div class="book-tab-content btc_c">
                        <h2>Salient Features</h2>
                         
                          <?php echo $s_data->series_salient_feature ?> 
                        
                    </div>
                </div>

                <div id="faq" class="tab-content">
                    <div class="book-tab-content btc_c">
                        <h2>Supporting Material</h2>
                        <p><?php echo $s_data->series_supporting_material ?></p>
                    </div>
                </div>
            </main>
        </div>
    </section>
<?php
}
?>

<script>
    $(document).ready(function() {
        $('ul.tabs li').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        })
    });
</script>
<script>

</script>