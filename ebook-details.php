<?php
require_once "admin/private/initialize.php";
$mail_data = EmailtemplateMaster::find_by_mailtemplate_id(104);
$a_mail_data = EmailtemplateMaster::find_by_mailtemplate_id(105);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if (isset($_GET['book_id'])) {
    $ebook_id = $_GET['book_id'];
    $e_books = BookMaster::find_by_book_id($ebook_id);

    if (is_post_request()) {
        $name = htmlentities($database->escape_string($_POST['review']['name']));
        $email = htmlentities($database->escape_string($_POST['review']['email']));
        $message = htmlentities($database->escape_string($_POST['review']['message']));
        $mail = new PHPMailer();
        $mail->Host = "mail.madhubunbook.com";

        $swap_var = array(
            "{DATE}" => $time,
            "{USERNAME}" =>  $name
        );

        $mail->addAddress($email);
        $mail->setFrom('marketing@madhubunbooks.com');
        $mail->FromName = 'Madhubun Books';
        $mail->Subject = $mail_data->mail_subject;
        $mail->isHTML(true);

        $body = strtr($mail_data->mail_message, $swap_var);

        $mail->Body = $body;

        if ($mail->send()) {
            $args = $_POST['review'];
            $review = new Review($args);
            $review->review = $name;
            $review->series_id = $e_books->book_id;
            $review->user_id = '1';
            $result = $review->save('id');

            if ($result) {

                $_SESSION['status_pop'] = "Review Submitted";
                $_SESSION['status_pop_code'] = "success";
                header('Refresh:3;');
            } else {
                $_SESSION['status_pop'] = "Something wrong";
                $_SESSION['status_pop_code'] = "error";
            }
        } else {
            echo $mail->Errorinfo;
        }
    }


    $admin_email = $_POST['admin_email'];
    $mails = new PHPMailer();
    $mails->Host = "mail.madhubunbook.com";
    $swap_var2 = array(

        "~#FEEDBACK_DATA#~" =>  $name . ',' . $email . ',' . $message
    );

    $mails->addAddress($admin_email);
    $mails->setFrom('marketing@madhubunbooks.com');
    $mails->FromName = 'Feedback';
    $mails->Subject = 'Feedback in Madhubun Educational E-Books';
    $mails->isHTML(true);

    $body = strtr($a_mail_data->mail_message, $swap_var2);

    $mails->Body = $body;

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
    <title>E-Books Details | Madhubunbooks</title>
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
    .btc_c ul li {
            color: #000 !important;
        }
        #event-banner .owl-prev {
        display:none;
    }
    #event-banner .owl-next {
        display:none;
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
                            <nav class="breadcrumb-content d-flex">
                                <a class="breadcrumb_item">E-Books ></a>
                                <span class="breadcrumb_item"><?php echo $e_books->subject_name($e_books->book_subject) ?> > </span>
                                <span class="breadcrumb_item active"><?php echo $e_books->book_title ?></span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Search Popup -->

        <!-- Start Shop Page -->
         
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
                    <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                        <div class="digital_browse">
                            <h4>Browse by Subject</h4>
                            <ul>
                                <?php $subject_data = BookSubject::find_by_sort_order();
                                foreach ($subject_data as $subject) {

                                    if ($subject->subject_id == $e_books->book_subject) {
                                        $s = 'actives';
                                    } else {
                                        $s = '';
                                    }

                                ?>
                                    <li><a href="ebooks-list/<?php echo $subject->subject_filename ?>" class="<?php echo $s ?>"><?php echo $subject->subject_title ?></a></li>
                                <?php } ?>
                            </ul>

                        </div>
                    </div>
                    <div class="col-lg-9 col-12 order-1 order-lg-2 d-block">

                        <div class="tab__container ">
                            <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                                <div class="row">
                                    <!-- Start -->
                                    <div class="product product__style--3 col-lg-5 col-md-6 col-sm-6 col-12">
                                        <div class="product__style--details">
                                            <div class="product__thumb">
                                                <a class="first__imgs" href=""><img src="admin/<?php echo $e_books->picture_path() ?>" alt="product image"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <!-- Start -->
                                    <div class="product product__style--3 prostye col-lg-7 col-md-6 col-sm-6 col-12">
                                        <h4 class="madhu-bal-text"><?php echo $e_books->book_title; ?></h4>

                                        <div class="product__style--detailss">
                                            <div class="product__author_book">
                                                <p><?php echo $e_books->book_author ?></p>
                                            </div>
                                            <div class="product__author_des mt-2">
                                                <p><?php echo $e_books->book_detail ?></p>
                                            </div>
                                            <div class="product__author mt-5">
                                                <?php if ($e_books->book_amazon_link != "") { ?>
                                                    <a href="<?php echo $e_books->book_amazon_link ?>" target="blank" class="view-buttons"><img src="img/Amazon_Books.png" width="100"></a>
                                                <?php }  ?>
                                                <a href="<?php echo $e_books->book_google_link ?>" target="blank" class="view-buttons"><img src="img/Google_Play_books.png" height="25" width="75"></a>
                                                <?php if ($e_books->book_google_link == '') { ?>
                                                    <a href="<?php echo $e_books->book_amazon_link ?>" target="blank" class="view-buttons"><img src="img/Amazon_Books.png" width="100"></a>
                                                <?php } ?>

                                                <a data-bs-toggle="modal" data-bs-target="#Review-modal" class="view-buttons">Submit Review</a>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                </div>
                            </div>
                        </div>
                        <section class="mt--40 mb-5">
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
                                            <p><?php echo $e_books->book_author ?></p>

                                        </div>
                                    </div>
                                    <div id="features" class="tab-content">
                                        <div class="book-tab-content btc_c">
                                            <h2>About the Book</h2>
                                            <p><?php echo $e_books->book_detail ?></p>
                                        </div>
                                    </div>
                                    <div id="screenshots" class="tab-content">
                                        <div class="book-tab-content btc_c">
                                            <h2>Salient Features</h2>
                                            <p><?php echo $e_books->salient_features ?></p>
                                        </div>
                                    </div>
                                    <div id="faq" class="tab-content">
                                        <div class="book-tab-content btc_c">
                                            <h2>Supporting Material</h2>
                                            <p><?php echo $e_books->book_supporting_material ?></p>
                                        </div>
                                    </div>
                                </main>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>


        <!-- End Shop Page -->

        <style>
            .form_err {
                color: red;
                font-size: 12px;
                font-weight: 600;
            }
        </style>
        <!-- Footer Area -->
        <?php include 'includes/footer.php' ?>
        <!-- //Footer Area -->
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
                            <form method="post" onsubmit="return validation()">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="review[name]" id="name_" placeholder="Enter Name">
                                        <div class="form_err" id="name_err"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="review[email]" id="email_" placeholder="Enter Email">
                                        <div class="form_err" id="email_err"></div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="form-label">Write Review</label>
                                        <textarea type="text" class="form-control" name="review[message]" id="message_" placeholder="Review"></textarea>
                                        <div class="form_err" id="message_err"></div>
                                    </div>
                                    <input type="hidden" name="review[created_at]" value="<?php echo $time; ?>">
                                    <input type="hidden" name="admin_email" value="marketingmadhubun@gmail.com">
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

    </div>
    <!-- //Main wrapper -->
    <?php include 'includes/foot.php' ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function validation() {
            var name = document.getElementById("name_").value;
            var email = document.getElementById("email_").value;
            var message = document.getElementById("message_").value;

            if (name == '') {
                document.getElementById('name_err').innerHTML = "Please enter your name*";
                return false;
            } else {
                document.getElementById('name_err').innerHTML = "";
            }
            if (email == '') {
                document.getElementById('email_err').innerHTML = "Please enter your email*";
                return false;
            } else {
                document.getElementById('email_err').innerHTML = "";
            }
            if (message == '') {
                document.getElementById('message_err').innerHTML = "Please enter your message*";
                return false;
            } else {
                document.getElementById('message_err').innerHTML = "";
            }


        }
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
                $('ul.tabs li').click(function() {
                    var tab_id = $(this).attr('data-tab');

                    $('ul.tabs li').removeClass('current');
                    $('.tab-content').removeClass('current');

                    $(this).addClass('current');
                    $("#" + tab_id).addClass('current');
                })
            });
        </script>
</body>

</html>