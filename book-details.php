<?php
require_once "admin/private/initialize.php";
$mail_t = EmailtemplateMaster::find_by_mailtemplate_id(112);
$admin_spiciman = EmailtemplateMaster::find_by_mailtemplate_id(113);
$mail_data = EmailtemplateMaster::find_by_mailtemplate_id(104);
$mail_data2 = EmailtemplateMaster::find_by_mailtemplate_id(105);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if (isset($_GET['series_id'])) {
    $series_id = $_GET['series_id'];
    $s_data = BookSeries::find_by_series_id($series_id);


    if (isset($_POST['submit'])) {
        $name = htmlentities($database->escape_string($_POST['review']['name']));
        $email = htmlentities($database->escape_string($_POST['review']['email']));

        $mail = new PHPMailer();
        $mail->Host = "mail.madhubunbooks.com";
        $mail->Port  = 465; 
       
          $swap_var = array(
            "{DATE}" => $time,
            "{USERNAME}" =>  $name
        );

        $mail->addAddress($email);
        $mail->setFrom('marketing@madhubunbooks.com');
        $mail->FromName = 'Madhubun Books';
        $mail->Subject = 'Review';

        $mail->isHTML(true);

        $body = strtr($mail_data->mail_message, $swap_var);

        $mail->Body = $body;


        if ($mail->send()) {

            $args = $_POST['review'];
            $review = new Review($args);
            $review->review = $name;
            $review->email = $email;
            $review->series_id = $s_data->series_id;
            $review->user_id = '1';
            $result = $review->save('id');

            if ($result) {
                $_SESSION['r_status_pop'] = "Review Submitted";
                $_SESSION['r_status_pop_code'] = "success";
                header("Refresh:2;");
            } else {
                $_SESSION['r_status_pop'] = "Something Wrong";
                $_SESSION['r_status_pop_code'] = "error";
            }
        } else {
            echo $mail->Errorinfo;
        }
    }

 

    $admin_review_email = $_POST['admin_review_email'];
    $mails = new PHPMailer();
    $mails->Host = "mail.madhubunbooks.com";
    $swap_var2 = array(
        "{FEEDBACK_DATA}" =>  'Feedback Recieved'
    );
    $mails->addAddress($admin_review_email);
    $mails->setFrom('marketing@madhubunbooks.com');
    $mails->FromName = 'Madhubun Books';
    $mails->Subject = 'Feedback in Madhubun Educational E-Books';
    $mails->isHTML(true);

    $body2 = strtr($mail_data2->mail_message, $swap_var2);

    $mails->Body = $body2;

    if ($mails->send()) {
    } else {
        echo $mail->Errorinfo;
    }
}


