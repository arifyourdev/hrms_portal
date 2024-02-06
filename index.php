<?php 
require_once "admin/private/initialize.php";
$mail_t = EmailtemplateMaster::find_by_mailtemplate_id(108);
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
 
 $contact = Contact::find_by_single_contact();
   
 if (is_post_request()) {
     
    $e_name = htmlentities($database->escape_string($_POST['nl']['nl_email']));
   
      
// if we want to send via SMTP

        $mail = new PHPMailer();
        $mail->Host = "mail.madhubun.in";
        $mail->addAddress($e_name);                             
        $mail->setFrom('marketing@madhubun.in');
        $mail->FromName = 'Regard';
        $mail->Subject = 'Newsletter Subscription @ madhubunbooks.com';
        $mail->isHTML(true);
 
        $mail->Body ='Thank You! for Subscribing at www.madhubunbooks.com.
         We have successfully received your Newsletter Subscription request for Madhubun Books. You will be notified of every new update.
        Thank You,
        The Madhubun Publication Team';
 
         if($mail->send()){
            $args = $_POST['nl'];
            $nl = new BookSubscription ($args);
            $nl->nl_email = $e_name;
            $nl->nl_status = 'Y';
            
            $result = $nl->save('nl_id');
            
                  if($result) 
                        {
                            $_SESSION['status_pop'] = "Subscription Submitted";
                            $_SESSION['status_pop_code'] = "success";
                            header('Refresh:3;url=index');
                             
                        } else {
                            $_SESSION['status_pop'] = "Email already Register";
                            $_SESSION['status_pop_code'] = "error";
                        }
           
        } else{
            echo $mail->Errorinfo; 
        }
        $admin_email = $_POST['admin_email'];
        $mails = new PHPMailer();
        $mails->Host = "mail.madhubun.in";
        $mails->addAddress($admin_email);                             
        $mails->setFrom('marketing@madhubun.in');
        $mails->FromName = 'Regard';
        $mails->Subject = 'Newsletter-2';
        $mails->isHTML(true);
 
        $mails->Body ='Thank You newdsfds ';
 
         if($mails->send()){
             
        } else{
            echo $mail->Errorinfo; 
        }
        
    
    } 
        
        
     $notice = BookCms::find_by_caution_notice();
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <base href="<?php echo $base_url?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <?php include 'includes/head.php' ?>
    
</head>

