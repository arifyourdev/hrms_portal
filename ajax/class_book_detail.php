<?php
require_once "../admin/private/initialize.php";

if (is_post_request()) {

    // $user_id = $_SESSION['user_id'];
    // $user_master = BookUserMaster::find_by_custom_id('user_id',$user_id);


    if (!isset($_POST['book_id'])) {
        $class = $_POST['class_d'];
        $series_id = $_POST['book_series'];
        $s_data_sql = BookMaster::find_book_by_class_new($_POST['book_series'], $class);
    } elseif (isset($_POST['book_id'])) {
        $class = $_POST['class_d'];
        $series_id = $_POST['book_series'];
        $s_data_sql = BookMaster::find_book_by_class_new($_POST['book_id'], $class);
    }

?>
    <style>
        #owl-demo .item img {
            display: block;

        }
    </style>

    <div class="row">
        <div class="col-lg-12">
            <div id="book-class-slider" class="owl-carousel owl-theme">
                <?php
                foreach ($s_data_sql as $s_data) {
                ?>

                    <div class="item">
                        <div class="row">
                            <div class="product product__style--3 col-lg-5">
                                <div class="product__style--details">
                                    <div class="product__thumb">
                                        <img src="admin/<?php echo $s_data->picture_path(); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="product product__style--3 prostye col-lg-7">
                                <h4 class="madhu-bal-text"><?php echo $s_data->book_title; ?></h4>
                                <div class="product__style--detailss">
                                    <div class="product__author_book">
                                        <p><?php echo $s_data->book_author ?></p>
                                    </div>
                                    <div class="product__author_des mt-2">
                                        <p><b>ISBN</b> : <?php echo $s_data->book_isbn ?></p>
                                        <p><b>PRICE</b> : <?php echo $s_data->book_price ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>

<?php }  ?>

<script>
    $('#book-class-slider').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
</script>