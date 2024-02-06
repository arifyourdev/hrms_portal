<?php
$contact = Contact::find_by_single_contact();
$user_login_type = $_SESSION['user_login_type'];
?>

<div class="top-header">
    <div class="top-header-support">
        <div class="row">
            <div class="col-lg-2 top-h-width">

            </div>
            <style>
                .ui-autocomplete {
                    max-height: 400px;
                    overflow-y: auto;
                    overflow-x: hidden;
                    padding-right: 20px;
                }

                .ui-autocomplete {
                    height: 400px;
                }

                .dummy {
                    pointer-events: none
                }
            </style>
            <div class="col-lg-8">
                <div class="madhuban-tags-break">
                    <div class="madhuban-tags">
                        <a href="tel://<?php echo $contact->mobile ?>"><i class="fa fa-phone"></i> +91-11204078900</a>
                        <a href="https://wa.me/<?php echo $contact->whatsapp ?>"><i class="fa-brands fa-whatsapp"></i>+91-7827801827 </a>
                        <a href="mailto:<?php echo $contact->email ?>"><i class="fa fa-envelope-o"></i> info@madhubunbooks.com</a>
                    </div>
                    <div class="madhuban-searchs">
                        <form method="post">
                            <input type="text" name="search" id="search" class="form-controls" placeholder="Search with ISBN / Author / Title">
                            <button type="button" name="submsit" class="serch-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">

                <?php if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $user_data = BookUserMaster::find_by_user_id($user_id); ?>
                    <nav class="mainmenu__nav reponsive_profile login_nav ">
                        <ul class="meninmenu d-flex justify-content-start">
                            <li class="drop"><a href="my-profile#edit_profile" class="madhu_account">
                                    <i class="fa-solid fa-user class_icn_h"></i><?php echo substr($user_data->user_firstname,0,12)?>..</a>
                                <div class="megamenu dropdown profil_dropwn">
                                    <?php if ($user_login_type == '1') {
                                    ?>
                                        <ul class="item item01 ">
                                            <li class="my-profile_label"><a href="my-profile#edit_profile" style="color: #000 !important;"><i class="fa-solid fa-user"></i>Edit Profile</a></li>
                                            <li class="my-profile_label"><a href="subscription" style="color: #000 !important;"><i class="fa-solid fa-subscript"></i></i> My Subscription</a> </li>
                                            <li class="my-profile_label"><a href="my-profile#favourite" style="color: #000 !important;"><i class="fa-solid fa-heart"></i> My Favourite</a> </li>
                                            <li class="my-profile_label"><a href="my-profile#change_password" style="color: #000 !important;"><i class="fa-solid fa-lock"></i>Change Password</a></li>
                                            <li class="my-profile_label"><a href="my-profile#resources" style="color: #000 !important;"><i class="fa-solid fa-file-export"></i> Request Resources</a></li>
                                            <li><a href="logout" style="color: #000 !important;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                                        </ul>
                                    <?php } else { ?>
                                        <ul class="item item01 ">
                                            <li class="my-profile_label"><a href="my-profile#edit_profile" style="color: #000 !important;"><i class="fa-solid fa-user"></i>Edit Profile</a></li>
                                            <li class="my-profile_label"><a href="my-profile#favourite" style="color: #000 !important;"><i class="fa-solid fa-heart"></i> My Favourite</a> </li>
                                            <li class="my-profile_label"><a href="my-profile#change_password" style="color: #000 !important;"><i class="fa-solid fa-lock"></i>Change Password</a></li>
                                            <li><a href="logout" style="color: #000 !important;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                                        </ul>
                                    <?php } ?>
                                </div>
                            </li>
                        </ul>
                    </nav>
                <?php } else { ?>
                    <div class="login-register">
                        <a href="login" class="btnn login-btn">Login</a>
                        <a href="register" class="btnn register-btn">Register</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<header id="wn__header" class="oth-page header__area header__absolute sticky__header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-7 col-lg-2">
                <div class="logo">
                    <a href="<?php echo $base_url ?>" class="logo-hover">
                        <img src="img/logo.svg" alt="logo images">
                    </a>
                </div>
            </div>
            <div class="col-lg-10 d-none d-lg-block">
                <nav class="mainmenu__nav">
                    <ul class="meninmenu d-flex justify-content-start">
                        <li><a href="<?php echo $base_url ?>"><i class="fa-solid fa-house home_icon"></i></a></li>

                        <li class="drop"><a href="about">About us<i class="fa-solid fa-angle-down"></i></a>
                            <div class="megamenu dropdown">
                                <ul class="item item01">
                                    <li class="about_label"><a href="about#who-we-are">Who we are</a></li>
                                    <li class="about_label"><a href="#">Our Legacy</a> </li>
                                    <li class="about_label"><a href="#">Our Leadership Team</a></li>
                                    <li class="about_label"><a href="about#vision-and-mission">Our Mission</a></li>
                                    <li class="about_label"><a href="#">Meet our Authors</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="drop"><a href="<?php echo $base_url ?>/books-list/hindisanskrit-">Books <i class="fa-solid fa-angle-down"></i></a>
                            <div class="megamenu dropdown">
                                <ul class="item item01">
                                    <?php
                                    $book_subject_sql = BookSubject::find_by_sort_order();
                                    foreach ($book_subject_sql as $subject_data) {

                                    ?>
                                        <li class="label2"><a href="books-list/<?php echo $subject_data->subject_filename ?>"><?php echo $subject_data->subject_title ?></a>
                                            <?php
                                            if ($subject_data->subject_title != 'Madhubun Reading Club') { ?>
                                                <ul class="d-none">
                                                    <?php $boards = Board::find_by_order();
                                                    foreach ($boards as $board) {
                                                    ?>
                                                        <li><a href="books-list/<?php echo $board->board_title ?>/<?php echo $subject_data->subject_filename ?>"><?php echo $board->board_title ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            <?php }
                                            ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </li>

                        <li class="drop"><a href="<?php echo $base_url ?>/ebooks-list/hindisanskrit-">Buy ebooks <i class="fa-solid fa-angle-down"></i></a>
                            <div class="megamenu dropdown">
                                <ul class="item item01">
                                    <?php
                                    $book_subject_sql = BookSubject::find_by_sort_order();
                                    foreach ($book_subject_sql as $subject_data) {
                                    ?>
                                        <li class="label2"><a href="ebooks-list/<?php echo $subject_data->subject_filename ?>"><?php echo $subject_data->subject_title ?></a>
                                            <?php if ($subject_data->subject_title != 'Madhubun Reading Club') { ?>
                                                <ul class="d-none">
                                                    <?php $boards = Board::find_by_order();
                                                    foreach ($boards as $board) {
                                                    ?>
                                                        <li><a href="ebooks-list/<?php echo $board->board_title ?>/<?php echo $subject_data->subject_filename ?>"><?php echo $board->board_title ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </li>

                        <li class="drop"><a href="javascript:void(0)">Teacher Resoure Centre <i class="fa-solid fa-angle-down"></i></a>
                            <div class="megamenu dropdown">
                                <?php if (isset($_SESSION['user_id'])) {
                                    if ($user_login_type == '1') {
                                ?>
                                        <ul class="item item01">
                                            <li><a href="#" style="pointer-events: none">Digital Content</a></li>
                                            <li><a href="my-profile#subscription">Teacher Support Book (Lesson Plans/ Answer Keys)</a></li>
                                            <li><a href="my-profile#subscription">Worksheets</a></li>
                                            <li><a href="#" style="pointer-events: none">Flipbook</a></li>
                                        </ul>
                                    <?php } else { ?>
                                        <ul class="item item01">
                                            <li><a href="#">Digital Content</a></li>
                                            <li><a href="dummy">Teacher Support Book (Lesson Plans/ Answer Keys)</a></li>
                                            <li><a href="dummy">Worksheets</a></li>
                                            <li><a href="#">Flipbook</a></li>
                                        </ul>
                                    <?php } ?>
                            </div>
                        </li>
                    <?php } else { ?>
                        <ul class="item item01">
                            <li><a href="#">Digital Content</a></li>
                            <li><a href="login">Teacher Support Book (Lesson Plans/ Answer Keys)</a></li>
                            <li><a href="login">Worksheets</a></li>
                            <li><a href="#">Flipbook</a></li>
                        </ul>
                    <?php } ?>

                    <li class="drop"><a href="request-epd">Educator Professional Development <i class="fa-solid fa-angle-down"></i></a>
                        <div class="megamenu dropdown">
                            <ul class="item item01">
                                <li><a href="javascript:void(0)">Webinars</a></li>
                                <li><a href="javascript:void(0)">Workshops</a></li>
                                <li><a href="https://madhubunbooks.com/past-events?sort_type=webinars">Past events</a></li>
                                <li><a href="request-epd" target="_blank">Request EPD</a></li>
                                <li><a href="javascript:void(0)">Articles and Blogs</a></li>
                            </ul>
                        </div>
                    </li>

                    <li><a href="educate-360">Educate 360</a></li>
                    </ul>
                </nav>
            </div>

        </div>

        <!-- Start Mobile Menu -->
        <div class="row d-none">
            <div class="col-lg-12 d-none">
                <nav class="mobilemenu__nav">
                    <ul class="meninmenu">
                        <li><a href="about">About</a>
                            <ul>
                                <li class="about_label"><a href="about#who-we-are">Who we are</a></li>
                                <li class="about_label"><a href="about#our-legacy">Our Legacy</a> </li>
                                <li class="about_label"><a href="about#our-leadership-team">Our Leadership Team</a></li>
                                <li class="about_label"><a href="about#vision-and-mission">Vision and Mission</a></li>
                                <li class="about_label"><a href="about#meet-our-authors">Meet our Authors</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo $base_url ?>/books-list/hindisanskrit-">Books</a>
                            <ul>
                                <?php
                                $book_subject_sql = BookSubject::find_by_sort_order();
                                foreach ($book_subject_sql as $subject_data) {
                                ?>
                                    <li class="label2"><a href="books-list/<?php echo $subject_data->subject_filename ?>"><?php echo $subject_data->subject_title ?></a>
                                        <?php if ($subject_data->subject_title != 'Madhubun Reading Club') { ?>
                                            <ul class="d-none">
                                                <?php $boards = Board::find_by_order();
                                                foreach ($boards as $board) {
                                                ?>
                                                    <li><a href="books-list/<?php echo $board->board_title ?>/<?php echo $subject_data->subject_filename ?>"><?php echo $board->board_title ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li><a href="<?php echo $base_url ?>/ebooks-list/hindisanskrit-">Ebooks</a>
                            <ul>
                                <?php
                                $book_subject_sql = BookSubject::find_by_sort_order();
                                foreach ($book_subject_sql as $subject_data) {
                                ?>
                                    <li class="label2"><a href="ebooks-list/<?php echo $subject_data->subject_filename ?>"><?php echo $subject_data->subject_title ?></a>
                                        <?php if ($subject_data->subject_title != 'Madhubun Reading Club') { ?>
                                            <ul class="d-none">
                                                <?php $boards = Board::find_by_order();
                                                foreach ($boards as $board) {
                                                ?>
                                                    <li><a href="ebooks-list/<?php echo $board->board_title ?>/<?php echo $subject_data->subject_filename ?>"><?php echo $board->board_title ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Teachers Resoure Centre</a>
                            <?php if (isset($_SESSION['user_id'])) {
                                if ($user_login_type == '1') {
                            ?>
                                    <ul class="item item01">
                                        <li><a href="digital-content" style="pointer-events: none">Digital Content</a></li>
                                        <li><a href="my-profile#subscription">Teacher Support Book (Lesson Plans/ Answer Keys)</a></li>
                                        <li><a href="my-profile#subscription">Worksheets</a></li>
                                        <li><a href="#" style="pointer-events: none">Flipbook</a></li>
                                    </ul>
                                <?php } else { ?>
                                    <ul class="item item01">
                                        <li><a href="dummy">Digital Content</a></li>
                                        <li><a href="dummy">Teacher Support Book (Lesson Plans/ Answer Keys)</a></li>
                                        <li><a href="dummy">Worksheets</a></li>
                                        <li><a href="dummy">Flipbook</a></li>
                                    </ul>
                                <?php } ?>
            </div>
            </li>
        <?php } else { ?>
            <ul class="item item01">
                <li><a href="login">Digital Content</a></li>
                <li><a href="login">Teacher Support Book (Lesson Plans/ Answer Keys)</a></li>
                <li><a href="login">Worksheets</a></li>
                <li><a href="login">Flipbook</a></li>
            </ul>
        <?php } ?>

        <li><a href="request-epd">Educator Professional Development</a>
            <ul>
                <li><a href="all-webinars">Webinars</a></li>
                <li><a href="all-workshops">Workshops</a></li>
                <li><a href="past-events">Past events</a></li>
                <li><a href="request-epd" target="_blank">Request EPD</a></li>
                <li><a href="blog">Articles and Blogs</a></li>
            </ul>
        </li>
        <li><a href="educate-360">Educate 360</a></li>
        <li>
            <div class="mobile-madhuban-tags">
                <a href="tel://<?php echo $contact->mobile ?>"><i class="fa fa-phone"></i> +91-11204078900 </a>
                <a href="https://wa.me/<?php echo $contact->whatsapp ?>" target="_blank"><i class="fa fa-whatsapp"></i> +91-7827801827 </a>
                <a href="mailto:<?php echo $contact->email ?>"><i class="fa fa-envelope-o"></i> info@madhubunbooks.com</a>
            </div>
        </li>
        <li>
            <div class="mobile-social-tags">
                <a href="<?php echo $contact->facebook ?>" target="_blank"><img src="img/facebook.svg" alt=""></a>
                <a href="<?php echo $contact->instagram ?>" target="_blank"><img src="img/instagram.svg" alt=""></i></a>
                <a href="<?php echo $contact->linkedin ?>" target="_blank"><img src="img/linkedin.svg" alt=""></a>
                <a href="<?php echo $contact->twitter ?>" target="_blank"><img src="img/twitter.svg" alt=""></a>
            </div>
        </li>

        </ul>
        </nav>
        </div>
    </div>
    <!-- End Mobile Menu -->
    <div class="mobile-menu d-block d-lg-none">
    </div>
    <!-- Mobile Menu -->
    </div>
    <div class="side-social-links justify-content-center On-Desktop">

        <ul class="social__net social__net--2">
            <li><a href="<?php echo $contact->facebook ?>" target="_blank"><img src="img/facebook.svg" alt=""></a></li>
            <li><a href="<?php echo $contact->instagram ?>" target="_blank"><img src="img/instagram.svg" alt=""></i></a></li>
            <li><a href="<?php echo $contact->linkedin ?>" target="_blank"><img src="img/linkedin.svg" alt=""></a></li>
            <li><a href="<?php echo $contact->twitter ?>" target="_blank"><img src="img/twitter.svg" alt=""></a></li>
            <li><a href="<?php echo $contact->youtube ?>" target="_blank"><img src="img/youtube.svg" alt=""></a></li>
        </ul>
    </div>

</header>