<body>
    <!-- Main wrapper -->
    <div class="wrapper" id="wrapper">
        <!-- Header -->
        <?php include 'includes/header.php' ?>
        <!-- //Header -->
        <!-- Start Search Popup -->
        <div class="brown--color box-search-content search_active block-bg close__top">
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
        <style>
            .main-slider {
                margin-top: 62px;
                background: #ffc0cb4a;
                height: 370px;
               }
             
            .main-s-text {
                margin-top: 80px;
                margin-bottom: 34px;
            }

            .main-s-text p {
                color: grey;
            }

            .main-s-text h2 {
                text-transform: uppercase;
                color: #000;
            }

            .items {
                opacity: 0.9;
                transition: .4s ease all;
                margin: 0 10px;
                transform: scale(.4);
                position: relative;
                bottom: 59px;
                left: 40px;
            }

             

            .active .items {
                opacity: 1;
                transform: scale(.7);
                /*margin-left:50px;*/
                /*margin-top: 30px;*/
            }

            .owl-item {
                -webkit-backface-visibility: hidden;
                -webkit-transform: translateZ(0) scale(1.0, 1.0);
            }

            .inner {
                position: absolute;
                left: -150px;
                top: 178px;
                width: 100%;
                background: #892139;
                text-align: center;
                transform: rotate(270deg);
                font-size: 23px;
                padding: 6px 10px;
                }

            .inner a {
                color: #fff !important;
                text-decoration: none;
              
                transition: .3s ease border-color
            }

            .inner a:hover {
                border-color: #fff !important;
            }

            .black .inner a {
                color: #000;
                border-color: rgba(0, 0, 0, 0.4)
            }

            .black .inner a:hover {
                border-color: #000;
            }
 
            .owl-controls {
                position: absolute;
                margin-top: 300px;
            }
             
            /*css*/
            .madhu-oc .owl-nav div.owl-prev, 
            .madhu-oc .owl-nav div.owl-next {
                font-size: 18px;
                margin-top: 20px;
                position: absolute;
                text-align: center;
                line-height: 39px;
                color: #fff !important;
                width: 40px;
                height: 40px;
                left: -40px;
                top: 127px;
                background: #892139;
                border-radius: 50%;
            }
            .madhu-oc .owl-nav div.owl-prev{
                left: 46%;
                opacity: 3;
                display: none;
            }
            .madhu-oc .owl-nav div.owl-next {
                left: -17;
                opacity: 3; 
                transform: rotate(180deg);
            }
            
           .madhu-oc:hover .owl-nav div.owl-next:hover,
           .madhu-oc:hover .owl-nav div.owl-prev:hover{
                color:#fff;
                background: #0C94B8;
                border: 1px solid #0C94B8;
            }
 
         .customer-review-star ul{
            display: flex;
            position: inherit;
            right: 18px;
            }
        .customer-speak-content{
             height:250px;   
            }
        .first__img img{
            height:230px;
        }    
        .madhu-books-name h6{
            font-size:15px;
        }
       .video {
            width: 100%;
            height: 400px;
            margin: auto;
            display: block;
            border: none;
        }

        .video-popup {
            display: none;
            z-index: 999;
            width: 100%;
            height: 100vh;
            margin: auto;
            position: fixed;
            top: 0;
            box-shadow: 10px 10px 10px 10px black;
        }

        .popup-bg {
            background: rgba(0, 0, 0, 0.8);
            width: 100%;
            height: 100vh;
            position: absolute;
        }

        .popup-content {
            background: black;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 800px;
            height: auto;
        }
        .testip {
            overflow-x: scroll;
            height:200px;
        }
        .items:nth-child(2){
            display:none;
        }
 </style>
        <!-- End Search Popup -->
        <!-- Start Slider area -->
        <div class="main-slider">
            <div class="container">
                <div class="row">
                     <div class="col-lg-3">
                        <div class="main-s-text">
                            <h2>Feature To Fascinate</h2>
                            <p>Fun Animation l-Book With interactive Activities</p>
                        </div>
                    </div>
                     <div class="col-lg-9 section-w">
                        <div id="madhu-slider" class="owl-carousel madhu-oc">
                            <?php $banner = Banner::find_by_order();
                            foreach($banner as $data){
                            ?>
                            <div class="items">
                                <a href="<?php echo $data->banners_click_url ?>">
                                    <img src="admin/<?php echo $data->picture_path()?>" alt="" style="height: 461px;" />
                                     <div class="inner">
                                        <a href=""><?php echo $data->banners_title?></a>
                                     </div>
                                </a>
                            </div>
                            <?php } ?>
                            
                            </div>
                        </div>
               </div>
               <div class="border-img">
                 <img src="img/banner-b.png">
               </div>
            </div>
            </div>
        </div>
        <!-- End Slider area -->

        <!-- Start cj Area -->
        <section class="wn__newsletter__area home-cj">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="cj-section">
                            <div class="text-center">
                                <div class="cj-items">
                                    <img src="img/play-alt.svg">
                                     <a class="popup-btn" href="" target="_blank"><h6 class="cj-txt">Corporate Video</h6></a>
                                </div>
                            </div>
                            <div class="cj-items">
                                <img src="img/download.svg">
                              <h6 class="cj-txt cj-text2">Download <a href="Price-List-2023.pdf" target="_blank" download> <b>Price list</b></a>  & <a href="Catalogue_Madhubun_2023.pdf" target="_blank" download><b>Catalogue</b></a></h6>
                            </div>
                            <div class="cj-items">
                                <img src="img/journal.svg"> 
                               <a href="journals"><h6 class="cj-txt cj-jour">Journals</h6></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Start BEst Seller Area -->
        <section class="wn__product__area brown--color pt--80  pb--30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title text-center">
                            <h2 class="title__be--2">BESTSELLER</h2>
                            <p>Which serve as valueble companions for effective, hands-on interactive teaching </p>
                        </div>
                    </div>
                </div>
                <!-- Start Single Tab Content -->
                <div class="furniture--4 border--round arrows_style owl-carousel owl-theme mt--50">
                     <!--Start bestseller -->
                    <?php 
                        $bestseller = BookSeries::find_by_bestseller();
                        foreach($bestseller as $best){
                        ?>
                    <div class="product product__style--3">
                        <div class="product__thumb madhu-bestseller">
                            <a class="first__img" href="book-details/<?php echo $best->series_id?>">
                                <img src="admin/<?php echo $best->picture_path()?>" alt="product image"></a>
                        </div>
                        <div class="madhu-books-name">
                            <h6><a href="book-details/<?php echo $best->series_id ?>"><?php echo $best->series_title ?></a></h6>
                        </div>
                    </div>
                    <?php } ?>
                      
                </div>
                <!-- End Single Tab Content -->
            </div>
        </section>

      
        <section>
            <div class="container mt-5">
                <div class="row">
                       <div class="col-lg-6">
                      <div class="news-m">
                         <div class="madhubn-news">
                            <div class="madhuban_news_h5">
                                <h4>NEWSROOM</h4>
                            </div>
                        </div>
                        <div id="workshop-slider" class="owl-carousel">
                            <?php 
                            $news = NewsroomDetail::find_by_order();
                            foreach($news as $new){
                            ?>
                            <div class="item">
                                <div class="madhubun-news-content">
                                    <div class="madhubun-news-img">
                                        <div class="news-pro">
                                            <?php
                                            if($new->image == ""){ ?>
 
                                         <img src="https://fakeimg.pl/255x136/"> 
                                              
                                             <?php } else {?>
                                              
                                            <a href="newsroom_details/<?php echo $new->id ?>"> <img src="admin/<?php echo $new->picture_path(); ?>" alt=""></a>
                                             
                                             <?php } ?>
                                             
                                         </div>
                                        <div class="news-title">
                                            <a href="newsroom_details/<?php echo $new->id?>"><h6><?php echo $new->title?></h6></a>
                                            <p><?php echo $new->date?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php } ?>
                         
                        </div>
                         <div class="view-all2 text-center">
                              <a href="<?php echo $base_url ?>/newsroom?newsroom=2022" class="view-btn2">View All</a>
                         </div>
                    </div>
                    
                    </div>
                     <div class="col-lg-6">
                        <div class="news-m">
                        <div class="madhubn-news">
                            <div class="madhuban_news_h5">
                                <h4>AT MADHUBUN EDUCATIONAL BOOKS</h4>
                            </div>
                        </div>
                          <div id="news-slider" class="owl-carousel">
                              <?php $album_sql = BookAlbum::find_by_order();
                              foreach($album_sql as $album_data){?>
                            <div class="item">
                                <div class="madhubun-news-content">
                                    <div class="madhubun-news-img">
                                        <div class="news-pro">
                                            <a href="at-madhubun-educatinal-books-detail/<?php echo $album_data->album_id?>"> <img src="admin/<?php echo $album_data->picture_path()?>"></a>
                                         </div>
                                        <div class="news-title">
                                            <h6><?php echo $album_data->album_title?></h6>
                                            <!--<p>Posted on january 20-07-2021</p>-->
                                        </div>
                                    </div>
                                 </div>
                            </div>
                            <?php } ?>
                          </div>
                         <div class="view-all2 text-center">
                              <a href="at-madhubun-educatinal-books" class="view-btn2">View All</a>
                         </div>
                         </div>
                    </div>
                     
                </div>
            </div>
        </section>
       
    <!-- Start customer speak -->
    <section class="wn__product__area brown--color pt--80 pb--30 main-content">
        <div class="container" style="margin-bottom:100px;">
           <div class="section__title text-center">
             <h2>Testimonials</h2>
          </div>
            <div id="speak-slider" class="owl-carousel">
                <?php 
                $testimonial= BookTestimonial::find_by_order();
                foreach($testimonial as $test){
                ?>
                <div class="item testimonial_items">
                    <div class="customer-speak-content">
                        <div class="customer-speak">
                            <div class="customer-pro">
                                <img src="img/empower.png" alt="">
                            </div>
                            <div class="customer-name">
                                <h6><?php echo $test->testimonial_added_by?></h6>
                                 
                            </div>
                            <div class="customer-review-star">
                                <ul>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="testip">
                          <p><?php echo $test->testimonial_detail?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

 
    <!-- Newsletter -->
    <div class="home-news-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="home-n-back text-center">
                        <h4>NEWSLETTER SIGN-UP</h4>
                        <p>For regular interesting educational content</p>
                        <h6 class="text-success"><?php echo display_session_message(); ?></h6>
                        <form method="POST">
                        <div class="newsletter-new">
                            <input name="nl[nl_email]" id="nl_email" type="email" placeholder="Enter your email address" value="" required>
                            <input type="hidden" name="admin_email"  value="divjonny58@gmail.com">
                            <input type="hidden" name="nl[nl_date]" value="<?php echo $time ?>">
                            <input type="hidden" name="nl[nl_status]">
                            <input type="submit" name="submit" id="subSubmit" value="Subscribe Now">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- Footer Area -->
    <?php include 'includes/footer.php' ?>
    <!-- //Footer Area -->
 <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-headerss text-center">
                <!-- <button type="button" id="accButton" data-target="#myModal" class="close close-modal" data-dismiss="modal" aria-label="Close">-->
                <!--    <span aria-hidden="true">×</span>-->
                <!--</button>-->
                <a href="<?php echo $base_url; ?>" class="">
                   <img src="img/logo.svg" alt="logo images">
                </a>
            </div>
            <div class="modal-bodyss">
                <div class="container">
              <div class="modal-content-text text-center">
                <div class="c_n">
                <h4>CAUTION NOTICE</h4> 
                </div>
                
                <!-- <div class="notice_border"></div> -->
                <div>
                  <?php echo $notice->cms_detail?>
                  </div>
                <div class="text-center modal-ok-h">
                <button type="button" id="accButton" data-target="#myModal" class="close modal-ok" data-bs-dismiss="modal" aria-label="Close">
                    Ok
                </button>
            </div>
           </div>
           </div>
           
         </div>
         </div>
    </div>
</div>

    </div>
    <!-- //Main wrapper -->
    
<!--Video-->
   <div class="video-popup">
    <div class="popup-bg"></div>
      <div class="popup-content">
         <iframe src="https://www.youtube.com/embed/Zt0m_vDT7Aw" class="video"></iframe>
        <div class="text-center">
         <button class="close-btn">close</button>
        </div>
      </div>
  </div>
  <!--end Video-->
    <!-- JS Files -->
    <?php include 'includes/foot.php' ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
        $('#madhu-slider').owlCarousel({
            stagePadding: 400,
            loop: true,
            margin: -20,
            nav: true,
            navText: ['<i class="fa-solid fa-arrow-right-long"></i>', '<i class="fa-solid fa-arrow-right-long"></i>'],
            items: 1,
            
            responsive: {
                0: {
                    items: 1,
                    stagePadding: 60
                },
                260: {
                    items: 1,
                    stagePadding: 0
                },
                900: {
                    items: 1,
                    stagePadding: 200
                },
                 1100: {
                    items: 1,
                    stagePadding: 200
                },
                1200: {
                    items: 1,
                    stagePadding: 250
                },
                1400: {
                    items: 1,
                    stagePadding: 250
                },
                1600: {
                    items: 1,
                    stagePadding: 250
                },
                1800: {
                    items: 1,
                    stagePadding: 250
                }
            }
        });
        
         $('.popup-btn').on('click', function() {
                $('.video-popup').fadeIn('slow');
                return false;
            });



            $('.close-btn').on('click', function() {
                $('.video-popup').fadeOut('slow');
                window.location.reload();
            });
            
            
    </script>
 </body>

</html>
