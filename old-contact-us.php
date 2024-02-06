<?php
require_once "admin/private/initialize.php";
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Contact us | Madhuban</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include 'includes/head.php' ?>
</head>

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
        <!-- End Search Popup -->
         <!-- Start About Area -->
        <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                    <div class="wn__sidebar">
                         <!-- Start Single Widget -->
                        <aside class="widget category_widget">
                            <h3 class="widget-titles">Contact Us</h3>
                            <ul class="contact-us-ul">
                                <li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="contact-us">Reach Us</a></li>
                                <li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="feedback">Feedback</a></li>
                                
                              </ul>
                        </aside>
                        <!-- End Single Widget -->
                         
                    </div>
                </div>
                <div class="col-lg-9 col-12 order-1 order-lg-2">
                    <div class="blog-page">
                         <!-- Start Single Post -->
                        <article class="blog__post d-flex flex-wrap contact-bck">
                            <div class="thumb">
                               <h4 class="contact-h4">Corporate Office</h4>
                               <p>E-28, Sector-8, Noida- 201301</p> 
                               <p>Landline: +91 1204078900</p> 
                               <p>Fax: +91 1204078999</p>
                               <p><a href="">Email: info@madhubunbooks.com</a></p>
                            </div>
                            <div class="content">
                             <h4 class="contact-h4">Registered Office</h4>  
                               <p>A-27, 2nd Floor,</p> 
                               <p>Mohan Co-operative Industrial Estate,</p> 
                               <p>New Delhi-110044</p>
                             </div>
                        </article>
                        <!-- End Single Post -->
                     </div>
                    <div class="contact-page mt-3">
                      <h3 class="c-branchs">BRANCHES</h3>
                      <div class="contact-page-2">
                          <div class="contact-flex-2">
                               <div class="address-d-2">
                                  <h6 class="addres-t-n">Ahmedabad</h6>
                                  <p>4th Floor, 409/B, Shivalik Corporate Park,
                                    Opp. Ashwamegh Bunglows,
                                    V-1, B/H Petrol Pump, 132 Ft Ring Road,
                                    Satellite, Ahmedabad – 380015
                                  </p>
                                  <p>Landline: +079  26763327</p>
                                  <p>Email: ahmedabad@madhubunbooks.com</p>
                              </div>
                               <div class="address-d-3">
                                     <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=121%20King%20St%2C%20Melbourne%20VIC%203000%2C%20Australia&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"></iframe>
                                    <a href="https://sites.google.com/view/maps-api-v2/mapv2"></a>
                              </div>
                           </div>
                      </div>
                      <div class="contact-page-2">
                          <div class="contact-flex-2">
                               <div class="address-d-2">
                                  <h6 class="addres-t-n">Bengaluru</h6>
                                  <p>First Floor, N.S. Bhawan, 4th Cross, 4th MainGandhi Nagar, Bengaluru - 560009 </p>
                                  <p>Landline: +079  26763327</p>
                                  <p>Email: ahmedabad@madhubunbooks.com</p>
                              </div>
                               <div class="address-d-3">
                                     <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=121%20King%20St%2C%20Melbourne%20VIC%203000%2C%20Australia&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"></iframe>
                                    <a href="https://sites.google.com/view/maps-api-v2/mapv2"></a>
                              </div>
                           </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- End About Area -->

        <!-- Footer Area -->
        <?php include 'includes/footer.php' ?>
        <!-- //Footer Area -->

    </div>
    <!-- //Main wrapper -->
    <!-- JS Files -->
    <?php include 'includes/foot.php' ?>
</body>

</html>