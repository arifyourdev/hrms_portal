<?php
require_once "admin/private/initialize.php";
user_login();

$user_id = $_SESSION['user_id'];
$user_master = BookUserMaster::find_by_custom_id('user_id', $user_id);
$user_profile = BookUserProfile::find_by_profile_user_id($user_id);

if (isset($_GET['page'])) {
    $chapter = BookChapterLog::find_book_chapter($_GET['page']);
    $book_detail = BookMaster::find_by_book_id($_GET['page']);
}

if (is_post_request($_POST['all_download_submit'])) {
    $request_id = $_POST['request_id'];

    $zipname = 'answer-key.zip';
    $zip = new ZipArchive;
    $tmp_file = tempnam('.','');
    $zip->open($tmp_file, ZipArchive::CREATE);
    foreach ($request_id as $file) {
        $download_file = file_get_contents($file);
        $zip->addFromString(basename($file),$download_file);
    }
    $zip->close();

    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename='.$zipname);
    readfile($tmp_file);

    unlink($zipname);
}

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <base href="<?php echo $base_url ?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Answer Key | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include 'includes/head.php' ?>
</head>

<body>
    <style>
        .active a {
            color: #a32c4c !important;
            font-weight: 500 !important;
        }

        .product__thumb img {
            height: 230px;
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
                                    <li class=""><a href="my-profile#edit_profile"><i class="fa-solid fa-user"></i> Edit Profile</a></li>
                                    <li class="active"><a href="my-profile#subscription"><i class="fa-solid fa-subscript"></i> My Subscription</a></li>
                                    <li class=""><a href="my-profile#change_password"><i class="fa-solid fa-lock"></i>Change Password</a></li>
                                    <li class=""><a href="my-profile#resources"><i class="fa-solid fa-file-export"></i> Request Resources</a></li>
                                    <li><a href="../logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                                </ul>
                            </aside>

                        </div>
                    </div>
                    <div class="col-lg-9 col-12 order-1 order-lg-2">
                        <div class="content tabs-content">

                            <!--Worksheets-->
                            <div class="about-lft my_p" id="worksheets">
                                <div class="all_background_">
                                    <h5>My Subscription/Answer Key For <?php echo $book_detail->book_title ?></h5>
                                    <form method="post">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-sm btn-outline-success check_button" disabled name="all_download_submit"><i class="fa fa-download" aria-hidden="true"></i> Download Selected Ans Book List</button>
                                        </div>

                                        <div class="profile_form__">
                                            <div class="table-responsive">
                                                <table class="table table-responsive table-borderless">

                                                    <thead>
                                                        <tr class="bg-light">
                                                            <th scope="col" width="5%"><input type="checkbox" id="check_b" onClick="selectall(this)"></th>
                                                            <th scope="col" width="5%">#</th>
                                                            <th scope="col" width="20%">Chapter</th>
                                                            <th scope="col" width="10%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $s = 1;
                                                        foreach ($chapter as $c) { ?>
                                                            <tr>
                                                                <th scope="row"><input type="checkbox" class="check_b2" name="request_id[]" class="sin_check" value="admin/images/book_brochures/<?php echo $c->clog_worksheet_ans ?>"></th>
                                                                <td><?php echo $s; ?></td>
                                                                <td><?php echo $c->clog_chapter_id ?></td>
                                                                <td><a href="admin/images/book_brochures/<?php echo $c->clog_worksheet_ans ?>"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                                                            </tr>
                                                        <?php $s++;
                                                        } ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </form>
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
              function selectall(source) {
              checkboxes = document.getElementsByName('request_id[]');
             for(var i=0, n=checkboxes.length;i<n;i++) {
             checkboxes[i].checked = source.checked;
           }
         }

         $('#check_b').click(function () {
               if ($(this).prop('checked')) {
           
              $('.check_button').removeAttr('disabled'); //enable input
             }
            else {
            $('.check_button').prop('disabled', true); //disable input
          }
           });

           $('.check_b2').click(function () {

             if ($(this).prop('checked')) {
           
              $('.check_button').removeAttr('disabled'); //enable input
             }
            else {
            $('.check_button').prop('disabled', true); //disable input
          }
           });
        
 
      
        </script>
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