if (isset($_POST['r_submit'])) {
    $request_name = htmlentities(trim($_POST['specimen']['request_name']));
    $request_email = htmlentities(trim($_POST['specimen']['request_email']));
    $request_mobile = htmlentities(trim($_POST['specimen']['request_mobile']));
    $request_school_name = htmlentities(trim($_POST['specimen']['request_school_name']));
    $request_msg = htmlentities(trim($_POST['specimen']['request_msg']));

    // if we want to send via SMTP

    $mail = new PHPMailer();
    $mail->Host = "mail.madhubunbooks.com";
    $swap_var2 = array(
        "{DATE}" => $time,
        "{USERNAME}" =>  $request_name
    );
    $mail->setFrom('marketing@madhubunbooks.com');
    $mail->FromName = 'Madhubun Books';
    $mail->addAddress($request_email);
    $mail->Subject = $mail_t->mail_subject;
    $body = strtr($mail_t->mail_message, $swap_var2);
    $mail->Body = $body;

    if ($mail->send()) {
        $args = $_POST['specimen'];
        $request = new Specimancopyrequest($args);

        $request->request_for_id = $s_data->series_id;
        $request->request_by = $user_id;

        $result = $request->save('request_id');

        if ($result) {
            $_SESSION['status_pop'] = "Request Submitted";
            $_SESSION['status_pop_code'] = "success";
        } else {
            $_SESSION['status_pop'] = "Something Wrong";
            $_SESSION['status_pop_code'] = "error";
        }
    } else {

        echo $mail->Errorinfo;
    }

    $admin_email = $_POST['admin_email'];
    $mails = new PHPMailer();
    $mails->Host = "mail.madhubunbooks.com";
    $swap_var3 = array(
        "{USER_DATA}" => 'Spicimen Request',
        "{SPECIMEN_DATA}" => $request_name . ',' . $request_school_name . ',' . $request_msg
    );
    $mails->addAddress($admin_email);
    $mails->setFrom('marketing@madhubunbooks.com');
    $mails->FromName = 'Madhubun Books';
    $mails->Subject = $admin_spiciman->mail_subject;
    $mails->isHTML(true);

    $body3 = strtr($admin_spiciman->mail_message, $swap_var3);

    $mails->Body = $body3;

    if ($mails->send()) {
    } else {
        echo $mail->Errorinfo;
    }
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <base href="<?php echo $base_url ?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Books Details | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <?php include 'includes/head.php' ?>
</head>
<style>
    .tabs {
        display: none;
    }

    .active {
        display: block;
    }
    #event-banner .owl-prev {
        display:none;
    }
    #event-banner .owl-next {
        display:none;
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

    .current {
        color: #881f38 !important;
    }

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

    .form_err {
        font-size: 12px;
        font-weight: 600;
        color: red;
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
        <input type="hidden" id="book_series" value="<?php echo $series_id ?>">
        <div class="ht__breadcrumb__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-centers">
                            <nav class="breadcrumb-content d-flex">
                                <a class="breadcrumb_item" href="index">Books ></a>
                                <span class="breadcrumb_item"><?php echo $s_data->subject_name($s_data->series_subject) ?> ></span>
                                <span class="breadcrumb_item active"><?php echo $s_data->series_title; ?></span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Search Popup -->

        <!-- Start Shop Page -->
         
       
        <style>
            .author-scrolls {
                width: 300px;
                height: 258px;
                overflow-y: scroll;
            }
        </style>
        <div class="mt-2">
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
                        <h3 class="widget__title_book">By Title <img src="img/filter.svg" class="bk-img"></h3>
                        <div class="shop_sidebar">
                            <aside class="widget__categories-books products--cat">
                                <ul class="author-scrolls">
                                    <?php
                                    $series_book = $subject_sql_data = BookSeries::find_by_series_subject($s_data->series_subject);
                                    foreach ($series_book as $book_series) {
                                    ?>
                                        <li>
                                            <div class="form-group frm-gg in-desktop-query">
                                                <input type="checkbox" id="<?php echo $book_series->series_id ?>" class="common_checkbox book_id" value="<?php echo $book_series->series_id; ?>" name="myCheckbox">
                                                <label for="<?php echo $book_series->series_id  ?>"><?php if (strlen($book_series->series_title) > 23) {
                                                                                                        echo substr($book_series->series_title, 0, 23) . '...';
                                                                                                    } else {
                                                                                                        echo $book_series->series_title;
                                                                                                    } ?></label>
                                            </div>
                                            <!-- Media Query -->
                                            <div class="form-group frm-gg in-media-query d-none">
                                                <input type="checkbox" id="<?php echo $book_series->series_id ?>" class="common_checkbox book_id" value="<?php echo $book_series->series_id; ?>" name="myCheckbox">
                                                <label for="<?php echo $book_series->series_id  ?>"><?php if (strlen($book_series->series_title) > 35) {
                                                                                                        echo substr($book_series->series_title, 0, 35) . '...';
                                                                                                    } else {
                                                                                                        echo $book_series->series_title;
                                                                                                    } ?></label>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </aside>
                        </div>
                        <div class="digital_browse">
                            <h4>Browse by Subject</h4>
                            <ul>
                                <?php $subject_data = BookSubject::find_by_sort_order();
                                foreach ($subject_data as $subject) {
                                    if ($subject->subject_id == $s_data->series_subject) {
                                        $s = 'actives';
                                    } else {
                                        $s = '';
                                    }

                                ?>
                                    <li><a href="books-list/<?php echo $subject->subject_filename ?>" class="<?php echo $s ?>"><?php echo $subject->subject_title ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>
                    <div class="col-lg-9 col-12 order-1 order-lg-2 d-block product_filter">

                    </div>
                </div>
            </div>
        </div>


        <!-- End Shop Page -->

        <section>
            <div class="container new-r-s">
                <div class="row">
                    <div class="text-center new-releases">
                        <h4>NEW RELEASES</h4>
                    </div>
                    <div class="col-lg-12">
                        <div class="book-detail-m">
                            <div id="Newsroom-slider" class="owl-carousel">
                                <?php $new_books_series = BookSeries::find_by_series_as_new();
                                foreach ($new_books_series as $series_as_new) {
                                ?>
                                    <div class="item">
                                        <div class="madhubun-news-content">
                                            <div class="madhubun-news-img">
                                                <div class="news-pro2">
                                                    <a href="book-details/<?php echo $series_as_new->series_id ?>"><img src="admin/<?php echo $series_as_new->picture_path() ?>" alt=""></a>
                                                </div>
                                                <div class="news-re-title">
                                                    <h6><?php echo $series_as_new->book_title ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include 'includes/footer.php' ?>

        <div class="modal fade" id="Review-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title review-t">Book Review</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-bodys">
                        <div class="row review_form">
                            <form method="post" onsubmit="return r_validation()">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="review[name]" id="r_name" placeholder="Enter Name">
                                        <div class="form_err" id="r_name_err"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="review[email]" id="r_email" placeholder="Enter Email">
                                        <div class="form_err" id="r_email_err"></div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="form-label">Write Review</label>
                                        <textarea type="text" class="form-control" name="review[message]" id="r_massage" placeholder="Review"></textarea>
                                        <div class="form_err" id="r_message_err"></div>
                                    </div>
                                    <input type="hidden" name="review[created_at]" value="<?php echo $time; ?>">
                                    <input type="hidden" name="review['series_id']" value="">
                                    <input type="hidden" name="admin_review_email" value="<?php echo $mail_data2->mail_to_admin ?>">
                                </div>
                                <div class="madhu-review">
                                    <button type="submit" name="submit" class="btn-review">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!--<div class="modal-footer">-->
                    <!--  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>-->
                    <!--</div>-->

                </div>
            </div>
        </div>

        <!--Spicemen Modal-->
        <div class="modal fade" id="speciman-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title review-t">REQUEST A SPECIMEN COPY</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-bodys">
                        <div class="row review_form">
                            <form method="post" onsubmit="return validation()">
                                <div class="row mt-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Name: <span>*</span></label>
                                            <input type="text" class="form-control" name="specimen[request_name]" id="s_name" placeholder="Enter Name">
                                            <div class="form_err" id="s_name_err"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Email: <span>*</span></label>
                                            <input type="email" class="form-control" name="specimen[request_email]" id="s_email" placeholder="Enter Email">
                                            <div class="form_err" id="s_email_err"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Contact: <span>*</span></label>
                                            <input type="text" class="form-control" name="specimen[request_mobile]" id="s_mobile" placeholder="Enter Contact" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
                                            <div class="form_err" id="s_mobile_err"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">School Name: <span>*</span></label>
                                            <input type="text" class="form-control" name="specimen[request_school_name]" id="ss_name" placeholder="Enter School Name">
                                            <div class="form_err" id="ss_name_err"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name">Message(Optional): <span>*</span></label>
                                            <textarea type="text" class="form-control" name="specimen[request_msg]" placeholder="Enter Message"></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="specimen[request_date_time]" value="<?php echo $time ?>">
                                    <input type="hidden" name="request_for_id">
                                    <input type="hidden" name="admin_email" value="<?php $admin_spiciman->mail_to_admin ?>">
                                    <div class="publish-submit text-center">
                                        <button type="submit" name="r_submit" class="custom-btn btn-5 request_epd">Request Specimen</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
    <!-- //Main wrapper -->
    <?php include 'includes/foot.php' ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function validation() {
            var s_name = document.getElementById("s_name").value;
            var s_email = document.getElementById("s_email").value;
            var s_mobile = document.getElementById("s_mobile").value;
            var ss_name = document.getElementById("ss_name").value;

            if (s_name == "") {
                document.getElementById("s_name_err").innerHTML = "Please enter your name*";
                return false;
            } else {
                document.getElementById("s_name_err").innerHTML = "";
            }
            if (s_email == "") {
                document.getElementById("s_email_err").innerHTML = "Please enter your email*";
                return false;
            } else {
                document.getElementById("s_email_err").innerHTML = "";
            }
            if (s_mobile == "") {
                document.getElementById("s_mobile_err").innerHTML = "Please enter your p number*";
                return false;
            } else {
                document.getElementById("s_mobile_err").innerHTML = "";
            }
            if (ss_name == "") {
                document.getElementById("ss_name_err").innerHTML = "Please enter your school name*";
                return false;
            } else {
                document.getElementById("ss_name_err").innerHTML = "";
            }
        }
    </script>
    <script>
        function r_validation() {
            var r_name = document.getElementById("r_name").value;
            var r_email = document.getElementById("r_email").value;
            var r_massage = document.getElementById("r_massage").value;

            if (r_name == "") {
                document.getElementById("r_name_err").innerHTML = "Please enter your name*";
                return false;
            } else {
                document.getElementById("r_name_err").innerHTML = "";
            }
            if (r_email == "") {
                document.getElementById("r_email_err").innerHTML = "Please enter your email*";
                return false;
            } else {
                document.getElementById("r_email_err").innerHTML = "";
            }
            if (r_massage == "") {
                document.getElementById("r_message_err").innerHTML = "Please enter Message";
                return false;
            } else {
                document.getElementById("r_message_err").innerHTML = "";
            }
        }
    </script>
    <?php
    if (isset($_SESSION['r_status_pop'])) {
    ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['r_status_pop']; ?>",
                icon: "<?php echo $_SESSION['r_status_pop_code']; ?>",
                button: "Ok",
            });
            <?php
            unset($_SESSION['r_status_pop']);
        }
            ?>
        </script>
        </script>
        <?php
        if (isset($_SESSION['status_pop'])) {
        ?>
            <script>
                swal({
                    title: "<?php echo $_SESSION['status_pop']; ?>",
                    icon: "<?php echo $_SESSION['status_pop_code']; ?>",
                    button: "Ok",
                });
                <?php
                unset($_SESSION['status_pop']);
            }
                ?>
            </script>

            <script>
                $(document).ready(function() {
                    $('.book_id').on('click', function() {
                        $('.book_id').not(this).prop('checked', false);
                    });



                    filter_data();

                    function filter_data() {
                        $('.filter_data').html('<div id="loading" style="" ></div>');
                        var action = 'ajax/book-list';
                        var book_id = get_filter('book_id');
                        var series = $("#book_series").val()
                        $.ajax({
                            url: "ajax/book-list",
                            method: "POST",
                            data: {
                                action: action,
                                book_id: book_id,
                                book_series: series
                            },
                            success: function(data) {
                                $('.product_filter').html(data);
                                if ($('.class_id')[0].checked = true) {
                                    var value = $('input[name="myCheckbox1"]:checked').val();
                                    var book_id = get_filter('book_id');
                                    var series = $("#book_series").val();
                                    $.ajax({
                                        type: "post",
                                        url: "ajax/class_book_detail",
                                        data: {
                                            class_d: value,
                                            book_id: book_id,
                                            book_series: series
                                        },
                                        success: function(data) {
                                            $('#class_detail').html(data);
                                        }
                                    });
                                }
                            }
                        });
                    }

                    $(document).on("click", ".class_id", function() {
                        $('.class_id').not(this).prop('checked', false);
                        var value = $(this).val();
                        var book_id = get_filter('book_id');
                        var series = $("#book_series").val()
                        $.ajax({
                            type: "post",
                            url: "ajax/class_book_detail",
                            data: {
                                class_d: value,
                                book_id: book_id,
                                book_series: series
                            },
                            success: function(data) {
                                $('#class_detail').html(data);
                            }
                        });
                    });

                    function get_filter(class_name) {
                        var filter = $('.' + class_name + ':checked').val();

                        return filter;
                    }

                    $('.common_checkbox').click(function() {
                        filter_data();
                    });




                    $(document).on('click', '.add_favor', function(e) {
                        e.preventDefault();

                        var x = confirm('Book Added Succesfully');
                        if (x == true) {
                            var id = $(this).attr('id');
                            console.log(id);
                            $.ajax({
                                type: "POST",
                                url: "ajax/favourite_books",
                                data: {
                                    book_id: id
                                },
                                success: function(data) {
                                    //window.location.reload();
                                }
                            });
                        }
                    });
                });
            </script>
</body>

</html>