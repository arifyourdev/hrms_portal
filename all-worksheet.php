<?php
require_once "admin/private/initialize.php";
user_login();

$user_id = $_SESSION['user_id'];
$user_master = BookUserMaster::find_by_custom_id('user_id', $user_id);
$user_profile = BookUserProfile::find_by_profile_user_id($user_id);

// if (isset($_GET['page'])) {
//     $chapter = BookChapterLog::find_by_all_chapter($_GET['page']);
// }

if(is_post_request())
{
    $all_chapters = BookChapterLog::find_by_chapter_worksheet($_POST['book_id']);
    
    $zipname = 'allworksheet.zip';
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
    foreach($all_chapters as $file) 
    {
        $zip->addFile($file->view_worksheet());
    }
    $zip->close();
    
    if(file_exists($zip_name))
    {
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: '.filesize($zipname));
        readfile($zipname);
        unlink($zipname);
    }
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <base href="<?php echo $base_url ?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>My Worksheets | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'includes/head.php' ?>
</head>

<body>
    <style>
        .active a{
            color: #a32c4c !important;
            font-weight: 500 !important;
        }

        .product__thumb img{
            height: 230px;
        }
    </style>

    <div class="wrapper" id="wrapper">

        <?php include 'includes/header.php' ?>

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

        <!-- End Search Popup -->

        <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="text-center">
                    <h5 style="color: darkgreen;"><?php echo display_session_message() ?></h5>
                </div>
            <?php } ?>
            <div class="container">
                <div class="row mt-3">
                    <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                        <div class="shop__sidebar">
                            <aside class="tabs-nav">
                                <div class="my_profile_text">
                                    <h5>My Account</h5>
                                </div>
                                <ul class="my_profile_ul">
                                    <li class=" active"><a href="my-profile#edit_profile"><i class="fa-solid fa-user"></i> Edit Profile</a></li>
                                    <li class=""><a href="my-profile#subscription"><i class="fa-solid fa-subscript"></i> My Subscription</a></li>
                                    <li class=""><a href="all-worksheet"><i class="fa fa-book" aria-hidden="true"></i> Worksheets</a></li>
                                    <li class=""><a href="all-answer-key"><i class="fa fa-download" aria-hidden="true"></i> Answer Keys</a></li>
                                    <li class=""><a href="my-profile#favourite"><i class="fa-solid fa-heart"></i> My Favourite</a></li>
                                    <li class=""><a href="my-profile#change_password"><i class="fa-solid fa-lock"></i>Change Password</a></li>
                                    <li class=""><a href="my-profile#resources"><i class="fa-solid fa-file-export"></i> Request Resources</a></li>
                                    <li><a href="../logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12 order-1 order-lg-2">
                        <div class="content tabs-content">
                            <div class="about-lft my_p" id="worksheets">
                                <div class="all_background_">
                                    <h5>All Worksheets</h5>
                                    <div class="profile_form__">
                                        <div class="table-responsive">
                                            <table class="table table-responsive table-borderless">

                                                <thead>
                                                    <tr class="bg-light">
                                                        <th scope="col" width="5%">#</th>
                                                        <th scope="col" width="20%">Book</th>
                                                        <th scope="col" width="10%">Total Chapter</th>
                                                        <th scope="col" width="5%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $s = 1;
                                                    $r_sql = BooksRrequest::worksheet_find_by_user_id($user_id);
                                                    foreach($r_sql as $request) {
                                                     $book_data = BookMaster::find_by_book_id($request->request_book_id);
                                                     $all_chapters = BookChapterLog::find_by_all_chapter($request->request_book_id);
                                                     ?>
                                                    <tr>
                                                        <td><?php echo $s; ?></td>
                                                        <td><?php echo $book_data->book_title?></td>
                                                        <td><?php echo $all_chapters ?></td>
                                                        <td>
                                                            <form method="post">
                                                                <input type="hidden" name="book_id" value="<?php echo $request->request_book_id; ?>">
                                                                <button type="submit" name="all_download_submit" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php $s++; } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Worksheets-->

                        </div>
                    </div>
                </div>
            </div>
            <!-- Start About Area -->
            <div class="page-about about_area bg--white section-padding--lg">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-sm-12 col-12">

                        </div>
                    </div>
                </div>

            </div>
            <!-- End About Area -->

            <style>
            .tabs-content .my_p:not(:first-child) {
                display: none;
            }
            </style>

            <!-- Footer Area -->
            <?php include 'includes/footer.php' ?>
            <!-- //Footer Area -->

        </div>
        <!-- //Main wrapper -->
        <!-- JS Files -->
        <?php include 'includes/foot.php' ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("body").on("click", ".add_m_btn", function() {
                    var html = $(".after-add-more").first().clone();

                    //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

                    $(html).find(".change").html();


                    $(".after-add-more").last().after(html);



                });

            });
        </script>
        <script>
            $(function() {
                $('.tabs-nav a').click(function() {

                    // Check for active
                    $('.tabs-nav li').removeClass('active');
                    $(this).parent().addClass('active');

                    // Display active tab
                    let currentTab = $(this).attr('href');
                    $('.tabs-content .my_p').hide();
                    $(currentTab).show();
                    window.location.hash = e.target.hash;

                    return false;
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                var hash = location.hash.replace(); // ^ means starting, meaning only match the first hash
                get_data(hash);
                $(document).on("click", ".my-profile_label a", function() {
                    var id = $(this).attr("href");

                    var hash = id.replace('my-profile', '');
                    get_data(hash);
                });

                function get_data(hash) {
                    if (hash) {
                        if ($('.tabs-nav li a[href="' + hash + '"]').length > 0) {
                            $('.tabs-nav li').removeClass('active');
                            $('a[href="' + hash + '"]').parent().addClass('active');
                            $('.tabs-content .my_p').hide();
                            $(hash).show();

                        } else {
                            $('.tabs-content .my_p').hide();
                        }

                    }
                }


            });

            // Change hash for page-reload
            $('.tabs-nav li a').on('shown.bs.tab', function(e) {
                window.location.hash = e.target.hash;
            })
        </script>
        <script>
            $(document).ready(function() {
                $('#subject_id').on('change', function() {
                    var subject_id = this.value;
                    $.ajax({
                        url: "ajax/get_series",
                        type: "POST",
                        data: {
                            subject_id: subject_id
                        },
                        cache: false,
                        success: function(result) {
                            $("#series_id").html(result);
                            // $('#class_id').html('<option value="">Select Series First</option>'); 
                        }
                    });
                });

                $('#series_id').on('change', function() {
                    var series_id = this.value;
                    $.ajax({
                        url: "ajax/get_class",
                        type: "POST",
                        data: {
                            series_id: series_id
                        },
                        cache: false,
                        success: function(result) {
                            $("#class_id").html(result);
                        }
                    });
                });
            });

            // Add More

            $(document).ready(function() {
                var maxField = 50;
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                // var fieldHTML = '<a href="javascript:void(0);" class="remove_button remove_m_btn"><i class="fa-solid fa-minus"></i></a></div>';
                var x = 1;
                $(addButton).click(function() {
                    if (x < maxField) {
                        x++;
                        $(wrapper).append(fieldHTML);
                    }
                });

                $(wrapper).on('click', '.remove_button', function(e) {
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                });
            });
        </script>

</body>

</html>